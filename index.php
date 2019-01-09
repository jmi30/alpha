<?php 
session_start();
require_once('config/connection.php');

$ipcheck = $_SERVER['REMOTE_ADDR'];
$sql_x = mysqli_query($connection, "SELECT * FROM admin WHERE active = '1'");
$fetch_x = mysqli_fetch_array($sql_x);
if(mysqli_num_rows($sql_x) == 1) {
		$_SESSION['username'] == $fetch_x['username'];
		header('location: main/');

} else {
	


?>

<!DOCTYPE html>
<html>
<head>
	<title>Enrollment System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	
</head>
<body>

	<div class="rap">
		<div class="u_name">Herman Kimmel State University</div>
		<div class="center">
			<div class="login_wrapper">
				<div class="blask">
					<div class="timer">
						<div class="tf">
							<div class="timer-text">The system disabled</div>
							<small>Try again in</small>
						</div>
						<div id="countdowntimer">60 <small>s</small></div>
					</div>
				</div>

				<div class="label1">Login</div>
				<!-- <form method="post" action=""> -->
					<div class="warning"></div>
					<div class="form">
						<div class="input">
							<div class="icon"><img src="img/icons/man-user.png" class="user-icon"></div>
							<input type="text" class="input1 un" name="username" placeholder="Username">
						</div>
						<div class="input">
							<div class="icon"><img src="img/icons/lock.png" class="user-icon"></div>
							<input type="password" class="input1 pw" name="password" placeholder="Password">

						</div>

						<div class="inputs">

							<div class="forgot">Forgot password?</div>


							<input type="submit" class="submitbtn" name="submit" value="Login">
						</div>
					</div>
					<div class="dd"></div>

					<!-- </form> -->

				</div>

			</div>
		</div>




<!-- <div class="notif_badge">
	<ul class="lines3">
		<li class="line"></li>
		<li class="line"></li>
		<li class="line"></li>
	</ul>
</div> -->


</body>
</html>

<script type="text/javascript">
	$(function() {

		$('.input1').click(function() {
			$(this).css('border','1px solid rgba(0,0,0,0.2)');
		});

		$('.forgot').click(function() {
			$('.input1').slideUp();
			$('.label1').text("Forgot Password").slideDown();
			$(this).text('Back to login');

		});

		var count = 0;
		var count2 = 0;

			

		$('.submitbtn').click(function(event) {
			count += 1;
			var username = $('input[name=username]').val();
			var password = $('input[name=password]').val();
			var warning = $('.warning');
			var textBox = $('.input1');
			var loginBox = $('.center');
			var loginWrapper = $('.login_wrapper');
			var cover = $('.blask');

			if((count == 1 || count == 3) && (!username || !password)) {

				loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300,function() {
					warning.slideDown(300).text("Please provide your credentials").delay(2500).slideUp();
					textBox.css('border','1px solid orangered');
				});


			} else if(count == 5 && (!username || !password)) {
				loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300,function() {
					warning.slideDown(300).text("Don't play with the system").delay(2500).slideUp();
					textBox.css('border','1px solid orangered');
				});
			} else if(count == 7 && (!username || !password)) {
				loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300,function() {
					warning.slideDown(300).text("The system will soon disable if you continue").delay(2500).slideUp();
					textBox.css('border','1px solid orangered');
				});
			} else if(count >= 8 && (!username || !password)) {
				warning.hide();
				cover.slideDown(300, function() {
					$(this).animate({height:loginWrapper.height(),width:loginWrapper.width()},500);
					$('.timer').fadeIn(function() {

						var timeleft = 60;
						var downloadTimer = setInterval(function(){
							timeleft--;

							$('#countdowntimer').html(timeleft+'<small> s<small>');
							if(timeleft <= 0) {
								clearInterval(downloadTimer);
								$('.timer').fadeOut();
								textBox.css('border','1px solid rgba(0,0,0,0.2)');
								textBox.val('');
								cover.slideUp();

								count = 0;
							}

						},1000);
					});

				});



			} else if(count2 >= 2 ) {
				warning.hide();
				
				cover.slideDown(300, function() {
					$(this).animate({height:loginWrapper.height(),width:loginWrapper.width()},500);
					$('.timer').fadeIn(function() {

						var timeleft = 60;
						var downloadTimer = setInterval(function(){
							timeleft--;

							$('#countdowntimer').html(timeleft+'<small> s<small>');
							if(timeleft <= 0) {
								clearInterval(downloadTimer);
								$('.timer').fadeOut();
								textBox.css('border','1px solid rgba(0,0,0,0.2)');
								textBox.val('');
								cover.slideUp();

								count = 0;
							}

						},1000);
					});

				});

			} else if(!username || !password) {
				loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300);
			} else {
				$.ajax({
					url: 'login.php',
					type: 'post',
					data: {username:username,password:password},
					success: function(res) {
						if(res.indexOf('accountCheck') > -1) {
							$('.rap').animate({'margin-top' : '-'+$(window).height()+'px'},1000,function() {

								$(this).remove();

							});
							$('.bottomup').fadeIn();
							window.location.href = 'acct_check.php';
							
						} else if(res.indexOf('active') > -1) {
							loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300,function() {
								warning.slideDown(300).text("The account that you're trying to login is already active").delay(125000).slideUp();
							});

						} else if(res.indexOf('true') > -1) { 
							window.location.href = 'main/';
						} else {
							
							loginBox.fadeOut(300).fadeIn(250).fadeOut(200).fadeIn(100).fadeOut(60).fadeIn(300,function() {
								warning.slideDown(300).text("Incorrect username and password").delay(2500).slideUp();
								textBox.css('border','1px solid orangered');
							});
							count2 +=1;


						}
					}
				});

			}




		});
	});
</script>

<?php } ?>