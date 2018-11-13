<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct($foo = null)
	{
		parent::__construct();
		$this->load->model('admin/Notification_m');
	}

	public function index($NID)
	{
		$ud=[
			'AdminNotificationID'=>$NID,
		];
		$data=$this->Notification_m->get_notification_data($ud);
		if(count($data)!=1)
			redirect('Error_404');
		$setd=['IsRead'=>1];
		$this->Notification_m->update_notification_data($setd, $ud);
		redirect(site_url($data[0]->AdminNotificationRedirect));
	}

/*	public function getAllNotification()
	{
		$this->Notification_m->getAllNotificationData();
	}*/

}

/* End of file Notification.php */
/* Location: ./application/controllers/admin/Notification.php */