<?php
class Section_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Get Perticular Section Detail
	public function getSectionData($SectionID)
	{
		$where=array('SectionID'=>$SectionID);
		$this->db->where($where);
		$data['Section_Data']=$this->db->get('tblsection')->result();
		return $data;
	}
}
?>