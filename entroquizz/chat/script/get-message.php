<?php
header("Content-Type: text/plain");
require('functions.php');
$bdd = bdd_connect();
if($_GET['action'] == 'new') {
$reponse = $bdd->query('SELECT message,login FROM chat_messages ORDER BY id_chat DESC LIMIT 10');
    while ($donnees = $reponse->fetch()){
        $pseudo = $donnees['login'];
        $texte = $donnees['message'];
        $message = smiley($texte);
    	echo '<p><strong>' . $pseudo . '</strong> : ' . $message . '</p>';
    }
    $reponse->closeCursor();
}
if ($_GET['action'] == 'anc') {
  $reponse_2 = $bdd->query('SELECT login, message FROM ancien_message ORDER BY id DESC ');
    while ($donnees_2 = $reponse_2->fetch())
    {
        $pseudo_2 = $donnees_2['login'];
        $texte_2 = $donnees_2['message'];
        $message_2 = smiley($texte_2);
    	echo '<p><strong>' . $pseudo_2 . '</strong> : ' . $message_2 . '</p>';
    }
    $reponse_2->closeCursor();
}
?>