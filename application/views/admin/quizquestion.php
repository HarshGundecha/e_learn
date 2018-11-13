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
																<label for="<?=$pf?>QuestionContent">Question</label>
																<textarea name="<?=$pf?>QuestionContent" id="<?=$pf?>QuestionContent" class="form-control" rows="3" placeholder="Content goes here..."></textarea>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="aCourseID">Course</label>
																<select name="aCourseID" id="aCourseID" class="form-control">
																	<?php
																		foreach ($CourseData as $cd)
																			echo "<option value='$cd->CourseID'>$cd->CourseName</option>";
																	?>
																</select>
															</div>
														</div>
														<script type="text/javascript">
															$(function(){
																$('#aCourseID').on('change', function(){
																	AIOAjax(
																		"admin/QuizQuestion/getChapter/"+$(this).val(),
																		5,
																		false,
																		2,
																		"#aChapterID"
																	);
																	$('#aChapterID').prop("disabled", false);
																})
															});
														</script>
														<div class="col-md-6">
															<div class="form-group">
																<label for="aChapterID">Chapter</label>
																<select name="aChapterID" id="aChapterID" class="form-control" disabled>
																	<option>Select Course First</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group is-empty">
																<label>Option 1</label>
																<input type="text" name="aQuestionXOptionContent[]" class="form-control">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group is-empty">
																<label>Option 2</label>
																<input type="text" name="aQuestionXOptionContent[]" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group is-empty">
																<label>Option 3</label>
																<input type="text" name="aQuestionXOptionContent[]" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group is-empty">
																<label>Option 4</label>
																<input type="text" name="aQuestionXOptionContent[]" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="aQuestionPoint">Points</label>
																<select name="aQuestionPoint" id="aQuestionPoint" class="form-control">
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4" selected="">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																	<option value="10">10</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="aIsAnswer">Correct Answer</label>
																<select name="aIsAnswer" id="aIsAnswer" class="form-control">
																	<option value="0">Option 1</option>
																	<option value="1">Option 2</option>
																	<option value="2">Option 3</option>
																	<option value="3">Option 4</option>
																</select>
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
						<table id="tblView<?=$Entity?>" class="table table-bordered table-striped">
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
						.addEntityAjaxCode($Entity);

	?>
</script>