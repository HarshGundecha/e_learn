<section class="banner">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="banner-text">
		<div class="container">
			<br><h1>Get and Share Knowledge</h1>
		</div>
	</div>
</section>
<section class="student-feedback">
	<div class="forums-page">
		<div class="container">
			<h2 style="color:#02cbf7;text-decoration:underline;text-align:center;">Ask Your Question Below</h2>
			<script src="<?=base_url('/resources/admin/assets/niceditor/');?>nicEdit.js" type="text/javascript"></script>
			<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({fullPanel : true}).panelInstance('aQuestionContent');
			});
			</script>
			<form method="POST" action="<?=site_url('/AskQuestion/addquestion')?>">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-8" style="text-align:center;">
							<font style="font-size:1.8em">Title : </font><input type="text" name="aQuestionTitle" id="aQuestionTitle" placeholder="Title" autofocus>
						</div>
						<div class="col-sm-4">
							<button type="submit" style="border-style:solid;border-width:2px;" class="btn2">Post</button><br><br>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<textarea name="aQuestionContent" id="aQuestionContent" class="textarea" placeholder="Ask your Question" style="color:black;width: 100%; height: 370px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
								<font color="black"><h3><u>Ask </u><b>Question </b><i>Here</i></h3></font>
							</textarea>
						</div>
										<style type="text/css">
											.default-tag{
												line-height: 36px;
												padding: 0 15px;
												border: solid 1px #e0e0e0;
												border-radius: 18px;
												color: #9C9C9C;
												background: #f5f5f5;
												text-decoration: none;
												font-size: 15px;
												transition: all 0.7s ease-in-out 0s;
											}
											.alter-tag{
												line-height: 36px;
												padding: 0 15px;
												border: solid 1px #e0e0e0;
												border-radius: 18px;
												color: white;
												background: #02cbf7;
												text-decoration: none;
												font-size: 15px;
												transition: all 0.7s ease-in-out 0s;
											}
										</style>
										<div class="col-sm-10 col-sm-offset-1" style="margin-top:15px;">
											<?php
												foreach ($TagData as $td) {
													?>
														<label for="tag-<?=$td->TagID;?>" class="default-tag labela"><?=$td->TagName;?></label>
														<input id="tag-<?=$td->TagID;?>" style="display: none;" type="checkbox" name="tag[]" value="<?=$td->TagID;?>">
													<?php
												}
											?>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.labela').on('click',function(){
													$(this).toggleClass('default-tag alter-tag');
												});
											});
										</script>
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
				</script>
			</form>
		</div>
	</div>
</section>