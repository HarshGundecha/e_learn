<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoChat extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('view_loader');
            $this->load->library('session');
    		if(!$this->session->UserID)
    			redirect('Login');
		}

		public function index()
		{
			get_view('videochat','TS | Video Chat');
		}
}