<?php
class Register_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function do_register($data)
	{
		$this->db->insert('tbluser',$data);
	}
}
?>