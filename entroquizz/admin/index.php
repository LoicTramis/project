<?php
    require_once '../include/header.inc.php';
?>
<section>
	<h2>Que voulez-vous faire Ma&icirc;tre <?php echo (isset($_SESSION['admin']) && $_SESSION['admin'] == true ? $_SESSION['username'] : "");?></h2>
	<article>
		<h3>Profil</h3>
	</article>
	
	<article>
		<h3>G&eacute;rer les quizz</h3>
		<a href="./creation.php">Cr&eacute;er des questions</a>
		<a href="./manage_question.php">Voir les questions</a>
	</article>
	
	<article>
		<h3>Statistiques</h3>
	</article>
</section>
<?php
    require_once '../include/footer.inc.php';
?>