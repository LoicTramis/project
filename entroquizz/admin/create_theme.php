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
    	            <input type="text" name="theme" id="theme" autofocus="autofocus" required/>
    	            
    	            <label for="soustheme">Sous-th&egrave;me :</label>
    	            <input type="text" name="soustheme" id="soustheme"/>
    	            
                    <input type="submit" value="Enregistrer"/>
            	</fieldset>
            </form>
            
            <?php 
                
                if(isset($_GET['theme'])){
                    $connexion = pg_connect($confi);
                    $nom_theme = pg_escape_string($_GET['theme']);
                    $sous_theme =(empty($_GET['soustheme'])) ? '' : pg_escape_string($_GET['soustheme']);
                    
                    $query = " SELECT count(*) FROM Theme WHERE  nom_theme ILIKE '$nom_theme' AND  sous_theme ILIKE '$sous_theme' ";
                    
                    $result = pg_query($query);
                    $data = pg_fetch_row($result);
                    
                    if($data[0] == 0){
                        //Inserer les données dans la base de donnée
                        $psql ="INSERT INTO Theme (nom_theme,sous_theme) VALUES ('".$nom_theme."','".$sous_theme."')";
                        //execution de la requete
                        $req=pg_query($connexion,$psql);
        
                        //Test si l'insertion a été effectué
                       if (!$req) {
                          echo "<p class=\"error\">".pg_last_error()."</p>";
                       } else {
                          echo "<p class=\"success\">Th&egrave;me : \"".$_GET['theme']."\" enregist&eacute; !</p>";
                       }    
                        pg_close($connexion);
                    }
                }
                
                if(isset($_GET['themeN'])){
                    include_once '../include/postgres.conf.inc.php';
                    
                    $connexion = pg_connect($confi);
                    $p = $_GET['themeN'];
                    $req2 = " UPDATE Theme SET nom_theme = ".$p." WHERE id_theme = ".$_GET['updateid'];
                    $req=pg_query($connexion,$req2);
                    pg_close($connexion);
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
                    pg_close($connexion);
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
