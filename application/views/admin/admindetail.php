<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-widget widget-user">
					<div class="widget-user-header bg-white" style="background: url('<?=base_url("/resources/common/1.png");?>') center center;background-size: 100% 500%;background-repeat: no-repeat;color:white;">
						<h3 class="widget-user-username"><b><?=$ad['admin_data'][0]->AdminName?></b></h3>
						<h5 class="widget-user-desc"><?=$ad['admin_data'][0]->AdminEmail?></h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" src="<?=base_url('/resources/admin/uploads/'.$ad['admin_data'][0]->AdminImage)?>" alt="User Image">
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header"><?=$ad['admin_data'][0]->AdminContactNo?></h5>
									<span class="description-text">Contact No.</span>
								</div>
							</div>
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header" style="padding-top:12px;font-size:1.5em;">
										<?php 
										if($ad['admin_data'][0]->AdminLevel==0)
											echo "Super Admin";
										else if($ad['admin_data'][0]->AdminLevel==1)
											echo "Sub Admin";
										?>	
									</h5>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="description-block">
									<h5 class="description-header"><?=substr($ad['admin_data'][0]->CreatedDateTime,0,10)?></h5>
									<span class="description-text">Date Joined</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="nav-tabs-custom ">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity<div class="ripple-container"></div></a></li>
						<?php
							if($this->session->AdminID==$ad['admin_data'][0]->AdminID)
							{
						?>
								<li class=""><a href="#profile_update" data-toggle="tab" aria-expanded="false">Update Profile<div class="ripple-container"></div></a></li>
						<?php	
							}
						?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="activity">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<?php
										if($ad['admin_data'][0]->AdminLevel==0)
										{
											?>
											<div class="col-md-12">
												<div class="box box-widget">
													<div class="box-header with-border">
														<div class="user-block text-center">
															<span class="username" style="margin-left:0px;">
																<h3>
																	Sub-Admins Added By <a href="<?=site_url('/admin/Admin/'.$ad['admin_data'][0]->AdminID);?>"><?=$ad['admin_data'][0]->AdminName?></a>
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
														foreach ($ad['added_admin_data'] as $aad) {
															?>
															<div class="box-comment">
																<img class="img-circle img-sm" src="<?=base_url('/resources/admin/uploads/'.$aad->AdminImage)?>" alt="User Image">
																<div class="comment-text">
																	<span class="username">
																		<a href="<?=site_url('/admin/Admin/'.$aad->AdminID);?>"><?=$aad->AdminName?></a>
																		<span class="text-muted pull-right" title="<?=$aad->CreatedDateTime?>" data-toggle="tooltip">
																			<?php
																				$dt = DateTime::createFromFormat('Y-m-d H:i:s', $aad->CreatedDateTime);
																				$dd3 = $dt->getTimestamp();
																				echo timespan($dd3, '', 2). ' ago';
																			?>
																		</span>
																	</span>
																</div>
															</div>
															<?php
														}
														?> 
													</div>
												</div>
											</div>
											<?php
										}
										?>
										<div class="col-md-12">
											<div class="box box-widget">
												<div class="box-header with-border">
													<div class="user-block text-center">
														<span class="username" style="margin-left:0px;">
															<h3>
																Courses Added By <a href="<?=site_url('/admin/Admin/'.$ad['admin_data'][0]->AdminID);?>"><?=$ad['admin_data'][0]->AdminName?></a>
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
													foreach ($ad['added_course_data'] as $acd) {
														?>
														<div class="box-comment">
															<img class="img-circle img-sm" src="<?=base_url('/resources/admin/uploads/'.$acd->CourseImage)?>" alt="User Image">
															<div class="comment-text">
																<span class="username">
																	<a href="<?=site_url('admin/course/');?>"><?=$acd->CourseName?></a>
																	<span class="text-muted pull-right" title="<?=$acd->CreatedDateTime?>" data-toggle="tooltip">
																		<?php
																			$dt = DateTime::createFromFormat('Y-m-d H:i:s', $acd->CreatedDateTime);
																			$dd3 = $dt->getTimestamp();
																			echo timespan($dd3, '', 2). ' ago';
																		?>
																	</span>
																</span>
																<?=$acd->CourseDescription?>
																<br>
															</div>
														</div>
														<?php
													}
													?> 
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="box box-widget">
												<div class="box-header with-border">
													<div class="user-block text-center">
														<span class="username" style="margin-left:0px;">
															<h3>
																Articles Added By <a href="<?=site_url('/admin/Admin/'.$ad['admin_data'][0]->AdminID);?>"><?=$ad['admin_data'][0]->AdminName?></a>
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
													foreach ($ad['added_article_data'] as $ard) {
														?>
														<div class="box-comment">
															<img class="img-circle img-sm" src="<?=base_url('/resources/admin/uploads/'.$ard->ArticleImage)?>" alt="User Image">
															<div class="comment-text">
																<span class="username">
																	<a href="<?=site_url('admin/course/');?>"><?=$ard->ArticleTitle?></a>
																	<span class="text-muted pull-right" title="<?=$ard->CreatedDateTime?>" data-toggle="tooltip">
																		<?php
																			$dt = DateTime::createFromFormat('Y-m-d H:i:s', $ard->CreatedDateTime);
																			$dd3 = $dt->getTimestamp();
																			echo timespan($dd3, '', 2). ' ago';
																		?>
																	</span>
																</span>
															</div>
														</div>
														<?php
													}
													?> 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<div class="box box-widget">
												<div class="box-header with-border">
													<div class="user-block text-center">
														<span class="username" style="margin-left:0px;">
															<h3>
																Chapters Added By <a href="<?=site_url('/admin/Admin/'.$ad['admin_data'][0]->AdminID);?>"><?=$ad['admin_data'][0]->AdminName?></a>
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
													foreach ($ad['added_chapter_data'] as $achd) {
														?>
														<div class="box-comment">
															<i class="fa fa-files-o img-circle img-sm" style="font-size:20px;"></i>
															<div class="comment-text">
																<span class="username">
																	<a href="<?=site_url('/admin/chapter/'.$achd->CourseID);?>"><?=$achd->ChapterName?></a>
																	<span class="text-muted pull-right" title="<?=$achd->CreatedDateTime?>" data-toggle="tooltip">
																		<?php
																			$dt = DateTime::createFromFormat('Y-m-d H:i:s', $achd->CreatedDateTime);
																			$dd3 = $dt->getTimestamp();
																			echo timespan($dd3, '', 2). ' ago';
																		?>
																	</span>
																</span>
															</div>
														</div>
														<?php
													}
													?> 
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="box box-widget">
												<div class="box-header with-border">
													<div class="user-block text-center">
														<span class="username" style="margin-left:0px;">
															<h3>
																Sections Added By <a href="<?=site_url('/admin/Admin/'.$ad['admin_data'][0]->AdminID);?>"><?=$ad['admin_data'][0]->AdminName?></a>
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
													foreach ($ad['added_section_data'] as $asd) {
														?>
														<div class="box-comment">
															<img class="img-circle img-sm" src="<?=base_url('/resources/admin/uploads/default.jpg')?>" alt="User Image">
															<div class="comment-text">
																<span class="username">
																	<a href="<?=site_url('admin/section/'.$asd->ChapterID);?>"><?=$asd->SectionName?></a>
																	<span class="text-muted pull-right" title="<?=$achd->CreatedDateTime?>" data-toggle="tooltip">
																		<?php
																			$dt = DateTime::createFromFormat('Y-m-d H:i:s', $asd->CreatedDateTime);
																			$dd3 = $dt->getTimestamp();
																			echo timespan($dd3, '', 2). ' ago';
																		?>
																	</span>
																</span>
															</div>
														</div>
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
						<!-- /.tab-pane -->
						<!-- 
						    <div class="tab-pane" id="timeline">
    							<ul class="timeline timeline-inverse">
    								<li class="time-label">
    									<span class="bg-red">
    										10 Feb. 2014
    									</span>
    								</li>
    								<li>
    									<i class="fa fa-envelope bg-blue"></i>
    
    									<div class="timeline-item">
    										<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
    
    										<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
    
    										<div class="timeline-body">
    											Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
    											weebly ning heekya handango imeem plugg dopplr jibjab, movity
    											jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
    											quora plaxo ideeli hulu weebly balihoo...
    										</div>
    										<div class="timeline-footer">
    											<a class="btn btn-primary btn-xs">Read more</a>
    											<a class="btn btn-danger btn-xs">Delete</a>
    										</div>
    									</div>
    								</li>
    								<li>
    									<i class="fa fa-user bg-aqua"></i>
    
    									<div class="timeline-item">
    										<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
    
    										<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
    										</h3>
    									</div>
    								</li>
    								<li>
    									<i class="fa fa-comments bg-yellow"></i>
    
    									<div class="timeline-item">
    										<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
    
    										<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
    
    										<div class="timeline-body">
    											Take me to your leader!
    											Switzerland is small and neutral!
    											We are more like Germany, ambitious and misunderstood!
    										</div>
    										<div class="timeline-footer">
    											<a class="btn btn-warning btn-flat btn-xs">View comment</a>
    										</div>
    									</div>
    								</li>
    								<li class="time-label">
    									<span class="bg-green">
    										3 Jan. 2014
    									</span>
    								</li>
    								<li>
    									<i class="fa fa-camera bg-purple"></i>
    
    									<div class="timeline-item">
    										<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
    
    										<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
    
    										<div class="timeline-body">
    											<img src="http://placehold.it/150x100" alt="..." class="margin">
    											<img src="http://placehold.it/150x100" alt="..." class="margin">
    											<img src="http://placehold.it/150x100" alt="..." class="margin">
    											<img src="http://placehold.it/150x100" alt="..." class="margin">
    										</div>
    									</div>
    								</li>
    								<li>
    									<i class="fa fa-clock-o bg-gray"></i>
    								</li>
    							</ul>
    						</div>
    					-->
						<!-- /.tab-pane -->
						<?php
							if($this->session->AdminID==$ad['admin_data'][0]->AdminID)
							{
						?>
								<div class="tab-pane" id="profile_update">
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<div class="alert alert-danger alert-dismissible" style="display: none">
												<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
													×
												</button>
												<h4><i class="icon fa fa-ban"></i>Errors In Form :(</h4>
												<div id="formUpdateAlert">
												
												</div>
											</div>
											<form class="form-horizontal"  method="POST" id="formUpdateadmin" action="<?=site_url('admin/Admin/updateAdminData/'.$this->session->AdminID);?>" enctype="multipart/form-data">
												<?php $pf="u"; ?>
												<div class="form-group is-empty">
													<label for="<?=$pf?>AdminName" class="col-sm-2 control-label">Name</label>
													<div class="col-sm-10">
														<input type="text" name="<?=$pf?>AdminName" class="form-control" id="<?=$pf?>AdminName" placeholder="e.g., John" value="<?=$ad['admin_data'][0]->AdminName?>">
													</div>
												</div>
												<div class="form-group is-empty">
													<label for="<?=$pf?>AdminContactNo" class="col-sm-2 control-label">Contact No</label>
													<div class="col-sm-10">
														<input type="number" name="<?=$pf?>AdminContactNo" class="form-control" id="<?=$pf?>AdminContactNo" placeholder="e.g., 9875xxxxxx" value="<?=$ad['admin_data'][0]->AdminContactNo?>">
													</div>
												</div>
												<div class="form-group is-empty">
													<label for="<?=$pf?>AdminPassword" class="col-sm-2 control-label">Password</label>
													<div class="col-sm-10">
														<input type="password" name="<?=$pf?>AdminPassword" class="form-control" id="<?=$pf?>AdminPassword" placeholder="e.g., John@some_123" value="<?=$ad['admin_data'][0]->AdminPassword?>">
													</div>
												</div>
												<div class="form-group is-empty">
													<label for="<?=$pf?>AdminImage" class="col-sm-2 control-label">Image</label>
													<div class="col-sm-10">
														<a href="#" style="cursor: pointer;" onclick="$(this).next().trigger('click')">
															<img src="<?=base_url('resources/admin/uploads/'.$ad['admin_data'][0]->AdminImage);?>" style="height: 180px;width: 180px;" data-toggle="tooltip" title="To Change Image, Click On It">
														</a>
														<input name="<?=$pf?>AdminImage" id="<?=$pf?>AdminImage" type="file" style="display: none" class="imgUpload">
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
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-success pull-right" name="btnUpdateAdmin" id="btnUpdateAdmin" value="Update Admin">Update Details</button>
												</div>
											</form>
										</div>
									</div>
								</div>
						<?php	
							}
						?>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
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