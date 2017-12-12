<?php
require_once '../include/header.inc.php';
require_once '../include/fonctions.inc.php';

function chargerClasse($classe) {
    include './'.$classe.'.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

?>
<section>
	<h2>Quizz solo</h2>
	<article>
		<h3>Mode : Simple</h3>
		
		<?php
		
		  if (isset($_GET['theme']) && isset($_GET['difficulte']) && isset($_GET['nombre'])) {
		      $theme = $_GET['theme'];
		      $difficulte = $_GET['difficulte'];
		      $nombre = $_GET['nombre'];
		      
		      echo html_quizz(return_questions_of_quizz($theme, $nombre, $difficulte), $difficulte, $theme);
		  } else {
		      echo simple_quizz_form();
		  }
		?>
		<p id="re"></p>
		<p id="message"></p>
	</article>
</section>

