<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Contact Us</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
	</div>
</section>
<section class="contact-detail">
	<div class="container">
		<div class="section-title">
			
			<h2>Get in Touch</h2>
			<p>
				Want to suggest something ?<br>
				Got a question?<br>
				Want to say something ?<br>
				Reach us anytime using any of the following way, we would be happy to hear from you :) 
			</p>
		</div>
		<div class="contact-boxView">
			<div class="row">
				<div class="col-sm-4">
					<a href="some_link_here">
						<div class="contact-box yello">
							<div class="icon-box">
								<i class="fa fa-map-marker"></i>
							</div>
							<h4>location</h4>
							<p>F-23, Agersen Point, City Light, Surat</p>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="Tel:919558994445">
						<div class="contact-box green">
							<div class="icon-box">
								<i class="fa fa-phone"></i>
							</div>
							<h4>phone number</h4>
							<p>+91 95589 94445</p>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="your_mail_here">
						<div class="contact-box red">
							<div class="icon-box">
								<i class="fa fa-envelope"></i>
							</div>
							<h4>email address</h4>
							<p>your_mail_here</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="contact-message">
	<div class="container">
		<div class="section-title">
			<h2>SEND A MESSAGE</h2>
		</div>
		<div class="form-filde">
			<div class="row">
				<div class="col-sm-12">
					<form class="has-validation-callback" action="<?=site_url('/ContactUs/SendReport')?>" method="post">
						<div class="input-box">
							<input type="text" placeholder="Subject" data-validation="required" name="aSiteReportSubject" >
							<br>
							<?=form_error('aSiteReportSubject')?>
						</div>
						<div class="input-box">
							<textarea placeholder="Your Message :)" data-validation="required" name="aSiteReportContent"></textarea>
							<br>
							<?=form_error('aSiteReportContent')?>
						</div>
						<div class="submit-box">
							<input type="submit" value="SEND" class="btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>