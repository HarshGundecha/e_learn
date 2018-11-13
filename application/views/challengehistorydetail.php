<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Challenge History</h1>
		</div>
	</div>
</section>
<section class="breadcrumb white-bg">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/Challenge/');?>">Challenges</a></li>
			<li><a href="#">Challenge History</a></li>
		</ul>
	</div>
</section>
<section class="quiz-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<!-- <div id="countdown"></div> -->
				<div class="qustion-list">
					<?php
						$i=1;
						foreach ($ReceiverData as $q)
						{
					?>
							<div class="qustion-slide<?=$i==1?' active':'';?>">
								<div class="qustion-number">Question <?=$i?></div>
								<span><?=$q->QuestionPoint?></span>
							</div>
					<?php
						$i++;
						}
					?>
				</div>
			</div>
			<div class="col-sm-8 col-md-9">
				<div class="qustion-main">
					<div class="qustion-box">
						<div class="qustion" style="border-bottom:none;">

							<div class="group-tab-view" style="padding-top: 0px;">
								<div class="tab-menu" style="display: none;">
									<ul>
										<?php
											$i=1;
											foreach ($ReceiverData as $qd)
											{
										?>
												<li <?=$i==1?'class="active"':'';?> >
													<a href="#question-<?=$qd->QuestionID?>" data-toggle="tab" <?=$i==1?' aria-expanded="true"':'';?> >
													Activity
												</a>
											</li>												
										<?php
											$i++;
											}
										?>
									</ul>
								</div>
								<div class="tab-content">

									<?php
										$i=1;
										foreach ($ReceiverData as $q)
										{
									?>
											<div class="tab-pane <?=$i==1?' active':'';?>" id="question-<?=$q->QuestionID?>">
												<p style="border-bottom: solid 2px #e0e0e0;padding-bottom:10px;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;">
													<?=$q->QuestionContent?>
												</p>
												<div class="ans">
													<?php
														foreach ($q->OptionData as $o)
														{
													?>
															<div class="ans-slide">
																<div class="row">
																	<div class="col-sm-1">
																		<?php
																			// echo $q->QuestionXOptionID;
																			// echo $o->QuestionXOptionID;
																			// echo $o->IsAnswer;
																			if($q->QuestionXOptionID==$o->QuestionXOptionID && $o->IsAnswer==1)
																				echo ' <i class="fa fa-check" title="Your Answer Is Correct" data-toggle="tooltip" style="font-size:1.5em; color:green;float:right;margin-top:0px;padding:0px;"></i> ';
																			if($q->QuestionXOptionID==$o->QuestionXOptionID && $o->IsAnswer==0)
																				echo ' <i class="fa fa-times" title="Your Answer Is Wrong" data-toggle="tooltip" style="font-size:1.5em; color:Red;float:right;margin-top:0px;padding:0px;"></i> ';
																		?>
																	</div>
																	<div class="col-sm-11">
																		<?=$o->QuestionXOptionContent?>
																	</div>
																</div>
															</div>
													<?php
														}
													?>
												</div>
											</div>
									<?php
											$i++;
										}
									?>
								</div>
							</div>
						</div>
						<div class="save-btn">
			        <button type="button" id="prevTab" class="btn2" style="margin-right: 20px;">Prev</button>
			        <button type="button" id="nextTab" class="btn2">Next</button>
						</div>
						<script type="text/javascript">
							$(function(){

								$('#prevTab').click(function(){
									$('.tab-menu > ul > .active').prev('li').find('a').trigger('click');
									if($('.qustion-slide.fill').length>0){
										$('.qustion-slide.active').removeClass('active').prev().removeClass('fill').addClass('active');
									}
								});
								$('#nextTab').click(function(){
									$('.tab-menu > ul > .active').next('li').find('a').trigger('click');
									if($('.qustion-slide.fill').length < <?=$qCount-1?>){
										$('.qustion-slide.active').removeClass('active').addClass('fill').next().addClass('active');
									}
								});
								// setTimeout(function(){$('form').submit();}, 150000);
							});
						</script>
						<!-- 
							<div class="btn-slide">
								<a href="#" class="btn"><i class="fa fa-angle-left"></i></a>
								<a href="#" class="btn"><i class="fa fa-angle-right"></i></a>
							</div> 
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>