<?php
    require_once '../include/header.inc.php';
    require_once '../include/postgres.conf.inc.php';
    require_once '../include/fonctions.inc.php';
    
    
?>

<section>
		<h2>G&eacute;rer les th&egrave;me</h2>
		
		<article>
			<h3>Ins&eacute;rer un th&egrave;me</h3>
            <form class="creation-theme" action="./create_theme.php" method="get">
            	<fieldset>
            		<legend>Choisissez le th&egrave;me</legend>
            		
        	        <label for="theme">Nom du th&egrave;me : </label>
    	            <input type="text" name="theme" id="theme" required/>
    	            
                    <input type="submit" value="Enregistrer"/>
            	</fieldset>
            </form>
            
            <?php 
                
                if(isset($_GET['theme'])){
                    $nom_theme = pg_escape_string($_GET['theme']);
                    
                    if (is_in_database("Theme", "nom_theme", $nom_theme)) {
                        echo "<p class=\"warning\">D&eacute;j&agrave; dans la base de donn&eacute;es</p>";
                    } else {
                        $dbconn = pg_connect($confi);
                        //Inserer les données dans la base de donnée
                        $psql ="INSERT INTO Theme (nom_theme) VALUES ('".$nom_theme."')";
                        //execution de la requete
                        $req=pg_query($dbconn,$psql);
        
                        //Test si l'insertion a été effectué
                       if (!$req) {
                          echo "<p class=\"error\">".pg_last_error()."</p>";
                       } else {
                          echo "<p class=\"success\">Th&egrave;me : \"".$_GET['theme']."\" enregist&eacute; !</p>";
                       }    
                        if(isset($_GET['themeN'])){
                            $p = $_GET['themeN'];
                            $req2 = " UPDATE Theme SET nom_theme = ".$p." WHERE id_theme = ".$_GET['updateid'];
                            $req=pg_query($dbconn,$req2);
                        }
                        pg_close($dbconn);
                    }
                }
                
                if (isset($_GET['delete_id']) && isset($_GET['delete_name'])) {
                    include_once '../include/postgres.conf.inc.php';
                    
                    $query = "DELETE FROM Theme WHERE id_theme = ".$_GET['delete_id'];
                    
                    $connexion = pg_connect($confi);
                    $result = pg_query($connexion, $query);
                    
                    //Test si l'insertion a été effectué
                    if (!$result) {
                        echo "<p class=\"error\">".pg_last_error()."</p>";
                    } else {
                        echo "<p class=\"success\">Th&egrave;me : \"".$_GET['delete_name']."\" supprim&eacute; !</p>";
                    }  
                    
                }
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
