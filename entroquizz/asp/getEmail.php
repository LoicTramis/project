<?php
    require_once '../include/postgres.conf.inc.php';
    
    $email = $_REQUEST['email'];
    $text = "";
    $query = " SELECT email FROM Utilisateur WHERE lower(email) = lower('".$email."')";
    
    $connexion = pg_connect($confi);
    $result = pg_query($connexion, $query);
    $row = pg_fetch_array($result);
    
    if (strcasecmp($row[0], $email) == 0 && $email != "") {
        $text = "Email existe d&eacute;j&agrave; !";
    }
    echo $text;
    
    pg_free_result($result);
    pg_close($connexion);
?>