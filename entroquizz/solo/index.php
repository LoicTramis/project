<?php
    require_once '../include/header.inc.php';
?>
<section>
	<article>
		<h3>Solo</h3>
		<form action="./simple.php" method="get">
			<fieldset>
				<legend>Choisissez les param&egrave;tres du quizz</legend>
				
				<label for="theme">Le th&egrave;me</label>
				<select name="theme" id="theme">
            		<?php 
            		  $nom_themes = get_names_table("nom_theme", "Theme");
            		  
            		  for ($index = 0; $index < count($nom_themes); $index++) {
            		      echo "<option value=\"".$nom_themes[$index]."\">".$nom_themes[$index]."</option>";
            		  }
            		?>
				</select>
				
				<label for="diff">La difficult&eacute;</label>
				<select name="difficulte" id="diff">
            		<option value="facile">Facile</option>
            		<option value="moyen">Moyen</option>
            		<option value="difficile">Difficile</option>
				</select>
				
				<label for="nb">Nombre de questions</label>
				<select name="nombre" id="nb">
            		<option value="5">5</option>
            		<option value="10">10</option>
            		<option value="15">15</option>
            		<option value="20">20</option>
				</select>
				
				<input type="submit" value="Commencer">
			</fieldset>
		</form>
	</article>
</section>
<?php 
    require_once '../include/footer.inc.php';
?>