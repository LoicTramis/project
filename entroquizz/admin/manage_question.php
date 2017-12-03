<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Les tables</h2>
	<article>
		<h3>Les questions</h3>
		<?php
		  echo get_table("Question");		  
		?>
	</article>
	
	<article>
		<h3>Les questions CM</h3>
		<?php
		  echo get_table("Question_cm");		  
		?>
	</article>
	
	<article>
		<h3>Les question ON</h3>
		<?php 
		  echo get_table("Question_on");
		?>
	</article>
	
	<article>
		<h3>Les question Texte</h3>
		<?php 
		  echo get_table("Question_texte");
		?>
	</article>
</section>