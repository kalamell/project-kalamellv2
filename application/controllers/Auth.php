<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model', 'auth');
	}
	
	public function login() 
	{
		$this->load->view('auth/login');
	}
	
	public function fb_login()
	{

		$data['user'] = array();

		if ($this->facebook->logged_in())
		{
			$user = $this->facebook->user();

			if ($user['code'] === 200)
			{
				/*
				unset($user['data']['permissions']);
				*/
				$data['user'] = $user['data'];
				
				
				//print_r($user['data']);
				$this->auth->do_login('facebook', $user['data']);
				
				
			}

		}

		redirect('');
	}
	
	public function logout() 
	{
		
	}

}
