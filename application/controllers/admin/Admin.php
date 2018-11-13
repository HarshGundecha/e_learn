<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='AdminID';
	private $__TABLE='tbladmin';
	private $__ENTITY='Admin';
	private $__STATUS='AdminStatus';

	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Admin'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/Admin_m');
		if(!$this->session->AdminID)
			redirect('admin/Login');
	}
	//loading datatable view with data
	public function index($id=false)
	{
		if($id)
		{
		    if($this->session->AdminLevel!=0 && $this->session->AdminID!=$id)
		    	redirect('admin/Course');
			$data['ad']=$this->Admin_m->get_admin_data($id);
			if(count($data['ad']['admin_data'])!=1)
				redirect('admin/Error_404');
			$data['Entity']=$this->__ENTITY;
			get_views('admindetail', 'Admin Details', $data);
		}
		else
		{
		    if($this->session->AdminLevel!=0)
		    	redirect('admin/Course');
			$acd1 = $this->jsdtc->dtImage('resources/admin/uploads/', 'AdminImage');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'AdminName','AdminID');
			$acd3 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'AddedByAdminName','AddedByAdminID');
			$acd4 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS).
								$this->jsdtc->dtUpdateButton($this->__ID);
			$actionColumnData = [$acd1, $acd2, $acd3, $acd4];
			$columnNames =[
				//$this->__ID,
				false, //for $acd1
				false, //for $acd2
				'AdminEmail',
				'AdminContactNo',
				false, //for $acd3
				$this->__STATUS,
				false, //for $acd4
			];

			$data['DataTableCode']= // no changes required here
				$this->jsdtc->getDatatable
				(
					"#tblView{$this->__ENTITY}", 
					"admin/{$this->__ENTITY}/getDtData", 
					$columnNames,
					$actionColumnData
				);

			$data['Entity'] = $this->__ENTITY;
			$data['thead'] = [
				//'#',
				'Image',
				'Name',
				'Email',
				'Contact No.',
				'Added By Admin',
				'Status',
				'Action'
			];
			get_views('admin',"Manage $this->__ENTITY", $data);
			//$this->load->view('admin/'.$this->__ENTITY,$data);
		}
	}

  //echoing datatable JSON data
	public function getDtData()
	{
		$query = $this->Admin_m->get_entity();
		$this->enum->exchangeOptions('adminstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	//add entity data
	public function addEntityData()
	{
	    if($this->session->AdminLevel!=0)
	    	redirect('admin/Course');
		$validation = [
			[
				'field' => 'aAdminName',
				'label' => 'Admin Name',
				'rules' => 'trim|required|min_length[3]|max_length[20]'
			],
			[
				'field' => 'aAdminContactNo',
				'label' => 'Contact No.',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'aAdminEmail',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|is_unique[tbladmin.AdminEmail]'
			],
			[
				'field' => 'aAdminPassword',
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
			$aAdminImage='aAdminImage';
			$insert_data =[
				'AdminName' => $this->input->get_post('aAdminName'),
				'AdminEmail' => $this->input->get_post('aAdminEmail'),
				'AdminPassword' => $this->input->get_post('aAdminPassword'),
				'AdminContactNo' => $this->input->get_post('aAdminContactNo'),
				'AddedByAdminID' => $this->session->AdminID,
				$this->__STATUS => 0
			];
			if($this->upload->do_upload($aAdminImage))
			{
				$upload_data = $this->upload->data();
				$insert_data['AdminImage'] = $upload_data['file_name'];
			}
			$this->Admin_m->add_entity($this->__TABLE, $insert_data);
			@unlink($_FILES[$aAdminImage]);
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->Admin_m->get_entity($where);
		return $this->enum->exchangeOptions('adminstatus', $this->__STATUS, $query);
	}

	//get data & content(html) for update entity modal
	public function getUpdateEntityContent($id)
	{
	    if($this->session->AdminLevel!=0)
		    redirect('admin/Course');
		$EntityData=$this->getEntityData($id)[0];
		//$this->session->set_flashdata("flash_".$this->__ID, $id);
		?>

			<?php $pf="u"; ?>
			<input type="hidden" name="u<?=$this->__ID?>" value="<?=$id?>"/>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>AdminName">Name</label>
							<input type="text" name="<?=$pf?>AdminName" id="<?=$pf?>AdminName" class="form-control" placeholder="e.g., John" value="<?=$EntityData->AdminName?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group is-empty">
							<label for="<?=$pf?>AdminContactNo">Contact No</label>
							<input type="text" name="<?=$pf?>AdminContactNo" id="<?=$pf?>AdminContactNo" class="form-control" placeholder="e.g., 9875xxxxxx" value="<?=$EntityData->AdminContactNo?>">
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group is-empty is-fileinput">
							<label for="<?=$pf?>AdminImage">Image</label>
							<a href="#" style="cursor: pointer;" onclick="$(this).next().trigger('click')">
								<img src="<?=base_url('resources/admin/uploads/').$EntityData->AdminImage?>" style="height: 180px;width: 180px;" data-toggle="tooltip" title="To Change Image, Click On It">
							</a>
							<input name="<?=$pf?>AdminImage" id="<?=$pf?>AdminImage" type="file" style="display: none" class="imgUpload">
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
	public function updateEntityData($id=false)
	{
	    if($this->session->AdminLevel!=0)
		    redirect('admin/Course');
		$this->form_validation->set_rules('uAdminName', 'Admin Name', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$uAdminImage='uAdminImage';
			$updateData=[
				'AdminName'=>$this->input->get_post('uAdminName'),
				'AdminContactNo'=>$this->input->get_post('uAdminContactNo'),
			];
			$this->session->set_userdata('AdminName',$updateData['AdminName']);
			if($this->upload->do_upload($uAdminImage))
			{	
				$upload_data = $this->upload->data();
				$updateData['AdminImage'] = $upload_data['file_name'];
				$this->session->set_userdata('AdminImage',$updateData['AdminImage']);
			}
			$table = $this->__TABLE;
			if($id)
				$where = [
					'AdminId' => $id
				];
			else
				$where = [
					$this->__ID => $this->input->post("u".$this->__ID)
				];
			$this->Admin_m->update_entity($table, $updateData, $where);
			@unlink($_FILES[$uAdminImage]);
			echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
		}
	}

	//set data for updating PARTICULAR entity (user self updation)
	public function updateadminData($id=false)
	{
		$validation = [
			[
				'field' => 'uAdminName',
				'label' => 'Admin Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'uAdminContactNo',
				'label' => 'Contact No.',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'uAdminPassword',
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
			$uAdminImage='uAdminImage';
			$updateData=[
				'AdminName'=>$this->input->get_post('uAdminName'),
				'AdminContactNo'=>$this->input->get_post('uAdminContactNo'),
				'AdminPassword'=>$this->input->get_post('uAdminPassword'),
			];
			if($this->upload->do_upload($uAdminImage))
			{	
				$upload_data = $this->upload->data();
				$updateData['AdminImage'] = $upload_data['file_name'];
			}
			//die('hello'.$this->upload->display_errors());
			$table = $this->__TABLE;
			$where = [
				'AdminId' => $id
			];
			$this->Admin_m->update_entity($table, $updateData, $where);
			@unlink($_FILES[$uAdminImage]);
			//redirect('admin/admin/admindetail/'.$id);
			//echo json_encode(['status'=>true, 'message'=>'Record Successfully Updated']);
			redirect('admin/admin/admindetail/'.$id);
		}
	}

	//toggle DB status of the entity
	public function toggleEntityStatus($id)
	{
	    if($this->session->AdminLevel!=0)
		    redirect('admin/Course');
		$table = $this->__TABLE;
		$updateData = [ $this->__STATUS => '1-'.$this->__STATUS ];
		$where = [
			$this->__ID => $id
		];
		$this->Admin_m->toggle_entity_status($table, $updateData, $where);
		echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}

	// get perticular admin detail for profile display 
	public function updateadmin($id=FALSE)
	{
		if($id)
		{
			$data['aud']=$this->Admin_m->get_update_entity($id);
			get_views('updateadmin', 'Update Admin Details', $data);
		}
	}

	// get perticular admin detail for update display 
	//08-04-2018 deprecated, to be removed soon
	public function admindetail($id=FALSE)
	{
	    if($id)
		{
			$data['ad']=$this->Admin_m->get_admin_data($id);
			$data['Entity']=$this->__ENTITY;
			$data['aud']=$this->Admin_m->get_update_entity($id);
			get_views('admindetail', 'Admin Details', $data);
		}
	}
}