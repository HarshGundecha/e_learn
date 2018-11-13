<?php
class Login_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function do_login($ad)
	{
		$this->db->where($ad);
		$data=$this->db->get('tbluser');
		return $data->result();
	}

	//insert otp when loggedin
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