function success(name,up,type,cid) {     
	$('.mask').html('<div class="v"><div class="vv"><div class="vvv"><img class="vi" src="../img/icons/checked.png"><div class="vii">Learner Enrolled</div><div class="btnn" id="'+type+'">Continue</div></div><div class="vv2"><div class="vn">'+name+'</div><small>Name</small><br><br><div class="vn">'+up+'</div><small>Username</small><br><br><div class="vn">'+up+'</div><small>Password</small></div></div></div>');

	$('.btnn').click(function() {

		if(type=='teacher') { 
			window.location.href = 'index.php?page=teacher&page2=addnew&tuser='+up; 
		} if(type=='student') { 
			window.location.href = 'index.php?page=enrolment&page2=e3&pid=addclass&cid='+cid; 
		}
	});
}

function modal(qid,optns) {
	$('body').css('overflow','hidden');
	$('.mask').fadeIn(function() {
		$('.modal').fadeIn();

	});
	

if(optns=="dlt") {
	$('.modal-btn-neg').click(function(e) {
		$('body').css('overflow','auto');
		$('.mask').fadeOut();		
	});
	$('.modal-btn-pos').on('click', function() {
		$.ajax({
			url: 'bridge.php',
			method: 'get',
			data: {qid,qid},
			success: function(x) {
				$('.modal-content').text('Successfully Deleted');
				$('.modal-btn-pos').hide();
				$('.modal-btn-neg').text('Ok');

			}, beforeSend: function() {
				$('.modal-content').text('Deleting record...');
			}
		});
		
		
	});
}
	closeModal();	
}

function modalForErrors(reason) {
	$('body').css('overflow','hidden');
	$('.mask').fadeIn(function() {
		$('.modal').fadeIn();
		if(reason=='publish_date') {
			$('.modal-header').text("Error: Publish date");
			$('.modal-content').text("Publish date should start tomorrow or later");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='category') {
			$('.modal-header').text("Error: Category and quantity");
			$('.modal-content').text("Select first category and quantity");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='categoryLimit') {
			$('.modal-header').text("Error: Category limit");
			$('.modal-content').text("You can only add 5 catergories");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='choicesLimit') {
			$('.modal-header').text("Error: Choices limit");
			$('.modal-content').text("You can only add 3 choices");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='selectAdviser') {
			$('.modal-header').text("Error: Select adviser");
			$('.modal-content').text("Select adviser");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='assign_confirmation') {
			$('.modal-header').text("Error: Select adviser");
			$('.modal-content').text("This teacher confirmed taken");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='emptyField') {
			$('.modal-header').text("Error: Empty field");
			$('.modal-content').text("Some field appears to be empty");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		} if(reason=='addChoices') {
			$('.modal-header').text("Error: No Choices");
			$('.modal-content').text("You must add choices");
			$('.modal-btn-pos').hide();
			$('.modal-btn-neg').text("Close");
		}
		
	});

	closeModal();
}

function closeModal() {
	
		$('.modal-btn-neg').click(function() {
			var text = $(this).text();
			if(text=="Ok") {
				window.location.href="index.php?page=teacher&page2=profile";
			} else {
				$('.modal,.mask').fadeOut();
				$('body').css('overflow','auto');
			}
		});
}



function findTest(val) {
	 val=="True or False" ? trueorfalse() :  
	 val=="Multiple Choice" ? multipleChoice() :
	 val=="Fill in the blank" ? fillintheblank() :
	 val=="Essay" ? essay() :
	 val=="Set A & B" ? setab() : false;

}




function multipleChoice() {
	var testPanel = $('.mu');
	var tp = $('<div/>').addClass('tp').appendTo(testPanel),
		testNum = $('<div/>').addClass('test-num').text('1.').appendTo(tp);
	var tp1 = $('<div/>').addClass('tp1').appendTo(testPanel),
		textarea_1 = $('<textarea/>').attr({'name':'question','placeholder':'Question: multipleChoice'}).addClass('test-box').appendTo(tp1),
		textarea2 = $('<textarea/>').attr({'name':'answer','placeholder':'Answer'}).addClass('test-box').appendTo(tp1),
		testBtnNav = $('<div/>').addClass('test-btn-nav').appendTo(tp1),
		addField = $('<div/>').addClass('add-field add-c').text('Add category').appendTo(testBtnNav),
		nextBtn = $('<button/>').addClass('submit nextQuestion').text('Next').appendTo(testBtnNav);
		
}

function trueorfalse() {
	var testPanel = $('.tr');
	var tp = $('<div/>').addClass('tp').appendTo(testPanel),
		testNum = $('<div/>').addClass('test-num').text('1.').appendTo(tp);
	var tp1 = $('<div/>').addClass('tp1').appendTo(testPanel),
		textarea_1 = $('<textarea/>').attr({'name':'q_multiple','placeholder':'Question:true or false'}).addClass('test-box').appendTo(tp1),
		textarea2 = $('<textarea/>').attr({'name':'a_multiple','placeholder':'Answer'}).addClass('test-box').appendTo(tp1),
		testBtnNav = $('<div/>').addClass('test-btn-nav').appendTo(tp1),
		addField = $('<div/>').addClass('add-field add-c').text('Add category').appendTo(testBtnNav),
		nextBtn = $('<button/>').addClass('submit nextQuestion').text('Next').appendTo(testBtnNav);
}

function setab() {
	var testPanel = $('.se');
	var tp = $('<div/>').addClass('tp').appendTo(testPanel),
		testNum = $('<div/>').addClass('test-num').text('1.').appendTo(tp);
	var tp1 = $('<div/>').addClass('tp1').appendTo(testPanel),
		textarea_1 = $('<textarea/>').attr({'name':'q_multiple','placeholder':'Question:set a b'}).addClass('test-box').appendTo(tp1),
		textarea2 = $('<textarea/>').attr({'name':'a_multiple','placeholder':'Answer'}).addClass('test-box').appendTo(tp1),
		testBtnNav = $('<div/>').addClass('test-btn-nav').appendTo(tp1),
		addField = $('<div/>').addClass('add-field add-c').text('Add category').appendTo(testBtnNav),
		nextBtn = $('<button/>').addClass('submit nextQuestion').text('Next').appendTo(testBtnNav);
}

function fillintheblank() {
	var testPanel = $('.fi');
	var tp = $('<div/>').addClass('tp').appendTo(testPanel),
		testNum = $('<div/>').addClass('test-num').text('1.').appendTo(tp);
	var tp1 = $('<div/>').addClass('tp1').appendTo(testPanel),
		textarea_1 = $('<textarea/>').attr({'name':'q_multiple','placeholder':'Question:Fill in the blank'}).addClass('test-box').appendTo(tp1),
		textarea2 = $('<textarea/>').attr({'name':'a_multiple','placeholder':'Answer'}).addClass('test-box').appendTo(tp1),
		testBtnNav = $('<div/>').addClass('test-btn-nav').appendTo(tp1),
		addField = $('<div/>').addClass('add-field add-c').text('Add category').appendTo(testBtnNav),
		nextBtn = $('<button/>').addClass('submit nextQuestion').text('Next').appendTo(testBtnNav);
}

function essay() {
	var testPanel = $('.es');
	var tp = $('<div/>').addClass('tp').appendTo(testPanel),
		testNum = $('<div/>').addClass('test-num').text('1.').appendTo(tp);
	var tp1 = $('<div/>').addClass('tp1').appendTo(testPanel),
		textarea_1 = $('<textarea/>').attr({'name':'q_multiple','placeholder':'Question:essay'}).addClass('test-box').appendTo(tp1),
		testBtnNav = $('<div/>').addClass('test-btn-nav').appendTo(tp1),
		nextBtn = $('<button/>').addClass('submit nextQuestion').text('Next').appendTo(testBtnNav);
}


/*$(document).click(function() {
	
		$('.ttdel').fadeOut();
	
   
});
$('.ttdel').click(function(e) {
    e.stopPropagation(); // This is the preferred method.
    return false;        // This should not be used unless you do not want
                         // any click events registering inside the div
});
$('.remove').click(function() {
	alert();
});*/
