<?php

class PromoCode extends CI_Model
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
        $this->db->from('promo_code');
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
        $this->db->from('promo_code');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function get_promo_code($string)
    {
        $this->db->select("*");
        $this->db->from('promo_code');
        $this->db->like('code', $string);
        $query = $this->db->get();
        $array = array();
        foreach($query->result_array() as $row)
        {
            $row['text'] = $row['code'];
            unset($row['code']);
            $array[] = $row;
        }
        return $array;
    }
    
    public function add($array)
    {
        $this->db->insert('promo_code', $array);
        return $this->db->insert_id();
    }

    public function update($id, $array)
    {
        $this->db->update('promo_code', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("promo_code", array('id' => $id));
    }
}
