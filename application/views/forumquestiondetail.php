<?php
// echo "<pre>";
// print_r($Question_Data[0]);
// echo "</pre>";
// die();
	if($Question_Data[0]->ForumQStatus==1)
		redirect('ForumQuestion');
	$this->load->helper('date');
?>
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


			  //$(id).animate({ opacity: 0.1 }, 3000);
				//$(id).css({"border": "solid","border-color":"red"},2000).css({"border-color":"black"});
				//$(id).addClass('dummy').removeClass('dummy');
				//$(id).fadeTo(100, 0.1).fadeTo(200, 1.0);
				//$(id).fadeIn(100).fadeOut(1000).fadeIn(100);
				//$(id).animate({height: "200px"},2000);
        //$(id).animate({height: "100px"},2000);
			}
		});	
	</script>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Discussions</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/ForumQuestion/');?>">Q & A</a></li>
			<li><a href="#">Discussion</a></li>
		</ul>
	</div>
</section>
<div class="forums-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<!--
					<div class="group-details">
						<div class="cover-img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/group-img.jpg" alt=""></div>
						<div class="group-info" style="padding-left:0px;">
							<div class="group-prifile"><img src="<?=base_url('resources/user/assets/');?>images/user-img/group-profile.jpg" alt=""></div> 
							<div class="group-status">
								<div class="group-type"><h3>Question</h3></div>
								<span>active 8 months, 3 weeks ago</span>
							</div>
							<p><?=$Question_Data[0]->ForumQTitle;?></p><hr>
							<p><?=$Question_Data[0]->ForumQContent;?></p>
						</div>
					</div>
				-->
				<div class="right-slide">
					<h3>Question</h3>
					<br><p style="font-size:2em;"><?=$Question_Data[0]->ForumQTitle;?></p><hr>
					<p><?=$Question_Data[0]->ForumQContent;?></p><hr>

					<div class="" style="margin-bottom:15px;">
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
							foreach ($tag_data as $td)
							{
						?>
								<label for="tag-<?=$td->TagID;?>" class="default-tag labela"><?=$td->TagName;?></label>
						<?php
							}
						?>
					</div>


					<div id="changes">
						<span id="btnupvote" class="btnupvote">
							<?=$Question_Data[0]->UpVote;?> <i class="fa fa-thumbs-up"
							<?php 
								if(array_search($this->session->UserID, array_column($Question_UpVote,'UserID'))!==FALSE)
									echo ' style="font-size:1.4em;color:blue;"';
								else
									echo ' style="font-size:1.4em;"';
							?> 
							></i>
						</span>
						<span id="btndownvote" class="btndownvote">
							<?=$Question_Data[0]->DownVote;?> <i class="fa fa-thumbs-down"
							<?php 
								if(array_search($this->session->UserID, array_column($Question_DownVote,'UserID'))!==FALSE)
									echo ' style="font-size:1.4em;color:blue;"';
								else
									echo ' style="font-size:1.4em;"';
							?> 
							></i>
						</span>
					</div><br>
					<div class="info">
						<div class="post-info">
							<span style="font-size:1.3em;">Posted By : <img src="<?=base_url('resources/user/uploads/'.$Question_Data[0]->UserAvatar);?>" style="width:25px;border-radius:50%;"> <a href="<?=site_url('Profile/'.$Question_Data[0]->UserID);?>"><?=$Question_Data[0]->UserName;?></a></span>
							<span style="float:right;font-size:1.2em;">
								<?php
									$dt = DateTime::createFromFormat('Y-m-d H:i:s', $Question_Data[0]->CreatedDateTime);
									$dd3 = $dt->getTimestamp();
									echo timespan($dd3, '', 2). ' ago';
								?>
							</span>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function(){

						$('#changes').on('click','.btnupvote', function(){
							$.ajax({
								url:"<?=site_url('/ForumQuestion/funupvote/'.$Question_Data[0]->ForumQID)?>",
								success:function(result){
									$('#changes').html(result);
								}
							});
						});

						$('#changes').on('click','.btndownvote', function(){
							$.ajax({
								url:"<?=site_url('/ForumQuestion/fundownvote/'.$Question_Data[0]->ForumQID)?>",
								success:function(result){
									$('#changes').html(result);
								}
							});
						});

					});
				</script>
				<br><br>
				<div class="right-slide">
					<h3>Answers</h3>
				</div>
				<div class="group-tab-view">
					<!--
						<div class="tab-menu">
							<ul>
								<li class="active"><a href="forums-profile-activity.html">Activity</a></li>
								<li><a href="forums-profile.html">Profile</a></li>
								<li><a href="forums-profile-friends.html">Friends <span>9</span></a></li>
								<li><a href="forums-profile-groups.html">Groups <span>2</span></a></li>
								<li><a href="forums-profile-forums.html">Forums</a></li>
							</ul>
						</div>
						<div class="sub-title">
							<div class="right-select">
								<span class="select-label">Show :</span>
								<div class="select-box">
									<select class="order-select">
										<option>Last Active</option>
										<option>Newest Registered</option>
										<option>Alphabetical</option>
									</select>
								</div>
							</div>
						</div>
					-->
					<?php 
						foreach ($Answer_Data as $ad)
						{
					?>
							<div class="create-info" id="answer-<?=$ad->ForumAID?>" <?php if($Question_Data[0]->AcceptedForumAID==$ad->ForumAID) echo 'style="border-color:green; border-width:5px; border-style:double; "';?> >
								<div class="img"><img src="<?=base_url('resources/user/uploads/'.$ad->UserAvatar);?>" alt=""></div>
								<div class="info"><a href="<?=site_url('/Profile/'.$ad->UserID);?>"><?=$ad->UserName;?></a></div>
								<span>
									<?php
										$dt = DateTime::createFromFormat('Y-m-d H:i:s', $ad->CreatedDateTime);
										$dd3 = $dt->getTimestamp();
										echo timespan($dd3, '', 2). ' ago';
									?>
								<?php
								    if($Question_Data[0]->AcceptedForumAID==NULL && $Question_Data[0]->UserID==$this->session->UserID)
								    {
								        echo '<a href='.site_url("ForumQuestion/AddCorrectAnswer/".$ad->ForumQID.'/'.$ad->ForumAID).' class="btn btn-info" style="padding:1px;font-size:12px;">Accept Answer</a>';
								    }
								?>								
								</span>

								<p><?=$ad->ForumAContent;?></p>
								<div id="<?=$ad->ForumAID;?>">
									<span id="AnsUpVote" style="display: inline-block;">
										<?php 
											if(array_search($this->session->UserID, array_column($ad->UpVote,'UserID'))!==FALSE)
												echo $ad->TotalUpVote.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:blue;"></i>';
											else
												echo $ad->TotalUpVote.' <i class="fa fa-thumbs-up" style="font-size:1.4em;color:black;"></i>';
										?>
									</span>
									<span id="AnsDownVote" style="display: inline-block;">
										<?php 
											if(array_search($this->session->UserID, array_column($ad->DownVote,'UserID'))!==FALSE)
												echo $ad->TotalDownVote.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:blue;"></i>';
											else
												echo $ad->TotalDownVote.' <i class="fa fa-thumbs-down" style="font-size:1.4em;color:black;"></i>';
										?>
									</span>
								</div>

							</div>
							<script type="text/javascript">
								$(function(){

									$('#<?=$ad->ForumAID;?>').on('click','#AnsUpVote', function(){
										$.ajax({
											url:"<?=site_url('/ForumQuestion/ansupvote/'.$ad->ForumAID)?>",
											success:function(result){
												$('#<?=$ad->ForumAID;?>').html(result);
											}
										});
									});

									$('#<?=$ad->ForumAID;?>').on('click','#AnsDownVote', function(){
										$.ajax({
											url:"<?=site_url('/ForumQuestion/ansdownvote/'.$ad->ForumAID)?>",
											success:function(result){
												$('#<?=$ad->ForumAID;?>').html(result);
											}
										});
									});

								});
							</script>
					<?php
						}
					?>
					<!--
						<div class="create-info">
							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-blank.png" alt=""></div>
							<div class="info"><a href="#">Edugate</a> created the group <a href="forum-single-topic.html">Online Courses</a></div>
							<span>active 8 months, 3 weeks ago</span>
						</div>
					-->
				</div>
				<div class="comment-form">
					<h3>Give A Answer</h3>
					<form action="<?php echo site_url('/ForumQuestion/addans/'.$Question_Data[0]->ForumQID); ?>" method="post">
							<div class="input-box">
								<input type="text" name="aAnswer" placeholder="Write a Answer..." required="">
								<i class="fa fa-comment"></i>
							</div>
							<div class="submit-slide">
								<button type="submit" class="btn2">Add Answer</button>
							</div>
					</form>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="right-slide">
					<!--
						<div class="search-box">
							<input type="text" placeholder="Search">
							<input type="submit" value=""> 
						</div>
					-->
					<h3>Members</h3>
					<div class="member-list">
						<?php
							foreach ($UserData as $ud)
							{
								if($ud->UserID!=$this->session->UserID)
								{
						?>
									<div class="member-slide">
										<div class="img"><img src="<?=base_url('resources/user/uploads/'.$ud->UserAvatar);?>" alt=""></div>
										<div class="name"><a href="<?=site_url('/Profile/'.$ud->UserID);?>"><?=$ud->UserName?></a></div>
										<div class="activity"><?=$ud->UserXP?> XP</div>
									</div>
						<?php
								}
							}
						?>
					</div>
					<!--
						<h3>Groups</h3>
						<div class="member-list">
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img2.jpg" alt=""></div>
								<div class="name"><a href="forums-group-details.html">Jamie Nicholson</a></div>
								<div class="activity">active 2 day, 3 hours ago</div>
							</div>
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img3.jpg" alt=""></div>
								<div class="name"><a href="forums-group-details.html">Dieter Baum</a></div>
								<div class="activity">active 11 day, 9 hours ago</div>
							</div>
						</div>
						<h3>Recent Replies</h3>
						<div class="replies-course">
							<div class="course-slide">
								<div class="name"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img1.jpg" alt=""><a href="forums-profile.html">Dieter</a> on <a href="forum-single-topic.html">E-Learn 2015</a></div>
								<div class="date">29 Day ago</div>
							</div>
							<div class="course-slide">
								<div class="name"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img2.jpg" alt=""><a href="forums-profile.html">Jamie</a> on <a href="forum-single-topic.html">Y-Learn 2015</a></div>
								<div class="date">2 Month ago</div>
							</div>
							<div class="course-slide">
								<div class="name"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img3.jpg" alt=""><a href="forums-profile.html">Kavanagh</a> on <a href="forum-single-topic.html">Exam-Learn 2015</a></div>
								<div class="date">1 Year ago</div>
							</div>
						</div>
						<h3>Recent Topics</h3>
						<div class="replies-course topics">
							<div class="course-slide">
								<div class="name"><a href="forums-profile.html">Dieter</a> on by <img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img1.jpg" alt="">  <a href="forum-single-topic.html">E-Learn 2015</a></div>
								<div class="date">29 Day ago</div>
							</div>
							<div class="course-slide">
								<div class="name"><a href="forums-profile.html">Jamie</a> on by <img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img2.jpg" alt=""> <a href="forum-single-topic.html">Y-Learn 2015</a></div>
								<div class="date">2 Month ago</div>
							</div>
							<div class="course-slide">
								<div class="name"><a href="forums-profile.html">Kavanagh</a> on by <img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img3.jpg" alt=""><a href="forum-single-topic.html">Exam-Learn 2015</a></div>
								<div class="date">1 Year ago</div>
							</div>
						</div>
						<h3>Forum Statistics</h3>
						<ul class="working-list">
							<li>Replies<span>5</span></li>
							<li>Topics<span>10</span></li>
							<li>Topic Tags<span>7</span></li>
							<li>Registered Users<span>888</span></li>
							<li>Forums<span>5</span></li>
						</ul>
						<h3>Topic Views List</h3>
						<ul class="catagorie-list">
							<li><a href="#">Most popular Course</a></li>
							<li><a href="#">Exam Course</a></li>
							<li><a href="#">Course Details</a></li>
						</ul>
					-->
				</div>
			</div>
		</div>
	</div>
</div>