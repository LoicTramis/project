<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Le script d'installation bient&ocirc;t ici</h2>
	<a href="formulaire_insertionquestion.php">Cr&eacute;er des questions</a>
	<a href="scriptinserttheme.php">Cr&eacute;er un th&egrave;me</a>
	<?php 
	   $tab = random_id(1, "facile", "Espace");
	   $max_tab = count($tab);
	   
	   for ($index = 0; $index < $max_tab; $index++) {
	       echo "<p>".$tab[$index]."</p>";
	   }
	?>
</section>
<?php 
    require_once '../include/footer.inc.php';
?>