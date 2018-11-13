<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<?php
				if($this->session->AdminID==$aud[0]->AdminID)
				{}
				else
					redirect('admin/admin/admindetail/'.$this->session->AdminID);
			?>
			<form method="POST" id="formUpdateadmin" action="<?=site_url('admin/admin/updateentityData/'.$this->session->AdminID);?>" >
				<div class="col-md-10 col-md-offset-1">
					<div class="box box-widget widget-user">
						<div class="widget-user-header bg-white" style="background: url('<?=base_url("/resources/common/1.png");?>') center center;background-size: 100% 500%;background-repeat: no-repeat;color:white;">
							<h3 class="widget-user-username"><b><?=$aud[0]->AdminName?></b></h3>
							<h5 class="widget-user-desc"><?=$aud[0]->AdminEmail?></h5>
						</div>
						<div class="widget-user-image">
							<img class="img-circle" src="<?=base_url('/resources/admin/uploads/'.$aud[0]->AdminImage)?>" alt="User image">
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-sm-4 border-right">
									<div class="description-block">
										<h5 class="description-header"><?=$aud[0]->AdminContactNo?></h5>
										<span class="description-text">Contact No.</span>
									</div>
								</div>
								<div class="col-sm-4 border-right">
									<div class="description-block">
									<button type="submit" class="btn btn-success" name="btnUpdateAdmin" id="btnUpdateAdmin"
									value="Update Admin">
										Update Details
									</button>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="description-block">
										<h5 class="description-header"><?=$aud[0]->CreatedDateTime?></h5>
										<span class="description-text">Date Joined</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-md-offset-3" style="padding:20px;">	
					<div class="box box-primary">
						<div class="box-body box-profile" style="padding:50px;">
							<div class="alert alert-danger alert-dismissible" style="display: none">
								<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
									×
								</button>
								<h4><i class="icon fa fa-ban"></i>Errors In Form :(</h4>
								<div id="formUpdateAlert">
								
								</div>
							</div>
							<?php $pf="u"; ?>
							<img class="profile-user-img img-responsive img-circle" src="<?=base_url('/resources/admin/uploads/'.$aud[0]->AdminImage)?>" alt="User profile picture">
							<div class="row">
								<div class="col-md-5 text-center"><br><br>
									<div class="row">
										<div class="col-md-12">
											<label for="<?=$pf?>AdminName?>"><b>Name</b></label>
										</div>
										<div class="col-md-12"><br><br>
											<label for="<?=$pf?>AdminContactNo"><b>Contact No</b></label>
										</div>
										<div class="col-md-12"><br><br><br>
											<label for="<?=$pf?>AdminPassword"><b>Password</b></label>
										</div>
										<div class="col-md-12"><br><br>
											<label for="<?=$pf?>AdminImage">Image</label>
										</div>
									</div>
								</div>
								<div class="col-md-5 text-center"> 
									<div class="row">
										<div class="col-md-12">
											<input type="text" name="<?=$pf?>AdminName" id="<?=$pf?>AdminName" class="form-control" placeholder="e.g., John" value="<?=$aud[0]->AdminName?>">
										</div>
										<div class="col-md-12">
											<input type="number" name="<?=$pf?>AdminContactNo" id="<?=$pf?>AdminContactNo" class="form-control" placeholder="e.g., 9875xxxxxx" value="<?=$aud[0]->AdminContactNo?>">
										</div>
										<div class="col-md-12">
											<input type="Password" name="<?=$pf?>AdminPassword" id="<?=$pf?>AdminPassword" class="form-control" placeholder="e.g., John@some_123" value="<?=$aud[0]->AdminPassword?>">
										</div>
										<div class="col-md-12">
											<a href="#" style="cursor: pointer;" onclick="$(this).next().trigger('click')">
												<img src="<?=base_url('resources/admin/uploads/').$aud[0]->AdminImage?>" style="height: 180px;width: 180px;" data-toggle="tooltip" title="To Change Image, Click On It">
											</a>
											<input name="<?=$pf?>AdminImage" id="<?=$pf?>AdminImage" type="file" style="display: none" class="imgUpload">
										</div>
									</div>
								</div>
							</div>
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
							<!-- <input name="btnUpdateadmin" id="btnUpdateadmin" type="button" class="btn btn-success" value="Update Admin"> -->
							<button type="Reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</div>
			</form>
			<!--<div class="col-md-9-offset-2">
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block text-center">
							<span class="username" style="margin-left:0px;">
								<h3>
									Update Profile Form
								</h3>
							</span>
						</div>
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-footer box-comments">
							<div class="box-comment">
								<img class="img-circle img-sm" src="<?=base_url('/resources/admin/uploads/'.$aud[0]->AdminImage)?>" alt="User Image">
								<div class="comment-text">
									<span class="username">
										
									</span>
								</div>
							</div> 
					</div>
				</div>
			</div>-->
			<!--<div class="col-md-6">
				<div class="box box-widget">
					<div class="box-header with-border">
						<div class="user-block text-center">
							<span class="username" style="margin-left:0px;">
								<h3>
									Answers By <a href="<?=site_url('/admin/user/userdetail/'.$ud['user_data'][0]->UserID);?>"><?=$ud['user_data'][0]->UserName?></a>
								</h3>
							</span>
						</div>
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-footer box-comments">
						<?php
							foreach ($ud['answer_data'] as $ad) {
						?>
							<div class="box-comment">
								<img class="img-circle img-sm" src="<?=base_url('/resources/user/uploads/'.$ud['user_data'][0]->UserAvatar)?>" alt="User Image">
								<div class="comment-text">
									<span class="username">
										<a href="<?=site_url('/admin/forumquestion/questiondetail/'.$ad->ForumQID);?>">View Answer</a>
										<span class="text-muted pull-right"><?=$ad->CreatedDateTime?></span>
									</span>
									<?=$ad->ForumAContent?>
									<br>
									<div class="pull-left">
										<?=$ad->TotalLike!=''?$ad->TotalLike:0?>
										<i class="fa fa-thumbs-up"></i>
										<?=$ad->TotalDisLike!=''?$ad->TotalDisLike:0?>
										<i class="fa fa-thumbs-down"></i>
									</div>
								</div>
							</div>
						<?php
							}
						?> 
					</div>
				</div>
			</div>-->
		</div>
	</section>
</div>
<script type="text/javascript">
	<?php

	$this->load->helper([
		'AIOAjax_helper',
		'addUpdateEntityAjaxCode_helper'
	]);

	echo AIOAjax();
//.$DataTableCode
//.addEntityAjaxCode($Entity,true)
//.updateEntityAjaxCode($Entity,true);

	?>
</script>