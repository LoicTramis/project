<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    
    include '../include/postgres.conf.inc.php';
    
    if (isset($_SESSION["username"])){
        $req="SELECT nombre_points,
                     nombre_quizz,
                     nb_quizz_facile,
                     nb_quizz_moyen,
                     nb_quizz_difficile,
                     classement
              FROM Utilisateur WHERE login='".$_SESSION["username"]."'";
        
        $obj = json_decode($_POST["x"], false);
        
        $dbconn = pg_connect($confi);
        $result=pg_query($dbconn,$req);
        
        while ($row = pg_fetch_row($result)) {
            $donnees=array(
                "score" => $row[0],
                "nb_quizz" => $row[1],
                "nb_quizz_facile" => $row[2],
                "nb_quizz_moyen" => $row[3],
                "nb_quizz_difficile" => $row[4],
                "classement" => $row[5],
            );
        }
        pg_close($dbconn);
        
        echo json_encode($donnees);
    }
?>