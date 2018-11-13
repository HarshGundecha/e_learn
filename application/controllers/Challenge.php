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
	public function index($id=false)
	{
		if($id)
		{
			$data['ReceiverData']=$this->cm->getSenderChallengeData($id);
			$data['qCount']=count($data['ReceiverData']);
			get_view('challengehistorydetail','Challenge History | e_learn',$data);
		}
		else
		{
			$data=$this->cm->getHistoryData();
			get_view('challengehistory','Challenge History | e_learn',$data);
		}
	}

	// deprecated on 10-04-2018, to be removed soon, use index() with arguement instead
	//Load Detail Of Perticular Challenge
	public function ViewDetailSender($ChallengeID)
	{
		// $data['qData']=$this->cm->getQuestions($this->session->UserID, $CID);
		// $data['qCount']=count($data['qData']);
		// $data['CID']=$CID;
	

		$data['ReceiverData']=$this->cm->getSenderChallengeData($ChallengeID);
		$data['qCount']=count($data['ReceiverData']);
		get_view('challengehistorydetail','Challenge History | e_learn',$data);
	}

	//Select Course
	public function course()
	{
		//die($this->session->UserID);
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
		$data['FollowersData']=$this->cm->getFollowers();
		$data['FollowersCount']=count($data['FollowersData']);
		$data['FollowingData']=$this->cm->getFollowing();
		$data['FollowingCount']=count($data['FollowingData']);
		$data['CourseID']=$CourseID;
		get_view('userlist','User | e_learn',$data);
	}

	//start quiz //no views to be loaded redirect to play() 
	public function start($CID=FALSE, $UserID=FALSE)
	{
		if($CID && is_numeric($CID) && $UserID && is_numeric($UserID))
		{
			//insert into challenge code goes here
			$cd=[
				'SenderID'=>$this->session->UserID,
				'ReceiverID'=>$UserID,
				'CourseID'=>$CID
			];
			$ChallengeID=$this->cm->addChallenge($cd);
			$this->cm->setQuestions($ChallengeID, $CID, $this->session->UserID);
			redirect('Challenge/play');
		}
/*		elseif($CID && is_numeric($CID))
		{
			$this->cm->setQuestions($CID);
			redirect('Challenge/play/'.$CID);
		}*/

	}

	//play quiz 
	public function play($CID=false)
	{
		$data['qData']=$this->cm->getQuestions($this->session->UserID, $CID);
		if(count($data['qData'])<1)
			redirect('challenge');
		//$data['qData']=$data['qData'][0];
		$data['qCount']=count($data['qData']);
		$data['CID']=$CID;
		get_view('quiz','Quiz | e_learn', $data);
	}

	public function submit($ChallengeID2=false)
	{
		$this->load->model('Notification_m', 'nm');
		if($ChallengeID2 && is_numeric($ChallengeID2))
		{
			$UserID=$ChallengeID=$CourseID=$qd=null;
			$UserID=$this->session->UserID;
			$ChallengeData=$this->cm->getUserLastChallenge2($ChallengeID2);
			$ChallengeID=$ChallengeData[0]->ChallengeID;
			$CourseID=$ChallengeData[0]->CourseID;
			$CourseName=$ChallengeData[0]->CourseName;
			$TotalXP=0;

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

			$cdata=['ReceiverXP'=>$TotalXP];
			$cwhere=['ChallengeID'=>$ChallengeID];
			$this->cm->submitChallenge($cdata, $cwhere);

			$cwhere=$cdata=null;
			$cdata="UserXP+".$TotalXP;
			$cwhere=['UserID'=>$UserID];
			$this->cm->updateXP($cdata, $cwhere);

			$nd=[
				'NotificationContent'=>$this->session->UserName.' completed challenge in '.$CourseName,
				'NotificationSenderID'=>$UserID,
				'NotificationReceiverID'=>$this->cm->getChallengedUser($ChallengeID)->SenderID,
				'NotificationRedirect'=>'/challenge/'.$ChallengeID, //path to be passed inside site_url()
			];
			$this->nm->addNotification($nd);

			redirect('challenge/'.$ChallengeID2);
		}
		else
		{
			$UserID=$ChallengeID=$CourseID=$qd=null;
			$UserID=$this->session->UserID;
			$ChallengeData=$this->cm->getUserLastChallenge($UserID);
			$ChallengeID=$ChallengeData[0]->ChallengeID;
			$CourseID=$ChallengeData[0]->CourseID;
			$CourseName=$ChallengeData[0]->CourseName;
			$TotalXP=0;

			$wqd=[
				'ChallengeID'=>$ChallengeID,
				'CourseID'=>$CourseID,
				'UserID'=>$UserID
			];
			//print_r($wqd);
			foreach ($_POST as $ipk => $ipv)
			{
				if(substr($ipk,0,9)==="question-")
				{
					$XP=$sqd=null;
					$XP=$this->cm->checkAnswer(substr($ipk,9),$ipv);
					$TotalXP+=$XP;

					$wqd['QuestionID']=substr($ipk,9);
					$sqd=[];
					$sqd['QuestionXOptionID']=$ipv;
					$sqd['QuestionXOptionPoint']=$XP;

					$this->cm->submitAnswers($wqd, $sqd);
					//print_r($sqd);
					//echo '<br><br>';
				}
			}
			//die('hello');
			$cdata=['SenderXP'=>$TotalXP];
			$cwhere=['ChallengeID'=>$ChallengeID];
			$this->cm->submitChallenge($cdata, $cwhere);

			$cwhere=$cdata=null;
			$cdata="UserXP+".$TotalXP;
			$cwhere=['UserID'=>$UserID];
			$this->cm->updateXP($cdata, $cwhere);

			$nd=[
				'NotificationContent'=>'You have been challenged by '.$this->session->UserName.' in '.$CourseName,
				'NotificationSenderID'=>$UserID,
				'NotificationReceiverID'=>$this->cm->getChallengedUser($ChallengeID)->ReceiverID,
				'NotificationRedirect'=>'/challenge/play/'.$ChallengeID, //path to be passed inside site_url()
			];
			$this->nm->addNotification($nd);
			redirect('challenge/'.$ChallengeID);
		}
	}
}
?>