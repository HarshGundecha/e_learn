<?php
// old, untested and incomplete
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller
{
	//class variables
	private static $entity_id='CategoryID';
	private static $entity_table='tblcategory';
	private static $Entity='Category';
	private static $entity_status='CategoryStatus';

	//constructor
  public function __construct()
  {
    parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('JsDatatableCode', NULL, 'jsdtc');
		$this->load->library('Enum');
		$this->load->helper('url');
  }

  //loading datatable view with data
	public function index()
	{
		$acd1 =
			$this->jsdtc->dtMoreInfoAjaxButton(self::$entity_id).
				$this->jsdtc->dtUpdateButton(self::$entity_id).
					$this->jsdtc->dtToggleStatusButton(self::$entity_id, self::$entity_status);

		$actionColumnData = [$acd1];

		$columnNames =[
			self::$entity_id,
			'CategoryName',
			self::$entity_status,
			false
		];

		$data['DataTableCode']=
			$this->jsdtc->getDatatable
			(
				"#tblView".self::$Entity, 
				self::$Entity."/getDtData", 
				$columnNames,
				$actionColumnData
			)
				.$this->jsdtc->dtMoreInfoAjaxButtonJSCode(self::$Entity)
					.$this->jsdtc->dtUpdateButtonJSCode(self::$Entity)
						.$this->jsdtc->dtToggleStatusButtonJSCode(self::$Entity);

		$this->load->view('admin/'.self::$Entity,$data);
	}

  //echoing datatable JSON data
	public function getDtData()
	{
		$query = $this->db->get(self::$entity_table);
		$this->enum->exchangeOptions('categorystatus', self::$entity_status, $query->result());
		echo $this->jsdtc->dtData($query->result());
	}

	//add entity data
	public function addEntityData()
	{
		$insert_data =[
		  'CategoryName' => $this->input->get_post('aCategoryName'),
		  self::$entity_status => 0
		];
		$this->db->insert(self::$entity_table, $insert_data);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$query = $this->db->where(self::$entity_id,$id)->get(self::$entity_table);
		$this->enum->exchangeOptions('categorystatus', self::$entity_status, $query->result());
		return $query->result();
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent()
	{
		$EntityData=$this->getEntityData($this->uri->segment(4))[0];
		$this->session->set_flashdata("flash_".self::$entity_id, $this->uri->segment(4));
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row">

				        <div class="col-md-12">
				          <div class="form-group">
				            <label for="uCategoryName">Category Name</label>
				            <input name="uCategoryName" id="uCategoryName" type="text" class="form-control" placeholder="Category Name" value="<?=$EntityData->CategoryName?>">
				          </div>
				        </div>

							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<input name="btnUpdate<?=self::$Entity?>" id="btnUpdate<?=self::$Entity?>" type="button" class="btn btn-success" value="Update <?=self::$Entity?>">
					<button type="reset" class="btn btn-danger pull-right">Reset</button>
				</div>
			</div>
		<?php
	}

	//set data for updating entity
	public function updateEntityData()
	{
		$updateData=[
			'CategoryName'=>$this->input->get_post('uCategoryName'),
		];

		$this->db->set($updateData);
		$this->db->where(self::$entity_id, $this->session->flashdata("flash_".self::$entity_id));
		$query=$this->db->update(self::$entity_table);
	}

	//get data & content(html) for displaying information modal
	public function getInfoEntityContent()
	{
		$EntityData=$this->getEntityData($this->uri->segment(4))[0];
		?>
			<div class="col-md-12">
				<div class="box-body">
					<div class="row">

        		<div class="col-md-6">
		          <div class="form-group">
		            <label for="dCategoryName" >Category Name</label>
		            <input name="dCategoryName" id="dCategoryName" type="text" class="form-control" placeholder="Category Name" disabled="" style="background-color: white"  value="<?=$EntityData->CategoryName?>">
		          </div>
		        </div>

        		<div class="col-md-6">
		          <div class="form-group">
		            <label for="dCategoryStatus" >Status</label>
		            <input name="dCategoryStatus" id="dCategoryStatus" type="text" class="form-control" disabled="" style="background-color: white"  value="<?=$EntityData->CategoryStatus?>">
		          </div>
		        </div>

        		<div class="col-md-6">
		          <div class="form-group">
		            <label for="dCreatedDate" >Created Date Time</label>
		            <input name="dCreatedDate" id="dCreatedDate" type="text" class="form-control" disabled="" style="background-color: white"  value="<?=$EntityData->CreateDateTime?>">
		          </div>
		        </div>

        		<div class="col-md-6">
		          <div class="form-group">
		            <label for="dAmendmentDate" >Amendment Date Time</label>
		            <input name="dAmendmentDate" id="dAmendmentDate" type="text" class="form-control" disabled="" style="background-color: white"  value="<?=$EntityData->AmendmentDateTime?>">
		          </div>
		        </div>

					</div>
				</div>
			</div>
		<?php
	}

	//toggle DB status of the entity
	public function toggleEntityStatus()
	{
		$this->db->set(self::$entity_status, '1-'.self::$entity_status, FALSE);
		$this->db->where(self::$entity_id, $this->uri->segment(4));
		$this->db->update(self::$entity_table, $data);

		/*$data = array(
		        self::$entity_status => 1-$this->enum->exchangeOptions('adminstatus',$this->uri->segment(5)),
		);*/
		//$this->db->where(self::$entity_id, $this->uri->segment(4));
		//$this->db->update(self::$entity_table, $data);
	}
}