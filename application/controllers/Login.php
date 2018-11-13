<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
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
		$this->load->model('Login_m','lm');
		if($this->session->UserID)
			redirect('Home');
	}
	public function index()
	{
		get_view('login','Login | Register');
	}
	public function Login()
	{
		//$this->form_validation->set_rules('Field Name','User friendly name','required');
		$this->form_validation->set_rules('sEmail','Email','trim|required');
		$this->form_validation->set_rules('sPassword','Password','trim|required|min_length[8]');
		if($this->form_validation->run()==FALSE)
		{
			$data['error']='Format Doesnot Match Of Email Or Password';
			get_view('login','Login | Register',$data);
		}
		else
		{
			$ad=array(
				'UserEmail'=>$this->input->post('sEmail'),
				'UserPassword like binary'=>$this->input->post('sPassword'));
			$data=$this->lm->do_login($ad);
			if(count($data)===1)
			{
				if($data[0]->IsEmailVerified==1)
				{
					$this->session->set_userdata('UserEmail',$data[0]->UserEmail);
					$op['otp'] = random_string('alnum', 6);
					$this->email->from('your_mail_here', 'name');
					$this->email->to($this->session->UserEmail);
					$this->email->subject('Email Verification');
					$this->email->message($this->load->view('emaildesign',$op,TRUE));
					$this->email->send();
					$this->lm->InsertOTP($op['otp']);
					redirect('Verify');
				}
				elseif($data[0]->UserStatus==1)
				{
					$data['error']='You Were Blocked By SuperAdmin';
					get_view('login','Login | Register',$data);
				}
				else
				{
					$this->session->set_userdata('UserID',$data[0]->UserID);
					$this->session->set_userdata('UserEmail',$data[0]->UserEmail);
					$this->session->set_userdata('UserName',$data[0]->UserName);
					$this->session->set_userdata('UserAvatar',$data[0]->UserAvatar);
					redirect('Home');
				}
				
			}
			else
			{
				$data['error']='Incorrect Email Or Password';
				get_view('login','Login | Register',$data);
			}
		}
	}
}
?>