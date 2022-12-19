<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	
	public function __construct()
	{
		// header('Access-Control-Allow-Origin: *');
		parent::__construct();
		$this->load->helper('cookie');

		if ($this->checkAuth()) {
            redirect(base_url("index.php/admin"), "refresh");
            die();
        }
	}
	
	public function login()
	{
		$data = array('base_url' => base_url(), 'alert' => '');

		if($this->input->post("login") && $this->input->post("password"))
		{
			$this->load->model("user");

			$array = $this->user->auth($this->input->post("login"), $this->input->post("password"));
			if($array!=null && ($array['access'] == 100 || $array['access'] == 60 ))
			{
				$session = array("user_id" => $array['user_id'], 'auth_soft' => $this->input->user_agent(),'auth_date' => time());
				$auth_id = $this->user->CreateSession($session);
				$this->isAuth = true;
				setcookie("auth_id", $auth_id, time()+3600*24*15, '/');
				redirect(base_url('/index.php/admin/'), 'refresh');
			}
			else
			{
				$data['alert'] = $this->createAlert('Ошибка Авторизации');	
			}
		}
		
		$this->parser->parse('login', $data);
	}

	private $isAuth = null;

	private function checkAuth()
    {
        $this->load->model("user");
        if ($this->isAuth == null) {
            if ($this->input->cookie('auth_id')) {
                $this->user->GetUserData($this->input->cookie('auth_id'));
            }

            if ($this->user->myData == null || $this->user->myData['access'] < 20) {
                $this->isAuth = false;
                return false;
            } else {
                $this->isAuth = true;
                return true;
            }
        } else {
            return $this->isAuth;
        }
    }

    public function register()
	{
		$data = array('base_url' => base_url(), 'alert' => '');
        
        if ($this->input->post("login") & $this->input->post('password')) {
        	
        	$this->load->model("user");

            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            $new_user = array(
                                'login' => $login, 
                                'password' => $password, 
                                'name' => $name, 
                                'enabled' => 1, 
                                'access' => 10
                            );
            $result = $this->user->newUser($new_user);
            if($result > 0)
            {
                redirect(base_url("index.php/auth/login"), "refresh");
            } else 
            {
				$data['alert'] = $this->createAlert('Пользователь с таким login уже существуют!');	
            }
        }
        // else
        //     echo '{"result" : -1}';

        $this->parser->parse('admin/register', $data);
	}



	//public function newUser($login, $pass)
	//{
	//    $this->load->model("user");

	//    $array = array("login" => $login, "password" => $pass, "name" => "Admin");
	//    $this->user->newUser($array);
	//}
	
	private function createAlert($text)
	{
		return $this->parser->parse('alert', array('alertText' => $text), true);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */