<?php
class Course_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//get perticular course data
	public function getCourseData($CourseID)
	{
		$where=array('CourseID'=>$CourseID);
		$this->db->where($where);
		$data=$this->db->get('tblcourse')->result();
		return $data;
	}

	//Get Chapter Data Of Perticular Course
	public function getChapterData($CourseID)
	{
		$where=array('CourseID'=>$CourseID);
		$this->db->where($where);
		$data=$this->db->get('tblchapter')->result();
		foreach ($data as $cd)
		{
			$this->db->select('SectionID, SectionName');
			$this->db->where(['ChapterID'=>$cd->ChapterID]);
			$cd->Section_Data=$this->db->get('tblsection')->result();
		}
		return $data;
	}
}
?>