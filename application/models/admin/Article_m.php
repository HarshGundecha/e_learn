<?php
class Article_m extends CI_Model
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
			$this->db->select('ar.*, a.AdminName AddedByAdminName');
			$this->db->from('tblarticle ar');
			$this->db->join('tbladmin a','ar.AddedByAdminID=a.AdminID');
			return $this->db->get()->result();
		}
		$this->db->select('ar.*, a.AdminName AddedByAdminName');
		$this->db->from('tblarticle ar');
		$this->db->join('tbladmin a','ar.AddedByAdminID=a.AdminID');
		return $this->db->get()->result();
	}

	public function add_entity($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_entity($table, $data=false, $id=false)
	{
		if($data && $id)
		{
			$where["ArticleID"]=$id;
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

	public function get_article_data($id)
	{
		if($id)
		{
			$where=null;
			$where['ar.ArticleID'] = $id;
			$this->db->where($where);
			$this->db->select('ar.*, a.AdminName AddedByAdminName');
			$this->db->from('tblarticle ar');
			$this->db->join('tbladmin a','ar.AddedByAdminID=a.AdminID');
			$ard['article_data']=$this->db->get()->result()[0];

			$where=null;
			$where['arxc.ArticleID'] = $id;
			$this->db->where($where);
			$this->db->select('arxc.*, ar.ArticleTitle, u.UserName, u.UserAvatar');
			$this->db->from('tblarticlexcomment arxc');
			$this->db->join('tblarticle ar','ar.ArticleID=arxc.ArticleID');
			$this->db->join('tbluser u','u.UserID=arxc.UserID');
			$ard['comment_data']=$this->db->get()->result();

			$ard['article_data']->CommentCount=count($ard['comment_data']);

			$where=null;
			$where['arxl.ArticleID'] = $id;
			$this->db->where($where);
			$this->db->select('arxl.*, ar.ArticleTitle, u.UserName');
			$this->db->from('tblarticlexlike arxl');
			$this->db->join('tblarticle ar','ar.ArticleID=arxl.ArticleID');
			$this->db->join('tbluser u','u.UserID=arxl.UserID');
			$ard['like_data']=$this->db->get()->result();

			$ard['article_data']->LikeCount=count($ard['like_data']);
			
			$this->db->select('*');
			$this->db->from('tbltag t');
			$this->db->join('tblarticlextag axt', 't.TagID=axt.TagID');
			$this->db->where(['axt.ArticleID'=>$id]);
			$ard['tag_data']=$this->db->get()->result();

			return $ard;
		}
	}

	//toggle article comment status
	public function toggle_comment_status($ArticleXCommentID)
	{
		$where=NULL;
		$where=['ArticleXCommentID'=>$ArticleXCommentID];
		$this->db->where($where);
		$this->db->set('ArticleCommentStatus', '1-ArticleCommentStatus', FALSE);
		$this->db->update('tblarticlexcomment');	
	}

	public function getTags()
	{
		return $this->db->where(['TagStatus'=>0])->get('tbltag')->result();
	}
}