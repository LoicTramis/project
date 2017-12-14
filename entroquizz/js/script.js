window.onload = function() {
	/* --- SIGN IN / SIGN OUT --- */
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
	// Hide the log in popup when clicking outside the popup
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
	// Check if the passwords are the same after each input
	$('input').keyup(function() {
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
	// Check if the passwords are the same when submiting the form
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
	
	/* --- ANIMATION for the navigation bar --- */
	// Show/hide the solo panel
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
	// Show/hide the mutli panel
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
	// Show/hide the admin panel
	$("#flip-admin").click(function(){
		if ($("#panel-admin").is(':visible')) {
			$("#panel-admin li").animate({
				opacity: 0
			});
	        $("#panel-admin").delay(400).slideToggle(300);
		} else {
			$("#panel-admin li").delay(400).animate({
				opacity: 1
			});
			$("#panel-admin").slideToggle(300);
		}
    });
	// Prevent a jump from the animation
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
	 $('#panel-admin').each(function() {
		 $height = $(this).height();
		 $(this).css('height', $height);
		 $(this).hide();
		});
	 /* --- QUIZZ --- */
	 var questions = document.querySelectorAll("#quizz .question");
	 var i=0;
	 var total = questions.length;
	 
	 $("#finish").css("display", "none");
	 $("#confirm").prop("disabled", false);
	 $("#validate").prop("disabled", true);
	 
	 // Prevent the code from being executed on each page
	 if (questions[0] !== undefined) {
		questions[0].style.display = "block";
		
		// Switch the value and the name of the 'submit' button when answering a question
		validate.addEventListener("click", function(e){
			questions[i].style.display="none";
			i++;
			
			if(i < total){
				questions[i].style.display="block";
			}

			$("label > input").attr("disabled", false); // enable the form
			$("#confirm").removeClass().addClass("wait"); // reset the class
			$("#confirm").css("display", "block"); // display the confirm button
			$("#confirm").prop("disabled", false); // enable the confirm button
			$("#validate").prop("disabled", true); // disable the validate button
			
			// display finish button at the end of the quizz
			if (i == total) {
				$("#finish").css("display", "block");
				$("#confirm").css("display", "none");
				$("#validate").css("display", "none");
			} else {
				$("#finish").css("display", "none");
			}
		});
		
		
	 }
}
/**
 * Show/Hide element according to the type of the questions in the create script. 
 */
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

/**
 * Change the value of the input checkbox if checked 
 */
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

/**
 * Switch between the log in and sign in
 */
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

/**
 * Split the actual ID and get the ID for DB compare
 * 
 * @param element - an element with an ID
 * @returns formated ID
 */
function getID(element) {
	var temp_id = element.id;
	var input = document.getElementById(element.id);
	var real_id = temp_id.split("-");
	
	return real_id[1];
}

/* --- QUIZZ --- */
/**
 * Check if all the field/checkbox/radio input are empty
 * 
 * @param type - the type of the question
 * @returns boolean
 */
function check_empty_answer(type, inputs) {
	
	switch (type) {
	case 'on':
		var radio0 = document.getElementById(inputs[0].getAttribute('id'));
		var radio1 = document.getElementById(inputs[1].getAttribute('id'));
		var ident = inputs[0].getAttribute('id');
		var res = ident.split("-");
		var idd = res[1];

	    if (radio0.checked == false && radio1.checked == false) {
	    	document.getElementById("correction"+idd).classList.add("error");
	    	document.getElementById("correction"+idd).innerHTML = "Dans le pire des cas 1 chance sur 2";
	    	
	        return false;
	    }
		break;
	case 'cm':
		var checkbox0 = document.getElementById(inputs[0].getAttribute('id'));
		var checkbox1 = document.getElementById(inputs[1].getAttribute('id'));
		var checkbox2 = document.getElementById(inputs[2].getAttribute('id'));
		var checkbox3 = document.getElementById(inputs[3].getAttribute('id'));
		var ident = inputs[0].getAttribute('id');
		var res = ident.split("-");
		var idd = res[1];

	    if (checkbox0.checked == false
	    		&& checkbox1.checked == false
	    		&& checkbox2.checked == false
	    		&& checkbox3.checked == false) {
	    	document.getElementById("correction"+idd).classList.add("error");
	    	document.getElementById("correction"+idd).innerHTML = "N'ayez pas peur cocher au moins 1 case.";
	    	
	        return false;
	    }
		break;
	case 'txt':
		var text = document.getElementById(inputs[0].getAttribute('id'));
		var ident = inputs[0].getAttribute('id');
		var res = ident.split("-");
		var idd = res[1];
		
	    if (text.value == "") {
	    	document.getElementById("correction"+idd).classList.add("error");
	    	document.getElementById("correction"+idd).innerHTML = "Voyons ! Tentez votre chance !";
	    	
	        return false;
	    }
		break;

	default:
		break;
	}
	return true;
}

/**
 * Show/hide the navigation bar panel
 */
function display_nav() {
	var nav = $('#nav-panel');
	
	if (nav.css('display') == "block") {
		nav.hide();
	} else if (nav.css('display') == "none") {
		nav.show();
	}
}