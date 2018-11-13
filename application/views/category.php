<?php
		// echo "<pre>";
		// print_r($Category_Data);
		// echo "</pre>";
		// die();
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Courses List</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">All courses</a></li>
		</ul>
	</div>
</section>
<section class="courses-view list-view">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="right-slide left">

					<h3>Catagories</h3>
					<ul class="catagorie-list">
                            <li>

                            </li>
						<?php
							foreach ($Category_Data as $cd)
							{
						?>
								<li><a href="<?=site_url('/Category/'.$cd->CategoryID);?>"><?=$cd->CategoryName;?></a></li>
						<?php
							}
						?>
					</ul>
					<!--
						<h3>Price</h3>
						<div class="filter-blcok">
							<div class="check-slide">
								<label class="label_check" for="checkbox-01"><input id="checkbox-01" type="checkbox"> Free</label>
							</div>
							<div class="check-slide">
								<label class="label_check" for="checkbox-02"><input id="checkbox-02" type="checkbox"> Paid</label>
							</div>
						</div>
						<h3>Language</h3>
						<div class="filter-blcok">
							<div class="check-slide">
								<label class="label_check" for="checkbox-03"><input id="checkbox-03" type="checkbox"> Chinese</label>
							</div>
							<div class="check-slide">
								<label class="label_check" for="checkbox-04"><input id="checkbox-04" type="checkbox"> English</label>
							</div>
							<div class="check-slide">
								<label class="label_check" for="checkbox-05"><input id="checkbox-05" type="checkbox"> French</label>
							</div>
							<div class="check-slide">
								<label class="label_check" for="checkbox-06"><input id="checkbox-06" type="checkbox"> Portuguese</label>
							</div>
						</div>
						<h3>Related Courses</h3>
						<div class="recent-post">
							<div class="post-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img1.jpg" alt=""></div>
								<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
								<div class="date">$200</div>
							</div>
							<div class="post-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img2.jpg" alt=""></div>
								<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
								<div class="date">FREE</div>
							</div>
							<div class="post-slide">
								<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img3.jpg" alt=""></div>
								<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
								<div class="date">$78</div>
							</div>
						</div>
						
						<h3>Keywords</h3>
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
					-->
				</div>
			</div>
			<div class="col-md-9">
				<div class="filter-row">
					<!--
						<div class="view-type">
							<a href="courses-gride-sideBar.html"><i class="fa fa-th-large"></i></a>
							<a href="courses-list-sideBar.html" class="active"><i class="fa fa-list"></i></a>
						</div>
					-->
					<center>
					    <h3>Courses</h3>
                        <!-- These styles fix CSE and Bootstrap 3 conflict -->
                        <!--<style type="text/css">
                            .reset-box-sizing, .reset-box-sizing *, .reset-box-sizing *:before, .reset-box-sizing *:after,  .gsc-inline-block
                            {
                                -webkit-box-sizing: content-box;
                                -moz-box-sizing: content-box;
                                box-sizing: content-box;
                            }
                            input.gsc-input, .gsc-input-box, .gsc-input-box-hover, .gsc-input-box-focus, .gsc-search-button
                            {
                                box-sizing: content-box;
                                line-height: normal;
                            }
                        </style>
                        <script>
                          (function() {
                            var cx = '012998091516256671414:1uga3yymsgu';
                            var gcse = document.createElement('script');
                            gcse.type = 'text/javascript';
                            gcse.async = true;
                            gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(gcse, s);
                          })();
                        </script>
                        <gcse:search></gcse:search>-->
                    </center>
					<!--
						<div class="search">
							<input type="text" placeholder="Search">
							<input type="submit" value="">
						</div>
					-->
				</div>
				<?php
					foreach ($Course_Data as $cd)
					{
				?>
						<div class="course-post">
							<div class="img">
								<img src="<?=base_url('resources/admin/uploads/'.$cd->CourseImage );?>" alt="">
								<div class="icon">
									<a href="<?=site_url('/Course/'.$cd->CourseID);?>"><img src="<?=base_url('resources/user/assets/');?>images/book-icon.png" alt=""></a>
								</div>
								<div class="price free">free</div>
								<!-- <div class="price">$23</div> -->
							</div>
							<div class="info">
								<div class="name"><?=$cd->CourseName;?></div>
								<div class="expert"><span>By </span> <?=$cd->AddedByAdminName;?></div>
								<div class="product-footer">
									<!--
										<div class="comment-box">	
											<div class="box"><i class="fa fa-users"></i>35 Enrolled</div>
										</div>
										<div class="rating">
											<div class="fill" style="width:45%"></div>
										</div>
									-->
									<p><?=$cd->CourseDescription;?></p>
									<div class="view-btn2">
										<a href="<?=site_url('/Course/'.$cd->CourseID);?>" class="btn2">view more</a>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
				?>
				<!-- <div class="pagination">
					<ul>
						<li class="next"><a href="#"><i class="fa fa-angle-left"></i><span>Next</span></a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li class="prev"><a href="#"><span>prev</span> <i class="fa fa-angle-right"></i></a></li>
					</ul>
				</div> -->
			</div>
		</div>
	</div>
</section>