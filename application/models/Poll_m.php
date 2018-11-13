<?php
class Poll_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get perticular Question data
	public function getPollData($PollID=FALSE)
	{
		if($PollID)
		{
			//Poll Data
			$where=null;
			$where['PollID']=$PollID;
			$this->db->where($where);
			$data=$this->db->get('tblpoll')->result();
			
			$now1 = strtotime ($data[0]->PollStartDate);
			$now2 = strtotime('today midnight');
			$data[0]->PollStartStatus = ($now1 - $now2)/(24*60*60);

			$now1 = strtotime ($data[0]->PollEndDate);
			$now2 = strtotime('today midnight');
			$data[0]->PollEndStatus = ($now1 - $now2)/(24*60*60);

			$where=NULL;
			$where=[
				'PollID'=>$data[0]->PollID
			];

			$this->db->where($where);
			$data[0]->OptionData=$this->db->get('tblpollxoption')->result();

			if($data[0]->PollStartStatus<0)//
			{
				// $data[0]->TotalVote=$this->db
				// 	->select('count(PollID) TotalVote')
				// 	->where([
				// 		'PollID'=>$data[0]->PollID
				// 	])
				// 	->get('tblpollxanswer')->result()[0]->TotalVote;
				foreach ($data[0]->OptionData as $od) {
					$od->OptionCount=$this->db
						->select('count(PollID) OptionCount')
						->where([
							'PollXOptionID'=>$od->PollXOptionID
						])
						->get('tblpollxanswer')->result()[0]->OptionCount;
				}
			}
		}
		else
		{
			$where=null;
			$where['p.PollStatus']=0;
			$this->db->where($where);
			$this->db->select('p.*, count(pxa.PollID) TotalVote');
			$this->db->from('tblpoll p');
			$this->db->join('tblpollxanswer pxa','p.PollID=pxa.PollID','left');
			$this->db->group_by('pxa.PollID');
			$this->db->order_by('p.PollEndDate');
			$data=$this->db->get()->result();
			$where=null;
			foreach ($data as $pd)
			{
				$now1 = strtotime ($pd->PollStartDate);
				$now2 = strtotime('today midnight');
				$pd->PollStartStatus = ($now1 - $now2)/(24*60*60);

				$now1 = strtotime ($pd->PollEndDate);
				$now2 = strtotime('today midnight');
				$pd->PollEndStatus = ($now1 - $now2)/(24*60*60);

				$where=NULL;
				$where=[
					'PollID'=>$pd->PollID
				];
			}
		}
		return $data;
	}

	//get vote count of perticular Poll Votes
	public function getCount($PollID)
	{
		$where=NULL;
		$where=[
			'PollID'=>$PollID,
		];
		$this->db->select('count(PollID) TotalVote');
		$this->db->where($where);
		$data=$this->db->get('tblpollxanswer')->result()[0]->TotalVote;
		return $data;
	}

	//get vote for perticular user for pericular poll
	public function getVote($PollID)
	{
		$where=NULL;
		$where=[
			'PollID'=>$PollID,
			'UserID'=>$this->session->UserID
		];
		$this->db->select('PollXAnswerID, PollXOptionID');
		$this->db->where($where);
		$data=$this->db->get('tblpollxanswer')->result();
		if(count($data)>0)
			return $data[0];
		else
			return 0;
	}	

	public function add($PollXOptionID,$PollID)
	{
		//deleting old data
		$where=NULL;
		$where=[
			'UserID'=>$this->session->UserID,
			'PollID'=>$PollID
		];
		$data=$this->db
			->where($where)
			->delete('tblpollxanswer',$where);
	
		$Insert_Data=[
			'PollXOptionID'=>$this->input->post('PollAnswer'),
			'PollID'=>$PollID,
			'UserID'=>$this->session->UserID
		];
		$this->db->insert('tblpollxanswer',$Insert_Data);
	}
}
?>