<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Bienvenue <?php echo (is_admin() ? "".$_SESSION['username']."" : "casu");?></h2>
	<article>
		<h3>infos pour la bd</h3>
		<?php 
		  if (is_connected()) {
		      echo "connecté";
		  } else {
		      echo "pas connecté";
		  }
		?>
		<a href="loggout.php">Deconnexion</a>
	</article>
</section>

<?php 
    require_once '../include/footer.inc.php';
?>