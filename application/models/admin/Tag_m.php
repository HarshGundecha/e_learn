<?php
class Tag_m extends CI_Model {

	public function get_entity($where=FALSE)
	{
		if($where)
		{
			$this->db->where($where);
			return $this->db->get('tbltag')->result();
		}
		return $this->db
			->select('t.*,a.AdminID, a.AdminName AddedByAdminName')
			->from('tbltag t')
			->join('tbladmin a','t.AddedByAdminID=a.AdminID')
			->get()
			->result();
	}

	public function get_update_entity($id=FALSE)
	{
		if($id)
		{		
			$where["TagID"]=$id;
			$this->db->where($where);
			return $this->db->get('tbltag')->result();
		}
	}

	public function add_entity($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function update_entity($table, $data=false, $where=false)
	{
		// echo "<pre>";
		// print_r($data['TagName']);
		// echo "<pre>";
		// die();
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

	public function get_tag_data($id)
	{
		//simple tag info
		$where=null;
		$where['TagID'] = $id;
		$this->db->where($where);
		$ad['tag_data']=$this->db->get('tbltag')->result();
		
		// use (left)join to get question with total votes in single query instead of foreach
		//added by tag info
		$where=null;
		$where['AddedByTagID'] = $id;
		$where['TagLevel'] = 1;
		$this->db->where($where);
		$ad['added_tag_data']=$this->db->get('tbltag')->result();
		
		//Added By Curses Info
		$where=null;
		$where['AddedByTagID'] = $id;
		$this->db->where($where);
		$ad['added_course_data']=$this->db->get('tblcourse')->result();
		
		//Added By Chapters Info
		$where=null;
		$where['AddedByTagID'] = $id;
		$this->db->where($where);
		$ad['added_chapter_data']=$this->db->get('tblchapter')->result();
		
		//Added By Sections Info
		$where=null;
		$where['AddedByTagID'] = $id;
		$this->db->where($where);
		$this->db->select('SectionID,SectionName,ChapterID,CreatedDateTime');
		$ad['added_section_data']=$this->db->get('tblsection')->result();
		
		//Added By Article Info
		$where=null;
		$where['AddedByTagID'] = $id;
		$this->db->where($where);
		$ad['added_article_data']=$this->db->get('tblarticle')->result();
		
		//count of Likes of Question
		/*foreach ($ud['question_data'] as $uvd)
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

		//Tag Answers
		$where=null;
		$where['TagID'] = $id;
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
		}*/
			

		return $ad;

		// echo '<pre>';
		// print_r($ad);
		// echo '</pre>';
		// die('hello');
	}
}