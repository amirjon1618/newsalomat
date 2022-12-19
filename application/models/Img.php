<?php

class Img extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    
	public function add($array)
	{
        $this->db->insert('imgs', $array);
        return $this->db->insert_id();
    }

    public function remove($id)
    {
//        $this->db->where("id", $id);
        $img = $this->get_by_id($id);

        @unlink($img['img_link']);
        $this->db->delete("imgs", array("id" => $id));
    }
    
    public function update_news_id($id, $news_id)
    {
        $this->db->where("id", $id);
        $this->db->update("imgs", array("news_id" => $news_id));
    }

    public function update_by_news_id($news_id, $news_id_2 = 0)
    {
        $this->db->where("news_id", $news_id);
        $this->db->update("imgs", array("news_id" => $news_id_2));
    }

    public function get_by_id($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('imgs');
        $this->db->where("id", $id);
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            //$row['base_url'] = base_url();
            $array = $row;
        }
        return $array;
    }

    public function get_by_news_id($news_id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('imgs');
        $this->db->where("news_id", $news_id);
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            //$row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }
}

?>