<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>e_learn | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url('resources/admin/assets/'); ?>bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('resources/admin/assets/'); ?>dist/css/AdminLTE.min.css">
	<!-- Material Design -->
	<link rel="stylesheet" href="<?php echo base_url('resources/admin/assets/'); ?>dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="<?php echo base_url('resources/admin/assets/'); ?>dist/css/ripples.min.css">
	<link rel="stylesheet" href="<?php echo base_url('resources/admin/assets/'); ?>dist/css/MaterialAdminLTE.min.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">
<h1>
	<?php
		//echo validation_errors();
	?>
</h1>
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo base_url('resources/admin/assets/'); ?>index2.html"><b>e_learn</b></a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your journey</p>

		<form action="<?php echo site_url('/admin/login/login'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="email" name="sEmail" class="form-control" placeholder="Email" autofocus="">
				<br>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="sPassword" class="form-control" placeholder="Password">
				<br>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
<!--				<div class="col-xs-7">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember Me
						</label>
					</div>
				</div>-->
				<!-- /.col -->
				<div class="col-xs-5">
					<button type="submit" class="btn btn-primary btn-raised btn-block btn-flat">Sign In</button>      
				</div>
				<div class="col-xs-12">
					<label style="color:red;">
						<?php
							if(isset($error))
								echo $error;
						?>
					</label>
				</div>
				<!-- /.col -->
			</div>
		</form>

<!--		<div class="social-auth-links text-center">
			<p>- OR -</p>
			<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
				Facebook</a>
			<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
				Google+</a>
		</div>-->
		<!-- /.social-auth-links -->

		<!--<a href="#">I forgot my password</a><br>-->

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('resources/admin/assets/'); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('resources/admin/assets/'); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?php echo base_url('resources/admin/assets/'); ?>dist/js/material.min.js"></script>
<script src="<?php echo base_url('resources/admin/assets/'); ?>dist/js/ripples.min.js"></script>
<script>
		$.material.init();
</script>
</body>
</html>
