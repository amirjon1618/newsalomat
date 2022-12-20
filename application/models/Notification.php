<?php

class Notification extends CI_Model
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
        $this->db->from('notification');
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
        $this->db->from('notification');
        $this->db->like('id', $id);
        $query = $this->db->get();
        $array = array();

        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function add($array)
    {

        $this->db->insert('notification', $array);
        return $this->db->insert_id();
    }

    public function update($id, $array)
    {
        $this->db->update('notification', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("notification", array('id' => $id));
    }

}