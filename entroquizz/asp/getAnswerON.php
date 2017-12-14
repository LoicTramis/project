<?php
    require_once '../include/postgres.conf.inc.php';
    
    $id = $_REQUEST['idon'];
    $user = $_REQUEST['user'];
    $right_answer = "bad";
    $query = "  SELECT reponse 
                FROM Question_on
                WHERE id_question = '".$id."'";
    
    $db_connection = pg_connect($confi);
    $result = pg_query($db_connection, $query);
    
    $row = pg_fetch_array($result);
    
    if (($row[0]== 't' && $user == 'true') || ($row[0] == 'f' && $user == 'false')) {
        $right_answer = "good";
    }
    echo $right_answer;        

?>