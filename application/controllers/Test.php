<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Test extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('view_loader');
		}

		public function index()
		{
			//$this->load->view('rtc/minivid2');
			get_view('rtc/minivid2','Dummy');
		}
	
	}