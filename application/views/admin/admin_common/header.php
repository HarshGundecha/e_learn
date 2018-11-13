<body class="hold-transition skin-black-light sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>TS</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>e_learn</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->

<?php
	$CI =& get_instance();
	$CI->load->model('admin/Notification_m');
	$nd=$CI->Notification_m->getAllNotificationData();
	$i=0;
	foreach ($nd as $nd2) {
		if($nd2->IsRead==0)
			$i++;
	}
?>

							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
                                <?php
                                    if($i!=0)
                                    {
                                ?>
    									<span class="label label-success"><?=$i;?></span>                                
                                <?php
                                    }
                                ?>
								</a>
								<ul class="dropdown-menu">
									<li class="header"><?=$i!=0?$i:'no';?> new notifications</li>
									<li>
										<ul class="menu">

										<?php
											foreach ($nd as $n)
											{
										?>
												<li>
													<a href="<?=site_url('/admin/Notification/'.$n->AdminNotificationID)?>">
														<div class="pull-left">
															<img src="<?=base_url('resources/user/uploads/'.$n->UserAvatar)?>" class="img-circle" alt="User Image">
														</div>
														<h4>
															<?=$n->UserName;?>
															<small><i class="fa fa-clock-o"></i>

															<?php
																$dt = DateTime::createFromFormat('Y-m-d H:i:s', $n->CreatedDateTime);
																$dd3 = $dt->getTimestamp();
																echo timespan($dd3, '', 1). ' ago';
															?>

															</small>
														</h4>
														<p><?=$n->AdminNotificationContent;?></p>
													</a>
												</li>
										<?php
											}
										?>

										</ul>
									</li>
									<!-- <li class="footer"><a href="#">See All Messages</a></li> -->
								</ul>
							</li>
						
						<!-- Notifications: style can be found in dropdown.less -->
						<!--
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning">10</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 10 notifications</li>
									<li>
										<ul class="menu">
											<li>
												<a href="#">
													<i class="fa fa-users text-aqua"></i> 5 new members joined today
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
													page and may cause design problems
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-users text-red"></i> 5 new members joined
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-shopping-cart text-green"></i> 25 sales made
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-user text-red"></i> You changed your username
												</a>
											</li>
										</ul>
									</li>
									<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li>
						-->
						<!-- Tasks: style can be found in dropdown.less -->
						<!--
							<li class="dropdown tasks-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-flag-o"></i>
									<span class="label label-danger">9</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 9 tasks</li>
									<li>
										<ul class="menu">
											<li>
												<a href="#">
													<h3>
														Design some buttons
														<small class="pull-right">20%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">20% Complete</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="#">
													<h3>
														Create a nice theme
														<small class="pull-right">40%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">40% Complete</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="#">
													<h3>
														Some task I need to do
														<small class="pull-right">60%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="#">
													<h3>
														Make beautiful transitions
														<small class="pull-right">80%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">80% Complete</span>
														</div>
													</div>
												</a>
											</li>
										</ul>
									</li>
									<li class="footer">
										<a href="#">View all tasks</a>
									</li>
								</ul>
							</li>
						-->
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?=base_url('resources/admin/uploads/'.$this->session->AdminImage)?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?=$this->session->AdminName?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?=base_url('resources/admin/uploads/'.$this->session->AdminImage)?>" class="img-circle" alt="User Image">

									<p>
										<?=$this->session->AdminName?> <br> <small><?=$this->session->AdminEmail?></small>
										<small>
											<?php
												if($this->session->AdminLevel==0)
													echo "Super Admin";
												else if($this->session->AdminLevel==1)
													echo "Sub Admin";
												//echo $this->session->AdminLevel;
											?>
										</small>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?=site_url('admin/Admin/');?><?=$this->session->AdminID?>" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?=site_url('admin/Logout');?>" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?=base_url('resources/admin/uploads/'.$this->session->AdminImage)?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?=$this->session->AdminName;?></p>
						<a href="<?=site_url('admin/Admin/'.$this->session->AdminID);?>">
							<i class="fa fa-circle text-success"></i> Online
						</a>
					</div>
				</div>
				<!-- search form -->
				<!--
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				-->
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN PAGES</li>
        			<?php
        			    if($this->session->AdminLevel==0)
        			    {
        			 ?>
        					<li>
        						<a href="<?=site_url('admin/Admin');?>">
        							<i class="fa fa-user-secret"></i>
        							<span>Manage Admin</span>
        						</a>
        					</li>
                    <?php
        			    }
                    ?>
					<li class="treeview active">
						<a href="#">
							<i class="fa fa-graduation-cap"></i> <span>Manage Study Material</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
					        <li><a href="<?=site_url('admin/Category');?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-list"></i> Manage Category</a></li>
							<li><a href="<?=site_url('admin/Course');?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-book"></i> Manage Course</a></li>
							<li><a href="<?=site_url('admin/Chapter');?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-book"></i> Manage Chapter</a></li>
							<li><a href="<?=site_url('admin/Section');?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-book"></i> Manage Section</a></li>
						</ul>
					</li>
					<li>
						<a href="<?=site_url('admin/Article');?>">
							<i class="fa fa-newspaper-o"></i>
							<span>Manage Article</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/Poll');?>">
							<i class="fa fa-flag"></i>
							<span>Manage Poll</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/QuizQuestion');?>">
							<i class="fa fa-question-circle"></i>
							<span>Manage Quiz Q&A</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/User');?>">
							<i class="fa fa-user"></i>
							<span>Manage User</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/ForumQuestion');?>">
							<i class="fa fa-comments-o"></i>
							<span>Manage Discussion</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/Tag');?>">
							<i class="fa fa-tag"></i>
							<span>Manage Tag</span>
						</a>
					</li>
					<li>
						<a href="<?=site_url('admin/SiteReport');?>">
							<i class="fa fa-bar-chart"></i>
							<span>Manage Reports</span>
						</a>
					</li>
					<!--
						<li>
							<a href="<?=site_url('admin/challenge');?>">
								<i class="fa fa-book"></i>
								<span>Manage Challenge</span>
							</a>
						</li>
					-->
					<!-- <li class="header">MAIN NAVIGATION</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i>
							<span>Layout Options</span>
							<span class="pull-right-container">
								<span class="label label-primary pull-right">4</span>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
							<li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
							<li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
							<li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
						</ul>
					</li>
					<li>
						<a href="../widgets.html">
							<i class="fa fa-th"></i> <span>Widgets</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green">new</small>
							</span>
						</a>
					</li>
					<li class="treeview active">
						<a href="#">
							<i class="fa fa-table"></i> <span>Tables</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
							<li class="active"><a href="data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
						</ul>
					</li>
					<li>
						<a href="../calendar.html">
							<i class="fa fa-calendar"></i> <span>Calendar</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-red">3</small>
								<small class="label pull-right bg-blue">17</small>
							</span>
						</a>
					</li>
					<li>
						<a href="../mailbox/mailbox.html">
							<i class="fa fa-envelope"></i> <span>Mailbox</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-yellow">12</small>
								<small class="label pull-right bg-green">16</small>
								<small class="label pull-right bg-red">5</small>
							</span>
						</a>
					</li>

					<li><a href="<?=base_url('resources/admin/assets/')?>documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
					<li class="header">LABELS</li>
					<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
				</ul>
      <script type="text/javascript">
        $(function(){
          var url=window.location.href;
          //url=url.substring(url.lastIndexOf('/')+1);
          $('ul.sidebar-menu > li > a').each(function(){
            if(url.search($(this).attr("href"))>-1){
              $(this).parent().addClass("active");
            }
          });
        })
      </script>
			</section>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->		