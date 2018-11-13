<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Entity="Category";
$boxStyle="box-shadow:3px 6px 6px 3px #aaa;border-top-color:#3c8dbc";
$adminControllerPath='index.php/admin/';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>View <?=$Entity?></title>

	<!-- top JS and CSS files -->
	<?php
	$this->load->view('admin/topScripts.php');
	?>
	<!-- / top JS and CSS files -->


	<!-- Additional files to be included -->


	<!-- / Additional files to be included -->

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<!-- header -->
		<?php
		$this->load->view('admin/header.php');
		?>
		<!-- / header -->

		<!-- leftSidebar -->
		<?php
		$this->load->view('admin/leftSidebar.php');
		?>
		<!-- / leftSidebar -->

		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-md-12">

						<div class="box box-primary" style="<?=$boxStyle?>">
							<div class="box-header">
								<h3 class="box-title" style="font-size: 1.8em;"><?=$Entity?> Info.</h3>
								<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add<?=$Entity?>Modal">
									Add <?=$Entity?>
								</button>
							</div>


							<div class="modal fade" id="add<?=$Entity?>Modal">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title">Add <?=$Entity?></h4>
										</div>
										<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
											<div class="row">

												<div class="col-md-12">

													<div class="box box-primary" style="<?=$boxStyle?>">
														<div class="box-header with-border">
															<h3 class="box-title"><?=$Entity?> Details</h3>
														</div>

														<div class="row">
														<?php
															$this->load->helper('form');
															echo form_open('email/send', array("id"=>"formAdd".$Entity));
														?>
																<div class="col-md-12">

																	<div class="box-body">
																		<div class="row">

															        <div class="col-md-12">
															          <div class="form-group">
															            <label for="aCategoryName" >Category Name</label>
															            <input name="aCategoryName" id="aCategoryName" type="text" class="form-control" placeholder="Category Name">
															          </div>
															        </div>

																		</div>
																			

																		<?php //$div->formInputText("aCategoryName", "Category Name", "e.g. New", 0, 1, 1); ?>
																	</div>
																	<div class="box-footer">
																		<input name="btnAdd<?=$Entity?>" id="btnAdd<?=$Entity?>" type="submit" class="btn btn-success" value="Add <?=$Entity?>">
																		<button type="reset" class="btn btn-danger pull-right">Reset</button>
																	</div>
																</div>
															<?=form_close();?>
														</div>
													</div>

												</div>

											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
										</div>
									</div>

								</div>
							</div>


							<div class="modal fade" id="update<?=$Entity?>Modal">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title"><?=$Entity?> Update</h4>
										</div>
										<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
											<div class="row">

												<form class="form" id="formUpdate<?=$Entity?>" method="POST">

												</form>

											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
										</div>
									</div>

								</div>
							</div>


							<div class="modal fade" id="info<?=$Entity?>Modal">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title"><?=$Entity?> Info</h4>
										</div>
										<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
											<div class="row" id="divInfo<?=$Entity?>">


											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
										</div>
									</div>

								</div>
							</div>


							<div class="box-body">
								<table id="tblView<?=$Entity?>" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Category Name</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div>


						</div>

					</div>
				</div>

			</section>
		</div>

		<!-- footer -->
		<?php
		$this->load->view('admin/footer.php');
		?>
		<!-- / footer -->

	</div>

	<!-- bottom JS and CSS files -->
	<?php
	$this->load->view('admin/bottomScripts.php');
	?>
	<!-- / bottom JS and CSS files -->


	<!-- Additional files to be included -->

	<!-- / Additional files to be included -->


	<!-- All JS Code -->
	<script type="text/javascript">

		<?php

			$this->load->helper([
				'AIOAjax_helper',
				'addUpdateEntityAjaxCode_helper'
			]);

			echo AIOAjax()
						.$DataTableCode
							.addEntityAjaxCode($Entity)
								.updateEntityAjaxCode($Entity);

		?>
	</script>
	<!-- / All JS Code -->
	
</body>
</html>