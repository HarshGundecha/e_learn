<?php
	// echo "<pre>";
	// print_r($UserData);
	// echo "</pre>";
	// die();
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Account Settings</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/Home');?>">Home</a></li>
			<li><a href="<?=site_url('/User');?>">Account Settings</a></li>
		</ul>
	</div>
</section>
<div class="my-accountPage">
	<div class="container">
		<div class="my-account">
			<label>
				<?php
					if(isset($flag))
					{
						if($flag==1)
							echo '<p style="color:green;">Password Changed SuccessFully</p>';
						else
							echo '<p style="color:red;">Current Password is Incorrect</p>';
					}
					if(isset($flag2))
					{
						if($flag2==1)
							echo '<p style="color:green;">Profile Updated SuccessFully</p>';
						elseif($flag2==0)
							echo '<p style="color:red;">Invalid Input</p>';
					}
				?>
			</label>
			<div class="account-tab">
				<ul>
					<li class="active"><a href="javascript:void(0);" id="profile">Profile</a></li>
					<!-- <li><a href="javascript:void(0);" id="order">Order</a></li> -->
					<li><a href="javascript:void(0);" id="updateProfile">Update Profile</a></li>
					<li><a href="javascript:void(0);" id="changePassword">Change Password</a></li>
				</ul>
			</div>
			<div class="tab-content profile-con open">
				<div class="personal-information">
					<div class="info-slide">
						<p><span>Avatar :</span><img src="<?=base_url('resources/user/uploads/'.$UserData[0]->UserAvatar);?>" style="height:100px; width:100px; " ></p>
					</div>
					<div class="info-slide">
						<p><span>Name :</span><?=$UserData[0]->UserName;?></p>
					</div>
					<div class="info-slide">
						<p>
							<span>Email ID :</span>
							
							<?php
								echo $UserData[0]->UserEmail; 
								if($UserData[0]->IsEmailVerified==0)
								{
							?>
									<i class="fa fa-check" title="Verified" data-toggle="tooltip" style="font-size:1.5em; color:green;"></i> 
							<?php
								}
								else
								{
							?>		
									<i class="fa fa-times" title="Not Verified" data-toggle="tooltip" style="font-size:1.5em; color:red;"></i>
							<?php
								}
							?>
						</p>
					</div>
					<div class="info-slide">
						<p><span>Contact Number :</span><?=$UserData[0]->UserContactNo;?></p>
					</div>
					<div class="info-slide">
						<p><span>Date Joined :</span><?=$UserData[0]->CreatedDateTime;?></p>
					</div>
					<div class="info-slide">
						<p><span>Address :</span><?=$UserData[0]->UserAddress;?></p>
					</div>
				</div>
			</div>
			<!--
				<div class="tab-content order-con">
					<table class="booking-viewTable">
						<tr>
							<th>Courses ID</th>
							<th class="detail"> Courses Details</th>
							<th>Purchase Date</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td><span class="small-heading">Courses ID</span>258452112500</td>
							<td class="detail">
								<span class="small-heading">Courses Details</span>
								<div class="detailTd">
									<label>Hiraba Farm</label>
									<p>Behind Shalby Hospital, Garden Road, Prahlad Nagar , Ahmedabad-380015</p>
								</div>
							</td>
							<td><span class="small-heading">Purchase Date</span>25<sup>th</sup> Aug 2015</td>
							<td><span class="small-heading">Amount</span>Rs. 42,710</td>
						</tr>
					</table>
				</div>
			-->
			<div class="tab-content updateProfile-con">
				<form action="<?=site_url('/user/updateprofile');?>" method="post" enctype="multipart/form-data">
					<div class="change-password ">

						<div class="input-box">
							<label for="uUserAvatar">Avatar</label></br>
							<a style="cursor: pointer;" onclick="$(this).next().trigger('click')">
								<img src="<?=base_url('resources/user/uploads/').$UserData[0]->UserAvatar?>" style="height: 100px;width: 100px;" data-toggle="tooltip" title="To Change Image, Click On It">
							</a>
							<input name="uUserAvatar" id="uUserAvatar" type="file" style="display:none" class="imgUpload">
							<script type="text/javascript">
								function readURL(input)	{
									if (input.files && input.files[0]) {
										var reader = new FileReader();
										reader.onload = function(e) {
											$(input).prev().children(":first").attr('src', e.target.result);
										}
										reader.readAsDataURL(input.files[0]);
									}
								}
								$(".imgUpload").change(function() {
									readURL(this);
								});
							</script>
						</div>

						<div class="input-box">
							<label for="uUserContactNo">Contact No.</label></br>
							<input type="text" name="uUserContactNo" id="uUserContactNo" value="<?=$UserData[0]->UserContactNo?>" placeholder="Contact No">
							<label style="color:red;">
								<?php
									echo form_error('uUserContactNo');
								?>
							</label>
						</div>

						<div class="input-box">
							<label for="AddressText">Address</label></br>
							<span id="AddressText">
								<?php
									if($UserData[0]->UserAddress!='')
									{
										echo $UserData[0]->UserAddress;
									}
									else
									{
										echo 'Use below button to get address';
									}
								?>
							</span>
						</div>

						<input type="hidden" value="" name="UserLatitude" id="UserLatitude">
						<input type="hidden" value="" name="UserLongitude" id="UserLongitude">
						<input type="hidden" value="" name="UserAddress" id="UserAddress">
						<input type="hidden" value="" name="UserPostalCode" id="UserPostalCode">
						<input type="hidden" value="" name="UserCity" id="UserCity">
						<input type="hidden" value="" name="UserState" id="UserState">
						<input type="hidden" value="" name="UserCountry" id="UserCountry">


						<div class="submit-box">
							<button type="button" class="btn btn-warning" style="width: auto;padding-left: 10px;padding-right: 10px" id="AutoFill" data-toggle="tooltip" title="Click to get your address (location access is required)">Auto Fetch Address</button>
							<input type="submit" value="Update" class="btn">
						</div>
					</div>
				</form>
			</div>
			<div class="tab-content changePassword-con">
				<form action="<?=site_url('/User/UpdatePassword');?>" method="post">
					<div class="change-password ">
						<div class="input-box">
							<input type="text" name="uCurrentPassword" placeholder="Current Password">
							<label style="color:red;">
								<?php
									echo form_error('uCurrentPassword');
								?>
							</label>
						</div>
						<div class="input-box">
							<input type="text" name="uNewPassword" placeholder="New Password">
							<label style="color:red;">
								<?php
									echo form_error('uNewPassword');
								?>
							</label>
						</div>
						<div class="input-box">
							<input type="text" name="uRePassword" placeholder="Confirm Password">
							<label style="color:red;">
								<?php
									echo form_error('uRePassword');
								?>
							</label>
						</div>
						<div class="submit-box">
							<input type="submit" value="Save" class="btn">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<section class="our-advantages">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/learn-icon.png" alt=""></div>
						<h3>Learn at your own place</h3>
						<p>Learn from anywhere be it home or work or anywhere in the world.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/save-timeIcon.png" alt=""></div>
						<h3>Save time and money</h3>
						<p>Save yout time by learning short and simple yet upto date and free courses.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/online-learningIcon.png" alt=""></div>
						<h3>100% Online learning</h3>
						<p>Learn almost everything by using our web application.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

	<?php

		$this->load->helper([
			'AIOAjax_helper',
		]);
		echo AIOAjax();
	?>

	/*$('#Country').on('change', function(){
		AIOAjax(
			"user/get_state/"+$(this).val(),
			5,
			false,
			2,
			'#State'
		);
	});
	$('#State').on('change', function(){
		AIOAjax(
			"user/get_city/"+$(this).val(),
			5,
			false,
			2,
			'#City'
		);
	});*/

		$('#AutoFill').on('click',function(){
				getLocation();
		});

		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			}
			else{
				$x.html("Geolocation is not supported by this browser.");
			}
		}
		function showPosition(position) {
			$('#UserLatitude').val(position.coords.latitude);
			$('#UserLongitude').val(position.coords.longitude);
			$.ajax({
				url:"<?=base_url('resources/services/apiCode.php');?>",
				//data:$('#formAddress input[type=hidden]').serialize(),
				data:{'lat':$("#UserLatitude").val(),'long':$("#UserLongitude").val()},
				success:function(result){
					var Jresult = JSON.parse(result);
					if(Jresult.error==false)
					{
						$('#UserAddress').val(Jresult.data.Address);
						$('#AddressText').text(Jresult.data.Address);
						$('#UserPostalCode').val(Jresult.data.PostalCode);
						$('#UserCity').val(Jresult.data.City);
						$('#UserState').val(Jresult.data.State);
						$('#UserCountry').val(Jresult.data.Country);
					}
				}
			});
		}
</script>