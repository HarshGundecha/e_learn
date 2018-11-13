<section class="banner">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="banner-text">
		<div class="container">
			<h1>Learn the smart way</h1>
			<p>Join us today :)</p>
			<!--
				<div class="search-box">	
					<input type="text" placeholder="Search here">
					<input type="submit" value="">
				</div>
			-->
			<div class="learning-btn" style="margin-top:105px;">
				<a href="<?=site_url('/Category');?>" class="btn">Start learning now</a>
			</div>
		</div>
	</div>
</section>
<section class="our-course">
	<div class="container">
		<div class="section-title">
			<h2>Some Of Our Courses</h2>
		</div>
		<div class="row">
			<?php
				foreach($CourseData as $cd)
				{
			?>
					<div class="col-md-4 col-sm-6">
						<div class="course-box">
							<div class="img">
								<img src="<?=base_url('resources/admin/uploads/'.$cd->CourseImage);?>" alt="" style="height:250px;width:250px;margin-left:59px;">
								<div class="price free">free</div>
							</div>
							<div class="comment-row">
								<font style="font-size:1.8em;font-weight:bold;"><?=$cd->CourseName?></font>
								<div class="enroll-btn">	
									<a href="<?=site_url('/Course/'.$cd->CourseID);?>" class="btn">Enroll</a>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
		</div>
	</div>
</section>
<!-- <section class="preparation">
	<div class="container">
		<div class="section-title white">
			<h2>Maximize your preparation</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
		</div>
		<div class="preparation-view">
			<div class="item">
				<div class="icon"><img src="<?=base_url('resources/user/assets/');?>images/preparation-icon1.png" alt=""></div>
				<div class="course-name">Highest Quality Content by IIM Alumni  <span>CONTENT</span></div>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
			</div>
			<div class="item">
				<div class="icon"><img src="<?=base_url('resources/user/assets/');?>images/preparation-icon2.png" alt=""></div>
				<div class="course-name">Detailed Analysis with Performance Indicators<span>ANALYSIS</span></div>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
			</div>
			<div class="item">
				<div class="icon"><img src="<?=base_url('resources/user/assets/');?>images/preparation-icon1.png" alt=""></div>
				<div class="course-name">Highest Quality Content by IIM Alumni  <span>CONTENT</span></div>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
			</div>
			<div class="item">
				<div class="icon"><img src="<?=base_url('resources/user/assets/');?>images/preparation-icon2.png" alt=""></div>
				<div class="course-name">Detailed Analysis with Performance Indicators<span>ANALYSIS</span></div>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
			</div>
		</div>
	</div>
</section>
 -->
<section class="student-feedback">
	<div class="container">
		<div class="section-title">
			<h2>Top Users</h2>
		</div>
		<div class="feedback-slider" style="padding-bottom:0px;background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(http://localhost/projects/ts2/resources/user/assets/images/background/<?=rand(1,50)?>.jpg);overflow-x:hidden;margin-bottom:10px;">
			<div class="item">
				<div class="student-img"><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt="" style="height:80px;width:80px;"></div>
				<div class="student-name" style="font-size:2em;color: white;"><?=$UserData[0]->UserName?></div>
				<div class="student-designation" style="margin-top:30px;font-size:1.7em;"><?=$UserData[0]->UserXP?> XP</div>
			</div>
			<div class="item">
				<div class="student-img"><img src="<?=base_url('resources/user/uploads/'.$UserData[1]->UserAvatar);?>" alt="" style="height:80px;width:80px;"></div>
				<div class="student-name" style="font-size:2em;color: white;"><?=$UserData[1]->UserName?></div>
				<div class="student-designation" style="margin-top:30px;font-size:1.7em;"><?=$UserData[1]->UserXP?> XP</div>
			</div>
		</div>
		<div class="more-stories">
			<a href="<?=site_url('/Home/Users');?>" class="btn">View More Students</a>
		</div>
	</div>
</section>
<!--
	<section class="our-team">
		<div class="section-title">
			<h2>Our Team</h2>
		</div>
		<div class="member-slider">	
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img1.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Hardik Chauhan<span>Strategizer</span></div>
				</div>
			</div>
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img2.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Dhruv Patel<span>Geek-in-charge, Coder extraordinaire</span></div>
				</div>
			</div>
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img3.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Ravi Chauhan<span>A.K.A Freshie </span></div>
				</div>
			</div>
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img1.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Hardik Chauhan<span>Strategizer</span></div>
				</div>
			</div>
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img2.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Dhruv Patel<span>Geek-in-charge, Coder extraordinaire</span></div>
				</div>
			</div>
			<div class="item">
				<div class="member-info">
					<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img3.png" alt=""></div>
					<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry it has survived not only five centuries, but also the leap into electronic typesetting, unchanged...</p>
					<p>It was popularised in the 1960s with the release of recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<div class="member-name">-Ravi Chauhan<span>A.K.A Freshie </span></div>
				</div>
			</div>
		</div>
	</section>
	<section class="graph-view">
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="graph-title">climbing the Percentile Ladder</div>
					<img src="<?=base_url('resources/user/assets/');?>images/graph-img.png" alt="">
				</div>
				<div class="col-sm-7">
					<div class="point-view">
						<div class="graph-point">
							<i class="fa fa-area-chart"></i>
							<h4>Lorem Ipsum is simply dummy text</h4>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.</p>
						</div>
						<div class="graph-point">
							<i class="fa fa-users"></i>
							<h4>Lorem Ipsum is simply dummy text</h4>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
-->

<section class="page-404">
	<div class="section-title">
		<h2>Location</h2>
	</div>
	<div class="container">
		<iframe src="some_link_here" frameborder="0" style="border:0" allowfullscreen height="450" width="100%"></iframe>
	</div>
</section>

<section class="start-learning">
	<div class="container">
		<p>I've read enough. Take me to Courses</p>
		<a href="<?=site_url('/Category');?>" class="btn">Start learning now</a>
	</div>
</section>

<!-- 	
	<section class="contact-block">
			<div class="contact-form">
				<div class="section-title">
					<h2>Contact Us</h2>
				</div>
				<div class="form-filde">
					<form class="has-validation-callback" action="thank-you.html" method="post">
						<div class="input-box">
							<input type="text" placeholder="Name" data-validation="required" name="name" >
						</div>
						<div class="input-box">
							<input type="text" placeholder="Email" data-validation="required" name="email" >
						</div>
						<div class="input-box">
							<textarea placeholder="Message" data-validation="required" name="message"></textarea>
						</div>
						<div class="submit-slide">
							<input type="submit" value="Submit" class="btn" >
						</div>
					</form>
				</div>
			</div>
			<div class="map" id="map">
			</div>
	</section>
 -->