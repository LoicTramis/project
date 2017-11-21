<?php
    require_once '../include/header.inc.php';
    
   function Tableau($req ){
        $stid = pg_query($req);
        $res ="<table>\n";
        $nbcol = pg_num_fields($stid);
        $res.= "<tr>\n";
        for($i = 0; $i < $nbcol; $i++){
            $res.= "<th>".pg_field_name($stid, $i)."</th>\n";
        }
        $res.= "</tr>";
        while ($row = pg_fetch_array($stid,null,PGSQL_ASSOC)) {
            $res.= "<tr>\n";
            foreach ($row as $item) {
                $res.="<td>" .$item. "</td>\n";
            }
               $res.= "</tr>\n";
        }
        $res.= "</table>\n";
        pg_free_result($stid);
        return $res;
    }
?>
<section>
        <form method="post" >

            <label>Theme </label> : <input type="text" name="theme" id="theme" required />
            <input type="submit" value="Enregistrer"/>

        </form>
        <?php
//
            if(isset($_POST['theme'])){
                include('../include/postgres.conf.inc.php');
                $dbconn = pg_connect($confi);
                $nom_theme = $_POST['theme'];
                $nomt_heme = pg_escape_string($nom_theme);//Protège la chaîne et la retourne au format PostgreSQL
                //Inserer les données dans la base de donnée
                $psql ="INSERT INTO Theme (nom_theme) VALUES ('".$nom_theme."')";
                //execution de la requete
                $req=pg_query($dbconn,$psql);

                //Test si l'insertion a été effectué
               if(!$req) {
                  echo pg_last_error();
               } else {
                  echo "Enregistrement réussi avec succès\n";
                    echo Tableau("SELECT * FROM Theme");    
                    echo'<form method="post" >
                        <input type="text" name="themel" id="theme" required />
                        <input type="submit" value="Enregistrer"/>
                    </form>';

                    echo'<form method="post" >
                        <input type="text" name="themei" id="theme" required />
                        <input type="text" name="themeN" id="theme" required />
                        <input type="submit" value="Enregistrer"/>
                    </form>';
               }
              pg_close($dbconn);
               
            }
        ?>
        <?php 
            if (isset($_POST['themel'])) {
                include('../include/postgres.conf.inc.php');
                $dbconn = pg_connect($confi);
                $req1="DELETE FROM Theme WHERE id_theme = ".$_POST['themel'];
                $req=pg_query($dbconn,$req1);
                echo Tableau("SELECT * FROM Theme");
                pg_close($dbconn);
            }
            if(isset($_POST['themeN'])){
                include('../include/postgres.conf.inc.php');
                $dbconn = pg_connect($confi);
                $p = $_POST['themeN'];
                $req2 = " UPDATE Theme SET nom_theme = '$p' WHERE id_theme = ".$_POST['themei'];
                $req=pg_query($dbconn,$req2);
                echo Tableau("SELECT * FROM Theme");
                pg_close($dbconn);
            }
           
        ?>
        </section>
    </body>

</html>
