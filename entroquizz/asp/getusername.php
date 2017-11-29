<?php
    require_once '../include/postgres.conf.inc.php';
    
    $name = $_REQUEST['name'];
    $username = "";
    $query = " SELECT login FROM Utilisateur WHERE login = '".$name."'";
    
    $db_connection = pg_connect($confi);
    $result = pg_query($db_connection, $query);
    
    while ($row = pg_fetch_assoc($result)) {
        if ($name == $row['login']) {
            $username = "Pseudo existe d&eacute;j&agrave; !";
        }
    }
    echo $username;
?>