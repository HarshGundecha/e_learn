<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!--
		<section class="content-header">
			<h1>
				Section Editor
				<small>With Advanced form element</small>
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
						<h3 class="box-title">Create Section With e_learn
							<small>Simple and fast</small>
						</h3>
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<!--<button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>-->
						</div>
						<!-- /. tools -->
					</div>
					<!-- /.box-header -->


					<script src="<?=base_url('/resources/admin/assets/niceditor/');?>nicEdit.js" type="text/javascript"></script>
					<script type="text/javascript">
					bkLib.onDomLoaded(function() {
						new nicEditor({fullPanel : true}).panelInstance('aSectionContent');
					});
					</script>
					<div class="box-body pad">
						<form method="POST" action="<?=site_url('/admin/section/addentitydata/'.$ChapterID)?>">
							<?php $pf='a'; ?>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-10">
											<div class="form-group is-empty">
												<label for="<?=$pf?>SectionName">Name</label>
												<input type="text" name="<?=$pf?>SectionName" id="<?=$pf?>SectionName" class="form-control" placeholder="A great title makes an Section appealing :)" autofocus required>
											</div>
										</div>
										<div class="col-md-2">
											<button type="submit" style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right col-xs-12 xol-sm-12">
												Add <?=$Entity?>
											</button>                      
										</div>
									</div>
									<?php
										if(isset($error))									
											echo '<font style="font-size:1.5em;color:red;">'.$error.'</font>';
									?> 
									<div class="row">
										<div class="col-md-12">
											<textarea name="<?=$pf?>SectionContent" id="<?=$pf?>SectionContent" class="textarea" placeholder="Place some text here" style="width: 100%; height: 370px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
												<h1><u>Some </u><b>Content </b><i>Here</i></h1>
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
