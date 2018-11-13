<?php
class Profile_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//get user data
	public function getUserData($UserID)
	{
		$where=[
			'UserID'=>$UserID
		];
		$this->db->where($where);
		$data=$this->db->get('tbluser');
		return $data->result();
	}
	
	//get PollID with PollXOptionID which is voted by perticular user
	public function getPollID($UserID)
	{
		$where=NULL;
		$where=[
			'UserID'=>$UserID
		];
		$this->db->where($where);
		$this->db->select('pxa.PollID, pxa.PollXOptionID, p.PollTitle, p.CreatedDateTime');
		$this->db->from('tblpollxanswer pxa');
		$this->db->join('tblpoll p','pxa.PollID=p.PollID');
		$data=$this->db->get()->result();
		return $data;
	}

	//get perticular Poll Data
	public function getPollData($PollID)
	{
		$where=NULL;
		$where=[
			'PollStatus'=>0,
			'PollID'=>$PollID
		];
		$this->db->where($where);
		$data=$this->db->get('tblpoll')->result();

		$where=NULL;
		$where=[
			'PollID'=>$data[0]->PollID
		];
		$this->db->where($where);
		$data[0]->OptionData=$this->db->get('tblpollxoption')->result();

		$data[0]->TotalVote=$this->db
			->select('count(PollID) TotalVote')
			->where([
				'PollID'=>$data[0]->PollID
			])
			->get('tblpollxanswer')->result()[0]->TotalVote;
		foreach ($data[0]->OptionData as $od)
		{
			$od->OptionCount=$this->db
				->select('count(PollID) OptionCount')
				->where([
					'PollXOptionID'=>$od->PollXOptionID
				])
				->get('tblpollxanswer')->result()[0]->OptionCount;
		}
		return $data;
	}

	//get follow or not to perticular user with logged in user
	public function getfollow($UserID)
	{
		$where=NULL;
		$where=[
			'FollowingID'=>$UserID,
			'FollowerID'=>$this->session->UserID
		];
		$this->db->where($where);
		$data=$this->db->get('tblfollow')->result();
		if(count($data)===1)
			return 'Follow';
		else
			return 'Not Follow';
	}

	//Delete Follow Data
	public function deleteFollow($where)
	{
		$this->db->delete('tblfollow',$where);
	}

	//Add Follow Data
	public function addFollow($insert_data)
	{
		$this->db->insert('tblfollow',$insert_data);
	}

	//get followers data
	public function getFollowers($UserID)
	{
		$where=NULL;
		$where=[
			'FollowingID'=>$UserID,
		];
		$this->db->where($where);
		$this->db->select('u.UserID, u.UserName, u.UserAvatar, u.UserXP');
		$this->db->from('tbluser u');
		$this->db->join('tblfollow f','u.UserID=f.FollowerID');
        $this->db->order_by('u.UserXP', 'DESC');
		$data=$this->db->get()->result();
		return $data;
	}
	
	//get following data
	public function getFollowing($UserID)
	{
		$where=NULL;
		$where=[
			'FollowerID'=>$UserID,
		];
		$this->db->where($where);
		$this->db->select('u.UserID, u.UserName, u.UserAvatar, u.UserXP');
		$this->db->from('tbluser u');
		$this->db->join('tblfollow f','u.UserID=f.FollowingID');
        $this->db->order_by('u.UserXP', 'DESC');
		$data=$this->db->get()->result();
		return $data;
	}

	//get question asked by perticular user
	public function getQuestion($UserID)
	{
		$where=NULL;
		$where=[
			'UserID'=>$UserID,
			'ForumQStatus'=>0
		];
		$this->db->where($where);
		$this->db->select('ForumQID, ForumQTitle, CreatedDateTime');
		// $this->db->from('tblpollxanswer pxa');
		// $this->db->join('tblpoll p','pxa.PollID=p.PollID');
		$this->db->order_by('CreatedDateTime', 'DESC');
		$data=$this->db->get('tblforumq')->result();
		return $data;
	}

	//get answer given by perticular user
	public function getAnswer($UserID)
	{
		$where=NULL;
		$where=[
			'UserID'=>$UserID,
			'ForumAStatus'=>0
		];
		$this->db->where($where);
		$this->db->select('ForumQID, ForumAContent, ForumAID, CreatedDateTime');
		// $this->db->from('tblpollxanswer pxa');
		// $this->db->join('tblpoll p','pxa.PollID=p.PollID');
		$this->db->order_by('CreatedDateTime', 'DESC');
		$data=$this->db->get('tblforuma')->result();
		return $data;
	}
}
?>