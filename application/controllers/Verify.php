<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('string');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('session');
		$this->load->model('Verify_m','vm');
		if($this->session->UserID)
			redirect('Home');
		if(!$this->session->UserEmail)
		{
			redirect('Login');
		}
	}
	public function index()
	{
		get_view('verify','Verify Email');
	}

	public function ReSendOTP()
	{
		$otp = random_string('alnum', 6);
		$this->email->from('your_,ail_here', 'name');
		$this->email->to($this->session->UserEmail);
		$this->email->subject('Email Verification');
		$this->email->message('Your One Time Password(OTP) Is : '.$otp);
		$this->email->send();
		$this->vm->InsertOTP($otp);
		// echo $this->email->print_debugger();
		// echo '<br>'.$this->session->UserEmail;
		// die();
		//get_view('verify','Verify Email');
        redirect('Verify');
	}

	public function verify()
	{
		$UserPassword=$this->input->post('UserPassword');
		$UserOTP=$this->input->post('UserOTP');
		$data=$this->vm->getUserData();
		if(count($data)==1)
		{
			if($data[0]->UserPassword!==$UserPassword)
			{
				$data['error']='Password You Entered Is Incorrect';
				get_view('verify','Verify Email',$data);
			}
			elseif($data[0]->UserOTP!==$UserOTP)
			{
				$data['error']='OTP You Entered Is Incorrect';
				get_view('verify','Verify Email',$data);
			}
			elseif($data[0]->UserPassword===$UserPassword && $data[0]->UserOTP===$UserOTP)
			{
				$this->vm->do_verify();
				$this->session->set_userdata('UserID',$data[0]->UserID);
				// $this->session->set_userdata('UserEmail',$data[0]->UserEmail);
				$this->session->set_userdata('UserName',$data[0]->UserName);
				$this->session->set_userdata('UserAvatar',$data[0]->UserAvatar);
				redirect('Home');			
			}
		}
	}
}