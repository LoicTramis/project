<?php
    require_once '../include/header.inc.php';
?>
<section>
	<h2>Que voulez-vous faire Ma&icirc;tre <!-- <?php $_SESSION['admin_name']?> --></h2>
	<article>
		<h3>Profil</h3>
	</article>
	
	<article>
		<h3>G&eacute;rer les quizz</h3>
		<a href="./creation.php">Cr&eacute;er des questions</a>
	</article>
	
	<article>
		<h3>Statistiques</h3>
	</article>
</section>
<?php
    require_once '../include/footer.inc.php';
?>