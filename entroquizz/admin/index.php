<?php
    require_once '../include/header.inc.php';
?>
<section>
	<h2>Que voulez-vous faire Ma&icirc;tre <?php echo (isset($_SESSION['admin']) && $_SESSION['admin'] == true ? $_SESSION['username'] : "");?></h2>
	<article>
		<h3>Ins&eacute;rer dans la base de donn&eacute;es</h3>
		<a href="./create_theme.php">Cr&eacute;er un th&egrave;me</a>
		<a href="./create_question.php">Cr&eacute;er des questions</a>
	</article>
	
	<article>
		<h3>Visualiser la base de donn&eacute;es</h3>
		<a href="./manage_theme.php">Voir les th&egrave;mes</a>
		<a href="./manage_question.php">Voir les questions</a>
		<a href="./manage_account.php">Voir les comptes utilisateurs</a>
	</article>

</section>
<?php
    require_once '../include/footer.inc.php';
?>