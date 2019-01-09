<script type="text/javascript">
	$(function() {
		$('.form_box1, .form_box2').click(function() {
			$('.tooltip').fadeOut();
			$(this).css('border','1px solid rgba(0,0,0,0.14)');
		});
	});
</script>
<div class="wrapper_box">
	<div class="boxa1">
		<div class="pa">Create Test</div>
	</div>

	<?php if(isset($_GET['testID'])) { 
		$testID = $_GET['testID'];
		$sql_z = mysql_query("SELECT * FROM tests WHERE test_id = '$testID'");
		$fetch_z = mysql_fetch_array($sql_z);
		?>
		<div id="<?php echo $testID; ?>" class="h1"><?php echo $fetch_z['test_desc']; ?></div>
		<div><b>To:</b> <?php echo $fetch_z['grade'] ." &mdash; ". $fetch_z['section']; ?></div>
		<div><b>Time Limit:</b> <?php echo $fetch_z['time_limit']; ?></div>
		<input type="hidden" id='hidden_id' value="<?php echo $testID; ?>">
		<ul class="nav-category">
			<?php
			echo '<li id="lc1" class="list-category actibo" data-category="'.$fetch_z['category'].'">'.$fetch_z['category'].'<small id="numQtty" class="qtty">'.$fetch_z['noofq'].'</small></li>'; 
			echo '<li class="list-category" data-category="'.$fetch_z['category2'].'">'.$fetch_z['category2'].'<small class="qtty">'.$fetch_z['noofq2'].'</small></li>';
			echo '<li class="list-category" data-category="'.$fetch_z['category3'].'">'.$fetch_z['category3'].'<small class="qtty">'.$fetch_z['noofq3'].'</small></li>';
			echo '<li class="list-category" data-category="'.$fetch_z['category4'].'">'.$fetch_z['category4'].'<small class="qtty">'.$fetch_z['noofq4'].'</small></li>';
			echo '<li class="list-category" data-category="'.$fetch_z['category5'].'">'.$fetch_z['category5'].'<small class="qtty">'.$fetch_z['noofq5'].'</small></li>';

			?>

		</ul>
		<div class="test-col">
			<div class="test-wrapper">
				<div class="done-test-wrapper">
					<!-- <div class="test-container">
						<div class="test-num-done"></div>
						<div class="test-content">
							<div class="test-question"></div>
							<ul class="test-choices">
								<li>Choice a</li>
								<li>Choice b</li>
								<li>Choice c</li>
								<li>Choice d</li>
							</ul>
						</div>
					</div> -->
				</div>
		<ul class="mylist"></ul>
		
		<!-- s<div class="label7">Question no. 1</div> -->

		<div class="test-panel multiple-choice" style="display: none;">

			<!-- <div class="tp">
				<div class="test-num">1.</div>
			</div>
			<div class="tp1">
				<textarea name="question" id="ta" class="test-box" placeholder="Question"></textarea>
				<textarea name="answer" id="ta" class="test-box ans" placeholder="Answer"></textarea>
				<div class="test-btn-nav">
					<div class="add-field add-c">Add Choices</div>
					<button class="submit nextQuestion">Next</button>
				</div>
			</div> -->
		</div>

		<div class="test-panel true-or-false" style="display: none;" >
			<div class="tp">
				<div class="test-num">1.</div>
			</div>
			<div class="tp1">
				<textarea name="q_tof" id="ta" class="test-box" placeholder="Question"></textarea>
				<textarea name="a_tof" id="ta" class="test-box ans" placeholder="Answer"></textarea>
				<textarea name="c_tof" id="ta" class="test-box ans" placeholder="Choice"></textarea>
				<div class="test-btn-nav">
					<div></div>
					<button class="submit nextQuestion">Next</button>
				</div>
			</div>
		</div>
		
		
	</div>
	<!-- <div class="right-wrp">
		<div class="labely">Generated questions:</div>
		<div class="qbox" title="expand">
			<?php 
			$sql_ae = mysql_query("SELECT * FROM questions where test_id = '$testID'");
				if(!mysql_num_rows($sql_ae)) {}
				else {
					echo mysql_num_rows($sql_ae);
				} 
			?>
		</div>
		<ol class="qbox1">
	
		</ol>
		<div class="submit subdis" style="display: none;">Finish</div>
	</div> -->

</div>
<?php } else { ?>
	<div class="">
	<!-- <?php 
	$test_desc = $grade = $section = $subject = $hour = $minute = $publish_date = $phour = $pminute = "";
	if(isset($_POST['submit'])) {
		$test_desc = $_POST['test_desc'];
		$grade = $_POST['grade'];
		$section = $_POST['section'];
		$subject = $_POST['subject'];
		$hour = $_POST['hour'];
		$minute = $_POST['minute'];
		$hex = bin2hex($test_desc);
		$date = date('M d, Y H:i:s');
		$publish_date = $_POST['publish_date'];
		$phour = $_POST['phour'];
		$pminute = $_POST['pminute'];
		$meridiem = $_POST['meridiem'];
		$current_date = date('Y-m-d');
		if(!$test_desc) {
		?><script>$(function() {$($('input[name=test_desc]')).css('border','1px solid red');
			$('.err_test_desc').show().text('Empty field');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$grade) {
		?><script>$(function() {$($('select[name=grade]')).css('border','1px solid red');
			$('.err_grade').show().text('Select Grade');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$section) {
		?><script>$(function() {$($('select[name=section]')).css('border','1px solid red');
			$('.err_section').show().text('Select Section');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$subject) {
		?><script>$(function() {$($('select[name=subject]')).css('border','1px solid red');
			$('.err_subject').show().text('Select Subject');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$hour) {
		?><script>$(function() {$($('input[name=hour]')).css('border','1px solid red');
			$('.err_hour').show().text('Empty field');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$minute) {
		?><script>$(function() {$($('input[name=minute]')).css('border','1px solid red');
			$('.err_minute').show().text('Empty field');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$publish_date) {
		?><script>$(function() {$($('input[name=publish_date]')).css('border','1px solid red');
			$('.err_publish_date').show().text('Select date');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$phour) {
		?><script>$(function() {$($('input[name=phour]')).css('border','1px solid red');
			$('.err_phour').show().text('Empty field');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if(!$pminute) {
		?><script>$(function() {$($('input[name=pminute]')).css('border','1px solid red');
			$('.err_pminute').show().text('Empty field');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else if($publish_date <= $current_date) {
	 		?><script>$(function() {$($('input[name=publish_date]')).css('border','1px solid red');
			$('.err_publish_date').show().text('Date must start tomorrow or after proir to creation of test');
			$('html, body').animate({ scrollTop: $('#rel4').offset().top-150}, 1000);});</script><?php
	 	} else {
	
			mysql_query("INSERT INTO tests VALUES('$hex','$test_desc','$grade','$section','$subject','$hour:$minute:00','$publish_date $phour:$pminute:00 $meridiem','$date','','$user')");
			?>
			<script>
				$(function() {
					window.location.href = "index.php?page=t_test&testID=<?php echo $hex; ?>";
				});
			</script>
			<?php
		}
	}
	
	?> -->
	

	<script type="text/javascript">
		$(function() {
			$('.submit').click(function() {
				var data = [];
				var serialize = $(':input').serialize();
				data.push(serialize);
				var specificSection = $("[name=section]").val(),
				categoryCondition = $(this).parents('#iii').find('[id*=primary]'),
				quantityCondition = $('[name=noofq]').val();
				var allcateg = categoryCondition.length;
				var d = new Date(),
				day = d.getDate(),
				month = d.getMonth()+1,
				year = d.getFullYear(),
				outputDate = year + '-' + month + '-' + day;


				
				if(!$("[name=test_desc]").val()) {
					$('[name=test_desc]').css('border','1px solid red');
					$('.err_test_desc').show().text('Required field');
				} else if(!$("[name=grade]").val()) {
					$('[name=grade]').css('border','1px solid red');
					$('.err_grade').show().text('Required field');
				} else if(specificSection.indexOf('Select section') > -1) {
					$('[name=section]').css('border','1px solid red');
					$('.err_section').show().text('Required field');
				} else if(!$("[name=subject]").val()) {
					$('[name=subject]').css('border','1px solid red');
					$('.err_subject').show().text('Required field');
				} else if(!categoryCondition.find('[name*=category]').val() || !categoryCondition.find('[name*=noofq]').val()) {
					
					$('[name=category], [name=noofq]').css('border','1px solid red');


				} else if(!$("[name=hour]").val()) {
					$('[name=hour]').css('border','1px solid red');
					$('.err_hour').show().text('Required field');
				} else if(!$("[name=minute]").val()) {
					$('[name=minute]').css('border','1px solid red');
					$('.err_minute').show().text('Required field');
				} else if(!$("[name=publish_date]").val()) {
					$('[name=publish_date]').css('border','1px solid red');
					$('.err_publish_date').show().text('Required field');
				} else if($("[name=publish_date]").val() <= outputDate) {
					modalForErrors('publish_date');
				} else if(!$("[name=phour]").val() || !$("[name=pminute]").val()) {
					$('[name=phour], [name=pminute]').css('border','1px solid red');
					$('.err_phour').show().text('Required field');
				} else {
					$.ajax({
						method: 'post',
						url: 'bridge.php',
						data: serialize,
						success: function(o) {
							window.location.href = "index.php?page=t_test&testID="+o;
						}, beforeSend: function() {
							$('.loading1').show();
						}
					});
					
				}

				
			});
		});
	</script>

	<div id="iii">
		<!-- <form method="post" action=""> -->
			
			<div class="ag">
				<div class="form_label">Test Description</div>
				<input type="text" class="form_box1" name="test_desc" size="50" value="<?php echo $test_desc;  ?>">
				<div class="tooltip"><span class="tooltiptext err_test_desc"></span></div>
			</div>
			
			<?php 
			$sql_m1 = mysql_query("SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' group by grade, section HAVING COUNT(*) >= 0") or die(mysql_error());
			?>

			<div class="ag">
				<div class="form_label">Class</div>
				<select class="form_box1" name="grade">
					<option data-grade="empty" value="">Grade</option>

					<option data-grade="g7" value="Grade 7" <?php if(isset($grade) && $grade == "Grade 7") echo "selected"; ?>>Grade 7</option>
					<option data-grade="g8" value="Grade 8" <?php if(isset($grade) && $grade == "Grade 8") echo "selected"; ?>>Grade 8</option>
					<option data-grade="g9" value="Grade 9" <?php if(isset($grade) && $grade == "Grade 9") echo "selected"; ?>>Grade 9</option>
					<option data-grade="g10" value="Grade 10" <?php if(isset($grade) && $grade == "Grade 10") echo "selected"; ?>>Grade 10</option>

				</select>
				
				<div class="tooltip"><span class="tooltiptext err_grade"></span></div>
				<select class="form_box2" name="section">
					<!-- <option value="">Section</option> -->


					<script type="text/javascript">
						$(function() {
							$('option[data-grade]').click(function() {
								var theGrade = $(this).attr('data-grade');
								
								$.ajax({
									url: 'bridge.php',
									type: 'get',
									data: {theGrade:theGrade},
									beforeSend: function() {
										$('.loading').show();
									}, success: function(fd) {

										if(fd.indexOf('Select section') > -1) {
											$('select[name=section]').html(fd);
										} else if(fd.indexOf('Select section') > -1) {
											$('select[name=section]').html(fd);
										} else if(fd.indexOf('Select section') > -1) {
											$('select[name=section]').html(fd);
										} else if(fd.indexOf('Select section') > -1) {
											$('select[name=section]').html(fd);
										} else if(fd.indexOf('err') > -1) {
											$('select[name=section]').html("");
										} else {

										}
										$('.loading').hide();
									}
								});
								
							});
						});
					</script>

					
					<!-- <option id="g7" value="<?php echo $sec; ?>" <?php if(isset($section) && $section == "$sec") echo "selected"; ?>><?php echo $sec; ?></option> -->
					
				</select>
				<div class="tooltip"><span class="tooltiptext err_section"></span></div>
				<img class="loading" src="../img/icons/loading.gif">

			</div>
			
			<div class="ag">
				<div class="form_label">Subject</div> 
				<select name="subject" class="form_box1">
					<option value="">Subject</option>
					<option value="Math" <?php if(isset($subject) && $subject == "Math") echo "selected"; ?>>Math</option>
					<option value="Science" <?php if(isset($subject) && $subject == "Science") echo "selected"; ?>>Science</option>
					<option value="English" <?php if(isset($subject) && $subject == "English") echo "selected"; ?>>English</option>
					<option value="Filipino" <?php if(isset($subject) && $subject == "Filipino") echo "selected"; ?>>Filipino</option>
					<option value="TLE" <?php if(isset($subject) && $subject == "TLE") echo "selected"; ?>>TLE</option>
					<option value="Mapeh" <?php if(isset($subject) && $subject == "Mapeh") echo "selected"; ?>>Mapeh</option>
					<option value="Music" <?php if(isset($subject) && $subject == "Music") echo "selected"; ?>>Music</option>
				</select>
			</div>
			<div class="ag clone_box">
				<div class="form_label">Questions Category</div>
				<div class="fl">
					<div class="clon" id="primary1">
						<select class="form_box1" name="category" id="copy1">
							<option value="">Category</option>
							<option value="Multiple Choice" id="category">Multiple Choice</option>
							<option value="True or False" id="category">True or False</option>
							<option value="Fill in the blank" id="category">Fill in the blank</option>
							<option value="Set A & B" id="category">Set A & B</option>
							<option value="Essay" id="category">Essay</option>
						</select>

						<input type="text" name="noofq" class="form_box2" maxlength="2" placeholder="No of question" size="10">
						<img class="remove_cat" title="Remove" src="../img/icons/icon.png">
					</div>

				</div>
				<div class="addcat">Add Category</div>
				<div class="total-box">
					<div class="heading1">Summary</div>
					<table width="100%">
						<tr>
							<th><small>Category</small></th>
							<th><small>List of questions</small></th>
						</tr>
						<tr id="added">
							<td><small class="cat1"></small></td>
							<td><small id="dinput1"></small></td>
						</tr>
						<tr class="last">
							<th><small>Total</small></th>
							<th><small class="total"></small></th>
						</tr>
					</table>
				</div>
			</div>

			<script type="text/javascript">
				$(function() {
					var cc = 1;
					var totals = [];

					$('.addcat').click(function(e) {
						cc += 1;
						var categ = $("select[name=category]").val(),
						no = $("input[name=noofq]").val();

						if($('.fl').children().length == 5) {
							modalForErrors('categoryLimit');
						}

						/*primary.eq(0).clone().appendTo('.fl').find('select[name=category]').attr('id','copy'+cnt);*/
						
						else {
							if(!categ || !no) {
								modalForErrors('category');
							} else {

								var primary = $("div[id^='primary']:last");
								var cnt = parseInt( primary.prop("id").match(/\d+/g), 10) +1;
								e.preventDefault();
								var cloneSelect = primary.clone().prop('id', 'primary'+cnt);
								cloneSelect.find('[type=text]').val("").attr({'id':'dinput'+cnt, 'name':'noofq'+cnt});
								cloneSelect.find('.remove_cat').show();
								cloneSelect.find('select').attr({'data-category':'category'+cnt,'name':'category'+cnt});
								cloneSelect.find('[type=text]').css('border','1px solid rgba(0,0,0,0.14)');
								cloneSelect.find('select').css('border','1px solid rgba(0,0,0,0.14)');
								$('.fl').append(cloneSelect);
								
								
								

								drawNav();

								/*if(cloneSelect.find('[type=text]').val()=="") {
									modalForErrors();
								}*/

								$('.remove_cat').click(function() {
									$(this).parent().remove();
									drawNav();
									$('#tr'+cnt).remove();
								});

								function drawNav() {
									var numofclone = $('.clon').length;
									if(numofclone > 1) {
										$('.remove_cat').not(':first').show();
									} else {
										$('.remove_cat').hide();
									}
								}


								$('.total-box').show();
								$('.cat1').text(categ);
								$('#dinput1').text(no);
								$('.total').text(no);
								var counter = 0;

								$("select[name=category]").on('change', function() {
									var sel = $(this).val();
									var dataCategory = $(this).attr('data-category');
									counter++;



									if(counter==1) {
										$('.last').before('<tr id="'+cnt+'"><td><small class="'+dataCategory+'">'+sel+'</small></td></tr>');

									} else {
										$('.'+dataCategory).text(sel);
										
									}
								});
								var counter1 = 0;
								$('input[name=noofq]').on('keyup', function(event) {
									var newno = $(this).val(), no_id = $(this).attr('id');
									counter1++;
									if(counter1==1) {
										$("tr#"+cnt).append("<td><small id='"+no_id+"'>"+newno+"</small></td>");
									} else {
										$('#'+no_id).text(newno);
									}

									
									
								});

								$('.total').text($.map($('input[name=noofq]'), function (elem) {
									return parseInt(elem.value, 10) || 0; }).reduce(function (a,b) {
										return a + b;
									}, 0));
								

							} /*end of else*/
						} /*end of else in category limit*/



					});
				});
			</script>
			<div class="ag">
				<div class="form_label">Time Limit</div>
				<input type="text" class="form_box1" name="hour" placeholder="Hour" size="10" value="<?php echo $hour; ?>">
				<div class="tooltip"><span class="tooltiptext err_hour"></span></div>
				<input type="text" class="form_box2" name="minute" placeholder="Minute" size="10" value="<?php echo $minute;  ?>">
				<div class="tooltip"><span class="tooltiptext err_minute"></span></div>
			</div>

			<div class="ag">
				<div class="form_label">Publish date</div>
				<input type="date" class="form_box1" name="publish_date" value="<?php echo $publish_date; ?>">
				<div class="tooltip"><span class="tooltiptext err_publish_date"></span></div>
				

				<input type="text" class="form_box2" name="phour" placeholder="Hour" size="10" value="<?php echo $phour; ?>">
				<div class="tooltip"><span class="tooltiptext err_phour"></span></div>
				<input type="text" class="form_box2" name="pminute" placeholder="Minute" size="10" value="<?php echo $pminute;  ?>">
				<div class="tooltip"><span class="tooltiptext err_pminute"></span></div>
				<select name="meridiem" class="form_box2">
					<option value="AM" <?php if(isset($meridiem) && $meridiem == "AM") echo "selected"; ?>>AM</option>
					<option value="PM" <?php if(isset($meridiem) && $meridiem == "PM") echo "selected"; ?>>PM</option>
				</select>
			</div>


			<div class="agg">
				<input type="submit" class="submit" name="submit" value="Create">
				<img class="loading1" src="../img/icons/loading.gif">
			</div>
			
			<!-- </form> -->
		</div>	
	</div>
<?php } ?>
</div>

<script type="text/javascript">
	$(function() {

/*$('.nav-category').show(function() {
	$(this).children().each(function() {
		var categoryID = $(this).attr('data-category');
		if($(this).is(':first-child')) {
			showTestPanel(categoryID);
		} else if($(this).is(':nth-child(2)')) {
			showTestPanel(categoryID);
		} else if($(this).is(':nth-child(3)')) {
			showTestPanel(categoryID);
		} else if($(this).is(':nth-child(4)')) {
			showTestPanel(categoryID);
		} else if($(this).is(':last-child')) {
			showTestPanel(categoryID);
		}
	});
	
});*/

$('li.list-category').show(function() {
	var categoryID = $(this).attr('data-category');
	handler(categoryID);
});

function handler(categoryID) {
	$.ajax({
		url: 'bridge.php',
		type: 'get',
		data: {category:categoryID},
		success: function(f) {
			/*alert(f);*/
		}
	});
}

$.each($('ul.nav-category').children(), function(index) {
	$(this).animate({opacity:1}).delay(index * 1000).fadeIn();
});





		var c = 0;
		
		$('.add-c').click(function() {
			c += 1;
			var tbox = "<textarea name='ch"+c+"' id='ch' class='test-box' placeholder='Choices "+c+"'></textarea>";
			if(c<4) {
				$('.test-btn-nav').before(tbox);
				$('.ans').css('background-color','rgba(0,0,0,0.1)');
				$('.remx').click(function() {
					$(this).parent().remove();
					c = c-1;
				});
			} else {
				modalForErrors('choicesLimit');
			}
			
		});
		var q = 1, q_ = 0, testArray = [];
		testID = "<?php echo $testID; ?>";
		$('.nextQuestion').on('click',function(e) {
			
			var testPanel = $('.test-panel').children(),
			tp1 = $('.tp1').children();

			var question = $('[name=question]').val(),
			answer = $('[name=answer]').val(),
			ch1 = testPanel.eq(2).val(),
			ch2 = testPanel.eq(3).val(),
			ch3 = testPanel.eq(4).val(),
			testID = "<?php echo $testID; ?>";

			var q_tof = $('[name=q_tof]').val(),
				a_tof = $('[name=a_tof]').val(),
				c_tof = $('[name=c_tof]').val();

			e.preventDefault();

			if(!question && !answer && !$('#ch').val() && !q_tof && !a_tof && !c_tof) {
				$("[name=question], [name=answer], $('#ch'), [name=q_tof], [name=a_tof], [name=c_tof]").css('border','1px solid orangered');
			} /*else if($('').length < 3) { 
				alert('Add choices');
			} */else {
				var numQtty = parseInt($('#numQtty').text(),10);
				var counterqty = $('#numQtty').text(numQtty-1);


				if($('#numQtty').text() == 0) {
					testPanel.hide().not('.btn-next');
					$('<div/>').addClass('btn-next btn').text('Next category').appendTo($('.test-panel'));
					$('.nav-category').find(':first').css('background-color','limegreen');
					$('ul.nav-category').find('#lc1').removeClass('actibo');
					q = 0;
					nextCategory();
				}
				testArray.push(question);
				
				$('.done-test-wrapper').show(function() {
					q_ += 1;
					var testContainer = $("<div/>").addClass('test-container'),
					testNumDone = $("<div/>").addClass('test-num-done').text(q_+'.').appendTo(testContainer),
					testContent = $("<div/>").addClass('test-content').appendTo(testContainer),
					testQuestion = $("<div/>").addClass('test-question').text(question).appendTo(testContent);

					var testContainer = $("<div/>").addClass('test-container'),
					testNumDone = $("<div/>").addClass('test-num-done').text(q_+'.').appendTo(testContainer),
					testContent = $("<div/>").addClass('test-content').appendTo(testContainer),
					testQuestion = $("<div/>").addClass('test-question').text(q_tof).appendTo(testContent);

					$(this).append(testContainer);



				});


				$.ajax({
					url: '../teacher/process_test.phps',
					type: 'post',
					data: {testID:testID,question:question,answer:answer,ch1:ch1,ch2:ch2,ch3:ch3},
					success: function(h) {
						/*alert(h);*/
					}
				});
				$('.ans').css('background-color','white');
				$('.labely').fadeIn();
				q += 1;
				/*var children = [];
				tp1.each(function() {
					children.push(this);
				}); 
				function fadeChild(children) {
					if(children.length > 0) {
						var currentChild = children.shift();
						$(currentChild).animate({'margin-left':'50px','opacity':'0'}, 500, function() {
							$(this).animate({'margin-left':'-15px'},'fast', function() {
								$(this).delay(100).animate({'margin-left':'0px','opacity':'1'}, 500, function() {

									
								});


								

							});
							fadeChild(children);
							
						});
					}
				}*/
				/*fadeChild(children);
*/				createdQuestion($('textarea:input[name=question]').val());
				$('textarea#ch').remove();
				$('textarea').val('');
				$('.test-num').text(q+".");
				$('.test-box').css('border','1px solid rgba(0,0,0,0.1)');
								c = 0;

			}

			function createdQuestion(count) {
	/*var qc = "<li class='qlist'>"+c+"</li>";
	$('ol.qbox').append(qc);*/
	var cur_val = parseInt($('.qbox').text());
	if(!cur_val) {
		$('.qbox').text(q-1);
	} else {
		$('.qbox').text(cur_val + 1);
	}
	

	
}


}); /*end of nextQuestion*/

		function nextCategory() {
			$('.btn-next').click(function() {
				$('ul.nav-category').find('#lc1').next().addClass('actibo');
				$('.done-test-wrapper, .btn-next').fadeOut(function() {
					$('#tof').fadeIn();

				});
			});
		}
		


/*$('.qbox').click(function() {
	$('.test-wrapper').animate({width:'20%'},500);
	$('.subdis').fadeIn();
	$('.right-wrp').animate({width:'80%'},500, function() {
		$('.qbox').slideUp(function() {
			$.ajax({
		url: '../main/bridge.php',
		type: 'get',
		data: {testID:testID},
		success: function(f) {
			$('.qbox1').html(f);
			$('.delqlist').click(function(e) {
				$('.mask').fadeIn();

				var qid = $(this).attr('id');
				var optns = "dlt";
				modal(qid,optns);

			});
		}
		});
		});
		
	});
	
});

$('.test-wrapper').click(function() {
	$(this).animate({width:'80%'},500);
	$('.subdis').fadeOut();
	$('.right-wrp').animate({width:'20%'},500, function() {
		$('.qbox').slideDown();
		$('.qlist').slideUp(function() {
			$(this).remove().finish();
		});
	});
});*/

/*$('.subdis').click(function() {
	$.ajax({
		url: 'bridge.php',
		type: 'post',
		data: { testID2:testID },
		success: function(e) {
			alert(e);
			window.location.href = "index.php?page=t_test";
		}, beforeSend: function() {
			
		}
	});
});*/


$('textarea#ta, textarea#ch').click(function() {
	$(this).css('border','1px solid rgba(0,0,0,0.1)');
});

$(window).on('beforeunload', function(){
	return 'Are you sure you want to leave?';
	$.ajax({
		type: 'GET',
		async: false,
		url: 'bridge.php?testID='+testID
	});


});





});
</script>
