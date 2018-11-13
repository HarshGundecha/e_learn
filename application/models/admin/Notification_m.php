<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_m extends CI_Model
{

	public function getAllNotificationData()
	{
		return $this->db
		->select('n.*, u.UserAvatar, u.UserName')
		->from('tbladminnotification n')
		->join('tbluser u', 'n.SenderUserID=u.UserID')
		->order_by('n.CreatedDateTime', 'DESC')
		->get()
		->result();
	}

	public function get_notification_data($nd)
	{
		return $this->db
			->where($nd)
			->get('tbladminnotification')
			->result();
	}

	public function update_notification_data($setd, $od)
	{
		$this->db
			->set($setd)
			->where($od)
			->update('tbladminnotification');
	}	

}

/* End of file Notification_m.php */
/* Location: ./application/models/admin/Notification_m.php */