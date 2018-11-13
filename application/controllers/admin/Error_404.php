<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function index()
	{
		get_views('error_404');
	}
}
?>