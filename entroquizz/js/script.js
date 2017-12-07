window.onload = function() {
	// Call the display/hide function when clicking the span
	$(document).ready(function() {
		$(".switch > span").on("click", function() {
			$(this).after(switch_login());
		});
	});
	
	$('#signin').click(function() {
		$('#connect').animate({
			left: '50%',
			opacity: '1'
		});
		$('#register').animate({
			left: '50%',
			opacity: '1'
		});
	});
	$('#frontground').click(function() {
		$('#connect').animate({
			left: '80%',
			opacity: '0'
		});

		$('#register').animate({
			left: '80%',
			opacity: '0',
		});
		setTimeout(() => {
			popup_login();
		}, 300);
	});
	
	$('input').blur(function() {
		var pass = $('input[name=r_password]').val();
		var repass = $('input[name=r_repassword]').val();
		
		if (pass.length == 0 && repass.length == 0) {
			$('.fa-unlock-alt').css('color', '#3385ff');
	        $('.fa-check-circle-o').removeClass().addClass('fa fa-unlock-alt');
		} else if (pass != repass) {
	        $('.fa-unlock-alt').css('color', 'red');
	        $('.fa-check-circle-o').css('color', 'red');
	        $('.fa-check-circle-o').removeClass().addClass('fa fa-unlock-alt');
	    } else {
	        $('.fa-unlock-alt').css('color', 'green');
	        $('.fa-unlock-alt').removeClass().addClass('fa fa-check-circle-o');
	    }
	});
	
	$('#register > form').submit(function(event) {
		var pass = $('input[name=r_password]').val();
		var repass = $('input[name=r_repassword]').val();
		
		if ((pass.length == 0 && repass.length == 0) || (pass != repass)) {
			$('.message').addClass('warning');
			$('.message').text("Les mots de passe sont différents.");
			event.preventDefault();
		} else {
			return;
		}
	});

	$("#flip-solo").click(function(){
		if ($("#panel-solo").is(':visible')) {
			$("#panel-solo li").animate({
				opacity: 0
			});
	        $("#panel-solo").delay(400).slideToggle(300);
		} else {
			$("#panel-solo li").delay(400).animate({
				opacity: 1
			});
			$("#panel-solo").slideToggle(300);
		}
    });
	$("#flip-multi").click(function(){
		if ($("#panel-multi").is(':visible')) {
			$("#panel-multi li").animate({
				opacity: 0
			});
	        $("#panel-multi").delay(400).slideToggle(300);
		} else {
			$("#panel-multi li").delay(400).animate({
				opacity: 1
			});
			$("#panel-multi").slideToggle(300);
		}
    });
	 $('#panel-solo').each(function() {
		 $height = $(this).height();
		 $(this).css('height', $height);
		 $(this).hide();
		});
	 $('#panel-multi').each(function() {
		 $height = $(this).height();
		 $(this).css('height', $height);
		 $(this).hide();
		});	
	
	var questions= document.querySelectorAll(" #quizz .question ");
	var i=0;

	questions[0].style.display="block";

	validate.addEventListener("click", function(e){
		questions[i].style.display="none";
		i++;
		if(i<questions.length) questions[i].style.display="block";
	});
}

function typeCheck(){
     if (document.getElementById('radioON').checked) {  //si vrai/faux coché
         document.getElementById('divON').style.display = 'block';
        document.getElementById('divTXT').style.display = 'none';
        document.getElementById('divCM').style.display = 'none';
     }
     else if (document.getElementById('radioTXT').checked) { //si txt coché
         document.getElementById('divON').style.display = 'none';
        document.getElementById('divTXT').style.display = 'block';
        document.getElementById('divCM').style.display = 'none';
     }
     else{ //si qcm coché
         document.getElementById('divON').style.display = 'none';
        document.getElementById('divTXT').style.display = 'none';
        document.getElementById('divCM').style.display = 'block';
     }
}

function boxCheck(){
    if (document.getElementById('rep1').checked)  //si la box est cochée
         document.getElementById('rep1').value = 'true';
    if (document.getElementById('rep2').checked)  //si la box est cochée
         document.getElementById('rep2').value = 'true';
    if (document.getElementById('rep3').checked)  //si la box est cochée
         document.getElementById('rep3').value = 'true';
    if (document.getElementById('rep4').checked)  //si la box est cochée
         document.getElementById('rep4').value = 'true';
}

function popup_login() {
    var y = document.getElementById('connect');
    var x = document.getElementById('register');
    var front = document.getElementById('frontground');
    
	if (y.style.display == 'none' && front.style.display == 'none') {
		y.style.display = 'block';
		front.style.display = 'block';
	} else {
		y.style.display = 'none';
		x.style.display = 'none';
		front.style.display = 'none';
	}
}

/**
 * Display/Hide the login form
 */
function switch_login() {
    var x = document.getElementById('register');
    var y = document.getElementById('connect');

    if (y.style.display === 'none') {
        y.style.display = 'block';
        x.style.display = 'none';
    } else {
        y.style.display = 'none';
        x.style.display = 'block';
    }
}


function getID(element) {
	var temp_id = element.id;
	var input = document.getElementById(element.id);
	var real_id = temp_id.split("-");
	
	return real_id[1];
}