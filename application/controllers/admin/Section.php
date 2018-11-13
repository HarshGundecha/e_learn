<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Section extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='SectionID';
	private $__TABLE='tblsection';
	private $__ENTITY='Section';
	private $__STATUS='SectionStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Section'], 'jsdtc');
		$this->load->model('admin/Section_m', 'model');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		$acd1 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/sectiondetail/'),'SectionName','SectionID');
		$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
		if($id)
		{
			$acd3 = $this->jsdtc->dtLink(site_url('admin/Section/updatesection/'),'Update Section','SectionID');
			$actionColumnData = [$acd1, $acd2, $acd3];
			$columnNames =[
				//$this->__ID,
				false, //acd1
				'ChapterName',
				'AddedByAdminName',
				$this->__STATUS,
				false, //acd2
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
			$data['thead'] = [
				//'#',
				'Section Name',
				'Chapter Name',
				'Added By Admin Name',
				'Status',
				'Action',
				'Update Section',
			];
			$data['ChapterID']=$id;
			$data['add_facility']=0;
		}
		else
		{
			$actionColumnData = [$acd1, $acd2];
			$columnNames =[
				$this->__ID,
				false, //acd1
				'ChapterName',
				'AddedByAdminName',
				$this->__STATUS,
				false, //acd2
			];
			$data['DataTableCode']= // no changes required here
				$this->jsdtc->getDatatable
				(
					"#tblView".$this->__ENTITY, 
					"admin/{$this->__ENTITY}/getDtData/", 
					$columnNames,
					$actionColumnData
				);
			$data['thead'] = [
				'#',
				'Section Name',
				'Chapter Name',
				'Added By Admin Name',
				'Status',
				'Action',
			];
			$data['ChapterID']=FALSE;
			$data['add_facility']=1;
		}
		$data['Entity'] = $this->__ENTITY;
		get_views('section',"Manage $this->__ENTITY", $data);
		//$this->load->view('admin/'.$this->__ENTITY,$data);
	}

	//call section details view
	public function sectiondetail($id=FALSE)
	{
		if($id==FALSE)
			redirect('admin/section');
		$data['sd']=$this->model->get_entity_detail($id);
		$data['Entity']=$this->__ENTITY;
		get_views('sectiondetail', 'Section Details', $data);
	}

	//call view of update with its data
	public function updatesection($id=FALSE)
	{
		if($id==FALSE)
			redirect('admin/Section');
		$where['s.SectionID']=$id;
		$data = $this->model->get_update_entity($where);
		
// echo "<pre>";
// print_r($data);
// echo "</pre>";
// die();
			
		$data['section_data'] = $this->enum->exchangeOptions('sectionstatus', $this->__STATUS, $data['section_data']);
		get_views('updatesection',"Update $this->__ENTITY", $data);	
	}

	//update entity data
	public function updateEntityData($id,$ChapterID)
	{
		$validation = [
			[
				'field' => 'uSectionContent',
				'label' => 'Section Content',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
			echo "invalid";
		else
		{
			$update_data =[
				'SectionName' => $this->input->get_post('uSectionName'),
				'SectionContent' => $this->input->get_post('uSectionContent'),
			];
			$this->model->update_entity($this->__TABLE, $update_data, $id);
			//echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
			redirect('admin/Section/'.$ChapterID);
		}
	}

	public function addsectionview($ChapterID)
	{
		$data['ChapterID']=$ChapterID;
		$data['Entity'] = $this->__ENTITY;
		get_views('addsection', 'Add Section', $data);
	}

	//add entity data
	public function addEntityData($ChapterID=FALSE)
	{
		$validation = [
			[
				'field' => 'aSectionContent',
				'label' => 'Section Content',
				'rules' => 'trim|required'
			],
			[
				'field' => 'aSectionName',
				'label' => 'Section Name',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
		{
			$data['error']="Please Fill All Details";
			$data['ChapterID']=$ChapterID;
			$data['Entity'] = $this->__ENTITY;
			get_views('addsection', 'Add Section', $data);
		}
		else
		{
			$insert_data =[
				'SectionName' => $this->input->get_post('aSectionName'),
				'SectionContent' => $this->input->get_post('aSectionContent'),
				'AddedByAdminID' => $this->session->AdminID,
				'ChapterID' => $ChapterID,
			];
			$this->model->add_entity($this->__TABLE, $insert_data);
			//echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
			redirect('admin/section/'.$ChapterID);
		}
	}

	//echoing datatable JSON data
	public function getDtData($id=false)
	{
		// $where=false;
		// if($id)
		// 	$where['a1.SectionID']=$id;
		$query = $this->model->get_entity($id);
		$this->enum->exchangeOptions('sectionstatus', $this->__STATUS, $query['section_data']);
		echo $this->jsdtc->dtData($query['section_data']);
	}

	// retrieve/select entity data
	/*private function getEntityData($id=FALSE)
	{
		//$where = [$this->__ID=>$id];
		if($id==FALSE)
			redirect('admin/Section');
		$query = $this->model->get_entity($id);
		$query['section_data']=$this->enum->exchangeOptions('sectionstatus', $this->__STATUS, $query['section_data']);
		return $query;
	}*/

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

}