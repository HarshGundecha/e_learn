<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poll extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Poll_m','pm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	
	public function index($PollID=false)
	{
		if($PollID)
		{
			//get details of pericular ForumQuestion
			$data=$this->pm->getPollData($PollID);
			$data[0]->TotalVote=$this->pm->getCount($PollID);
			$data[0]->UserVote=$this->pm->getVote($PollID);
			$data['Poll_Data']=$data;
			get_view('polldetail','Poll | e_learn',$data);
		}
		else
		{
			//get all ForumQuestion details
			$data['Poll_Data']=$this->pm->getPollData();
			get_view('poll','Poll | e_learn',$data);
		}
	}

	//add vote of a user
	public function AddVote($PollID)
	{
		// echo "<pre>";
		// print_r();
		// echo "</pre>";
		// die();
		$PollXOptionID=$this->input->post('PollAnswer');
		$this->pm->Add($PollXOptionID,$PollID);
		redirect('Poll/'.$PollID);
	}

	//Toggle upvote of answer
	/*public function ansupvote($ForumAnswerID)
	{
		$this->pm->toggle_ans_upvote($ForumAnswerID);
		
		$UpVoteCount=$this->pm->getAnsCount($ForumAnswerID,1);
		$Color=$this->pm->getAnsColor($ForumAnswerID,1);
		if($Color===0)
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		else
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:black;"></i></span>';
		
		$DownVoteCount=$this->pm->getAnsCount($ForumAnswerID,-1);
		$Color=$this->pm->getAnsColor($ForumAnswerID,-1);
		if($Color===1)
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:black;"></i></span>';
		else
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';
	}*/

	//Toggle downvote of answer
	/*public function ansdownvote($ForumAnswerID)
	{
		$this->pm->toggle_ans_downvote($ForumAnswerID);
		
		$UpVoteCount=$this->pm->getAnsCount($ForumAnswerID,1);
		$Color=$this->pm->getAnsColor($ForumAnswerID,1);
		if($Color===1)
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:black;"></i></span>';
		else
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		
		$DownVoteCount=$this->pm->getAnsCount($ForumAnswerID,-1);
		$Color=$this->pm->getAnsColor($ForumAnswerID,-1);
		if($Color===1)
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:black;"></i></span>';					
		else
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';						
	}*/

	//Toggle upvote of question
	/*public function funupvote($PollID)
	{
		$this->pm->toggle_upvote($PollID);
		
		$UpVoteCount=$this->pm->getCount($PollID,1);
		$Color=$this->pm->getColor($PollID,1);
		if($Color===0)
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		else
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;"></i></span>';					
		
		$DownVoteCount=$this->pm->getCount($PollID,-1);
		$Color=$this->pm->getColor($PollID,-1);
		if($Color===1)
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;"></i></span>';
		else
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';
	}*/

	//Toggle downvote of question
	/*public function fundownvote($PollID)
	{
		$this->pm->toggle_downvote($PollID);
		
		$UpVoteCount=$this->pm->getCount($PollID,1);
		$Color=$this->pm->getColor($PollID,1);
		if($Color===1)
			echo '<span id="btnupvote"  class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;"></i></span>';					
		else
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';					
		
		$DownVoteCount=$this->pm->getCount($PollID,-1);
		$Color=$this->pm->getColor($PollID,-1);
		if($Color===1)
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;"></i></span>';					
		else
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';						
	}*/

	//Add Answer
	/*public function addans($ForumQID)
	{
		$this->form_validation->set_rules('aAnswer', 'Answer', 'trim|required');
		if ($this->form_validation->run() == FALSE)
			redirect('ForumQuestion/index/'.$ForumQID,'Q&A | e_learn');
		else
		{
			$insert_data =[
				'ForumQID' => $ForumQID,
				'UserID' => $this->session->UserID,
				'ForumAContent' => $this->input->get_post('aAnswer'),
			];
			$this->pm->addanswer($insert_data);
			redirect('ForumQuestion/index/'.$ForumQID,'Q&A | e_learn');
		}
	}*/
}