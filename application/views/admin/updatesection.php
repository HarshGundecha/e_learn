
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
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
						<h3 class="box-title">Update Section Posted By <a href="<?=site_url('/admin/Admin/admindetail/'.$section_data[0]->AddedByAdminID);?>"><?=$section_data[0]->AddedByAdminName;?></a>
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
						new nicEditor({fullPanel : true}).panelInstance('uSectionContent');
					});
					</script>
					<div class="box-body pad">
						<form method="POST" action="<?=site_url('/admin/section/updateentitydata/'.$section_data[0]->SectionID.'/'.$section_data[0]->ChapterID)?>">
							<?php $pf='u'; ?>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-10">
											<div class="form-group is-empty">
												<label for="<?=$pf?>SectionTitle">
													<?php
														// echo '<pre>';
														// print_r($section_data[0]);
														// echo $section_data[0]->SectionTitle;
														// echo '</pre>';
														// die('hello');
													?>
													Update Section name in place of <?=$section_data[0]->SectionName?>
												</label>
												<input type="text" name="<?=$pf?>SectionName" id="<?=$pf?>SectionName" value="<?=$section_data[0]->SectionName?>" class="form-control" placeholder="<?=$section_data[0]->SectionName?>" autofocus >
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
										</script>
										<div class="col-md-2">
											<button type="submit" style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right col-xs-12 xol-sm-12">
												Update Section
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<textarea name="<?=$pf?>SectionContent" id="<?=$pf?>SectionContent" class="textarea" placeholder="Place some text here" style="width: 100%; height: 370px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
												<?=$section_data[0]->SectionContent?>
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
