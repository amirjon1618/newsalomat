<?php

class Indication extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        // Your own constructor code
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select("*");
        $this->db->from('indications');
        $query = $this->db->get();
        $array = array();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get($id)
    {
        $this->db->select("*");
        $this->db->from('indications');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function get_indication($string)
    {
        $this->db->select("*");
        $this->db->from('indications');
        $this->db->like('tag_name', $string);
        $query = $this->db->get();
        $array = array();
        foreach ($query->result_array() as $row) {
            $row['text'] = $row['tag_name'];
            unset($row['tag_name']);
            $array[] = $row;
        }
        return $array;
    }
    private $per_page = 12;
    public function get_products($ind_id, $current = 1, $min_price = '', $max_price = '')
    {
        $array = array();
        $this->db->select('COUNT(DISTINCT(product.id)) as total_products');
        $this->db->from('product');
        $this->db->join('indications_product', 'indications_product.product_id = product.id', 'left');
        $this->db->where('indications_product.indications_id', $ind_id);
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
                    "link" => base_url("index.php/main/get_sales_prods?sales_id=" . $ind_id . "&page="),
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => base_url("index.php/main/get_sales_prods?sales_id=" . $ind_id . "&page="),
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $current);
        $array['pages'] = $rr;
        $array['total_prods'] = [];
        if ($current > 1 & $current <= $total_pages) {
            $array['prev_page'] = $current - 1;
        }
        if ($current < $total_pages) {
            $array['next_page'] = $current + 1;
        }

        if ($current <= $total_pages) {
            // $this->db->query(`
            //     SELECT product.*, category.id as category_id
            //     FROM product
            //     JOIN indications_product ON indications_product.product_id = product.id
            //     JOIN category_product ON category_product.product_id = product.id
            //     JOIN category ON category_product.category_id = category.id
            //     WHERE indications_product.indications_id = '8'
            //     GROUP BY product.id, category.id
            //      LIMIT 12
            // `);
            // SELECT `product`.*, `category`.`id` as `category_id`
            // FROM `product`
            // JOIN `indications_product` ON `indications_product`.`product_id` = `product`.`id`
            // JOIN `category_product` ON `category_product`.`product_id` = `product`.`id`
            // JOIN `category` ON `category_product`.`category_id` = `category`.`id`
            // WHERE `indications_product`.`indications_id` = '7'
            // GROUP BY `product`.`id`, `category`.`id`
            // LIMIT 24, 12
            $query_string = '
            SELECT *
                FROM (
                    select p.*, c.id as category_id,
                                            @r := CASE 
                                                    WHEN p.id = @pcol1 THEN @r + 1 
                                                    WHEN (@pcol1 := p.id) = null THEN null
                                                    ELSE 1 
                                                  END AS rn
                                      from indications_product ip
                                        INNER JOIN product p ON ip.product_id=p.id
                                        INNER JOIN category_product cp ON p.id=cp.product_id
                                        INNER JOIN category c ON cp.category_id=c.id
                                        ,(SELECT @r := 0, @pcol1 := null) x
                                      WHERE ip.indications_id='. $ind_id .'
                                      ORDER BY p.id, c.id
                                      ) t
                                      WHERE t.rn=1
                                      LIMIT ' . $this->per_page . '' . ($current==1 ? '' : ', ') . ((($current - 1) * $this->per_page)==0 ? '' : (($current - 1) * $this->per_page));

            if ($min_price != '' && $max_price != '') {
                $query_string = '
                SELECT *
                    FROM (
                        select p.*, c.id as category_id,
                              @r := CASE 
                                      WHEN p.id = @pcol1 THEN @r + 1 
                                      WHEN (@pcol1 := p.id) = null THEN null
                                      ELSE 1 
                                    END AS rn
                        from indications_product ip
                          INNER JOIN product p ON ip.product_id=p.id
                          INNER JOIN category_product cp ON p.id=cp.product_id
                          INNER JOIN category c ON cp.category_id=c.id
                          ,(SELECT @r := 0, @pcol1 := null) x
                        WHERE p.product_price >' . $min_price . ' AND p.product_price <' . $max_price .' AND ip.indications_id='. $ind_id .' ORDER BY p.id, c.id
                        ) t
                        WHERE t.rn=1
                        LIMIT ' . $this->per_page . '' . ($current==1 ? '' : ', ') . ((($current - 1) * $this->per_page)==0 ? '' : (($current - 1) * $this->per_page));
            }
            $query = $this->db->query($query_string);
            // print_r($this->db->last_query());
            // $this->db->select('product.*, category.id as category_id');
            // $this->db->from('product');
            // $this->db->join('indications_product', 'indications_product.product_id = product.id');
            // $this->db->join('category_product', 'category_product.product_id = product.id');
            // $this->db->join('category', 'category_product.category_id = category.id');
            // $this->db->where('indications_product.indications_id', $ind_id);
            // if ($min_price != '' && $max_price != '') {
            //     $this->db->where('product.product_price >=', $min_price);
            //     $this->db->where('product.product_price <= ', $max_price);
            // }
            // $this->db->group_by(array('product.id', 'category.id'));
            // $this->db->limit($this->per_page, ($current - 1) * $this->per_page);
            // $query = $this->db->get();
            // print_r($this->db->last_query());           

            $array['prod_max_price'] = null;
            if (sizeof($query->result_array()) > 0) {
                $query_string = $this->db->last_query();
                $result = explode('LIMIT', $query_string);
                if (sizeof($result) > 1 && $total_pages > 0) {
                    $new_query = $result[0] . ' ORDER BY `product_price` DESC';
                    $qq3 = $this->db->query($new_query);
                    $array['prod_max_price'] = $qq3->result_array()[0]['product_price'];
                }
            }
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
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
                $array['total_prods'][] = $row;
            }
        }
        // print_r($array);
        // die();
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
    public function get_count_of_products_in_indications_sorted_by_category($cat_id)
    {

        $this->db->select("*");
        $this->db->from('active_substance');
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $ind) {
            $q2 = $this->db->query("SELECT product.* FROM product 
                                    LEFT JOIN indications_product ON indications_product.product_id = product.id
                                    LEFT JOIN indications ON indications_product.indications_id = indications.id 
                                    LEFT JOIN category_product ON category_product.product_id = product.id
                                    WHERE indications.id = " . $ind['id'] . " AND category_product.category_id = " . $cat_id);
            $ind['products'] = $q2->result_array();
            $array[] = $ind;
        }
        return $array;
    }

    public function add($array)
    {
        $array['url'] = base_url('main/sales/');
        $this->db->insert('indications', $array);
        return $this->db->insert_id();
    }

    public function update($id, $array)
    {
        $this->db->update('indications', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("indications", array('id' => $id));
        $this->db->delete("indications_product", array('id', $id));
    }
    public function filter_pages($arr, $c_page)
    {
        $count = 6;
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
            return $new_arr;
        } else {
            return $arr;
        }
    }
}
