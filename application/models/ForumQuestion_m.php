<?php
class ForumQuestion_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get perticular Question data
	public function getQuestionData($ForumQuestionID=FALSE)
	{
		if($ForumQuestionID)
		{
			//Forum Question Data
			$where=NULL;
			$where=[
				'fq.ForumQID'=>$ForumQuestionID
				//'fq.ForumQStatus'=>0
			];
			$this->db->where($where);
			$this->db->select('fq.*, u.UserName, u.UserAvatar');
			$this->db->from('tblforumq fq');
			$this->db->join('tbluser u', 'fq.UserID=u.UserID');
			$data['Question_Data']=$this->db->get()->result();
			
			//Question up votes
			$where=NULL;
			$where=[
				'ForumQID'=>$ForumQuestionID,
				'VoteType'=>1
			];
			$this->db->where($where);
			$data['Question_UpVote']=$this->db->get('tblforumqxvote')->result();
			$data['Question_Data'][0]->UpVote=count($data['Question_UpVote']);

			//Question down votes
			$where=NULL;
			$where=[
				'ForumQID'=>$ForumQuestionID,
				'VoteType'=>-1
			];
			$this->db->where($where);
			$data['Question_DownVote']=$this->db->get('tblforumqxvote')->result();
			$data['Question_Data'][0]->DownVote=count($data['Question_DownVote']);
			
			//Forum Answer Data
			$where=NULL;
			$where=[
				'fa.ForumQID'=>$ForumQuestionID,
				'fa.ForumAStatus'=>0
			];
			$this->db->where($where);
			$this->db->select('fa.*, u.UserName, u.UserAvatar');
			$this->db->from('tblforuma fa');
			$this->db->join('tbluser u', 'fa.UserID=u.UserID');
			$this->db->order_by('fa.CreatedDateTime', 'DESC');
			$data['Answer_Data']=$this->db->get()->result();

			foreach ($data['Answer_Data'] as $ad)
			{
				//Answer up votes
				$where=NULL;
				$where=[
					'ForumAID'=>$ad->ForumAID,
					'VoteType'=>1
				];
				$this->db->where($where);
				$ad->UpVote=$this->db->get('tblforumaxvote')->result();
				$ad->TotalUpVote=count($ad->UpVote);
	
				//Answer down votes
				$where=NULL;
				$where=[
					'ForumAID'=>$ad->ForumAID,
					'VoteType'=>-1
				];
				$this->db->where($where);
				$ad->DownVote=$this->db->get('tblforumaxvote')->result();
				$ad->TotalDownVote=count($ad->DownVote);
			}
            		
    		$this->db->select('*');
    		$this->db->from('tbltag t');
    		$this->db->join('tblforumqxtag qxt', 't.TagID=qxt.TagID');
    		$this->db->where(['qxt.ForumQID'=>$ForumQuestionID]);
    		$data['tag_data']=$this->db->get()->result();
		}
		else
		{
			$where=null;
			$where['ForumQStatus']=0;
			$this->db->where($where);
			$this->db->select('fq.*, u.UserName, u.UserAvatar');
			$this->db->from('tblforumq fq');
			$this->db->join('tbluser u', 'fq.UserID=u.UserID');
			$data['Question_Data']=$this->db->get()->result();
			
			foreach ($data['Question_Data'] as $qd)
			{
				$where=null;
				$where=[
					'ForumQID'=>$qd->ForumQID,
					'ForumAStatus'=>0
				];
				$this->db->where($where);
				$this->db->select('count(ForumAID) AnsCount');
				$ans=$this->db->get('tblforuma')->result()[0];
				$qd->answer=$ans->AnsCount;

				$where=null;
				$where=[
					'ForumQID'=>$qd->ForumQID,
					'VoteType'=>1
				];
				$this->db->where($where);
				$this->db->select('count(ForumQID) UpVote');
				$comment=$this->db->get('tblforumqxvote')->result()[0];
				$qd->UpVote=$comment->UpVote;

				$where=null;
				$where=[
					'ForumQID'=>$qd->ForumQID,
					'VoteType'=>-1
				];
				$this->db->where($where);
				$this->db->select('count(ForumQID) DownVote');
				$comment=$this->db->get('tblforumqxvote')->result()[0];
				$qd->DownVote=$comment->DownVote;
			}
		}
		return $data;
	}

    //add correct answer vote
    public function AddRightAnswer($ForumQID, $ForumAID)
    {
        $where=null;
		$where=[
			'ForumQID'=>$ForumQID,
		];
        $this->db->where($where);
        $update_data=NULL;
        $update_data =[
			'AcceptedForumAID' => $ForumAID,
		];
		
		$this->db->set($update_data);
		$this->db->update('tblforumq');
    }

    //get tagged question data
    public function getFilteredQuestionData($TagID)
    {
        $where=null;
		$where['TagID']=$TagID;
		$this->db->select('ForumQID');
		$this->db->where($where);
        $TagData=$this->db->get('tblforumqxtag')->result();
        
        $where=NULL;
		$where=array_column($TagData, 'ForumQID');
        $wherein=NULL;
        $wherein=implode(", ",array_values($where));
        
        $where=null;
		$where['ForumQStatus']=0;
		$this->db->where($where);
		if($wherein!='')
		    $this->db->where("fq.ForumQID in($wherein)");
		else
		    $this->db->where("fq.ForumQID in(0)");
        $this->db->select('fq.*, u.UserName, u.UserAvatar');
		$this->db->from('tblforumq fq');
		$this->db->join('tbluser u', 'fq.UserID=u.UserID');
		$data['Question_Data']=$this->db->get()->result();
		
		foreach ($data['Question_Data'] as $qd)
		{
			$where=null;
			$where=[
				'ForumQID'=>$qd->ForumQID,
				'ForumAStatus'=>0
			];
			$this->db->where($where);
			$this->db->select('count(ForumAID) AnsCount');
			$ans=$this->db->get('tblforuma')->result()[0];
			$qd->answer=$ans->AnsCount;

			$where=null;
			$where=[
				'ForumQID'=>$qd->ForumQID,
				'VoteType'=>1
			];
			$this->db->where($where);
			$this->db->select('count(ForumQID) UpVote');
			$comment=$this->db->get('tblforumqxvote')->result()[0];
			$qd->UpVote=$comment->UpVote;

			$where=null;
			$where=[
				'ForumQID'=>$qd->ForumQID,
				'VoteType'=>-1
			];
			$this->db->where($where);
			$this->db->select('count(ForumQID) DownVote');
			$comment=$this->db->get('tblforumqxvote')->result()[0];
			$qd->DownVote=$comment->DownVote;
		}
		return $data;
    }

    //get Tag Data
    public function getTagData()
    {
        return $this->db->get('tbltag')->result();
    }

	//toggle upvote of Answer
	public function toggle_ans_upvote($ForumAnswerID)
	{
		//deleting old negetive vote
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>-1
		];
		$data=$this->db
			->where($where)
			->delete('tblforumaxvote',$where);
	
		//inserting new data
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'UserID'=>$this->session->UserID
		];
		$data=$this->db
			->where($where)
			->get('tblforumaxvote')
			->result();
		if(count($data)===0)
		{
			$Insert_Data=NULL;
			$Insert_Data=[
				'ForumAID'=>$ForumAnswerID,
				'UserID'=>$this->session->UserID,
				'VoteType'=>1
			];
			$this->db->insert('tblforumaxvote',$Insert_Data);
		}
		else //deleting old positive vote
		{
			$where=NULL;
			$where=[
				'ForumAID'=>$ForumAnswerID,
				'UserID'=>$this->session->UserID
			];
			$data=$this->db
				->where($where)
				->delete('tblforumaxvote',$where);
		}
	}

	//toggle dwonvote of Answer
	public function toggle_ans_downvote($ForumAnswerID)
	{
		//deleting old possitive vote
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>1
		];
		$data=$this->db
			->where($where)
			->delete('tblforumaxvote',$where);
		
		//inserting new data
		$data=NULL;
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'UserID'=>$this->session->UserID
		];
		$data=$this->db
			->where($where)
			->get('tblforumaxvote')
			->result();
		if(count($data)===0)
		{
			$Insert_Data=NULL;
			$Insert_Data=[
				'ForumAID'=>$ForumAnswerID,
				'UserID'=>$this->session->UserID,
				'VoteType'=>-1
			];
			$this->db->insert('tblforumaxvote',$Insert_Data);
		}
		else //deleting old negetive vote
		{
			$where=NULL;
			$where=[
				'ForumAID'=>$ForumAnswerID,
				'UserID'=>$this->session->UserID
			];
			$data=$this->db
				->where($where)
				->delete('tblforumaxvote',$where);
		}
	}

	//get vote count of perticular Answer
	public function getAnsCount($ForumAnswerID,$VoteType)
	{
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'VoteType'=>$VoteType
		];
		$this->db->where($where);
		$this->db->select('count(ForumAXVoteID) VoteCount');
		$data=$this->db->get('tblforumaxvote')->result();
		return $data[0]->VoteCount;
	}

	//get color vote of perticular Answer
	public function getAnsColor($ForumAnswerID,$VoteType)
	{
		$where=NULL;
		$where=[
			'ForumAID'=>$ForumAnswerID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>$VoteType
		];
		$this->db->where($where);
		$data=$this->db->get('tblforumaxvote')->result();
		if(count($data)==1)
			return 0;
		else	
			return 1;
	}

	//toggle upvote of Question
	public function toggle_upvote($ForumQuestionID)
	{
		//deleting old negetive vote
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>-1
		];
		$data=$this->db
			->where($where)
			->delete('tblforumqxvote',$where);
	
		//inserting new data
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'UserID'=>$this->session->UserID
		];
		$data=$this->db
			->where($where)
			->get('tblforumqxvote')
			->result();
		if(count($data)===0)
		{
			$Insert_Data=NULL;
			$Insert_Data=[
				'ForumQID'=>$ForumQuestionID,
				'UserID'=>$this->session->UserID,
				'VoteType'=>1
			];
			$this->db->insert('tblforumqxvote',$Insert_Data);
		}
		else //deleting old positive vote
		{
			$where=NULL;
			$where=[
				'ForumQID'=>$ForumQuestionID,
				'UserID'=>$this->session->UserID
			];
			$data=$this->db
				->where($where)
				->delete('tblforumqxvote',$where);
		}
	}

	//toggle dwonvote of Question
	public function toggle_downvote($ForumQuestionID)
	{
		//deleting old possitive vote
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>1
		];
		$data=$this->db
			->where($where)
			->delete('tblforumqxvote',$where);
		
		//inserting new data
		$data=NULL;
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'UserID'=>$this->session->UserID
		];
		$data=$this->db
			->where($where)
			->get('tblforumqxvote')
			->result();
		if(count($data)===0)
		{
			$Insert_Data=NULL;
			$Insert_Data=[
				'ForumQID'=>$ForumQuestionID,
				'UserID'=>$this->session->UserID,
				'VoteType'=>-1
			];
			$this->db->insert('tblforumqxvote',$Insert_Data);
		}
		else //deleting old negetive vote
		{
			$where=NULL;
			$where=[
				'ForumQID'=>$ForumQuestionID,
				'UserID'=>$this->session->UserID
			];
			$data=$this->db
				->where($where)
				->delete('tblforumqxvote',$where);
		}
	}

	//get vote count of perticular Question
	public function getCount($ForumQuestionID,$VoteType)
	{
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'VoteType'=>$VoteType
		];
		$this->db->where($where);
		$this->db->select('count(ForumQXVoteID) VoteCount');
		$data=$this->db->get('tblforumqxvote')->result();
		return $data[0]->VoteCount;
	}

	//get color vote of perticular question
	public function getColor($ForumQuestionID,$VoteType)
	{
		$where=NULL;
		$where=[
			'ForumQID'=>$ForumQuestionID,
			'UserID'=>$this->session->UserID,
			'VoteType'=>$VoteType
		];
		$this->db->where($where);
		$data=$this->db->get('tblforumqxvote')->result();
		if(count($data)==1)
			return 0;
		else	
			return 1;
	}

	// add answer	
	public function addanswer($insert_data)
	{
		$this->db->insert('tblforuma', $insert_data);
		return $this->db->insert_id();
	}

	//get question asker id and question title for notification
	public function getQuestionInfo($id)
	{
		return
			$this->db
				->select('f.ForumQTitle, f.UserID, u.UserEmail')
				->where(['ForumQID'=>$id])
				->from('tblforumq f')
				->join('tbluser u', 'f.UserID=u.UserID')
				->get()
				->result();
	}

	//get random users 7 users
	public function getUserData()
	{
		$this->db->where([
			'UserStatus'=>0
			]);
		$this->db->order_by('', 'RANDOM');
		$this->db->limit(7);
		$data=$this->db->get('tbluser')->result();
		return $data;
	}
}
?>