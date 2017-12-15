<?php
	session_start();
	require('functions.php');
	$bdd = bdd_connect();
	$no = time();
	//delete_msg();
 	$sql = "INSERT INTO chat_messages (message,login,timestamp,date_heure) VALUES ('".$_GET['message']."','".$_SESSION['username']."','".$no."',now())";
	$result = $bdd->prepare($sql);
	$result->execute();
	header('Location: index.php');
?>
