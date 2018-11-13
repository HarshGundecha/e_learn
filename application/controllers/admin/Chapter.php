<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chapter extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='ChapterID';
	private $__TABLE='tblchapter';
	private $__ENTITY='Chapter';
	private $__STATUS='ChapterStatus';
	//private $__COURSEID=$this->uri->segment(4);
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Chapter'], 'jsdtc');
		$this->load->model('admin/Chapter_m');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		//if($id==FALSE)
			//redirect('admin/Course');
		$acd1 = $this->jsdtc->dtLink2(site_url('admin/admin/'),'AddedByAdminName','AddedByAdminID');
		if($id)
		{
			$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
								$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
									$this->jsdtc->dtUpdateButton($this->__ID);
			$data['add_facility']=0;
		}
		else
		{
			$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
								$this->jsdtc->dtMoreInfoAjaxButton($this->__ID);
			$data['add_facility']=1;
		}	
		$acd3 = $this->jsdtc->dtLink(site_url('admin/section/'),'View Sections','ChapterID');;
		$actionColumnData = [$acd1, $acd2, $acd3];
		$columnNames =[
			//$this->__ID,
			'ChapterName',
			'CourseName',
			false, //for $acd1
			$this->__STATUS,
			false, //for $acd2
			false, //for $acd2
		];
		if($id)
		{
    		$data['DataTableCode']= // no changes required here
    			$this->jsdtc->getDatatable
    			(
    				"#tblView".$this->__ENTITY, 
    				"admin/{$this->__ENTITY}/getDtData/".$id, 
    				$columnNames,
    				$actionColumnData
    			);
		}
		else
		{
    		$data['DataTableCode']= // no changes required here
    			$this->jsdtc->getDatatable
    			(
    				"#tblView".$this->__ENTITY, 
    				"admin/{$this->__ENTITY}/getDtData/", 
    				$columnNames,
    				$actionColumnData
    			);
		}
		$data['Entity'] = $this->__ENTITY;
		$data['thead'] = [
			//'#',
			'Chapter Name',
			'Course Name',
			'Added By Admin',
			'Status',
			'Action',
			'View Section',
		];
		$data['CourseID']=$id;
		get_views('chapter',"Manage $this->__ENTITY", $data);
		//$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['a3.CourseID']=$id;
		$query = $this->Chapter_m->get_entity($where);
		$this->enum->exchangeOptions('chapterstatus', $this->__STATUS, $query['chapter_data']);
		echo $this->jsdtc->dtData($query['chapter_data']);
	}

	//add entity data
	public function addEntityData($CourseID=FALSE)
	{
		$validation = [
			[
				'field' => 'aChapterName',
				'label' => 'Chapter Name',
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
			$insert_data =[
				'ChapterName' => $this->input->get_post('aChapterName'),
				'AddedByAdminID' => $this->session->AdminID,
				'CourseId' => $CourseID
			];
			$this->Chapter_m->add_entity($this->__TABLE, $insert_data);
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Chapter_m->get_entity($where);
		$this->enum->exchangeOptions('chapterstatus', $this->__STATUS, $query['chapter_data']);
		return $query;
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id);
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>

			<?php $pf="u"; ?>
			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>ChapterName">Name</label>
							<input type="text" name="<?=$pf?>ChapterName" id="<?=$pf?>ChapterName" class="form-control" placeholder="e.g., Control Structure" value="<?=$EntityData['chapter_data'][0]->ChapterName?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseID">Course</label>
							<select name="<?=$pf?>CourseID" id="<?=$pf?>CourseID" style="color:black;">
								<?php
									foreach ($EntityData['course_data'] as $Course) 
									{
										echo '<option value="'.$Course->CourseID.'">'.$Course->CourseName."</option>";
									}
								?>
							</select>
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
		$this->form_validation->set_rules('uChapterName', 'Chapter Name', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$updateData=[
				'ChapterName'=>$this->input->get_post('uChapterName'),
				'CourseID'=>$this->input->get_post('uCourseID')
			];
			$table = $this->__TABLE;
			$where = [
				$this->__ID => $this->input->post("u".$this->__ID)
			];
			$this->Chapter_m->update_entity($table, $updateData, $where);
			echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//get data & content(html) for displaying information modal
	public function getInfoEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)['chapter_data'][0];
		//echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
		// echo '<pre>';
		// print_r($EntityData);
		// echo '</pre>';
		// die('hello');
		
		?>
			<?php $pf="d"; ?>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>ChapterName">Chapter Name</label>
							<input type="text" name="<?=$pf?>ChapterName" id="<?=$pf?>ChapterName" class="form-control" placeholder="e.g., Control Structure" value="<?=$EntityData->ChapterName?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CreatedDateTime">Created Date Time</label>
							<input type="text" name="<?=$pf?>CreatedDateTime" id="<?=$pf?>CreatedDateTime" class="form-control" placeholder="e.g., C++" value="<?=$EntityData->CreatedDateTime?>" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>CourseName">Course Name</label>
							<input type="text" name="<?=$pf?>CourseName" id="<?=$pf?>CourseName" class="form-control" placeholder="e.g., C++" value="<?=$EntityData->CourseName?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>AddedByAdminName">Added By Admin Name</label>
							<input type="text" name="<?=$pf?>AddedByAdminName" id="<?=$pf?>AddedByAdminName" class="form-control" placeholder="e.g., C++" value="<?=$EntityData->AddedByAdminName?>" disabled>
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
		$this->Chapter_m->toggle_entity_status($table, $updateData, $where);
		echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}
}