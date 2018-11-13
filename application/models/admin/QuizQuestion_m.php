<?php
class QuizQuestion_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($where=FALSE)
	{
		$this->db->select('*');
		$this->db->from('tblquestion q');
		$this->db->join('tbladmin a','q.AddedByAdminID=a.AdminID');
		$this->db->join('tblcourse co','q.CourseID=co.CourseID');
		$this->db->join('tblchapter ch','q.ChapterID=ch.ChapterID');
		if($where)
			$this->db->where($where);
		return $this->db->get()->result();
	}

	public function add_entity($table=false, $data=false)
	{
		if($table && $data)
		{
			$this->db->insert($table, $data);
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

	public function get_question_data($where=false)
	{
		$this->db->select('q.*, a.AdminID, a.AdminName, a.AdminImage');
		$this->db->from('tblquestion q');
		$this->db->join('tbladmin a', 'q.AddedByAdminID=a.AdminID');
		if($where)
			$this->db->where($where);
		$qd=$this->db->get()->result();


		if($where)
			$this->db->where($where);
		$qd[0]->OptionData=$this->db->get('tblquestionxoption')->result();		

		// echo '<pre>';
		// print_r($qd);
		// echo '</pre>';
		// die('hello');
		return $qd;
	}

	public function get_course_data()
	{
		return $this->db->get('tblcourse')->result();
	}

	public function get_chapter_data($where=false)
	{
		if($where)
			$this->db->where($where);
		return $this->db->get('tblchapter')->result();;
	}
}