<?php
// deprecated before 25-02-2018
// no more used
// do not use
function dtMoreInfoAjaxButtonJSCode($Entity)
{
	$adminControllerPath='index.php/admin/';
	return '
		$("#tblView'.$Entity.'").on("click","tbody .fa-info-circle, tbody .fa-info",function(){
			AIOAjax
			(
				"'.base_url().$adminControllerPath.$Entity.'/getInfoEntityContent/"+$(this).attr("id"),
				false,
				2,
				"#divInfo'.$Entity.'"
			);
			$("#info'.$Entity.'Modal").modal();
		});
	';
}

function dtUpdateButtonJSCode($Entity)
{
	$adminControllerPath='index.php/admin/';
	return '
		$("#tblView'.$Entity.'").on("click","tbody .fa-edit",function(){
			AIOAjax
			(
				"'.base_url().$adminControllerPath.$Entity.'/getUpdateEntityContent/"+$(this).attr("id"),
				false,
				2,
				"#formUpdate'.$Entity.'"
			);
			$("#update'.$Entity.'Modal").modal();
		});
	';
}

function dtToggleStatusButtonJSCode($Entity)
{
	$adminControllerPath='index.php/admin/';
	return '
		$("#tblView'.$Entity.'").on("click","tbody .fa-lock, tbody .fa-unlock",function(){
			AIOAjax
			(
				"'.base_url().$adminControllerPath.$Entity.'/toggleEntityStatus/"+$(this).attr("id"),
				false,
				1,
				"#tblView'.$Entity.'"
			);

		});
	';
}
?>