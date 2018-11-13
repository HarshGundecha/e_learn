<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID			=	'UserID';
	private $__TABLE 	=	'tbluser';
	private $__ENTITY	=	'User';
	private $__STATUS	=	'UserStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['User'], 'jsdtc');
		$this->load->model('admin/User_m', 'model');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		if($id)
		{
			$data['ud']=$this->model->get_user_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('userdetail', 'User Details', $data);
		}
		else
		{
			$acd1 = $this->jsdtc->dtImage('resources/user/uploads/', 'UserAvatar');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/user/'),'UserName','UserID');
			$acd3 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
			$actionColumnData = [$acd1, $acd2, $acd3];
			$columnNames =[
				//$this->__ID,
				false, //acd1
				false, //acd2
				'UserEmail',
				$this->__STATUS,
				false, //acd3
			];
			$data['DataTableCode']= // no changes required here
				$this->jsdtc->getDatatable
				(
					"#tblView".$this->__ENTITY, 
					"admin/{$this->__ENTITY}/getDtData/$id", 
					$columnNames,
					$actionColumnData
				);

			$data['Entity'] = $this->__ENTITY;
			$data['thead'] = [
				//'#',
				'Profile Detail',
				'User Name',
				'Email',
				'Status',
				'Action',
			];
			$data['UserID']=$id;
			get_views('user',"Manage $this->__ENTITY", $data);
		}
		//$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		/*if($id)
			$where['a3.ChapterID']=$id;*/
		$query = $this->model->get_entity($where);
		$this->enum->exchangeOptions('userstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		return $this->enum->exchangeOptions('userstatus', $this->__STATUS, $query);
	}

	//toggle DB status of the entity
	public function toggleEntityStatus($id)
	{
		$table = $this->__TABLE;
		$updateData = [ $this->__STATUS => '1-'.$this->__STATUS ];
		$where = [
			$this->__ID => $id
		];
		$this->model->toggle_entity_status($table, $updateData, $where);
		echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}

	/*public function userdetail($id=FALSE)
	{
		if($id)
		{
			$data['ud']=$this->model->get_user_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('userdetail', 'User Details', $data);
		}
	}*/

}