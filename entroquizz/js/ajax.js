function getUsername(name) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("oui").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","../asp/getUsername.php?name=" + name,true);
	xmlhttp.send();
}

function getEmail(email) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("oui").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","../asp/getEmail.php?email=" + email,true);
	xmlhttp.send();
}

function getAnswer() {
	// get the type of the question (on-cm-txt)
	var type = $('.question:visible').attr('id');
	var input, i, user, id;
	var ans = {};
	
	input = document.getElementById(type).getElementsByClassName("q-" + type);
	
	if (check_empty_answer(type, input)) {
		switch (type) {
		// TRUE OR FALSE
		case "on":
			for (i = 0; i < input.length; i++) {
					
				if (input[i].checked == true) {
					user = input[i].value;
					
					id = getID(input[i]);
					
					if (window.XMLHttpRequest) {
						xmlhttp = new XMLHttpRequest();
					} else {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("message").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","../asp/getAnswerON.php?idon=" + id + "&user=" + user,true);
					xmlhttp.send();
				}
			}
			break;
		// MULTIPLE CHOICE
		case "cm":
			for (i = 0; i < input.length; i++) {
				var actual_id = input[i].getAttribute('id');
				// rempli le tableau de réponse
				if (input[i].checked == true) {
					ans[i] = 'true';
				} else {
					ans[i] = 'false';
				}
				id = getID(input[i])
		
			}
				
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("message").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","../asp/getAnswerCM.php?idcm=" + id 
															+ "&ans0=" + ans[0]
		 													+ "&ans1=" + ans[1]
			 												+ "&ans2=" + ans[2]
			 												+ "&ans3=" + ans[3], true);
			xmlhttp.send();
			break;
		// TYPE TEXT
		case "txt":
			text = input[0].value;
			id = getID(input[0]);
			
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("message").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","../asp/getAnswerTXT.php?idtxt=" + id + "&text=" + text,true);
			xmlhttp.send();
			break;
		
		default:
			break;
		}
		$("#validate").css("display", "block");
		$("#confirm").css("display", "none");
	}
}

function getJsonStats() {
    var obj, dbParam, xmlhttp, myObj, x, txt = "";
    obj = { "table":"Utilisateur"};
    dbParam = JSON.stringify(obj);
    
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myObj = JSON.parse(this.responseText);
            txt = "<p>Expérience : " + myObj.score + "</p>";
            txt += "<p>Quizz total effectués : " + myObj.nb_quizz + "</p>";
            txt += "<p> - dont " + myObj.nb_quizz_facile + " quizz faciles</p>";
        	txt += "<p> - dont " + myObj.nb_quizz_moyen + " quizz moyens</p>";
        	txt += "<p> - et " + myObj.nb_quizz_difficile + " quizz difficiles</p>";
        	txt += "<p>Classement global : " + myObj.classement + " du site. Pas mal.</p>";
        }
            document.getElementById("demo").innerHTML = txt;
    };
    xmlhttp.open("POST", "../asp/json.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam);
}
function getXMLTable(xml) {
	var i;
	var xmlDoc = xml.responseXML;
	var table="<tr><th>Personnage</th><th>Niveau</th><th>Exp. requise</th>" +
			"<th>Niveau</th><th>Exp. requise</th>" +
			"<th>Niveau</th><th>Exp. requise</th>" +
			"<th>Niveau</th><th>Exp. requise</th></tr>";
	var x = xmlDoc.getElementsByTagName("character");
	
	for (i = 0; i < x.length; i++) { 
	    table += "<tr><td>" +
	    x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue + "</td><td>" +
	    x[i].getElementsByTagName("level")[0].childNodes[1].childNodes[0].nodeValue + "</td><td>" +
	    x[i].getElementsByTagName("level")[0].childNodes[1].getAttribute("exp") + "</td><td>" +
	    
	    x[i].getElementsByTagName("level")[1].childNodes[1].childNodes[0].nodeValue + "</td><td>" +
	    x[i].getElementsByTagName("level")[1].childNodes[1].getAttribute("exp") + "</td><td>" +
	    
	    x[i].getElementsByTagName("level")[2].childNodes[1].childNodes[0].nodeValue + "</td><td>" +
	    x[i].getElementsByTagName("level")[2].childNodes[1].getAttribute("exp") + "</td><td>" +
	    
	    x[i].getElementsByTagName("level")[3].childNodes[1].childNodes[0].nodeValue + "</td><td>" +
	    x[i].getElementsByTagName("level")[3].childNodes[1].getAttribute("exp") + "</td></tr>";
	}
	document.getElementById("scale").innerHTML = table;
}

function getXMLScale() {
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		getXMLTable(this);
	 }
	};
	xhr.open("GET", "../xml/scale.xml", true);
	xhr.send();
}