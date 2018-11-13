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
			<div class="col-md-8 col-md-offset-2">
				<!-- Box Comment -->
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block">
							<img class="img-circle" src="<?=base_url('resources/admin/uploads/'.$qd->AdminImage)?>" alt="User Image">
							<span class="username"><a href="<?=site_url('/admin/admin/'.$qd->AddedByAdminID)?>"><?=$qd->AdminName?></a></span>
							<span class="description">Question Status - <?=$qd->QuestionStatus?> </span>
						</div>
						<!-- /.user-block -->
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
						<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
						<form>
							<div class="box-body">
								<p id="display_text">
									<pre><?=$qd->QuestionContent?></pre>
								</p>
								<?php
									if($qd->QuestionStatus=='Active')
									{
								?>
									<a href="<?=site_url('/admin/QuizQuestion/toggleEntityStatus/'.$qd->QuestionID.'/'.true);?>" title="Block Record" data-toggle="tooltip" class="btn btn-success btn-xs"><i class="fa fa-toggle-on" style="font-size: 2em"></i></a>
								<?php
									}
									else
									{
								?>
									<a href="<?=site_url('/admin/QuizQuestion/toggleEntityStatus/'.$qd->QuestionID.'/'.true);?>" title="UnBlock Record" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-toggle-off" style="font-size: 2em"></i></a>
								<?php
									}
								?>
								<!-- <button id="toggle_text" title="Edit Poll Content" data-toggle="tooltip" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil" style="font-size: 2em"></i></button> -->
								<!-- <button id="add_option" title="Add Option" data-toggle="tooltip" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus" style="font-size: 2em;color:#f39c12"></i></button>
								<button id="remove_option" title="Remove Option Field" data-toggle="tooltip" type="button" style="display: none;" class="btn btn-danger btn-xs"><i class="fa fa-minus" style="font-size: 2em"></i></button> -->
								<button id="save_changes" title="Save Changes" data-toggle="tooltip" type="button" style="display: none;" class="btn btn-success btn-xs"><i class="fa fa-save" style="font-size: 2em"></i></button>
								<span class="pull-right text-muted" title="<?=$qd->CreatedDateTime?>" data-toggle="tooltip">Added - 
									<?php
										$dt = DateTime::createFromFormat('Y-m-d H:i:s', $qd->CreatedDateTime);
										$dd3 = $dt->getTimestamp();
										echo timespan($dd3, '', 2). ' ago';
									?>
								</span>

							</div>
							<!-- /.box-body -->
							<div class="box-footer box-comments">

							<?php
								$i=1;
								foreach ($qd->OptionData as $od)
								{
							?>
									<div class="box-comment">
										<span class="img-circle img-sm text-center" style="font-size: 25px"><?=$i++;?></span>
										<div class="comment-text">
											<?=$od->QuestionXOptionContent?>	
											<span title="<?=$od->IsAnswer==1?'Correct Answer':'Wrong Answer'?>" data-toggle="tooltip" class="text-<?=$od->IsAnswer==1?'success':'danger'?> btn-xs"><i class="fa fa-<?=$od->IsAnswer==1?'check':'times'?>" style="font-size: 2em;"></i></span>
										</div>
									</div>
							<?php
								}
							?>
							</div>
						</form>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
</div>
<script type="text/javascript">
	<?php
		$this->load->helper([
			'AIOAjax_helper',
			'addUpdateEntityAjaxCode_helper'
		]);
	?>
</script>