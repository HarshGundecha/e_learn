<?php
// echo "<pre>";
// print_r($Section_Data);
// echo "</pre>";
// die();
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>courses Lessons</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/category/');?>">All courses</a></li>
			<!-- <li><a href="#">courses details</a></li> -->
			<li><a href="#">courses Lessons</a></li>
		</ul>
	</div>
</section>
<section class="lession-view">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!--
					<div class="vedio-box">
						<img src="<?=base_url('resources/user/assets/');?>images/courses/courses-img8.jpg" alt="">
						<div class="play-icon"><i class="fa fa-play"></i></div>
					</div>
				-->
				<h1 style="color:black;"><?=$Section_Data[0]->SectionName;?></h1>
				<div class="lessone-info">
					<pre>
						<?php
							echo $Section_Data[0]->SectionContent;
						?>
					</pre>
					<?php //die(); ?>
					<!--
						<div class="bottom-nav">
							<a href="#"><i class="fa fa-long-arrow-left"></i>Prev Lessons</a>
							<a href="#" class="pull-right">Next Lessons <i class="fa fa-long-arrow-right"></i></a>
						</div>
					-->
					<div class="back-link">
						<a href="<?=site_url('/category/');?>"><i class="fa fa-reply"></i>Back to Categories</a>
					</div>
				</div>
			</div>
			<!--
				<div class="col-md-3">
					<div class="right-slide">
						<h3>Working Hours</h3>
						<ul class="working-list">
							<li>Monday<span>10am - 7pm</span></li>
							<li>Tuesday<span>10am - 7pm</span></li>
							<li>Wednesday<span>10am - 7pm</span></li>
							<li>Thursday<span>10am - 7pm</span></li>
							<li>Friday<span>10am - 7pm</span></li>
							<li>Saturday<span class="closed">Closed</span></li>
							<li>Sunday<span class="closed ">Closed</span></li>
						</ul>
						<h3>Latest Posts</h3>
						<div class="recent-post">
							<div class="post-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img1.jpg" alt=""></div>
								<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
								<div class="date">12 Jan</div>
							</div>
							<div class="post-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img2.jpg" alt=""></div>
								<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
								<div class="date">12 Jan</div>
							</div>
						</div>
						<h3>Teachers</h3>
						<div class="teacher-box">
							<div class="img">
								<img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img7.jpg" alt="">
								<div class="sosiyal-mediya">
									<ul>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="name">Lorem ipsum dolor sit amet, </div>
							<div class="designation">consectetur </div>
							<p>Vestibulum tincidunt nibh aliquam odio ultrices imperdiet.</p>
						</div>
					</div>
				</div>
			-->
		</div>
	</div>
</section>