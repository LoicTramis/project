<?php
    require_once '../include/header.inc.php';
    require_once '../include/postgres.conf.inc.php';
    require_once '../include/fonctions.inc.php';
    
    
?>

<section>
		<h2>Cr&eacute;er un th&egrave;me</h2>
		
		<article>
			<h3>Ins&eacute;rer un th&egrave;me</h3>
            <form class="creation" action="./create_theme.php" method="get">
            	<fieldset>
            		<legend>Choisissez le th&egrave;me</legend>
            		
        	        <label for="theme">Nom du th&egrave;me : </label>
    	            <input type="text" name="theme" id="theme" required/>
    	            
                    <input type="submit" value="Enregistrer"/>
            	</fieldset>
            </form>
            
            <?php 
                $dbconn = pg_connect($confi);
                
                if(isset($_GET['theme'])){
                    $nom_theme = pg_escape_string($_GET['theme']);
                    //Inserer les données dans la base de donnée
                    $psql ="INSERT INTO Theme (nom_theme) VALUES ('".$nom_theme."')";
                    //execution de la requete
                    $req=pg_query($dbconn,$psql);
    
                    //Test si l'insertion a été effectué
                   if (!$req) {
                      echo pg_last_error();
                   } else {
                      echo "<p class=\"success\">Th&egrave;me : \"".$_GET['theme']."\" enregist&eacute; !</p>";
                   }    
                }
                if(isset($_GET['themeN'])){
                    $p = $_GET['themeN'];
                    $req2 = " UPDATE Theme SET nom_theme = ".$p." WHERE id_theme = ".$_GET['updateid'];
                    $req=pg_query($dbconn,$req2);
                }
                if (isset($_GET['delete'])) {
                    $req1="DELETE FROM Theme WHERE id_theme = ".$_GET['delete'];
                    $req=pg_query($dbconn,$req1);
                }
                pg_close($dbconn);
            ?>
		</article>
	
		<article>
			<h3>La table Th&egrave;me</h3>
		
    		<?php
                // affichage de la table
                echo get_table("Theme");
            ?>
		</article>
	</section>
</body>

</html>
