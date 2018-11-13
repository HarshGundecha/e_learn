<?php
class Category_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//get perticular course data
	public function getCourseData($CategoryID=FALSE)
	{
		if($CategoryID)
		{
			$where=[
				'c.CategoryID'=>$CategoryID,
				'c.COurseStatus'=>0
			];
			$this->db->where($where);
		}

		$this->db->select('c.*,a.AdminName AddedByAdminName');
		$this->db->from('tblcourse c');
		$this->db->join('tbladmin a', 'c.AddedByAdminID=a.AdminID');
		$data=$this->db->get()->result();

		return $data;
	}

	//get all category
	public function getCategoryData()
	{
		$data=$this->db->get('tblcategory')->result();
		return $data;
	}
}
?>