<?php
class Home_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Random Course	
	public function getCourse()
	{
		$this->db->where([
			'CourseStatus'=>0
			]);
		$this->db->order_by('', 'RANDOM');
		$this->db->limit(3);
		$data=$this->db->get('tblcourse')->result();
		return $data;
	}

	//get top user
	public function getTopUser()
	{
		$this->db->where([
			'UserStatus'=>0
			]);
		$this->db->order_by('UserXP', 'DESC');
		$this->db->limit(2);
		$data=$this->db->get('tbluser')->result();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		return $data;
	}

	//get All Users
	public function getAllUser()
	{
		$this->db->where([
			'UserStatus'=>0
			]);
		$this->db->order_by('UserXP', 'DESC');
		$data=$this->db->get('tbluser')->result();
		return $data;
	}
}
?>