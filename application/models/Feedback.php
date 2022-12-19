<?php

class Feedback extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    
    public function add($array)
	{
		$this->db->insert('feedback', $array);
	}

    public function get($id)
	{
		$array = array();
        $this->db->select("*");
		$this->db->where('feedback_id', $id);
        $this->db->from('feedback');
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

        @unlink("upload_banner/".$dd['feedback_pic']);

		$this->db->delete("feedback",array('feedback_id' => $id));
	}

    public function update($id, $array)
	{
		$this->db->update('feedback', $array, array('feedback_id' => $id));
	}

    public function get_all()
	{
		$array = array();
        $this->db->select("*");
        $this->db->from('feedback');
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