<?php
require_once '../include/header.inc.php';
require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Les tables</h2>
	<article>
		<h3>Les th&egrave;mes</h3>
		<?php
		  echo get_table("Theme");		  
		?>
	</article>
</section>