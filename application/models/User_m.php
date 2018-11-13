<?php
class User_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get user data
	public function getData($where=false)
	{
		if($where)
			$this->db->where($where);
		$data=$this->db->get('tbluser');
		return $data->result();
	}
	
	//update password data into database
	public function UpdatePasswordData($update_data,$where)
	{
		if($update_data && $where)
		{
			$this->db->set($update_data);
			$this->db->where($where);
			$this->db->update('tbluser');
			return $this->db->affected_rows();
		}
	}

	public function UpdateProfileData($data=false, $where=false)
	{
		if($data && $where)
		{
			$this->db
				->set($data)
				->where($where)
				->update('tbluser');
				return $this->db->affected_rows();	
		}
	}

	/*public function getCountryData()
	{
		return $this->db->get('tblcountry')->result();
	}
	public function get_state_data($where=false)
	{
		if($where && is_array($where))
		{
			return $this->db->where($where)->get('tblstate')->result();
		}
	}
	public function get_city_data($where=false)
	{
		if($where && is_array($where))
		{
			return $this->db->where($where)->get('tblcity')->result();
		}
	}*/
}
?>