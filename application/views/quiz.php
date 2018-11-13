<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Challenge</h1>
		</div>
	</div>
</section>
<section class="breadcrumb white-bg">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Quiz</a></li>
		</ul>
	</div>
</section>
<section class="quiz-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<div id="countdown"></div>
				<div class="qustion-list">
					<?php
						$i=1;
						foreach ($qData as $q)
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
					<form method="post" action="<?=site_url('/challenge/submit/')?><?=$CID!=false?$CID:''?>">
						<div class="qustion-box">
							<div class="qustion" style="border-bottom:none;">

								<div class="group-tab-view" style="padding-top: 0px;">
									<div class="tab-menu" style="display: none;">
										<ul>
											<?php
												$i=1;
												foreach ($qData as $qd)
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
											foreach ($qData as $q)
											{
										?>
												<div class="tab-pane <?=$i==1?' active':'';?>" id="question-<?=$q->QuestionID?>">
													<p style="border-bottom: solid 2px #e0e0e0;padding-bottom:10px;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;">
														<?=$q->QuestionContent?>
													</p>
													<div class="ans">
														<?php
															foreach ($q->Options as $o)
															{
														?>
																<div class="ans-slide">
																	<label class="label_radio" for="option-<?=$o->QuestionXOptionID?>" style="cursor: pointer;">
																		<input name="question-<?=$q->QuestionID?>" id="option-<?=$o->QuestionXOptionID?>" value="<?=$o->QuestionXOptionID?>" type="radio"><?=$o->QuestionXOptionContent?>
																	</label>
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
									setTimeout(function(){$('form').submit();}, 150000);
								});
							</script>
							<!-- 
								<div class="btn-slide">
									<a href="#" class="btn"><i class="fa fa-angle-left"></i></a>
									<a href="#" class="btn"><i class="fa fa-angle-right"></i></a>
								</div> 
							-->
						</div>
						<div class="submit-quiz">
							<button type="submit" class="btn">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>