<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Profile_m','pm');
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}
	public function index($UserID=FALSE)
	{
		if($UserID==FALSE || !is_numeric($UserID))
			redirect('Error_404');
		$data['UserData']=$this->pm->getUserData($UserID);
		if(count($data['UserData'])<1)
			redirect('Error_404');
		$data['PollData']=$this->pm->getPollID($UserID);
		$data['UserData'][0]->Follow=$this->pm->getfollow($UserID);
		$data['QuestionAskedData']=$this->pm->getQuestion($UserID);
		$data['AnswerGivenData']=$this->pm->getAnswer($UserID);
		$data['FollowersData']=$this->pm->getFollowers($UserID);
		$data['FollowingData']=$this->pm->getFollowing($UserID);
		get_view('profile',$data['UserData'][0]->UserName,$data);
	}

	//view perticular poll detail
	public function Poll($PollID,$PollXOptionID)
	{
		$data['Poll_Data']=$this->pm->getPollData($PollID);
		$data['Poll_Data'][0]->UserVote=$PollXOptionID;
		get_view('profilepoll','Poll Detail',$data);
	}

	//Toggle Follow
	public function togglefollow($UserID)
	{
		$Follow=$this->pm->getfollow($UserID);
		if($Follow==='Follow')
		{
			$where=NULL;
			$where=[
				'FollowingID'=>$UserID,
				'FollowerID'=>$this->session->UserID
			];
			$this->pm->deleteFollow($where);
			echo 'Follow';
		}
		elseif($Follow==='Not Follow')
		{
			$insert_data=NULL;
			$insert_data=[
				'FollowingID'=>$UserID,
				'FollowerID'=>$this->session->UserID
			];
			$this->pm->addFollow($insert_data);
			echo '<i class="fa fa-check" style="font-size:1.2em;color:white;margin-right:5px;"></i>Followed';
		}
	}
}
?>