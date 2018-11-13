<?php
// echo "<pre>";
// print_r($PollData);
// echo "</pre>";
// die();
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt="" style="background-color:black"></div>
	<div class="page-title">	
		<div class="container">
			<h1>Users Of e_learn</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Users</a></li>
		</ul>
	</div>
</section>
<div class="forums-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="my-account">
					<div class="group-member">
						<div class="row">
							<?php
								foreach ($UserData as $ud)
								{
							?>
									<a href="<?=site_url('/Profile/'.$ud->UserID);?>">
										<div class="col-sm-6 col-md-4">
											<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
												<div class="img"><img src="<?=base_url('resources/user/uploads/'.$ud->UserAvatar);?>" alt=""></div>
												<div class="name" style="color: white;font-weight: bolder"><?=$ud->UserName?></div>
												<div class="join-details" style="color: white;font-weight: bolder"><?=$ud->UserXP?> XP</div>
											</div>
										</div>
									</a>
							<?php	
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>