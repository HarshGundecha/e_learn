<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Poll extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID='PollID';
	private $__TABLE='tblpoll';
	private $__ENTITY='Poll';
	private $__STATUS='PollStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Poll'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/Poll_m', 'model');
		if(!$this->session->AdminID)
		{
			redirect('admin/Login');
		}
	}
	//loading datatable view with data
	public function index($id=false)
	{
		if($id)
		{
			$ad=['PollID'=>$id];
			$data['pd']=$this->model->get_poll_data($ad);
			$data['Entity']=$this->__ENTITY;
			$data['pd']=$this->enum->exchangeOptions('pollstatus', $this->__STATUS, $data['pd']);
			$data['pd']=$data['pd'][0];
			get_views('polldetail', 'Poll Details', $data);
		}
		else
		{
			$acd1 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'PollTitle','PollID');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/admin/'),'AddedByAdminName','AddedByAdminID');
			$acd3 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
			//$acd2 = $this->jsdtc->dtLink(site_url('admin/poll/polldetail/'),'More Info.','PollID');
			$actionColumnData = [$acd1, $acd2, $acd3];
			$columnNames =[
				//$this->__ID,
				false, //acd1
				false, //acd2
				$this->__STATUS,
				false, //acd3
			];
			$data['thead'] = [
				//'#',
				'Poll Title',
				'Added By Admin',
				'Status',
				'Action',
				//'More Info.',
			];
			$data['DataTableCode']= // no changes required here
				$this->jsdtc->getDatatable
				(
					"#tblView".$this->__ENTITY, 
					"admin/{$this->__ENTITY}/getDtData/", 
					$columnNames,
					$actionColumnData
				);

			$data['Entity'] = $this->__ENTITY;
			get_views('poll',"Manage $this->__ENTITY", $data);
		}
	}

	/*public function polldetail($id=FALSE)
	{
		if($id)
		{
			$ad=['PollID'=>$id];
			$data['pd']=$this->model->get_poll_data($ad);
			$data['Entity']=$this->__ENTITY;
			$data['pd']=$this->enum->exchangeOptions('pollstatus', $this->__STATUS, $data['pd']);
			$data['pd']=$data['pd'][0];
			get_views('polldetail', 'Poll Details', $data);
		}
	}*/

	public function addpollview()
	{
		$data['Entity'] = $this->__ENTITY;
		get_views('addpoll', 'Add Poll', $data);
	}

	//add entity data
	public function addEntityData($ChapterID=FALSE)
	{
		$validation = [
			[
				'field' => 'aPollContent',
				'label' => 'Poll Content',
				'rules' => 'trim|required'
			],
			[
				'field' => 'aPollTitle',
				'label' => 'Poll Title',
				'rules' => 'trim|required'
			]
		];
		$now1 = strtotime ($this->input->post('aPollStartDate'));
		$now2 = strtotime('today midnight');
		$sdate = ($now1 - $now2)/(24*60*60).'<br>';

		$now1 = strtotime ($this->input->post('aPollEndDate'));
		$now2 = strtotime('today midnight');
		$edate = ($now1 - $now2)/(24*60*60).'<br>';

		//die($this->input->post('aPollStartDate').$this->input->post('aPollEndDate').'hello');
		$this->form_validation->set_rules($validation);
		if($sdate <1 || $sdate>$edate)
		{
			echo json_encode(['status'=>false, 'message'=>'Invalid Date Entered']);
		}
		elseif($this->form_validation->run() == FALSE)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$insert_data =[
				'PollTitle' => $this->input->post('aPollTitle'),
				'PollContent' => $this->input->post('aPollContent'),
				'PollStartDate' => $this->input->post('aPollStartDate'),
				'PollEndDate' => $this->input->post('aPollEndDate'),
				'AddedByAdminID' => $this->session->AdminID,
			];
			$this->model->add_entity($this->__TABLE, $insert_data);
			$PollID=NULL;
			$PollID=$this->db->insert_id();
			foreach ($this->input->post('aPollXOptionContent') as $vv)
			{
				if(trim($vv)!='')
				{
					$insert_data=null;
					$insert_data=[
						'PollID'=>$PollID,
						'PollXOptionContent'=>$vv,
					];
					$this->model->add_entity('tblpollxoption', $insert_data);
				}
			}
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}

	public function updatepoll($id=false)
	{
		if($id)
		{
			$validation = [
				[
					'field' => 'uPollContent',
					'label' => 'Poll Content',
					'rules' => 'trim|required'
				],
				[
					'field' => 'uPollTitle',
					'label' => 'Poll Title',
					'rules' => 'trim|required'
				]
			];
			$this->form_validation->set_rules($validation);
			if($this->form_validation->run() == FALSE)
			{
				$ad=['PollID'=>$id];
				$data['pd']=$this->model->get_poll_data($ad);
				$data['Entity']=$this->__ENTITY;
				$data['pd']=$this->enum->exchangeOptions('pollstatus', $this->__STATUS, $data['pd']);
				$data['pd']=$data['pd'][0];
				get_views('polldetail', 'Poll Details', $data);
			}
			else
			{
				$polldata=[
					'PollTitle'=>$this->input->post('uPollTitle'),
					'PollContent'=>$this->input->post('uPollContent'),
				];
				$where=[
					'PollID'=>$id
				];
				$this->model->updatepolldata($polldata, $where);
				foreach ($this->input->post('aPollXOptionContent') as $pxoc)
				{
					if(trim($pxoc)!='')
					{
						$polloptiondata=null;
						$polloptiondata=[
							'PollID'=>$id,
							'PollXOptionContent'=>$pxoc
						];
						$this->model->addpolloptiondata($polloptiondata);
					}
				}
				redirect('admin/poll/'.$id);
			}
		}
	}

	//echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		/*if($id)
			$where['a1.PollID']=$id;*/
		$query = $this->model->get_entity($where);
		$this->enum->exchangeOptions('pollstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		$query['poll_data']=$this->enum->exchangeOptions('pollstatus', $this->__STATUS, $query['poll_data']);
		return $query;
	}

	//toggle DB status of the entity
	public function toggleEntityStatus($id, $type=false)
	{
		$table = $this->__TABLE;
		$updateData = [ $this->__STATUS => '1-'.$this->__STATUS ];
		$where = [
			$this->__ID => $id
		];
		$this->model->toggle_entity_status($table, $updateData, $where);
		if($type==1)
			redirect('admin/poll/'.$id);
		else
			echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}
	public function deleteoption($poid=false,$pid=false)
	{
		if($poid && $pid)
		{
			$where=[
				'PollXOptionID'=>$poid
			];
			$this->model->deleteoptiondata($where);
			redirect('admin/poll/'.$pid);
		}
	}
}