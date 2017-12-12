<?php 
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Statistques</h2>
	<article>
		<h3>Classement global</h3>
		<?php 
		  echo get_global_ranking();
		?>
	</article>
	<article>
		<h3>D&eacute;tails (JSON)</h3>
        <?php 
        if (isset($_SESSION["username"])){
            echo '<button id="ouioui" onclick="getJsonStats()">Voir vos statistiques</button>';
        } else {
            echo "<p class=\"warning\">Connectez-vous pour voir vos statistiques</p>";
        }
        ?>
        <div id="demo"></div>
	</article>
    <article>
    	<h3>Le bar&egrave;me de niveau (XML)</h3>
    	<button onclick="getXMLScale()">Voir le bar&egrave;me</button>
    	<table id="scale"></table>
    	<button>T&eacute;l&eacute;charger le bar&egrave;me</button>
	</article>
</section>
<?php
    require_once '../include/footer.inc.php';
?>