<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function do_login($ad)
	{
		$this->db->where($ad);
		$data=$this->db->get('tbladmin');
		//print_r($data->result());
		//die();
		//$this->load->view('admin/login');
		return $data->result();
	}
}
?>