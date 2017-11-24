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

function popup_login(session_login,) {
	if (session_login == null) {
		document.getElementById('connect').style.display = "visible";
		return false;
	} else {
		return true;
	}
}