<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Course_m','cm');
		if(!$this->session->UserID)
			redirect('Login');
	}
	
	public function index($CourseID=false)
	{
		if($CourseID)
		{
			//get perticular course details
			$data['Course_Data']=$this->cm->getCourseData($CourseID);
			$data['Chapter_Data']=$this->cm->getChapterData($CourseID);
			if(count($data['Course_Data'])==0)
				get_view('error_404','Page Not Found');
			else
			{
				$data['Course_Data']=$data['Course_Data'][0];
				get_view('course','Learn with e_learn',$data);
			}
		}
		else
			get_view('error_404','Page Not Found');
	}
}