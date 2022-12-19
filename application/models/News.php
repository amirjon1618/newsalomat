<?php

class News extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
	}
	
	private function date_str($d)
	{
		$month = array("01" => "Январь", "02" => "Февраль", "03" => "Март", "04" => "Апрель", "05" => "Май", "06" => "Июнь", "07" => "Июль", "08" => "Август", "09" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь");
	
		$str = $month[date('m', $d)].' '.date('d', $d).', '.date('Y', $d);
		return $str;
	}
    
    public function add($array)
    {
        $this->db->insert('news', $array);
        return $this->db->insert_id();
    }

    public function remove($id)
    {
        $this->db->delete("news",array('id' => $id));
    }

    public function update($array, $id)
    {
        $this->db->where("id", $id);
        $this->db->update("news", $array);
    }

    public function get_all($page = 1, $category = null)
    {
        $content_on_page = $this->content_on_page_admin;

        $array = array();
        $this->db->select("*");
        $this->db->from('news');
		$this->db->order_by("id", "desc");

		if($category!=null)
			$this->db->where("category_id", $category);

        if(is_null($page))
		{
			$this->db->limit($content_on_page);
		}
		else
		{
			$from = $page;
			$from = $from*$content_on_page-$content_on_page;
			$this->db->limit($content_on_page, $from);
		}

        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
			$row['news_date_str'] = date("d.m.Y h:i", $row['news_date']);
			$row['news_date2'] = $this->date_str($row['news_date']);
			$row['base_url'] = base_url();
			$array[] = $row;
        }
        return $array;
	}

	public function get_rand($limit = 5)
    {

        $array = array();
        $this->db->select("*");
        $this->db->from('news');
		$this->db->order_by("id", "RANDOM");

		$this->db->limit($limit);
		
		$query = $this->db->get();
        foreach($query->result_array() as $row)
        {
			$row['news_date_str'] = date("d.m.Y h:i", $row['news_date']);
			$row['news_date2'] = $this->date_str($row['news_date']);
			$row['base_url'] = base_url();
			$array[] = $row;
        }
        return $array;
	}
	
	public function get_by_words($words)
    {
        
        $array = array();
        $this->db->select("*");
        $this->db->from('news');
		$this->db->order_by("id", "desc");

		$this->db->limit(10);
		$this->db->like('news_title', $words);


        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
            $row['news_date_str'] = date("d.m.Y h:i", $row['news_date']);
			$row['base_url'] = base_url();
			$array[] = $row;
        }
        return $array;
    }

    

    public function get_by_id($id)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('news');
        $this->db->where("id", $id);
        $query = $this->db->get();
        foreach($query->result_array() as $row)
        {
			$row['news_date_str'] = date("d.m.Y h:i", $row['news_date']);
			$row['news_date2'] = $this->date_str($row['news_date']);
            $row['base_url'] = base_url();
            $array = $row;
        }
        return $array;
    }

    private $content_on_page_admin = 5;

    public function get_paging($page_now = 1)
	{
		$page = 0;

		$page_count = 6;
		$ccc = $this->content_on_page_admin;
		$total = 0;

		$query = null;
		
		$query = $this->db->query("select COUNT(id) as cc FROM news");		
		foreach($query->result_array() as $row)
		{
			$total = $row['cc'];
		}
		// $total = $this->db->count_all("content");
		$total=ceil($total/$ccc);

		$page_count = $total;

		if($total>($page_now+$page_count/2))
		{
			$page = $page_now+$page_count/2;
			if($page<$page_count)
				$page=$page_count;
		}
		else
		{
			$page = $total-$page_now;
			$page = $page_now+$page;
		}

		$ii=1;
		//if($page_now>$page_count/2)
		//	$ii = $page_now-$page_count/2;
	
		$str = '';
		
		$paging = array();

		if($page>1)
		{
			$pp = array();
			$pp["go_to_start_status"] = "";
			$pp["go_to_left_status"] = "";
			$pp["go_to_right_status"] = "";
			$pp["go_to_finish_status"] = "";
			$pp["go_to_left"] = $page_now-1;
			$pp["go_to_right"] = $page_now+1;

			$pp["go_to_start"] = "1";
			$pp["go_to_finish"] = $total;
			$pp["base_url"] = base_url();

			if($page_now==1)
			{
				$pp["go_to_start_status"] = "disabled";
				$pp["go_to_left_status"] = "disabled";
			}
			else if($page_now==$total)
			{
				$pp["go_to_right_status"] = "disabled";
				$pp["go_to_finish_status"] = "disabled";
			}

			for($i=$ii; $i<$page+1; $i++)
			{
				$ppp = array();
				$ppp["page_number"] = $i;
				$ppp["page_active"] = "";
				$ppp["base_url"] = base_url();

				if($page_now == $i)
					$ppp["page_active"] = "disabled";

				$pp["pags"][] = $ppp;					
			}

			$paging[] = $pp;		
		}
		return $paging;
	}
}

?>