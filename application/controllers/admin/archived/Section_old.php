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
		$this->load->helper('url');
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Section'], 'jsdtc');
    $this->load->library('upload', [
    	'upload_path' => './uploads/',
    	'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
    ]);
    $this->load->model('admin/Section_m');
  }

  //loading datatable view with data
	public function index($id=false)
	{
		$acd1 = $this->jsdtc->dtImage('uploads/', 'Image');
		$acd2 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
							$this->jsdtc->dtMoreInfoAjaxButton($this->__ID).
								$this->jsdtc->dtUpdateButton($this->__ID);

		$actionColumnData = [$acd1,$acd2];

		$columnNames =[
			$this->__ID,
			false,
			'SectionName',
			'ChapterName',
			'SectionContent',
			$this->__STATUS,
			false //for $acd2
		];

		$data['DataTableCode']= // no changes required here
			$this->jsdtc->getDatatable
			(
				"#tblView".$this->__ENTITY, 
				site_url('admin/'.$this->__ENTITY."/getDtData/$id"), 
				$columnNames,
				$actionColumnData
			);

			$data['cData']=$this->Section_m->get_all_chapter();

		$this->load->view('admin/'.$this->__ENTITY,$data);
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		if($id)
			$where['tblsection.ChapterID']=$id;
		$query = $this->Section_m->get_entity($where);
		$this->enum->exchangeOptions('sectionstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData()
	{
	  $this->form_validation->set_rules('aSectionName', 'Section Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$image='aImage';
			$insert_data =[
			  'SectionName' => $this->input->get_post('aSectionName'),
			  'ChapterID' => $this->input->get_post('aChapterID'),
			  'SectionContent' => $this->input->get_post('aSectionContent'),
			  $this->__STATUS => 0
			];
			if($this->upload->do_upload($image))
	    {
	    	$upload_data = $this->upload->data();
				$insert_data['Image'] = $upload_data['file_name'];
	    }
			$this->Section_m->add_entity($this->__TABLE, $insert_data);
	    @unlink($_FILES[$image]);
	  	echo json_encode(['status'=>true, 'message'=>validation_errors()]);
	  }
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Section_m->get_entity($where);
		return $this->enum->exchangeOptions('adminstatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		$cData=$this->Section_m->get_all_chapter();
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
				            <label for="uSectionName" >Section Name</label>
				            <input name="uSectionName" id="uSectionName" type="text" class="form-control" placeholder="Section Name" value="<?=$EntityData->SectionName?>">
				          </div>
				        </div>

								<div class="col-md-12">
								  <div class="form-group">
								    <label for="uChapterID" >Chapter Name</label>
								    <select name="uChapterID" id="uChapterID" class="form-control">
								    	<?php
								    		foreach($cData as $cd)
								    		{
								    			?>
								          	<option value="<?=$cd->ChapterID?>"

								          		<?=$cd->ChapterID==$EntityData->ChapterID?'selected':''?>

								          		><?=$cd->ChapterName?></option>
								    			<?php
								    		}
								    	?>
								    </select>
								  </div>
								</div>
		        		<div class="col-md-12">

		        			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

				          <div class="form-group">
				            <label for="uSectionContent" >Section Content</label>
				            <input name="uSectionContent" id="uSectionContent" type="text" class="form-control" placeholder="Section Content" value="<?=$EntityData->SectionContent?>">
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
	  $this->form_validation->set_rules('uSectionName', 'Sectoin Name', 'required');

	  if ($this->form_validation->run() == FALSE)
	  {
	  	echo json_encode(['status'=>false, 'message'=>validation_errors()]);
	  }
	  else
	  {
			$image='uImage';
			$updateData=[
				'SectionName'=>$this->input->get_post('uSectionName'),
				'ChapterID'=>$this->input->get_post('uChapterID'),
				'SectionContent'=>$this->input->get_post('uSectionContent'),
			];
			if($this->upload->do_upload($image))
			{	
				$upload_data = $this->upload->data();
				$updateData['Image'] = $upload_data['file_name'];
			}
			$table = $this->__TABLE;
			$where = [
				$this->__ID => $this->input->post("u".$this->__ID)
			];
			$this->Section_m->update_entity($table, $updateData, $where);
	    @unlink($_FILES[$image]);
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
						<div class="col-md-6">
							<div class="row">
				        <div class="col-md-12">
				          <div class="form-group">
				            <label for="dChapterName" >Chapter Name</label>
				            <input name="dChapterName" id="dChapterName" type="text" class="form-control" placeholder="Chapter Name" disabled="" style="background-color: white" value="<?=$EntityData->ChapterName?>">
				          </div>
				        </div>
		        		<div class="col-md-12">
				          <div class="form-group">
				            <label for="dSectionName" >Section Name</label>
				            <input name="dSectionName" id="dSectionName" type="text" class="form-control" placeholder="Section Name" disabled="" style="background-color: white"  value="<?=$EntityData->SectionName?>">
				          </div>
				        </div>
		        		<div class="col-md-12">
				          <div class="form-group">
				            <label for="dSectionContent" >Section Content</label>
				            <input name="dSectionContent" id="dSectionContent" type="text" class="form-control" placeholder="Section Content" disabled="" style="background-color: white"  value="<?=$EntityData->SectionContent?>">
				          </div>
				        </div>
							</div>
						</div>
		        <div class="col-md-6">
		          <div class="form-group">
		            <label for="dImage" >Image</label>
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
		$this->Section_m->toggle_entity_status($table, $updateData, $where);
	  echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}
}