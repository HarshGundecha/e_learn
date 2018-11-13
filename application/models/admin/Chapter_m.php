<?php
class Chapter_m extends CI_Model {

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
		}
		$this->db->select('a1.*,a2.AdminName AddedByAdminName, a3.CourseName CourseName');
		$this->db->from('tblchapter a1');
		$this->db->join('tbladmin a2', 'a1.AddedByAdminID=a2.AdminID');
		$this->db->join('tblcourse a3', 'a1.CourseID=a3.CourseID');
		$cd['chapter_data']=$this->db->get()->result();

		$cd['course_data']=$this->db->get('tblcourse')->result();

		return $cd;
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
}

