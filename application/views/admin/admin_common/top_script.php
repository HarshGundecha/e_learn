<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php if(isset($title))
			echo $title
	 	?>
	 </title>
	<link rel="shortcut icon" href="<?=base_url('resources/admin/assets/dist/img/')?>Favicon.ico">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- jQuery 3.3.1 -->
  <script src="<?=base_url('resources/admin/assets/')?>plugins/jQuery/jquery-3.3.1.min.js"></script>
  <!-- jQuery 2.2.3 -->
  <!-- <script src="<?=base_url('resources/admin/assets/')?>plugins/jQuery/jquery-2.2.3.min.js"></script> -->
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/AdminLTE.min.css">
	<!-- Material Design -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/ripples.min.css">
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/MaterialAdminLTE.min.css">
  <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/skins/all-md-skins.min.css">
  	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/custom/')?>tooltip.css">

	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dt-buttons/css/colReorder.dataTables.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	::-webkit-scrollbar-track
		{
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			background-color: #424949;	
		}
		::-webkit-scrollbar
		{
			width: 6px;
			background-color: #F5F5F5;
		}
		::-webkit-scrollbar-thumb
		{
			background-color: #AED6F1;
		}
		.box-header{
			padding:10px !important;
		}
</style>
</head>