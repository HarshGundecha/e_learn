<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QuizQuestion extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID			=	'QuestionID';
	private $__TABLE 	=	'tblquestion';
	private $__ENTITY	=	'QuizQuestion';
	private $__STATUS	=	'QuestionStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->library('JsDatatableCode', ['QuizQuestion'], 'jsdtc');
		$this->load->model('admin/QuizQuestion_m', 'model');
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
			$where=false;
			$where=['QuestionID'=>$id];
			$data['Entity']=$this->__ENTITY;
			$data['qd']=$this->model->get_question_data($where);
			$data['qd'] = $this->enum->exchangeOptions('questionstatus', $this->__STATUS, $data['qd']);
			$data['qd']=$data['qd'][0];
			get_views('quizquestiondetail', 'Question Details', $data);
		}
		else
		{
			$acd1 = $this->jsdtc->dtLink2(site_url('admin/QuizQuestion/'),'QuestionContent','QuestionID');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/Chapter/'),'CourseName','CourseID');
			$acd3 = $this->jsdtc->dtLink2(site_url('admin/Section/'),'ChapterName','ChapterID');
			$acd4 = $this->jsdtc->dtLink2(site_url('admin/Admin/'),'AdminName','AddedByAdminID');
			$acd5 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
			$actionColumnData = [$acd1, $acd2, $acd3, $acd4, $acd5];
			$columnNames =[
				//$this->__ID,
				false,//acd1
				'QuestionPoint',
				false,
				false,
				false,
				$this->__STATUS,
				false, //acd2
			];
			$data['thead'] = [
				//'#',
				'Question',
				'Points',
				'Course',
				'Chapter',
				'Added By',
				'Status',
				'Action',
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

			$data['QuestionID']=$id;
			$data['CourseData']=$this->model->get_course_data();
			get_views('quizquestion',"Manage $this->__ENTITY", $data);
		}
	}

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
				'label' => 'Course',
				'rules' => 'trim|required|numeric'
			],
			[
				'field' => 'aChapterID',
				'label' => 'Chapter',
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
		    $aQuestionContent=htmlentities($this->input->get_post('aQuestionContent'));
			$aAdminImage='aAdminImage';
			$insert_data =[
				'QuestionContent' => $aQuestionContent,
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
		            $RealOptionContent=NULL;
		            $RealOptionContent=htmlentities($qxoc);
					$insert_data2 = null;					
					$insert_data2 =[
						'QuestionXOptionContent' => $RealOptionContent,
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
		$query=$this->enum->exchangeOptions('questionstatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		return $this->enum->exchangeOptions('questionstatus', $this->__STATUS, $query);
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
			redirect('admin/QuizQuestion/'.$id);
		else
			echo json_encode(['status'=>true, 'message'=>'Status Changed Successfully']);
	}

	/*public function quizquestiondetail($id=FALSE)
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
	}*/

}