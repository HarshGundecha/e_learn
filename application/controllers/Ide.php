<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ide extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Register_m','rm');
	/*	if(!$this->session->UserID)
		{
			redirect('Login');
		}*/
	}
	public function index()
	{
		get_view('ide','Welcome');
	}
}
?>