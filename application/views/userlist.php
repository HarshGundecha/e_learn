<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Select User</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/Challenge/');?>">Courses List</a></li>
			<li><a href="#">Select User</a></li>
		</ul>
	</div>
</section>
<div class="forums-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="group-tab-view">
					<div class="tab-menu">
						<ul>
							<li class="active"><a href="#AllUser" data-toggle="tab">All Users <span style="background-color:#595959;"><font style="font-weight:bolder;color:white;"><?=$UserCount?></font></span></a></li>
							<li><a href="#Followers" data-toggle="tab">Followers <span style="background-color:#595959;"><font style="font-weight:bolder;color:white;"><?=$FollowersCount?></font></span></a></li>
							<li><a href="#Following" data-toggle="tab">Following <span style="background-color:#595959;"><font style="font-weight:bolder;color:white;"><?=$FollowingCount?></font></span></a></li>
						</ul>
					</div>
					<div class="tab-content" style="margin-top: 30px;">
						<div class="tab-pane active" id="AllUser">
							<div class="group-member">
								<div class="row">
									<?php
										foreach ($User_Data as $ud)
										{
									?>
											<a href="<?=site_url('/challenge/start/'.$CourseID.'/'.$ud->UserID);?>">
												<div class="col-sm-6 col-md-4">
													<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
														<div class="img">
															<img src="<?=base_url('resources/user/uploads/'.$ud->UserAvatar);?>" alt="">
														</div>
														<div class="name" style="color: white;font-weight: bolder"><?=$ud->UserName?></div>
														<div class="join-details" style="color: white;font-weight: bolder"><?=$ud->UserXP?> XP</div>
													</div>
												</div>
											</a>
									<?php
										}
									?>					
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Followers">
							<div class="group-member">
								<div class="row">
									<?php
										foreach ($FollowersData as $fd)
										{
									?>
											<a href="<?=site_url('/challenge/start/'.$CourseID.'/'.$fd->UserID);?>">
												<div class="col-sm-6 col-md-4">
													<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
														<div class="img">
															<img src="<?=base_url('resources/user/uploads/'.$fd->UserAvatar);?>" alt="">
														</div>
														<div class="name" style="color: white;font-weight: bolder"><?=$fd->UserName?></div>
														<div class="join-details" style="color: white;font-weight: bolder"><?=$fd->UserXP?> XP</div>
													</div>
												</div>
											</a>
									<?php
										}
									?>					
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Following">
							<div class="group-member">
								<div class="row">
									<?php
										foreach ($FollowingData as $fd)
										{
									?>
											<a href="<?=site_url('/challenge/start/'.$CourseID.'/'.$fd->UserID);?>">
												<div class="col-sm-6 col-md-4">
													<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
														<div class="img">
															<img src="<?=base_url('resources/user/uploads/'.$fd->UserAvatar);?>" alt="">
														</div>
														<div class="name" style="color: white;font-weight: bolder"><?=$fd->UserName?></div>
														<div class="join-details" style="color: white;font-weight: bolder"><?=$fd->UserXP?> XP</div>
													</div>
												</div>
											</a>
									<?php
										}
									?>					
								</div>
							</div>
						</div>
					</div>
				</div>  
			</div>
			<!--
				<div class="col-sm-3">
					<div class="right-slide">
						<div class="search-box">
							<input type="text" placeholder="Search">
							<input type="submit" value=""> 
						</div>
						<h3>Members</h3>
						<div class="member-list">
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img1.jpg" alt=""></div>
								<div class="name"><a href="forums-single-profile.html">Jörg Barth</a></div>
								<div class="activity">active 5 day, 22 hours ago</div>
							</div>
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img2.jpg" alt=""></div>
								<div class="name"><a href="forums-single-profile.html">Dieter Baum</a></div>
								<div class="activity">active 9 day, 3 hours ago</div>
							</div>
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img3.jpg" alt=""></div>
								<div class="name"><a href="forums-single-profile.html">Dieter Baum</a></div>
								<div class="activity">active 14 day, 8 hours ago</div>
							</div>
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img1.jpg" alt=""></div>
								<div class="name"><a href="forums-single-profile.html">Dieter Baum</a></div>
								<div class="activity">active 18 day, 2 hours ago</div>
							</div>
							<div class="member-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/testimonial-img2.jpg" alt=""></div>
								<div class="name"><a href="forums-single-profile.html">Dieter Baum</a></div>
								<div class="activity">active 25 day, 6 hours ago</div>
							</div>
						</div>
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
					</div>
				</div>
			-->
		</div>
	</div>
</div>