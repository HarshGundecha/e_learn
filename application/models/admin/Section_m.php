<?php
class Section_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function get_entity($id=FALSE)
	{
		if($id)
		{
			$where=NULL;
			$where['s.ChapterID']=$id;
			$this->db->where($where);
		}
		$this->db->select('s.*,a.AdminName AddedByAdminName, c.ChapterName ChapterName');
		$this->db->from('tblsection s');
		$this->db->join('tbladmin a', 's.AddedByAdminID=a.AdminID');
		$this->db->join('tblchapter c', 's.ChapterID=c.ChapterID');
		$data['section_data']=$this->db->get()->result();
		//$data['chapter_data']=$this->db->get('tblchapter')->result();
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// die('hello');
		return $data;
	}

	public function get_entity_detail($id=FALSE)
	{
		if($id)
		{
			$where=NULL;
			$where['s.SectionID']=$id;
			$this->db->where($where);
		}
		$this->db->select('s.*,a.AdminName AddedByAdminName, c.ChapterName ChapterName');
		$this->db->from('tblsection s');
		$this->db->join('tbladmin a', 's.AddedByAdminID=a.AdminID');
		$this->db->join('tblchapter c', 's.ChapterID=c.ChapterID');
		$data['section_data']=$this->db->get()->result();
		//$data['chapter_data']=$this->db->get('tblchapter')->result();
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// die('hello');
		return $data;
	}

	public function get_update_entity($where=FALSE)
	{
		if($where==FALSE)
			redirect('admin/Section');
		$this->db->where($where);
		$this->db->select('s.*,a.AdminName AddedByAdminName, c.ChapterName ChapterName');
		$this->db->from('tblsection s');
		$this->db->join('tbladmin a', 's.AddedByAdminID=a.AdminID');
		$this->db->join('tblchapter c', 's.ChapterID=c.ChapterID');
		$data['section_data']=$this->db->get()->result();
		return $data;
	}

	public function add_entity($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function update_entity($table, $data=false, $id=false)
	{
		if($data && $id)
		{
			$where=NULL;
			$where['SectionID']=$id;
			$this->db->set($data);
			$this->db->where($where);
			$this->db->update($table);
		}
	}

	public function toggle_entity_status($table, $data=false, $where=false)
	{
		if($data && $where)
		{
			$this->db->set($data, '', FALSE);
			$this->db->where($where);
			$this->db->update($table);
		}
	}
	// public function get_all_Section()
	// {
	// 	return $this->db->get('tblsection')->result();
	// }
}

