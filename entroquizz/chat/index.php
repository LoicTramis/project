<?php

require_once '../include/header.inc.php';
require ('./script/functions.php');
require_once '../include/fonctions.inc.php';
delete_msg();
if (!($_SESSION['username'])) {
   echo"<script>alert('Inscris toi pour parler');</script>";
}
else {    
?>

    <section>
        <h2>Chat</h2>
        <article>
            <h3>Vous pouvez parlez ici</h3>
            <form action="#" method="post" style="text-align: center;">
                <p>
                    <label for="message"></label><textarea onKeyPress="if(event.keyCode==13){post(); clear();}" name="message" id="message"  rows="5" cols="40" placeholder="Message ..."></textarea><br />
                    <input type="button" onClick="post(), clear()" value="Envoyer !" />
               </p>
            </form>
            <script>
                function addSmileySmile(){document.getElementById('message').innerHTML += ':)';}function addSmileyClin(){document.getElementById('message').innerHTML += ';)';}function addSmileyLangue(){document.getElementById('message').innerHTML += ':p';}
                function addSmileyRigole(){document.getElementById('message').innerHTML += ':d';}function addSmileyHi(){document.getElementById('message').innerHTML += '^^';}function addSmileyCoeur(){document.getElementById('message').innerHTML += '<3';}
            </script>
           
            <div id="smiley">
                <a onClick="javascript:addSmileySmile()"><img src="./image/sourire.png" /></a>
                <a onClick="javascript:addSmileyClin()"><img src="./image/clin.png" /></a>
                <a onClick="javascript:addSmileyLangue()"><img src="./image/langue.png" /></a>
                <a onclick="javascript:addSmileyRigole()"><img src="./image/rigole.png" /></a>
                <a onClick="javascript:addSmileyHi()"><img src="./image/hihi.png" /></a>
                <a onclick="javascript:addSmileyCoeur()"><img src="./image/coeur.png" /></a>
            </div>
           
            
            <div id="cadre_chat">  </div>
        </article>
    </section>
    </body>
</html>
<?php
}
?>