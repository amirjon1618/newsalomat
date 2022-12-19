<?php

class Slider extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function add($array)
    {
        $this->db->insert('slider', $array);
    }

    public function get($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->where('slider_id', $id);
        $this->db->from('slider');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function remove($id)
    {
        $dd = $this->get($id);

        @unlink("upload_banner/" . $dd['slider_pic']);

        $this->db->delete("slider", array('slider_id' => $id));
    }

    public function update($id, $array)
    {
        if (isset($array['slider_pic'])) {
            $this->remove_from_folder($id);
        }

        $this->db->update('slider', $array, array('slider_id' => $id));
    }

    private function remove_from_folder($id)
    {
        $dd = $this->get($id);

        @unlink("upload_banner/" . $dd['slider_pic']);
    }

    public function get_all($type = '', $category_id = '')
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->join('category', 'category.id = slider.slider_category_id', 'left');
        $this->db->order_by("slider.order_id", "asc");
        if ($category_id != '') {
            $this->db->where('slider_category_id', $category_id);
        }
        if ($type != null && $type != '') {
            $this->db->where('slider_type', $type);
        }
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get_all_by_sort($sort)
    {
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->where_in('slider_id', $sort);
        $order = sprintf('FIELD(slider_id, %s)', implode(', ', $sort));
        $this->db->order_by($order);
        $query = $this->db->get();
        $sliders = $query->result_array();

        return $sliders;
    }

    public function get_by_slider_category($id,$type)
    {
        $array = array();
        $this->db->select("*");
        $this->db->where('slider_category_id', $id);
        $this->db->where('type', $type);
        $this->db->from('slider');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;        
    }
}
