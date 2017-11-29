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
    
    /**
     * Store user informations in the PostgreSQL database.
     * 
     * @param String $username
     * @param String $email
     * @param String $password
     * @param String $tribe
     */
    function register_user($username, $email, $password, $tribe) {
        include '../include/postgres.conf.inc.php';
        
        $enc_username = utf8_decode($username);
        $hash_password = password_hash($password, PASSWORD_DEFAULT); // encrypted password
        $avatar = $tribe; // get the icon for the character (inc)
        
        $db_connection = pg_connect($confi);
        
        // SQL query
        $insert_query = "   INSERT INTO Utilisateur (login, email, motdepasse, admini, avatar, badge_niveau, ip)
                            VALUES ('".$enc_username."', '".$email."', '".$hash_password."', false, '".$avatar."', '', '12121212')"; 
        $result_query = pg_query($db_connection, $insert_query);
        
        // the query failed
        if(!$result_query) {
            echo pg_last_error();
        }
        else {
            echo "<p>Enregistrement r&eacute;ussi avec succ&egrave;s</p>";
        }
        pg_close($db_connection);
    }

    /**
     * WARNING : Use this after the form loggin only
     * Check if the user is the database and set the session
     */
    function connect_user() {
        include '../include/postgres.conf.inc.php';
        
        $select_query = "SELECT * FROM Utilisateur";
        
        $db_connection = pg_connect($confi);
        $result_query = pg_query($select_query);
        
        // the user logs in 
        if (isset($_POST['c_login']) && isset($_POST['c_password']) && !empty($_POST['c_login']) && !empty($_POST['c_password'])) {
            $login = $_POST['c_login'];
            $password = $_POST['c_password'];
        }
        // the user signs in
        if (isset($_POST['r_username']) && isset($_POST['r_password']) && !empty($_POST['r_username']) && !empty($_POST['r_password'])) {
            $login = $_POST['r_username'];
            $password = $_POST['r_password'];
        }
       
        // read all data row to row
        while ($row = pg_fetch_array($result_query)) {
            // user is in the database and password is good
            if ($login == $row[1] && password_verify($password, $row[3])) {
                $_SESSION['username'] = utf8_encode($row[1]);
                $_SESSION['email'] = $row[2];
                ($row[4] == 't' ? $_SESSION['admin'] = true : $_SESSION['admin'] = false);
                $_SESSION['avatar'] = $row[5];
            }
        }
        pg_close($db_connection);
    }
    
    /**
     * Check if the username string already exists in the database (case insensitive)
     * 
     * @param String $username
     * @return boolean
     */
    function is_in_database($username) {
        include '../include/postgres.conf.inc.php';
        
        $select_query = "SELECT count(*) FROM Utilisateur WHERE login='".pg_escape_string($username)."'";
        
        $db_connection = pg_connect($confi);
        $result_query = pg_query($select_query) or die('Erreur SQL !'.$sql.'<br />'.pg_last_error());
        $nb_username = pg_fetch_row($result_query);
        // case insensitive comparison
        if (strcasecmp($username, $nb_username[0])) {
            return true;
        } else {
            return false;
        }
        pg_close($db_connection);
    }
    
    function return_donnees_question($id) { //RETOURNE DANS UN TABLEAU KEY => VALUE LES CHAMPS COMMUNS A TOUTES LES QUESTIONS
        include ('../include/postgres.conf.inc.php');
        
        $dbconn = pg_connect($confi);
        $donnees = array();
        $query = "  SELECT id_question, type_question, text_question, difficulte, id_theme FROM Question
                    WHERE id_question = ".$id;
        $result = pg_query($dbconn, $query);
        
        // put all the date in an array
        while ($row = pg_fetch_row($result)) {
            $donnees=array(
                "id_question" => $row[0],
                "type_question" => $row[1],
                "text_question" => $row[2],
                "difficulte" => $row[3],
                "id_theme" => $row[4],
            );
        }
        pg_close($dbconn);
        return $donnees;
    }
    
    function return_donnees_question_sup($id, $random_type){ //RETOURNE DANS UN TABLEAU KEY => VALUE LES CHAMPS PROPRES A UN TYPE D UNE QUESTION
        include ('../include/postgres.conf.inc.php');
        
        $dbconn = pg_connect($confi);
        $donnees = array();
        if($random_type==0){ //ON
            $query = "  SELECT reponse FROM Question_on
                            WHERE id_question = ".$id;
            $result = pg_query($dbconn, $query);
            
            // put all the date in an array
            while ($row = pg_fetch_row($result)) {
                $donnees=array(
                    "reponse" => $row[0],
                );
            }
        }
        
        
        else if($random_type==1){ //CM
            $query = "  SELECT choix_1, choix_2, choix_3, choix_4, reponse_1, reponse_2, reponse_3, reponse_4, id_question FROM Question_cm
		                WHERE id_question = ".$id;
            $result = pg_query($dbconn, $query);
            
            // put all the date in an array
            while ($row = pg_fetch_row($result)) {
                $donnees=array(
                    "choix_1" => $row[0],
                    "choix_2" => $row[1],
                    "choix_3" => $row[2],
                    "choix_4" => $row[3],
                    "reponse_1" => $row[4],
                    "reponse_2" => $row[5],
                    "reponse_3" => $row[6],
                    "reponse_4" => $row[7],
                );
            }
        }
        
        
        else if($random_type==2){ //TXT
            $query = "  SELECT reponse_exacte, reponse_correct1, reponse_correct2, reponse_correct3 FROM Question_texte
		                WHERE id_question = ".$id;
            $result = pg_query($dbconn, $query);
            
            // put all the date in an array
            while ($row = pg_fetch_row($result)) {
                $donnees=array(
                    "reponse_exacte" => $row[0],
                    "reponse_correct1" => $row[1],
                    "reponse_correct2" => $row[2],
                    "reponse_correct3" => $row[3],
                );
            }
        }
        pg_close($dbconn);
        return $donnees;
    }
?>