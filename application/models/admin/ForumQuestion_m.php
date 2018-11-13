<?php
class ForumQuestion_m extends CI_Model
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
			return $this->db->get('tbladmin')->result();
		}
		$this->db->select('*');
		$this->db->from('tblforumq fq');
		$this->db->join('tbluser u','fq.UserID=u.UserID');
		return $this->db->get()->result();
	}

	public function add_entity($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function update_entity($table, $data=false, $where=false)
	{
		if($data && $where)
		{
			$this->db->set($data);
			$this->db->where($where);
			$this->db->update($table);
		}
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

	public function get_question_data($id)
	{
		$where=null;
		$where['ForumQID'] = $id;
		$this->db->where($where);
		$fqd['question_data']=$this->db->get('tblforumq')->result()[0];

		$this->db->select('sum(VoteType) Vote');
		$where=null;
		$where=[
			'ForumQID' => $id,
			'VoteType' => 1
		];
		$this->db->where($where);
		$fqd['question_data']->UpVote=$this->db->get('tblforumqxvote')->result()[0]->Vote;

		$this->db->select('sum(VoteType) Vote');
		$where=null;
		$where=[
			'ForumQID' => $id,
			'VoteType' => -1
		];
		$this->db->where($where);
		$fqd['question_data']->DownVote=$this->db->get('tblforumqxvote')->result()[0]->Vote;

		$where=null;
		$where['UserID']=$fqd['question_data']->UserID;
		$this->db->where($where);
		$fqd['asker_data']=$this->db->get('tbluser')->result()[0];

		$where=null;
		$where['fa.ForumQID'] = $id;
		$this->db->select('fa.*, u.UserID , u.UserName , u.UserEmail , u.UserAvatar');
		$this->db->from('tblforuma fa');
		$this->db->join('tbluser u', 'fa.UserID=u.UserID');
		//$this->db->join('tblforumaxvote fv', 'fa.ForumAID=fv.ForumAID', 'left');
		$this->db->where($where);
		$fqd['answer_data']=$this->db->get()->result();

		foreach ($fqd['answer_data'] as $ad)
		{
			$this->db->select('sum(VoteType) Vote');
			$this->db->where(['ForumAID'=>$ad->ForumAID,'VoteType'=>1]);
			$ad->UpVote=$this->db->get('tblforumaxvote')->result()[0]->Vote;
			
			$this->db->select('sum(VoteType) Vote');
			$this->db->where(['ForumAID'=>$ad->ForumAID,'VoteType'=>-1]);
			$ad->DownVote=$this->db->get('tblforumaxvote')->result()[0]->Vote;
		}
		
		$this->db->select('*');
		$this->db->from('tbltag t');
		$this->db->join('tblforumqxtag qxt', 't.TagID=qxt.TagID');
		$this->db->where(['qxt.ForumQID'=>$id]);
		$fqd['tag_data']=$this->db->get()->result();
		
		return $fqd;
	}

	//toggle answer status
	public function toggle_answer_status($ForumAID)
	{
		$where=NULL;
		$where=['ForumAID'=>$ForumAID];
		$this->db->where($where);
		$this->db->set('ForumAStatus', '1-ForumAStatus', FALSE);
		$this->db->update('tblforuma');	
	}
}