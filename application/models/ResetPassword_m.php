<?php
class ResetPassword_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getUserData($ad)
	{
		$this->db->where($ad);
		$data=$this->db->get('tbluser');
		return $data->result();
	}

	//insert otp
	public function InsertOTP($otp)
	{
		$where=NULL;
		$where=['UserEmail'=>$this->session->EmailResetPassword];
		$this->db->where($where);
		$data=NULL;
		$data=['UserOTP'=>$otp];
		$this->db->set($data);
		$this->db->update('tbluser');
	}

	//update password in database
	public function UpdataPassword($where,$data)
	{
		$this->db->where($where);	
		$this->db->set($data);
		$this->db->update('tbluser');
	}
}
?>