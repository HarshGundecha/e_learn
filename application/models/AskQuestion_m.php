<?php
class AskQuestion_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// add Question	
	public function addquestion($insert_data)
	{
		$this->db->insert('tblforumq', $insert_data);
		return $this->db->insert_id();
	}
	public function add_entity($tbl, $tagD)
	{
	    $this->db->insert($tbl,$tagD);
	}
	public function getTags()
	{
		return $this->db->where(['TagStatus'=>0])->get('tbltag')->result();
	}
}
?>