<section class="banner inner-page">
		<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
		<div class="page-title">    
				<div class="container">
						<h1>Login</h1>
				</div>
		</div>
</section>
<section class="breadcrumb">
		<div class="container">
				<ul>
						<li><a href="#">Login Or Register</a></li>
				</ul>
		</div>
</section>
<section class="login-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="section-title">
					<h2>Login</h2>
					<p>Login to your account below</p>
				</div>
				<form action="<?php echo site_url('/login/login'); ?>" method="post">
					<div class="input-box">
						<input type="text" name="sEmail" placeholder="Email">
					</div>
					<div class="input-box">
						<input type="password" name="sPassword" placeholder="Password">
					</div>
					<div>
						<label style="color:red;">
							<?php
								if(isset($error))
									echo $error;
							?>
						</label>
					</div>
					<div class="submit-slide">
						<input type="submit" value="Login" class="btn pull-left">
                        <a class="btn btn-danger pull-right pull-right" href="<?=site_url('/ResetPassword');?>">Lost Password</a>
					</div>
				</form>
			</div>
			<div class="col-sm-6">
				<form action="<?php //echo site_url('/Register/Register'); ?>" method="post">
					<div class="section-title">
						<h2>REGISTER</h2>
						<p>Register now - Completely free</p>
					</div>
					<div class="input-box">
						<input type="text" name="aUserName" placeholder="User Name">
					</div>
					<div>
						<label style="color:red;">
							<?php
								echo form_error('aUserName');
							?>
						</label>
					</div>
					
					<div class="input-box">
						<input type="text" name="aUserEmail" placeholder="Email">
					</div>
					<div>
						<label style="color:red;">
							<?php
								echo form_error('aUserEmail');
							?>
						</label>
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
					
					<div class="submit-slide">
						<input type="submit" name="btnSubmit" value="SIGN UP" class="btn">
					</div>
				</form>
			</div>
		</div>
<!--		<div class="sosiyal-login">
			<div class="row">
					<div class="col-sm-3 col-md-3">
							<a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook</a>
						</div>
						<div class="col-sm-3 col-md-3">
								<a href="#" class="google-pluse"><i class="fa fa-google-plus"></i>Google</a>
						</div>
						<div class="col-sm-3 col-md-3">
								<a href="#" class="twitter"><i class="fa fa-twitter"></i>Twitter</a>
						</div>
						<div class="col-sm-3 col-md-3">
								<a href="#" class="linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>
						</div>
				</div>
		</div>-->
	</div>
</section>