<?php
require_once '../include/postgres.conf.inc.php';

$id = $_REQUEST['idtxt'];
$answer = $_REQUEST['text'];
$right_answer = "NOPE";
$query = "  SELECT reponse_exacte, reponse_correct1, reponse_correct2, reponse_correct3
                    FROM Question_texte
                    WHERE id_question = '".$id."'";

$db_connection = pg_connect($confi);
$result = pg_query($db_connection, $query);

while ($row = pg_fetch_row($result)) {
    if ($row[0] == $answer || $row[1] == $answer || $row[2] == $answer || $row[3] == $answer) {
        $right_answer = "OH OUI";
    }
}
echo $right_answer;

?>