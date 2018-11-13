<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>List Of Courses</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Select Course</a></li>
		</ul>
	</div>
</section>
<section class="courses-view">
	<div class="container">
		<!--
			<div class="filter-row">
				<div class="view-type">
					<a href="courses-gride.html" class="active"><i class="fa fa-th-large"></i></a>
					<a href="courses-list.html"><i class="fa fa-list"></i></a>
				</div>
				<div class="search">
					<input type="text" placeholder="Search">
					<input type="submit" value="">
				</div>
			</div>
		-->
		<div class="row">
			<?php
				foreach($Course_Data as $cd)
				{
			?>
					<div class="col-sm-6 col-md-3">
						<div class="course-post">
							<div class="img">
								<img src="<?=base_url('resources/admin/uploads/'.$cd->CourseImage);?>" alt="" style="height:270px;width:270px;">
								<div class="price free">free</div>    
								<div class="icon">
									<a href="<?=site_url('challenge/users/'.$cd->CourseID);?>"><img src="<?=base_url('resources/user/assets/');?>images/book-icon.png" alt=""></a>
								</div>
							</div>
							<!--
								<div class="info">
									<div class="name">Introduction to Mobile Apps Development</div>
									<div class="expert"><span>By </span>Michael Windzor</div>
								</div>
							-->
							<div class="product-footer">
								<div class="comment-box">	
									<div class="box"><i class="fa fa-book"></i><?=$cd->CourseName?></div>
								</div>
								<!--
									<div class="rating">
										<div class="fill" style="width:45%"></div>
									</div>
								-->
								<div class="view-btn">
									<a href="<?=site_url('challenge/users/'.$cd->CourseID);?>" class="btn">Select Course</a>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
		</div>
		<div class="pagination">
			<ul>
				<li class="next"><a href="#"><i class="fa fa-angle-left"></i><span>Next</span></a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li class="prev"><a href="#"><span>prev</span> <i class="fa fa-angle-right"></i></a></li>
			</ul>
		</div>
	</div>
</section>