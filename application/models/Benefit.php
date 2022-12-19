<?php

class Benefit extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    

    public function get_info()
    {
        $text = array();
        $this->db->select("*");
		//$this->db->where('tag', 'info');
        $this->db->from('setting');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            
            $text[$row['tag']] = $row['text'];

        }
        return $text;
    }

    public function set_info($text, $mobile, $email)
    {
        $this->db->where("tag", "info");
        $this->db->update("setting", array("text" => $text));

        $this->db->where("tag", "phone");
        $this->db->update("setting", array("text" => $mobile));
  
        $this->db->where("tag", "email");
        $this->db->update("setting", array("text" => $email));
    }

    public function add($array)
	{
		$this->db->insert('benefit', $array);
	}

    public function get($id)
	{
		$array = array();
        $this->db->select("*");
		$this->db->where('id', $id);
        $this->db->from('benefit');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $array = $row;
        }
        return $array;
	}

    public function remove($id)
	{
        $dd = $this->get($id);

        @unlink("upload_banner/".$dd['benefit_pic']);

		$this->db->delete("benefit",array('id' => $id));
	}

    public function update($id, $array)
	{
		$this->db->update('benefit', $array, array('id' => $id));
	}

    public function get_all()
	{
		$array = array();
        $this->db->select("*");
        $this->db->from('benefit');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
	}
}

?>