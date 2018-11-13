<header id="header">
	<div class="container">
		<nav id="nav-main">
			<div class="navbar navbar-inverse">
				<div class="navbar-header">
					<a href="<?=site_url('/Home');?>" class="navbar-brand"><img src="<?=base_url('resources/user/assets/');?>images/logo.png" alt=""></a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="menu">
							<a href="<?=site_url('/Home');?>"> Home </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Category');?>"> Category </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Article');?>"> Article </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/ForumQuestion');?>"> Discussions </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/AskQuestion');?>"> Ask Question </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Poll');?>"> Poll </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Challenge');?>"> Challenge </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Ide');?>"> Code Arena </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/Home/Users');?>"> Users </a>
						</li>
						<li class="menu">
							<a href="<?=site_url('/VideoChat');?>"> Video Chat </a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
<script>
	var prevScrollpos = window.pageYOffset;
	window.onscroll = function() {
		var currentScrollPos = window.pageYOffset;
		if (prevScrollpos > currentScrollPos) {
			$('#header').fadeIn(200);	
		} else {
			$('#header').fadeOut(200);
		}
		prevScrollpos = currentScrollPos;
	}
</script>
