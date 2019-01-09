	<?php 

	session_start();

	require_once('../config/connection.php');
	require_once('../session/session.php');

	$username = $_SESSION['username'];

	$sql_main = mysqli_query($connection, "SELECT username, fname, lname, type FROM admin where username = '$username' UNION SELECT username, fname, lname, type FROM teacher where username = '$username' UNION SELECT username, fname, lname, type FROM students where username = '$username'");

/* 
	*/


$fetch_result = mysqli_fetch_array($sql_main);
$fname = $fetch_result['fname'];
$lname = $fetch_result['lname'];
$type = $fetch_result['type'];


/*if(isset($_GET['class_name'])) $clas = $_REQUEST['class_name'];
if(isset($_GET['grade'])) $grade = $_REQUEST['grade'];*/
$cid = $pid = "";
if(isset($_GET['cid'])) $cid = $_REQUEST['cid'];
if(isset($_GET['pid'])) $pid = $_REQUEST['pid'];

$sql_e = mysqli_query($connection, "SELECT * FROM class_tbl where id = '$cid'");
$fetch_e = mysqli_fetch_array($sql_e);


$page2 = "";
if(isset($_GET['page2'])) {
	$page2 = $_REQUEST['page2'];
	
}
?>


<!DOCTYPE html>
<html>
<head>
	<title><?php if($type == "admin") echo 'Administrator'; if($type == 'student') echo 'Student'; if($type == 'teacher') echo 'Instructor'; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/datatable/jquery.dataTables.min.css">

	<script src="../js/jquery.min.js"></script>
	<script src="../js/highlight.js"></script>
	<script src="../js/modal.js"></script>
	<script src="../js/datatable/datatable-main.js"></script>
	<script src="../js/datatable/jquery.dataTables.min.js"></script>
	<script src="../js/Chart.js"></script>

	<link href="../js/select2/select2.min.css" rel="stylesheet" />
	<script src="../js/select2/select2.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$('.enr_body').hide().fadeIn(800);
			$('.bc').hide().slideDown();
			$('.active').css('background','rgba(0,0,0,0.07)').delay(500);
			$('.active2').hide().fadeIn();
			$('.search').click(function() {
				
			});	

			
			
		/*$('.ba').hide().slideDown(500);
		$('.sectionlist1').hide();
		$('.boxbba').hide().slideDown().animate({"width":"100%"},1000, function() {
			$('.sectionlist1').fadeIn();
		});*/

		$('.search').one('click',function() {
			$('.mglass').animate({'opacity':'1'});
			$('.ba').text('Search');
			$('.mainright_side').fadeOut().remove();
			$('.bc').hide().not('.sng');
			$('.ac').removeClass('active');
			$('.ad').addClass('showw');
			$('.sng').show();
			$('.mainleft_side').animate({marginLeft:-235},500,function() {
				$('.search-wrapper').slideDown(function() {
					history();
				});
				$(this).remove();

			});
			$('.sdef').fadeIn();
			$('.ad').animate({width:'40%'});
			$(this).bind('keyup',function(ev) {
				var val = $(this).val(),
				resq = $('.search-res');
				if(val.length=="") {
					resq.slideUp(function() {
						$('.sdef').fadeIn();
					});
					
				} else {

					$.ajax({
						url: 'search.php',
						type: 'get',
						data: { keyword:val },
						success: function(res) {
							$('.sdef').fadeOut();
							resq.fadeIn().html(res);
							$('li.result-list').highlight(val);

							var children = [];
							resq.children().each(function() {
								children.push(this);
							});

							function fadeThemOut(children) {
								if(children.length > 0) {
									var currentChild = children.shift();
									$(currentChild).animate({'opacity':'1','margin':'5px'},30, function() {
										fadeThemOut(children);
										
									});
								}
							}
							fadeThemOut(children);
							
						}
					});
				}
			});

		});

		function history() {
			var username = "<?php echo $username; ?>";
			$.ajax({
				url: 'bridge.php',
				type: 'get',
				data: {user:username},
				success: function(r) {
					$('.history').html(r);
				}
			});
		}
		
		$('.sh1').click(function() {
			var hisUser = "<?php echo $user; ?>";

			$.ajax({
				url: 'bridge.php',
				type: 'get',
				data: {hisUser:hisUser},
				success: function() {
					$('ul.history').fadeOut();
				}
			});
		});



	});
</script>
<script type="text/javascript">
	var c = 0;
	function msg(m) {
		c += 1;
		if(c==1) {
			$.ajax({
				url: 'message.php',
				type: 'get',
				data: { m:m },
				success: function(h) {
					$('.msg-wrapper').html(h).show();
					$('.dots').hide();
				},
				beforeSend: function() {
					$('.dots').show();
				}
			});
		} else if(c==2) {
			$('.msg-wrapper').hide();
			c = 0;
		}
	}

	
</script>
</head>
<body>
	<div class="mask"></div>

	<div class="modal">
		<div class="modal-box">
			<div class="modal-header">Delete</div>
			<div class="modal-content"></div>
			<div class="modal-btn">
				<div class="modal-btn-pos">Yes</div>
				<div class="modal-btn-neg">No</div>
			</div>
		</div>
	</div>




	<div class="header">
		<div class="u_name2">HKSU</div>

		<div class="right_side">
			
			<div class="user_pic"></div>
			<div class="an_raper">
				<div class="account_name"><?php echo $fname.' '.$lname; ?></div>
				<small><?php if($type == "admin") echo 'Administrator'; if($type == 'student') echo 'Student'; if($type == 'teacher') echo 'Instructor'; ?></small>
			</div>
			
			<div class="mail-wrapper">
				<div class="m2w">
					<img class="mail" onclick="msg('<?php echo "$user"; ?>')" src="../img/icons/mail.png">
					<small class="badge">1</small>
				</div>
				<img class="dots" src="../img/icons/dots.gif">
				<div class="mail msg-wrapper"></div>
			</div>
			<div class="rapnotif">
				<?php 
				$sql_m = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username' and active = '1'");
				$fetch_m = mysqli_fetch_array($sql_m); 

				if($fetch_m['attempt'] == 0) {
					echo '
					<img class="notif" src="../img/icons/notifications-button.png">
					<small class="badge">1</small>
					';
				} else {
					echo '<img class="notif" src="../img/icons/notification.png">
					<small class="badge">1</small>
					';
				}
				?>
				
				
			</div>

			<div class="logout"><a class='alog' href="../logout.php">Log Out</a></div>
		</div>

		<div class="header_label">
			<div class="ad">
				<input type="text" class="search" name="" placeholder="Search...">
				<img class="mglass" src="../img/icons/magnifying-glass.png">
			</div>
			<div class="search-wrapper">
				<?php 
				$sql_y = mysqli_query($connection, "SELECT * FROM history WHERE user = '$user'");
				if(mysqli_num_rows($sql_y) == 0) {} else {
					?>
					<small class="sh">Search History: </small>
					<small class="sh1">Clear History</small>
				<?php } ?>
				<ul class="history"></ul>
				<ul class="search-res"></ul>
				<div class="sdef">
					
					<img src="../img/icons/mg.png">
					<div>
						<div><b>Search by:</b></div>
						<small>Student name</small><br>
						<small>Student LRN</small><br>
						<small>Student Grade or section</small><br>
						<small>Student Address</small><br>
						<small>Student Adviser</small>
					</div>
				</div>
			</div>

			<div class="rapa">
				<div class="bb">
					<div class="ba">
						
						<?php 
/*if(isset($_GET['page'])) {
	if($_GET['page'] == 'enrolment') {
		if(isset($page2) && $page2 == '') { echo 'Dashboard'; }
		else if(isset($e2) && $e2 == 'e2') { echo 'List of Students'; }
		else if(isset($e3) && ($e3 == 'e3' && !$pid)) { echo 'Masterlist'; }
		else if(isset($e3) && ($e3 == 'e3'  && $pid == 'enrol')) { echo 'Enrolment'; }
		else if(isset($e4) && $e4 == 'e4') { echo 'Enrolment Form'; }
		else if(isset($cid)) { 
			echo $fetch_e['grade'] . " - " .$fetch_e['class_name']; 
		}
	} else {
		echo "Welcome";
	}
} 
	*/	

$hp = $page = "";
if(isset($_GET['page'])) {
	$page = $_REQUEST['page'];
	
	$hp = $_REQUEST['page'];

	if(isset($page) && $page == 'enrolment') {
		if(isset($page2) && $page2 == '') { echo 'Dashboard'; }
		else if(isset($page2) && $page2 == 'e2') { echo 'List of Students'; }
		else if(isset($page2) && ($page2 == 'e3' && !$pid)) { echo 'Masterlist'; }
		else if(isset($page2) && ($page2 == 'e3'  && $pid == 'enrol')) { echo 'Enrolment'; }
		else if(isset($page2) && $page2 == 'e4') { echo 'Enrolment Form'; }
		else if(isset($cid)) { 
			echo $fetch_e['grade'] . " - " .$fetch_e['class_name']; 
		}
	} else if(isset($page) && $page == 'teacher') {
		if(isset($page2) && $page2 == 'department') { echo "Departments"; }
		else if(isset($page2) && $page2 == 'addnew') { echo "Add New"; }
		else if(isset($page2) && $page2 == 'profile') { echo "Profile"; }
		else { echo "Teacher"; }
	} else if(isset($page) && $page == 'students') {
		if(isset($page2) && $page2 == 'records') { echo 'Records'; }
		else if(isset($page2) && $page2 == 'profile') { echo "Profile"; } 
		else { echo 'Students'; }
	} else if(isset($page) && $page == 't_test' ) {
		echo "Test";
	} else if(isset($page) && $page == 's_test') {
		echo "Test";
	}

} else echo "Welcome";



?>

</div>
<small><?php if($type == "admin") echo 'Administrator'; if($type == 'student') echo 'Student'; if($type == 'teacher') echo 'Instructor'; ?> / <?php echo $username; ?></small>
</div>

<div class="bc">
	<?php 
	if(isset($_GET['page'])) {
		if(isset($page) && $page == 'enrolment') {
			?>
			<div class="bd"><a class="be <?php if(isset($page2) && $page2 == '') echo 'active2'; ?>" href="index.php?page=enrolment">Dashboard</a></div>
			<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'e2' || isset($view) && $view == 'view_enrolment') echo 'active2'; ?>" href="index.php?page=enrolment&page2=e2">List of Students</a></div>
			<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'e3') echo 'active2'; ?>" href="index.php?page=enrolment&page2=e3">Masterlist</a></div>
			<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'e4') echo 'active2'; ?>" href="index.php?page=enrolment&page2=e4">School Form</a></div>
			<?php
		}
	} if(isset($page) && $page == 'teacher') {
		?>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == '') echo 'active2'; ?>" href="index.php?page=teacher">Featured</a></div>
		<div class="bd"><a class="be  <?php if(isset($page2) && $page2 == 'addnew') echo 'active2'; ?>" href="index.php?page=teacher&page2=addnew">Add New</a></div>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'department') echo 'active2'; ?>" href="index.php?page=teacher&page2=department">Departments</a></div>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'profile') echo 'active2'; ?>" href="index.php?page=teacher&page2=profile">Profile</a></div>

		<div class="bd"><a class="be" href="">Principal</a></div>
		<div class="bd"><a class="be" href="">Partime</a></div>
		<div class="bd"><a class="be" href="">OJT</a></div>

		<?php
	} if(isset($page) && $page == 'students') { 
		?>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'records') echo 'active2'; ?>" href="index.php?page=students&page2=records&grade=7">Records</a></div>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'profile') echo 'active2'; ?>" href="index.php?page=students&page2=profile">Profile</a></div>
		<?php
	} if(isset($page) && $page == 't_test') { 
		?>
		<div class="bd"><a class="be <?php if(isset($page2) && $page2 == 'profile') echo 'active2'; ?>" href="index.php?page=students&page2=profile">Settings</a></div>
		<?php
	} else {
		?> 

	<?php } ?>	
	
</div>


<div class="bd sng"><a class="be" href="">Close</a></div>

</div>
</div>


</div> <!-- end of .header -->

<div class="main2_box">
	<div class="mainleft_side">

		<ul class="aa">
			<?php if($fetch_result['type'] == "admin") { ?>
				<li class="ab"><a class="ac <?php if(isset($hp) && $hp == '') echo 'active'; ?>"  href="index.php">Home</a></li>
				<li class="ab"><a class="ac <?php if(isset($page) && $page == 'enrolment') echo 'active'; ?>" href="index.php?page=enrolment">Enrolment</a></li>
				<li class="ab"><a class="ac <?php if(isset($page) && $page == 'students') echo 'active'; ?>" href="index.php?page=students">Student Records</a></li>
				<li class="ab"><a class="ac <?php if(isset($page) && $page == 'teacher') echo 'active'; ?>" href="index.php?page=teacher">Teacher</a></li>
				<li class="ab"><a class="ac" href="#">Faculty and Staff</a></li>
				<li class="ab"><a class="ac" href="#">Exams</a></li>
				<li class="ab"><a class="ac" href="#">Events</a></li>
			<?php } if($fetch_result['type'] == "student") { ?>
				<li class="ab"><a class="ac <?php if(isset($hp) && $hp == '') echo 'active'; ?>"  href="index.php">Home</a></li>
				<li class="ab"><a class="ac" href="#">Profile</a></li>
				<li class="ab"><a class="ac" href="#">Grade</a></li>
				<li class="ab"><a class="ac" href="index.php?page=project">Projects</a></li>
				<li class="ab"><a class="ac" href="#">Assignments</a></li>
				<li class="ab"><a class="ac" href="index.php?page=s_test">Test 
					<?php 
					$sql_af = mysqli_query($connection, "SELECT * FROM students WHERE username = '$user'");
					$fetch_af = mysqli_fetch_array($sql_af);
					$grade = "Grade ".$fetch_af['grade'];
					$section = $fetch_af['section'];

					$sql_ag = mysqli_query($connection, "SELECT * FROM tests where grade = '$grade' and section = '$section' and status = 'available'");
					echo "(".mysqli_num_rows($sql_ag).")";
					?></a></li>
					<li class="ab"><a class="ac" href="#">Videos</a></li>
					<li class="ab"><a class="ac" href="#">Games</a></li>
				<?php } if($fetch_result['type'] == "teacher") { ?>
					<li class="ab"><a class="ac <?php if(isset($hp) && $hp == '') echo 'active'; ?>"  href="index.php">Home</a></li>
					<li class="ab"><a class="ac" href="#">Profile</a></li>
					<li class="ab"><a class="ac <?php if(isset($hp) && $hp == 't_test') echo 'active'; ?>" href="index.php?page=t_test">Test</a></li>
					<li class="ab"><a class="ac" href="#">Assignments</a></li>
					<li class="ab"><a class="ac" href="#">Projects</a></li>
					<li class="ab"><a class="ac" href="#">Videos</a></li>
					
				<?php } ?>
			</ul>
			
		</div>
		
		<div class="mainright_side">
			<?php 

			if(isset($_GET['page'])) {

				if($_GET['page'] == 'enrolment') include __DIR__ . '/enrolment.php'; 
				if($_GET['page'] == 'students') include __DIR__ . '/students_index.php'; 
				if($_GET['page'] == 'teacher') include __DIR__ . '/teacher/index.php';
				if($_GET['page'] == 'project') include __DIR__ . '/student/index.php'; 
				if($_GET['page'] == 't_test') include __DIR__ . '../../teacher/index.php'; 
				if($_GET['page'] == 's_test') include __DIR__ . '../../student/test.php'; 
				

			} else {
				include dirname(__FILE__) . '/home.php';
			}

			?>
		</div>

<!-- <?php 
$sql_m = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username' and active = '1'");
$fetch_m = mysqli_fetch_array($sql_m);

if($fetch_m['attempt'] == 0) {

} else {

?>
<script type="text/javascript">


	$(function() {
		$(window).one('mouseover',function() {
			$('.warning-msgs').fadeIn(300).fadeOut(250).fadeIn(200).fadeOut(100).fadeIn(60).fadeOut(30).fadeIn(300);
		});
	});
</script>
		<div class="warning-msgs">
			<div>Warning message</div>
		</div>

		<?php } ?> -->

	</body>
	</html>
