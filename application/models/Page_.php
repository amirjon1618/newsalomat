<?php

class Page extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    public function GetStaticByAlias($alias)
    {
        $PageObject = null;
        $query = $this->db->get_where('statics', array('alias' => $alias));
        foreach ($query->result_array() as $row)
        {
               $PageObject = $row;
        }
        return $PageObject;
    }

    public function addStatic($array)
	{
		$this->db->insert('statics', $array);
	}

    public function getStatic($id)
	{
		$array = array();
        $this->db->select("*");
		$this->db->where('id', $id);
        $this->db->from('statics');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $array = $row;
        }
        return $array;
	}

    public function removeStatic($array)
	{
		$this->db->delete("statics",array('id' => $id));
	}

    public function updateStatic($id, $array)
	{
		$this->db->update('statics', $array, array('id' => $id));
	}

    public function getStatics()
	{
		$array = array();
        $this->db->select("*");
        $this->db->from('statics');
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