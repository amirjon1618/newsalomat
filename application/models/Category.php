<?php

class Category extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function add($array)
    {
        $this->db->insert('category', $array);
    }

    public function get($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->where('id', $id);
        $this->db->from('category');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function get_with_children($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->where('id', $id);
        $this->db->from('category');
        $query = $this->db->get();
        $category = $query->result_array();
        $category[0]['base_url'] = base_url();
        $category[0]['sub_cat'] = $this->_sub_categories($category[0]['id']);
        return $category[0];
    }

    public function get_category_by_name($str)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id', '0');
        $this->db->like('category_name', $str);
        $this->db->limit(1);
        $query = $this->db->get();
        $category = $query->result_array();

        $category[0]['base_url'] = base_url();

        $category[0]['sub_cat'] = $this->_sub_categories($category[0]['id']);

        $this->load->model('product');

        return $category[0];
    }


    public function get_all()
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id', '0');
        $this->db->order_by("order_id", "asc");
        $query = $this->db->get();
        $categories = $query->result_array();
        $i = 0;
        foreach ($categories as $cat) {
            $categories[$i]['base_url'] = base_url();
            $categories[$i]['total_cat_in_main'] = sizeof($this->get_categories_from_main());
            $categories[$i]['sub_cat'] = $this->_sub_categories($cat['id']);
            $i++;
        }
        return $categories;
    }

    public function get_by_sort_all($array)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id', '0');
        $this->db->where_in('id', $array);
        $order = sprintf('FIELD(id, %s)', implode(', ', $array));

        $this->db->order_by($order);
        $query = $this->db->get();
        $categories = $query->result_array();
        $i = 0;
        foreach ($categories as $cat) {
            $categories[$i]['base_url'] = base_url();
            $categories[$i]['total_cat_in_main'] = sizeof($this->get_categories_from_main());
            $categories[$i]['sub_cat'] = $this->_sub_categories($cat['id']);
            $i++;
        }
        return $categories;
    }

    public function get_min_sub_category($str)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id !=', '0');
        $this->db->like('category_name', $str);
        $res = $this->db->get();
        $query = $res->result_array();

        if (sizeof($query) != 0) {
            $array = array();

            foreach ($query as $row) {
                $parents = $this->get_parent_categories($row['id']);
                $row['text'] = $parents['parent_cat']['category_name'] . ' / ' . $row['category_name'];
                unset($row['category_name']);
                unset($row['sub_cat']);
                unset($row['parent_id']);
                $array[] = $row;
            }
            return $array;
        } else {
            return [];
        }
    }

    public function get_sub_category($str)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id !=', '0');
        $this->db->like('category_name', $str);
        $res = $this->db->get();
        $query = $res->result_array();

        if (sizeof($query) != 0) {
            $array = array();

            foreach ($query as $row) {
                $parents = $this->get_parent_categories($row['id']);
                if ($parents['parent_cat']['parent_id'] == 0) {
                    $row['text'] = $row['category_name'];
                    unset($row['category_name']);
                    unset($row['sub_cat']);
                    unset($row['parent_id']);
                    $array[] = $row;
                }
            }
            return $array;
        } else {
            return [];
        }
    }

    public function _sub_categories($id)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $categories = $query->result_array();

        $i = 0;
        if (sizeof($categories) != 0) {
            foreach ($categories as $cat) {
                $categories[$i]['sub_cat'] = $this->_sub_categories($cat['id']);
                $i++;
            }
        }
        return $categories;
    }
    // private $p_id = null;
    public function _parent_categories($parent_id)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('id', $parent_id);
        $query = $this->db->get();
        $category = $query->result_array();

        if ($category[0]['parent_id'] != 0) {
            $category[0]['parent_cat'] = $this->_parent_categories($category[0]['parent_id']);
        }
        // $category[0]['parent_cat'] = [];
        // print_r($category);
        // die();
        return $category[0];
    }


    public function get_parent_categories($id)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $category = $query->result_array();

        if (sizeof($category) == 0)
            return [];

        $category[0]['base_url'] = base_url();

        if ($category[0]['parent_id'] != 0) {
            $category[0]['parent_cat'] = $this->_parent_categories($category[0]['parent_id']);
            return $category[0];
        }

        $category[0]['parent_cat'] = [];
        return $category[0];
    }

    public function get_sub_categories($id)
    {
        $this->db->select("*");
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $array = array();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function update($id, $array)
    {
        $this->db->update('category', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $category = $this->get($id);
        if (sizeof($category) == 0)
            return;
        $category['sub_cat'] = $this->_sub_categories($id);
        $category['parent_cat'] = $this->get_parent_categories($id);
        if (sizeof($category['sub_cat']) == 0 && sizeof($category['parent_cat']['parent_cat']) != 0) {
            $this->db->delete('category_product', array('category_id' => $id));
            $this->db->delete('category', array('id' => $id));
        } else if ($category['parent_id'] == 0) {
            if (sizeof($category['sub_cat']) != 0) {
                foreach ($category['sub_cat'] as $sub_cat) {
                    if (sizeof($sub_cat['sub_cat']) != 0) {
                        foreach ($sub_cat['sub_cat'] as $sub_sub_cat) {
                            $this->db->delete('category_product', array('category_id' => $sub_sub_cat['id']));
                            $this->db->delete('category', array('id' => $sub_sub_cat['id']));
                        }
                    }
                    $this->db->delete('category', array('id' => $sub_cat['id']));
                }
            }
            $this->db->delete('category', array('id' => $id));
        } else if ($category['parent_cat']['parent_cat']['parent_id'] == 0) {

            if (sizeof($category['sub_cat']) != 0) {
                foreach ($category['sub_cat'] as $sub_cat) {
                    $this->db->delete('category_product', array('category_id' => $sub_cat['id']));
                    $this->db->delete('category', array('id' => $sub_cat['id']));
                }
            }
            $this->db->delete('category', array('id' => $id));
        }
    }
    public function addToMain($id, $stat)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id', $id);
        $q = $this->db->get();

        if (sizeof($q->result_array()) >= 3) {
            return 0;
        }
        $this->db->where('id', $id);
        $this->db->update('category', array('category_in_main' => $stat));

        return 1;
    }

    public function get_categories_from_main()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_in_main', 1);
        $q = $this->db->get();
        return $q->result_array();
    }
}
