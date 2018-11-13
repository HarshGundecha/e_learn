<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Section_m','sm');
		if(!$this->session->UserID)
			redirect('Login');
	}
	
	public function index($SectionID)
	{
		if($SectionID)
		{
			$data=$this->sm->getSectionData($SectionID);
			if(count($data['Section_Data'])==0)
				get_view('error_404','Page Not Found');
			else
				get_view('section','Learn with e_learn',$data);
		}
		else
			get_view('error_404','Page Not Found');
	}
}