<?php
class Course_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($table, $where=FALSE)
	{
		if($where)
			$this->db->where($where);
		$this->db->select('a1.*,a2.AdminName AddedByAdminName, c.CategoryName');
		$this->db->from('tblcourse a1');
		$this->db->join('tbladmin a2','a1.AddedByAdminID=a2.AdminID');
		$this->db->join('tblcategory c','c.CategoryID=a1.CategoryID');
		$cd['course_data']=$this->db->get()->result();
		// echo '<pre>';
		// print_r($cd);
		// echo '</pre>';
		// die('hello');
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

