<?php
class Challenge_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get followers data
	public function getFollowers()
	{
		$where=NULL;
		$where=[
			'FollowingID'=>$this->session->UserID,
		];
		$this->db->where($where);
		$this->db->select('u.UserID, u.UserName, u.UserAvatar, u.UserXP');
		$this->db->from('tbluser u');
		$this->db->join('tblfollow f','u.UserID=f.FollowerID');
		$data=$this->db->get()->result();
		return $data;
	}

	//get following data
	public function getFollowing()
	{
		$where=NULL;
		$where=[
			'FollowerID'=>$this->session->UserID,
		];
		$this->db->where($where);
		$this->db->select('u.UserID, u.UserName, u.UserAvatar, u.UserXP');
		$this->db->from('tbluser u');
		$this->db->join('tblfollow f','u.UserID=f.FollowingID');
		$data=$this->db->get()->result();
		return $data;
	}

	//get Challenge History data
	public function getHistoryData()
	{
		$where=NULL;
		$where=[
			'ReceiverID'=>$this->session->UserID,
			'SenderID'=>$this->session->UserID,
		];
		$this->db->or_where($where);
		$this->db->select('ch.*, u.UserID, u.UserName, u.UserAvatar, co.CourseName, co.CourseImage');
		$this->db->from('tblchallenge ch');
		$this->db->join('tbluser u','u.UserID=ch.ReceiverID');
		$this->db->join('tblcourse co','co.CourseID=ch.CourseID');
		// $this->db->join('tblquestionxanswer qxa','qxa.ChallengeID=ch.ChallengeID','left');
		$data['SenderData']=$this->db->get()->result();
		// foreach ($data['SenderData'] as $sd)
		// {
		// 	$where=NULL;
		// 	$where=[
		// 		'ChallengeID'=>$sd->ChallengeID,
		// 	];
		// 	$this->db->where($where);
		// 	$this->db->select('QuestionID');
		// 	$QXP=NULL;
		// 	$QXP=$this->db->get()->result();
			
		// 	foreach ($QXP as $key)
		// 	{
		// 		$where=NULL;
		// 		$where=[
		// 			'QuestionID'=>$key->QuestionID,
		// 		];
		// 		$this->db->where($where);
		// 		$this->db->select('sum(QuestionPoint) TotalXP');
		// 		// $this->db->from('tblquestion q');
		// 		// $this->db->join('tblquestionxanswer qxa','qxa');
		// 		$XP=NULL;
		// 		$XP=$this->db->get('tblquestion')->result();
		// 		$sd->TotalXP=$XP[0]->TotalXP;
		// 	}
		// }

		/*
		$where=NULL;
		$where=[
			'ReceiverID'=>$this->session->UserID,
		];
		$this->db->where($where);
		$this->db->select('ch.*, u.UserID, co.CourseName, co.CourseImage');
		$this->db->from('tblchallenge ch');
		$this->db->join('tbluser u','u.UserID=ch.ReceiverID');
		$this->db->join('tblcourse co','co.CourseID=ch.CourseID');
		$data['ReceiverData']=$this->db->get()->result();
		*/
		
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		return $data;
	}

	//get perticular detailed challenge of sender
	public function getSenderChallengeData($ChallengeID)
	{
		$where=NULL;
		$where=[
			'ChallengeID'=>$ChallengeID,
			'UserID'=>$this->session->UserID
		];
		$this->db->where($where);
		$this->db->select('qxa.*, q.QuestionContent, q.QuestionPoint');
		$this->db->from('tblquestionxanswer qxa');
		$this->db->join('tblquestion q','q.QuestionID=qxa.QuestionID');
		$data=$this->db->get()->result();
		foreach ($data as $rd)
		{
			$where=NULL;
			$where=[
				'QuestionID'=>$rd->QuestionID,
			];
			$this->db->where($where);
			$this->db->select('QuestionXOptionID, QuestionXOptionContent, IsAnswer');
			$rd->OptionData=$this->db->get('tblquestionxoption')->result();
		}
		return $data;
	}

	//get courses list
	public function getCourseData()
	{
		$where=[
			'CourseStatus'=>0
		];
		$this->db->where($where);
		$data=$this->db->get('tblcourse')->result();
		return $data; 
	}

	//get users list
	public function getUserData($ud)
	{
		return $this->db->where($ud)->get('tbluser')->result();
	}
	public function addChallenge($cd)
	{
		$this->db->insert('tblchallenge', $cd);
		return $this->db->insert_id();
	}

	public function setQuestions($ChallengeID=FALSE, $CourseID=FALSE, $UserID=FALSE)
	{
		if($ChallengeID && is_numeric($ChallengeID) && $CourseID && is_numeric($CourseID) && $UserID && is_numeric($UserID) )
		{
			$qData=$this->db
				->select('QuestionID')
				->where([
					'QuestionStatus'=>0,
					'CourseID'=>$CourseID
					])
				->order_by('', 'RANDOM')
				->limit(5)
				->get('tblquestion')
				->result();
		}
/*		elseif($ChallengeID && is_numeric($ChallengeID))
		{
			$qData=$this->db
				->select('QuestionID')
				->where([
					'ChallengeID'=>$ChallengeID
					])
				->get('tblquestionxanswer')
				->result();
			$CourseID=$qData[0]->CourseID;
			$UserID=$this->session->UserID;
		}*/
		$cd=null;
		$cd=[
			'ChallengeID'=>$ChallengeID,
			'CourseID'=>$CourseID,
			'UserID'=>$UserID
		];
		foreach ($qData as $q)
		{
			$cd['QuestionID']=$q->QuestionID;
			$q->Options=$this->db->insert('tblquestionxanswer', $cd);
		}
	}

	public function getQuestions($UserID=false, $CID=false)
	{
		if($UserID && is_numeric($UserID) && $CID && is_numeric($CID))
		{
			//$data=$this->getUserLastChallenge($UserID);
			$data=$this->db
				->where(['ChallengeID'=>$CID])
				->where('ReceiverXP is null')
				->get('tblchallenge')
				->result();
			if(count($data)>0)
			{
				$data=$this->db
					->where('QuestionStatus=0 and QuestionID in (select QuestionID from tblquestionxanswer where ChallengeID = '.$CID.')')
					->get('tblquestion')
					->result();
			}
			else
				return [];
		}
		elseif($UserID && is_numeric($UserID))
		{
			//$data=$this->getUserLastChallenge($UserID);
			$data=$this->db
				->where('QuestionStatus=0 and QuestionID in (select QuestionID from tblquestionxanswer where ChallengeID = (select ChallengeID from tblchallenge where SenderID='.$UserID.' and SenderXP is null ORDER BY ChallengeID DESC LIMIT 1))')
				->get('tblquestion')
				->result();
		}
		foreach ($data as $q)
		{
			$q->Options=$this->db
				->where(['QuestionID'=>$q->QuestionID])
				->get('	tblquestionxoption')
				->result();
		}
		return $data;
	}

	public function getUserLastChallenge($id)
	{
		return $this->db
			->where([
				'SenderID'=>$id,
				'SenderXP'=>null,
				'ReceiverXP'=>null,
			])
			->from('tblchallenge')
			->join('tblcourse', 'tblchallenge.CourseID=tblcourse.CourseID')
			->order_by('ChallengeID', 'DESC')
			->limit(1)
			->get()
			->result();
	}

	public function getUserLastChallenge2($id)
	{
		return $this->db
			->where([
				'ChallengeID'=>$id,
			])
			->from('tblchallenge')
			->join('tblcourse', 'tblchallenge.CourseID=tblcourse.CourseID')
			->get()
			->result();
	}

	public function checkAnswer($qid, $oid)
	{
		$qp=null;
		$qp=$this->db
			->select('QuestionPoint')
			->where(['QuestionID'=>$qid])
			->get('tblquestion')
			->result()[0]->QuestionPoint;

		$isa=null;
		$isa=$this->db
			->select('IsAnswer')
			->where(['QuestionXOptionID'=>$oid])
			->get('tblquestionxoption')
			->result()[0]->IsAnswer;

		return $isa==1?$qp:-$qp;
	}

	public function submitAnswers($wqd=false, $sqd=false)
	{
		if($wqd && is_array($wqd) && $sqd && is_array($sqd))
		{
			$this->db
				->set($sqd)
				->where($wqd)
				->update('tblquestionxanswer');
		}
		elseif($wqd && is_array($wqd))
		{
			$this->db
				->insert('tblquestionxanswer', $wqd);
		}
		//echo $this->db->last_query().'<br><br>';
	}

	public function submitChallenge($cdata, $cwhere)
	{
		$this->db
			->set($cdata)
			->where($cwhere)
			->update('tblchallenge');
	}

	public function updateXP($cdata, $cwhere)
	{
		$this->db
			->set('UserXP', $cdata, false)
			->where($cwhere)
			->update('tbluser');
	}

	public function getChallengedUser($ChallengeID)
	{
		return $this->db
			->where(['ChallengeID'=>$ChallengeID])
			->get('tblchallenge')
			->result()[0];
	}
}