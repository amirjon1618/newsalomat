<?php

class History extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    
    public function add($array)
	{
        //2019-02-11 14:33:03
        $array['history_date'] = date("Y.m.d H:i:s");
        
		$this->db->insert('history', $array);
    }
    
    private function get_status()
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('status');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $array[$row['id']] = $row['status_text'];
        }
        return $array;
    }

    public function get_by_delivery($id)
	{
        $status = $this->get_status();

		$array = array();
        $this->db->select("*");
		$this->db->where('delivery_id', $id);
        $this->db->from('history');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $row['history_status_str'] = $status[$row['history_status']];
            $array[] = $row;
        }
        return $array;
    }

    

    public function update($id, $array)
	{
		$this->db->update('history', $array, array('delivery_id' => $id));
	}

    public function get_all()
	{
        $status = $this->get_status();

		$array = array();
        $this->db->select("*");
        $this->db->from('history');
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $row['base_url'] = base_url();
            $row['status_text'] = $status[$row['delivery_status']];
            $array[] = $row;
        }
        return $array;
	}
}

?>