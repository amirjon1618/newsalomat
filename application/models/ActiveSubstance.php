<?php

class ActiveSubstance extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select("*");
        $this->db->from('active_substance');
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
        $this->db->from('active_substance');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function get_active_substance($string)
    {
        $this->db->select("*");
        $this->db->from('active_substance');
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

    public function get_count_of_products_in_active_substance_sorted_by_category($cat_id)
    {
        $this->db->select("*");
        $this->db->from('active_substance');
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $as) {
            $qq = $this->db->query("SELECT product.* FROM product 
                                    LEFT JOIN active_substance_product ON active_substance_product.product_id = product.id
                                    LEFT JOIN active_substance ON active_substance_product.active_substance_id = active_substance.id
                                    LEFT JOIN category_product ON category_product.product_id = product.id
                                    WHERE active_substance.id = " . $as['id'] . " AND category_product.category_id = " . $cat_id);
            $as['products'] = $qq->result_array();
            $array[] = $as;
        }
        return $array;
    }


    public function add($array)
    {
        $this->db->insert('active_substance', $array);
        return $this->db->insert_id();
    }

    public function update($id, $array)
    {
        $this->db->update('active_substance', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("active_substance", array('id' => $id));
        $this->db->delete("active_substance_product", array('id', $id));
    }
}
