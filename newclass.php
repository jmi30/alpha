
	<script type="text/javascript">
		$(function() {
			$('[class*=form_box]').click(function() {
				$(this).parent().find('.tooltip').fadeOut();
			});

		});
	</script>
<div class="boxbba">

 <?php 
require_once('../config/connection.php');
 
 	$lrn = $fname = $midname = $lname = $extname = $bmonth = $bday = $byear = $gender = $street = $brgy = $city = $status = $mother_tang = $religion = $ethnicity = $dialect = $id_number = $grade_level = $school = $adviser_b = $father_fname = $father_midname = $father_lname = $mother_fname = $mother_midname = $mother_lname = $guardian_fname = $guardian_midname = $guardian_lname = $relationship = $contact = $gid = "";



 
 if(isset($_POST['submit'])) {
 
 

 $lrn = $_POST['lrn'];
 $fname = ucwords($_POST['fname']);
 $midname = ucwords($_POST['midname']);
 $lname = ucwords($_POST['lname']);
 $extname = ucwords($_POST['extname']);
 $bmonth = $_POST['bmonth'];
 $bday = $_POST['bday'];
 $byear = $_POST['byear'];
 $gender = $_POST['gender'];
 $street = ucwords($_POST['street']);
 $brgy = ucwords($_POST['brgy']);
 $city = ucwords($_POST['city']);
 $status = $_POST['status'];
 $mother_tang = ucwords($_POST['mother_tang']);
 $religion = $_POST['religion'];
 $ethnicity = ucwords($_POST['ethnicity']);
 $dialect = $_POST['dialect'];
 $id_number = $_POST['id_number'];
 $grade_level = $_POST['grade_level'];
 $school = ucwords($_POST['school']);
 $adviser_b = ucwords($_POST['adviser_b']);
 $father_fname = ucwords($_POST['father_fname']);
 $father_midname = ucwords($_POST['father_midname']);
 $father_lname = ucwords($_POST['father_lname']);
 $mother_fname = ucwords($_POST['mother_fname']);
 $mother_midname = ucwords($_POST['mother_midname']);
 $mother_lname = ucwords($_POST['mother_lname']);
 $guardian_fname = ucwords($_POST['guardian_fname']);
 $guardian_midname = ucwords($_POST['guardian_midname']);
 $guardian_lname = ucwords($_POST['guardian_lname']);
 $relationship = $_POST['relationship'];
 $contact = $_POST['contact'];
 $date = date('M d, Y');
 $time = date('H:m:s');
 date_default_timezone_set('Asia/Manila');
 $y = date('Y');
$i = $y.'0000';
$sy = $y+1;
$name = $fname.' '.$midname.' '.$lname.' '.$extname;
$keyword = $lrn.$fname.$midname.$lname.$extname.$grade.$class.$street.$brgy.$city;
$up = strtolower($fname.substr($lrn, 7));

$sql_check = mysqli_query($connection, "SELECT *, concat(fname,' ',midname,' ',lname,' ',extname) as sname FROM students WHERE LRN = '$lrn'");
$sql_check2 = mysqli_query($connection, "SELECT *, concat(fname,' ',midname,' ',lname,' ',extname) as sname FROM students");
$fetch_check = mysqli_fetch_array($sql_check2);
 
 	/*if(!$grade || !$lrn || !$fname || !$midname || !$lname || !$bmonth || !$bday || !$byear || !$gender || !$street || !$brgy || !$city || !$status || !$mother_tang || !$religion || !$ethnicity || !$dialect || !$id_number || !$grade_level || !$school || !$adviser_b || !$father_fname || !$father_midname || !$father_lname || !$mother_fname || !$mother_midname || !$mother_lname || !$guardian_fname || !$guardian_midname || !$guardian_lname || !$relationship) {*/
 
 		
		if(!$lrn) {
 			?><script>$(function() {$($('input[name=lrn]')).css('border','1px solid red');
 				$('.err_lrn').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
 		} else if(strlen($lrn) < 12) { 
 			?><script>$(function() {$($('input[name=lrn]')).css('border','1px solid red');
 				$('.err_lrn').show().text('Incomplete LRN');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);
 		});</script><?php
 		} else if (!$fname) {
 			?><script>$(function() {$($('input[name=fname]')).css('border','1px solid red');
 				$('.err_fn').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-60}, 1000);});</script><?php
 		} else if(!$midname) {
 			?><script>$(function() {$($('input[name=midname]')).css('border','1px solid red');
 				$('.err_mn').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-60}, 1000);});</script><?php
 		} else if(!$lname) {
 			?><script>$(function() {$($('input[name=lname]')).css('border','1px solid red');
 				$('.err_ln').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-60}, 1000);});</script><?php
 		} else if(!$bmonth) {
 			?><script>$(function() {$($('select[name=bmonth]')).css('border','1px solid red');
 				$('.err_bmonth').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$bday) {
 			?><script>$(function() {$($('select[name=bday]')).css('border','1px solid red');
 				$('.err_bday').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$byear) {
 			?><script>$(function() {$($('input[name=byear]')).css('border','1px solid red');
 				$('.err_byear').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(strlen($byear) <= 3 || $byear < 1950 || $byear > 2018) {
 			?><script>$(function() {$($('input[name=byear]')).css('border','1px solid red');
 				$('.err_byear').show().text('Birthyear is not valid');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);
 		});</script><?php

 		} else if(!$gender) {
 			?><script>$(function() {$($('select[name=gender]')).css('border','1px solid red');
 				$('.err_gender').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$street) {
 			?><script>$(function() {$($('input[name=street]')).css('border','1px solid red');
 				$('.err_st').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$brgy) {
 			?><script>$(function() {$($('input[name=brgy]')).css('border','1px solid red');
 				$('.err_brgy').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$city) {
 			?><script>$(function() {$($('input[name=city]')).css('border','1px solid red');
 				$('.err_city').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$status) {
 			?><script>$(function() {$($('select[name=status]')).css('border','1px solid red');
 				$('.err_status').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top}, 1000);});</script><?php
 		} else if(!$mother_tang) {
 			?><script>$(function() {$($('input[name=mother_tang]')).css('border','1px solid red');
 				$('.err_tang').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel3').offset().top-140}, 1000);});</script><?php
 		} else if(!$religion) {
 			?><script>$(function() {$($('select[name=religion]')).css('border','1px solid red');
 				$('.err_reli').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel3').offset().top-140}, 1000);});</script><?php
 		} else if(!$ethnicity) {
 			?><script>$(function() {$($('input[name=ethnicity]')).css('border','1px solid red');
 				$('.err_eth').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel3').offset().top-140}, 1000);});</script><?php
 		} else if(!$dialect) {
 			?><script>$(function() {$($('select[name=dialect]')).css('border','1px solid red');
 				$('.err_dialect').show().text('Select one');
 				$('html, body').animate({ scrollTop: $('#rel3').offset().top-140}, 1000);});</script><?php
 		} else if(!$id_number) {
 			?><script>$(function() {$($('input[name=id_number]')).css('border','1px solid red');
 				$('.err_id').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$grade_level) {
 			?><script>$(function() {$($('input[name=grade_level]')).css('border','1px solid red');
 				$('.err_level').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$school) {
 			?><script>$(function() {$($('input[name=school]')).css('border','1px solid red');
 				$('.err_sch').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$adviser_b) {
 			?><script>$(function() {$($('input[name=adviser_b]')).css('border','1px solid red');
 				$('.err_adv').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$father_fname) {
 			?><script>$(function() {$($('input[name=father_fname]')).css('border','1px solid red');
 				$('.err_ff').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$father_midname) {
 			?><script>$(function() {$($('input[name=father_midname]')).css('border','1px solid red');
 				$('.err_fm').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$father_lname) {
 			?><script>$(function() {$($('input[name=father_lname]')).css('border','1px solid red');
 				$('.err_fl').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$mother_fname) {
 			?><script>$(function() {$($('input[name=mother_fname]')).css('border','1px solid red');
 				$('.err_mf').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$mother_midname) {
 			?><script>$(function() {$($('input[name=mother_midname]')).css('border','1px solid red');
 				$('.err_mm').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$mother_lname) {
 			?><script>$(function() {$($('input[name=mother_lname]')).css('border','1px solid red');
 				$('.err_ml').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$guardian_fname) {
 			?><script>$(function() {$($('input[name=guardian_fname]')).css('border','1px solid red');
 				$('.err_gf').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$guardian_midname) {
 			?><script>$(function() {$($('input[name=guardian_midname]')).css('border','1px solid red');
 				$('.err_gm').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$guardian_lname) {
 			?><script>$(function() {$($('input[name=guardian_lname]')).css('border','1px solid red');
 				$('.err_gl').show().text('Empty field');
 				$('html, body').animate({ scrollTop: $('#rel2').offset().top}, 1000);});</script><?php
 		} else if(!$relationship) {
 			?><script>$(function() {$($('select[name=relationship]')).css('border','1px solid red');
 				$('.err_rel').show().text('Select one');
 			$('html, body').animate({ scrollTop: $('#rel').offset().top}, 1000);
 		});</script><?php
 		} else if(!$contact) {
 			?><script>$(function() {$($('select[name=contact]')).css('border','1px solid red');
 				$('.err_con').show().text('Empty field');
 			$('html, body').animate({ scrollTop: $('#rel').offset().top}, 1000);
 		});</script><?php
 		} else if(strlen($contact) < 10) {
 			?><script>$(function() {$($('select[name=contact]')).css('border','1px solid red');
 				$('.err_con').show().text('Incomplete Contact Number');
 			$('html, body').animate({ scrollTop: $('#rel').offset().top}, 1000);
 		});</script><?php
 		} else if(mysqli_num_rows($sql_check) == 1) {
 			?><script>$(function() {$($('input[name=lrn]')).css('border','1px solid red');
 				$('.err_lrn').show().text('LRN already exist');
 				$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);
 		});</script><?php
 		} else {



/*
mysqli_query($connection, "INSERT INTO students VALUES ('','$gr','$class','$sy','',$fname','$midname','$lname','$extname','$bmonth','$bday','$byear','$gender','$street','$brgy','$city','$status','$mother_tang','$religion','$ethnicity','$dialect','$id_number','$grade_level','$school','$adviser_b','$father_fname','$father_midname','$father_lname','mother_fname','mother_midname','mother_lname','guardian_fname','$guardian_midname','$guardian_lname','$relationship','$contact','$date','$time','$up','$up','$username')") or die(mysqli_error());*/

mysqli_query($connection, "INSERT INTO students VALUES ('','$gr','$class','2018-2019','','$lrn','$fname','$midname','$lname','$extname','$bmonth','$bday','$byear','$gender','$street','$brgy','$city','$status','$mother_tang','$religion','$ethnicity','$dialect','$id_number','$grade_level','$school','$adviser_b','$father_fname','$father_midname','$father_lname','$mother_fname','$mother_midname','$mother_lname','$guardian_fname','$guardian_midname','$guardian_lname','$relationship','$contact','$date','$time','$up','$up','student','$username','$keyword')") or die(mysqli_error());

mysqli_query($connection, "UPDATE class_tbl SET status = 'confirmed' where id = '$cid'") or die(mysqli_error());
 			/*echo "<div class='success'>Learner Enrolled</div>";*/

 			?>

  			<script>$(function() {
  				$('.mask').fadeIn(function() {
            var name = '<?php echo $name ?>',
                  up = '<?php echo $up ?>',
                type = 'student',
                cid = '<?php echo $cid ?>';
 
  				success(name,up,type,cid);
        });
          $('body').css('overflow','hidden');
        });

/* $('.btnn').click(function() {
 	var idid = $(this).attr('id');
 	$('.v').animate({marginTop:-250},600,function() {
 		$('.mask').fadeOut();
 		$(':input','#myform')
  .not(':button, :submit, :reset, :hidden')
  .val('')
  .removeAttr('checked')
  .removeAttr('selected');
  $('body').css('overflow','auto');
  var recad = $('.recent_added');
  var neg = $('.negative'),
  	  reca = $('.reca');
  	  

  	reca.prepend("<div class='rr2'><?php echo $name; ?><img class='remove' data-name='<?php echo $name; ?>' id='"+r+"' src='../img/icons/icon.png'></div>").fadeIn();

  	  $.ajax({
  	  	url: 'checkid.php',
  	  	type: 'GET',
  	  	data: {idid:idid},
  	  	success: function(r) {
  	  		neg.hide();

  	  	reca.prepend("<div class='rr2'><?php echo $name; ?><img class='remove' data-name='<?php echo $name; ?>' id='"+r+"' src='../img/icons/icon.png'></div>").fadeIn();


		remove();

  	  	}
  	  });*/




  		
/*function remove() {

$('.remove').click(function(e) {
  var sid = $(this).attr('id'),
      name = $(this).attr('data-name');

 var xx = e.clientX-130,
     yy = e.clientY+20;



     var fin = $(this).parents('.recent_added').next().show().animate({top:(yy)+'px',left:(xx)+'px'},300,function() {
     	$(this).removeAttr('style');
      var ttdel = $(this);
      $('.sn').html("<b id='"+sid+"'>"+name+"</b>");
      $('.sn1').html("<?php echo $grade;?> &mdash; <?php echo $class ?>");
      $('.btn').attr("id",sid);

$('.btn_no').click(function() {
 ttdel.fadeOut();
});

$('.btn').click(function() {
  var studid = $(this).attr('id'),
      rem = $(this).parents('.ttdel').siblings('.recent_added').find('div#'+studid);
      $.ajax({
    url: 'delete_record.php',
    type: 'GET',
    data: {studid:studid},
    success: function(html) {
      if(html.indexOf('success') > -1) {
        rem.remove();
        $('.hh1').css('background-color','limegreen').text("Success");
        $('.fc,.flex').slideUp();
        $('.ttdel').delay(1000).fadeOut(200,function() {
          $('.hh1').css('background-color','orangered').text("Delete");
        $('.fc,.flex').slideDown();
        fin.removeAttr('style');
        });
      }

     

    }

  });


});

     });
*/



/*$('.ttdel').fadeIn().animate({top:"32%"},800, function() {*/



/*  $(document).click(function() {
   $('.ttdel').animate({top:"29%"},800).fadeOut();
});
$('.ttdel').click(function(e) {
    e.stopPropagation(); // This is the preferred method.
    return false;        // This should not be used unless you do not want
                         // any click events registering inside the div
});*/


/*});*/





/*});
}


	
  




 	});
 	 
 });
 
  			
  				});
  				
  				
 
  			});*/
  			</script> <?php
 		
 
 		
 
 		
 }
 	 
 			}
 
 
 
 
 
 ?> 






			<form method="POST" action="" id="myform">
			

			<div class="label7" id="rel4">Basic Profile</div>

			
			<!-- 	<div class="ag ha">
			
					<div class="form_label">Grade</div> 
				<input type="text" class="form_box1" name="grade" maxlength="2" size="10" 
				value="<?php echo $grade; ?>">
			
				<div class="tooltip"><span class="tooltiptext err_grade"></span></div>
			</div> -->

				<div class="ag">
				<div class="form_label">LRN</div>
				<input type="text" class="form_box1" name="lrn" size="50" maxlength="12" value="<?php echo $lrn; ?>"><div class="tooltip"><span class="tooltiptext err_lrn"></span></div>
				</div>
			
			<div class="ag">
				<div class="form_label">Name</div> 
				<input type="text" class="form_box1" name="fname" placeholder="First Name" size="30" value="<?php echo $fname; ?>"><div class="tooltip"><span class="tooltiptext err_fn"></span></div>
				<input type="text" class="form_box2" name="midname" placeholder="Middle Name" size="30" value="<?php echo $midname; ?>"><div class="tooltip"><span class="tooltiptext err_mn"></span></div>
				<input type="text" class="form_box2" name="lname" placeholder="Last Name" size="30" value="<?php echo $lname; ?>"><div class="tooltip"><span class="tooltiptext err_ln"></span></div>
				<input type="text" class="form_box2" name="extname" placeholder="Ext Name" size="10" value="<?php echo $extname; ?>">
			</div>

			<div class="ag">
				
				<div class="form_label">Birth Date</div>
				<select name="bmonth" class="form_box1">
					<option value="">Month</option>
					<option value="Jan" <?php if(isset($bmonth) && $bmonth == "Jan") echo "selected";?>>Jan</option>
					<option value="Feb" <?php if(isset($bmonth) && $bmonth == "Feb") echo "selected";?>>Feb</option>
					<option value="Mar" <?php if(isset($bmonth) && $bmonth == "Mar") echo "selected";?>>Mar</option>
					<option value="Apr" <?php if(isset($bmonth) && $bmonth == "Apr") echo "selected";?>>Apr</option>
					<option value="May" <?php if(isset($bmonth) && $bmonth == "May") echo "selected";?>>May</option>
					<option value="Jun" <?php if(isset($bmonth) && $bmonth == "Jun") echo "selected";?>>Jun</option>
					<option value="Jul" <?php if(isset($bmonth) && $bmonth == "Jul") echo "selected";?>>Jul</option>
					<option value="Aug" <?php if(isset($bmonth) && $bmonth == "Aug") echo "selected";?>>Aug</option>
					<option value="Sep" <?php if(isset($bmonth) && $bmonth == "Sep") echo "selected";?>>Sep</option>
					<option value="Oct" <?php if(isset($bmonth) && $bmonth == "Oct") echo "selected";?>>Oct</option>
					<option value="Nov" <?php if(isset($bmonth) && $bmonth == "Nov") echo "selected";?>>Nov</option>
					<option value="Dec" <?php if(isset($bmonth) && $bmonth == "Dec") echo "selected";?>>Dec</option>
				</select><div class="tooltip"><span class="tooltiptext err_bmonth"></span></div>

				<select name="bday" class="form_box2">
					<option value="">Day</option>
					<?php 
							for ($day=1; $day <= 31; $day++) { 

								?>

								<option value="<?php echo $day; ?>" <?php if(isset($bday) && $bday == $day) echo "selected";?>><?php echo $day; ?></option>

								<?php 

							}
							?>
					
				</select><div class="tooltip"><span class="tooltiptext err_bday"></span></div>

				<input type="text" class="form_box2" name="byear" placeholder="Year" size="10" maxlength="4" value="<?php echo $byear; ?>"> 
				<div class="tooltip"><span class="tooltiptext err_byear"></span></div>
				
			</div> <!-- end of .ag -->

					<div class="ag">
					<div class="form_label">Gender</div> 
					<select name="gender" class="form_box1">
						<option value="">Gender</option>
						<option value="Male" <?php if(isset($gender) && $gender == "Male") echo "selected"; ?>>Male</option>
						<option value="Female" <?php if(isset($gender) && $gender == "Female") echo "selected"; ?>>Female</option>
					</select><div class="tooltip"><span class="tooltiptext err_gender"></span></div>
					</div>

				

				<div class="ag">
				<div class="form_label">Address</div> 
				<input type="text" class="form_box1" name="street" placeholder="Street Name and No. / Purok" size="30" value="<?php echo $street; ?>"><div class="tooltip"><span class="tooltiptext err_st"></span></div>
				<input type="text" class="form_box2" name="brgy" placeholder="Barangay" size="30" value="<?php echo $brgy; ?>"><div class="tooltip"><span class="tooltiptext err_brgy"></span></div>
				<input type="text" class="form_box2" name="city" placeholder="City" size="30" value="<?php echo $city; ?>"><div class="tooltip"><span class="tooltiptext err_city"></span></div>
				</div>

				<div class="ag">
				<div class="form_label">Status</div> 
				<select name="status" class="form_box1">
						<option value="">Status</option>
						<option value="reg" <?php if(isset($status) && $status == "reg") echo "selected"; ?>>Regular</option>
						<option value="trans" <?php if(isset($status) && $status == "trans") echo "selected"; ?>>Transferee</option>
						<option value="balik" <?php if(isset($status) && $status == "balik") echo "selected"; ?>>Balik-Aral</option>
						<option value="repeat" <?php if(isset($status) && $status == "repeat") echo "selected"; ?>>Repeater</option>
					</select> <div class="tooltip"><span class="tooltiptext err_status"></span></div>
				</div>
</div>
<div class="boxbba">
				<div class="label7" id="rel3">Other Details</div>

				
				<div class="ag">
				<div class="form_label">Mother Tongue</div> <input type="text" class="form_box1" name="mother_tang" size="30" value="<?php echo $mother_tang;?>"><div class="tooltip"><span class="tooltiptext err_tang"></span></div>
				</div>
				<div class="ag">
				<div class="form_label">Religion</div> <!-- <input type="text" class="form_box9" name="religion" size="30" value="<?php echo $religion; ?>"> -->
				<select name="religion" class="form_box1">
					<option value="">Religion</option>
					<option value="Buddhism" <?php if(isset($religion) && $religion == "Buddhism") echo "selected"; ?>>Buddhism</option>
					<option value="Catholic" <?php if(isset($religion) && $religion == "Catholic") echo "selected"; ?>>Catholic</option>
					<option value="El Shadai" <?php if(isset($religion) && $religion == "El Shadai") echo "selected"; ?>>El Shadia</option>
					<option value="Orthodox Church" <?php if(isset($religion) && $religion == "Orthodox Church") echo "selected"; ?>>Orthodox Church</option>
					<option value="Aglipayan" <?php if(isset($religion) && $religion == "Aglipayan") echo "selected"; ?>>Aglipayan</option>
					<option value="Apostolic" <?php if(isset($religion) && $religion == "Apostolic") echo "selected"; ?>>Apostolic</option>
					<option value="Iglesia ni Cristo" <?php if(isset($religion) && $religion == "Iglesia ni Cristo") echo "selected"; ?>>Iglesia ni Cristo</option>
					<option value="Muslim" <?php if(isset($religion) && $religion == "Muslim") echo "selected"; ?>>Muslim</option>
					<option value="Angilican" <?php if(isset($religion) && $religion == "Angilican") echo "selected"; ?>>Angilican</option>
					<option value="Baptist" <?php if(isset($religion) && $religion == "Baptist") echo "selected"; ?>>Baptist</option>
					<option value="Full Gospel" <?php if(isset($religion) && $religion == "Full Gospel") echo "selected"; ?>>Full Gospel</option>
					<option value="Lutheran" <?php if(isset($religion) && $religion == "Lutheran") echo "selected"; ?>>Lutheran</option>
					<option value="Methodist" <?php if(isset($religion) && $religion == "Methodist") echo "selected"; ?>>Methodist</option>
					<option value="Pentecostal" <?php if(isset($religion) && $religion == "Pentecostal") echo "selected"; ?>>Petecostal</option>
					<option value="Presbyterian" <?php if(isset($religion) && $religion == "Presbyterian") echo "selected"; ?>>Presbyterian</option>
					<option value="Christ Latter Day Siants" <?php if(isset($religion) && $religion == "Christ Latter Day Siants") echo "selected"; ?>>Christ Latter Day Siants</option>
					<option value="Church of God in Jesus Christ" <?php if(isset($religion) && $religion == "Church of God in Jesus Christ") echo "selected"; ?>>Church of God 	International</option>
					<option value="Jehovah Witnesses" <?php if(isset($religion) && $religion == "Jehovah Witnesses") echo "selected"; ?>>Jehovah Witnesses</option>
					<option value="Kingdom of Jesus Christ" <?php if(isset($religion) && $religion == "Kingdom of Jesus Christ") echo "selected"; ?>>Kingdom of Jesus Christ</option>
					<option value="Seventh Day Adventist" <?php if(isset($religion) && $religion == "Seventh Day Adventist") echo "selected"; ?>>Seventh Day Adventist</option>
				</select> <div class="tooltip"><span class="tooltiptext err_reli"></span></div>
				</div>
				

		
				<div class="ag">
				<div class="form_label">Ethnicity</div> <input type="text" class="form_box1" name="ethnicity" size="30" value="<?php echo $ethnicity ?>"><div class="tooltip"><span class="tooltiptext err_eth"></span></div>
				</div>
				<div class="ag">
				<div class="form_label">Dialect</div> <!-- <input type="text" class="form_box8" name="dialect" size="30" value="<?php echo $dialect; ?>"> -->

				<select name="dialect" class="form_box1">
					<option value="">Dialect</option>
					<option value="Bikol" <?php if(isset($dialect) && $dialect == "Bikol") echo "selected"; ?>>Bikol</option>
					<option value="Cebuano" <?php if(isset($dialect) && $dialect == "Cebuano") echo "selected"; ?>>Cebuano</option>
					<option value="Chabacano" <?php if(isset($dialect) && $dialect == "Chabacano") echo "selected"; ?>>Chabacano</option>
					<option value="Hiligaynon" <?php if(isset($dialect) && $dialect == "Hiligaynon") echo "selected"; ?>>Hiligaynon</option>
					<option value="Iloko" <?php if(isset($dialect) && $dialect == "Iloko") echo "selected"; ?>>Iloko</option>
					<option value="Kapampangan" <?php if(isset($dialect) && $dialect == "Kapampangan") echo "selected"; ?>>Kapampangan</option>
					<option value="Maguindanaoan" <?php if(isset($dialect) && $dialect == "Maguindanaoan") echo "selected"; ?>>Maguindanaoan</option>
					<option value="Maranaw" <?php if(isset($dialect) && $dialect == "Maranaw") echo "selected"; ?>>Maranaw</option>
					<option value="Pangasinense" <?php if(isset($dialect) && $dialect == "Pangasinense") echo "selected"; ?>>Pangasinense</option>
					<option value="Tagalog" <?php if(isset($dialect) && $dialect == "Tagalog") echo "selected"; ?>>Tagalog</option>
					<option value="Tausog" <?php if(isset($dialect) && $dialect == "Tausog") echo "selected"; ?>>Tausog</option>
					<option value="Waray" <?php if(isset($dialect) && $dialect == "Waray") echo "selected"; ?>>Waray</option>
				</select><div class="tooltip"><span class="tooltiptext err_dialect"></span></div>
				</div>
			
</div>
<div class="boxbba" id="rel2">

			<div class="label7">Enrolment Profile / Previous Enrolment</div>

			
				<div class="ag">
				<div class="form_label">School ID No.</div> <input type="text" class="form_box1" name="id_number" size="30" value="<?php echo $id_number; ?>"><div class="tooltip"><span class="tooltiptext err_id"></span></div>
				</div>
				<div class="ag">
				<div class="form_label">Grade Level</div><input type="text" class="form_box1" name="grade_level" size="30" value="<?php echo $grade_level; ?>"><div class="tooltip"><span class="tooltiptext err_level"></span></div>
				</div>
			
			
			<div class="ag">
				<div class="form_label">Name of School</div> 
				<input type="text" class="form_box1" name="school" size="100" value="<?php echo $school; ?>">
				<div class="tooltip"><span class="tooltiptext err_sch"></span></div>
			</div>
			<div class="ag">
				<div class="form_label">Name of Adviser</div> 
				<input type="text" class="form_box1" name="adviser_b" size="50" value="<?php echo $adviser_b; ?>">
				<div class="tooltip"><span class="tooltiptext err_adv"></span></div>
			</div>

		</div>
<div class="boxbba">
<div class="label7" id="rel">Parent's / Guardian Information</div>

<div class="ag">
				<div class="form_label">Father's Name</div> 
				<input type="text" class="form_box1" name="father_fname" placeholder="First Name" size="25" value="<?php echo $father_fname; ?>"><div class="tooltip"><span class="tooltiptext err_ff"></span></div>
				<input type="text" class="form_box2" name="father_midname" placeholder="Middle Name" size="25" value="<?php echo $father_midname; ?>"><div class="tooltip"><span class="tooltiptext err_fm"></span></div>
				<input type="text" class="form_box2" name="father_lname" placeholder="Family Name" size="25" value="<?php echo $father_lname; ?>"><div class="tooltip"><span class="tooltiptext err_fl"></span></div>
			</div>

			<div class="ag">
				<div class="form_label">Mother's Maiden Name</div> 
				<input type="text" class="form_box1" name="mother_fname" placeholder="First Name" size="25" value="<?php echo $mother_fname; ?>"><div class="tooltip"><span class="tooltiptext err_mf"></span></div>
				<input type="text" class="form_box2" name="mother_midname" placeholder="Middle Name" size="25" value="<?php echo $mother_midname; ?>"><div class="tooltip"><span class="tooltiptext err_mm"></span></div>
				<input type="text" class="form_box2" name="mother_lname" placeholder="Family Name" size="25" value="<?php echo $mother_lname; ?>"><div class="tooltip"><span class="tooltiptext err_ml"></span></div>
			</div>

			<div class="ag">
				<div class="form_label">Guardian Name</div> 
				<input type="text" class="form_box1" name="guardian_fname" placeholder="First Name" size="25" value="<?php echo $guardian_fname; ?>"><div class="tooltip"><span class="tooltiptext err_gf"></span></div>
				<input type="text" class="form_box2" name="guardian_midname" placeholder="Middle Name" size="25" value="<?php echo $guardian_midname; ?>"><div class="tooltip"><span class="tooltiptext err_gm"></span></div>
				<input type="text" class="form_box2" name="guardian_lname" placeholder="Family Name" size="25" value="<?php echo $guardian_lname ?>"><div class="tooltip"><span class="tooltiptext err_gl"></span></div>
				<!-- <input type="text" class="form_box2" name="relationship" placeholder="Relationship" size="25" value="<?php echo $relationship ?>">
								 -->				
				<select name="relationship" class="form_box2">
					<option value="">Relationship</option>
					<option value="Nanny" <?php if(isset($relationship) && $relationship == 'Nanny') echo "selected"; ?>>Nanny</option>
					<option value="Cousin" <?php if(isset($relationship) && $relationship == 'Cousin') echo "selected"; ?>>Cousin</option>
					<option value="Auntie" <?php if(isset($relationship) && $relationship == 'Auntie') echo "selected"; ?>>Auntie</option>
					<option value="Uncle" <?php if(isset($relationship) && $relationship == 'Uncle') echo "selected"; ?>>Uncle</option>
					<option value="Sibling" <?php if(isset($relationship) && $relationship == 'Sibling') echo "selected"; ?>>Sibling</option>
					<option value="Parent" <?php if(isset($relationship) && $relationship == 'Parent') echo "selected"; ?>>Parent</option>
					<option value="Stepparent" <?php if(isset($relationship) && $relationship == 'Stepparent') echo "selected"; ?>>Stepparent</option>
					<option value="Grandparent" <?php if(isset($relationship) && $relationship == 'Grandparent') echo "selected"; ?>>Grandparent</option>
					
				</select><div class="tooltip"><span class="tooltiptextleft err_rel"></span></div>
			</div>

			<div class="ag">
				<div class="form_label">Contact No.</div> <input type="text" class="form_box1" name="contact" placeholder="+63" size="25" maxlength="10" value="<?php echo $contact; ?>"><div class="tooltip"><span class="tooltiptext err_con"></span></div>
				</div>



			<div class="ag">
        <div class="form_label"></div>
				<input type="submit" class="submit" name="submit" value="Submit">
				<input type="reset" class="false_btn" name="reset" value="Reset">
			
			</div>
			
			

		</form>
				
</div>

