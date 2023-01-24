<?php

use function PHPSTORM_META\type;

class Product extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
    }

    public function get_all_count()
    {
        $this->db->select("COUNT(*) as total_products");
        $this->db->from('product');
        $this->db->where('total_count_in_store > 0');
        $query = $this->db->get();
        $array = $query->result_array();
        return $array;
    }

    public function get_product_category($id)
    {
        $array = array();
        $this->db->select('category_product.category_id');
        $this->db->from('category_product');
        $this->db->where('product_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function add($array)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_articule', $array['product_articule']);
        $query0 = $this->db->get();
        if (sizeof($query0->result_array()) != 0)
            return -1;
        $active_substances = $array['active_substance'];
        $indications = $array['indications'];
        $categories = $array['categories'];
        $product_pic = $array['product_pic'];
        unset($array['active_substance']);
        unset($array['indications']);
        unset($array['categories']);
        unset($array['product_pic']);

        $array['product_pic'] = $product_pic['1'];
        $this->db->insert('product', $array);
        $id = $this->db->insert_id();

        if ($active_substances != '') {
            foreach ($active_substances as $as) {
                $arr = array('active_substance_id' => $as, 'product_id' => $id);
                $this->db->insert('active_substance_product', $arr);
            }
        }
        if ($indications != '') {
            foreach ($indications as $is) {
                $arr = array('indications_id' => $is, 'product_id' => $id);
                $this->db->insert('indications_product', $arr);
            }
        }
        if (sizeof($categories) != 0) {
            foreach ($categories as $category_id) {
                $arr = array('category_id' => $category_id, 'product_id' => $id);
                $this->db->insert('category_product', $arr);
            }
        }

        $arr = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
        $this->db->insert('product_images', $arr);
        unset($product_pic['1']);

        if (sizeof($product_pic) != 0) {
            foreach ($product_pic as $pp) {
                $arr = array('product_id' => $id, 'product_pic' => $pp);
                $this->db->insert('product_images', $arr);
            }
        }
        return $id;
    }

    public function get($id, $str = '' , $user_id = null)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('product');
        $this->db->where('id', $id);
        if ($str != '') {
            $this->db->where('product_status', 1);
        }

        $query = $this->db->get();
        $q = $this->db->query("SELECT active_substance_product.id as asp_id, active_substance.id, active_substance.tag_name FROM product 
                          LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                          LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                          WHERE product.id = " . $id);

        $q3 = $this->db->query("SELECT category_product.id as cp_id, category.id,
                            category.category_name FROM product 
                          LEFT JOIN category_product ON category_product.product_id = product.id
                          LEFT JOIN category ON category_product.category_id = category.id 
                          WHERE product.id = " . $id);

        foreach ($query->result_array() as $row) {
            $row['product_form'] = $this->get_other_fields($row['product_form'], 'form');
            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            // $row['product_country'] = $this->get_other_fields($row['product_country'], 'country');
            $row['active_substance'] = $q->result_array();
            $row['categories'] = $q3->result_array();
            if (!isset($user_id))
                $user_id = $this->session->userdata('user_id');

            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }
            $array['total_prods'][] = $row;



            $array = $row;

        }
        $array['product_pics'] = $this->get_img_by_id($id);

        // RATING

        $rating = $this->get_rating($id);
        if (sizeof($rating) != 0) {
            $array['prod_rating_average'] = $rating['prod_rating_average'];
            $array['prod_rating_each'] = $rating['prod_rating_each'];
            $array['review_count'] = $rating['review_count'];
        } else {
            $array['prod_rating_average'] = '';
            $array['prod_rating_each'] = '';
            $array['review_count'] = 0;
        }
        return $array;
    }

    public function get_other_fields($id, $str)
    {
        $this->db->select("*");
        $this->db->from($str);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        if (sizeof($query->result_array()) == 0) {
            $array['id'] = '';
            $array[$str . '_name'] = '';
        }
        return $array;
    }

    public function remove($id)
    {
        $dd = $this->get($id);

        $this->db->delete("active_substance_product", array('product_id' => $id));

        $this->db->delete("indications_product", array('product_id' => $id));

        $this->db->select("*");
        $this->db->from('product_images');
        $this->db->where('product_id', $id);
        $query = $this->db->get();

        $pics = $query->result_array();

        foreach ($pics as $pic) {
            @unlink("././upload_product/" . $pic['product_pic']);
        }

        $this->db->delete("product_images", array('product_id' => $id));

        $this->db->delete("product", array('id' => $id));
    }

    public function remove_prod_pic($prod_pic_id)
    {

        $this->db->select('*');
        $this->db->from('product_images');
        $this->db->where('id', $prod_pic_id);
        $q = $this->db->get();
        $prod_img = null;
        foreach ($q->result_array() as $row) {
            $prod_img = $row['product_pic'];
        }
        @unlink("././upload_product/" . $prod_img);

        $this->db->delete("product_images", array('id' => $prod_pic_id));
    }

    public function update($id, $array)
    {
        $active_substances = $array['active_substance'];
        $indications = $array['indications'];
        $categories = $array['categories'];
        $issetProdPic = false;


        if (isset($array['product_pic'])) {
            $issetProdPic = true;
            $product_pic = $array['product_pic'];
        }
        unset($array['active_substance']);
        unset($array['indications']);
        unset($array['categories']);
        unset($array['product_pic']);

        if ($issetProdPic & isset($product_pic['1'])) {
            $array['product_pic'] = $product_pic['1'];
        }
        $this->db->update('product', $array, array('id' => $id));

        $this->db->delete('active_substance_product', array('product_id' => $id));
        $this->db->delete('indications_product', array('product_id' => $id));
        $this->db->delete('category_product', array('product_id' => $id));

        if (sizeof($active_substances) != 0) {
            foreach ($active_substances as $as) {
                $arr = array('active_substance_id' => $as, 'product_id' => $id);
                $this->db->insert('active_substance_product', $arr);
            }
        }
        if (sizeof($indications) != 0) {
            foreach ($indications as $is) {
                $arr = array('indications_id' => $is, 'product_id' => $id);
                $this->db->insert('indications_product', $arr);
            }
        }
        if (sizeof($categories) != 0) {
            foreach ($categories as $c) {
                $arr = array('product_id' => $id, 'category_id' => $c);
                $this->db->insert('category_product', $arr);
            }
        }

        $this->db->select('*');
        $this->db->from('product_images');
        $this->db->where('product_id', $id);
        $qq = $this->db->get();
        $pi = $qq->result_array();
        $pi_count = sizeof($pi);

        if ($issetProdPic) {

            if ($pi_count == 0) {
                $pic_array = array();
                $this->db->select('*');
                $this->db->from('product');
                $this->db->where('id', $id);
                $qq2 = $this->db->get();
                $pi = $qq2->result_array();
                if ($pi[0]['product_pic'] != '') {
                    foreach ($product_pic as $ind => $prod_pic) {
                        $pic_array['product_id'] = $id;
                        $pic_array['product_pic'] = $prod_pic;
                        if ($pi[0]['product_pic'] == $prod_pic) {
                            $pic_array['product_avatar'] = 1;
                        } else {
                            $pic_array['product_avatar'] = 0;
                        }
                        $this->db->insert('product_images', $pic_array);
                    }
                } else {
                    foreach ($product_pic as $ind => $prod_pic) {
                        $this->db->insert('product_images', array(
                            'product_id' => $id,
                            'product_pic' => $prod_pic,
                            'product_avatar' => 0
                        ));
                    }
                }
            } else if ($pi_count == 1) {

                if (sizeof($product_pic) == 3) {

                    $arr2 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                    $this->db->update('product_images', $arr2, array('product_id' => $id));
                    unset($product_pic['1']);

                    foreach ($product_pic as $pp) {
                        $arr = array('product_id' => $id, 'product_pic' => $pp);
                        $this->db->insert('product_images', $arr);
                    }
                    $this->remove_pic_from_folder($pi[0]['product_pic']);
                } else if (sizeof($product_pic) == 2) {

                    if (isset($product_pic['1'])) {
                        $arr2 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                        $this->db->update('product_images', $arr2, array('product_id' => $id));
                        unset($product_pic['1']);

                        if (isset($product_pic['2'])) {
                            $arr = array('product_id' => $id, 'product_pic' => $product_pic['2']);
                            $this->db->insert('product_images', $arr);
                        } else if (isset($product_pic['3'])) {
                            $arr = array('product_id' => $id, 'product_pic' => $product_pic['3']);
                            $this->db->insert('product_images', $arr);
                        }
                        $this->remove_pic_from_folder($pi[0]['product_pic']);
                    } else {

                        foreach ($product_pic as $pp) {
                            $arr = array('product_id' => $id, 'product_pic' => $pp);
                            $this->db->insert('product_images', $arr);
                        }
                    }
                } else {

                    if (isset($product_pic['1'])) {
                        $arr = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                        $this->db->update('product_images', $arr, array('product_id' => $id));
                        $this->remove_pic_from_folder($pi[0]['product_pic']);
                    } else {
                        $product_pic = array_values($product_pic);
                        // print_r($product_pic);
                        // die();
                        $arr = array('product_id' => $id, 'product_pic' => $product_pic[0]);
                        $this->db->insert('product_images', $arr);
                    }
                }
            } else if ($pi_count == 2) {

                if (sizeof($product_pic) == 3) {

                    $arr1 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                    $this->db->update('product_images', $arr1, array('product_id' => $id, 'product_avatar' => 1));
                    unset($product_pic['1']);

                    $arr2 = array('product_id' => $id, 'product_pic' => $product_pic['2']);
                    $this->db->update('product_images', $arr2, array('product_id' => $id, 'product_avatar' => 0));
                    unset($product_pic['2']);

                    $arr3 = array('product_id' => $id, 'product_pic' => $product_pic['3']);
                    $this->db->insert('product_images', $arr3);
                    foreach ($pi as $p) {
                        $this->remove_pic_from_folder($p['product_pic']);
                    }
                } else if (sizeof($product_pic) == 2) {

                    if (isset($product_pic['1'])) {

                        $arr1 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                        $this->db->update('product_images', $arr1, array('product_id' => $id, 'product_avatar' => 1));
                        unset($product_pic['1']);

                        $product_pic = array_values($product_pic);

                        $arr = array('product_id' => $id, 'product_pic' => $product_pic[0]);
                        $this->db->insert('product_images', $arr);
                        foreach ($pi as $p) {
                            if ($p['product_avatar'] == 1) {
                                $this->remove_pic_from_folder($p['product_pic']);
                            }
                        }
                    } else {

                        $product_pic = array_values($product_pic);

                        $arr2 = array('product_id' => $id, 'product_pic' => $product_pic[0]);
                        $this->db->update('product_images', $arr2, array('product_id' => $id, 'product_avatar' => 0));

                        $arr = array('product_id' => $id, 'product_pic' => $product_pic[1]);
                        $this->db->insert('product_images', $arr);
                        foreach ($pi as $p) {
                            if ($p['product_avatar'] != 1) {
                                $this->remove_pic_from_folder($p['product_pic']);
                            }
                        }
                    }
                } else {
                    if (isset($product_pic['1'])) {

                        $arr1 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                        $this->db->update('product_images', $arr1, array('product_id' => $id, 'product_avatar' => 1));
                        foreach ($pi as $p) {
                            if ($p['product_avatar'] == 1) {
                                $this->remove_pic_from_folder($p['product_pic']);
                            }
                        }
                    } else {

                        $product_pic = array_values($product_pic);

                        $arr2 = array('product_id' => $id, 'product_pic' => $product_pic[0]);
                        $this->db->insert('product_images', $arr2);
                    }
                }
            } else {
                if (isset($product_pic['1'])) {
                    $arr1 = array('product_id' => $id, 'product_pic' => $product_pic['1'], 'product_avatar' => 1);
                    $this->db->update('product_images', $arr1, array('product_id' => $id, 'product_avatar' => 1));
                    foreach ($pi as $p) {
                        if ($p['product_avatar'] == 1) {
                            $this->remove_pic_from_folder($p['product_pic']);
                        }
                    }
                    unset($product_pic['1']);
                }

                if (sizeof($product_pic) != 0) {
                    $product_pic = array_values($product_pic);
                    foreach ($pi as $i => $p) {
                        array_splice($p, $i, 1);
                    }

                    foreach ($product_pic as $prod_p) {
                        $arr2 = array('product_id' => $id, 'product_pic' => $prod_p);

                        for ($i = 0; $i < sizeof($pi); $i++) {
                            if ($pi[$i]['product_avatar'] != 1) {
                                $this->db->update('product_images', $arr2, array('id' => $pi[$i]['id']));
                                $this->remove_pic_from_folder($pi[$i]['product_pic']);
                                unset($pi[$i]);
                                break;
                            }
                        }
                        $pi = array_values($pi);
                    }
                }
            }
        }
        // return $id;
    }

    public function remove_pic_from_folder($str)
    {
        @unlink("././upload_product/" . $str);
    }

    private $per_page_admin = 30;
    public function get_all($current_page, $brand_id = '', $price = '', $search_text = '', $export_status_sort = '',$category_id = '')
    {
        //echo $current_page;
        $array = array('base_url' => base_url());

        $this->db->select("COUNT(*) as total_products");
        $this->db->from('product');

        if ($category_id != '') {
            $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
            $this->db->where('category_product.category_id', $category_id);
        }
        if ($brand_id != '') {
            $this->db->where('product_brand', $brand_id);
        }
        if ($search_text != '') {
            $this->db->like('product_name', $search_text);
        }
        if ($export_status_sort != '') {
            $this->db->where('product_status', $export_status_sort);
        }

        if ($price != '') {
            $this->db->order_by('product_price', $price);
        }

        $qq = $this->db->get();
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            $array['total_products'] = $row['total_products'];
            if ($row['total_products'] > 0)
                $total_pages = ceil($row['total_products'] / $this->per_page_admin);
        }
        $linkk = base_url("index.php/admin/products/?");
        $pages = array();

        if ($category_id != '') {
            $array['product_category_sort'] = $this->get_other_fields($category_id, 'category');
            $linkk = $linkk . "category_sort=" . $category_id . '&';
        }
        if ($brand_id != '') {
            $array['product_brand_sort'] = $this->get_other_fields($brand_id, 'brand');
            $linkk = $linkk . "brand_sort=" . $brand_id . '&';
        }
        if ($price != '') {
            $array['product_price_sort'] = $price;
            $linkk = $linkk . "price_sort=" . $price . '&';
        }
        if ($export_status_sort != '') {
            $array['export_status_sort'] = $export_status_sort;
            $linkk = $linkk . "export_status_sort=" . $export_status_sort . '&';
        }
        $linkk = $linkk . "page=";
        $array['link'] = $linkk;

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $current_page);
        $array['pages'] = $rr;


        if ($current_page > 1 & $current_page <= $total_pages) {
            $array['prev_page'] = $current_page - 1;
        }
        if ($current_page < $total_pages) {
            $array['next_page'] = $current_page + 1;
        }

        if ($current_page <= $total_pages) {

            $this->db->select("product.*");
            $this->db->from('product');

            if ($category_id != '') {
                $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
                $this->db->where('category_product.category_id', $category_id);
            }

            if ($brand_id != '') {
                $this->db->where('product_brand', $brand_id);
            }

            if ($search_text != '') {
                $this->db->like('product_name', $search_text);
            }
            if ($export_status_sort != '') {
                $this->db->where('product_status', $export_status_sort);
            }

            if ($price != '') {
                $this->db->order_by('product_price', $price);
            }
            $this->db->limit($this->per_page_admin, ($current_page - 1) * $this->per_page_admin);

            $query = $this->db->get();
      
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                $array['products'][] = $row;
            }
        } else {
            $array['products'] = [];
        }

        $array['total_pages'] = $total_pages;
        return $array;
    }

    /**
     * Product for admin searching
     */
    public function get_all_admin($current_page, $category_id = '', $brand_id = '', $price = '', $search_text = '', $export_status_sort = '')
    {
        //echo $current_page;
        $array = array('base_url' => base_url());

        $this->db->select("COUNT(*) as total_products");
        $this->db->from('product');

        if ($category_id != '') {
            $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
            $this->db->where('category_product.category_id', $category_id);
        }
        if ($brand_id != '') {
            $this->db->where('product_brand', $brand_id);
        }
        if ($search_text != '') {
            $this->db->like('product_name', $search_text);
        }
        if ($export_status_sort != '') {
            $this->db->where('product_status', $export_status_sort);
        }

        if ($price != '') {
            $this->db->order_by('product_price', $price);
        }

        $qq = $this->db->get();
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            $array['total_products'] = $row['total_products'];
            if ($row['total_products'] > 0)
                $total_pages = ceil($row['total_products'] / $this->per_page_admin);
        }
        $linkk = base_url("index.php/admin/products/?");
        $pages = array();

        if ($category_id != '') {
            $array['product_category_sort'] = $this->get_other_fields($category_id, 'category');
            $linkk = $linkk . "category_sort=" . $category_id . '&';
        }
        if ($brand_id != '') {
            $array['product_brand_sort'] = $this->get_other_fields($brand_id, 'brand');
            $linkk = $linkk . "brand_sort=" . $brand_id . '&';
        }
        if ($price != '') {
            $array['product_price_sort'] = $price;
            $linkk = $linkk . "price_sort=" . $price . '&';
        }
        if ($export_status_sort != '') {
            $array['export_status_sort'] = $export_status_sort;
            $linkk = $linkk . "export_status_sort=" . $export_status_sort . '&';
        }
        $linkk = $linkk . "page=";
        $array['link'] = $linkk;

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $current_page);
        $array['pages'] = $rr;


        if ($current_page > 1 & $current_page <= $total_pages) {
            $array['prev_page'] = $current_page - 1;
        }
        if ($current_page < $total_pages) {
            $array['next_page'] = $current_page + 1;
        }

        if ($current_page <= $total_pages) {

            $this->db->select("product.*");
            $this->db->from('product');

            if ($category_id != '') {
                $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
                $this->db->where('category_product.category_id', $category_id);
            }

            if ($brand_id != '') {
                $this->db->where('product_brand', $brand_id);
            }

            if ($search_text != '') {
                $this->db->like('product_name', $search_text);
            }
            if ($export_status_sort != '') {
                $this->db->where('product_status', $export_status_sort);
            }

            if ($price != '') {
                $this->db->order_by('product_price', $price);
            }
            $this->db->limit($this->per_page_admin, ($current_page - 1) * $this->per_page_admin);

            $query = $this->db->get();

            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                $array['products'][] = $row;
            }
        } else {
            $array['products'] = [];
        }

        $array['total_pages'] = $total_pages;
        return $array;
    }


    public function get_img_by_id($id, $count = null)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('product_images');
        $this->db->where('product_id', $id);
        if ($count != null) {
            $this->db->limit($count);
        }
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    private $per_page = 12;
    //this method for main page because it returns...
    //...products with total_count > 0
    public function get_products_by_category($id, $sort_by, $current, $min_price = '', $max_price = '')
    {
//        var_dump($current);

        if(empty($current)){
            $current = 1;
        }
        $this->load->model('category');
        $array = array();
        // ---------------------------Pages--------------------------------
        $total_products = 0;
        $current_category = $this->category->get_parent_categories($id);
        $cur_cat = $this->category->get_with_children($id);
        $this->db->select("COUNT(DISTINCT(product.id)) as total_products");
        $this->db->from('product');
        $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
        if (sizeof($current_category['parent_cat']) != 0) {
            if ($current_category['parent_cat']['parent_id'] == 0 && sizeof($cur_cat['sub_cat']) != 0) {
                $arr_of_id = null;
                foreach ($cur_cat['sub_cat'] as $sub_cat) {
                    $arr_of_id[] = $sub_cat['id'];
                }
                $arr_of_id[] = $id;
                $this->db->where_in('category_product.category_id', $arr_of_id);
            } else {
                $this->db->where('category_product.category_id', $id);
            }
        }
        $this->db->where('product.product_status', 1);
        // $this->db->where('product.total_count_in_store >', 0);

        if ($min_price != '' && $max_price != '') {
            $this->db->where('product.product_price >=', $min_price);
            $this->db->where('product.product_price <= ', $max_price);
        }
        $qq = $this->db->get();
        $total_pages = 0;
        foreach ($qq->result_array() as $row) {
            if ($row['total_products'] > 0)
                $total_pages = ceil($row['total_products'] / $this->per_page);
        }

        $pages = array();

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => base_url("index.php/main/categoryProducts/" . $id . "?page="),
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => base_url("index.php/main/categoryProducts/" . $id . "?page="),
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $current);
        $array['pages'] = $rr;
        if ($current > 1 & $current <= $total_pages) {
            $array['prev_page'] = $current - 1;
        }
        if ($current < $total_pages) {
            $array['next_page'] = $current + 1;
        }
        if ($current <= $total_pages) {
            $this->db->distinct();
            $this->db->select("product.*");
            $this->db->from('product');
            $this->db->join('category_product', 'category_product.product_id = product.id', 'left');
            if (sizeof($current_category['parent_cat']) != 0) {
                if ($current_category['parent_cat']['parent_id'] == 0 && sizeof($cur_cat['sub_cat']) != 0) {
                    $arr_of_id = null;
                    foreach ($cur_cat['sub_cat'] as $sub_cat) {
                        $arr_of_id[] = $sub_cat['id'];
                    }
                    $arr_of_id[] = $id;
                    $this->db->where_in('category_product.category_id', $arr_of_id);
                } else {
                    $this->db->where('category_product.category_id', $id);
                }
            }
            $this->db->where('product.product_status', 1);

            // $this->db->where('product.total_count_in_store >', 0);

            $sort_rating = false;
            if ($min_price != '' && $max_price != '') {
                $this->db->where('product_price >= ', $min_price);
                $this->db->where('product_price <= ', $max_price);
            }

            if ($sort_by != 'pr') {
                $this->db->order_by('product_price', strtoupper($sort_by));
            } else {
                $sort_rating = true;
            }
            $this->db->limit($this->per_page, ($current - 1) * $this->per_page);
            $query = $this->db->get();

            $query_string = $this->db->last_query();
            $result = explode('ORDER BY', $query_string);
            $array['prod_max_price'] = null;

            if (sizeof($result) > 1 && $total_pages > 0) {
                $new_query = $result[0] . ' ORDER BY `product_price` DESC';
                $qq3 = $this->db->query($new_query);
                $array['prod_max_price'] = $qq3->result_array()[0]['product_price'];
            }
            foreach ($query->result_array() as $row) {
                if (substr_count($row['product_about'], "\n") > 7) {
                    $lines = explode(PHP_EOL, $row['product_about']);
                    $row['product_about'] = implode(PHP_EOL, array_slice($lines, 0, 6)) . PHP_EOL;
                }
                $rating = $this->get_rating($row['id']);
                if (sizeof($rating) != 0) {
                    $row['prod_rating_average'] = $rating['prod_rating_average'];
                    $row['review_count'] = $rating['review_count'];
                } else {
                    $row['prod_rating_average'] = '';
                    $row['review_count'] = 0;
                }

                $user_id = $this->session->userdata('user_id');
                $favorite = $this->get_favorite($row['id'],$user_id?:0);
                if (sizeof($favorite) != 0) {
                    $row['is_favorite'] = true;
                } else {
                    $row['is_favorite'] = false;
                }

                $q = $this->db->query("SELECT active_substance_product.id as asp_id, active_substance.id, active_substance.tag_name FROM product 
                LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                WHERE product.id = " . $row['id']);

                $q3 = $this->db->query("SELECT category_product.id as cp_id, category.id,
                  category.category_name FROM product 
                LEFT JOIN category_product ON category_product.product_id = product.id
                LEFT JOIN category ON category_product.category_id = category.id 
                WHERE product.id = " . $row['id']);

                $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
                $row['active_substance'] = $q->result_array();
                $row['categories'] = $q3->result_array();

                $row['base_url'] = base_url();
                $array['products'][] = $row;
            }
        } else {
            $array['products'] = [];
        }
        $array['total_products'] = ($qq->result_array())[0]['total_products'];

        if (sizeof($array['products']) != 0 && $sort_rating) {
            array_multisort(array_column($array['products'], 'prod_rating_average'), SORT_DESC, $array['products']);
        }
        $array['isOnlySecondCategory'] = false;
        if (sizeof($cur_cat['sub_cat']) == 0 && $current_category['parent_cat']['parent_id'] == 0) {
            $array['isOnlySecondCategory'] = true;
        }

        return $array;
    }

    public function filter_pages($arr, $c_page)
    {
        $count = 5;
        if (sizeof($arr) > $count) {
            $new_arr = array();
            $dd = 0;
            if ($c_page > ($count / 2))
                $dd = floor($c_page / 2);

            for ($i = $dd; $i < $count + $dd; $i++) {
                if (isset($arr[$i])) {
                    $new_arr[] = $arr[$i];
                }
            }

            // if ($arr[0]['current'] == 'active') {

            //     $new_arr[] = $arr[0];
            //     $new_arr[] = $arr[1];
            //     $new_arr[] = $arr[2];
            // } else if ($arr[sizeof($arr) - 1]['current'] == 'active') {
            //     $new_arr[] = $arr[sizeof($arr) - 3];
            //     $new_arr[] = $arr[sizeof($arr) - 2];
            //     $new_arr[] = $arr[sizeof($arr) - 1];
            // } else {
            //     for ($i = 0; $i < sizeof($arr); $i++) {
            //         if ($arr[$i]['current'] == 'active') {
            //             $new_arr[] = $arr[$i - 1];
            //             $new_arr[] = $arr[$i];
            //             $new_arr[] = $arr[$i + 1];
            //             break;
            //         }
            //     }
            // }
            return $new_arr;
        } else {
            return $arr;
        }
    }

    public function get_rating($id)
    {
        $array = array();
        $q_count = $this->db->query("SELECT COUNT(*) as count FROM `product_rating` WHERE `prod_id` = " . $id . " AND `status` = 1");
        $arr_count = $q_count->result_array();
        if ($arr_count[0]['count'] != 0) {
            $this->db->select('*');
            $this->db->from('product_rating');
            $this->db->where('prod_id', $id);
            $this->db->where('status', '1');
            $query = $this->db->get();
            $count = 0;
            $ones = 0;
            $twos = 0;
            $threes = 0;
            $fours = 0;
            $fives = 0;
            foreach ($query->result_array() as $pr) {
                $count += $pr['star_rating'];
                if ($pr['star_rating'] == 1) {
                    $ones += 1;
                } else if ($pr['star_rating'] == 2) {
                    $twos += 1;
                } else if ($pr['star_rating'] == 3) {
                    $threes += 1;
                } else if ($pr['star_rating'] == 4) {
                    $fours += 1;
                } else if ($pr['star_rating'] == 5) {
                    $fives += 1;
                }
            }
            $rating = round($count / $arr_count[0]['count']);
            $array['prod_rating_average'] = $rating;

            $array['prod_rating_each']['ones']['count'] = $ones;
            $array['prod_rating_each']['ones']['percentage'] = round(($ones / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['twos']['count'] = $twos;
            $array['prod_rating_each']['twos']['percentage'] = round(($twos / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['threes']['count'] = $threes;
            $array['prod_rating_each']['threes']['percentage'] = round(($threes / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['fours']['count'] = $fours;
            $array['prod_rating_each']['fours']['percentage'] = round(($fours / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['fives']['count'] = $fives;
            $array['prod_rating_each']['fives']['percentage'] = round(($fives / $arr_count[0]['count']) * 100);

            $array['review_count'] = $arr_count[0]['count'];
        }

        return $array;
    }

    public function get_prod_by_name_main($str)
    {
//        $array = array();
//        $this->db->select("*");
//        $this->db->from('product');
//        $this->db->like('product_name', $str);
//        // $this->db->where('total_count_in_store >', 0);
//        $this->db->where('product_status', 1);
//        $this->db->limit(5);
//        $query = $this->db->get();
//        $arr = $query->result_array();
//
//
//        return $arr;



        if ($str == '')
            return [];
        $array = array();
        $this->db->select('*');
        $this->db->from('product');
        $this->db->like('product_name', $str);
//        if ($min_price != '' && $max_price != '') {
//            $this->db->where('product.product_price >=', $min_price);
//            $this->db->where('product.product_price <= ', $max_price);
//        }
        // $this->db->where('total_count_in_store >', 0);
        $this->db->where('product_status', 1);
        $this->db->limit(20);
        $query = $this->db->get();
        $qe[0] = $query->result_array();

        if (empty($qe[0]))
        {
            $this->db->select('*');
            $this->db->from('product');
//            if ($min_price != '' && $max_price != '') {
//                $this->db->where('product.product_price >=', $min_price);
//                $this->db->where('product.product_price <= ', $max_price);
//            }
            $this->db->where('product_status', 1);
            $query = $this->db->get();
            $qe = $query->result_array();
            $prod = [];
            foreach ($qe as $q => $key)
            {
                $product_name = explode(" ", $key['product_name']);
                foreach ($product_name as $name) {
                    similar_text($str, $name, $percent);
                    if ($percent >= 80) {
                        $prod[] = $key;
                    }
                }
            }

            $qe[0] = $prod;
        }

        foreach ($qe[0] as $row) {
            $q = $this->db->query("SELECT active_substance_product.id as asp_id, active_substance.id, active_substance.tag_name FROM product 
                LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                WHERE product.id = " . $row['id']);

            $q3 = $this->db->query("SELECT category_product.id as cp_id, category.id,
                  category.category_name FROM product 
                LEFT JOIN category_product ON category_product.product_id = product.id
                LEFT JOIN category ON category_product.category_id = category.id 
                WHERE product.id = " . $row['id']);

            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            $row['active_substance'] = $q->result_array();
            $row['categories'] = $q3->result_array();

            $row['base_url'] = base_url();
            $rating = $this->get_rating($row['id']);

            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            if (!isset($user_id))
                $user_id = $this->session->userdata('user_id');

            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }


            $array []= $row;
        }
        if (sizeof($query->result_array()) != 0) {
            $newArray  = $array;
            if (sizeof($newArray) != 0) {
                array_multisort(array_column($newArray, 'product_price'), SORT_DESC, $newArray);
//                $array['srch_prod_max_pr'] = $newArray[0]['product_price'];

            }
        }

        return $array;
    }

    public function get_prods_by_slider_type($str,$user_id = 0)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('product');
        $this->db->where($str, 1);
        // $this->db->where('total_count_in_store >', 0);
        $this->db->where('product_status', 1);
        $this->db->limit(10);
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $rating = $this->get_rating($row['id']);
            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            $favorite = $this->get_favorite($row['id'],$user_id);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }
            $row['base_url'] = base_url();
            $array[] = $row;
        };
        return $array;
    }

    public function update_prod_of_the_day($prod_id, $stat)
    {
        $this->db->update('product', array('product_of_the_day' => $stat), array('id' => $prod_id));
    }

    public function update_prod_in_category($prod_id, $stat)
    {
        $this->db->update('product', array('product_in_category' => $stat), array('id' => $prod_id));
    }

    public function update_prod_suggestions($prod_id, $stat)
    {
        $this->db->update('product', array('product_suggestions' => $stat), array('id' => $prod_id));
    }

    public function get_similar_products($prod_id, $user_id = '')
    {
        $q = $this->db->query("SELECT active_substance.id FROM product 
                          LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                          LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                          WHERE product.id = " . $prod_id);
        $array_of_as_ids = null;

        foreach ($q->result_array() as $res) {
            $array_of_as_ids[] = $res['id'];
        }

        $array = array();
        $this->db->select("product.*");
        $this->db->from('product');
        $this->db->join('active_substance_product', 'active_substance_product.product_id = product.id', 'left');
        $this->db->where_in('active_substance_product.active_substance_id', $array_of_as_ids);
        $this->db->where('product.id !=', $prod_id);
        // $this->db->where('product.total_count_in_store >', 0);
        $this->db->where('product_status', 1);
        $this->db->limit(10);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $rating = $this->get_rating($row['id']);
            if (sizeof($rating) != 0) {
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['review_count'] = 0;
            }
            if (!isset($user_id))
                $user_id = $this->session->userdata('user_id');

            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }
            $row['base_url'] = base_url();
            $array[] = $row;
        }

        return $array;
    }

    public function get_product_images($prod_id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('product_images');
        $this->db->where('product_id', $prod_id);
        $q = $this->db->get();
        foreach ($q->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get_prods_in_categ($cat_id, $user_id)
    {
        $array = array();
        $this->load->model('category');
        $category = $this->category->get_with_children($cat_id);
        $cat_ids = null;
        foreach ($category['sub_cat'] as $sub_cat) {
            if (isset($sub_cat['sub_cat'])) {
                foreach ($sub_cat['sub_cat'] as $sub_sub_cat) {
                    $cat_ids[] = $sub_sub_cat['id'];
                }
            }
        }
        if ($cat_ids == null) {
            return [];
        }

        $this->db->distinct();
        $this->db->select('product.*');
        $this->db->from('product');
        $this->db->join('category_product', 'category_product.product_id = product.id');
        $this->db->where_in('category_product.category_id', $cat_ids);
        $this->db->where('product.product_in_category', 1);
        // $this->db->where('product.total_count_in_store >', 0);
        $this->db->where('product.product_status', 1);
        $this->db->limit(6);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $rating = $this->get_rating($row['id']);
            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            $favorite = $this->get_favorite($row['id'],$user_id);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }
            $array[] = $row;
        }
        return $array;
    }

    public function get_favorite($id, $user_id)
    {
        $array = array();
        $q_count = $this->db->query("SELECT COUNT(*) as count FROM `favorites` WHERE `favoriteable_id` = " . $id . " AND `user_id` = ".$user_id);
        $arr_count = $q_count->result_array();
        if ($arr_count[0]['count'] != 0) {
            $this->db->select('*');
            $this->db->from('favorites');
            $this->db->where('favoriteable_id', $id);
            $this->db->where('user_id', '61');
            $query = $this->db->get();
            $array['is_favorite'] = $query->result_array();

        }
        return $array;
    }

    /**
     * Search for product
     * @param $str
     * @param $min_price
     * @param $max_price
     * @return array
     */
    public function search_for_prod($str, $min_price = '' , $max_price ='', $user_id = '')
    {
        if ($str == '')
            return [];
        $array = array();
        $this->db->select('*');
        $this->db->from('product');
        $this->db->like('product_name', $str);
        if ($min_price != '' && $max_price != '') {
            $this->db->where('product.product_price >=', $min_price);
            $this->db->where('product.product_price <= ', $max_price);
        }
        // $this->db->where('total_count_in_store >', 0);
        $this->db->where('product_status', 1);
        $this->db->limit(20);
        $query = $this->db->get();
        $qe[0] = $query->result_array();

        if (empty($qe[0]))
        {
            $this->db->select('*');
            $this->db->from('product');
            if ($min_price != '' && $max_price != '') {
                $this->db->where('product.product_price >=', $min_price);
                $this->db->where('product.product_price <= ', $max_price);
            }
            $this->db->where('product_status', 1);
            $query = $this->db->get();
            $qe = $query->result_array();
            $prod = [];
            foreach ($qe as $q => $key)
            {
                $product_name = explode(" ", $key['product_name']);
                foreach ($product_name as $name) {
                    similar_text($str, $name, $percent);
                    if ($percent >= 80) {
                        $prod[] = $key;
                    }
                }
            }

            $qe[0] = $prod;
        }

        foreach ($qe[0] as $row) {
            $q = $this->db->query("SELECT active_substance_product.id as asp_id, active_substance.id, active_substance.tag_name FROM product 
                LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                WHERE product.id = " . $row['id']);

            $q3 = $this->db->query("SELECT category_product.id as cp_id, category.id,
                  category.category_name FROM product 
                LEFT JOIN category_product ON category_product.product_id = product.id
                LEFT JOIN category ON category_product.category_id = category.id 
                WHERE product.id = " . $row['id']);

            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            $row['active_substance'] = $q->result_array();
            $row['categories'] = $q3->result_array();

            $row['base_url'] = base_url();
            $rating = $this->get_rating($row['id']);

            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            if (!isset($user_id))
                $user_id = $this->session->userdata('user_id');

            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }

            $row['text'] = $row['product_name'];


            $array []= $row;
        }
        if (sizeof($query->result_array()) != 0) {
            $newArray  = $array;
            if (sizeof($newArray) != 0) {
                array_multisort(array_column($newArray, 'product_price'), SORT_DESC, $newArray);
                $array['srch_prod_max_pr'] = $newArray[0]['product_price'];

            }
        }

        return $array;
    }

    public function add_from_import($array)
    {
        if (!isset($array)) {
            // $array['product_pic'] = 
        }
        $this->db->insert('product', $array);
        $id = $this->db->insert_id();

        return $id;
    }
    public function import_from_json($array)
    {
        if (!isset($array)) {
            // $array['product_pic'] = 
        }
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_articule', $array['product_articule']);
        $query_res = $this->db->get();
        if (sizeof($query_res->result_array()) > 0) {
            foreach($query_res->result_array() as $row) {
                $this->db->update('product', array(
                    'product_name' => $array['product_name'],
                    'product_price' => $array['product_price'],
                    'total_count_in_store' => $array['total_count_in_store'],
                ), array('product_articule' => $array['product_articule']));
            }
        } else {
            $array['product_status'] = 0;
            $this->db->insert('product', $array);
        }
        $id = $this->db->insert_id();

        return $id;
    }

    public function check_by_artk($artk)
    {
        $bb = 0;
        $this->db->select("count(*) as ss");
        $this->db->from("product");
        $this->db->where("product_articule", $artk);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $bb = $row['ss'];
        }

        if ($bb > 0)
            return true;
        else
            return false;
    }

    /**
     * Search for product
     * @param $str
     * @param $min_price
     * @param $max_price
     * @return array
     */
    public function search_for_product($str, $min_price = '' , $max_price ='', $user_id = '')
    {
        if ($str == '')
            return [];
        $array = array();
        $this->db->select('*');
        $this->db->from('product');
        $this->db->like('product_name', $str);
        if ($min_price != '' && $max_price != '') {
            $this->db->where('product.product_price >=', $min_price);
            $this->db->where('product.product_price <= ', $max_price);
        }
        // $this->db->where('total_count_in_store >', 0);
        $this->db->where('product_status', 1);
        $this->db->limit(20);
        $query = $this->db->get();
        $qe[0] = $query->result_array();

        if (empty($qe[0]))
        {
            $this->db->select('*');
            $this->db->from('product');
            if ($min_price != '' && $max_price != '') {
                $this->db->where('product.product_price >=', $min_price);
                $this->db->where('product.product_price <= ', $max_price);
            }
            $this->db->where('product_status', 1);
            $query = $this->db->get();
            $qe = $query->result_array();
            $prod = [];
            foreach ($qe as $q => $key)
            {
                $product_name = explode(" ", $key['product_name']);
                foreach ($product_name as $name) {
                    similar_text($str, $name, $percent);
                    if ($percent >= 80) {
                        $prod[] = $key;
                    }
                }
            }

            $qe[0] = $prod;
        }

        foreach ($qe[0] as $row) {
            $q = $this->db->query("SELECT active_substance_product.id as asp_id, active_substance.id, active_substance.tag_name FROM product 
                LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id 
                WHERE product.id = " . $row['id']);

            $q3 = $this->db->query("SELECT category_product.id as cp_id, category.id,
                  category.category_name FROM product 
                LEFT JOIN category_product ON category_product.product_id = product.id
                LEFT JOIN category ON category_product.category_id = category.id 
                WHERE product.id = " . $row['id']);

            $row['product_brand'] = $this->get_other_fields($row['product_brand'], 'brand');
            $row['active_substance'] = $q->result_array();
            $row['categories'] = $q3->result_array();

            $row['base_url'] = base_url();
            $rating = $this->get_rating($row['id']);

            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            if (!isset($user_id))
                $user_id = $this->session->userdata('user_id');

            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            if (sizeof($favorite) != 0) {
                $row['is_favorite'] = true;
            } else {
                $row['is_favorite'] = false;
            }

            $row['text'] = $row['product_name'];


            $array []= $row;
        }
        if (sizeof($query->result_array()) != 0) {
            $newArray  = $array;
            if (sizeof($newArray) != 0) {
                array_multisort(array_column($newArray, 'product_price'), SORT_DESC, $newArray);
//                $array['srch_prod_max_pr'] = $newArray[0]['product_price'];

            }
        }

        return $array;
    }
}
