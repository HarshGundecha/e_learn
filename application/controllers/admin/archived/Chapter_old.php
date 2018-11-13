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

	//constructor
  public function __construct()
  {
    parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Chapter'], 'jsdtc');
    $this->load->library('upload', [
    	'upload_path' => './resourses/admin/uploads/',
    	'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
    ]);
    $this->load->model('admin/Chapter_m');
    if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
  }

  //loading datatable view with data
	public function index($id=false)
	{
		$acd1 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
							$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
								$this->jsdtc->dtUpdateButton($this->__ID);
		$acd2 = $this->jsdtc->dtLink(site_url('admin/section/index/'),'View Sections','ChapterID');
		$actionColumnData = [$acd1, $acd2];

		$columnNames =[
			$this->__ID,
			'ChapterName',
			'CourseName',
			$this->__STATUS,
			false, //for $acd2
			false
		];

		$data['DataTableCode']= // no changes required here
			$this->jsdtc->getDatatable
			(
				"#tblView".$this->__ENTITY, 
				site_url('admin/'.$this->__ENTITY."/getDtData/$id"), 
				$columnNames,
				$actionColumnData
			);

			$data['cData']=$this->Chapter_m->get_all_course();

		$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['tblchapter.CourseID']=$id;
		$query = $this->Chapter_m->get_entity($where);
		$this->enum->exchangeOptions('chapterstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData()
	{
	  $this->form_validation->set_rules('aChapterName', 'Chapter Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$insert_data =[
			  'ChapterName' => $this->input->get_post('aChapterName'),
			  'CourseID' => $this->input->get_post('aCourseID'),
			  $this->__STATUS => 0
			];
			$this->Chapter_m->add_entity($this->__TABLE, $insert_data);
	  	echo json_encode(['status'=>true, 'message'=>validation_errors()]);
	  }
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Chapter_m->get_entity($where);
		return $this->enum->exchangeOptions('adminstatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		$cData=$this->Chapter_m->get_all_course();
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">

		        		<div class="col-md-12">

		        			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

				          <div class="form-group">
				            <label for="uChapterName" >Chapter Name</label>
				            <input name="uChapterName" id="uChapterName" type="text" class="form-control" placeholder="Chapter Name" value="<?=$EntityData->ChapterName?>">
				          </div>
				        </div>

								<div class="col-md-12">
								  <div class="form-group">
								    <label for="uCourseID" >Course Name</label>
								    <select name="uCourseID" id="uCourseID" class="form-control">
								    	<?php
								    		foreach($cData as $cd)
								    		{
								    			?>
								          	<option value="<?=$cd->CourseID?>"

								          		<?=$cd->CourseID==$EntityData->CourseID?'selected':''?>

								          		><?=$cd->CourseName?></option>
								    			<?php
								    		}
								    	?>
								    </select>
								  </div>
								</div>
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
	  $this->form_validation->set_rules('uChapterName', 'Chapter Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$updateData=[
				'ChapterName'=>$this->input->get_post('uChapterName'),
				'CourseID'=>$this->input->get_post('uCourseID'),
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
		$EntityData=$this->getEntityData($id)[0];
	  //echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
		        		<div class="col-md-12">
				          <div class="form-group">
				            <label for="dChapterName" >Chapter Name</label>
				            <input name="dChapterName" id="dChapterName" type="text" class="form-control" placeholder="Chapter Name" disabled="" style="background-color: white"  value="<?=$EntityData->ChapterName?>">
				          </div>
				        </div>
				        <div class="col-md-12">
				          <div class="form-group">
				            <label for="dCourseName" >Course Name</label>
				            <input name="dCourseName" id="dCourseName" type="text" class="form-control" placeholder="Course Name" disabled="" style="background-color: white" value="<?=$EntityData->CourseName?>">
				          </div>
				        </div>
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
		$this->Chapter_m->toggle_entity_status($table, $updateData, $where);
	  echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}
}