<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('string');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Register_m','rm');
		if($this->session->UserID)
		{
			redirect('Home');
		}
	}
	public function index()
	{
		get_view('login','Login | Register');
	}
	public function Register()
	{
		//$this->form_validation->set_rules('Field Name','User friendly name','required');
		$this->form_validation->set_rules('aUserName','UserName','trim|required|min_length[6]');
		$this->form_validation->set_rules('aUserEmail','Email','trim|required|valid_email|is_unique[tbluser.UserEmail]');
		$this->form_validation->set_rules('aUserPassword','Password','trim|required|min_length[8]');
		$this->form_validation->set_rules('aRePassword','Confirm Password','trim|required|min_length[8]|matches[aUserPassword]');
		if($this->form_validation->run()==FALSE)
			get_view('login','Login | Register');
		else
		{
			$otp = random_string('alnum', 6);
			$UserAvatar=strtolower(substr($this->input->get_post('aUserName'), 0, 1).".svg");
			$insert_data=[
				'UserName' => $this->input->get_post('aUserName'),
				'UserEmail' => $this->input->get_post('aUserEmail'),
				'UserPassword' => $this->input->get_post('aUserPassword'),
				'UserAvatar' => $UserAvatar,
				'UserOTP' => $otp
			];
			$this->rm->do_register($insert_data);
			$this->session->set_userdata('UserEmail',$this->input->get_post('aUserEmail'));
			$this->email->from('your_mail_here', 'name');
			$this->email->to($this->session->UserEmail);
			$this->email->subject('Email Verification');
			$this->email->message('Your One Time Password(OTP) Is : '.$otp);
			$this->email->send();
			redirect('Verify');
		}
	}
}
?>