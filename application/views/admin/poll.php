<div class="content-wrapper">
	<!-- 
		<section class="content-header">
			<h1>
				Data Tables
				<small>advanced tables</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Tables</a>`</li>
				<li class="active">Data tables</li>
			</ol>
		</section>
	 -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title" style="font-size: 1.8em;"><?=$Entity?> Info.</h3>
						<button style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right" data-toggle="modal" data-target="#addModal" >
							Add <?=$Entity?>
						</button>
						<div class="modal modal-success" id="addModal" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h3 class="modal-title"><b>Add <?=$Entity?></b></h3>
									</div>
									<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
										<div class="col-md-12">
											<div class="alert alert-danger alert-dismissible" style="display: none">
												<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
													×
												</button>
												<h4><i class="icon fa fa-ban"></i>Errors In Form :(</h4>
												<div id="formAddAlert">
												
												</div>
											</div>
											<div class="box box-widget">
												<div class="box-header with-border">
													<h3 class="box-title"><?=$Entity?> Details</h3>
													<div class="box-tools">
														<button type="button" class="btn btn-box-tool" data-widget="collapse">
															<i class="fa fa-minus"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<form method="POST" id="formAdd<?=$Entity?>" method="multipart/form-data">
														<?php $pf="a"; ?>
														<div class="col-md-12">
															<div class="form-group is-empty">
																<label for="<?=$pf?>PollTitle">Title</label>
																<input type="text" name="<?=$pf?>PollTitle" id="<?=$pf?>PollTitle" class="form-control">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group is-empty">
																<label for="<?=$pf?>PollContent">Description</label>
																<textarea name="<?=$pf?>PollContent" id="<?=$pf?>PollContent" class="form-control" rows="3" placeholder="Content goes here..."></textarea>
															</div>
														</div>

														<!-- date-range-picker -->
														<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
														<!-- <script src="<?=base_url('resources/admin/assets/');?>plugins/daterangepicker/daterangepicker.js"></script> -->
														<!-- daterange picker -->
														<!-- <link rel="stylesheet" href="<?=base_url('resources/admin/assets/');?>plugins/daterangepicker/daterangepicker.css"> -->
														<!-- bootstrap datepicker -->
														<!-- <link rel="stylesheet" href="<?=base_url('resources/admin/assets/');?>plugins/datepicker/datepicker3.css"> -->


														<!-- InputMask -->
														<script src="<?=base_url('resources/admin/assets/');?>plugins/input-mask/jquery.inputmask.js"></script>
														<script src="<?=base_url('resources/admin/assets/');?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>

														<div class="col-md-12">
															<div class="form-group is-empty is-fileinput">
																<label for="aPollImage">Image</label>
																<input type="text" readonly="" class="form-control" placeholder="Browse...">
																<input type="file" name="aPollImage" id="aPollImage">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="<?=$pf?>PollStartDate">Start Date</label>
																	<input name="<?=$pf?>PollStartDate" id="<?=$pf?>PollStartDate" type="text" class="form-control pull-right" data-mask>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="<?=$pf?>PollEndDate">End Date</label>
																	<input name="<?=$pf?>PollEndDate" id="<?=$pf?>PollEndDate" type="text" class="form-control pull-right" data-mask>
															</div>
														</div>

														<script>
													    //Datemask dd/mm/yyyy
													    $("[data-mask]").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
														</script>

														<div class="col-md-12">
															<div id="clone_here" class="row clone_here">
																<div class="col-md-12">
																	<div class="form-group is-empty">
																		<label>Option</label>
																		<input type="text" name="<?=$pf?>PollXOptionContent[]" class="form-control">
																	</div>
																</div>
																<div id="clone_me" class="col-md-12 clone_me">
																	<div class="form-group is-empty">
																		<label>Option</label>
																		<input type="text" name="<?=$pf?>PollXOptionContent[]" class="form-control">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<button id="add_option" class="btn btn-success btn-flat"><label style="color:green;font-weight: bolder;">+ Add Option</label>
																	</button>
																</div>
																<div class="col-md-12" style="display: none;">
																	<button id="remove_option" class="btn btn-danger btn-flat"><label style="color:red;font-weight: bolder;">- Remove Option</label>
																	</button>
																</div>
																<script type="text/javascript">
																	$(function(){
																		$('#add_option').on('click',function(e){
																			e.preventDefault();
																				$(".clone_me").first().clone().appendTo(".clone_here");
																				$(".clone_me").last().find('input').val('');
																				$("#remove_option").parent().show();
																		});
																		$('#remove_option').on('click',function(e){
																			e.preventDefault();
																			if($("input[name='<?=$pf?>PollXOptionContent[]']").length>2)
																				$(".clone_me").last().remove();
																			if($("input[name='<?=$pf?>PollXOptionContent[]']").length==2)
																				$("#remove_option").parent().hide();
																		});
																	});
																</script>
															</div>
														</div>
													</form>
												</div>
												<div class="box-footer">
													<input name="btnAdd<?=$Entity?>" id="btnAdd<?=$Entity?>" type="button" class="btn btn-success" value="Add <?=$Entity?>">
													<!--<button type="Reset" class="btn btn-danger pull-right">Reset</button>-->
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal modal-success" id="updateModal" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h3 class="modal-title"><b>Update <?=$Entity?></b></h3>
									</div>
									<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
										<div class="col-md-12">
											<div class="alert alert-danger alert-dismissible" style="display: none">
												<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
													×
												</button>
												<h4><i class="icon fa fa-ban"></i>Errors In Form :(</h4>
												<div id="formUpdateAlert">
												
												</div>
											</div>
											<div class="box box-widget">
												<div class="box-header with-border">
													<h3 class="box-title"><?=$Entity?> Details</h3>
													<div class="box-tools">
														<button type="button" class="btn btn-box-tool" data-widget="collapse">
															<i class="fa fa-minus"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<form method="POST" id="formUpdate<?=$Entity?>">

													</form>
												</div>
												<div class="box-footer">
													<input name="btnUpdate<?=$Entity?>" id="btnUpdate<?=$Entity?>" type="button" class="btn btn-success" value="Update <?=$Entity?>">
													<button type="Reset" class="btn btn-danger pull-right">Reset</button>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal modal-success" id="infoModal" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h3 class="modal-title"><b><?=$Entity?> Info</b></h3>
									</div>
									<div class="modal-body" style="max-height: calc(100vh - 190px); overflow-y: auto;">
										<div class="col-md-12">
											<div class="alert alert-danger alert-dismissible" style="display: none">
												<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
													×
												</button>
												<h4><i class="icon fa fa-ban"></i>Errors In Form :(</h4>
												<div id="formInfoAlert">
												
												</div>
											</div>
											<div class="box box-widget">
												<div class="box-header with-border">
													<h3 class="box-title"><?=$Entity?> Details</h3>
													<div class="box-tools">
														<button type="button" class="btn btn-box-tool" data-widget="collapse">
															<i class="fa fa-minus"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="row" id="contentInfoModal">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-body">
						<div class="alert alert-success alert-dismissible" style="display: none">
							<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
								×
							</button>
							<h4><i class="icon fa fa-check"></i>Success Notice :)</h4>
							<div id="pageAlert">
						
							</div>
						</div>
						<table id="tblView<?=$Entity?>" class="table table-bordered table-striped text-center">
							<thead>
								<tr>
									<?php
										foreach ($thead as $th){echo "<th>$th</th>";}
									?>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<?php
										foreach ($thead as $th){echo "<th>$th</th>";}
									?>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

	<?php

		$this->load->helper([
			'AIOAjax_helper',
			'addUpdateEntityAjaxCode_helper'
		]);

		echo AIOAjax()
					.$DataTableCode
						.addEntityAjaxCode($Entity,true)
							.updateEntityAjaxCode($Entity,true);

	?>
</script>
