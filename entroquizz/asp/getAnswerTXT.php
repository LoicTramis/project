<?php
require_once '../include/postgres.conf.inc.php';

$id = $_REQUEST['idtxt'];
$answer = $_REQUEST['text'];
$right_answer = "bad";
$query = "  SELECT reponse_exacte, reponse_correct1, reponse_correct2, reponse_correct3
                    FROM Question_texte
                    WHERE id_question = '".$id."'";

$db_connection = pg_connect($confi);
$result = pg_query($db_connection, $query);

while ($row = pg_fetch_row($result)) {
    if(strcasecmp($answer, $row[0]) == 0) {
        $right_answer="good";
    } else if(strcasecmp($answer, $row[1]) == 0) {
        $right_answer="good";
    } else if(strcasecmp($answer, $row[2]) == 0) {
        $right_answer="good";
    } else if(strcasecmp($answer, $row[3]) == 0) {
        $right_answer="good";
    }
}
echo $right_answer;

?>