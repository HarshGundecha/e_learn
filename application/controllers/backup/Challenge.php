<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Challenge extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Challenge_m','cm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	public function index()
	{
		$data['Course_Data']=$this->cm->getCourseData();
		get_view('courselist','User | e_learn',$data);
	}

	//display user detail
	public function users($CourseID)
	{
		$ud=[
			'UserID !='=>$this->session->UserID
		];
		$data['User_Data']=$this->cm->getUserData($ud);
		$data['UserCount']=count($data['User_Data']);
		$data['CourseID']=$CourseID;
		get_view('userlist','User | e_learn',$data);
	}

	//start quiz //no views to be loaded redirect to play() 
	public function start($CourseID=FALSE, $UserID=FALSE)
	{
		if($CourseID && is_numeric($CourseID) && $UserID && is_numeric($UserID))
		{
			//insert into challenge code goes here
			$cd=[
				'SenderID'=>$this->session->UserID,
				'ReceiverID'=>$UserID,
				'CourseID'=>$CourseID
			];
			$this->cm->addChallenge($cd);
			redirect('Challenge/play');
		}
	}

	//play quiz 
	public function play()
	{
		// get 5 random questions of this users last challenge and pass to view
		$data['qData']=$this->cm->getQuestions($this->session->UserID);
		if(count($data['qData'])!=1)
			redirect('challenge');
		$data['qData']=$data['qData'][0];
		$data['qCount']=count($data['qData']->Questions);
		get_view('quiz','Quiz | e_learn', $data);
	}


	public function submit()
	{
		$UserID=null;
		$UserID=$this->session->UserID;
		$ChallengeData=$this->cm->getUserLastChallenge($UserID);
		$ChallengeID=null;
		$ChallengeID=$ChallengeData[0]->ChallengeID;
		$CourseID=null;
		$CourseID=$ChallengeData[0]->CourseID;
		$TotalXP=0;

		$qd=null;
		$qd=[
			'ChallengeID'=>$ChallengeID,
			'CourseID'=>$CourseID,
			'UserID'=>$UserID
		];

		foreach ($_POST as $ipk => $ipv)
		{
			if(substr($ipk,0,9)==="question-")
			{
				$XP=null;
				$XP=$this->cm->checkAnswer(substr($ipk,9),$ipv);
				$TotalXP+=$XP;

				$qd['QuestionID']=substr($ipk,9);
				$qd['QuestionXOptionID']=$ipv;
				$qd['QuestionXOptionPoint']=$XP;

				$this->cm->submitAnswers($qd);
			}
		}

		$cdata=['SenderXP'=>$TotalXP];
		$cwhere=['ChallengeID'=>$ChallengeID];
		$this->cm->submitChallenge($cdata, $cwhere);

		$nd=[
			'NotificationContent'=>'You have been challenged by '.$this->session->UserName.' in '.$coursename,
			'NotificationSenderID'=>$UserID,
			'NotificationReceiverID'=>$this->cm->getChallengedUser($ChallengeID),
			'NotificationRedirect'=>'/challenge/????????', //path to be passed inside site_url()
		];
		#$this->cm->addNotification($nd);

		redirect('challenge');
	}
}
?>