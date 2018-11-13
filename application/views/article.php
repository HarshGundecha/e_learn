<?php
// echo "<pre>";
// print_r($Article_Data);
// echo "</pre>";
// die();
$this->load->helper('date');
?>
<section class="banner inner-page">
	<div class="banner-img"><img src="<?=base_url('resources/user/assets/');?>images/banner/1.png" alt=""></div>
	<div class="page-title">	
		<div class="container">
			<h1>Article</h1>
		</div>
	</div>
</section>
<section class="breadcrumb white-bg">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="#">Article</a></li>
		</ul>
	</div>
</section>
<div class="blog-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-1">
                <!--<div class="row" style="margin-bottom:15px;">
                    <style type="text/css">
                        .reset-box-sizing, .reset-box-sizing *, .reset-box-sizing *:before, .reset-box-sizing *:after,  .gsc-inline-block
                        {
                            -webkit-box-sizing: content-box;
                            -moz-box-sizing: content-box;
                            box-sizing: content-box;
                        }
                        input.gsc-input, .gsc-input-box, .gsc-input-box-hover, .gsc-input-box-focus, .gsc-search-button
                        {
                            box-sizing: content-box;
                            line-height: normal;
                        }
                    </style>
                    <script>
                      (function() {
                        var cx = '012998091516256671414:1uga3yymsgu';
                        var gcse = document.createElement('script');
                        gcse.type = 'text/javascript';
                        gcse.async = true;
                        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(gcse, s);
                      })();
                    </script>
                    <gcse:search></gcse:search>                    
                </div>-->
				<div class="row">
                    
					<?php
						foreach ($Article_Data as $ar)
						{
							if($ar->ArticleStatus==0)
							{
					?>
								<div class="col-md-6">
									<div class="blog-slide">
										<div class="img">
											<img src="<?=base_url('resources/admin/uploads/'.$ar->ArticleImage);?>" alt="" style="height:400px;width:500px;">
											<div class="date" style="padding-top:20px;font-size:1.3em;" title="<?=$ar->CreatedDateTime?>" data-toggle="tooltip">
											<?php
												$dt = DateTime::createFromFormat('Y-m-d H:i:s', $ar->CreatedDateTime);
												$dd3 = $dt->getTimestamp();
												echo timespan($dd3, '', 1).' Ago';
											?>
											</div>
										</div>
										<div class="info">
											<!-- <div class="category">Article </div> -->
											<div class="name"><?php echo substr($ar->ArticleTitle,0,20); ?>...</div>
											<div class="post-info">
												<span><i class="fa fa-user"></i><?=$ar->AddedByAdminName;?></span>
												<span><i class="fa fa-thumbs-up"></i><?=$ar->LikeCount;?>  Like</span>
												<span><i class="fa fa-comments"></i><?=$ar->CommentCount;?>  Comment</span>
											</div>
											<!-- <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> -->
											<a href="<?=site_url('/Article/'.$ar->ArticleID);?>" class="btn2">view More</a>
										</div>
									</div>
								</div>
					<?php
							}
						}
					?>
				</div>
				<!--
					<div class="blog-slide">
						<div class="img">
							<img src="<?=base_url('resources/user/assets/');?>images/blog/img2.jpg" alt="">
							<div class="date">12<span>Jan</span></div>
						</div>
						<div class="info">
							<div class="category">Lorem Ipsum </div>
							<div class="name">Ipsum is simply dummy text of the printing and</div>
							<div class="post-info">
								<span><a href="#"><i class="fa fa-user"></i>info@gmail.com</a></span>
								<span><a href="#"><i class="fa fa-tag"></i>Music</a></span>
								<span><a href="#"><i class="fa fa-comments"></i>78  Comment</a></span>
							</div>
							<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
							<a href="blog-details.html" class="btn2">view More</a>
						</div>
					</div>
					<div class="blog-slide">
						<div class="img">
							<img src="<?=base_url('resources/user/assets/');?>images/blog/img3.jpg" alt="">
							<div class="date">12<span>Jan</span></div>
						</div>
						<div class="info">
							<div class="category">Lorem Ipsum </div>
							<div class="name">Ipsum is simply dummy text of the printing and</div>
							<div class="post-info">
								<span><a href="#"><i class="fa fa-user"></i>info@gmail.com</a></span>
								<span><a href="#"><i class="fa fa-tag"></i>Music</a></span>
								<span><a href="#"><i class="fa fa-comments"></i>78  Comment</a></span>
							</div>
							<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
							<a href="blog-details.html" class="btn2">view More</a>
						</div>
					</div>
					<div class="pagination">
						<ul>
							<li class="next"><a href="#"><i class="fa fa-angle-left"></i><span>Next</span></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li class="prev"><a href="#"><span>prev</span> <i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				-->
			</div>
			<div class="col-md-3">
				<div class="right-slide">
    				<!--
    				    <div class="search-box">
    						<input type="text" placeholder="Search">
    						<input type="submit" value=""> 
    					</div>
    					<h3>Catagories</h3>
    					<ul class="catagorie-list">
    						<li><a href="#">Computer Sciences</a></li>
    						<li><a href="#">Business & Management</a></li>
    						<li><a href="#">Biology & Life Sciences</a></li>
    						<li><a href="#">Software Engineering</a></li>
    						<li><a href="#">Music, Film And Audio</a></li>
    					</ul>
    					<h3>Recent Posts</h3>
    					<div class="recent-post">
    						<div class="post-slide">
    							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img1.jpg" alt=""></div>
    							<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
    							<div class="date">12 Jan</div>
    						</div>
    						<div class="post-slide">
    							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img2.jpg" alt=""></div>
    							<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
    							<div class="date">12 Jan</div>
    						</div>
    						<div class="post-slide">
    							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img3.jpg" alt=""></div>
    							<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
    							<div class="date">12 Jan</div>
    						</div>
    						<div class="post-slide">
    							<div class="img"><img src="<?=base_url('resources/user/assets/');?>images/blog/post-img1.jpg" alt=""></div>
    							<p><a href="#">when an unknown printer took a galley of type and scrambled</a></p>
    							<div class="date">12 Jan</div>
    						</div>
    					</div>
    					<h3>Archive</h3>
    					<ul class="catagorie-list">
    						<li><a href="#">October 2001</a></li>
    						<li><a href="#">November 2014</a></li>
    						<li><a href="#">December 2015</a></li>
    						<li><a href="#">January 2016</a></li>
    						<li><a href="#">February 2016</a></li>
    					</ul>
					-->
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

					<h3>Tag</h3>
					<form action="<?php echo site_url('/Article/filter/'); ?>" method="post">
    					<ul class="keyword-list">
    					    <?php
        						foreach ($TagData as $tagd)
        						{
    					    ?>
    			    			    <li>
    			    			        <label class="default-tag labela" for="tag-<?=$tagd->TagID?>"><?=$tagd->TagName?></label>
    			    			        <input type="checkbox" name="tag[]" value="<?=$tagd->TagID?>" id="tag-<?=$tagd->TagID?>" style="display:none;">
    			    			    </li>
                            <?php
        						}
                            ?>
        					<!--
        						<li><a href="#">Student</a></li>
        					-->
    					</ul>
    					<label style="color:red;">
    					    <?php
    					        if(isset($error))
    					            echo $error;
    					    ?>
    					</label><br><br>
    					<input type="submit" name="btnsub" value="Filter" class="btn btn-info">
    				</form>
    				<script type="text/javascript">
                        $(function(){
                            $('.labela').on('click',function(){
                                $(this).toggleClass('default-tag alter-tag');
                            });
                        });
                    </script>
				</div>
			</div>
		</div>
	</div>
</div>