<?php

class Form extends CI_Model
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
        $this->db->from('form');
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
        $this->db->from('form');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function get_form($string)
    {
        $this->db->select("*");
        $this->db->from('form');
        $this->db->like('form_name', $string);
        $query = $this->db->get();
        $array = array();
        foreach ($query->result_array() as $row) {
            $row['text'] = $row['form_name'];
            unset($row['form_name']);
            $array[] = $row;
        }
        return $array;
    }

    public function add($array)
    {
        $this->db->insert('form', $array);
        return $this->db->insert_id();
    }

    public function update($id, $array)
    {
        $this->db->update('form', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("form", array('id' => $id));
    }
}
