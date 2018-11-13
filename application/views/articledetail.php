<?php
	if($Article_Data[0]->ArticleStatus==1)
		redirect('Error_404');
?>
<section class="breadcrumb" style="margin-top:51px;">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home');?>">Home</a></li>
			<li><a href="<?=site_url('/Article');?>">All Articles</a></li>
			<li><a href="#">Article</a></li>
		</ul>
	</div>
</section>
<div class="blog-page blog-details" id="mainContent">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="blog-slide">
					<div class="img">
						<img src="<?=base_url('resources/admin/uploads/'.$Article_Data[0]->ArticleImage);?>" alt="">
						<div class="date" style="width:250px;min-height:54px;bottom:20px;right:auto;top:auto;left:-8px;border-radius: 0px;"><h3>
							<?php
								$dt = DateTime::createFromFormat('Y-m-d H:i:s', $Article_Data[0]->CreatedDateTime);
								$dd3 = $dt->getTimestamp();
								echo timespan($dd3, '', 2). ' ago';
							?></h3>
						</div>
					</div>
					<div class="info">
						<!-- <div class="category">Article Detail</div> -->
						<div class="name" style=""><h3>Title : <?=$Article_Data[0]->ArticleTitle;?></h3></div>
						<div class="post-info">
							<!-- <span><a href="#"><i class="fa fa-user"></i>info@gmail.com</a></span> -->
							<!--
								<div class="tooltip_custom">
									<font style="font-size:30px;"><?=$Article_Data[0]->LikeCount?></font>
									<i class="fa fa-thumbs-up" style="font-size:30px;"></i>
									<span class="tooltiptext">
										<?php foreach ($Like_Data as $ad)echo $ad->UserName."<br>";?>
									</span>
								</div>
							-->
							<!--<span><a href="#"><i class="fa fa-thumbs-up"></i><?=$Article_Data[0]->LikeCount;?>  Likes</a></span>-->
							<!--<span><a href="#"><i class="fa fa-comments"></i><?=$Article_Data[0]->CommentCount;?>  Comment</a></span>-->
						</div>
						<p>
							<?=$Article_Data[0]->ArticleContent;?>
						</p>
						<div class="blog-bottom">
							<div class="view-info" id="btnlike"><span><i class="fa fa-thumbs-up" 
								<?php 
								if(array_search($this->session->UserID, array_column($Like_Data,'UserID'))!==FALSE)
									{ 
										echo 'style="color:blue;"';
									}
								?> 
								>
								</i></span><?=$Article_Data[0]->LikeCount;?> Likes</div>
								<span> &nbsp;&nbsp;<i class="fa fa-comments"></i>  <?=$Article_Data[0]->CommentCount;?>  Comment</span>
							<ul class="sosiyal-mediya">
								<li><a href="http://www.facebook.com/sharer.php?u=<?=site_url('/Article/'.$Article_Data[0]->ArticleID);?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://api.whatsapp.com/send?text=<?=site_url('/Article/'.$Article_Data[0]->ArticleID);?>"><i class="fa fa-whatsapp"></i></a>
						</li>
								<li><a href="https://twitter.com/share?url=<?=site_url('/Article/'.$Article_Data[0]->ArticleID);?>&amp;text=Found%20a%20awesome%20link&amp;hashtags=e_learn"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://plus.google.com/share?url=<?=site_url('/Article/'.$Article_Data[0]->ArticleID);?>"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=site_url('/Article/'.$Article_Data[0]->ArticleID);?>"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function(){
						$('#btnlike').on('click', function(){
							$.ajax({
								url:"<?=site_url('/Article/togglelike/'.$Article_Data[0]->ArticleID)?>",
								success:function(result){
									$('#btnlike').html(result);
								}
							});
						});
						//alert("hello");
					});
				</script>
				<div class="comment-view">
					<h3>COMMENT</h3>
					<?php
						foreach ($Comment_Data as $cd)
						{
							if($cd->ArticleCommentStatus==0)
							{
					?>
							<div class="comment-slide">
								<div class="comment-box">
									<div class="img"><img src="<?=base_url('resources/user/uploads/'.$cd->UserAvatar);?>" alt="" style="height:96px; width:96px;"></div>
									<!-- <div class="replay"><a href="#"><i class="fa fa-mail-reply"></i>Replay</a></div> -->
									<div class="name"><a href="<?=site_url('/Profile/'.$cd->UserID);?>"><?=$cd->UserName;?></a></div>
									<div class="date">
										<?php
											$dt = DateTime::createFromFormat('Y-m-d H:i:s', $cd->CreatedDateTime);
											$dd3 = $dt->getTimestamp();
											echo timespan($dd3, '', 2). ' ago';
										?>
									</div>
									<p><?=$cd->ArticleCommentContent;?></p>
								</div>
							</div>
					<?php
							}
						}
					?>
				</div>
				<div class="comment-form">
					<h3>LEAVE A REPLY</h3>
					<form action="<?php echo site_url('/Article/addcomment/'.$Article_Data[0]->ArticleID); ?>" method="post">
							<div class="input-box">
								<input type="text" name="aComment" placeholder="Write a Comment..." required="">
								<i class="fa fa-comment"></i>
							</div>
							<div>
								<label style="color:red;">
									<?php
										echo form_error('aComment');
									?>
								</label>
							</div>
							<div class="submit-slide">
								<button type="submit" class="btn2">Submit</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
