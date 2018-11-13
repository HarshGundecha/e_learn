<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('admin/login');
	}
	public function Index(){}
}
?>