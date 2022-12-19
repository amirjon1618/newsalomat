<?php
class User extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper("cookie");
        $this->load->database();
    }

    public function getAllUser()
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where("access", "10");
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['enabled_str'] = 'false';
            $row['base_url'] = base_url();

            if ($row['enabled'] == '1')
                $row['enabled_str'] = 'true';
            $array[] = $row;
        }
        return $array;
    }

    public function get_users()
    {
        $this->db->select("*");
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }

    public function show_user($id)
    {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserByAccess($access)
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where("access", $access);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['enabled_str'] = 'false';
            $row['base_url'] = base_url();

            if ($row['enabled'] == '1')
                $row['enabled_str'] = 'true';
            $array[] = $row;
        }
        return $array;
    }

    public function getAllUser2()
    {
        $array = array();
        $this->db->select("*");
        $this->db->from('users');
        $this->db->order_by("user_id", "desc");
        //$this->db->where_not_in('user_id')
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['enabled_str'] = 'false';
            $row['access_type'] = '';

            if ($row['access'])
                $row['access_type'] = 'Пользователь';
            if ($row['access'] == 60)
                $row['access_type'] = 'Сотрудник';
            if ($row['access'] == 100)
                $row['access_type'] = 'Администратор';

            if ($row['enabled'] == '1')
                $row['enabled_str'] = 'true';
            $array[] = $row;
        }
        return $array;
    }

    public function getRole($userId, $role)
    {
        $array = array();
        $this->db->select("access_id");
        $this->db->from("access");
        $this->db->where('user_id', $userId);
        $this->db->where('role', $role);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            return true;
        }
        return false;
    }

    public function getUser($user_id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }


    public function hash_pass($str)
    {
        return md5("ffxKS&@)|_'a" . $str);
    }

    public function auth($login, $pass)
    {
        $array = null;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('login', $login);
        $this->db->where('password', $this->hash_pass($pass));
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $row['auth'] = true;
            // $this->sess->set($row);
            //print_r($row);
            $array = $row;

            // return true;
        }
        return $array;
    }


    function get_count_of_users($enabled = 1)
    {
        $cc = 0;
        $this->db->select('COUNT(user_id) as cc');
        // $this->db->where('user_level <', '2');
        $this->db->where('enabled',  $enabled);
        $query = $this->db->get('users');
        foreach ($query->result_array() as $row) {
            $cc = $row['cc'];
        }
        return $cc;
    }

    public function changePass($user_id, $newpass)
    {
        $this->db->where("user_id", $user_id);
        $this->db->update("users", array("password" => $this->hash_pass($newpass)));
        return 1;
    }

    public function updateUser($user_id, $userData)
    {
        if (isset($userData['password']))
            $userData['password'] = $this->hash_pass($userData['password']);

        $this->db->where("user_id", $user_id);
        $this->db->update("users", $userData);
    }

    public function newUser($userData)
    {
        if (isset($userData['password']))
            $userData['password'] = $this->hash_pass($userData['password']);

        if ($this->login_is_free($userData['login'])) {
            $this->db->insert('users', $userData);
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function get_access($user_id)
    {
        $array = array();
        $this->db->select("status_id");
        $this->db->from("status_access");
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array[$row['status_id']] = $row['status_id'];
        }
        return $array;
    }

    public function delete($user_id)
    {
        $this->db->delete('users', array('user_id' => $user_id));
    }

    public function addRole($userId, $roles)
    {
        $this->db->delete('access', array('user_id' => $userId));

        foreach ($roles as $role) {
            $this->db->insert('access', array('user_id' => $userId, 'role' => $role));
        }
    }


    public function login_is_free($login)
    {
        $this->db->where('login', $login);
        $this->db->from('users');
        if ($this->db->count_all_results() > 0) {
            return false;
        } else {
            return true;
        }
    }


    function get_keys()
    {
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $this->db->select('key');
        $this->db->from('keys');
        $query = $this->db->get();
        return $query->result();
    }

    function register_user(array $data)
    {
        $this->db->insert('users', $data);
        if ($this->db->insert_id() != 0) {
            $name = $data['name'];
            $login = $data['login'];

            //--log table insertion--//
            $this->db->insert('log_table', array(
                'user_id' => 0,
                //                'datetime' => date("Y-m-d H:i:s"),
                //                'status' => 1, // insertion
                'comment' => 'Новый пользователь: ' . $name . ', телефон: ' . $login . ', был добавлен.'
            ));
            //--log table insertion--//
        }
        return $this->db->insert_id();
    }

    function user_login($phone, $password)
    {
        $this->db->where('login', $phone);
        $query = $this->db->get('users');

        // if($query->num_rows())
        // {
        //     $user_pass = $query->row('password');
        //     if(hash('sha256', $phone.$password.$key) === $user_pass){
        //         return $query->row();
        //     }
        //     return FALSE;
        // }else{
        //     return FALSE;
        // }
        if ($query->num_rows()) {
            $user_pass = $query->row('password');
            if ($this->hash_pass($password) === $user_pass) {
                return $query->row();
            }
        }
        return FALSE;
    }

    function set_onesignal_id($phone, $oneSignalId)
    {
        $this->db->set('onesignal_id', $oneSignalId);
        $this->db->where('login', $phone);
        $this->db->update('users');
    }

    public function forgot_password($phone, $password)
    {
        $this->db->set('password', $this->hash_pass($password));
        $this->db->where('login', $phone);
        $this->db->update('users');

        $this->db->select('*');
        $this->db->where('login', $phone);
        $q = $this->db->get('users');
        $data = $q->result_array();

        if (!empty($data[0]['login'])) {
            return [
                "status"  => true,
                "message" => "Пароль изменён"
            ];
        } else {
            return 0;
        }
    }

    public function CreateSession($array)
    {
        $this->db->delete('session', array('user_id' => $array['user_id']));

        $array['auth_lastacces'] = time() + $this->sessionTime;
        $this->db->insert("session", $array);
        return $this->db->insert_id();
    }

    public function GetUserData($auth_id)
    {
        $array = null;
        $this->db->select('*');
        $this->db->where('auth_id', $auth_id);
        $this->db->from('session');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }

        if ($array != null) {
            // print_r($array);
            if ($array['auth_soft'] == $this->input->user_agent() && $array['auth_lastacces'] > time()) {
                $d = $this->getUser($array['user_id']);

                $this->db->where("user_id", $array['user_id']);
                $this->db->update("session", array("auth_lastacces" => time() + $this->sessionTime));

                $this->myData = $d;
                return $d;
            } else {
                delete_cookie("auth_id");
                // return null;
            }
        } else {
            delete_cookie("auth_id");
        }

        return null;
    }

    public $sessionTime = 1200000; //
    public $myData;

    public $access_status = null;
}
