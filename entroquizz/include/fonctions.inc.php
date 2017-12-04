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
     * Verifie si l'utilisateur est connecté
     * 
     * @return boolean
     */
    function is_connected() {
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Verifie si l'utilisateur est administrateur
     * 
     * @return boolean
     */
    function is_admin() {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && isset($_SESSION['username'])) {
            return true;
        } else if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
            return false;
        }
    }
    /**
     * Verifie si la BD ne contient pas 
     * 
     * @param string $table_name - le nom de la table (ex: Utilisateur)
     * @param string $attribut - Le nom de l'attribut (ex: login)
     * @param string $value - Le nom de la variable a comparer (ex: Entropy)
     * @return boolean
     */
    function is_in_database($table_name, $attribut, $value) {
        include '../include/postgres.conf.inc.php';
        
        $exist = false;
        $select_query = "SELECT count(*) FROM ".$table_name." WHERE lower(".$attribut.")=lower('".pg_escape_string($value)."')";
        
        $connextion = pg_connect($confi);
        $result = pg_query($select_query) or die('Erreur SQL !'.$sql.' '.pg_last_error());
        $nb_username = pg_fetch_row($result);
        
        // case insensitive comparison
        if ($value == $nb_username[0]) {
            $exist = true;
        }
        pg_free_result($result);
        pg_close($connextion);
        
        return $exist;
    }
    
    /**
     * Recupere tous les champs de la table Question
     *
     * @return string - Tableau HTML
     */
    function get_table($table_name) {
        include '../include/postgres.conf.inc.php';
        
        // tableau HTML
        $html_table = "<table>
                    <tr>";
        $query = "SELECT * FROM ".$table_name."";
        
        $connection = pg_connect($confi); // connexion a la BD
        $result = pg_query($query); // execute la requete
        $max_colums = pg_num_fields($result); // obtient le nombre de colonnes
        
        for ($field_number = 0; $field_number < $max_colums; $field_number++) {
            $html_table .= "<th>".pg_field_name($result, $field_number)."</th>\n";
        }
        
        $html_table .= "    <th>Modifier</th>\n
                            <th>Supprimer</th>\n
                        </tr>";
        
        while ($row = pg_fetch_assoc($result)) {
            $html_table .= "<tr>\n";
            
            // affiche toutes les colonnes de la table
            //             for ($index = 0; $index < $max_colums; $index++) {
            //                 $html_table .= "<td>".$row[$index]."</td>\n";
            
            //             }
            
            foreach ($row as $key => $value) {
                $html_table .= "<td>".$row[$key]."</td>\n";;
            }
            reset($row); 
            $html_table .="     <td>
                                    <a href=\"?updateid=\" class=\"icon\">
                                        <i class=\"fa fa-pencil warning\"></i>
                                    </a>
                                </td>\n
                                <td>
                                    <a href=\"?delete=".$row[key($row)]."\" onclick=\"return confirm('Supprimer ".$row[key($row)]."')\" class=\"icon\">
                                        <i class=\"fa fa-trash-o error\"></i>
                                    </a>
                                </td>\n
                            </tr>";
        }
        $html_table .= "</table>";
        
        pg_free_result($result);
        pg_close($connection);
        
        return $html_table;
    }
    
    
    function Tableau($req){
        $stid = pg_query($req);
        $res ="<table>\n<tr>\n";
        $nbcol = pg_num_fields($stid);
        for($i = 0; $i < $nbcol; $i++){
            $res.= "<th>".pg_field_name($stid, $i)."</th>\n";
        }
        $res.= "</tr>";
        while ($row = pg_fetch_array($stid)) {
            $res.= "<tr>\n
                        <td>" .$row[0]. "</td>\n
                        <td>" .$row[1]. "</td>\n
                        <td><a href=\"?updateid=".$row[0]."\" class=\"icon\"><i class=\"fa fa-pencil warning\"></i></a></td>\n
                        <td><a href=\"?delete=".$row[0]."\" class=\"icon\"><i class=\"fa fa-trash-o error\"></i></td>\n
                    </tr>\n";
        }
        $res.= "</table>\n";
        pg_free_result($stid);
        return $res;
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