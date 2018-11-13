<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$config['smtp_user'] = 'your_mail_here';
		$config['smtp_pass'] = 'your_password_here';
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Article_m','am');
	/*	if(!$this->session->UserID)
		{
			redirect('Login');
		}*/
	}
	
	public function index($ArticleID=false)
	{
		if($ArticleID)
		{
			//get details of pericular Article
			$data=$this->am->getArticleData($ArticleID);
			get_view('articledetail','Read with e_learn',$data);
		}
		else
		{
			//get all Article details
			$data=$this->am->getArticleData();
			$data['TagData']=$this->am->getTagData();
			get_view('article','Read with e_learn',$data);
		}
	}

    //filter article by tags
    public function filter()
	{
	    //$this->form_validation->set_rules('tag','Tag','required');
		if(!$this->input->post('tag'))
		{
			$data=$this->am->getArticleData();
			$data['TagData']=$this->am->getTagData();
    		$data['error']='Select Any Tag First';
			get_view('article','Read with e_learn',$data);
		}
		else
		{
    		//get all Article details
    		$wherein=implode(", ",array_values($this->input->post('tag')));
    		$data=$this->am->getFilteredArticleData($wherein);
    		$data['TagData']=$this->am->getTagData();
    		get_view('article','Read with e_learn',$data);
    	}	
	}
	
	//Add comment
	public function addcomment($id)
	{
		$this->form_validation->set_rules('aComment', 'Comment', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			//get_view('articledetail','Read with e_learn');
			redirect('Article/'.$id,'Read with e_learn');
		}
		else
		{
		    $ArticleCommentContent=htmlentities($this->input->get_post('aComment'));
			$insert_data =[
				'ArticleID' => $id,
				'UserID' => $this->session->UserID,
				'ArticleCommentContent' => $ArticleCommentContent,
			];
			$this->am->addcommentdata($insert_data);
			
			$spos=strpos(base_url(),'://');
			$Domain=substr(base_url(),$spos+3,strlen(base_url())-$spos-4);
			$MailTo='support@'.$Domain;
			$this->email->from($MailTo, 'name');
			$this->email->to($MailTo);
			$this->email->subject('Comment On Article');
			$this->email->message('Article Comment : '.$this->input->get_post('aComment').'  Article got a comment By '.$this->session->UserName);
			$this->email->send();
			//die($this->email->print_debugger().$MailTo);
			
			$insert_data = NULL;
			$insert_data =[
				'AdminNotificationContent' => $this->session->UserName.' Commented on Article',
				'AdminNotificationRedirect' => '/admin/Article/'.$id,
				'SenderUserID' => $this->session->UserID,
			];
			$this->am->addnotificationdata($insert_data);
			
			redirect('Article/'.$id,'Read with e_learn');
		}
	}

	//toggle like
	public function togglelike($ArticleID)
	{
		$data=$this->am->toggle_like($ArticleID);
		$LikeCount=$this->am->getCount($ArticleID);
		if($data===0)
			echo '<span><i class="fa fa-thumbs-up" style="color:blue;"></i> </span>'.$LikeCount.'  Likes';
		else
			echo '<span><i class="fa fa-thumbs-up"></i> </span>'.$LikeCount.'  Likes';
	}
}