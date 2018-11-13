<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SiteReport extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID			=	'SiteReportID';
	private $__TABLE 	=	'tblsitereport';
	private $__ENTITY	=	'SiteReport';
	private $__STATUS	=	'';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->library('JsDatatableCode', ['SiteReport'], 'jsdtc');
		$this->load->model('admin/SiteReport_m', 'model');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$config['mailtype'] = 'html';
		$this->load->library('email', $config);
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
		    $data['rd']=$this->model->GetReportData($id);
			get_views('readmail', 'Read Report', $data);
		}
		else
		{
			$actionColumnData = [
				$this->jsdtc->dtImage('resources/user/uploads/', 'UserAvatar'),
				$this->jsdtc->dtLink2(site_url('admin/User/'),'UserName','UserID'),
				$this->jsdtc->dtLink2(site_url('admin/SiteReport/'),'SiteReportSubject','SiteReportID'),
				$this->jsdtc->dtLink2(site_url('admin/SiteReport/Compose/'),'UserEmail','UserEmail'),
			];
			$columnNames =[
				//$this->__ID,
				false,//acd1
				false,
				false,
                //'IsResponded',
				false,
			];
			$data['thead'] = [
				//'#',
				'Avatar',
				'Name',
				'Subject',
				//'Response Status',
				'Reply',
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

			get_views('sitereport',"Manage $this->__ENTITY", $data);
		}
	}

	public function Compose($email='')
	{
		$data['SendTo']=$email;
		get_views('composemail',"Manage $this->__ENTITY", $data);
	}

	public function Send()
	{
		$this->form_validation->set_rules('aMailTo', 'MailID', 'trim|required|valid_email');
		$this->form_validation->set_rules('aMessage', 'Message', 'trim|required');
		if($this->form_validation->run()==false)
		{
			get_views('composemail',"Manage $this->__ENTITY");
		}
		else
		{
			$spos=strpos(base_url(),'://');
			$Domain=substr(base_url(),$spos+3,strlen(base_url())-$spos-4);
			$MailTo='support@'.$Domain;
			$this->email->from($MailTo, 'TS');
			$this->email->to($this->input->post('aMailTo'));
			$this->email->subject($this->input->post('aSubject'));
			$this->email->message($this->input->post('aMessage'));
			$this->email->send();
			//die($this->email->print_debugger().$MailTo);
			redirect('admin/SiteReport');			
		}
	}

/*
	public function getChapter($id=false)
	{
		$where=false;
		if($id)
			$where=['CourseID'=>$id];
		$chData=$this->model->get_chapter_data($where);
		// print_r($chData);
		// die('hello');
		foreach ($chData as $cd)
			echo "<option value='$cd->ChapterID'>$cd->ChapterName</option>";
	}

	//add entity data
	public function addEntityData()
	{
		$validation = [
			[
				'field' => 'aQuestionContent',
				'label' => 'Question',
				'rules' => 'trim|required'
			],
			[
				'field' => 'aQuestionPoint',
				'label' => 'Question Point',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'aCourseID',
				'label' => 'Email',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'aChapterID',
				'label' => 'Password',
				'rules' => 'trim|required|numeric'
			],
		];
		$this->form_validation->set_rules($validation);

		$option_no=$this->input->post('aIsAnswer');

		if(trim($this->input->post('aQuestionXOptionContent')[$option_no])=='')
			echo json_encode(['status'=>false, 'message'=>'Invalid Option and Answer']);			
		elseif ($this->form_validation->run() == FALSE && $this)
		{
			echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$aAdminImage='aAdminImage';
			$insert_data =[
				'QuestionContent' => $this->input->get_post('aQuestionContent'),
				'QuestionPoint' => $this->input->get_post('aQuestionPoint'),
				'CourseID' => $this->input->get_post('aCourseID'),
				'ChapterID' => $this->input->get_post('aChapterID'),
				'AddedByAdminID' => $this->session->AdminID,
				$this->__STATUS => 0
			];
			$this->model->add_entity($this->__TABLE, $insert_data);
			$qid=$this->db->insert_id();
			$i=0;
			foreach ($this->input->post('aQuestionXOptionContent') as $qxoc)
			{
				if(trim($qxoc)!='')
				{
					$insert_data2 = null;					
					$insert_data2 =[
						'QuestionXOptionContent' => $qxoc,
						'QuestionID' => $qid,
						'IsAnswer' => $i==$option_no?1:0
					];
					$this->model->add_entity('tblquestionxoption', $insert_data2);
				}
				$i++;
			}
			echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
		}
	}
*/
  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		// if($id)
		// 	$where['a3.ChapterID']=$id;
		$query = $this->model->get_entity($where);
		// echo '<pre>';
		// print_r($query);
		// die('hello');
        foreach($query as $q)
        {
            if($q->IsResponded==0)
                $q->IsResponded='Pending';
            else
                $q->IsResponded='Responded';
        }
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
        return $this->model->get_entity($where);
//		$query = $this->model->get_entity($where);
//		return $this->enum->exchangeOptions('questionstatus', $this->__STATUS, $query);
	}

/*
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
			redirect('admin/quizquestion/'.$id);
		else
			echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}

	public function quizquestiondetail($id=FALSE)
	{
		$where=false;
		if($id)
		{
			$where=['QuestionID'=>$id];
			$data['Entity']=$this->__ENTITY;
			$data['qd']=$this->model->get_question_data($where);
			$data['qd'] = $this->enum->exchangeOptions('questionstatus', $this->__STATUS, $data['qd']);
			$data['qd']=$data['qd'][0];
			get_views('quizquestiondetail', 'Question Details', $data);
		}
	}
*/

}