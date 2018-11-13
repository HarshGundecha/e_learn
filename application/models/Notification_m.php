<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_m extends CI_Model
{
	public function get_all_notification($id)
	{
		return $this->db
            ->select('un.*, u.UserID, u.UserName, u.UserAvatar')
			->from('tblusernotification un')
			->join('tbluser u', 'un.NotificationReceiverID=u.UserID')
			->where(['un.NotificationReceiverID'=>$id])
			->order_by('un.CreatedDateTime', 'DESC')
			->get()
			->result();
	}

	public function get_notification_data($nd)
	{
		return $this->db
			->where($nd)
			->get('tblusernotification')
			->result();
	}

	public function update_notification_data($setd, $od)
	{
		$this->db
			->set($setd)
			->where($od)
			->update('tblusernotification');
	}

	public function addNotification($nd)
	{
		$this->db->insert('tblusernotification', $nd);
		return $this->db->insert_id();
	}

}
