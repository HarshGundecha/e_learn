<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='CourseID';
	private $__TABLE='tblcourse';
	private $__ENTITY='Course';
	private $__STATUS='CourseStatus';

	//constructor
  public function __construct()
  {
    parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Course'], 'jsdtc');
    $this->load->library('upload', [
    	'upload_path' => './uploads/',
    	'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
    ]);
    $this->load->model('admin/Course_m');
  }

  //loading datatable view with data
	public function index()
	{
		$acd1 = $this->jsdtc->dtImage('resources/admin/uploads/', 'Image');
		$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
							$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
								$this->jsdtc->dtUpdateButton($this->__ID);
		$acd3=$this->jsdtc->dtLink(site_url('admin/chapter/index/'),'View Chapters','CourseID');
									//$this->jsdtc->dtMoreInfoLinkButton(site_url('admin/chapter/index/'),'CourseID');

		$actionColumnData = [$acd1, $acd2, $acd3];

		$columnNames =[
			$this->__ID,
			false, //for $acd1
			'CourseName',
			'Description',
			$this->__STATUS,
			false, //for $acd2
			false
		];

		$data['DataTableCode']= // no changes required here
			$this->jsdtc->getDatatable
			(
				"#tblView".$this->__ENTITY, 
				"admin/{$this->__ENTITY}/getDtData", 
				$columnNames,
				$actionColumnData
			);
		$data['Entity'] = $this->__ENTITY;
		$data['thead'] = [
			'#',
			'Image',
			'Name',
			'Chapter',
			'Status',
			'Action',
			'View Sections'
		];
		get_views('course',"Manage $this->__ENTITY", $data);
		//$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['CourseID']=$id;
		$query = $this->Course_m->get_entity($this->__TABLE,$where);
		$this->enum->exchangeOptions('coursestatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData()
	{
	  $this->form_validation->set_rules('aCourseName', 'Course Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$image='aImage';
			$insert_data =[
			  'CourseName' => $this->input->get_post('aCourseName'),
			  'Description' => $this->input->get_post('aDescription'),
			  $this->__STATUS => 0
			];
			if($this->upload->do_upload($image))
	    {
	    	$upload_data = $this->upload->data();
				$insert_data['Image'] = $upload_data['file_name'];
	    }
			$this->Course_m->add_entity($this->__TABLE, $insert_data);
	    @unlink($_FILES[$image]);
	  	echo json_encode(['status'=>true, 'message'=>validation_errors()]);
	  }
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Course_m->get_entity($this->__TABLE, $where);
		return $this->enum->exchangeOptions('coursestatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row">

		        		<div class="col-md-12">

		        			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

				          <div class="form-group">
				            <label for="uCourseName" >Course Name</label>
				            <input name="uCourseName" id="uCourseName" type="text" class="form-control" placeholder="Course Name" value="<?=$EntityData->CourseName?>">
				          </div>
				        </div>

		        		<div class="col-md-12">

		        			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

				          <div class="form-group">
				            <label for="uDescription" >Description</label>
				            <input name="uDescription" id="uDescription" type="text" class="form-control" placeholder="Description" value="<?=$EntityData->Description?>">
				          </div>
				        </div>

							</div>
						</div>

		        <div class="col-md-6">
		          <div class="form-group">
		            <label for="uImage" >Image</label>
                <a href="#" data-toggle="tooltip" title="To Change Image Click On It" style="cursor: pointer;" onclick="$(this).next().trigger('click')">
                	<img src="<?=base_url().'uploads/'.$EntityData->Image?>" style="height: 240px;width: 240px;" class="form-control">
                </a>
                <input name="uImage" id="uImage" type="file" style="display: none" class="imgUpload">
		          </div>
		        </div>
		        
					</div>
				</div>
				<div class="box-footer">
					<input name="btnUpdate<?=$this->__ENTITY?>" id="btnUpdate<?=$this->__ENTITY?>" type="button" class="btn btn-success" value="Update <?=$this->__ENTITY?>">
					<button type="reset" class="btn btn-danger pull-right">Reset</button>
				</div>
			</div>
    	<script type="text/javascript">
				function readURL(input)	{
				  if (input.files && input.files[0]) {
				    var reader = new FileReader();
				    reader.onload = function(e) {
				      $(input).prev().children(":first").attr('src', e.target.result);
				    }
				    reader.readAsDataURL(input.files[0]);
				  }
				}
				$(".imgUpload").change(function() {
				  readURL(this);
				});
			</script>
		<?php
	}

	//set data for updating entity
	public function updateEntityData()
	{
	  $this->form_validation->set_rules('uCourseName', 'Course Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$uAvatar='uImage';
			$updateData=[
				'CourseName'=>$this->input->get_post('uCourseName'),
				'Description'=>$this->input->get_post('uDescription'),
			];
			if($this->upload->do_upload($uAvatar))
			{	
				$upload_data = $this->upload->data();
				$updateData['Image'] = $upload_data['file_name'];
			}
			$table = $this->__TABLE;
			$where = [
				$this->__ID => $this->input->post("u".$this->__ID)
			];
			$this->Course_m->update_entity($table, $updateData, $where);
	    @unlink($_FILES[$uAvatar]);
		  echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//get data & content(html) for displaying information modal
	public function getInfoEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
	  //echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
		        		<div class="col-md-6">
				          <div class="form-group">
				            <label for="dCourseName" >Course Name</label>
				            <input name="dCourseName" id="dCourseName" type="text" class="form-control" placeholder="Course Name" disabled="" style="background-color: white"  value="<?=$EntityData->CourseName?>">
				          </div>
				        </div>
		        		<div class="col-md-6">
				          <div class="form-group">
				            <label for="dDescription" >Description</label>
				            <input name="dDescription" id="dDescription" type="text" class="form-control" placeholder="Description" disabled="" style="background-color: white"  value="<?=$EntityData->Description?>">
				          </div>
				        </div>
							</div>
						</div>
		        <div class="col-md-12">
		          <div class="form-group">
		            <label for="dImage" >Profile Picture</label>
		          	<img src="<?=base_url().'uploads/'.$EntityData->Image?>" id="dImage" style="height: 240px;width: 240px;" class="form-control">
		          </div>
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
		$this->Course_m->toggle_entity_status($table, $updateData, $where);
	  echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}
}