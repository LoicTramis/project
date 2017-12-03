<?php
    require_once '../include/postgres.conf.inc.php';
    
    $id = $_REQUEST['idon'];
    $user = $_REQUEST['user'];
    $right_answer = "NOPE";
    $query = "  SELECT reponse 
                FROM Question_on
                WHERE id_question = '".$id."'";
    
    $db_connection = pg_connect($confi);
    $result = pg_query($db_connection, $query);
    
    while ($row = pg_fetch_row($result)) {
        if (($row[0]== 't' && $user == 'true') || ($row[0] == 'f' && $user == 'false')) {
            $right_answer = " OJ OUI";
        }
    }
    echo $right_answer;

?>