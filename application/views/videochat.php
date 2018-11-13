<?php
// echo "<pre>";
// print_r($Article_Data);
// echo "</pre>";
// die();
$this->load->helper('date');
?>
<section class="breadcrumb white-bg">
	<div class="container">
		<ul>
			<li><a href="<?=site_url('/home/');?>">Home</a></li>
			<li><a href="<?=site_url('/VideoChat/');?>">Video Chat</a></li>
		</ul>
	</div>
</section>
<div class="blog-page">
	<div class="container">
		<div class="row">
			<link rel="stylesheet" type="text/css" href="<?=base_url('resources/user/simplertc/');?>stylesheets/style.css" />
			<script type="text/javascript">
				var host = "kevingleason.me";
				if ((host == window.location.host) && (window.location.protocol != "https:"))
					window.location.protocol = "https";
			</script>
			<script src="<?=base_url('resources/user/simplertc/');?>js/modernizr.custom.js"></script>
			<link rel="stylesheet" type="text/css" href="<?=base_url('resources/user/simplertc/');?>stylesheets/normalize.css"/>
			<style>
			#vid-box{
				display: inline-block;
				text-align:center;
				width:100%;
			}
			#vid-box video{
				width:47%;
			}
		</style>
		<div class = "bodyDiv">

			<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
			<!-- My Phone Number & Dial Areas -->
			<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
			<div id="vid-box" class="video2"></div>
			<div id="vid-thumb"></div>

			<!--
				<form name="loginForm" id="login" action="#" onsubmit="return login(this);">
				    <input type="text" name="username" id="username" placeholder="Pick a username!" />
				    <input type="submit" name="login_submit" value="Log In">
				</form>
			-->
			<form name="loginForm" id="login" action="#" onsubmit="return errWrap(login,this);" style="display: none">
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" name="username" id="username" placeholder="Enter A Username" value="<?=$this->session->UserEmail;?>"/>
					<label class="input__label input__label--nao" for="username">
						<span class="input__label-content input__label-content--nao">                                          
						</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>

				<button class="cbutton cbutton--effect-radomir" type="submit" name="login_submit" value="Log In" style="margin-top: 40px; margin-left:-10px">
					<i class="cbutton__icon fa fa-fw fa fa-sign-in"></i>
				</button>
			</form>
			<script type="text/javascript">
				$(function(){
					$('#login').trigger('submit');
				})
			</script>
			<form name="callForm" id="call" action="#" onsubmit="return errWrap(makeCall,this);">
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" name="number" id="call" placeholder="Enter Email of User To Call"/>
					<label class="input__label input__label--nao" for="number">
						<span class="input__label-content input__label-content--nao">                                          
						</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
				<button class="cbutton cbutton--effect-radomir md-trigger" type="submit" value="Call" style="margin-top: 40px; margin-left:-10px" data-modal="modal-13">
					<i class="cbutton__icon fa fa-fw fa fa fa-phone-square"></i>
				</button>
			</form>

			<div id="inCall" class="ptext">
				<button class="btn btn-lg btn-danger" id="end" onclick="end()" >End</button> 
				<button class="btn btn-lg" id="mute" onclick="mute()">Mute</button> 
				<button class="btn btn-lg btn-warning" id="pause" onclick="pause()">Pause</button>
			</div>

			<br><div id="logs" class="ptext"></div>

			<br><p class="ptext"><b>Usage:</b></p>
			<p class="ptext">Type a Email and click Call button.</p>
			<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- -->
			<!-- WebRTC Peer Connections -->
			<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- -->
			<script src="https://cdn.pubnub.com/pubnub.min.js"></script>
			<script src="<?=base_url('resources/user/simplertc/');?>js/webrtc.js"></script>
			<script src="<?=base_url('resources/user/simplertc/');?>js/rtc-controller.js"></script>

			<script type="text/javascript">

				var video_out = document.getElementById("vid-box");
				var vid_thumb = document.getElementById("vid-thumb");
				var vidCount  = 0;

				function login(form) {
					var phone = window.phone = PHONE({
	    number        : form.username.value || "Anonymous", // listen on username line else Anonymous
	    publish_key   : 'pub-c-561a7378-fa06-4c50-a331-5c0056d0163c', // Your Pub Key
	    subscribe_key : 'sub-c-17b7db8a-3915-11e4-9868-02ee2ddab7fe', // Your Sub Key
	  });
					var ctrl = window.ctrl = CONTROLLER(phone, get_xirsys_servers);
					ctrl.ready(function(){
						form.username.style.background="#55ff5b"; 
						form.login_submit.hidden="true"; 
						ctrl.addLocalStream(vid_thumb);
						addLog("Logged in as " + form.username.value); 
					});
					ctrl.receive(function(session){
						session.connected(function(session){ video_out.appendChild(session.video); addLog(session.number + " has joined."); vidCount++; });
						session.ended(function(session) { ctrl.getVideoElement(session.number).remove(); addLog(session.number + " has left.");    vidCount--;});
					});
					ctrl.videoToggled(function(session, isEnabled){
						ctrl.getVideoElement(session.number).toggle(isEnabled);
						addLog(session.number+": video enabled - " + isEnabled);
					});
					ctrl.audioToggled(function(session, isEnabled){
						ctrl.getVideoElement(session.number).css("opacity",isEnabled ? 1 : 0.75);
						addLog(session.number+": audio enabled - " + isEnabled);
					});
					return false;
				}

				function makeCall(form){
					if (!window.phone) alert("Login First!");
					var num = form.number.value;
	if (phone.number()==num) return false; // No calling yourself!
	ctrl.isOnline(num, function(isOn){
		if (isOn) ctrl.dial(num);
		else alert("User if Offline");
	});
	return false;
}

function mute(){
	var audio = ctrl.toggleAudio();
	if (!audio) $("#mute").html("Unmute");
	else $("#mute").html("Mute");
}

function end(){
	ctrl.hangup();
}

function pause(){
	var video = ctrl.toggleVideo();
	if (!video) $('#pause').html('Unpause'); 
	else $('#pause').html('Pause'); 
}

function getVideo(number){
	return $('*[data-number="'+number+'"]');
}

function addLog(log){
	$('#logs').append("<p>"+log+"</p>");
}

function get_xirsys_servers() {
	var servers;
	$.ajax({
		type: 'POST',
		url: 'https://service.xirsys.com/ice',
		data: {
			room: 'default',
			application: 'default',
			domain: 'kevingleason.me',
			ident: 'gleasonk',
			secret: 'b9066b5e-1f75-11e5-866a-c400956a1e19',
			secure: 1,
		},
		success: function(res) {
			console.log(res);
			res = JSON.parse(res);
			if (!res.e) servers = res.d.iceServers;
		},
		async: false
	});
	return servers;
}

function errWrap(fxn, form){
	try {
		return fxn(form);
	} catch(err) {
		alert("WebRTC is currently only supported by Chrome, Opera, and Firefox");
		return false;
	}
}

</script>

</div>
</div>
</div>
</div>
<section class="our-advantages">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="http://localhost/projects/ts2/resources/user/assets/images/learn-icon.png" alt=""></div>
						<h3>Learn at your own place</h3>
						<p>Learn from anywhere be it home or work or anywhere in the world.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="http://localhost/projects/ts2/resources/user/assets/images/save-timeIcon.png" alt=""></div>
						<h3>Save time and money</h3>
						<p>Save yout time by learning short and simple yet upto date and free courses.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="advantages-box">
						<div class="img"><img src="http://localhost/projects/ts2/resources/user/assets/images/online-learningIcon.png" alt=""></div>
						<h3>100% Online learning</h3>
						<p>Learn almost everything by using our web application.</p>
					</div>
				</div>
			</div>
		</div>
	</section>