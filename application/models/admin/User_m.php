<?php
class User_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($where=FALSE)
	{
		if($where)
		{
			$this->db->where($where);
			return $this->db->get('tbluser')->result();
		}
		// $this->db->select('*');
		// $this->db->from('tblforumq fq');
		// $this->db->join('tbluser u','fq.UserID=u.UserID');
		// return $this->db->get()->result();
		return $this->db->get('tbluser')->result();
	}

	public function toggle_entity_status($table, $data=false, $where=false)
	{
		if($data && $where)
		{
			$this->db->set($data, '', FALSE);
			$this->db->where($where);
			$this->db->update($table);
		}
	}

	public function get_user_data($id)
	{
		$where=null;
		$where['UserID'] = $id;
		$this->db->where($where);
		$ud['user_data']=$this->db->get('tbluser')->result();
		
		// use (left)join to get question with total votes in single query instead of foreach
		$where=null;
		$where['UserID'] = $id;
		$this->db->where($where);
		$ud['question_data']=$this->db->get('tblforumq')->result();
		//count of Likes of Question
		foreach ($ud['question_data'] as $uvd)
		{
			$where=NULL;
			$this->db->select('count(ForumQXVoteID) TotalLike');
			$this->db->where(['ForumQID'=>$uvd->ForumQID, 'VoteType'=>1]);
			$uvd->TotalLike=$this->db->get('tblforumqxvote')->result()[0]->TotalLike;
		}
		//count of Dis-Likes of Question
		foreach ($ud['question_data'] as $uvd)
		{
			$where=NULL;
			$this->db->select('count(ForumQXVoteID) TotalDisLike');
			$this->db->where(['ForumQID'=>$uvd->ForumQID, 'VoteType'=>-1]);
			$uvd->TotalDisLike=$this->db->get('tblforumqxvote')->result()[0]->TotalDisLike;
		}
		//Count of answer of Question
		foreach ($ud['question_data'] as $uvd)
		{
			$where=NULL;
			$this->db->select('count(ForumAID) Answer');
			$this->db->where(['ForumQID'=>$uvd->ForumQID]);
			$uvd->Answer=$this->db->get('tblforuma')->result()[0]->Answer;
		}

		//User Answers
		$where=null;
		$where['UserID'] = $id;
		$this->db->where($where);
		$ud['answer_data']=$this->db->get('tblforuma')->result();
		//count of Likes of Answers
		foreach ($ud['answer_data'] as $uvd)
		{
			$where=NULL;
			$this->db->select('count(ForumAXVoteID) TotalLike');
			$this->db->where(['ForumAID'=>$uvd->ForumAID, 'VoteType'=>1]);
			$uvd->TotalLike=$this->db->get('tblforumaxvote')->result()[0]->TotalLike;
		}
		//count of Dis-Likes of Answers
		foreach ($ud['answer_data'] as $uvd)
		{
			$where=NULL;
			$this->db->select('count(ForumAXVoteID) TotalDisLike');
			$this->db->where(['ForumAID'=>$uvd->ForumAID, 'VoteType'=>-1]);
			$uvd->TotalDisLike=$this->db->get('tblforumaxvote')->result()[0]->TotalDisLike;
		}
			

		return $ud;

		// echo '<pre>';
		// print_r($ud);
		// echo '</pre>';
		// die('hello');
	}

}