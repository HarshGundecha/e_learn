<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MaterialAdminLTE 2 | Data Tables</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/AdminLTE.min.css">
	<!-- Material Design -->
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/ripples.min.css">
	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/MaterialAdminLTE.min.css">
  <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>dist/css/skins/all-md-skins.min.css">
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?=base_url('resources/admin/assets/')?>index2.html" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">M<b>A</b>L</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">Material<b>Admin</b>LTE</span>
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
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-success">4</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 4 messages</li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- start message -->
											<a href="#">
												<div class="pull-left">
													<img src="<?=base_url('resources/admin/assets/')?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Support Team
													<small><i class="fa fa-clock-o"></i> 5 mins</small>
												</h4>
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<!-- end message -->
										<li>
											<a href="#">
												<div class="pull-left">
													<img src="<?=base_url('resources/admin/assets/')?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													AdminLTE Design Team
													<small><i class="fa fa-clock-o"></i> 2 hours</small>
												</h4>
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="pull-left">
													<img src="<?=base_url('resources/admin/assets/')?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Developers
													<small><i class="fa fa-clock-o"></i> Today</small>
												</h4>
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="pull-left">
													<img src="<?=base_url('resources/admin/assets/')?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Sales Department
													<small><i class="fa fa-clock-o"></i> Yesterday</small>
												</h4>
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="pull-left">
													<img src="<?=base_url('resources/admin/assets/')?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Reviewers
													<small><i class="fa fa-clock-o"></i> 2 days</small>
												</h4>
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#">See All Messages</a></li>
							</ul>
						</li>
						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 10 notifications</li>
								<li>
									<!-- inner menu: contains the actual data -->
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
						<!-- Tasks: style can be found in dropdown.less -->
						<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">9</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 9 tasks</li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- Task item -->
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
										<!-- end task item -->
										<li><!-- Task item -->
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
										<!-- end task item -->
										<li><!-- Task item -->
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
										<!-- end task item -->
										<li><!-- Task item -->
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
										<!-- end task item -->
									</ul>
								</li>
								<li class="footer">
									<a href="#">View all tasks</a>
								</li>
							</ul>
						</li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?=base_url('resources/admin/assets/')?>dist/img/user-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs">Thanh Nguyen</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?=base_url('resources/admin/assets/')?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">

									<p>
										Thanh Nguyen <br> <small>Software Developer</small>
										<small>Member since Nov. 2012</small>
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">
									<div class="row">
										<div class="col-xs-4 text-center">
											<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Friends</a>
										</div>
									</div>
									<!-- /.row -->
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="#" class="btn btn-default btn-flat">Sign out</a>
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
						<img src="<?=base_url('resources/admin/assets/')?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>Thanh Nguyen</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
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
					<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Data Tables
					<small>advanced tables</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
			</section>


			<section class="content">
				<div class="row">
					<div class="col-xs-12">

						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Data Table With Full Features</h3>

								<button class="btn btn-info pull-right" data-toggle="modal" data-target="#mymodal" >Login</button>

								<div class="modal modal-default" id="mymodal" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span></button>
													<h4 class="modal-title">Action Name</h4>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
														<div class="col-md-12">

															<div class="box box-widget">
																<div class="box-header with-border">


																		<h3 class="box-title">Form Name</h3>


																	<div class="box-tools">
																		<!-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read"> -->
																			<!-- <i class="fa fa-circle-o"></i></button> -->
																			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
																			</button>
																			<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
																		</div>

																	</div>

																	<div class="box-body">










																		<form role="form">
																			<div class="box-body">
																				<div class="form-group is-empty">
																					<label for="exampleInputEmail1">Email address</label>
																					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
																				</div>
																				<div class="form-group is-empty">
																					<label for="exampleInputPassword1">Password</label>
																					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
																				</div>
																				<div class="form-group is-empty is-fileinput">
																					<label for="exampleInputFile">File input</label>
																					<input type="text" readonly="" class="form-control" placeholder="Browse...">
																					<input type="file" id="exampleInputFile">

																					<p class="help-block">Example block-level help text here.</p>
																				</div>
																			</div>



																		</form>








																	</div>



																	<div class="box-footer">
																		<button type="submit" class="btn btn-success">Submit</button>
																		<button type="Reset" class="btn btn-danger pull-right">Reset</button>
																	</div>

																</div>

															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
													</div>
												</div>
											</div>
										</div>

									</div>

									<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Rendering engine</th>
													<th>Browser</th>
													<th>Platform(s)</th>
													<th>Engine version</th>
													<th>CSS grade</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Trident</td>
													<td>Internet
														Explorer 4.0
													</td>
													<td>Win 95+</td>
													<td> 4</td>
													<td>X</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th>Rendering engine</th>
													<th>Browser</th>
													<th>Platform(s)</th>
													<th>Engine version</th>
													<th>CSS grade</th>
												</tr>
											</tfoot>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</section>
					<!-- /.content -->
				</div>
				<!-- /.content-wrapper -->
				<footer class="main-footer">
					<div class="pull-right hidden-xs">
						<b>Version</b> 2.3.8
					</div>
					<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>, <a href="https://fezvrasta.github.io">Federico Zivolo</a> and <a href="https://ducthanhnguyen.github.io">Thanh Nguyen</a>.</strong> All rights
					reserved.
				</footer>

				<!-- Control Sidebar -->
				<aside class="control-sidebar control-sidebar-dark">
					<!-- Create the tabs -->
					<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
						<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
						<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<!-- Home tab content -->
						<div class="tab-pane" id="control-sidebar-home-tab">
							<h3 class="control-sidebar-heading">Recent Activity</h3>
							<ul class="control-sidebar-menu">
								<li>
									<a href="javascript:void(0)">
										<i class="menu-icon fa fa-birthday-cake bg-red"></i>

										<div class="menu-info">
											<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

											<p>Will be 23 on April 24th</p>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<i class="menu-icon fa fa-user bg-yellow"></i>

										<div class="menu-info">
											<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

											<p>New phone +1(800)555-1234</p>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

										<div class="menu-info">
											<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

											<p>nora@example.com</p>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<i class="menu-icon fa fa-file-code-o bg-green"></i>

										<div class="menu-info">
											<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

											<p>Execution time 5 seconds</p>
										</div>
									</a>
								</li>
							</ul>
							<!-- /.control-sidebar-menu -->

							<h3 class="control-sidebar-heading">Tasks Progress</h3>
							<ul class="control-sidebar-menu">
								<li>
									<a href="javascript:void(0)">
										<h4 class="control-sidebar-subheading">
											Custom Template Design
											<span class="label label-danger pull-right">70%</span>
										</h4>

										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<h4 class="control-sidebar-subheading">
											Update Resume
											<span class="label label-success pull-right">95%</span>
										</h4>

										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-success" style="width: 95%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<h4 class="control-sidebar-subheading">
											Laravel Integration
											<span class="label label-warning pull-right">50%</span>
										</h4>

										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<h4 class="control-sidebar-subheading">
											Back End Framework
											<span class="label label-primary pull-right">68%</span>
										</h4>

										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
										</div>
									</a>
								</li>
							</ul>
							<!-- /.control-sidebar-menu -->

						</div>
						<!-- /.tab-pane -->
						<!-- Stats tab content -->
						<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
						<!-- /.tab-pane -->
						<!-- Settings tab content -->
						<div class="tab-pane" id="control-sidebar-settings-tab">
							<form method="post">
								<h3 class="control-sidebar-heading">General Settings</h3>

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Report panel usage
										<input type="checkbox" class="pull-right" checked>
									</label>

									<p>
										Some information about this general settings option
									</p>
								</div>
								<!-- /.form-group -->

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Allow mail redirect
										<input type="checkbox" class="pull-right" checked>
									</label>

									<p>
										Other sets of options are available
									</p>
								</div>
								<!-- /.form-group -->

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Expose author name in posts
										<input type="checkbox" class="pull-right" checked>
									</label>

									<p>
										Allow the user to show his name in blog posts
									</p>
								</div>
								<!-- /.form-group -->

								<h3 class="control-sidebar-heading">Chat Settings</h3>

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Show me as online
										<input type="checkbox" class="pull-right" checked>
									</label>
								</div>
								<!-- /.form-group -->

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Turn off notifications
										<input type="checkbox" class="pull-right">
									</label>
								</div>
								<!-- /.form-group -->

								<div class="form-group">
									<label class="control-sidebar-subheading">
										Delete chat history
										<a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
									</label>
								</div>
								<!-- /.form-group -->
							</form>
						</div>
						<!-- /.tab-pane -->
					</div>
				</aside>
				<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  	immediately after the control sidebar -->
  	<div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="<?=base_url('resources/admin/assets/')?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?=base_url('resources/admin/assets/')?>bootstrap/js/bootstrap.min.js"></script>
  <!-- Material Design -->
  <script src="<?=base_url('resources/admin/assets/')?>dist/js/material.min.js"></script>
  <script src="<?=base_url('resources/admin/assets/')?>dist/js/ripples.min.js"></script>
  <script>
  	$.material.init();
  </script>
  <!-- DataTables -->
  <script src="<?=base_url('resources/admin/assets/')?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('resources/admin/assets/')?>plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?=base_url('resources/admin/assets/')?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?=base_url('resources/admin/assets/')?>plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url('resources/admin/assets/')?>dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=base_url('resources/admin/assets/')?>dist/js/demo.js"></script>
  <!-- page script -->
  <script>
  	$(function () {
  		$("#example1").DataTable();
  		$('#example2').DataTable({
  			"paging": true,
  			"lengthChange": false,
  			"searching": false,
  			"ordering": true,
  			"info": true,
  			"autoWidth": false
  		});
  	});
  </script>
</body>
</html>
