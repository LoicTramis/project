<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Probl&egrave;me durant la connexion</h2>
	<article>
		<h3></h3>
		<?php 
		if (!(isset($_POST['r_username'])
		    && isset($_POST['r_email'])
		    && isset($_POST['r_password'])
		    && isset($_POST['r_repassword'])
		    && isset($_POST['r_tribe']))) {
		        
		    if (!empty($_SESSION['username']) && isset($_SESSION['username'])) {
		            echo "<p class=\"warning\">Pourquoi &ecirc;tes-vous sur cette page ".$_SESSION['username']." ! Vous &ecirc;tes d&eacute;j&agrave; enregistr&eacute;e</p>";
		        } else {
		            echo "<p class=\"warning\">Vous n'&ecirc;tes pas connect&eacute;s ou il y a des champs mal remplis.</p>";
		        }
		    }
		    foreach ($_POST as $value) {
		        echo "<p>".$_POST[$value]."</p>";
		    }
		?>
	</article>
</section>

<?php 
    require_once '../include/footer.inc.php';
?>