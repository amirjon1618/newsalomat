<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		parent::__construct();
		$this->load->helper('cookie');

		
	}
	
	private function createHash($agent_id, $agent_password, $time, $soft)
	{
		
		return md5($agent_id.'&'.$agent_password.'&'.$time.'&'.$soft);
	}
	
	public function index()
	{
		// $this->
		$this->load->model("Agent");
		$agent = $this->Agent->CheckAgentPass($this->input->get("agent_id"), $this->input->get("pass"));
		if($agent!=null)
		{
			$hash = $this->createHash($agent['agent_id'],$agent['agent_password'], time(), $this->input->user_agent());
			
			//$agent_id, $time, $soft, $hash
			$array = array("agent_id" => $agent['agent_id'], 'auth_date' => time(), "auth_soft" => $this->input->user_agent(), "auth_hash" => $hash);
			
			$auth_id = $this->Agent->CreateSession($array);
			
			$auth = array("auth_id" => $auth_id, "auth_hash" => $hash);
			
			setcookie("auth_id", $auth_id, time()+3600*24*15, '/');
			setcookie("auth_hash", $hash, time()+3600*24*15, '/');
			
			echo json_encode($auth);
		}
		else
		{
			echo 'no_login';
		}
	}
	
}