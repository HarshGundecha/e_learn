<?php	
	// echo "<pre>";
	// print_r($Course_Data);
	// print_r($Chapter_Data);
	// echo "</pre>";
	// die();
?>

<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>courses details Free Courses</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/category/');?>">All courses</a></li>
			<li><a href="#">courses details</a></li>
		</ul>
	</div>
</section>
<div class="course-details">
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-8 col-md-9">original of below line -->
			<div class="col-sm-10 col-md-10 col-md-offset-1">
				<h2><?=$Course_Data->CourseName;?></h2>
				<div class="course-details-main" style="height:225px;width:225px;">
					<div class="course-img">
						<img src="<?=base_url('resources/admin/uploads/'.$Course_Data->CourseImage);?>" alt="" style="height:225px;width:225px;">
					</div>
				</div>
				<div class="info">
					<h4>Course Overview</h4>
					<p><?=$Course_Data->CourseDescription;?></p>
				</div>
				<div class="syllabus">
					<h4>Syllabus</h4>
					<?php
						$flag=1;
						foreach($Chapter_Data as $cd)
						{
					?>
							<div class="syllabus-box">
								<div class="syllabus-title">Lesson <?=$flag?></div>
								<div class="syllabus-view<?php if($flag==1)echo ' first ';?>">
									<div class="main-point<?php if($flag==1)echo ' active ';?>"><?=$cd->ChapterName?></div>
									<div class="point-list">
										<ul>
											<?php
												foreach ($cd->Section_Data as $sd)
												{
											?>
													<li><a href="<?=site_url('/Section/'.$sd->SectionID);?>"> <?=$sd->SectionName?> <span class="hover-text">Let's Go<i class="fa fa-angle-right"></i></span></a></li>
											<?php
												}
											?>
										</ul>
									</div>
								</div>
							</div>
					<?php
						$flag++;
						}
					?>
					<!--
						<div class="syllabus-box">
							<div class="syllabus-title">2st lesson</div>
							<div class="syllabus-view">
								<div class="main-point">It is a long established fact that a reader will be distracted by the</div>
								<div class="point-list">
									<ul>
										<li><a href="course-lessons.html">Lessons : auctor quam quis commodo feugiat. <span class="hover-text">understand now<i class="fa fa-angle-right"></i></span></a></li>                                	
										<li><a href="course-lessons.html">vedio : Lorem ipsum dolor sit amet. <span class="hover-text">Watch Video<i class="fa fa-angle-right"></i></span></a></li>
										<li><a href="course-lessons.html">Document : semper dolor quis lectus facilisis laoreet. <span class="hover-text">Let's Go<i class="fa fa-angle-right"></i></span></a></li>
										<li><a href="quiz-intro.html">Quizzes : auctor quam quis commodo feugiat. <span class="hover-text">upgrade now<i class="fa fa-angle-right"></i></span></a></li>

									</ul>
								</div>
							</div>
						</div>
						<div class="syllabus-box">
							<div class="syllabus-title">3st lesson</div>
							<div class="syllabus-view">
								<div class="main-point">readable content of a page when looking at its layout. The point of </div>
								<div class="point-list">
									<ul>
										<li><a href="course-lessons.html">Lessons : auctor quam quis commodo feugiat. <span class="hover-text">understand now<i class="fa fa-angle-right"></i></span></a></li>                                	
										<li><a href="course-lessons.html">vedio : Lorem ipsum dolor sit amet. <span class="hover-text">Watch Video<i class="fa fa-angle-right"></i></span></a></li>
										<li><a href="course-lessons.html">Document : semper dolor quis lectus facilisis laoreet. <span class="hover-text">Let's Go<i class="fa fa-angle-right"></i></span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="syllabus-box">
							<div class="syllabus-title">4st lesson</div>
							<div class="syllabus-view">
								<div class="main-point">using Lorem Ipsum is that it has a more-or-less normal distribution </div>
								<div class="point-list">
									<ul>
										<li><a href="course-lessons.html">Lessons : auctor quam quis commodo feugiat. <span class="hover-text">understand now<i class="fa fa-angle-right"></i></span></a></li>                                	
										<li><a href="course-lessons.html">vedio : Lorem ipsum dolor sit amet. <span class="hover-text">Watch Video<i class="fa fa-angle-right"></i></span></a></li>
										<li><a href="quiz-intro.html">Quizzes : auctor quam quis commodo feugiat. <span class="hover-text">upgrade now<i class="fa fa-angle-right"></i></span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="syllabus-box">
							<div class="syllabus-title">5st lesson</div>
							<div class="syllabus-view">
								<div class="main-point">of letters, as opposed to using 'Content here, content here', </div>
								<div class="point-list">
									<ul>
										<li><a href="course-lessons.html">Lessons : auctor quam quis commodo feugiat. <span class="hover-text">understand now<i class="fa fa-angle-right"></i></span></a></li>                                	
										<li><a href="course-lessons.html">Document : semper dolor quis lectus facilisis laoreet. <span class="hover-text">Let's Go<i class="fa fa-angle-right"></i></span></a></li>
										<li><a href="quiz-intro.html">Quizzes : auctor quam quis commodo feugiat. <span class="hover-text">upgrade now<i class="fa fa-angle-right"></i></span></a></li>
									</ul>
								</div>
							</div>
						</div>
					-->
				</div>
				<!--
					<div class="reviews">
						<h4>Reviews</h4>
						<div class="row">
							<div class="col-sm-5">
								<div class="rating-info">
									<label>Detailed Rating</label>
									<div class="rating-slide">
										<span>Stars 5</span>
										<div class="bar">
											<div class="fill" style="width:50%"></div>
										</div>
										<em>10</em>
									</div>
									<div class="rating-slide">
										<span>Stars 4</span>
										<div class="bar">
											<div class="fill" style="width:40%"></div>
										</div>
										<em>8</em>
									</div>
									<div class="rating-slide">
										<span>Stars 3</span>
										<div class="bar">
											<div class="fill" style="width:30%"></div>
										</div>
										<em>6</em>
									</div>
									<div class="rating-slide">
										<span>Stars 2</span>
										<div class="bar">
											<div class="fill" style="width:35%"></div>
										</div>
										<em>7</em>
									</div>
									<div class="rating-slide">
										<span>Stars 1</span>
										<div class="bar">
											<div class="fill" style="width:0"></div>
										</div>
										<em>0</em>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<label>Average Rating</label>
								<div class="rating-box">
									<div class="rating">4.3</div>
									<div class="rating-star">
										<div class="fill" style="width:86%"></div>
									</div>
									<span>31 Ratings</span>
								</div>
							</div>
						</div>
						<div class="reviews-view">
							<h4>Reviews List</h4>
							<div class="reviews-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/student-img1.png" alt=""></div>
								<div class="rating-star">
									<div class="fill" style="width:82%"></div>
								</div>
								<span>5 Day ago</span>
								<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you </p>
							</div>
							<div class="reviews-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/student-img1.png" alt=""></div>
								<div class="rating-star">
									<div class="fill" style="width:69%"></div>
								</div>
								<span>5 Month ago</span>
								<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you </p>
							</div>
							<div class="reviews-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/user-img/student-img1.png" alt=""></div>
								<div class="rating-star">
									<div class="fill" style="width:70%"></div>
								</div>
								<span>2.5 Years ago</span>
								<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you </p>
							</div>
						</div>
					</div>
				-->
			</div>
			<!--
				<div class="col-sm-4 col-md-3">
					<div class="right-slide">
						<h3>Course Details</h3>
						<div class="course-details-list"> 
							<ul>
								<li><i class="fa fa-user-secret"></i>Rebecca Smith</li>
								<li><i class="fa fa-file"></i>17 Lessons</li>
								<li><i class="fa fa-exclamation"></i>7 Quizzes</li>
								<li><i class="fa fa-file-text-o"></i>13 Documents</li>
								<li><i class="fa fa-video-camera"></i>9 vedio</li>
								<li><i class="fa fa-mortar-board"></i>1719 Students</li>
								<li><i class="fa fa-calendar"></i>16-09-2016 - 15-08-2018 </li>
							</ul>
							<div class="price-info"><span>Price: </span>Free</div>
							<div class="btn-block">	
								<a href="#" class="btn">ENROLL</a>
							</div>
						</div>
						<h3>INSTRUCTORS</h3>
						<div class="instructors-slider">
							<div class="item">
								<div class="teacher-box">
									<div class="img">
										<img src="<?=base_url('resources/user/assets/');?>images/team-member/member-img8.jpg" alt="">
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
							<div class="item">
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
						<h3>Tags</h3>
						<ul class="keyword-list">
							<li><a href="#">Html</a></li>
							<li><a href="#">Boostrap</a></li>
							<li><a href="#">Css3</a></li>
							<li><a href="#">Jquery</a></li>
							<li><a href="#">Student</a></li>
							<li><a href="#">Html</a></li>
							<li><a href="#">Boostrap</a></li>
							<li><a href="#">Css3</a></li>
							<li><a href="#">Jquery</a></li>
							<li><a href="#">Student</a></li>
						</ul>
					</div>
				</div>
			-->
		</div>
		
	</div>
</div>