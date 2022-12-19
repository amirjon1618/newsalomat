<?php

class Page extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    
    public function add($array)
	{
		$this->db->insert('pages', $array);
	}

    public function get($id)
	{
		$array = array();
        $this->db->select("*");
        $this->db->from('pages');
		$this->db->where('id', $id);
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $array = $row;
        }
        return $array;
	}

    public function remove($id)
	{
        //$dd = $this->get($id);

        //@unlink("upload_banner/".$dd['image']);

		$this->db->delete("pages",array('id' => $id));
	}

    public function update($id, $array)
	{
		$this->db->update('pages', $array, array('id' => $id));
	}

    public function get_all()
	{
		$array = array();
        $this->db->select("*");
        $this->db->from('pages');
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