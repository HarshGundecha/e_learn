<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notification_m','model');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}		
	}

	public function index($id)
	{
		$ud=[
			'NotificationID'=>$id,
			'NotificationReceiverID'=>$this->session->UserID
		];
		$data=$this->model->get_notification_data($ud);
		if(count($data)!=1)
			redirect('Error_404');
		$setd=['IsRead'=>1];
		$this->model->update_notification_data($setd, $ud);
		redirect(site_url($data[0]->NotificationRedirect));
	}

}