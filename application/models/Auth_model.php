<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function do_login($type='web', $data = array()) 
	{
		if ($type=='web') {
		} elseif ($type=='facebook') {
			$chk = $this->db->where('fb_id', $data['id'])->get('member');
			if ($chk->num_rows()==0) {
				$this->db->set('created', 'NOW()', FALSE)->insert('member', array(
					'fb_id' => $data['id'],
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'email' => $data['email'],
					'type' => $type,
					'ip' => $this->input->ip_address(),
				));
				$id = $this->db->insert_id();
				$this->session->set_userdata('login', $id);
			} else {
				$this->db->set('last_login', 'NOW()', FALSE)->where('id', $chk->row()->id)->update('member', array(
					'fb_id' => $data['id'],
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'type' => $type,
					'ip' => $this->input->ip_address(),
				));
				$this->session->set_userdata('login', $chk->row()->id);
			}
		}
	}
	
	
}