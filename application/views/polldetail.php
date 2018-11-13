<?php
	// echo "<pre>";
	// print_r($Poll_Data);
	// echo "</pre>";
	// die();
	if($Poll_Data[0]->PollStatus==1)
		redirect('Poll');
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Poll</h1>
		</div>
	</div>
</section>
<section class="breadcrumb">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/Poll/');?>">Polls</a></li>
			<li><a href="#">Poll Detail</a></li>
		</ul>
	</div>
</section>
<div class="forums-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-1">
				<div class="section-title">
					<h2>
						Poll
					</h2>
				</div>
				<div class="right-slide">
					<br><p style="font-size:2em;"><?=$Poll_Data[0]->PollTitle;?></p><hr>
					<p><?=$Poll_Data[0]->PollContent;?></p><hr>
				</div><br><br>
				<form action="<?=site_url('/Poll/AddVote/'.$Poll_Data[0]->PollID);?>" method="POST">
					<div class="right-slide">
						<button type="submit" style="float:right;" class="btn2">Add Vote</button><br>
						<h3>
							Options
						</h3>
					</div>
					<div class="group-tab-view">
						<?php
							$ColorBar=array('normal', 'error', 'success', 'warning');
							$flag=0;
							foreach ($Poll_Data[0]->OptionData as $pd)
							{
								// if($pd->PollStartStatus<0)
								// {
								if($Poll_Data[0]->TotalVote!=0)
								{
									$pc=$pd->OptionCount*100/$Poll_Data[0]->TotalVote;								
									$pc=round($pc);
								}
								else
									$pc=0;													
						?>
								<div class="row">
									<div class="col-xs-1" >
										<input type="radio" value="<?=$pd->PollXOptionID;?>" name="PollAnswer" id="<?=$pd->PollXOptionID;?>" style="-webkit-appearance:radio;float:right;margin-top:30px;"
										<?php
											if($Poll_Data[0]->UserVote)
											{
												if($Poll_Data[0]->UserVote->PollXOptionID==$pd->PollXOptionID)
													echo ' checked="checked" ';
											}
										?>
										>
									</div>
									<div class="col-xs-11">
										<div class="progress-bar-main">
											<div class="progress-label">
												<div class="info"><?=$pd->PollXOptionContent;?></div>
												<div class="progress">
													<div class="progress-bar <?=$ColorBar[$flag];?>" style="width:<?=$pc?>%">
														<span class="percentage "><?=$pc?>%</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php
								if($flag==3)
									$flag=0;
								else
									$flag++;
							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>