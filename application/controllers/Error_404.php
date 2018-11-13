<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Error_404_m','em');
	}
	public function index()
	{
		get_view('error_404','Welcome ');
	}
}
?>