<?php
require_once '../include/header.inc.php';
require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Les tables</h2>
	<article>
		<h3>Les utilisateur</h3>
		<?php
		  echo get_table("Utilisateur");		  
		?>
	</article>
</section>