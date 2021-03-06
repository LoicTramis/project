function getXMLHttpRequest() {
    var xhr = null;
     
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur est obsolète, veuillez en changer.");
        return null;
    }
     
    return xhr;
}

function request(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            
      callback(xhr.responseText);
            
        }
    };
 var action  = encodeURIComponent('new');
   xhr.open("GET", "../chat/script/get-message.php?action=" + action, true);
    xhr.send(null);
     
    
}
 
function readData(sData) {    
    if (sData.length > 0) {
  document.getElementById('cadre_chat').innerHTML = sData;
  }
  else {
  document.getElementById('cadre_chat').innerHTML = '<center><b>Pas de messages pour le moment.</b></center>';
  }
}
setInterval('request(readData)',50);

function post() {
  var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
          callback(xhr.responseText);
          write(msg);
        }
    };
    var msg = encodeURIComponent(document.getElementById("message").value);
      xhr.open("GET", "../chat/script/post.php?message=" + msg, true);
      xhr.send(null);
    document.getElementById("message").value = '';
}


