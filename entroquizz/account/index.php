<?php
    require_once '../include/header.inc.php';
?>
<section>
	<h2>Bienvenue Michoubichi</h2>
	<article>
	<div id="connect">
		<h3>Connexion</h3>
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
		<div class="hidden" id="register">
		<h3>Cr&eacute;er un compte</h3>
		<form method="post" action="./index.php">
			<fieldset class="signup">
				<legend>Inscription</legend>

					<label for="lastname" >Nom : </label>
					<input name ="lastname" type="text" id ="lastname" placeholder="Entrer votre nom" required>

					<label for="firstname">Pr&eacute;nom : </label>
					<input name ="firstname" type="text" id ="firstname" placeholder="Entrer votre pr&eacute;nom" required>

					<label for="username" > Identifiant : </label>
					<input name ="username" type="text" id ="username" placeholder="Entrer votre surnom" required>

					<label for="email" > E-mail : </label>
					<input name ="email" type="email" id ="email" placeholder="Entrer votre e-mail" required>

					<label for="password">Mot de passe : </label>
					<input name ="password" type ="password" id ="password" placeholder="Entrer votre mot de passe" required>

					<p class="switch">D&eacute;j&agrave; un compte ? <span>Connectez-vous</span></p>

					<div class="reset-button">
						<input type="reset" value="Annuler">
					</div>
					<div class="signin-button">
						<input type="submit" value="S'incrire">
					</div>
				</fieldset>
			</form>
		</div>
	</article>
</section>