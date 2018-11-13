<div class="content-wrapper">
	<!-- 
		<section class="content-header">
			<h1>
				Data Tables
				<small>advanced tables</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Tables</a>`</li>
				<li class="active">Data tables</li>
			</ol>
		</section>
	-->
	<section class="content">
		<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<!-- Box Comment -->
					<div class="box box-widget">
						<div class="box-header with-border">
							<div class="user-block">
								<img class="img-circle" src="<?=base_url('resources/admin/uploads/'.$pd->AdminImage);?>" alt="User Image">
								<span class="username"><a href="<?=site_url('/admin/admin/admindetail/'.$pd->AdminID);?>"><?=$pd->AdminName;?></a></span>
								<span class="description">
									Poll Status - 
									<?php
									//echo $pd->PollEndStatus<0;
										$color=$pd->PollEndStatus<0?'red':$pd->PollStartStatus>0?'orange':'green';
										$status=($pd->PollEndStatus<0?('Expired'):($pd->PollStartStatus>0?'Yet to start':'Active'));
									?>
									<span style="color: <?=$color?>;"><?=$status?></span><br>
								</span>
							</div>
							<!-- /.user-block -->
							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							</div>
							<!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
							<form action="<?=site_url('/admin/poll/updatepoll/'.$pd->PollID);?>" method="POST">
								<?php $pf='u';?>
								<div class="box-body">
									<h3 id="display_title"><?=$pd->PollTitle?><hr></h3>
									<p id="display_text"><?=$pd->PollContent?><hr></p>
									<?php
										if($pd->PollStartStatus>0)
										{
									?>
											<div class="form-group is-empty" style="display: none;">
												<input name="<?=$pf?>PollTitle" type="text" id="edit_title" class="form-control" value="<?=$pd->PollTitle?>">
											</div>
											<div class="form-group is-empty" style="display: none;">
												<textarea name="<?=$pf?>PollContent" id="edit_text" class="form-control"><?=$pd->PollContent?></textarea>
											</div>
											<?php
												if(validation_errors()!='')
													echo '<label style="color:red">'.validation_errors().'</label><br>';
											?>
											<?php
												if($pd->PollStatus=='Active')
												{
											?>
												<a href="<?=site_url('/admin/poll/toggleEntityStatus/'.$pd->PollID.'/'.true);?>" title="Block Record" data-toggle="tooltip" class="btn btn-success btn-xs"><i class="fa fa-toggle-on" style="font-size: 2em"></i></a>
											<?php
												}
												else
												{
											?>
												<a href="<?=site_url('/admin/poll/toggleEntityStatus/'.$pd->PollID.'/'.true);?>" title="UnBlock Record" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-toggle-off" style="font-size: 2em"></i></a>
											<?php
												}
											?>
											<button id="toggle_text" title="Edit Poll Content" data-toggle="tooltip" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil" style="font-size: 2em"></i></button>
											<button id="add_option" title="Add Option" data-toggle="tooltip" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus" style="font-size: 2em;color:#f39c12"></i></button>
											<button id="remove_option" title="Remove Option Field" data-toggle="tooltip" type="button" style="display: none;" class="btn btn-danger btn-xs"><i class="fa fa-minus" style="font-size: 2em"></i></button>
											<button id="save_changes" title="Save Changes" data-toggle="tooltip" type="submit" style="display: none;" class="btn btn-success btn-xs"><i class="fa fa-save" style="font-size: 2em"></i></button><br>
											<script type="text/javascript">
												$(function(){

													$('#toggle_text').on('click', function(){
														$('#save_changes').show();
														if($('#edit_text').parent().css('display')=='none'){
															$('#display_text').hide();
															var a=$('#display_text').text();
															$('#edit_text').val(a);
															$('#edit_text').parent().show();

															$('#display_title').hide();
															var a=$('#display_title').text();
															$('#edit_title').val(a);
															$('#edit_title').parent().show();

														}
														else{
															$('#edit_text').parent().hide();
															var a=$('#edit_text').val();
															$('#display_text').text(a);
															$('#display_text').show();

															$('#edit_title').parent().hide();
															var a=$('#edit_title').val();
															$('#display_title').html(a+'<hr>');
															$('#display_title').show();
														}
													});

													<?php $pf='a';?>
													$('#add_option').on('click',function(e){
														e.preventDefault();
														$('#save_changes').show();
														if($("input[name='<?=$pf?>PollXOptionContent[]']").length==1 && $("input[name='<?=$pf?>PollXOptionContent[]']").parent().parent().css("display")=="none")
														{
															$(".clone_me").last().show();
															$("#remove_option").show();
														}
														else
														{
															$(".clone_me").first().clone().appendTo(".clone_here");
															$(".clone_me").last().find('input').val('');
															$("#remove_option").show();
														}
													});

													$('#remove_option').on('click',function(e){
														e.preventDefault();
														if($("input[name='<?=$pf?>PollXOptionContent[]']").length==1)
														{
															$(".clone_me").last().hide();
															$("#remove_option").hide();
														}
														if($("input[name='<?=$pf?>PollXOptionContent[]']").length>1)
															$(".clone_me").last().remove();
														if($("input[name='<?=$pf?>PollXOptionContent[]']").length==0)
															$("#remove_option").hide();
													});

												});
											</script>
									<?php
										}
										else
										{
									?>
											<span class="pull-left text-muted">Total Votes - <?=$pd->TotalVote?></span><br>
									<?php
										}
									?>
									<span class="pull-left text-muted">Starting on - <span style="color: green"><?=$pd->PollStartDate;?></span>
									</span>
									<span class="pull-right text-muted">Ending on - <span style="color: red"><?=$pd->PollEndDate;?></span>
									</span>

								</div>
								<!-- /.box-body -->
								<div class="box-footer box-comments">
									<?php
										$i=1;
										$progress_color = array(
											'0' => 'info',
											'1' => 'success',
											'2' => 'danger',
											'3' => 'primary',
											'4' => 'warning', );
										$j=1; // used for changing color of progress bars
										foreach ($pd->OptionData as $pdo)
										{
									?>
											<div class="box-comment">
												<span class="img-circle img-sm text-center" style="font-size: 25px"><?=$i?></span>
												<div class="comment-text">
													<div class="col-md-12">
														<?php
															echo $pdo->PollXOptionContent;
															if($pd->PollStartStatus>0)
															{
														?>
																<a href="<?=site_url('/admin/poll/deleteoption/'.$pdo->PollXOptionID.'/'.$pd->PollID);?>" title="Delete Option" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="font-size: 2em;"></i></a>
														<?php
															}
														?>
													</div>
													<?php
														if($pd->PollStartStatus<0)
														{
															if($pd->TotalVote!=0)
															{
																$pc=$pdo->OptionCount*100/$pd->TotalVote;								
																$pc=round($pc);
															}
															else
																$pc=0;
													?>
															<div class="col-md-12">
																<div class="progress progress-xl active" style="height: 2em;">
																	<div class="progress-bar progress-bar-<?php echo $progress_color[$j];?> progress-bar-striped" role="progressbar" aria-valuenow="<?=$pc?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pc?>%">
																		<span class="sr-only"><?=$pc?>% Complete</span>
																		<label class="text-center" style="font-size:1.5em;margin-top:0.15em;color: white;font-weight: bold;">
																			<?=$pc?>%
																		</label>
																	</div>
																</div>
															</div>
													<?php
														}
													?>
												</div>
												<!-- /.comment-text -->
											</div>
									<?php
										$i++;
										if($j==4)
											$j=0;
										else
											$j++;
										}
									?>
									<div class="col-md-12">
										<div id="clone_here" class="row clone_here">
											<div id="clone_me" class="col-md-12 clone_me" style="display: none">
												<div class="form-group is-empty">
													<input type="text" name="<?=$pf?>PollXOptionContent[]" class="form-control input-sm" placeholder="Option text here" autofocus>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
					</div>
					<!-- /.box -->
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