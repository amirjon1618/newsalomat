<?php

use function PHPSTORM_META\type;

class Rating extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }
    
    public function get_all()
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('product_rating');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $row['base_url'] = base_url();
            $row['product_name'] = $this->get_product($row['prod_id']);
            $array[] = $row;
        }
        return $array;
    }
    
    public function add($arr)
    {
        // date_default_timezone_set('Asia/Dushanbe');
        // $now_date = date('Y-m-d H:i:s');
        $new_arr = array(
            'user_name' => $arr['review_name'],
            'user_comment' => $arr['review_comment'],
            'star_rating' => (int)$arr['review_rating'],
            'prod_id' => $arr['prod_id']
            // 'created_at' => $now_date
        );
        
        $this->db->insert('product_rating', $new_arr);
        
        return 1;
    }

    private function get_product($id) 
    {
        $this->db->select('product.product_name');
        $this->db->from('product');
        $this->db->where('id', $id);
        $result = $this->db->get();
        if (sizeof($result->result_array()) != 0) {
            return $result->result_array()[0]['product_name'];
        }
        return '';
    }

    public function find($prod_id, $email)
    {
        $this->db->select('*');
        $this->db->from('product_rating');
        $this->db->where('prod_id', $prod_id);
        $this->db->where('user_email', $email);
        $query = $this->db->get();
        if (sizeof($query->result_array()) == 0) {
            return true;
        }
        return false;
    }

    public function get_rating_info($prod_id)
    {
        
        $array = array();
        $this->db->select('*');
        $this->db->from('product_rating');
        $this->db->where('prod_id', $prod_id);
        $this->db->where('status', '1');
        $this->db->order_by('id', 'desc');
        $this->db->limit(15);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $month = date('m', strtotime($row['created_at']));
            $day = date('d', strtotime($row['created_at']));
            $year = date('Y', strtotime($row['created_at']));
            $months = array(
                '01' => 'января',
                '02' => 'февраля',
                '03' => 'марта',
                '04' => 'апреля',
                '05' => 'мая',
                '06' => 'июня',
                '07' => 'июля',
                '08' => 'августа',
                '09' => 'сентября',
                '10' => 'октября',
                '11' => 'ноября',
                '12' => 'декабря'
            );
            $string = $day . ' ' . $months[$month] . ' ' . $year;
            $row['created_at'] = $string;
            $array[] = $row;
        }

        return $array;
    } 
    
    public function update_rev_status($id, $stat) 
    {
        $this->db->update('product_rating', array('status' => $stat), array('id' => $id));
    }

    public function remove($id)
    {
        $this->db->delete("product_rating", array('id' => $id));
    }

}
