<?php
// echo "<pre>";
// print_r($PollData);
// echo "</pre>";
// die();
$this->load->helper('date');
if($UserData[0]->UserStatus==1 || $UserData==NULL)
	redirect('Error_404');
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt="" style="background-color:black"></div>
	<div class="page-title">	
		<div class="container">
			<h2 style="color:white;"><?=$UserData[0]->UserName;?>'s </h2><h1>Profile</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Profile</a></li>
		</ul>
	</div>
</section>
<?php
$rand=rand(10,50);
?>
<div class="forums-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<!-- <div class="group-details">
					<div class="cover-img"><img src="<?=base_url('resources/user/assets/');?>images/background/<?=$rand;?>.jpg" alt="" style="width:945px;height:225px;"><h1 style="background-color:black;width:inherit;"><font style="margin-left:180px;"><?=$UserData[0]->UserName;?></font></h1></div>
					<div class="group-info">
						<div class="group-prifile" style="border:none;"><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt="" style="height:122px;width:122px;"></div> 
						<div class="group-status">
							<div class="group-type"><i class="fa fa-star"></i> <?=$UserData[0]->UserXP;?> XP</div>
							<span style="padding-left:15px;"><?=$UserData[0]->UserContactNo;?></span>
							<?php
								if($UserData[0]->UserID!=$this->session->UserID)
								{
							?>
									<div class="group-type" style="margin-left:25px;cursor: pointer;">
										<span id="btnfollow" style="color: white">
										<?php
											if($UserData[0]->Follow==='Follow')
												echo '<i class="fa fa-check" style="font-size:1.2em;color:white;margin-right:5px;"></i>Followed';
											elseif($UserData[0]->Follow==='Not Follow')
												echo 'Follow';
										?>
										</span> <i id="spinner" style="display: none" class="fa fa-refresh fa-spin"></i>
									</div>
							<?php
								}
							?>
							<span style="float:right;padding-right:5px;" title="<?=$UserData[0]->CreatedDateTime;?>" data-toggle="tooltip">Joined : 
								<?php
									$dt = DateTime::createFromFormat('Y-m-d H:i:s', $UserData[0]->CreatedDateTime);
									$dd3 = $dt->getTimestamp();
									echo timespan($dd3, '', 2). ' ago';
								?>
							</span>
							<p>
								</span>
								<h3><i class="fa fa-envelope"></i> <?=$UserData[0]->UserEmail;?></h3>
								<h4>
									<?php
											if(trim($UserData[0]->UserAddress)!='')
											{
									?>
												<i class="fa fa fa-map-marker"> </i> &nbsp;<?=$UserData[0]->UserAddress;?>
									<?php
											}
									?>
								</h4>
							</p>
						</div>
					</div>
				</div> -->
			<div class="group-details">
				<div class="cover-img">
					<img src="<?=base_url('resources/user/assets/');?>images/background/<?=$rand;?>.jpg" style="height:250px;" alt="">
				</div>
				<div class="group-info">
					<div class="group-prifile" style="border: none;"><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt="" style="height:122px;width:122px;"></div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-sm-8">
								<span style="font-size: 2em;font-family: 'poetsenoneregular'"><?=$UserData[0]->UserName;?></span>
							</div>
							<div class="col-sm-4">
								<span class="btn btn-primary btn-lg"> <?=$UserData[0]->UserXP;?> XP</span>
								<?php
    								if($UserData[0]->UserID!=$this->session->UserID)
    								{
							    ?>
        							    <span id="btnfollow" class="btn btn-primary btn-lg">
        									<?php
        										if($UserData[0]->Follow==='Follow')
        											echo '<i class="fa fa-check" style="font-size:1.2em;color:white;margin-right:5px;"></i>Followed';
        										elseif($UserData[0]->Follow==='Not Follow')
        											echo 'Follow';
        									?>
        								</span>
								        <i id="spinner" style="display: none" class="fa fa-refresh fa-spin"></i>
					        	<?php
    								}
    							?>
							</div>
						</div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-sm-8">
								<a href="your_mail_here" style="font-size: 1.6em;"><i class="fa fa-envelope"></i> <?=$UserData[0]->UserEmail;?></a>
							</div>
							<div class="col-sm-4">
							<?php
								if(trim($UserData[0]->UserContactNo)!='')
								{
							?>
									<a href="tel:7567934387" style="font-size: 1.6em;"><i class="fa fa-phone"></i> <?=$UserData[0]->UserContactNo;?></a>
							<?php
								}
							?>
							</div>
						</div>
						<?php
							if(trim($UserData[0]->UserAddress)!='')
							{
						?>
								<a href="http://maps.google.com?q=<?=$UserData[0]->UserLatitude?>,<?=$UserData[0]->UserLongitude?>">
								    <p style="margin-top: 15px;font-size: 1.3em;"><i class="fa fa-map-marker"></i> <?=$UserData[0]->UserAddress;?></p>
								</a>
						<?php
							}
						?>
						<p title="<?=$UserData[0]->CreatedDateTime;?>" data-toggle="tooltip">Joined 
							<?php
								$dt = DateTime::createFromFormat('Y-m-d H:i:s', $UserData[0]->CreatedDateTime);
								$dd3 = $dt->getTimestamp();
								echo timespan($dd3, '', 2). ' ago';
							?>
						</p>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(function(){
					$('#btnfollow').on('click', function(){
						$.ajax({
							url:"<?=site_url('/Profile/togglefollow/'.$UserData[0]->UserID)?>",
							beforeSend:function(jqXHR, settings){
								$('#spinner').show();
							},
							complete:function(xhr,status){
								$('#spinner').hide();
							},
							success:function(result){
								$('#btnfollow').html(result);
							}
						});
					});
					//alert("hello");
				});
			</script>
			<div class="col-sm-12">
				<div class="my-account">
					<div class="account-tab">
						<ul>
							<!-- <li><a href="javascript:void(0);" id="profile">Profile</a></li> -->
							<li class="active"><a href="javascript:void(0);" id="Followers">Followers</a></li>
							<li><a href="javascript:void(0);" id="Following">Following</a></li>
							<li><a href="javascript:void(0);" id="Poll">Poll</a></li>
							<li><a href="javascript:void(0);" id="QuestionAsked">Question Asked</a></li>
							<li><a href="javascript:void(0);" id="AnswerGiven">Answer Given</a></li>
						</ul>
					</div>
					<div class="tab-content Followers-con open">
						<div class="group-member">
							<div class="row">
								<?php
									foreach ($FollowersData as $fd)
									{
								?>
										<a href="<?=site_url('/Profile/'.$fd->UserID);?>">
											<div class="col-sm-6 col-md-4">
												<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
													<div class="img"><img src="<?=base_url('resources/user/uploads/'.$fd->UserAvatar);?>" alt=""></div>
													<div class="name" style="color: white;font-weight: bolder"><?=$fd->UserName?></div>
													<div class="join-details" style="color: white;font-weight: bolder"><?=$fd->UserXP?> XP</div>
												</div>
											</div>
										</a>
								<?php
									}
								?>
							</div>
						</div>
					</div>
					<div class="tab-content Following-con">
						<div class="group-member">
							<div class="row">
								<?php
									foreach ($FollowingData as $fd)
									{
								?>
										<a href="<?=site_url('/Profile/'.$fd->UserID);?>">
											<div class="col-sm-6 col-md-4">
												<div class="member-box" style="background:linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?=base_url('/resources/user/assets/images/background/'.rand(1,50).'.jpg')?>);overflow-x:hidden;">
													<div class="img"><img src="<?=base_url('resources/user/uploads/'.$fd->UserAvatar);?>" alt=""></div>
													<div class="name" style="color: white;font-weight: bolder"><?=$fd->UserName?></div>
													<div class="join-details" style="color: white;font-weight: bolder"><?=$fd->UserXP?> XP</div>
												</div>
											</div>
										</a>
								<?php
									}
								?>
							</div>
						</div>
					</div>
					<div class="tab-content Poll-con">
						<div class="forum-details">
							<?php
								$flag=0;
								foreach ($PollData as $pd)
								{
							?>
									<div class="details-slide
									<?php
										if($flag==0)
											echo " even ";
									?>
									">
										<div class="name"><a href="<?=site_url('/Profile/Poll/'.$pd->PollID.'/'.$pd->PollXOptionID);?>"><?=$pd->PollTitle?></a></div>
										<div class="info">
											<div class="block"><i class="fa fa-user"></i><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt=""><?=$UserData[0]->UserName;?></div>
											<!-- <div class="block"><i class="fa fa-comment-o"></i>11</div> -->
											<div class="block"><i class="fa fa-clock-o"></i>
												<?php
													$dt = DateTime::createFromFormat('Y-m-d H:i:s', $pd->CreatedDateTime);
													$dd3 = $dt->getTimestamp();
													echo timespan($dd3, '', 2). ' ago';
												?>
											</div>
										</div>
									</div>
							<?php
									$flag=1-$flag;
								}
							?>
						</div>
					</div>
					<div class="tab-content QuestionAsked-con">
						<div class="forum-details">
							<?php
								$flag=0;
								foreach ($QuestionAskedData as $qad)
								{
							?>
									<div class="details-slide
									<?php
										if($flag==0)
											echo " even ";
									?>
									">
										<div class="name">
											<a href="<?=site_url('/ForumQuestion/'.$qad->ForumQID);?>"><?=$qad->ForumQTitle?></a>
										</div>
										<div class="info">
											<div class="block"><i class="fa fa-user"></i><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt=""><?=$UserData[0]->UserName;?></div>
											<!-- <div class="block"><i class="fa fa-comment-o"></i>11</div> -->
											<div class="block"><i class="fa fa-clock-o"></i>
												<?php
													$dt = DateTime::createFromFormat('Y-m-d H:i:s', $qad->CreatedDateTime);
													$dd3 = $dt->getTimestamp();
													echo timespan($dd3, '', 2). ' ago';
												?>
											</div>
										</div>
									</div>
							<?php
									$flag=1-$flag;
								}
							?>
						</div>
					</div>
					<div class="tab-content AnswerGiven-con">
						<div class="forum-details">
							<?php
								// $mysql_datetime='2009-01-27 09:38:33';
								$flag=0;
								foreach ($AnswerGivenData as $agd)
								{
							?>
									<div class="details-slide
									<?php
										if($flag==0)
											echo " even ";
									?>
									">
										<div class="name"><a href="<?=site_url('/ForumQuestion/'.$agd->ForumQID.'#answer-'.$agd->ForumAID);?>"><?=$agd->ForumAContent?></a></div>
										<div class="info">
											<div class="block"><i class="fa fa-user"></i><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" alt=""><?=$UserData[0]->UserName;?></div>
											<!-- <div class="block"><i class="fa fa-comment-o"></i>11</div> -->
											<div class="block"><i class="fa fa-clock-o"></i>
												<?php
													$dt = DateTime::createFromFormat('Y-m-d H:i:s', $agd->CreatedDateTime);
													$dd3 = $dt->getTimestamp();
													echo timespan($dd3, '', 2). ' ago';
												?>
											</div>
										</div>
									</div>
							<?php
									$flag=1-$flag;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>