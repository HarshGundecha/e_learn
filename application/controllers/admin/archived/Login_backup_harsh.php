<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
    parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		if(isset($this->session->AdminID))
			redirect('admin/Admin');
		else
			$this->load->view('admin/Login');
	}

	public function login()
	{
		$this->load->library('Enum');
		if(!empty($this->input->post('sEmail')) && !empty($this->input->post('sPassword')))
		{
			$this->load->database();
			$query = $this->db->where('Email',$this->input->post('sEmail'))
				->where('Password',$this->input->post('sPassword'))
					->where('AdminStatus',$this->enum->exchangeOptions('adminstatus','active'))
						->get('tbladmin');
			if($query->num_rows()==1)
			{
				$this->session->set_userdata('AdminID', $query->result()[0]->AdminID);
				$this->session->set_userdata('AdminName', $query->result()[0]->AdminName);
				$this->session->set_userdata('Avatar', $query->result()[0]->Avatar);
				$this->session->set_userdata('Email', $query->result()[0]->Email);
				redirect('admin/Admin');
			}
			else
			{
				redirect('admin/Login');
			}
		}
		else
		{
			redirect('admin/Login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/Login');
	}
}