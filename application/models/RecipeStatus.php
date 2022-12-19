<?php

class RecipeStatus extends CI_Model
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
        $this->db->from('recipe_status');
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
        $this->db->from('recipe_status');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $array = array();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function update($id, $array)
    {
        $this->db->update('recipe_status', $array, array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("recipe_status", array('id' => $id));
    }
}
