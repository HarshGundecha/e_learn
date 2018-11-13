<?php
class Poll_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($where=FALSE)
	{
		if($where)
			$this->db->where($where);
		$this->db->select('a1.*,a2.AdminName AddedByAdminName');
		$this->db->from('tblpoll a1');
		$this->db->join('tbladmin a2', 'a1.AddedByAdminID=a2.AdminID');
		//$this->db->join('tblchapter a3', 'a1.ChapterID=a3.ChapterID');
		$data=$this->db->get()->result();
		//$data['chapter_data']=$this->db->get('tblchapter')->result();
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// die('hello');
		return $data;
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

	public function get_poll_data($where=false)
	{
		$this->db->select('*');
		$this->db->from('tblpoll');
		$this->db->join('tbladmin', 'tblpoll.AddedByAdminID=tbladmin.AdminID');
		if($where)
			$this->db->where($where);
		$pd=$this->db->get()->result();

		$now1 = strtotime ($pd[0]->PollStartDate);
		$now2 = strtotime('today midnight');
		$pd[0]->PollStartStatus = ($now1 - $now2)/(24*60*60);

		$now1 = strtotime ($pd[0]->PollEndDate);
		$now2 = strtotime('today midnight');
		$pd[0]->PollEndStatus = ($now1 - $now2)/(24*60*60);

		$this->db->where($where);
		$pd[0]->OptionData=$this->db->get('tblpollxoption')->result();

		if($pd[0]->PollStartStatus<0)//
		{
			$pd[0]->TotalVote=$this->db
				->select('count(PollID) TotalVote')
				->where([
					'PollID'=>$pd[0]->PollID
				])
				->get('tblpollxanswer')->result()[0]->TotalVote;
			foreach ($pd[0]->OptionData as $od) {
				$od->OptionCount=$this->db
					->select('count(PollID) OptionCount')
					->where([
						'PollXOptionID'=>$od->PollXOptionID
					])
					->get('tblpollxanswer')->result()[0]->OptionCount;
			}
		}


		// echo '<pre>';
		// print_r($pd[0]);
		// die('hello');

		return $pd;

	}

	public function deleteoptiondata($where=false)
	{
		if($where)
		{
			$this->db->where($where);
			$this->db->delete('tblpollxoption');
		}
	}

	public function updatepolldata($polldata=false,$where=false)
	{
		if($polldata && $where)
		{
			$this->db->set($polldata);
			$this->db->where($where);
			$this->db->update('tblpoll');
		}
	}

	public function addpolloptiondata($polloptiondata=false)
	{
		$this->db->insert('tblpollxoption', $polloptiondata);
	}
}