<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Home_m','hm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	public function index()
	{
		$data['CourseData']=$this->hm->getCourse();
		$data['UserData']=$this->hm->getTopUser();
		get_view('home','Welcome '.$this->session->UserName,$data);
	}

	//display all user list
	public function Users()
	{
		$data['UserData']=$this->hm->getAllUser();
		get_view('alluserlist','All Users On e_learn',$data);	
	}

	//send message feedback and report to admin via email
	public function ContactUs()
	{
		$this->form_validation->set_rules('Message','Send Message','trim|required');
		if($this->form_validation->run()==FALSE)
			redirect('Home');
		else
		{
			$this->email->from($this->session->UserEmail, $this->session->UserName);
			$this->email->to('your_mail_here', 'name');
			$this->email->subject('FeedBack | Report');
			$this->email->message($this->input->post('message'));
			$this->email->send();
			redirect('Home');
		}
	}
}
?>