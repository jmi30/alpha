<?php 
session_start();
require_once('../config/connection.php');
require_once('../session/session.php');

date_default_timezone_set('Asia/Manila');

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql_v = mysqli_query($connection, "SELECT *, concat(fname,' ',lname) as name FROM teacher WHERE id = '$id'");
	$fetch_v = mysqli_fetch_array($sql_v);
	?>

	
				<div class="tp-heading">Teacher's Information</div>
				<div class="tp-cont">
					<img class="tp-pic" src="../img/icons/man.png">
					<div class="tp-dis">
						<div class="tp-name"><?php echo $fetch_v['ins_id']; ?></div>
						<small>ID Number</small>
					</div>
					<div class="tp-dis">
						<div class="tp-name"><?php if($fetch_v['gender'] == "Male") echo 'Mr. '; else echo 'Ms. '; echo $fetch_v['name'];?> </div>
						<small>Name</small>
					</div>
					<div class="tp-dis">
						<div class="tp-name"><?php echo $fetch_v['dept']; ?></div>
						<small>Department</small>
					</div>
					<div class="tp-dis">
						<div class="tp-name"><?php echo $fetch_v['ethnicity']; ?></div>
						<small>Ethnicity</small>
					</div>
					<div class="tp-dis">
						<div class="tp-name"><?php echo $fetch_v['dialect']; ?></div>
						<small>Dialect</small>
					</div>
					<div class="tp-dis">
						<div class="tp-name"><?php echo $fetch_v['religion']; ?></div>
						<small>Religion</small>
					</div>
				</div>
			

	<?php
exit;
} if(isset($_GET['g']) && isset($_GET['s'])) {
	$g = 'Grade '.$_GET['g'];
	$s = $_GET['s'];
	$sql = mysqli_query($connection, "SELECT * FROM class_tbl WHERE class_name = '$s' and grade = '$g'");
	$f = mysqli_fetch_array($sql);
	$cid = $f['id'];
	header("location: index.php?page=enrolment&page2=view_enrolment&cid=$cid");
	exit;
} if(isset($_POST['g1']) && isset($_POST['s1']) && isset($_POST['adv'])) {
	$g1 =  $_POST['g1'];
	$s1 =  $_POST['s1'];
	$adv =  $_POST['adv'];
/*
	$sql_x = mysqli_query($connection, "SELECT * FROM class_tbl WHERE class_name = '$s1' and grade = '$g1'");
	$fetch_x = mysqli_fetch_array($sql_x);
	echo "";*/

$sql_v1 = mysqli_query($connection, "SELECT *, concat(fname,' ',lname) as name FROM teacher WHERE id = '$adv'");
	$fetch_v1 = mysqli_fetch_array($sql_v1);
	// if($fetch_v1['gender'] == "Male") { echo $gen = "Mr. "; }
	// else { echo $gen = "Ms. "; }
	$name = $fetch_v1['name'];
	
	$gen = ($fetch_v1['gender']=="Male") ? 'Mr. ' : 'Ms. ';
	$ff = $gen.$name;

	

	
	$sql_ch =  mysqli_query($connection, "SELECT * FROM teacher where id = '$adv' and assign_confirmation = '1'");
	
	if(mysqli_num_rows($sql_ch)==true) {
		echo true;
	} else {
		mysqli_query($connection, "UPDATE students SET adviser = '$ff' WHERE grade = '$g1' and section = '$s1'");
		mysqli_query($connection,  "UPDATE teacher SET assign_confirmation = '1' where id = '$adv'");
	}
	
	
	exit;
} if(isset($_GET['classid'])) {
	$id = $_GET['classid'];
	mysqli_query($connection, "DELETE FROM class_tbl WHERE id = '$id'");
	exit;
} if(isset($_GET['user'])) {
	$user1 = $_GET['user'];

	$sql = mysqli_query($connection, "SELECT * FROM history where user = '$user1' order by id desc");
	while($fetch = mysqli_fetch_array($sql)) {
		$u = $fetch['username'];
		?>
		<li class="findU" id='<?php echo $u; ?>'><a class='anc_white' href='index.php?page=students&page2=profile&u=<?php echo $u; ?>'><?php echo $fetch['name']; ?></a>
			<span class='x' title='Delete' onclick="x('<?php echo $u; ?>')">&#10006;</span></li>
		<?php
	}
	exit;
} if(isset($_POST['userid'])) {
	$userid = $_POST['userid'];
	
	$sql = mysqli_query($connection, "SELECT fname, midname, lname, extname, username, concat(fname,' ',substring(midname,1,1),'. ',lname,' ',extname) as name FROM students WHERE username = '$userid' UNION SELECT fname, midname, lname, extname, username, concat(fname,' ',substring(midname,1,1),'. ',lname,' ',extname) as name FROM teacher WHERE username = '$userid'");
	$fetch = mysqli_fetch_array($sql);
	$name = $fetch['name'];
	$u = $fetch['username'];
	mysqli_query($connection, "INSERT INTO history VALUES('','$name','$u','$user')");
	echo $name;
	exit;
} if(isset($_GET['hisUser'])) {
	$hisUser = $_GET['hisUser'];
	mysqli_query($connection, "DELETE FROM history WHERE user = '$hisUser'");
	echo "true";
	exit;
} if(isset($_GET['v'])) {
	$v = $_GET['v'];
	mysqli_query($connection, "DELETE FROM history where username = '$v'");
	exit;

} if(isset($_GET['testID'])) {
	$testID = $_GET['testID'];
	$sql_ti = mysqli_query($connection, "SELECT * FROM questions WHERE test_id = '$testID'");
	while($fetch_ti = mysqli_fetch_array($sql_ti)) {
		echo "<li class='qlist'><div class='qlist1'>".$fetch_ti['question']."</div>
		<div>
		<span class='answ'>".$fetch_ti['ans']."</span>";
		if(!$fetch_ti['ch1']) {} else { echo "<span class='choi'>".$fetch_ti['ch1']."</span>"; }
		if(!$fetch_ti['ch2']) {} else { echo "<span class='choi'>".$fetch_ti['ch2']."</span>"; }
		if(!$fetch_ti['ch3']) {} else { echo "<span class='choi'>".$fetch_ti['ch3']."</span>"; }
		
		echo "
		</div>
		<div class='qlist_nv'><a href='#'>Edit</a> | <a id='$fetch_ti[id]' class='delqlist' href='#'>Delete</a></div>
		</li>";
		?>

		<?php
	}
	
	exit;
} if(isset($_POST['testID2'])) {
	$testID2 = $_POST['testID2'];
	
	mysqli_query($connection, "UPDATE tests set status = 'available' where test_id = '$testID2'");
	echo "Your test is now available";

	exit;
} if(isset($_GET['theGrade'])) {
	$theGrade = $_GET['theGrade'];

if($theGrade=="g7") { 
  $sql_g7 = mysqli_query($connection, "SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' and grade = '7' group by grade, section HAVING COUNT(*) >= 0") or die(mysqli_error());
  echo "<option>Select section</option>";
  while($fetch_g7 = mysqli_fetch_array($sql_g7)) {
    $sec = $fetch_g7['section'];
    /*echo "<option value='$sec'>".$sec."</option>";*/
    ?> 
    <option value="<?php echo $sec; ?>" <?php if(isset($section) && $section == "$sec") echo "selected"; ?>><?php echo $sec; ?></option>
    <?php
  }
  exit;
  
} if($theGrade=="g8") { 
  $sql_g8 = mysqli_query($connection, "SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' and grade = '8' group by grade, section HAVING COUNT(*) >= 0") or die(mysqli_error());
  echo "<option>Select section</option>";
  while($fetch_g8 = mysqli_fetch_array($sql_g8)) {
    $sec = $fetch_g8['section'];
    echo "<option>".$sec."</option>";
  }
  
} if($theGrade=="g9") { 
  $sql_g9 = mysqli_query($connection, "SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' and grade = '9' group by grade, section HAVING COUNT(*) >= 0") or die(mysqli_error());
  
  echo "<option>Select section</option>";
  while($fetch_g9 = mysqli_fetch_array($sql_g9)) {
    $sec = $fetch_g9['section'];
    echo "<option>".$sec."</option>";
  }
  
} if($theGrade=="g10") { 
  $sql_g10 = mysqli_query($connection, "SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' and grade = '10' group by grade, section HAVING COUNT(*) >= 0") or die(mysqli_error());
  echo "<option>Select section</option>";
  while($fetch_g10 = mysqli_fetch_array($sql_g10)) {
    $sec = $fetch_g10['section'];
    echo "<option>".$sec."</option>";
  }
  
} if($theGrade=="empty") {
  echo "<option>err</option>";
}

		
	exit;
}

if(isset($_GET['qid'])) {
	$qid = $_GET['qid'];
	mysqli_query($connection, "DELETE from teacher WHERE ins_id = '$qid'");
	exit;
}

 if(isset($_POST['test_desc'])) {

/*$category2 = $noofq2 = $category3 = $noofq3 = $category4 = $noofq4 = $category5 = $noofq5 = "";*/
error_reporting(0);

 	$test_desc = mysqli_real_escape_string($connection, $_POST['test_desc']);
 	$grade = mysqli_real_escape_string($connection, $_POST['grade']);
 	$section = mysqli_real_escape_string($connection, $_POST['section']);
 	$subject = mysqli_real_escape_string($connection, $_POST['subject']);

 	$category = mysqli_real_escape_string($connection, $_POST['category']);
 	$noofq = mysqli_real_escape_string($connection, $_POST['noofq']);
 	$category2 = mysqli_real_escape_string($connection, $_POST['category2']);
 	$noofq2 = mysqli_real_escape_string($connection, $_POST['noofq2']);
 	$category3 = mysqli_real_escape_string($connection, $_POST['category3']);
 	$noofq3 = mysqli_real_escape_string($connection, $_POST['noofq3']);
 	$category4 = mysqli_real_escape_string($connection, $_POST['category4']);
 	$noofq4 = mysqli_real_escape_string($connection, $_POST['noofq4']);
 	$category5 = mysqli_real_escape_string($connection, $_POST['category5']);
 	$noofq5 = mysqli_real_escape_string($connection, $_POST['noofq5']);

 	/*echo $category.$category2.$category3.$category4.$category5;*/

 	$hour = mysqli_real_escape_string($connection, $_POST['hour']);
 	$minute = mysqli_real_escape_string($connection, $_POST['minute']);
 	$publish_date = mysqli_real_escape_string($connection, $_POST['publish_date']);
 	$phour = mysqli_real_escape_string($connection, $_POST['phour']);
 	$pminute = mysqli_real_escape_string($connection, $_POST['pminute']);
 	$meridiem = mysqli_real_escape_string($connection, $_POST['meridiem']);

 	$now = date('Y-m-d');
 	$test_id = bin2hex($test_desc);

 	mysqli_query($connection, "INSERT INTO tests VALUES('', '$test_id', '$test_desc', '$grade', '$section', '$subject', '$category', '$noofq', '$category2', '$noofq2', '$category3', '$noofq3', '$category4', '$noofq4', '$category5', '$noofq5', '$hour:$minute', '$publish_date', '$now', '', '$user')") or die(mysqli_error());
 	echo $test_id;
 	

 	exit;
 } if(isset($_GET['category'])) {
 	$categ = $_GET['category'];
 	if($categ == "Multiple Choice") {
 		echo $categ;
 	} if($categ == "True or False") {
 		echo $categ;
 	} if($categ == "Fill in the blank") {
 		echo $categ;
 	} if($categ == "Set A & B") {
 		echo $categ;
 	} if($categ == "Essay") {
 		echo $categ;
 	}
 }

exit;




?>

<script type="text/javascript">
function x(v) {
	$.ajax({
		url: 'bridge.php',
		type: 'get',
		data: { v:v },
		success: function() {
			$("li#"+v).each(function() {
				$(this).fadeOut();
			})
		}
	});
}



</script>