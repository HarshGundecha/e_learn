<?php
	function addEntityAjaxCode($Entity,$id='')
	{
		$__CI=&get_instance();
		return "
		// JQ ajax call for Adding a entity
	  $('#btnAdd{$Entity}').click(function(e){
	    e.preventDefault();
			AIOAjax
			(
				'{$__CI->config->item('admin_site_folder')}{$Entity}/addEntityData/{$id}',	//	url
				1,
				'#formAdd{$Entity}',				//	data container i.e form/div
				1,													//	output type 1=DT,2=html,3=none
				'#tblView{$Entity}',				//	ID to use for output element
			);
	  });
		// JQ ajax call for Adding a entity
		";
	}

	function updateEntityAjaxCode($Entity,$id='')
	{
		$__CI=&get_instance();
		return "
		// JQ ajax call for Updating a entity
	  $('#btnUpdate{$Entity}').click(function(e){
	    e.preventDefault();
			AIOAjax
			(
				'{$__CI->config->item('admin_site_folder')}{$Entity}/updateEntityData',
				3,
				'#formUpdate{$Entity}',
				1,
				'#tblView{$Entity}',
			);
	  });
		// JQ ajax call for Updating a entity
		";
	}
?>