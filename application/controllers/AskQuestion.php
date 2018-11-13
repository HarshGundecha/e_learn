<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AskQuestion extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('AskQuestion_m','am');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	public function index()
	{
	    $data['TagData']=$this->am->getTags();
		get_view('askquestion','Solve Your Doubt',$data);
	}

	//add Question
	public function addquestion()
	{	
		$validation = [
			[
				'field' => 'aQuestionContent',
				'label' => 'Question Content',
				'rules' => 'trim|required'
			],
			[
				'field' => 'aQuestionTitle',
				'label' => 'Question Title',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
			redirect('AskQuestion/');
		else
		{
			$insert_data =[
				'ForumQTitle' => $this->input->get_post('aQuestionTitle'),
				'ForumQContent' => $this->input->get_post('aQuestionContent'),
				'UserID' => $this->session->UserID,
			];
			$id=$this->am->addquestion($insert_data);
			$td=$this->input->post('tag');
			if($td!=NULL)
			{
				foreach ($td as $td2k => $td2v)
				{
					$tagD=null;
					$tagD=[
						'ForumQID'=>$id,
						'TagID'=>$td2v
					];
					$this->am->add_entity('tblforumqxtag', $tagD);
				}
			}
			redirect('ForumQuestion/'.$id);
		}
	}
}
?>