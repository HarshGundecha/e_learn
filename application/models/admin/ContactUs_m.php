<?php
class ContactUs_m extends CI_Model {
	public function SendReportData($rd)
	{
		$this->db->insert('tblsitereport',$rd);
	}
}