<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"><!-- Mobile Specific Metas -->
	<title>
		<?php if(isset($title))
		echo $title
		?>
	</title>
	<?php
	$__P=base_url('resources/user/assets/');
	?>       
	<!-- favicon icon -->
	<link rel="shortcut icon" href="<?=$__P;?>images/Favicon.ico">
	<!-- CSS Stylesheet -->
	<link href="<?=$__P;?>css/bootstrap.css" rel="stylesheet"><!-- bootstrap css -->
	<link href="<?=$__P;?>css/owl.carousel.css" rel="stylesheet"><!-- carousel Slider -->
	<link href="<?=$__P;?>css/font-awesome.css" rel="stylesheet"><!-- font awesome -->
	<link href="<?=$__P;?>css/jquery.fancybox.css" rel="stylesheet"><!-- jquery.fancybox css -->
	<link href="<?=$__P;?>css/jquery.countdown.css" rel="stylesheet">
	<link href="<?=$__P;?>css/jquery.selectbox.css" rel="stylesheet">
	<link href="<?=$__P;?>css/loader.css" rel="stylesheet"><!--  loader css -->
	<link href="<?=$__P;?>css/jquery.selectbox.css" rel="stylesheet"><!-- select box -->
	<link href="<?=$__P;?>css/datepicker.css" rel="stylesheet" /><!-- Date picker css --> 
	<link href="<?=$__P;?>css/docs.css" rel="stylesheet"><!--  template structure css -->
	<link href="<?=$__P;?>css/gallery_image_effect.css" rel="stylesheet"><!--  image rotate css -->
	<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,200,300,400,500,700,800,900%7CPT+Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<!-- <script src="<?=base_url('resources/admin/assets/')?>plugins/jQuery/jquery-3.3.1.min.js"></script> -->
	<script src="<?=base_url('resources/user/assets/')?>js/jquery-2.2.4.min.js"></script>
	<style type="text/css">
		.navbar-nav li{
			padding-bottom:0px;
		}
		#header #nav-main{
			 padding:0px;
		}
		.quck-nav{
			padding-top: 5px;
		}
		#notiscroll{
			max-height: 27em;
			overflow-y:scroll;
			overflow-x:hidden;
		}
		.navm{
			top:38px;
			right: 0px;
			left: unset;
			width: 460px;
			box-shadow: 0px 5px 7px -1px #c1c1c1;
			padding-bottom: 0px;
			padding: 0px;
		}
		.navm:after{
			content: "";
			position: absolute;
			top: -16px;
			right: 28px;
			border-left:10px solid transparent;
			border-right: 10px solid transparent;
			border-bottom: 10px solid #fff;
		}
		/*
		.heador{
			padding:5px 15px;
			border-radius: 3px 3px 0px 0px;
		}
		.footor{
			padding:5px 15px;
			border-radius: 0px 0px 3px 3px; 
		}
		*/
		.nobox{
			padding: 10px 0px; 
		}
		.row22{
			margin-right: 0px;
			margin-left: 0px;
		}
		.prop{
			border-radius: 50%;
			width: 50%;
		}
		.bg-gray{
			background-color: #eee;
		}
		@media (max-width: 640px) {
			.navm{
				top: 50px;
				left: -138px;  
				width: 290px;
			}
		}
		@media screen and (min-width: 280px) and (max-width:662px )
		{
			.navm{
				top: 50px;
				left: 10px;  
				width: 300px;
			}
			.prop{
				width: 350px;
			}
			.navm:after{
				top:-20px;
				right:18em;
			}
		}
		strong{
			font-weight: bold;color: #31708f ;font-family:'Roboto', sans-serif; font-size: 14px;
		}
		.cont{
			color: black;font-family:'Roboto', sans-serif; font-size: 14px;
		}
		small{
			color: #8a6d3b;font-family:'Roboto', sans-serif; font-size: 12px;
		}
		::-webkit-scrollbar-track
		{
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			background-color: #424949;	
		}
		::-webkit-scrollbar
		{
			width: 6px;
			background-color: #F5F5F5;
		}
		::-webkit-scrollbar-thumb
		{
			background-color: #AED6F1;
		}
		#wruper{
			background: url(<?=base_url('resources/user/assets/');?>images/flag.jpg)center top no-repeat;
			padding-top: 0px;
			width: 100%;
			background-size: 100% 14px;
			font-size: 9px;
			color: black;
			text-align: center;
		}
	</style>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<noscript>
	<meta http-equiv="refresh" content="0;url=noscript.html">
</noscript>
</head>

<body>
	<div id="wruper">
		Made In India with <i class="fa fa-heart" style="color:red;"></i>
	</div>
	<div class="wapper">
		<div class="quck-nav">
			<div class="container">
				<div class="contact-no"><a href="some_link_here"><i class="fa fa-map-marker"></i>F-23, Agersen Point, City Light, Surat</a></div>
				<div class="contact-no"><a href="Tel:919558994445"><i class="fa fa-phone"></i>+91 95589 94445</a></div>
				<div class="contact-no"><a href="mailto:your_mail_here"><i class="fa fa-envelope"></i>your_mail_here</a></div>
				<div class="quck-right">
					<!-- notification start -->
					<?php
            if($this->session->UserID)
            {
        					$CI =& get_instance();
    						$CI->load->model('Notification_m', 'Notification_m');
    						$nData=$CI->Notification_m->get_all_notification($this->session->UserID);
    						$i=0;
    						foreach ($nData as $nd) {
    							if($nd->IsRead==0)
    								$i++;
    						}                            
            }
					?>
                    <?php
                        if($this->session->UserID)
                        {
                    ?>
					<div class="right-link lan">
						<a class="nav-link text-light" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-bell"></i>  Notification <?=$i>0?'('.$i.')':'';?>
						</a>
						<ul class="dropdown-menu navm">

							<div  id="notiscroll"  style="">
								<?php
									foreach ($nData as $nd)
									{
								?>
										<li class="notification-box <?=$nd->IsRead==0?'bg-gray':'';?> nobox">
											<a href="<?=site_url('/Notification/'.$nd->NotificationID)?>" class="text-info" >
												<div class="row row22">
													<div class="col-lg-3 col-sm-3 col-3 text-center col-xs-3">
														<img src="<?=base_url('resources/user/uploads/'.$nd->UserAvatar)?>" class="w-50 rounded-circle" alt="Avatar">
													</div>    
													<div class="col-lg-9 col-sm-9 col-9 col-xs-9">
														<strong class="text-info"><?=$nd->UserName?></strong>
														<div class="cont">
															<?=$nd->NotificationContent?>
														</div>
														<small class="text-warning">
															<?php
																$dt = DateTime::createFromFormat('Y-m-d H:i:s', $nd->CreatedDateTime);
																$dd3 = $dt->getTimestamp();
																echo timespan($dd3, '', 2). ' ago';
															?>
														</small>
													</div>
												</div>
											</a>
										</li>
								<?php
									}
								?>
							</div>
						</ul>
					</div>                    
                    <?php
                        }
                    ?>
					<!-- Notification end -->
					<?php
						if($this->session->UserID)
						{
					?>
							<div class="right-link user-profileLink">
								<a href="javascript:void(0);"><i class="fa  fa-user"></i><?=$this->session->UserName?></a>
								<ul class="accout-link">
									<li><a href="<?=site_url('/User');?>">My Account</a></li>
										<li><a href="<?=site_url('/Profile/'.$this->session->UserID);?>">My Dashboard</a></li>
										<li><a href="<?=site_url('/Logout');?>">Sign Out</a></li>
								</ul>
							</div>
					<?php
						}
						else
						{
					?>
							<div class="right-link"><a href="<?=site_url('/Login');?>"><i class="fa  fa-user"></i>Login \ Register</a></div>
					<?php
						}
					?>
				</div>
			</div>
		</div>