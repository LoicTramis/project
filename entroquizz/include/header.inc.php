<?php
    // end the session when the browser is closed
    session_set_cookie_params(0,'/');
    // start a new session or resume the last one
    session_start();
    
    require_once '../include/fonctions.inc.php';
    
    // if the user logs in correctly redirect to loggin.php then go back the previous page
    if (isset($_POST['c_login']) && isset($_POST['c_password'])) {
        connect_user();
        
        header("Status: 301 Moved Permanently", false, 301);
        header('Location: '.$_SERVER['HTTP_REFERER']); // retourne a la page precedente
        
        exit();
    }
    
    // if the user signs in correctly redirect to loggin.php then get back to the previous page
    if (isset($_POST['r_username']) && isset($_POST['r_email']) && isset($_POST['r_password']) && isset($_POST['r_repassword']) && isset($_POST['r_tribe'])) {
        if (($_POST['r_password'] == $_POST['r_repassword']) && !empty($_POST['r_password']) && !empty($_POST['r_repassword'])) {
            $username =     $_POST['r_username'];
            $email =        $_POST['r_email'];
            $password =     $_POST['r_password'];
            $tribe =        $_POST['r_tribe'];
            
            // user is not in the database
            if (!is_in_database("Utilisateur", "login", $username)) {
                // enreistrer dans la BD
                register_user($username, $email, $password, $tribe);
                connect_user();
                
                header("Status: 301 Moved Permanently", false, 301);
                header('Location: '.$_SERVER['HTTP_REFERER']); // retourne a la page precedente
                
                exit();
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
    	<title>Entroquizz - Version Beta</title>
    	<meta charset="utf-8">
    	<link href="../css/style.css" rel="stylesheet" type="text/css">
    	<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
    	<link href="../css/ionicons.css" rel="stylesheet" type="text/css">
    	<script src="../js/jquery-3.2.1.js"></script>
    	<script src="../js/script.js"></script>
    	<script src="../js/ajax.js"></script>
    	<script src="https://www.google.com/recaptcha/api.js"></script> <!-- reCAPTCHA -->
	</head>	
	<body>
        <!-- transparent background for the log in div -->
		<div id="frontground" style="display: none;"></div>
		<header>
			<h1 class="hidden">Entroquizz</h1>
			<ul>
				<li><a href="../home/" class="header-logo"></a></li>
			<?php 
			    // user is not logged in
			    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
			        echo "<li><i class=\"fa fa-power-off\"></i>".$_SESSION['username']."</li>";
    			// user is logged in
			    } else {
    				echo "<li onclick=\"popup_login()\" id=\"signin\"><i class=\"fa fa-power-off\"></i>Se connecter</li>";	
			    }
			?>
			</ul>

		</header>
		<nav>
			<ul>
				<li>	
					<p id="flip-solo">Solo</p>
        			<ul id="panel-solo">
        				<li><a href="../solo/">Simple</a></li>
        				<li><a href="#">Al&eacute;atoire</a></li>
        				<li><a href="#">Chronom&eacute;tr&eacute;e</a></li>
        			</ul>
				</li>
				<li>
					<p id="flip-multi">Multi-joueur</p>
					<ul id="panel-multi">
						<li><a href="#">Temps limit&eacute;</a></li>
						<li><a href="#">Mort subite</a></li>
						<li><a href="#">D&eacute;s&eacute;quilibre</a></li>
						<li><a href="#">Expansion</a></li>
					</ul>
				</li>
				<li><a href="../account/">Mon compte</a></li>
				<li><a href="../admin/">G&eacute;rer le site</a></li>
				<li><a href="../account/">Statistiques</a></li>
				<li><a href="../account/">Historique</a></li>
				<li><a href="../account/">Param&egrave;tres</a></li>
				<li><a href="../account/">&Agrave; propos</a></li>
			</ul>
		</nav>
		<div id="connect" style="display: none;">
			<form method="post" action="../account/loggin.php" class="signin">
				<fieldset>
				<legend >Connexion</legend>
					<div class="i-block">
						<label for="login" > Identifiant :</label>
						<input name ="c_login" type="text" id ="login" placeholder="Pseudo" required>
						<i class="fa fa-user-o"></i>					
					</div>
					
					<div class="i-block">
						<label for="password_signin">Mot de passe :</label>
						<input name ="c_password" type ="password" id ="password_signin" placeholder="Mot de passe" required>
						<i class="fa fa-lock"></i>
					</div>
					
					<div class="buttons">
						<input type="submit" value="&#xf121;" title="Se connecter">
					</div>
				</fieldset>
			</form>
			<p class="switch"><span>Inscrivez-vous</span></p>
		</div>
		<div id="register" style="display: none;">
		<form method="post" action="../account/loggin.php">
			<fieldset class="signup">
				<legend>Inscription</legend>
					<div class="i-block">
						<label for="username"> Identifiant : </label>
						<input name="r_username" type="text" id="username" placeholder="Pseudonyme" onkeyup="getUsername(this.value)" required>
						<i class="fa fa-user-o"></i>					
					</div>
					
					<div class="i-block">
						<label for="email" > E-mail : </label>
						<input name="r_email" type="email" id="email" placeholder="E-mail" onkeyup="getEmail(this.value)" required>	
						<i class="fa fa-envelope-o"></i>									
					</div>

					<div class="i-block">
						<label for="password">Mot de passe : </label>
						<input name ="r_password" type="password" id="password" placeholder="Mot de passe" required>
						<i class="fa fa-lock"></i>					
					</div>

					<div class="i-block">
						<label for="repassword">Mot de passe : </label>
						<input name="r_repassword" type="password" id="repassword" placeholder="Retaper le mot de passe" required>
						<i class="fa fa-unlock-alt"></i>					
					</div>

					<div class="i-block">
						<label for="dragonball" style="display: block; width: 100%;">Votre personnage : </label>
						<select name="r_tribe" id="dragonball">
							<optgroup label="Sa&iuml;yan">
    							<option value="sangoku">San Goku</option>		
    							<option value="vegeta">Vegeta</option>
    							<option value="sangohan">San Gohan</option>		
    							<option value="trunk">Trunk</option>		
							</optgroup>
									
							<optgroup label="Antagoniste">
								<option value="piccolo">Piccolo</option>									
								<option value="freezer">Freezer</option>		
								<option value="cell">Cell</option>		
								<option value="boo">Boo</option>
							</optgroup>
						</select>
						<i class="fa fa-users"></i>					
					</div>
					
                    <!-- For loictramis.esy.es -->
<!-- 					<div class="g-recaptcha" data-sitekey="6LfwnToUAAAAAKM27KltUD-fXUgFjNxPbG6s2vk8"></div> -->
                    <!-- For college server -->
					<div class="g-recaptcha" data-sitekey="6LeEnjoUAAAAAGRQtzVI5Fsdjf_mwYkRXu1ja13Y"></div>
					
					<p class="message" id="oui"></p>
					
					<div class="buttons">
						<input type="submit" value="&#xf121;" title="S'enregistrer">
					</div>
				</fieldset>
			</form>
			<p class="switch"><span>Connectez-vous</span></p>
		</div>