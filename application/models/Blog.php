<?php

class Blog extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    private $per_page_admin = 20;
    public function get_all($page = 1, $tag_id = 0, $search_inp = '')
    {
        $array = array();
        $this->db->select("COUNT(*) as total_blog_items");
        $this->db->from('blog');
        if ($tag_id != 0) {
            $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
            $this->db->join('tag', 'tag.id = blog_tag.tag_id');
            $this->db->where('tag.id', $tag_id);
        }
        if ($search_inp != '') {
            $this->db->where('blog.blog_title', $search_inp);
        }
        $this->db->order_by("blog.order_id", "asc");
        $qq = $this->db->get();
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            if ($row['total_blog_items'] > 0)
                $total_pages = ceil($row['total_blog_items'] / $this->per_page_admin);
        }

        $linkk = base_url("index.php/admin/blogs?");
        if ($tag_id != 0) {
            $linkk = $linkk . "tag_id=" . $tag_id . '&';
        }
        if ($search_inp != '') {
            $linkk = $linkk . "search_inp=" . $search_inp . '&';
        }
        $linkk = $linkk . 'page=';
        // $array['link'] = $linkk;
        $pages = array();
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $page);
        $array['pages'] = $rr;

        if ($page > 1 & $page <= $total_pages) {
            $array['prev_page'] = $page - 1;
        }
        if ($page < $total_pages) {
            $array['next_page'] = $page + 1;
        }
        if ($page <= $total_pages) {
            $this->db->select("*");
            $this->db->from('blog');
            $this->db->order_by("blog.order_id", "asc");
            if ($tag_id != 0) {
                $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
                $this->db->join('tag', 'tag.id = blog_tag.tag_id');
                $this->db->where('tag.id', $tag_id);
            }
            if ($search_inp != '') {
                $this->db->where('blog.blog_title', $search_inp);
            }
            $this->db->limit($this->per_page_admin, ($page - 1) * $this->per_page_admin);
            $query = $this->db->get();
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                $row['blog_pic'] = $this->get_blog_avatar($row['id']);
                $array[] = $row;
            }
        } else {
        }
        return $array;
    }

    public function get_all_by_sort($sort)
    {
        $this->db->select("*");
        $this->db->from('blog');
        $this->db->where_in('id', $sort);
        $order = sprintf('FIELD(id, %s)', implode(', ', $sort));
        $this->db->order_by($order);
        $query = $this->db->get();
        $blod = $query->result_array();

        return $blod;
    }


    public function get_all_mb($page = 1, $tag_id = 0, $search_inp = '')
    {
        $array = array();
        $this->db->select("COUNT(*) as total_blog_items");
        $this->db->from('blog');
        if ($tag_id != 0) {
            $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
            $this->db->join('tag', 'tag.id = blog_tag.tag_id');
            $this->db->where('tag.id', $tag_id);
        }
        if ($search_inp != '') {
            $this->db->where('blog.blog_title', $search_inp);
        }
        $qq = $this->db->get();
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            if ($row['total_blog_items'] > 0)
                $total_pages = ceil($row['total_blog_items'] / $this->per_page_admin);
        }

        $linkk = base_url("index.php/admin/blogs?");
        if ($tag_id != 0) {
            $linkk = $linkk . "tag_id=" . $tag_id . '&';
        }
        if ($search_inp != '') {
            $linkk = $linkk . "search_inp=" . $search_inp . '&';
        }
        $linkk = $linkk . 'page=';
        // $array['link'] = $linkk;
        $pages = array();
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $page);
        $blog_page = $rr[0]['page'];
        $blog_total_pages = $rr[0]['total_pages'];
        $blog_current = $rr[0]['current'];


        if ($page > 1 & $page <= $total_pages) {
            $array['prev_page'] = $page - 1;
        }
        if ($page < $total_pages) {
            $array['next_page'] = $page + 1;
        }
        if ($page <= $total_pages) {
            $this->db->select("*");
            $this->db->from('blog');
            if ($tag_id != 0) {
                $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
                $this->db->join('tag', 'tag.id = blog_tag.tag_id');
                $this->db->where('tag.id', $tag_id);
            }
            if ($search_inp != '') {
                $this->db->where('blog.blog_title', $search_inp);
            }
            $this->db->limit($this->per_page_admin, ($page - 1) * $this->per_page_admin);
            $query = $this->db->get();
            $array = [];
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                $row['blog_pic'] = $this->get_blog_avatar($row['id']);
                $array[] = $row;
            }
        }
        $data = [
            'blogs' => $array,
            'page' => $blog_page,
            'total_pages' => $blog_total_pages,
            'current' => $blog_current
        ];
        return $data;
    }


    private $per_page_main = 6;
    public function get_all_main($page = 1, $tag_id = 0)
    {
        $array = array();
        $this->db->select("COUNT(*) as total_blog_items");
        $this->db->from('blog');
        $this->db->order_by("blog.order_id", "asc");
        if ($tag_id != 0) {
            $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
            $this->db->join('tag', 'tag.id = blog_tag.tag_id');
            $this->db->where('tag.id', $tag_id);
        }
        $qq = $this->db->get();
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            if ($row['total_blog_items'] > 0)
                $total_pages = ceil($row['total_blog_items'] / $this->per_page_main);
        }

        $linkk = base_url("index.php/admin/blogs?");
        if ($tag_id != 0) {
            $linkk = $linkk . "tag_id=" . $tag_id . '&';
        }
        $linkk = $linkk . 'page=';
        // $array['link'] = $linkk;
        $pages = array();
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $page);
        $array['pages_info']['pages'] = $rr;

        if ($page > 1 & $page <= $total_pages) {
            $array['pages_info']['prev_page'] = $page - 1;
        }
        if ($page < $total_pages) {
            $array['pages_info']['next_page'] = $page + 1;
        }
        if ($page <= $total_pages) {
            $querrry = "blog.*";
            if ($tag_id != 0) {
                $querrry .= ", blog_tag.blog_id, blog_tag.tag_id, tag.tag_name";
            }
            $this->db->select($querrry);
            $this->db->from('blog');
            if ($tag_id != 0) {
                $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
                $this->db->join('tag', 'tag.id = blog_tag.tag_id');
                $this->db->where('tag.id', $tag_id);
            }
            $this->db->limit($this->per_page_main, ($page - 1) * $this->per_page_main);
            $query = $this->db->get();


            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                setlocale(LC_ALL, 'ru_RU.UTF-8');
                $row['blog_date'] = strftime("%B %d, %Y", strtotime($row['blog_created_at']));
                $row['blog_pic'] = $this->get_blog_avatar($row['id']);
                $row['blog_tags'] = $this->get_blog_tags($row['id']);
                $array[] = $row;
            }
        } else {
        }
        return $array;
    }

    public function get_blog_tags($id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('blog_tag');
        $this->db->where('blog_id', $id);
        $this->db->join('tag', 'blog_tag.tag_id = tag.id');
        $qq = $this->db->get();
        foreach ($qq->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function get_blog_procucts($id,$user_id = '')
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('blog_product');
        $this->db->where('blog_id', $id);
        $this->db->join('product', 'blog_product.product_id = product.id');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function blog_procucts($id,$user_id = '')
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('blog_product');
        $this->db->where('blog_id', $id);
        $this->db->join('product', 'blog_product.product_id = product.id');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
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
            $favorite = $this->product->get_favorite($row['id'], $user_id);
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


    public function get_blog_avatars($id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('blog_images');
        $this->db->where('blog_id', $id);
        $this->db->where('blog_avatar', 1);
        $qq = $this->db->get();
        foreach ($qq->result_array() as $row) {
            $array[] = $row['blog_pic'];
        }
        return $array;
    }

    public function get_blog_avatar($id)
    {
        $pic = '';
        $this->db->select('*');
        $this->db->from('blog_images');
        $this->db->where('blog_id', $id);
        $this->db->where('blog_avatar', 1);
        $qq = $this->db->get();
        foreach ($qq->result_array() as $row) {
            $pic = $row['blog_pic'];
        }
        return $pic;
    }

    public function get_blog_images($blog_id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('blog_images');
        $this->db->where('blog_id', $blog_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
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

    public function get($id)
    {
        $this->db->select("*");
        $this->db->from('blog');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $row['blog_pics'] = $this->get_blog_images($row['id']);
            setlocale(LC_ALL, 'ru_RU.UTF-8');
            $row['blog_date'] = strftime("%B %d/ %Y", strtotime($row['blog_created_at']));
            $array = $row;
        }
        return $array;
    }

    public function add($array)
    {
        $tags = $array['tags'];
        $products = $array['products'];
//        $products = $array['products'];
        unset($array['tags']);
        unset($array['products']);
        $this->db->insert('blog', $array);
        $blog_id = $this->db->insert_id();
        if (sizeof($tags) != 0) {
            foreach ($tags as $tag_id) {
                $arr = array('tag_id' => $tag_id, 'blog_id' => $blog_id);
                $this->db->insert('blog_tag', $arr);
            }
        }
        if (sizeof($products) != 0) {
            foreach ($products as $product_id) {
                $arr = array('product_id' => $product_id, 'blog_id' => $blog_id);
                $this->db->insert('blog_product', $arr);
            }
        }

        return $this->db->insert_id();
    }

    public function insert_images($blog_id, $array)
    {
        foreach ($array['blog_images'] as $row) {
            $array = array('blog_pic' => $row['uid'] . "" . $row['name'], 'blog_id' => $blog_id);
            $this->db->insert('blog_images', $array);
        }
    }

    public function update($id, $array)
    {
        $this->db->delete('blog_tag', array('blog_id' => $id));
        $tags = $array['tags'];
        $products = $array['products'];
        unset($array['tags']);
        unset($array['products']);
        if (sizeof($tags) != 0) {
            foreach ($tags as $tag_id) {
                $arr = array('tag_id' => $tag_id, 'blog_id' => $id);
                $this->db->insert('blog_tag', $arr);
            }
        }
        if (sizeof($products) != 0) {
            foreach ($products as $product_id) {
                $arr = array('product_id' => $product_id, 'blog_id' => $id);
                $this->db->insert('blog_product', $arr);
            }
        }
        $this->db->update('blog', $array, array('id' => $id));
    }

    public function update_blog_avatar($id, $stat_id)
    {
        $this->db->where('id', $id);
        $this->db->update('blog_images', array('blog_avatar' => $stat_id));
    }

    public function remove($id)
    {
        $this->db->delete("blog", array('id' => $id));
    }

    public function remove_image($id)
    {
        $this->db->select("*");
        $this->db->from('blog_images');
        $this->db->where('id', $id);
        $query = $this->db->get();
        foreach ($query->result_array() as $pic) {
            @unlink("././upload_blog/" . $pic['product_pic']);
        }

        $this->db->delete("blog_images", array('id' => $id));
    }

    public function get_with_tag($page = 1, $tag_id = 0)
    {

        $tag_id = json_decode($tag_id);
        $array = array();
        $this->db->select("COUNT(*) as total_blog_items");
        $this->db->from('blog_tag');
        $this->db->where_in('blog_tag.tag_id', $tag_id);
        if ($tag_id) {
            $this->db->join('blog', 'blog.id = blog_tag.blog_id');
            $this->db->join('tag', 'tag.id = blog_tag.tag_id');
        }
        $qq = $this->db->get();
        $tags = $qq->result_array();
//        var_dump($tags);
        $total_pages = 0;

        foreach ($qq->result_array() as $row) {
            if ($row['total_blog_items'] > 0)
                $total_pages = ceil($row['total_blog_items'] / $this->per_page_main);
        }

        $linkk = base_url("index.php/admin/blogs?");
//        if ($tag_id != 0) {
//            $linkk = $linkk . "tag_id=" . $tag_id . '&';
//        }
        $linkk = $linkk . 'page=';
        // $array['link'] = $linkk;
        $pages = array();
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages, $page);
        $array['pages_info']['pages'] = $rr;

        if ($page > 1 & $page <= $total_pages) {
            $array['pages_info']['prev_page'] = $page - 1;
        }
        if ($page < $total_pages) {
            $array['pages_info']['next_page'] = $page + 1;
        }
        if ($page <= $total_pages) {
            $querrry = "blog.*";
            if ($tag_id != 0) {
                $querrry .= ", blog_tag.blog_id, blog_tag.tag_id, tag.tag_name";
            }
            $this->db->select($querrry);
            $this->db->from('blog');
            if ($tag_id != 0) {
                $this->db->join('blog_tag', 'blog_tag.blog_id = blog.id');
                $this->db->join('tag', 'tag.id = blog_tag.tag_id');
                $this->db->where_in('tag.id', $tag_id);
            }
            $this->db->limit($this->per_page_main, ($page - 1) * $this->per_page_main);
            $query = $this->db->get();

            $array=[];
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                setlocale(LC_ALL, 'ru_RU.UTF-8');
                $row['blog_date'] = strftime("%B %d, %Y", strtotime($row['blog_created_at']));
                $row['blog_pic'] = $this->get_blog_avatar($row['id']);
                $row['blog_tags'] = $this->get_blog_tags($row['id']);
                $array []= $row;
            }
        } else {
        }
        return $array;
    }
}
