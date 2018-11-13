<footer id="footer">
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='your_address_here';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
	<!--
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<h5>Popular Courses</h5>
						<div class="course-slide">
							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img1.jpg" alt=""></div>
							<p><a href="courses-list.html">when an unknown printer took </a></p>
							<div class="price">$55</div>
						</div>
						<div class="course-slide">
							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img2.jpg" alt=""></div>
							<p><a href="courses-list-sideBar.html">when an unknown printer took </a></p>
							<div class="price">$505</div>
						</div>
						<div class="course-slide">
							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img3.jpg" alt=""></div>
							<p><a href="courses-list.html">when an unknown printer took </a></p>
							<div class="price">$178</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-md-offset-1 col-sm-6 col-md-5 col-xs-6">
								<h5>Company</h5>
								<ul class="footer-link">
									<li><a href="about-us.html">About Us</a></li>
									<li><a href="contact-us.html">Contact</a></li>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="event.html">Event</a></li>
									<li><a href="gallery.html">Gallery</a></li>
									<li><a href="instructor-profile.html">Instructor Profile</a></li>
								</ul>	
							</div>
							<div class="col-md-offset-1 col-sm-6 col-md-5 col-xs-6">
								<h5>Links</h5>
								<ul class="footer-link">
									<li><a href="courses-list.html">Courses List</a></li>
									<li><a href="price-plan.html">Pricing Table</a></li>
									<li><a href="instructors.html">Instructors</a></li>
									<li><a href="forums.html">Forums</a></li>
									<li><a href="faq.html">Faq</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<h5>Contact Us</h5>
						<div class="contact-view">
							<div class="contact-slide">
								<p><i class="fa fa-location-arrow"></i>76 Woodland Ave. Sherman Drive  <br>Fort Walton Beach,Harlingen</p>
							</div>
							<div class="contact-slide">
								<p><i class="fa fa-phone"></i>+299 97 39 82</p>
							</div>
							<div class="contact-slide">
								<p><i class="fa fa-fax"></i>(08) 8971 7450</p>
							</div>
							<div class="contact-slide">
								<p><i class="fa fa-envelope"></i><a href="mailTo:academy@info.com">academy@info.com</a></p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	-->
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="copy-right">
					<p>Copyright © <span class="year">2018</span> e_learn.</p>
					<!--
						<ul class="footer-link">
							<li><a href="#">Terms and Conditions</a></li>
							<li><a href="#">Privacy</a></li>
						</ul>
					-->
				</div>
			</div>
			<div class="col-sm-4 ">	
				<div class="social-media">
					<ul>


                        <?php
                            if($this->session->UserID)
                            {
                        ?>
						<li><a class="btn btn-info" href="<?=site_url('/ContactUs')?>">Contact Us</a></li>
						<li><a href="https://www.facebook.com/your_brand_here/"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://api.whatsapp.com/send?text=Hello, <?=$this->session->UserName?> Here&phone=xxxxxxxxxx"><i class="fa fa-whatsapp"></i></a>
						</li>
                	    <li><a href="https://www.instagram.com/your_brand_here"><i class="fa fa-instagram"></i></a>
						        </li>
                        <?php
                            }
                        ?>


						<!--
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-skype"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					 	-->
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>