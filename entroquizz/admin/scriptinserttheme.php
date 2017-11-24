<?php
    require_once '../include/header.inc.php';
    require_once '../include/postgres.conf.inc.php';
    
   function Tableau($req){
        $stid = pg_query($req);
        $res ="<table>\n<tr>\n";
        $nbcol = pg_num_fields($stid);
        for($i = 0; $i < $nbcol; $i++){
            $res.= "<th>".pg_field_name($stid, $i)."</th>\n";
        }
        $res.= "</tr>";
        while ($row = pg_fetch_array($stid)) {
            $res.= "<tr>\n
                        <td>" .$row[0]. "</td>\n
                        <td>" .$row[1]. "</td>\n
                        <td><a href=\"?updateid=".$row[0]."\" class=\"icon\"><i class=\"fa fa-pencil warning\"></i></a></td>\n
                        <td><a href=\"?delete=".$row[0]."\" class=\"icon\"><i class=\"fa fa-trash-o error\"></i></td>\n
                    </tr>\n";
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
            $dbconn = pg_connect($confi);
            if(isset($_POST['theme'])){
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
                    echo'<form method="post" action="#">
                        <input type="text" name="themel" id="theme" required />
                        <input type="submit" value="Enregistrer"/>
                    </form>';

                    echo'<form method="post" action="#">
                        <input type="text" name="themei" id="theme" required />
                        <input type="text" name="themeN" id="theme" required />
                        <input type="submit" value="Enregistrer"/>
                    </form>';
               }    
               
            }
            if(isset($_POST['themeN'])){
                $p = $_POST['themeN'];
                $req2 = " UPDATE Theme SET nom_theme = ".$p." WHERE id_theme = ".$_GET['updateid'];
                $req=pg_query($dbconn,$req2);
            }
            if (isset($_GET['delete'])) {
                $req1="DELETE FROM Theme WHERE id_theme = ".$_GET['delete'];
                $req=pg_query($dbconn,$req1);
            }
    echo Tableau("SELECT * FROM Theme");
    pg_close($dbconn);
           
        ?>
</section>
    </body>

</html>
