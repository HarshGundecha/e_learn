<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tag extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='TagID';
	private $__TABLE='tbltag';
	private $__ENTITY='Tag';
	private $__STATUS='TagStatus';

	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Tag'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/Tag_m');
		if(!$this->session->AdminID)
			redirect('admin/Login');
	}
	//loading datatable view with data
	public function index($id=false)
	{
		if($id)
		{
		    if($this->session->TagLevel!=0 && $this->session->TagID!=$id)
		    	redirect('admin/Course');
			$data['ad']=$this->Tag_m->get_tag_data($id);
			if(count($data['ad']['admin_data'])!=1)
				redirect('admin/Error_404');
			$data['Entity']=$this->__ENTITY;
			get_views('admindetail', 'Tag Details', $data);
		}
		else
		{
			$actionColumnData = [
				$this->jsdtc->dtLink2(site_url('admin/Admin/'),'AddedByAdminName','AddedByAdminID'),
				$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
					$this->jsdtc->dtUpdateButton($this->__ID)
			];
			$columnNames =[
				'TagName',
				'TagDescription',
				false,
				'TagStatus',
				false,
			];

			$data['thead'] = [
				'Name',
				'Description',
				'Added by Admin',
				'Status',
				'Action'
			];

			$data['Entity'] = $this->__ENTITY;

			$data['DataTableCode']= // no changes required here
				$this->jsdtc->getDatatable
				(
					"#tblView{$this->__ENTITY}", 
					"admin/{$this->__ENTITY}/getDtData", 
					$columnNames,
					$actionColumnData
				);

			get_views('tag',"Manage $this->__ENTITY", $data);
			//$this->load->view('admin/'.$this->__ENTITY,$data);
		}
	}

  //echoing datatable JSON data
	public function getDtData()
	{
		$query = $this->Tag_m->get_entity();
		$this->enum->exchangeOptions('tagstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData()
	{
		$validation = [
			[
				'field' => 'aTagName',
				'label' => 'Tag Name',
				'rules' => 'trim|required|strtolower|is_unique[tbltag.TagName]|max_length[50]|alpha_dash'
			],
			[
				'field' => 'aTagDescription',
				'label' => 'Description',
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
			$aTagImage='aTagImage';
			$insert_data =[
				'TagName' => $this->input->get_post('aTagName'),
				'TagDescription' => $this->input->get_post('aTagDescription'),
				'AddedByAdminID' => $this->session->AdminID,
				$this->__STATUS => 0
			];
			$this->Tag_m->add_entity($this->__TABLE, $insert_data);
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Tag_m->get_entity($where);
		return $this->enum->exchangeOptions('tagstatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
		$EntityData=$this->getEntityData($id)[0];
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>

			<?php $pf="u"; ?>
			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

			<div class="col-md-12">
				<div class="form-group is-empty">
					<label for="<?=$pf?>TagDescription">Description</label>
					<input type="text" name="<?=$pf?>TagDescription" id="<?=$pf?>TagDescription" class="form-control" placeholder="e.g., frontend scripting language" value="<?=$EntityData->TagDescription?>">
				</div>
			</div>
		<?php
	}

	//set data for updating entity
	public function updateEntityData($id=false)
	{
		$validation = [
			[
				'field' => 'uTagDescription',
				'label' => 'Description',
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
			$updateData=[
				'TagDescription'=>$this->input->get_post('uTagDescription'),
			];
			$table = $this->__TABLE;
			if($id)
				$where = [
					'TagId' => $id
				];
			else
				$where = [
					$this->__ID => $this->input->post("u".$this->__ID)
				];
			$this->Tag_m->update_entity($table, $updateData, $where);
			echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//set data for updating PARTICULAR entity (user self updation)
	public function updatetagData($id=false)
	{
		$validation = [
			[
				'field' => 'uTagName',
				'label' => 'Tag Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'uTagContactNo',
				'label' => 'Contact No.',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'uTagPassword',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]|max_length[35]'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$uTagImage='uTagImage';
			$updateData=[
				'TagName'=>$this->input->get_post('uTagName'),
				'TagContactNo'=>$this->input->get_post('uTagContactNo'),
				'TagPassword'=>$this->input->get_post('uTagPassword'),
			];
			if($this->upload->do_upload($uTagImage))
			{	
				$upload_data = $this->upload->data();
				$updateData['TagImage'] = $upload_data['file_name'];
			}
			//die('hello'.$this->upload->display_errors());
			$table = $this->__TABLE;
			$where = [
				'TagId' => $id
			];
			$this->Tag_m->update_entity($table, $updateData, $where);
			@unlink($_FILES[$uTagImage]);
			//redirect('admin/admin/admindetail/'.$id);
			//echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
			redirect('admin/admin/admindetail/'.$id);
		}
	}

	//toggle DB status of the entity
	public function toggleEntityStatus($id)
	{
	    if($this->session->TagLevel!=0)
		    redirect('admin/Course');
		$table = $this->__TABLE;
		$updateData = [ $this->__STATUS => '1-'.$this->__STATUS ];
		$where = [
			$this->__ID => $id
		];
		$this->Tag_m->toggle_entity_status($table, $updateData, $where);
		echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}

	// get perticular admin detail for profile display 
	public function updatetag($id=FALSE)
	{
		if($id)
		{
			$data['aud']=$this->Tag_m->get_update_entity($id);
			get_views('updatetag', 'Update Tag Details', $data);
		}
	}

	// get perticular admin detail for update display 
	//08-04-2018 deprecated, to be removed soon
	public function tagdetail($id=FALSE)
	{
	    if($id)
		{
			$data['ad']=$this->Tag_m->get_tag_data($id);
			$data['Entity']=$this->__ENTITY;
			$data['aud']=$this->Tag_m->get_update_entity($id);
			get_views('tagdetail', 'Tag Details', $data);
		}
	}
}