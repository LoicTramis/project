<?php 
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
    	<title>Entroquizz - Version Beta</title>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    	<link href="../css/style.css" rel="stylesheet" type="text/css">
    	<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
    	<script type="text/javascript" src="../js/script.js"></script>
	</head>	
	<body>
		<header>
			<h1><a href="../home/" class="header-logo"></a></h1>
			<div class="right">
				<a href="#"><i class="fa fa-power-off" aria-hidden="true"></i><?php echo "Se connecter";?></a>
			</div>
			<div id="connect">
				<form method="post" action="./index.php">
    				<fieldset class="signin">
    				<legend >Connexion</legend>
    					<label for="login" > Identifiant : </label>
    					<input name ="login" type="text" id ="login">
    
    					<label for="password_signin">Mot de passe : </label>
    					<input name ="password" type ="password" id ="password_signin">
    
    					<p class="switch">Pas encore de compte ? <span>Inscrivez-vous</span></p>
    
    					<div class="reset-button">
    						<input type="reset" value="Annuler">
    					</div>
    					<div class="signin-button">
    						<input type="submit" value="Se connecter">
    					</div>
    				</fieldset>
    			</form>
    		</div>
		</header>
		<nav>
			<ul>
				<li>	
					<a href="../solo/">Solo</a>
        			<ul>
        				<li>Simple</li>
        				<li>Al&eacute;atoire</li>
        				<li>Chronom&eacute;tr&eacute;e</li>
        			</ul>
				</li>
				<li>
					<a href="../multi/">Multi-joueur</a>
					<ul>
						<li>Temps limit&eacute;</li>
						<li>Mort subite</li>
						<li>D&eacute;s&eacute;quilibre</li>
						<li>Expansion (&Agrave; venir)</li>
					</ul>
				</li>
				<li><a href="../account/">Mon compte</a></li>
				<li><a href="../admin/">G&eacute;rer le site</a></li>
				<li>Statistiques</li>
				<li>Historique</li>
				<li>Param&egrave;tres</li>
				<li>&Agrave; propos</li>
			</ul>
		</nav>