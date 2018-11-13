<section class="banner">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="banner-text">
		<div class="container">
			<h1>Play Challenge and Do Your Best</h1>
			<p>Win Challenge To Earn XP</p>
			<div class="learning-btn" style="margin-top:105px;">
				<a href="<?=site_url('/Challenge/course/');?>" class="btn">Challenge Now</a>
			</div>
		</div>
	</div>
</section>
<section class="our-course">
	<div class="container">
		<div class="section-title">
			<h2>Challenge History</h2>
		</div>
		<div class="row">
			<?php
				foreach ($SenderData as $sd)
				{
			?>
					<div class="col-md-4 col-sm-6">
						<div class="course-box">
							<div class="ih-item square effect10 left_to_right">
								<a class="main-box-link">
									<div class="img">
										<img src="<?=base_url('resources/admin/uploads/'.$sd->CourseImage);?>" alt="img" style="height:250px;width:250px;">
									</div>
									<div class="info">
										<img src="<?=base_url('resources/user/uploads/'.$sd->UserAvatar);?>" style="height:100px;width:100px;border-radius: 50%;margin-top:5px;">
										<h3 style="margin-top: 5px;font-size:1.8em;"><?=$sd->UserName?></h3>
										<p>
											<?php
												if($sd->ReceiverXP<0)
													echo '<i class="fa fa-thumbs-down"></i> '.$sd->ReceiverXP.' XP Loss';
												else
													echo '<i class="fa fa-thumbs-up"></i> '.$sd->ReceiverXP.' XP Won';
											?>
										</p>
									</div>
								</a>
							</div>
							<div class="price-label free">
								<?php
									if($sd->SenderXP<0)
										echo 'Loss';
									else
										echo 'Won';
								?>
							</div>
							<div class="course-name"><?=$sd->CourseName?><span><em>Challenge Total XP : </em>20</span></div>
							<div class="comment-row">
								<div class="rating">
									<div class="fill" style="width:<?=5*$sd->SenderXP?>%"></div>
								</div>
								<div class="box" style="padding:0px;"><i class="fa fa-heart"></i>
									<?php
										if($sd->SenderXP<0)
											echo $sd->SenderXP.' XP Loss';
										else
											echo $sd->SenderXP.' XP Won';
									?>
								</div>
								<div class="enroll-btn">	
									<a href="<?=site_url('/Challenge/'.$sd->ChallengeID);?>" class="btn">View Detail</a>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
			<!--
				<div class="col-md-4 col-sm-6">
					<div class="course-box">
						<div class="img">
							<img src="<?=base_url('resources/user/assets/');?>images/courses/courses-img2.jpg" alt="">
							<div class="course-info">
								<div class="date"><i class="fa fa-calendar"></i>4 weeks, 5 Days ago</div>
							</div>
							<div class="price free">Won</div>
						</div>
						<div class="course-name">Course Name<span><em>Challenge Total XP : </em>50</span></div>
						<div class="comment-row">
							<div class="rating">
								<div class="fill" style="width:45%"></div>
							</div>
							<div class="box"><i class="fa fa-heart"></i>5 XP Won</div>
							<div class="enroll-btn">	
								<a href="#" class="btn">View Detail</a>
							</div>
						</div>
					</div>
				</div>
			-->
		</div>
	</div>
</section>