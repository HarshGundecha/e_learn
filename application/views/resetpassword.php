<?php
	if(!$this->session->EmailResetPassword)
		redirect('ResetPassword');
?>
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
						<li><a href="<?=site_url('/ResetPassword');?>">Get OTP</a></li>
						<li><a href="#">Reset Password</a></li>
				</ul>
		</div>
</section>
<section class="login-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3" style="border-left:none;">
				<div class="section-title">
					<h2>Reset Password</h2>
					<p>Reset Password Using OTP Sended To Your Email</p>
				</div>
				<form action="<?php echo site_url('/ResetPassword/ChangePassword'); ?>" method="post">
					<div class="input-box">
						<input type="text" name="aUserOTP" placeholder="Already Have An OTP Insert Here..">
						<font style="color:#cccccc;margin-left:10px;">*Case Sensitive</font>
						<div>
							<label style="color:red;">
								<?php
									echo form_error('aUserOTP');
									if(isset($error))
										echo $error;
								?>
							</label>
						</div>
					</div>
					<div class="input-box">
						<input type="password" name="aUserPassword" placeholder="Password">
					</div>
					<div>
						<label style="color:red;">
							<?php
								echo form_error('aUserPassword');
							?>
						</label>
					</div>
					<div class="input-box">
						<input type="password" name="aRePassword" placeholder="Confirm Password">
					</div>
					<div>
						<label style="color:red;">
							<?php
								echo form_error('aRePassword');
							?>
						</label>
					</div>
					
					<div>
						<label style="color:red;">
							<?php
								// if(isset($error))
								// 	echo $error;
							?>
						</label>
					</div>
					<div class="submit-slide" style="text-align:center;">
						<input type="submit" value="Change Password" class="btn">
					</div>
				</form>
				<br>
				<div class="submit-slide" style="text-align:center;">
					<font style="color:#262626;margin-left:10px;">Didn't Get OTP Yet..?</font>
					<a href="<?=site_url('ResetPassword/ReSendOTP');?>" class="btn2" style="padding:10px;text-transform:none;display:unset;">Resend OTP</a>
				</div>
			</div>
		</div>
	</div>
</section>