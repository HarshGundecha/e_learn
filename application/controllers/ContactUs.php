<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admin/ContactUs_m','cm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	public function index()
	{
		get_view('contactus','Contact Us | e_learn');
	}

	//send message feedback and report to admin via email
	public function SendReport()
	{
		$this->form_validation->set_rules('aSiteReportSubject','Subject','trim|required');
		$this->form_validation->set_rules('aSiteReportContent','Message','trim|required');
		if($this->form_validation->run()==FALSE)
			get_view('contactus','Contact Us | e_learn');
		else
		{
			//inserting record
			$rd=[
				'SiteReportSubject'=>$this->input->post('aSiteReportSubject'),
				'SiteReportContent'=>$this->input->post('aSiteReportContent'),
				'UserID'=>$this->session->UserID
			];
			$this->cm->SendReportData($rd);

			//mailing
			$spos=strpos(base_url(),'://');
			$Domain=substr(base_url(),$spos+3,strlen(base_url())-$spos-4);
			$MailTo='support@'.$Domain;
			$this->email->from($MailTo, 'TS');
			$this->email->to($MailTo);
			$this->email->subject($this->input->post('aSiteReportSubject'));
			$this->email->message($this->input->post('aSiteReportContent').'<br>UserEmail'.$this->session->UserEmail);
			$this->email->send();
			redirect('Home');
		}
	}
}
?>