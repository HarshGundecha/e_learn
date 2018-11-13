<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='CategoryID';
	private $__TABLE='tblcategory';
	private $__ENTITY='Category';
	private $__STATUS='CategoryStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Category'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/category_m','model');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		/*if($id==FALSE)
			redirect('admin/Course');*/
		$acd1 = $this->jsdtc->dtLink2(site_url('admin/Admin/'),'AddedByAdminName','AddedByAdminID');
		$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
							$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
								$this->jsdtc->dtUpdateButton($this->__ID);
		$acd3 = $this->jsdtc->dtLink(site_url('admin/Course/'),'View Courses','CategoryID');
		$actionColumnData = [$acd1, $acd2, $acd3];
		$columnNames =[
			//$this->__ID,
			'CategoryName',
			false, // $acd1
			$this->__STATUS,
			false, // $acd2
			false, // $acd3
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
			'Category Name',
			'Added By Admin',
			'Status',
			'Action',
			'Courses'
			//'CreatedDateTime'
		];
		$data['CourseID']=$id;
		get_views('category',"Manage $this->__ENTITY", $data);
		//$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['a3.ChapterID']=$id;
		$query = $this->model->get_entity($where);
		$this->enum->exchangeOptions('categorystatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData($ChapterID=FALSE)
	{
		$validation = [
			[
				'field' => 'aCategoryName',
				'label' => 'Category Name',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$aCategoryImage='aCategoryImage';
			$insert_data =[
				'CategoryName' => $this->input->get_post('aCategoryName'),
				'AddedByAdminID' => $this->session->AdminID,
			];
			$this->model->add_entity($this->__TABLE, $insert_data);
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		return $this->enum->exchangeOptions('chapterstatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>

			<?php $pf="u"; ?>
			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>
				<div class="form-group is-empty">
					<label for="<?=$pf?>CategoryName">Category Name</label>
					<input type="text" name="<?=$pf?>CategoryName" id="<?=$pf?>CategoryName" class="form-control" placeholder="e.g., John" value="<?=$EntityData->CategoryName;?>">
				</div>
		<?php
	}

	//set data for updating entity
	public function updateEntityData()
	{
		$this->form_validation->set_rules('uCategoryName', 'Category Name', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$updateData=[
				'CategoryName'=>$this->input->get_post('uCategoryName'),
			];
			//die($this->upload->display_errors());
			$table = $this->__TABLE;
			$where = [
				$this->__ID => $this->input->post("u".$this->__ID)
			];
			$this->model->update_entity($table, $updateData, $where);
			echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//get data & content(html) for displaying information modal
	public function getInfoEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		//echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
		?>
			<?php $pf="d"; ?>
			<div class="col-md-9">
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CategoryName">Category Name</label>
							<input type="text" name="<?=$pf?>CategoryName" id="<?=$pf?>CategoryName" class="form-control" placeholder="e.g., John" value="<?=$EntityData->CategoryName;?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>AddedByAdminName">Added By Admin</label>
							<input type="text" name="<?=$pf?>AddedByAdminName" id="<?=$pf?>AddedByAdminName" class="form-control" placeholder="e.g., John" value="<?=$EntityData->AddedByAdminName;?>" disabled>
						</div>
					</div>
				</div>
			</div>
		<?php
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
}