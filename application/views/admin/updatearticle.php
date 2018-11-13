
<div class="content-wrapper">
	<!--Content Header (Page header) -->
		<!--
			<section class="content-header">
				<h1>
					Text Editors
					<small>Advanced form element</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Forms</a></li>
					<li class="active">Editors</li>
				</ol>
			</section>
		-->	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Update Article Posted By <a href="<?=site_url('/admin/Admin/admindetail/'.$article_data[0]->AddedByAdminID);?>"><?=$article_data[0]->AddedByAdminName;?></a>
							<small></small>
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
						new nicEditor({fullPanel : true}).panelInstance('uArticleContent');
					});
					</script>
					<div class="box-body pad">
						<form method="POST" action="<?=site_url('/admin/Article/updateEntityData/'.$article_data[0]->ArticleID)?>" enctype="multipart/form-data">
							<?php $pf='u'; ?>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group is-empty">
												<label for="<?=$pf?>ArticleTitle">
													<?php
														// echo '<pre>';
														// print_r($article_data[0]);
														// echo '</pre>';
														// die('hello');
													?>
													Article Title
												</label>
												<input type="text" name="<?=$pf?>ArticleTitle" id="<?=$pf?>ArticleTitle" value="<?=$article_data[0]->ArticleTitle?>" class="form-control" placeholder="<?=$article_data[0]->ArticleTitle?>" autofocus >
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group is-empty is-fileinput">
												<label for="<?=$pf?>ArticleImage">Article Image </label>
												<a href="#" style="cursor: pointer;" onclick="$(this).next().trigger('click')">
													<img src="<?=base_url('resources/admin/uploads/').$article_data[0]->ArticleImage?>" style="height: 80px;width: 80px;" data-toggle="tooltip" title="To Change Image, Click On It">
												</a>
												<input name="<?=$pf?>ArticleImage" id="<?=$pf?>ArticleImage" type="file" style="display: none" class="imgUpload">
											</div>
										</div>
										<div class="col-md-2">
											<button type="submit" style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right col-xs-12 xol-sm-12">
												Update
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												
											</div>
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
										<div class="col-md-12">
											<textarea name="<?=$pf?>ArticleContent" id="<?=$pf?>ArticleContent" class="textarea" placeholder="Place some text here" style="width: 100%; height: 370px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
												<?=$article_data[0]->ArticleContent?>
											</textarea>
										</div>
									</div>
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
