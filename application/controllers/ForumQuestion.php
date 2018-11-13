<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForumQuestion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ForumQuestion_m','qm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	
	public function index($ForumQuestionID=false)
	{
		// die($ForumQuestionID);
		if($ForumQuestionID)
		{
			//get details of pericular ForumQuestion
			$data=$this->qm->getQuestionData($ForumQuestionID);
			$data['UserData']=$this->qm->getUserData();
			get_view('forumquestiondetail','Q&A | e_learn',$data);
		}
		else
		{
			//get all ForumQuestion details
			$data=$this->qm->getQuestionData();
			$data['UserData']=$this->qm->getUserData();
			$data['TagData']=$this->qm->getTagData();
			get_view('forumquestion','Q&A | e_learn',$data);
		}
	}
	
	//add correct answer vote
	public function AddCorrectAnswer($ForumQID=FALSE, $ForumAID=FALSE)
	{
	    if($ForumQID==FALSE || $ForumAID==FALSE)
	        redirect('Error_404');
	    else
	    {
			$this->qm->AddRightAnswer($ForumQID, $ForumAID);
			$this->index($ForumQID);
	    }
	}
	
	//filter Question by tags
    public function filter($TagID=FALSE)
	{
	    //$this->form_validation->set_rules('tag','Tag','required');
		if($TagID==FALSE)
		{
			$data=$this->qm->getQuestionData();
			$data['UserData']=$this->qm->getUserData();
			$data['TagData']=$this->qm->getTagData();
			$data['error']='Select Any Tag First';
			get_view('forumquestion','Q&A | e_learn',$data);
		}
		else
		{
    		//get filtered Question details
    		$data=$this->qm->getFilteredQuestionData($TagID);
    		$data['UserData']=$this->qm->getUserData();
			$data['TagData']=$this->qm->getTagData();
    		get_view('forumquestion','Q&A | e_learn',$data);
		}	
	}

	//Toggle upvote of answer
	public function ansupvote($ForumAnswerID)
	{
		$this->qm->toggle_ans_upvote($ForumAnswerID);
		
		$UpVoteCount=$this->qm->getAnsCount($ForumAnswerID,1);
		$Color=$this->qm->getAnsColor($ForumAnswerID,1);
		if($Color===0)
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		else
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:black;"></i></span>';
		
		$DownVoteCount=$this->qm->getAnsCount($ForumAnswerID,-1);
		$Color=$this->qm->getAnsColor($ForumAnswerID,-1);
		if($Color===1)
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:black;"></i></span>';
		else
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';
	}

	//Toggle downvote of answer
	public function ansdownvote($ForumAnswerID)
	{
		$this->qm->toggle_ans_downvote($ForumAnswerID);
		
		$UpVoteCount=$this->qm->getAnsCount($ForumAnswerID,1);
		$Color=$this->qm->getAnsColor($ForumAnswerID,1);
		if($Color===1)
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:black;"></i></span>';
		else
			echo ' <span id="AnsUpVote" style="display:inline-block;"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		
		$DownVoteCount=$this->qm->getAnsCount($ForumAnswerID,-1);
		$Color=$this->qm->getAnsColor($ForumAnswerID,-1);
		if($Color===1)
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:black;"></i></span>';					
		else
			echo ' <span id="AnsDownVote" style="display:inline-block;"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';						
	}

	//Toggle upvote of question
	public function funupvote($ForumQuestionID)
	{
		$this->qm->toggle_upvote($ForumQuestionID);
		
		$UpVoteCount=$this->qm->getCount($ForumQuestionID,1);
		$Color=$this->qm->getColor($ForumQuestionID,1);
		if($Color===0)
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';
		else
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;"></i></span>';					
		
		$DownVoteCount=$this->qm->getCount($ForumQuestionID,-1);
		$Color=$this->qm->getColor($ForumQuestionID,-1);
		if($Color===1)
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;"></i></span>';
		else
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';
	}

	//Toggle downvote of question
	public function fundownvote($ForumQuestionID)
	{
		$this->qm->toggle_downvote($ForumQuestionID);
		
		$UpVoteCount=$this->qm->getCount($ForumQuestionID,1);
		$Color=$this->qm->getColor($ForumQuestionID,1);
		if($Color===1)
			echo '<span id="btnupvote"  class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;"></i></span>';					
		else
			echo '<span id="btnupvote" class="btnupvote"> '.$UpVoteCount.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i></span>';					
		
		$DownVoteCount=$this->qm->getCount($ForumQuestionID,-1);
		$Color=$this->qm->getColor($ForumQuestionID,-1);
		if($Color===1)
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;"></i></span>';					
		else
			echo '<span id="btndownvote" class="btndownvote"> '.$DownVoteCount.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i></span>';						
	}

	//Add Answer
	public function addans($ForumQID)
	{
		$this->form_validation->set_rules('aAnswer', 'Answer', 'trim|required');
		if ($this->form_validation->run() == FALSE)
			redirect('ForumQuestion/'.$ForumQID,'Q&A | e_learn');
		else
		{
		    $Answer=htmlentities($this->input->get_post('aAnswer'));
			$insert_data =[
				'ForumQID' => $ForumQID,
				'UserID' => $this->session->UserID,
				'ForumAContent' => $Answer,
			];
			$ForumAID=$this->qm->addanswer($insert_data);

			$data=$this->qm->getQuestionInfo($ForumQID);
			if(count($data)==1)
			{
				$ForumQTitle=$data[0]->ForumQTitle;
				$QuestionAskerID=$data[0]->UserID;
				$this->load->model('Notification_m', 'nm');
				$nd=[
					'NotificationContent'=>$this->session->UserName.' answered your question " '.$ForumQTitle,
					'NotificationSenderID'=>$this->session->UserID,
					'NotificationReceiverID'=>$QuestionAskerID,
					'NotificationRedirect'=>'/ForumQuestion/'.$ForumQID.'#answer-'.$ForumAID, //path to be passed inside site_url()
				];
				$notID=$this->nm->addNotification($nd);
				
				$this->email->from('your_mail_here', 'name');
				$this->email->to($data[0]->UserEmail);
				$this->email->subject('You Got Answer | e_learn');
				$this->email->message($this->session->UserName.' answered your question " '.$ForumQTitle);
				$this->email->send();
			}
			redirect('ForumQuestion/'.$ForumQID.'#answer-'.$ForumAID,'Q&A | e_learn');
		}
	}
}