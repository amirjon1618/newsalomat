<?php

class General extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function get_article($id){
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_articles(){
        $array = null;
        $this->db->select('id, title, description, image');
        $this->db->from('service');
        $this->db->limit(3, 0);
        $query = $this->db->get();
        foreach ($query->result_array() as $row){
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get_delivery_adress($id){
        $result = null;
        $this->db->select('delivery_type_address');
        $this->db->from('delivery_type');
        $this->db->where('id', $id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row){
            $result = $row['delivery_type_address'];
        }
        return $result;
    }
}