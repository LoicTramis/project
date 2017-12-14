<?php
    require_once '../include/postgres.conf.inc.php';
    
    $id = $_REQUEST['idcm'];
    $ans0 = $_REQUEST['ans0'];
    $ans1 = $_REQUEST['ans1'];
    $ans2 = $_REQUEST['ans2'];
    $ans3 = $_REQUEST['ans3'];
    $right_answer = "bad";
    $query = "  SELECT reponse_1, reponse_2, reponse_3, reponse_4
                    FROM Question_cm
                    WHERE id_question = '".$id."'";
    
    $db_connection = pg_connect($confi);
    $result = pg_query($db_connection, $query);
    
    while ($row = pg_fetch_row($result)) {
        if ($row[0] == $ans0 && $row[1] == $ans1 && $row[2] == $ans2 && $row[3] == $ans3) {
            $right_answer = "good";
        }
    }
    echo $right_answer;
?>