<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admin/Login_m','lm');
		if($this->session->AdminID)
		{
			redirect('admin/Admin');
		}
	}
	public function index()
	{
		$this->load->view('admin/login');
	}
	public function Login()
	{
		//$this->form_validation->set_rules('Field Name','User friendly name','required');
		$this->form_validation->set_rules('sEmail','Email','trim|required|valid_email');
		$this->form_validation->set_rules('sPassword','Password','trim|required|min_length[8]');
		if($this->form_validation->run()==FALSE)
		{
			$data['error']='Format Doesnot Match Of Username Or Password';
			$this->load->view('admin/login',$data);
		}
		else
		{
			$ad=array(
				'AdminEmail'=>$this->input->post('sEmail'),
				'AdminPassword'=>$this->input->post('sPassword'));
			$data=$this->lm->do_login($ad);
			if(count($data)===1)
			{
				if($data[0]->AdminStatus==1)
				{
					$data['error']='You Were Blocked By SuperAdmin';
					$this->load->view('admin/login',$data);					
				}
				else
				{
					$this->session->set_userdata('AdminID',$data[0]->AdminID);
					$this->session->set_userdata('AdminEmail',$data[0]->AdminEmail);
					$this->session->set_userdata('AdminName',$data[0]->AdminName);
					$this->session->set_userdata('AdminImage',$data[0]->AdminImage);
					$this->session->set_userdata('AdminLevel',$data[0]->AdminLevel);
					redirect('admin/Admin');
				}
			}
			else
			{
				$data['error']='Invalid Username Or Password';
				$this->load->view('admin/login',$data);
			}
		}
	}
}
?>