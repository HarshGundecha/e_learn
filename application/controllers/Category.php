<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Category_m','cm');
/*        if(!$this->session->UserID)
		    redirect('Login');
*/	}
	
	public function index($CategoryID=false)
	{
		//get all category details
		$data['Category_Data']=$this->cm->getCategoryData();

		// if($CategoryID)
		// {
			//get Courses of pericular category
			$data['Course_Data']=$this->cm->getCourseData($CategoryID);
			//$data['Chapter_Data']=$this->cm->getCourseData($CourseID);
			get_view('category','Learn with e_learn',$data);
		// }
		// else
		// {
		// 	//get all category with course details 
		// 	$data=$this->cm->getCategoryData();
		// 	get_view('course','Learn with e_learn',$data);
		// }
	}
}