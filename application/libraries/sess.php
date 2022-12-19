<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ajax library
 * By phh
 */
class Sess
{	
	public function __construct()
	{
		// session_start();
		// parent::__construct();
		
	}
	
	public function destroy()
	{
		session_destroy();
	}
	
	public function set($var, $var2 = NULL)
	{
		if(is_array($var))
		{
			foreach($var as $index => $val)
			{
				$_SESSION[$index] = $val;
			}
		}
		if((is_string($var))&&(!is_null($var2)))
		{
			$_SESSION[$var]=$var2;
		}
	}

	public function get($var)
	{
		if(isset($_SESSION[$var]))
			return $_SESSION[$var];
		else
			return false;
	}
}
?>