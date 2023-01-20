<?php

use function PHPSTORM_META\type;

class Recipe extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function get($id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->where('id', $id);
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $row['base_url'] = base_url();
            $array = $row;
        }
        return $array;
    }

    public function get_all() 
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->order_by('created_at', 'desc');
        // $this->db->where('status_id', 1);
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $row['base_url'] = base_url();
            $recipe_status = $this->get_recipe_status($row['status_id']);
            $row['status'] = isset($recipe_status['status_text']) ? $recipe_status['status_text'] : '';;
            $row['status_color'] = isset($recipe_status['status_color']) ? $recipe_status['status_color'] : 'white';
            $array[] = $row;
        }
        return $array;
    }
    public function get_recipe_by_id($id) 
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->where('id', $id);
        $this->db->order_by('created_at', 'desc');
        // $this->db->where('status_id', 1);
        $result = $this->db->get();
        return $array;
    }
    public function get_all_waiting()
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->where('status_id', 1);
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function get_recipe_pics($recipe_id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('recipe_pic');
        $this->db->where('recipe_id', $recipe_id);
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    // public function add($arr)
    // {
    //     $this->db->insert('recipe', $arr);
    //     return array('stat' => 1, 'id' => $this->db->insert_id());
    // }

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
        $this->db->select('*');
        $this->db->from('product_rating');
        $this->db->where('prod_id', $prod_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(15);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function update($id, $stat)
    {
        $this->db->update('recipe', array('status_id' => $stat), array('id' => $id));
    }

    public function update_recipe_code($id, $code, $phone)
    {
        $this->db->update('recipe', array('recipe_code' => $code), array('id' => $id));
    }



    public function add_recipe($array)
    {
        // date_default_timezone_set('Asia/Dushanbe');
        // $created_at = date('Y-m-d H:i:s');
        // $timezone = new DateTimeZone('Asia/Dushanbe');
        // $datetime = new DateTime('now', $timezone);
        // $now = date('Y-m-d H:i:s', $datetime->getTimestamp());
        // print_r($now);
        // $now = new DateTime();
        // $now->setTimezone($timezone);
        // $now = date('Y-m-d H:i:s', $now->format('Y-m-d H:i:s'));
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->where('recipe_phone', $array['recipe_phone']);
        $this->db->where('recipe_code', $array['recipe_code']);
        $query = $this->db->get();
        if (sizeof($query->result_array()) == 0) {
            $this->db->insert('recipe', array('recipe_phone' => $array['recipe_phone'], 'recipe_code' => $array['recipe_code'],'full_name' => $array['recipe_name'],'comment' => $array['recipe_comment'],'status_id'=> $array['status_id']??0));
            $recipe_id = $this->db->insert_id();
            return array('recipe_id' => $recipe_id, 'stat' => 1);
        } else {
            return array('stat' => -1);
        }
    }

    public function add_recipe_pic($recipe_id, $recipe_pic)
    {
        $this->db->insert('recipe_pic', array('recipe_id' => $recipe_id, 'pic' => $recipe_pic));
    }

    public function check_recipe_phone_code($array)
    {
        $code = $array['recipe_phone_code'];
        $phone = $array['recipe_phone_number'];
        $id = $array['recipe_id'];
        $this->db->select('*');
        $this->db->from('recipe');
        $this->db->where('id', $id);
        $this->db->where('recipe_phone', $phone);
        $this->db->where('recipe_code', $code);
        $query = $this->db->get();
        $answer = $query->result_array();
        if (sizeof($answer) == 0) {
            return 0;
        } else {
            $this->db->update('recipe', array('status_id' => 1), array('id' => $array['recipe_id']));
            return 1;
        }
    }

    public function remove($recipe_id)
    {
        $this->db->delete("recipe", array('id' => $recipe_id));

        $this->db->select("*");
        $this->db->from('recipe_pic');
        $this->db->where('recipe_id', $recipe_id);
        $query = $this->db->get();

        $pics = $query->result_array();

        foreach ($pics as $pic) {
            @unlink("././upload_recipe/" . $pic['pic']);
        }


        $this->db->delete("recipe_pic", array('recipe_id' => $recipe_id));
    }
    public function change_status($recipe_id, $status_id)
    {
        if ($status_id == -1) {
            $this->db->select('*');
            $this->db->from('recipe_pic');
            $this->db->where('recipe_id', $recipe_id);
            $q = $this->db->get();
            $recipe_pics = $q->result_array();
            $pics_name = array();
            foreach ($recipe_pics as $recipe_pic) {
                $pics_name[] = $recipe_pic['pic'];
            }
            foreach ($recipe_pics as $recipe_pic) {
                @unlink("././upload_recipe/" . $recipe_pic['pic']);
            }
        }

        $this->db->update('recipe', array('status_id' => $status_id), array('id' => $recipe_id));
        return 1;
    }
    public function save_user_recipe_status_change($user_id, $recipe_id, $previous_status_id, $status_id, $user_comment)
    {
        $array = array(
            'user_id' => $user_id,
            'recipe_id' => $recipe_id,
            'previous_status_id' => $previous_status_id,
            'status_id' => $status_id,
            'user_comment' => $user_comment
            // 'created_at' => $created_at
        );
        $this->db->insert('user_recipe', $array);
    }
    public function get_all_user_changes($recipe_id)
    {
        $array = array();
        $query = $this->db->query(
            'SELECT ur.id AS user_recipe_id, ur.user_id, users.login AS user_login, users.name AS user_name, users.access AS user_access, ur.recipe_id, st.id AS previous_status_id, st.status_text AS previous_status_text, st2.id AS status_id, st2.status_text AS status_text, ur.user_comment, ur.created_at 
            FROM `user_recipe` AS ur 
            INNER JOIN recipe_status AS st2 ON ur.status_id=st2.id 
            INNER JOIN recipe_status AS st ON ur.previous_status_id=st.id 
            INNER JOIN users ON ur.user_id = users.user_id WHERE recipe_id=' . $recipe_id .' ORDER BY ur.created_at DESC'
        );
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }
    public function get_recipe_status($status_id)
    {
        $array = array('base_url' => base_url());
        $this->db->select('*');
        $this->db->from('recipe_status');
        $this->db->where('id', $status_id);
        $q = $this->db->get();
        foreach ($q->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

}
