<?php
class Challenge_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
		$data=$this->db->where($ud)->get('tbluser')->result();
		return $data; 
	}
	public function addChallenge($cd)
	{
		$this->db->insert('tblchallenge', $cd);
		return $this->db->insert_id();
	}

	public function getQuestions($UserID)
	{
		$data=$this->getUserLastChallenge($UserID);
		$data[0]->Questions=$this->db
			->where(['QuestionStatus'=>0])
			->order_by('', 'RANDOM')
			->limit(5)
			->get('tblquestion')
			->result();	
		foreach ($data[0]->Questions as $q)
		{
			$q->Options=$this->db
				->where(['QuestionID'=>$q->QuestionID])
				->get('	tblquestionxoption')
				->result();
		}		
		// echo '<pre>';
		// print_r($data);
		// die('hello');
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
			->order_by('ChallengeID', 'DESC')
			->limit(1)
			->get('tblchallenge')
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

	public function submitAnswers($qd)
	{
		$this->db->insert('tblquestionxanswer', $qd);
	}

	public function submitChallenge($cdata, $cwhere)
	{
		$this->db
			->set($cdata)
			->where($cwhere)
			->update('tblchallenge');
	}

	public function getChallengedUser($ChallengeID)
	{
		return $this->db
			->select('ReceiverID')
			->where(['ChallengeID'=>$ChallengeID])
			->get('tblchallenge')
			->result()[0]->ReceiverID;
	}

	public function addNotification($nd)
	{
		$this->db->insert('tblnotification', $nd);
	}
}