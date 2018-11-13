<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-widget widget-user">
					<div class="widget-user-header bg-white" style="background: url('<?=base_url("/resources/common/1.png");?>') center center;background-size: 100% 500%;background-repeat: no-repeat;color:white;">
						<h3 class="widget-user-username"><b><?=$ud['user_data'][0]->UserName?></b></h3>
						<h5 class="widget-user-desc"><?=$ud['user_data'][0]->UserEmail?></h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" src="<?=base_url('/resources/user/uploads/'.$ud['user_data'][0]->UserAvatar)?>" alt="User Avatar">
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header"><?=$ud['user_data'][0]->UserContactNo?></h5>
									<span class="description-text">Contact No.</span>
								</div>
							</div>
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header" style="padding-top:10px;font-size:1.5em;"><?=$ud['user_data'][0]->UserXP?> XP</h5>
									<!-- <span class="description-text">FOLLOWERS</span> -->
								</div>
							</div>
							<div class="col-sm-4">
								<div class="description-block">
									<h5 class="description-header"><?=$ud['user_data'][0]->CreatedDateTime?></h5>
									<span class="description-text">Date Joined</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block text-center">
							<span class="username" style="margin-left:0px;">
								<h3>
									Questions By <a href="<?=site_url('/admin/user/'.$ud['user_data'][0]->UserID);?>"><?=$ud['user_data'][0]->UserName?></a>
								</h3>
							</span>
						</div>
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-footer box-comments">
						<?php
							foreach ($ud['question_data'] as $qd) {
						?>
							<div class="box-comment">
								<img class="img-circle img-sm" src="<?=base_url('/resources/user/uploads/'.$ud['user_data'][0]->UserAvatar)?>" alt="User Image">
								<div class="comment-text">
									<span class="username">
										<a href="<?=site_url('/admin/ForumQuestion/'.$qd->ForumQID);?>"><?=$qd->ForumQTitle?></a>
										<span class="text-muted pull-right"><?=$qd->CreatedDateTime?></span>
									</span>
									<?=$qd->ForumQContent?>
									<br>
									<div class="pull-left">
										<?=$qd->TotalLike!=''?$qd->TotalLike:0?>
										<i class="fa fa-thumbs-up"></i>
										<?=$qd->TotalDisLike!=''?$qd->TotalDisLike:0?>
										<i class="fa fa-thumbs-down"></i>
										<?=$qd->Answer!=''?$qd->Answer:0?>
										<i class="fa fa-commenting"></i>
									</div>
								</div>
							</div>
						<?php
							}
						?> 
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block text-center">
							<span class="username" style="margin-left:0px;">
								<h3>
									Answers By <a href="<?=site_url('/admin/user/'.$ud['user_data'][0]->UserID);?>"><?=$ud['user_data'][0]->UserName?></a>
								</h3>
							</span>
						</div>
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-footer box-comments">
						<?php
							foreach ($ud['answer_data'] as $ad) {
						?>
							<div class="box-comment">
								<img class="img-circle img-sm" src="<?=base_url('/resources/user/uploads/'.$ud['user_data'][0]->UserAvatar)?>" alt="User Image">
								<div class="comment-text">
									<span class="username">
										<a href="<?=site_url('/admin/ForumQuestion/'.$ad->ForumQID.'#answer-'.$ad->ForumAID);?>">View Answer</a>
										<span class="text-muted pull-right"><?=$ad->CreatedDateTime?></span>
									</span>
									<?=$ad->ForumAContent?>
									<br>
									<div class="pull-left">
										<?=$ad->TotalLike!=''?$ad->TotalLike:0?>
										<i class="fa fa-thumbs-up"></i>
										<?=$ad->TotalDisLike!=''?$ad->TotalDisLike:0?>
										<i class="fa fa-thumbs-down"></i>
									</div>
								</div>
							</div>
						<?php
							}
						?> 
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

	echo AIOAjax();
//.$DataTableCode
//.addEntityAjaxCode($Entity,true)
//.updateEntityAjaxCode($Entity,true);

	?>
</script>