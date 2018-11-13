<?php
class Category_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($where=FALSE)
	{
		if($where)
			$this->db->where($where);
		$this->db->select('c.*,a.AdminName AddedByAdminName');
		$this->db->from('tblcategory c');
		$this->db->join('tbladmin a', 'c.AddedByAdminID=a.AdminID');
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
	// public function get_all_Section()
	// {
	// 	return $this->db->get('tblsection')->result();
	// }
}

