<?php
    /**
     * Stocke les id question de la table Question(ON/CM/TXT) dans un tableau
     * 
     * @param int $random_type - 0 pour Oui/Non, 1 pour ChoixMultiple et 2 pour Texte
     * @param string $difficulte - facile, moyen, difficile
     * @param string $theme - le nom du theme
     * @return array - tableau d'id
     */
    function random_id($random_type, $difficulte, $theme) {
        include '../include/postgres.conf.inc.php';
        
        $db_connection = pg_connect($confi);
        $ids = array();
        
        switch ($random_type) {
            case 0:
                $query = "  SELECT id_question, nom_theme FROM Question 
                            INNER JOIN Theme ON (Question.id_theme = Theme.id_theme)
                            WHERE nom_theme = '".$theme."' AND difficulte = '".$difficulte."' AND type_question = 'question_on'";
                $result = pg_query($db_connection, $query);
                
                // put all the ids from the database in the php array
                while ($row = pg_fetch_row($result)) {
                    array_push($ids, $row[0]);
                }   
            break;
            case 1:
                // retourne un tableau d'id question en fonction CM et du theme;
                $query = "  SELECT id_question, nom_theme FROM Question
                            INNER JOIN Theme ON (Question.id_theme = Theme.id_theme)
                            WHERE nom_theme = '".$theme."' AND difficulte = '".$difficulte."' AND type_question = 'question_cm'";
                $result = pg_query($db_connection, $query);
                
                // put all the ids from the database in the php array
                while ($row = pg_fetch_row($result)) {
                    array_push($ids, $row[0]);
                }
            break;
            case 2:
                // retourne un tableau d'id question en fonction TXT et du theme;
                $query = "  SELECT id_question, nom_theme FROM Question
                            INNER JOIN Theme ON (Question.id_theme = Theme.id_theme)
                            WHERE nom_theme = '".$theme."' AND difficulte = '".$difficulte."' AND type_question = 'question_texte'";
                $result = pg_query($db_connection, $query);
                
                // put all the ids from the database in the php array
                while ($row = pg_fetch_row($result)) {
                    array_push($ids, $row[0]);
                }
            break;
            
            default:
                echo "<p>Pas reussi</p>";
            break;
        }
        pg_close($db_connection);
        
        return $ids;
    }
?>