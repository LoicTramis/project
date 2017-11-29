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
	xmlhttp.open("GET","../asp/getusername.php?name=" + name,true);
	xmlhttp.send();
}