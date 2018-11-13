<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	
	public function index()
	{
		$this->email->from('your_mail_here', 'name');
		$this->email->to('receiver mail_here');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class from CODEIGNITER');
		$this->email->send();
		echo $this->email->print_debugger();
	}
}