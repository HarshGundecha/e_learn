<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ForumQuestion extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID			=	'ForumQID';
	private $__TABLE 	=	'tblforumq';
	private $__ENTITY	=	'ForumQuestion';
	private $__STATUS	=	'ForumQStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['ForumQuestion'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/ForumQuestion_m', 'model');
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
			$data['qd']=$this->model->get_question_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('questiondetail', 'Question Details', $data);
		}
		else
		{
			$acd1 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'ForumQTitle','ForumQID');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/'.'User'.'/'),'UserName','UserID');
			$acd3 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
			$actionColumnData = [$acd1, $acd2, $acd3];
			$columnNames =[
				//$this->__ID,
				false, //acd1
				false, //acd2
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
				'Question Title',
				'Posted By',
				'Status',
				'Action',
			];
			get_views('forumquestion',"Manage $this->__ENTITY", $data);
		}
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		/*if($id)
			$where['a3.ChapterID']=$id;*/
		$query = $this->model->get_entity($where);
		$this->enum->exchangeOptions('forumqstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		return $this->enum->exchangeOptions('chapterstatus', $this->__STATUS, $query);
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

	//toggle status of answers
	public function toggleAnswer($ForumQID=FALSE, $ForumAID=FALSE)
	{
		if($ForumQID && $ForumAID && is_numeric($ForumQID) && is_numeric($ForumAID))
		{
			$this->model->toggle_answer_status($ForumAID);
			redirect('admin/ForumQuestion/'.$ForumQID);
		}
		else
			redirect('admin/Error_404');
	}

	/*public function questiondetail($id=FALSE)
	{
		if($id)
		{
			$data['qd']=$this->model->get_question_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('questiondetail', 'Question Details', $data);
		}
	}*/

}