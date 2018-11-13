<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('string');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$config['mailtype'] = 'html';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ResetPassword_m','rpm');
		if($this->session->UserID)
			redirect('Home');
	}
	public function index()
	{
		get_view('forgetpassword','Reset Password | e_learn');
		// get_view('login','Login | Register');
	}
	public function GetOTP()
	{
		//$this->form_validation->set_rules('Field Name','User friendly name','required');
		$this->form_validation->set_rules('UserEmail','Email','trim|required');
		// $this->form_validation->set_rules('sPassword','Password','trim|required|min_length[8]');
		if($this->form_validation->run()==FALSE)
		{
			$data['error']='Format Doesnot Match Of Email';
			get_view('forgetpassword','Reset Password | e_learn',$data);
		}
		else
		{
			$ad=array(
				'UserEmail'=>$this->input->post('UserEmail'));
			$data=$this->rpm->getUserData($ad);
			if(count($data)==1)
			{
				$this->session->set_userdata('EmailResetPassword',$data[0]->UserEmail);
				$op['otp'] = random_string('alnum', 6);
				$this->email->from('your_mail_here', 'name');
				$this->email->to($this->session->EmailResetPassword);
				$this->email->subject('Reset Password');
				$this->email->message($this->load->view('emaildesign',$op,TRUE));
		        //$this->email->message('Your One Time Password(OTP) Is : '.$otp);
				$this->email->send();
				$this->rpm->InsertOTP($op['otp']);
				get_view('resetpassword','Reset Password | e_learn');
			}
			else
			{
				$data['error']='Email Doesnot Exist';
				get_view('forgetpassword','Reset Password | e_learn',$data);
			}
		}
	}

	//Forget Password
	public function ForgetPassword()
	{
		get_view('forgetpassword','Reset Password | e_learn');
	}	

	//resend OTP
	public function ReSendOTP()
	{
		$op['otp'] = random_string('alnum', 6);
		$this->email->from('your_mail_here', 'name');
		$this->email->to($this->session->EmailResetPassword);
		$this->email->subject('Reset Password');
		//$this->email->message('Your One Time Password(OTP) Is : '.$otp);
		$this->email->message($this->load->view('emaildesign',$op,TRUE));
		$this->email->send();
		$this->rpm->InsertOTP($op['otp']);
		get_view('resetpassword','Reset Password | e_learn');
	}

	//update password
	public function ChangePassword()
	{
		//$this->form_validation->set_rules('Field Name','User friendly name','required');
		// $this->form_validation->set_rules('aUserName','UserName','trim|required|min_length[6]');
		// $this->form_validation->set_rules('aUserEmail','Email','trim|required|valid_email|is_unique[tbluser.UserEmail]');
		$this->form_validation->set_rules('aUserOTP','OTP','trim|required|min_length[6]');
		$this->form_validation->set_rules('aUserPassword','Password','trim|required|min_length[8]');
		$this->form_validation->set_rules('aRePassword','Confirm Password','trim|required|min_length[8]|matches[aUserPassword]');
		if($this->form_validation->run()==FALSE)
			get_view('resetpassword','Reset Password | e_learn');
		else
		{
			$ad=array(
				'UserEmail'=>$this->session->EmailResetPassword);
			$data=$this->rpm->getUserData($ad);
			if($data[0]->UserOTP===$this->input->get_post('aUserOTP'))
			{
				$where=NULL;
				$where=['UserEmail'=>$this->session->EmailResetPassword];
				$data=NULL;
				$data=['UserPassword'=>$this->input->get_post('aUserPassword')];
				$this->rpm->UpdataPassword($where,$data);
				$this->session->sess_destroy();
				redirect('Login');
			}
			else
			{
				$data['error']='Incorrect OTP';
				get_view('resetpassword','Reset Password | e_learn',$data);
			}
		}
	}
}
?>