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
	console.log(type);
	
	switch (type) {
	// TRUE OR FALSE
	case "on":
		input = document.getElementById(type).getElementsByClassName("q-on");
		console.log(input.length);
		
		for (i = 0; i < input.length; i++) {
			if (input[i].checked == true) {
				user = input[i].value;
				id = getID(input[i])
				console.log(user + " user entree");
				console.log(id + " id entree");
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("non").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","../asp/getAnswerON.php?idon=" + id + "&user=" + user,true);
				xmlhttp.send();
			}
		}
		break;
	// MULTIPLE CHOICE
	case "cm":
		input = document.getElementById(type).getElementsByClassName("q-cm");
		console.log(input.length);
		
		for (i = 0; i < input.length; i++) {
			// rempli le tableau de réponse
			if (input[i].checked == true) {
				ans[i] = 'true';
			} else {
				ans[i] = 'false';
			}
			id = getID(input[i])

			console.log(ans[i] + " user value num:"+(i+1));
		}
			
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("non").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","../asp/getAnswerCM.php?idcm=" + id + "&ans0=" + ans[0]
	 													+ "&ans1=" + ans[1]
		 												+ "&ans2=" + ans[2]
		 												+ "&ans3=" + ans[3], true);
		xmlhttp.send();
		break;
	// TYPE TEXT
	case "txt":
		input = document.getElementById(type).getElementsByClassName("q-txt");
		
		text = input[0].value;
		id = getID(input[0]);
		console.log(user + " user entree");
		console.log(id + " id entree");
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("non").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","../asp/getAnswerTXT.php?idtxt=" + id + "&text=" + text,true);
		xmlhttp.send();
		break;

	default:
		break;
	}	
}