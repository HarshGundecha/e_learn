<?php
class Error_404_m extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
}
?>