<?php
class Verify_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//verify otp and make user unblocked
	public function do_verify()
	{
		$where=NULL;
		$where=['UserEmail'=>$this->session->UserEmail];
		$this->db->where($where);
		$data=NULL;
		$data=[
			'IsEmailVerified'=>0,
			'UserStatus'=>0,
		];
		$this->db->set($data);
		$this->db->update('tbluser');
	}

	//get user data
	public function getUserData()
	{
		$where=NULL;
		$where=['UserEmail'=>$this->session->UserEmail];
		$this->db->where($where);
		$data=$this->db->get('tbluser');
		return $data->result();
	}

	//insert otp where resended
	public function InsertOTP($otp)
	{
		$where=NULL;
		$where=['UserEmail'=>$this->session->UserEmail];
		$this->db->where($where);
		$data=NULL;
		$data=['UserOTP'=>$otp];
		$this->db->set($data);
		$this->db->update('tbluser');
	}
}
?>