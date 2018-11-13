<?php
class Article_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get perticular Article data
	public function getArticleData($ArticleID=FALSE)
	{
		if($ArticleID)
		{
			$where=NULL;
			$where=[
				'ar.ArticleID'=>$ArticleID,
				'ar.ArticleStatus'=>0
			];
			$this->db->where($where);
			$this->db->select('ar.*,a.AdminName AddedByAdminName');
			$this->db->from('tblarticle ar');
			$this->db->join('tbladmin a', 'ar.AddedByAdminID=a.AdminID');
			$data['Article_Data']=$this->db->get()->result();

			$where=NULL;
			$where=array(
				'arxc.ArticleID'=>$ArticleID,
				'ArticleCommentStatus'=>0);
			$this->db->where($where);
			$this->db->select('arxc.*, u.UserName, u.UserAvatar');
			$this->db->from('tblarticlexcomment arxc');
			$this->db->join('tbluser u', 'arxc.UserID=u.UserID');
            $this->db->order_by('arxc.CreatedDateTime', 'DESC');
			$data['Comment_Data']=$this->db->get()->result();
			$data['Article_Data'][0]->CommentCount=count($data['Comment_Data']);

			$where=NULL;
			$where=array(
				'arxl.ArticleID'=>$ArticleID,
				'ArticleLikeStatus'=>0);
			$this->db->where($where);
			$this->db->select('arxl.*, u.UserName');
			$this->db->from('tblarticlexlike arxl');
			$this->db->join('tbluser u', 'arxl.UserID=u.UserID');
			$data['Like_Data']=$this->db->get()->result();
			$data['Article_Data'][0]->LikeCount=count($data['Like_Data']);
		}
		else
		{
			$where=NULL;
			$where=[
				'ar.ArticleStatus'=>0
			];
			$this->db->where($where);
			$this->db->select('ar.*, a.AdminName AddedByAdminName');
			$this->db->from('tblarticle ar');
			$this->db->join('tbladmin a', 'ar.AddedByAdminID=a.AdminID');
			$this->db->order_by('ar.CreatedDateTime', 'DESC');
			$data['Article_Data']=$this->db->get()->result();
			
			foreach ($data['Article_Data'] as $ad)
			{
				$where=null;
				$where['ArticleID']=$ad->ArticleID;
				$where['ArticleCommentStatus']=0;
				$this->db->where($where);
				$this->db->select('count(ArticleID) CommentCount');
				$comment=$this->db->get('tblarticlexcomment')->result()[0];
				$ad->CommentCount=$comment->CommentCount;

				$where=null;
				$where['arxl.ArticleID']=$ad->ArticleID;
				$where['arxl.ArticleLikeStatus']=0;
				$this->db->where($where);
				$this->db->select('u.UserName');
				$this->db->from('tblarticlexlike arxl');
				$this->db->join('tbluser u','u.UserID=arxl.UserID');
				$ad->Like_Data=$this->db->get()->result();
				$ad->LikeCount=count($ad->Like_Data);
			}
		}
		return $data;
	}

    //get filtered article data
    public function getFilteredArticleData($wherein)
    {
        $this->db->select('ArticleID');
		$this->db->where("TagID in($wherein)");
        $TagData=$this->db->get('tblarticlextag')->result();
        
        $where=NULL;
		$where=array_column($TagData, 'ArticleID');
        $wherein=NULL;
        $wherein=implode(", ",array_values($where));
        
        $where=NULL;
		$where=[
			'ar.ArticleStatus'=>0
		];
		$this->db->where($where);
		if($wherein!='')
		    $this->db->where("ar.ArticleID in($wherein)");
		else
		    $this->db->where("ar.ArticleID in(0)");
        $this->db->select('ar.*, a.AdminName AddedByAdminName');
		$this->db->from('tblarticle ar');
		$this->db->join('tbladmin a', 'ar.AddedByAdminID=a.AdminID');
		$this->db->order_by('ar.CreatedDateTime', 'DESC');
		$data['Article_Data']=$this->db->get()->result();
		
		foreach ($data['Article_Data'] as $ad)
		{
			$where=null;
			$where['ArticleID']=$ad->ArticleID;
			$where['ArticleCommentStatus']=0;
			$this->db->where($where);
			$this->db->select('count(ArticleID) CommentCount');
			$comment=$this->db->get('tblarticlexcomment')->result()[0];
			$ad->CommentCount=$comment->CommentCount;

			$where=null;
			$where['arxl.ArticleID']=$ad->ArticleID;
			$where['arxl.ArticleLikeStatus']=0;
			$this->db->where($where);
			$this->db->select('u.UserName');
			$this->db->from('tblarticlexlike arxl');
			$this->db->join('tbluser u','u.UserID=arxl.UserID');
			$ad->Like_Data=$this->db->get()->result();
			$ad->LikeCount=count($ad->Like_Data);
		}
		return $data;
    }

    //get Tag Data
    public function getTagData()
    {
        return $this->db->get('tbltag')->result();
    }

	//Insert Comment Data
	public function addcommentdata($insert_data)
	{
		$this->db->insert('tblarticlexcomment', $insert_data);
	}

    //Insert Notification Data
    public function addnotificationdata($insert_data)
	{
		$this->db->insert('tbladminnotification', $insert_data);
	}
    
	//toggle like
	public function toggle_like($ArticleID)
	{
		$where=NULL;
		$where=[
			'ArticleID'=>$ArticleID,
			'UserID'=>$this->session->UserID
		];
		$data=$this->db
			->where($where)
			->get('tblarticlexlike')
			->result();
		if(count($data)==0)
		{
			$Insert_Data=NULL;
			$Insert_Data=[
				'ArticleID'=>$ArticleID,
				'UserID'=>$this->session->UserID
			];
			$this->db->insert('tblarticlexlike',$Insert_Data);
			return 0;
		}
		else
		{
			$where=NULL;
			$where=[
				'ArticleID'=>$ArticleID,
				'UserID'=>$this->session->UserID
			];
			$data=$this->db
				->where($where)
				->delete('tblarticlexlike',$where);
			return 1;
		}
	}

	//get like count of perticular article
	public function getCount($ArticleID)
	{
		$where=NULL;
		$where=[
			'ArticleID'=>$ArticleID,
			'ArticleLikeStatus'=>0
		];
		$this->db->where($where);
		$this->db->select('count(ArticleXLikeID) LikeCount');
		$data=$this->db->get('tblarticlexlike')->result();
		return $data[0]->LikeCount;
	}
}
?>