<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Read Article</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<div class="mailbox-read-info">
							<h3>Title : <?=$ard['article_data']->ArticleTitle?></h3>
							<?php
								// echo "<pre>";
								// print_r($ard);
								// echo "</pre>";
								// die();
								?>
							<h5>Posted By : <a href="<?=site_url('/admin/admin/admindetail/'.$ard['article_data']->AddedByAdminID);?>"><?=$ard['article_data']->AddedByAdminName?></a>
								<span class="mailbox-read-time pull-right" title="<?=$ard['article_data']->CreatedDateTime?>" data-toggle="tooltip">Posted : 
									<?php
										$dt = DateTime::createFromFormat('Y-m-d H:i:s', $ard['article_data']->CreatedDateTime);
										$dd3 = $dt->getTimestamp();
										echo timespan($dd3, '', 2). ' ago';
									?>
								</span>
							</h5>
						</div>
						<div class="text-center">
							<img class="rounded" align="middle" src="<?php echo base_url('/resources/admin/uploads/').$ard['article_data']->ArticleImage; ?>" style="max-height:400px;">
						</div>
						<hr>
						<div class="mailbox-read-message">
							<p>
								<?=$ard['article_data']->ArticleContent?>
							</p>
						</div>
					</div>
					<div class="col-md-12" style="margin-top: 10px;">
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
							foreach ($ard['tag_data'] as $td)
							{
						?>
								<label for="tag-<?=$td->TagID;?>" class="default-tag labela"><?=$td->TagName;?></label>
						<?php
							}
						?>
					</div>
					<!--<div class="box-footer">
						<ul class="mailbox-attachments clearfix">
							<li>
								<span class="mailbox-attachment-icon">
									<i class="fa fa-file-pdf-o"></i>
								</span>
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name">
										<i class="fa fa-paperclip"></i> Sep2014-report.pdf
									</a>
									<span class="mailbox-attachment-size">
										1,245 KB
										<a href="#" class="btn btn-default btn-xs pull-right">
											<i class="fa fa-cloud-download"></i>
										</a>
									</span>
								</div>
							</li>
							<li>
								<span class="mailbox-attachment-icon">
									<i class="fa fa-file-word-o"></i>
								</span>
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name">
										<i class="fa fa-paperclip"></i>
										App Description.docx
									</a>
									<span class="mailbox-attachment-size">
										1,245 KB
										<a href="#" class="btn btn-default btn-xs pull-right">
											<i class="fa fa-cloud-download"></i>
										</a>
									</span>
								</div>
							</li>
							<li>
								<span class="mailbox-attachment-icon has-img">
									<img src="../../dist/img/photo1.png" alt="Attachment">
								</span>
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name">
										<i class="fa fa-camera"></i>
										photo1.png
									</a>
									<span class="mailbox-attachment-size">
										2.67 MB
										<a href="#" class="btn btn-default btn-xs pull-right">
											<i class="fa fa-cloud-download"></i>
										</a>
									</span>
								</div>
							</li>
							<li>
								<span class="mailbox-attachment-icon has-img">
									<img src="../../dist/img/photo2.png" alt="Attachment">
								</span>
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name">
										<i class="fa fa-camera"></i>
										photo2.png
									</a>
									<span class="mailbox-attachment-size">
										1.9 MB
										<a href="#" class="btn btn-default btn-xs pull-right">
											<i class="fa fa-cloud-download"></i>
										</a>
									</span>
								</div>
							</li>
						</ul>
					</div>-->
					<div class="box-footer">
						<div class="pull-left">
							<div class="tooltip_custom">
								<font style="font-size:30px;"><?=$ard['article_data']->LikeCount?></font>
								<i class="fa fa-thumbs-up" style="font-size:30px;"></i>
								<span class="tooltiptext">
									<?php foreach ($ard['like_data'] as $ad)echo $ad->UserName."<br>";?>
								</span>
							</div>
							<font style="font-size:30px;">
							&nbsp;&nbsp;-&nbsp;&nbsp;<?=$ard['article_data']->CommentCount?>
							</font>
							<i class="fa fa-commenting" style="font-size:30px;"></i>
								<button type="button" class="btn btn-default" data-toggle="tooltip" title="Print" onclick="window.print();">
									&nbsp;&nbsp;&nbsp;<i class="fa fa-print" style="font-size:1.8em;"></i>
								</button>
						</div>
					</div>
					<div class="box-footer box-comments">
						<?php
							foreach ($ard['comment_data'] as $a) 
							{
						?>
							<div class="box-comment">
								<img class="img-circle img-sm" src="<?=base_url('/resources/user/uploads/'.$a->UserAvatar)?>" alt="User Image">
								<div class="comment-text">
									<span class="username">
										<a href="<?=site_url('/admin/User/'.$a->UserID);?>">
										<?=$a->UserName?>&nbsp;&nbsp;&nbsp;<a href="<?=site_url('admin/Article/toggleComment/'.$ard['article_data']->ArticleID.'/'.$a->ArticleXCommentID);?>" title="<?php if($a->ArticleCommentStatus==0) echo "Active"; else echo "Blocked"; ?>" data-toggle="tooltip"><i class="fa fa-toggle-o<?php if($a->ArticleCommentStatus==0) echo "n"; else echo "ff"; ?>"></i></a>
										</a>
										<span class="text-muted pull-right" title="<?=$a->CreatedDateTime?>" data-toggle="tooltip">
											<?php
												$dt = DateTime::createFromFormat('Y-m-d H:i:s', $a->CreatedDateTime);
												$dd3 = $dt->getTimestamp();
												echo timespan($dd3, '', 2). ' ago';
											?>
										</span>
									</span>
										<?=$a->ArticleCommentContent?>
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