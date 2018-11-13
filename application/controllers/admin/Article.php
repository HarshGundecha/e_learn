<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller
{
	// class variables
	// change values as per controller
	private $__ID			=	'ArticleID';
	private $__TABLE 	=	'tblarticle';
	private $__ENTITY	=	'Article';
	private $__STATUS	=	'ArticleStatus';
	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','view_loader']);
		$this->load->library(['session','Enum','form_validation']);
		$this->load->library('JsDatatableCode', ['Article'], 'jsdtc');
		$this->load->library('upload', [
			'upload_path' => './resources/admin/uploads/',
			'allowed_types' => 'gif|jpg|png',
			'encrypt_name' => TRUE
		]);
		$this->load->model('admin/Article_m', 'model');
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
			$data['ard']=$this->model->get_article_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('articledetail', 'Article Details', $data);
		}
		else
		{
			/*if($id==FALSE)
				redirect('admin/Course');*/
			$acd1 = $this->jsdtc->dtImage('resources/admin/uploads/', 'ArticleImage');
			$acd2 = $this->jsdtc->dtLink2(site_url('admin/'.$this->__ENTITY.'/'),'ArticleTitle','ArticleID');
			$acd3 = $this->jsdtc->dtLink2(site_url('admin/admin/'),'AddedByAdminName','AddedByAdminID');
			$acd4 =	$this->jsdtc->dtToggleStatusButton($this->__ID, $this->__STATUS);
			$acd5 = $this->jsdtc->dtLink(site_url('admin/Article/updatearticle/'),'Update Article','ArticleID');
			$actionColumnData = [$acd1, $acd2, $acd3, $acd4, $acd5];
			$columnNames =[
				//$this->__ID,
				false, //acd1
				false, //acd2
				false, //acd3
				$this->__STATUS,
				false, //acd4
				false, //acd5
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
				'Article Image',
				'Article Title',
				'Added By Admin',
				'Status',
				'Action',
				'Update Article',
			];
			$data['ArticleID']=$id;
			get_views('article',"Manage $this->__ENTITY", $data);
			//$this->load->view('admin/'.$this->__ENTITY,$data);
		}
	}

	//calling update view with its old data
	public function updatearticle($id=FALSE)
	{
		if($id==FALSE)
			redirect('admin/Article');
		$where['ArticleID']=$id;
		$data['article_data'] = $this->model->get_entity($where);
		$data['article_data'] = $this->enum->exchangeOptions('articlestatus', $this->__STATUS, $data['article_data']);
		$data['Entity'] = $this->__ENTITY;
		get_views('updatearticle',"Update $this->__ENTITY", $data);
	}

	//update entity data
	public function updateEntityData($id)
	{
		$validation = [
			[
				'field' => 'uArticleContent',
				'label' => 'Article Content',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
			echo "invalid";
		else
		{
			$Image='uArticleImage';
			$update_data =[
				'ArticleTitle' => $this->input->get_post('uArticleTitle'),
				'ArticleContent' => $this->input->get_post('uArticleContent'),
			];
			if($this->upload->do_upload($Image))
			{	
				$upload_data = $this->upload->data();
				$update_data['ArticleImage'] = $upload_data['file_name'];	
			}
			$this->model->update_entity($this->__TABLE, $update_data, $id);
			@unlink($_FILES[$Image]);
			//echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
			redirect('admin/article');
		}
	}

	public function addarticleview()
	{
		$data['Entity'] = $this->__ENTITY;
		$data['TagData'] = $this->model->getTags();
		get_views('addarticle', 'Add Article', $data);
	}

	//add entity data
	public function addEntityData()
	{
		// var_dump($this->input->post('tag'));
		// echo '<pre>';
		// print_r($this->input->post('tag'));
		// die('hello');
		$validation = [
			[
				'field' => 'aArticleContent',
				'label' => 'Article Content',
				'rules' => 'trim|required'
			],
			[
				'field' => 'aArticleTitle',
				'label' => 'Article Title',
				'rules' => 'trim|required'
			],
		];
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run() == FALSE)
		{
			echo "invalid";
			//echo json_encode(['status'=>false, 'message'=>validation_errors()]);
		}
		else
		{
			$Image='aArticleImage';
			$insert_data =[
				'ArticleTitle' => $this->input->get_post('aArticleTitle'),
				'ArticleContent' => $this->input->get_post('aArticleContent'),
				'AddedByAdminID' => $this->session->AdminID,
			];
			if($this->upload->do_upload($Image))
			{
				$upload_data = $this->upload->data();
				$insert_data['ArticleImage'] = $upload_data['file_name'];
			}	
			$aid=$this->model->add_entity($this->__TABLE, $insert_data);
			$td=$this->input->post('tag');
			if($td!=NULL)
			{
				foreach ($td as $td2k => $td2v)
				{
					$tagD=null;
					$tagD=[
						'ArticleID'=>$aid,
						'TagID'=>$td2v
					];
					$this->model->add_entity('tblarticlextag', $tagD);
				}
			}
			@unlink($_FILES[$Image]);
			//echo json_encode(['status'=>true, 'message'=>'Record Added Successfully']);
			redirect('admin/article');
		}
	}

  //echoing datatable JSON data
	public function getDtData($id=false)
	{
		$where=false;
		/*if($id)
			$where['a3.ChapterID']=$id;*/
		$query = $this->model->get_entity($where);
		$this->enum->exchangeOptions('articlestatus', $this->__STATUS, $query);
		echo $this->jsdtc->dtData($query);
	}

	// retrieve/select entity data
	private function getEntityData($id)
	{
		$where = [$this->__ID=>$id];
		$query = $this->model->get_entity($where);
		return $this->enum->exchangeOptions('articlestatus', $this->__STATUS, $query);
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

	//toggle comment status
	public function toggleComment($ArticleID=FALSE, $ArticleXCommentID=FALSE)
	{
		if($ArticleID && $ArticleXCommentID && is_numeric($ArticleID) && is_numeric($ArticleXCommentID))
		{
			$this->model->toggle_comment_status($ArticleXCommentID);
			redirect('admin/Article/'.$ArticleID);
		}
		else
			redirect('admin/Error_404');
	}

	/*public function articledetail($id=FALSE)
	{
		if($id)
		{
			$data['ard']=$this->model->get_article_data($id);
			$data['Entity']=$this->__ENTITY;
			get_views('articledetail', 'Article Details', $data);
		}
	}*/
}