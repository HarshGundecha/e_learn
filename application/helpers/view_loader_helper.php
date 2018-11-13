<?php
//for loading admin site views
function get_views($page,$title=FALSE,$data=FALSE)
{
	$title2['title']=$title;
	$__CI =& get_instance();
	$__CI->load->view($__CI->config->item('admin_site_folder').'admin_common/top_script',$title2);
	$__CI->load->view($__CI->config->item('admin_site_folder').'admin_common/header');
	$__CI->load->view($__CI->config->item('admin_site_folder').$page,$data);
	$__CI->load->view($__CI->config->item('admin_site_folder').'admin_common/footer');
	$__CI->load->view($__CI->config->item('admin_site_folder').'admin_common/bottom_script');
}

//for loading user site views
function get_view($page,$title=FALSE,$data=FALSE)
{
	$title2['title']=$title;
	$__CI =& get_instance();
	$__CI->load->view('user_common/top_script',$title2);
	$__CI->load->view('user_common/header');
	$__CI->load->view($page,$data);
	$__CI->load->view('user_common/footer');
	$__CI->load->view('user_common/bottom_script');
}
?>