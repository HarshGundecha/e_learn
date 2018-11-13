<section class="banner inner-page">
		<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
		<div class="page-title">    
				<div class="container">
						<h1>Reset Password</h1>
				</div>
		</div>
</section>
<section class="breadcrumb">
		<div class="container">
				<ul>
						<li><a href="<?=site_url('/Login');?>">Login & Register</a></li>
						<li><a href="#">Get OTP</a></li>
				</ul>
		</div>
</section>
<section class="login-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3" style="border-left:none;">
				<div class="section-title">
					<h2>Get OTP</h2>
					<p>Get One Time Password To Your Email</p>
				</div>
				<form action="<?php echo site_url('/ResetPassword/GetOTP'); ?>" method="post">
					<div class="input-box">
						<input type="Email" name="UserEmail" placeholder="Enter Your Email">
					</div>
					<div>
						<label style="color:red;">
							<?php
								if(isset($error))
									echo $error;
							?>
						</label>
					</div>
					<div class="submit-slide" style="text-align:center;">
						<input type="submit" value="Get OTP" class="btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>