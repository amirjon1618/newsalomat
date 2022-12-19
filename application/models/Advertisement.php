<?php

class Advertisement extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function add($array)
    {
        $this->db->insert('advertisement', $array);
    }

    public function get($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->where('id', $id);
        $this->db->from('advertisement');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function remove($id)
    {
        $dd = $this->get($id);

        @unlink("upload_banner/" . $dd['advertisement_pic']);

        $this->db->delete("advertisement", array('id' => $id));
    }

    public function update($id, $array)
    {
        if (isset($array['advertisement_pic'])) {
            $this->remove_from_folder($id);
        }
        $this->db->update('advertisement', $array, array('id' => $id));
    }

    private function remove_from_folder($id)
    {
        $dd = $this->get($id);

        @unlink("upload_banner/" . $dd['advertisement_pic']);
    }

    public function get_all($type = "")
    {
        $array = array();
        $this->db->select("*");
        $this->db->order_by('rand()');
        $this->db->from('advertisement');
        if ($type != '') {
            $this->db->where('advertisement_type', $type);
            $this->db->limit(2);
        }
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get_slider_by_category($id)
    {
        $new_id = $id;
        $this->load->model('category');
        $category = $this->category->get_parent_categories($new_id);
        if ($category['parent_cat']['parent_id'] != 0) {
            $new_id = $category['parent_cat']['id'];
        }
        $array = array();
        $this->db->select("*");
        $this->db->from('advertisement');
        $this->db->where('advertisement_category', $new_id);
        $query = $this->db->get();
        
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }
}
