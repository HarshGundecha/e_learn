<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('User_m','model');
		$this->load->library('upload', [
			'upload_path' => './resources/user/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		if(!$this->session->UserID)
		{
			redirect('Login');
		}
	}

	//get data to display
	public function index()
	{
		$where=array('UserID'=>$this->session->UserID);
		$data['UserData']=$this->model->getData($where);
		//$data['CountryData']=$this->model->getCountryData();
		//$data['UserData']=$this->enum->exchangeOptions('isemailvefied','IsEmailVerified', $data['UserData']);
		get_view('user',$this->session->UserName,$data);
	}

	//update password
	public function UpdatePassword()
	{
		$this->form_validation->set_rules('uCurrentPassword','Current Password','trim|required|min_length[8]');
		$this->form_validation->set_rules('uNewPassword','New Password','trim|required|min_length[8]|differs[uCurrentPassword]');
		$this->form_validation->set_rules('uRePassword','Confirm Password','trim|required|min_length[8]|matches[uNewPassword]');
		if($this->form_validation->run()==FALSE)
		{
			$this->index();
		}
		else
		{
			$update_data=['UserPassword' => $this->input->get_post('uNewPassword')];
			$where=[
				'UserPassword' => $this->input->get_post('uCurrentPassword'),
				'UserID' => $this->session->UserID
			];
			$data['flag']=$this->model->UpdatePasswordData($update_data,$where);
			$where=array('UserID'=>$this->session->UserID);
			$data['UserData']=$this->model->getData($where);
			get_view('user',$this->session->UserName,$data);
		}
	}

	public function UpdateProfile()
	{
		$this->form_validation->set_rules('uUserContactNo','Contact No','trim|required|min_length[10]');
		if($this->form_validation->run()==FALSE)
		{
			$data['flag2']=0;
			$where=['UserID' => $this->session->UserID];
			$data['UserData']=$this->model->getData($where);
			get_view('user',$this->session->UserName,$data);
		}
		else
		{
			$update_data=['UserContactNo' => $this->input->get_post('uUserContactNo')];
			if(trim($this->input->get_post('UserAddress'))!='')
			{
				$update_data['UserLatitude'] = $this->input->get_post('UserLatitude');
				$update_data['UserLongitude'] = $this->input->get_post('UserLongitude');
				$update_data['UserAddress'] = $this->input->get_post('UserAddress');
				$update_data['UserPostalCode'] = $this->input->get_post('UserPostalCode');
				$update_data['UserCity'] = $this->input->get_post('UserCity');
				$update_data['UserState'] = $this->input->get_post('UserState');
				$update_data['UserCountry'] = $this->input->get_post('UserCountry');
			}
			if($this->upload->do_upload('uUserAvatar'))
			{
				$upload_data = $this->upload->data();
				$update_data['UserAvatar'] = $upload_data['file_name'];
			}
			$where=['UserID' => $this->session->UserID];

			$data['flag2']=$this->model->UpdateProfileData($update_data,$where);

			$data['UserData']=$this->model->getData($where);
			get_view('user',$this->session->UserName,$data);
		}
	}

	/*
		public function get_state($cid=false)
		{
			if($cid && is_numeric($cid))
			{
				$where=['StateCountryID'=>$cid];			
				$StateData=$this->model->get_state_data($where);
				foreach ($StateData as $sd)
				{
					echo "<option value='$sd->StateID'>$sd->StateName</option>";
				}
			}
		}
		public function get_city($cid=false)
		{
			if($cid && is_numeric($cid))
			{
				$where=['CityStateID'=>$cid];			
				$CityData=$this->model->get_city_data($where);
				foreach ($CityData as $cd)
				{
					echo "<option value='$cd->CityID'>$cd->CityName</option>";
				}
			}
		}
	*/
}
?>