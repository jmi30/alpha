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
		$sql_z = mysqli_query($connection, "SELECT * FROM tests WHERE test_id = '$testID'");
		$fetch_z = mysqli_fetch_array($sql_z);
		?>
		<div id="<?php echo $testID; ?>" class="h1"><?php echo $fetch_z['test_desc']; ?></div>
		<div><b>To:</b> <?php echo $fetch_z['grade'] ." &mdash; ". $fetch_z['section']; ?></div>
		<div><b>Time Limit:</b> <?php echo $fetch_z['time_limit']; ?></div>
		<input type="hidden" id='hidden_id' value="<?php echo $testID; ?>">
		<ul class="nav-category">
			<?php 
			echo '<li id="lc1" class="list-category actibo" data-category="'.$fetch_z['category'].'">'.$fetch_z['category'].'<img class="checklogo" src="../img/icons/checked.png"><small id="numQtty" class="qtty">'.$fetch_z['noofq'].'</small></li>'; 

			if($fetch_z['category2'] == '' && $fetch_z['noofq2'] ==0) {}
				else {
					echo '<li class="list-category" data-category="'.$fetch_z['category2'].'">'.$fetch_z['category2'].'<small class="qtty">'.$fetch_z['noofq2'].'</small></li>';

				} if($fetch_z['category3'] == '' && $fetch_z['noofq3'] ==0) {}
				else {
					echo '<li class="list-category" data-category="'.$fetch_z['category3'].'">'.$fetch_z['category3'].'<small class="qtty">'.$fetch_z['noofq3'].'</small></li>';
				} if($fetch_z['category4'] == '' && $fetch_z['noofq4'] ==0) {}
				else {
					echo '<li class="list-category" data-category="'.$fetch_z['category4'].'">'.$fetch_z['category4'].'<small class="qtty">'.$fetch_z['noofq4'].'</small></li>';
				} if($fetch_z['category5'] == '' && $fetch_z['noofq5'] ==0) {}
				else {
					echo '<li class="list-category" data-category="'.$fetch_z['category5'].'">'.$fetch_z['category5'].'<small class="qtty">'.$fetch_z['noofq5'].'</small></li>';
				}
				?>
				<li class="list-category">Review</li>
				<li class="list-category">Finish</li>
			</ul>
			<script type="text/javascript">
				$(function() {
					
					var $selectcat = $('.nav-category'),
					numqqty = $('.qtty').text();
					
					function child1(whatChild) {
						var child1 = $selectcat.children(':first-child');
						var thischild1 = (child1) ? findTest(child1.attr('data-category')) : '';
						whatChild();


					}

					function child2(whatChild) {
						var child2 = $selectcat.children(':nth-child(2)');
						var thischild2 = (child2) ? findTest(child2.attr('data-category')) : '';
						whatChild();

					}

					function child3(whatChild) {
						var child3 = $selectcat.children(':nth-child(3)');
						var thischild3 = (child3) ? findTest(child3.attr('data-category')) : '';
						whatChild();
					}

					function child4(whatChild) {
						var child4 = $selectcat.children(':nth-child(4)');
						var thischild4 = (child4) ? findTest(child4.attr('data-category')) : '';
						whatChild();
					}

					function child5(whatChild) {
						var child5 = $selectcat.children(':last-child');
						var thischild5 = (child5) ? findTest(child5.attr('data-category')) : '';
						whatChild();
					}

					function runChildInOrder(whatChild) {
						child1(function() {
							/*$("child1.attr('data-category')").siblings().hide();*/
							
							child2(function() {
								
								child3(function() {
									child4(function() {
										child5(whatChild);
									});
								});
							});
						});
					}

					runChildInOrder(function() {
						
					});

					
					
					
					

				});
			</script>
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
				<div class="test-panel1 mu" id="child1"></div>
				<div class="test-panel2 tr" id="child2"></div>
				<div class="test-panel3 fi"></div>
				<div class="test-panel4 se"></div>
				<div class="test-panel5 es"></div>

				<script type="text/javascript">
					
				</script>

				<div class="test-panel-container"></div>

		<!-- <div class="test-panel multiple-choice" style="display: none;">
				
					<div class="tp">
						<div class="test-num">1.</div>
					</div>
					<div class="tp1">
						<textarea name="question" id="ta" class="test-box" placeholder="Question"></textarea>
						<textarea name="answer" id="ta" class="test-box ans" placeholder="Answer"></textarea>
						<div class="test-btn-nav">
							<div class="add-field add-c">Add Choices</div>
							<button class="submit nextQuestion">Next</button>
						</div>
					</div>
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
			-->		
			
		</div>
	<!-- <div class="right-wrp">
		<div class="labely">Generated questions:</div>
		<div class="qbox" title="expand">
			<?php 
			$sql_ae = mysqli_query($connection, "SELECT * FROM questions where test_id = '$testID'");
				if(!mysqli_num_rows($sql_ae)) {}
				else {
					echo mysqli_num_rows($sql_ae);
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
	
			mysqli_query($connection, "INSERT INTO tests VALUES('$hex','$test_desc','$grade','$section','$subject','$hour:$minute:00','$publish_date $phour:$pminute:00 $meridiem','$date','','$user')");
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
				
				var serialize = $(':input').serialize();
				
				var specificSection = $("[name=section]").val(),
				categoryCondition = $(this).parents('#iii').find('[id*=primary]'),
				quantityCondition = $('[name=noofq]').val();
				var allcateg = categoryCondition.length;
				var d = new Date(),
				day = ("0" + d.getDate()).slice(-2),
				month = ("0" + (d.getMonth() + 1)).slice(-2),
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
			$sql_m1 = mysqli_query($connection, "SELECT grade, section, COUNT(*) AS dup_count FROM students where sy = '2018-2019' group by grade, section HAVING COUNT(*) >= 0") or die(mysqli_error());
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
										$('select[name=section]').html(fd);
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

		var num = 0;
		$('.add-c').on('click', function() {
			num++;
			var addChoices = $('<textarea/>').addClass('test-box').attr('placeholder','Choice '+num);
			num>3 ? modalForErrors('choicesLimit') : $(this).parent().before(addChoices);
		});

		var num2 = 0, q = 1;
		$('.nextQuestion').on('click', function() {
			var testPanel = $(this).parents('[class*=test-panel]');
			var $textarea = testPanel.find('textarea'),
			valArr = [];
			$textarea.each(function() {
				var checkVal = $(this).val();
				valArr.push(checkVal);
			});
			
			
			jQuery.inArray("", valArr) !== -1 ? modalForErrors('emptyField') :
			valArr.length <= 2 ? modalForErrors('addChoices') : goToProcess(valArr[0]);

			
		});

		function goToProcess(question) {
			num2++; q++;
			$('.done-test-wrapper').slideDown(function() {
				
				var testContainer = $('<div/>').addClass('test-container'),
				testNumDone = $('<div/>').addClass('test-num-done').text(num2+'.').appendTo(testContainer),
				testContent = $('<div/>').addClass('test-content').appendTo(testContainer),
				testQuestion = $("<div/>").addClass('test-question').text(question).appendTo(testContent);
				$(this).append(testContainer);

				$("[class*='test-panel']").animate({'margin-top':'0px'});
				$('textarea').val('');
				var numQtty = parseInt($('#numQtty').text(), 10),
				countleft = $('#numQtty').text(numQtty-1);
				$('#numQtty').text()==4 ? next() : false;

			});
			$('.test-num').text(q+".");

		}

		function next() {
			$('[class*=test-panel]').fadeOut();
			var re = $('<div/>').addClass('btn-next btn').text('Next category');
			
			$('.checklogo').show();
			$('ul.nav-category').children(':first-child').find('.qtty').hide();
			$('.done-test-wrapper').children(':last-child').after(re);

			$('.btn-next').on('click', function() {
				$('ul.nav-category').children(':first-child').removeClass('actibo');
				$('ul.nav-category').children(':nth-child(2)').addClass('actibo');
				$('.nav-category').children(':nth-child(2)').attr('data-category').siblings().hide();
				$('[class*=test-panel]').show();
			});
		}

		
		




	});
</script>
