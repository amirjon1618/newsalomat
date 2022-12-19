<?php
class Delivery extends CI_Model 
{   
    public function __construct()    
    {        
        parent::__construct();        
        // Your own constructor code        
        $this->load->database();    
    }    

    // public function add($array)    
    // {
    //     //2019-02-11 14:33:03        
    //     $array['delivery_create'] = date("Y.m.d H:i:s");        
    //     $this->db->insert('delivery', $array);    
		
	// 	return $this->db->insert_id();
    // }    
    
    public function get($id)    
    {        
        $array = array();        
        $this->db->select("*");        
        $this->db->where('delivery_id', $id);        
        $this->db->from('delivery');        
        $query = $this->db->get();        
        foreach($query->result_array() as $row)        
        {            
            $array = $row;        
        }        
        return $array;    
    }

    
    // public function get_delivery_to()    
    // {        
    //     $array = array();        
    //     $this->db->select("*");
    //     $this->db->from('delivery_to');
    //     $this->db->where('enabled', 1);   
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $row['base_url'] = base_url();
    //         $array[] = $row;        
    //     }        
    //     return $array;    
    // }  

    // public function delivery_to_add($array)    
    // { 
    //     $this->db->insert('delivery_to', $array);    
	// 	return $this->db->insert_id();
    // }

    // public function delivery_to_remove($id)
    // {
    //     $this->db->where("id", $id);
    //     $this->db->update("delivery_to", array("enabled" => 0));
    // }

    // public function get_delivery_type_by_id($id)
    // {
    //     $delivery = array();
    //     $this->db->select("*");        
    //     $this->db->from('delivery_type');
    //     $this->db->where("id", $id);
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {
    //         $row['base_url'] = base_url();
    //         $delivery = $row;
    //     }
    //     return $delivery;  
    // }
        
    // public function get_delivery_type()
    // {   
    //     $delivery = array();
    //     $this->db->select("*");        
    //     $this->db->from('delivery_type');
    //     $this->db->where("enabled", 1);
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {
    //         $row['base_url'] = base_url();
    //         $delivery[] = $row;
    //     }
    //     return $delivery;
    // }

    // public function delivery_type_add($array)
    // {
    //     $this->db->insert('delivery_type', $array);    
	// 	return $this->db->insert_id();
    // }

    // public function delivery_type_id($id, $dd)
    // {
    //     $this->db->where("id", $id);
    //     $this->db->update("delivery_type", $dd);
    // }

    // public function delivery_type_remove($id)
    // {
    //     $this->db->where("id", $id);
    //     $this->db->update("delivery_type", array("enabled" => 0));
    // }
    
    // public function get_status2()
    // {        
    //     $array = array();        
    //     $this->db->select("*");        
    //     $this->db->from('status');   
    //     $this->db->where('enabled', 1);     
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $array[] = $row;        
    //     }        
    //     return $array;    
    // }    
    
    // private function get_status()    
    // {        
    //     $array = array();        
    //     $this->db->select("*");        
    //     $this->db->from('status');        
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $array[$row['id']] = $row['status_text'];        
    //     }        
    //     return $array;    
    // }
    
    // public function update($id, $array)
    // {
    //     //delivery_update
    //     $array['delivery_update'] = date("Y.m.d H:i:s");       
    //     $this->db->update('delivery', $array, array('delivery_id' => $id));    
    // }    
    
    // public function remove($id)
    // {
    //     $insert_data = $this->get($id);
    //     if(count($insert_data)>0)
    //     {
    //         $this->db->insert("delivery_del", $insert_data);
    //         $this->db->delete("delivery", array("delivery_id" => $id));
    //     }
    // }

    public function get_all()    
    {        
        $array = array();        
        $this->db->select("*");        
        $this->db->from('delivery');        
        $query = $this->db->get();        
        foreach($query->result_array() as $row)        
        {            
            $row['base_url'] = base_url();            
            $array[] = $row;        
        }        
        return $array;    
    }

    // public function get_by_user($user_id, $st = 0, $delivery_id = null)    
    // {        
    //     $status = $this->get_status();        
    //     $array = array();
    //     $this->db->select("*");
    //     $this->db->where("delivery_user_id", $user_id);
    //     $this->db->where("delivery_status", $st);
    //     if(!is_null($delivery_id))
    //         $this->db->where('delivery_id !=', $delivery_id);
    //     $this->db->from('delivery');        
    //     $query = $this->db->get();
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $row['base_url'] = base_url();            
    //         $row['status_text'] = $status[$row['delivery_status']];            
    //         $array[] = $row;        
    //     }        
    //     return $array;    
    // }

    // public function get_by_search($st = null, $q = null)    
    // {        
    //     $status = $this->get_status();       
    //     $array = array();        
    //     $this->db->select("*");        
    //     $this->db->from('delivery');        
    //     $this->db->order_by("delivery_id", "desc");       
    //     if($st!='')            
    //         $this->db->where('delivery_barcode', $st);        
    //     if(isset($q['date1']))        
    //     {            
    //         $this->db->where('delivery_create >', $q['date1']);            
    //         $this->db->where('delivery_create <', $q['date2']);        
    //     }
    //     else
    //         $this->db->limit(100);
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $row['base_url'] = base_url();            
    //         $row['status_text'] = $status[$row['delivery_status']];            
    //         $array[] = $row;        
    //     }   
    //     return $array;
    // }
    
    // public function get_by_status_all($st = null,$q = null)
    // {
    //     $status = $this->get_status();       
    //     $array = array();        
    //     $this->db->select("*");        
    //     $this->db->from('delivery');        
    //     $this->db->order_by("delivery_id", "desc");       
    //     if(!is_null($st))
    //         $this->db->where('delivery_status', $st);

    //     if(isset($q['date1']))        
    //     {            
    //         $this->db->where('delivery_create >', $q['date1']);            
    //         $this->db->where('delivery_create <', $q['date2']);        
    //     }

    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $row['base_url'] = base_url();            
    //         $row['status_text'] = $status[$row['delivery_status']];            
    //         $array[] = $row;        
    //     }   
    //     return $array;
    // }

    // public function get_by_status($st = null, $page = 1)    
    // {        
    //     $status = $this->get_status();        
    //     $array = array();        
    //     $this->db->select("*");        
    //     $this->db->from('delivery');        
    //     $this->db->order_by("delivery_id", "desc");        
    //     if(!is_null($st))        
    //     {            
    //         $this->db->where('delivery_status', $st);        
    //     }        
    //     if(is_null($page))
    //     {            
    //         $this->db->limit($this->contents);
    //     }        
    //     else
    //     {
    //         $from = $page;            
    //         $from = $from*$this->contents-$this->contents;            
    //         $this->db->limit($this->contents, $from);        
    //     }
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         $row['base_url'] = base_url();            
    //         $row['status_text'] = $status[$row['delivery_status']];           
    //         $array[] = $row;        
    //     }        
    //     return $array;    
    // }    
    
    // private $contents = 50;
    // public function paging($link, $current = 1, $st = null)    
    // {        
    //     $cc = 0;        
    //     $this->db->select("COUNT(*) as cc");        
    //     $this->db->from('delivery');        
    //     if(!is_null($st))
    //         $this->db->where("delivery_status", $st);        
    //     $query = $this->db->get();        
    //     foreach($query->result_array() as $row)        
    //     {            
    //         if($row['cc']>0)               
    //         $cc = ceil($row['cc']/$this->contents);        
    //     }        
    //     $pages = array();        
    //     for($i = 1;$i <= $cc; $i++)        
    //     {            
    //         if($i==$current)                
    //             $pages[] = array("page" => $i, "link" => base_url("index.php/Admin/".$link), "current" => 'active');            
    //         else                
    //             $pages[] = array("page" => $i, "link" => base_url("index.php/Admin/".$link), "current" => '');        
    //         }        
    //         return $pages;    
    //     }    /******************************************************************************************************************/    
        
    //     public function get_main_by_user($user_id)
    //     {        
    //         $array = null;        
    //         $this->db->select("delivery_id, delivery_barcode, DATE(delivery_create) as delivery_create, delivery_status");        
    //         $this->db->from('delivery');        
    //         $this->db->where('delivery_user_id', $user_id);       
    //         $this->db->order_by("delivery_id", "desc");        
    //         $query = $this->db->get();        
    //         foreach($query->result_array() as $row)        
    //         {            
    //             $row['base_url'] = base_url();            
    //             $row['status_text'] = $this->get_status_text_by_id($row['delivery_status']);            
    //             $array[] = $row;        
    //         }        
    //         return $array;    
    //     }    
        
    //     public function get_status_text_by_id($id)
    //     {        
    //         $array = null;        
    //         $this->db->select('status_text');        
    //         $this->db->from('status');        
    //         $this->db->where('id', $id);        
    //         $query = $this->db->get();        
    //         foreach ($query->result_array() as $row)
    //         {           
    //             $array = $row['status_text'];        
    //         }        
    //         return $array;    
    //     }    
        
    //     public function get_all_by_id($id)
    //     {
    //         $arr = array();
    //         $this->db->select("*");        
    //         $this->db->from('delivery');        
    //         $this->db->where('delivery_id', $id);        
    //         $query = $this->db->get();
    //         foreach ($query->result_array() as $row) {
    //             $row['delivery_to'] = $this->get_delivery_to_name($row['delivery_to']);      
    //             $row['delivery_type'] = $this->get_delivery_type_name($row['delivery_type']);
    //             $arr[] = $row;     
    //         }  
    //         return $arr;
    //     }

    //     public function get_delivery_to_name($id){
    //         $text = null;
    //         $this->db->select('delivery_to_name');
    //         $this->db->from('delivery_to');
    //         $this->db->where('id', $id);
    //         $query = $this->db->get();
    //         foreach ($query->result_array() as $value) {
    //             $text = $value['delivery_to_name'];
    //         }
    //         return $text;
    //     } 

    //     public function get_delivery_type_name($id){
    //         $text = null;
    //         $this->db->select('delivery_type_name');
    //         $this->db->from('delivery_type');
    //         $this->db->where('id', $id);
    //         $query = $this->db->get();
    //         foreach ($query->result_array() as $value) {
    //             $text = $value['delivery_type_name'];
    //         }
    //         return $text;
    //     } 

    //     public function get_all_by_barcode($barcode){
    //         $this->db->select("*");
    //         $this->db->from('delivery');
    //         $this->db->where('delivery_barcode', $barcode);
    //         $this->db->limit(1);
    //         $query = $this->db->get();
    //         return $query->result_array();
    //     }
        
    //     public function get_id_by_barcode($barcode)
    //     {        
    //         $id = null;        
    //         $this->db->select("delivery_id");        
    //         $this->db->from('delivery');        
    //         $this->db->where('delivery_barcode', $barcode);        
    //         $query = $this->db->get();        
    //         foreach ($query->result_array() as $row)
    //         {           
    //             $id = $row['delivery_id'];        
    //         }        
    //         return $id;    
    //     }    
        
    //     public function get_history_by_id($id)
    //     {        
    //         $array = null;      
    //         $this->db->select("history_id, history_status, DATE_FORMAT(history_date, '%Y-%m-%d') as history_date, DATE_FORMAT(history_date,'%H:%i') as history_time, history_comment");        
    //         $this->db->from('history');        
    //         $this->db->where('delivery_id', $id);        
    //         $this->db->order_by("history_id", "desc");        
    //         $query = $this->db->get();        
    //         foreach($query->result_array() as $row)        
    //         {            
    //             // $row['base_url'] = base_url();            
    //             $row['history_status_text'] = $this->get_status_text_by_id($row['history_status']);            
    //             $array[] = $row;        
    //         }        
    //         return $array;    
    //     }    
        
    //     public function add_delivery($info)
    //     {        
    //         $this->db->insert('delivery', $info);        
    //         $this->db->select('LAST_INSERT_ID()');        
    //         $this->db->from('delivery');        
    //         $id = $this->db->get();        
    //         $last_id = null;        
    //         foreach ($id->result_array() as $row)
    //         {            
    //             $last_id = $row['LAST_INSERT_ID()'];        
    //         }        
    //         return $last_id;    
    //     }

    //     public function get_active_delivery_count($user_id)
    //     {        
    //         $this->db->select("*");        
    //         $this->db->from('delivery');        
    //         $this->db->where('delivery_user_id', $user_id);        
    //         $this->db->where('delivery_status !=', 5);        
    //         $query = $this->db->get();        
    //         return count($query->result_array());    
    //     }

    //     public function check_if_mine($user_id, $delivery_id)
    //     {
    //         $this->db->select("*");
    //         $this->db->from('delivery');
    //         $this->db->where('delivery_id', $delivery_id);  
    //         $this->db->where('delivery_user_id', $user_id);
    //         $query = $this->db->get();
    //         if(count($query->result_array()) > 0){
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    }
?>