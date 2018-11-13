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
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/Course_m', 'model');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		$acd1 = $this->jsdtc->dtImage('resources/admin/uploads/', 'CourseImage');
		$acd2 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'AddedByAdminName','AdminID');
		if($id)
		{
			$acd3 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
						$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
						$this->jsdtc->dtUpdateButton($this->__ID);
			$data['add_facility']=0;
			$data['CategoryID']=$id;
		}
		else
		{
			$acd3 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
						$this->jsdtc->dtMoreInfoAjaxButton($this->__ID);
			$data['add_facility']=1;
			$data['CategoryID']=FALSE;
		}
		$acd4=$this->jsdtc->dtLink(site_url('admin/chapter/'),'View Chapters','CourseID');
		//$this->jsdtc->dtMoreInfoLinkButton(site_url('admin/chapter/'),'CourseID');
		$actionColumnData = [$acd1, $acd2, $acd3, $acd4];
		$columnNames =[
			//$this->__ID,
			false, //for $acd1
			'CourseName',
			'CategoryName',
			false, //for $acd2
			$this->__STATUS,
			false, //for $acd3
			false //for $acd4
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
			'Image',
			'Course Name',
			'Category Name',
			'Added By Admin',
			'Status',
			'Action',
			'View Sections'
		];
		//$data['category_data']=$this->model->get_entity
		get_views('course',"Manage $this->__ENTITY", $data);
	}
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['a1.CategoryID']=$id;
		$query = $this->model->get_entity($this->__TABLE,$where);
		$this->enum->exchangeOptions('coursestatus', $this->__STATUS, $query['course_data']);
		echo $this->jsdtc->dtData($query['course_data']);
	}
	public function addEntityData($id=FALSE)
	{
		if($id==FALSE)
			redirect('admin/Course');
		$this->form_validation->set_rules('aCourseName', 'Course Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$image='aCourseImage';
			$insert_data =[
				'CourseName' => $this->input->get_post('aCourseName'),
				'CourseDescription' => $this->input->get_post('aCourseDescription'),
				$this->__STATUS => 0,
				'AddedByAdminId' => $this->session->AdminID,
				'CategoryID' => $id
			];
			if($this->upload->do_upload($image))
			{
				$upload_data = $this->upload->data();
				$insert_data['CourseImage'] = $upload_data['file_name'];
			}
			$this->model->add_entity($this->__TABLE, $insert_data);
			@unlink($_FILES[$image]);
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($this->__TABLE, $where);
		$query['course_data']=$this->enum->exchangeOptions('coursestatus', $this->__STATUS, $query['course_data']);
		return $query; 
	}
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id);
		// echo '<pre>';
		// print_r($EntityData);
		// echo '</pre>';
		// die('hello');
		
		?>
			<?php $pf="u"; ?>

			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseName" >Course Name</label>
							<input name="<?=$pf?>CourseName" id="<?=$pf?>CourseName" type="text" class="form-control" placeholder="Course Name" value="<?=$EntityData['course_data'][0]->CourseName?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseDescription" >Description</label>
							<input name="<?=$pf?>CourseDescription" id="<?=$pf?>CourseDescription" type="text" class="form-control" placeholder="Description" value="<?=$EntityData['course_data'][0]->CourseDescription?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty is-fileinput">
							<label for="<?=$pf?>CourseImage" >Image</label>
							<a href="#" style="cursor:pointer;" onclick="$(this).next().trigger('click')">
								<img src="<?=base_url().'resources/admin/uploads/'.$EntityData['course_data'][0]->CourseImage?>" style="height: 180px;width: 180px;" data-toggle="tooltip" title="To Change Image, Click On It">
							</a>
							<input name="<?=$pf?>CourseImage" id="<?=$pf?>CourseImage" type="file" style="display: none" class="imgUpload">
						</div>
					</div>
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
			// echo '<pre>';
			// print_r($this->input->get_post());
			// echo '</pre>';
			// die('hello');
			$uCourseImage='uCourseImage';
			$updateData=[
				'CourseName'=>$this->input->get_post('uCourseName'),
				'CourseDescription'=>$this->input->get_post('uCourseDescription'),
				//'CourseDescription'=>$this->input->get_post('uCategoryID'),
			];
			if($this->upload->do_upload($uCourseImage))
			{	
				$upload_data = $this->upload->data();
				$updateData['CourseImage'] = $upload_data['file_name'];
			}
			$table = $this->__TABLE;
			$where = [
				$this->__ID => $this->input->post("u".$this->__ID)
			];
			$this->model->update_entity($table, $updateData, $where);
			@unlink($_FILES[$uCourseImage]);
			echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//get data & content(html) for displaying information modal
	public function getInfoEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)['course_data'][0];
		//echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);	
		?>
			<?php $pf="d"; ?>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseName">Course Name</label>
							<input type="text" name="<?=$pf?>CourseName" id="<?=$pf?>CourseName" class="form-control" placeholder="e.g., John" value="<?=$EntityData->CourseName?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseDescription">Course Description</label>
							<input type="text" name="<?=$pf?>CourseDescription" id="<?=$pf?>CourseDescription" class="form-control" placeholder="e.g., Something About Course" value="<?=$EntityData->CourseDescription?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CategoryName">Category Name</label>
							<input type="text" name="<?=$pf?>CategoryName" id="<?=$pf?>CategoryName" class="form-control" placeholder="e.g., Something About Course" value="<?=$EntityData->CategoryName?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseStatus">Course Status</label>
							<input type="text" name="<?=$pf?>CourseStatus" id="<?=$pf?>CourseStatus" class="form-control" placeholder="e.g., Something About Course" value="<?=$EntityData->CourseStatus?>" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty is-fileinput">
							<label for="<?=$pf?>CourseImage">Course Image</label></br>
							<a href="#" style="cursor: pointer;">
								<img src="<?=base_url('resources/admin/uploads/').$EntityData->CourseImage?>"  id="dCourseImage" style="height: 180px;width: 180px;">
							</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>AddedByAdminName">Added By Admin</label>
							<input type="text" name="<?=$pf?>AddedByAdminName" id="<?=$pf?>AddedByAdminName" class="form-control" placeholder="e.g., Something About Course" value="<?=$EntityData->AddedByAdminName?>" disabled>
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