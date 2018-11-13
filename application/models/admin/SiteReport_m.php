<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteReport_m extends CI_Model {
	public function get_entity($where=false)
	{
		$this->db
			->select('sr.*, u.UserID, u.UserName, u.UserAvatar, u.UserEmail')
			->from('tblsitereport sr')
			->join('tbluser u', 'sr.UserID=u.UserID');
			if($where)
				$this->db->where($where);
		return $this->db->get()->result();
	}
	public function GetReportData($id)
	{
	    return $this->db
            ->select('*')
            ->from('tblsitereport sr')
            ->join('tbluser u', 'sr.UserID=u.UserID')
            ->where(['SiteReportID'=>$id])
            ->get()
            ->result();
	}
}

/* End of file SiteReport_m.php */
/* Location: ./application/models/admin/SiteReport_m.php */