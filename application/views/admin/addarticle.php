<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Article Editor
			<small>With Advanced form element</small>
		</h1>
		<!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">Editors</li>
		</ol>-->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Create Article With e_learn
							<small>Simple and fast</small>
						</h3>
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
						</div>
						<!-- /. tools -->
					</div>
					<!-- /.box-header -->
					<script src="<?=base_url('/resources/admin/assets/niceditor/');?>nicEdit.js" type="text/javascript"></script>
					<script type="text/javascript">
					bkLib.onDomLoaded(function() {
						new nicEditor({fullPanel : true}).panelInstance('aArticleContent');
					});
					</script>
					<div class="box-body pad">
						<form method="POST" action="<?=site_url('/admin/article/addentitydata')?>" enctype="multipart/form-data">
							<?php $pf='a'; ?>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group is-empty">
												<label for="<?=$pf?>ArticleTitle">Title</label>
												<input type="text" name="<?=$pf?>ArticleTitle" id="<?=$pf?>ArticleTitle" class="form-control" placeholder="A great title makes an article appealing :)" autofocus >
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group is-empty is-fileinput">
												<label for="<?=$pf?>ArticleImage">Image</label>
												<input type="text" readonly="" class="form-control" placeholder="Browse...">
												<input type="file" name="<?=$pf?>ArticleImage" id="<?=$pf?>ArticleImage">
												<!-- <p class="help-block">Example block-level help text here.</p> -->
											</div>
										</div>
										<div class="col-md-2">
											<button type="submit" style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right col-xs-12 xol-sm-12">
												Add <?=$Entity?>
											</button>
										</div>  
									</div>
									<div class="row">
										<div class="col-md-12">
											<textarea name="<?=$pf?>ArticleContent" id="<?=$pf?>ArticleContent" class="textarea" placeholder="Place some text here" style="width: 100%; height: 370px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
												<h1><u>Some </u><b>Content </b><i>Here</i></h1>
											</textarea><br>
										</div>
										<style type="text/css">
											.default-tag{
												line-height: 36px;
												padding: 0 15px;
												border: solid 1px #e0e0e0;
												border-radius: 18px;
												color: #9C9C9C;
												background: #f5f5f5;
												text-decoration: none;
												font-size: 15px;
												transition: all 0.7s ease-in-out 0s;
											}
											.alter-tag{
												line-height: 36px;
												padding: 0 15px;
												border: solid 1px #e0e0e0;
												border-radius: 18px;
												color: white;
												background: #02cbf7;
												text-decoration: none;
												font-size: 15px;
												transition: all 0.7s ease-in-out 0s;
											}
										</style>
										<div class="col-md-12">
											<?php
												foreach ($TagData as $td) {
													?>
														<label for="tag-<?=$td->TagID;?>" class="default-tag labela"><?=$td->TagName;?></label>
														<input id="tag-<?=$td->TagID;?>" style="display: none;" type="checkbox" name="tag[]" value="<?=$td->TagID;?>">
													<?php
												}
											?>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.labela').on('click',function(){
													$(this).toggleClass('default-tag alter-tag');
												});
											});
										</script>
									</div>
									<script type="text/javascript">
								function readURL(input)	{
									if (input.files && input.files[0]) {
										var reader = new FileReader();
										reader.onload = function(e) {
											$(input).prev().children(":first").attr('src', e.target.result);
										}
										reader.readAsDataURL(input.files[0]);
									}
								}
								$(".imgUpload").change(function() {
								  readURL(this);
								});
							</script>
							
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.col-->
		</div>
		<!-- ./row -->
	</section>
	<!-- /.content -->
</div>