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

	<style type="text/css">
		.firstColor{
		background-color: #85C1E9 ;
		-webkit-transition: all 1.5s ease;
		-moz-transition: all 1.5s ease;
		-o-transition: all 1.5s ease;
		-ms-transition: all 1.5s ease;
		transition: all 1.5s ease;
		}
		.secondColor{
		background-color: initial;
		-webkit-transition: all 1.5s ease;
		-moz-transition: all 1.5s ease;
		-o-transition: all 1.5s ease;
		-ms-transition: all 1.5s ease;
		transition: all 1.5s ease;
		}
	</style>
	<script type="text/javascript">
		var id='';
		var id = window.location.hash;
		$(function(){
			if (id!='')
			{
		    $(id).addClass('firstColor');
		    setTimeout(
					function(){
						$(id).addClass('secondColor');						
					}
		    	, 1500);

			}
		});	
	</script>

	<section class="content">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
							<div class="box box-widget">
								<div class="box-header with-border">
									<div class="user-block">
										<img class="img-circle" src="<?=base_url('/resources/user/uploads/'.$qd['asker_data']->UserAvatar)?>" alt="User Image">
										<span class="username"><a href="<?=site_url('/admin/user/'.$qd['asker_data']->UserID);?>"><?=$qd['asker_data']->UserName?></a></span>
										<span class="description">
											<?php
												$dt = DateTime::createFromFormat('Y-m-d H:i:s', $qd['question_data']->CreatedDateTime);
												$dd3 = $dt->getTimestamp();
												echo timespan($dd3, '', 2). ' ago';
											?>
										</span>
									</div>
									<div class="box-tools">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
									</div>
								</div>
								<div class="box-body">
									<h2><?=$qd['question_data']->ForumQTitle?><hr></h2>
									<?=$qd['question_data']->ForumQContent?>
					<div class="">
					<style type="text/css">
						.default-tag{
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
						<?php
							foreach ($qd['tag_data'] as $td)
							{
						?>
								<label for="tag-<?=$td->TagID;?>" class="default-tag labela"><?=$td->TagName;?></label>
						<?php
							}
						?>
					</div>
									<span class="pull-left text-muted"><?=$qd['question_data']->UpVote?> <i class="fa fa-thumbs-up"></i>&nbsp;  <?=$qd['question_data']->DownVote?> <i class="fa fa-thumbs-down"></i> &nbsp;- <?=count($qd['answer_data'])?> <i class="fa fa-commenting"></i></span>

								</div>
								<div class="box-footer box-comments">
									<?php
										foreach ($qd['answer_data'] as $ad) {
									?>
										<div class="box-comment" id="answer-<?=$ad->ForumAID?>">
											<img class="img-circle img-sm" src="<?=base_url('/resources/user/uploads/'.$ad->UserAvatar)?>" alt="User Image">
											<div class="comment-text">
												<span class="username">
													<a href="<?=site_url('/admin/user/'.$ad->UserID);?>">
													<?=$ad->UserName?>&nbsp;&nbsp;&nbsp;<a href="<?=site_url('admin/ForumQuestion/toggleAnswer/'.$qd['question_data']->ForumQID.'/'.$ad->ForumAID);?>" title="<?php if($ad->ForumAStatus==0) echo "Block ?"; else echo "Activate ?"; ?>" data-toggle="tooltip"><i class='fa fa-toggle-o<?php if($ad->ForumAStatus==0) echo "n"; else echo "ff"; ?>'></i></a>
													</a>
													<span class="text-muted pull-right">
														<?php
															$dt = DateTime::createFromFormat('Y-m-d H:i:s', $ad->CreatedDateTime);
															$dd3 = $dt->getTimestamp();
															echo timespan($dd3, '', 2). ' ago';
														?>
													</span>
												</span>
													<?=$ad->ForumAContent?>
												<br>
												<div class="pull-left"> <?=$ad->UpVote!=''?$ad->UpVote:0?> <i class="fa fa-thumbs-up"></i> </div>
												<div class="pull-left">&nbsp; <?=$ad->DownVote!=''?$ad->DownVote:0?> <i class="fa fa-thumbs-up"></i> </div>
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