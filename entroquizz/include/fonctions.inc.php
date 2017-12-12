<?php
    /**
     * Get the path of the icon according to the level
     * 
     * @param string $avatar - the name of the character
     * @param int $level - the level of the player
     * @return string - the path of the icon
     */
    function get_icon($avatar, $level) {   
        $chararcters = array(
            'sangoku' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'vegeta' => array(
                1 => '../img/dragonball/vegeta_base.png',
                2 => '../img/dragonball/vegeta_ss1.png',
                3 => '../img/dragonball/vegeta_ss2.png',
                4 => '../img/dragonball/vegeta_majin.png'
            ),
            'sangohan' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'trunks' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'cooler' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'freezer' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'cell' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            ),
            'buu' => array(
                1 => '../img/dragonball/goku_base.png',
                2 => '../img/dragonball/goku_ss1.png',
                3 => '../img/dragonball/goku_ss2.png',
                4 => '../img/dragonball/goku_ss3.png'
            )
        );
        $img_path = $chararcters[$avatar][$level];
        return $img_path;
    }
    /**
     * Return the name of the form depending on the level
     * 
     * @param string $name
     * @param int $level
     * @return string - the name of the form
     */
    function get_form($name, $level) {
        $result;
        
        switch ($name) {
            case 'sangoku':
                switch ($level) {
                    case 1: $result = "Normal";break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Super saiyan 3"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'vegeta':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Majin"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'sangohan':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Supr&ecirc;me Ka&iuml;"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'trunks':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Ultra saiyan"; break;
                    case 4: $result = "N/A"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'cooler':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Super saiyan 3"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'freezer':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Super saiyan 3"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'cell':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Super saiyan 3"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            case 'buu':
                switch ($level) {
                    case 1: $result = "Normal"; break;
                    case 2: $result = "Super saiyan"; break;
                    case 3: $result = "Super saiyan 2"; break;
                    case 4: $result = "Super saiyan 3"; break;
                    default: $result = "Inconnu"; break;
                }
                break;
            default:
                $result = "Aucune forme";
            break;
        };
        return $result;
    }
    
    /**
     * Display the rank of each user.
     * 
     * @return string - HTML table rank
     */
    function get_global_ranking() {
        include '../include/postgres.conf.inc.php';
        
        $query = "SELECT login, nombre_points, row_number() OVER (ORDER BY nombre_points DESC) FROM Utilisateur";
        $table = "  <table>
                        <tr>
                            <th>Pseudonyme</th>
                            <th>Classement</th>
                            <th>Score</th>
                        </tr>";
        
        $connection = pg_connect($confi);
        $result = pg_query($query);
        while($ranking = pg_fetch_array($result)) {
            $table .= " <tr>
                            <td>".$ranking[0]."</td>
                            <td>".$ranking[2]."</td>
                            <td>".$ranking[1]."</td>
                        </tr>";
        }
        $table .= "</table>";
        pg_close($connection);
        
        return $table;
    }
    
    function get_solo_ranking($username) {
        include '../include/postgres.conf.inc.php';
        
        $query = "SELECT login, nombre_points, row_number() OVER (ORDER BY nombre_points DESC) FROM Utilisateur";
        $rank = 0;
        
        $connection = pg_connect($confi);
        $result = pg_query($query);
        while($ranking = pg_fetch_array($result)) {
            if ($ranking[0] == $username) {
                $rank = $ranking[2];
            }
        }
        $update_query = "UPDATE Utilisateur SET Classement = ".$rank." WHERE login = '".$username."'";
        
        pg_query($update_query);
        pg_close($connection);
        
        return $rank;
    }
    
    /**
     * Get the total point (exp) of the user
     * 
     * @param string $username
     * @return string - the exp
     */
    function get_exp($username) {
        include '../include/postgres.conf.inc.php';
        
        $query = "SELECT nombre_points FROM Utilisateur WHERE login = '".$username."'";
        $experience = ""; 
        
        $connection = pg_connect($confi);
        $result = pg_query($query);
        $ranking = pg_fetch_array($result);
        
        $experience = $ranking[0];
        
        pg_close($connection);
        
        return $experience;
    }
    
    /**
     * Calcul the bonus according the difficulty
     * 
     * @param string $difficulte
     * @param int $score
     * @return number - bonus point
     */
    function calcul_bonus($difficulte) {
        $bonus = 0;
        
        switch ($difficulte) {
            case 'facile':
                $bonus = 1.5 ;
                break;
            case 'moyen':
                $bonus = 3;
                break;
            case 'difficile':
                $bonus = 5;
                break;
            default:
                break;
        };
        return $bonus;
    }
    
    /**
     * Update the exp of the user
     * 
     * @param int $final_score
     * @param int $username
     * @return number
     */
    function update_exp($final_score, $username) {
        include '../include/postgres.conf.inc.php';
        
        // First we get the current points of the user
        $query = "SELECT nombre_points FROM Utilisateur WHERE login='".$username."'";
        
        $connection = pg_connect($confi);
        $result = pg_query($query);
        $row = pg_fetch_array($result);
        
        // Then we update his score with the result from the quizz
        $final_exp = $row[0] + $final_score;
        $update = "UPDATE Utilisateur SET nombre_points=".$final_exp." WHERE login='".$username."'";
        
        pg_query($update); 
        
        if ($final_exp > 1000) {
            $icon_update_query = "UPDATE Utilisateur SET badge_niveau = 4 WHERE login='".$username."'";
            pg_query($icon_update_query);
        } elseif ($final_exp > 500) {
            $icon_update_query = "UPDATE Utilisateur SET badge_niveau = 3 WHERE login='".$username."'";
            pg_query($icon_update_query);
        } elseif ($final_exp > 100) {
            $icon_update_query = "UPDATE Utilisateur SET badge_niveau = 2 WHERE login='".$username."'";
            pg_query($icon_update_query);
        }    
        
        pg_close($connection);
        
        return $final_exp;
        
    }
    
    function update_quizz($difficulte, $username) {
        include '../include/postgres.conf.inc.php';
        
        $query = "UPDATE Utilisateur SET nb_quizz_".$difficulte." = nb_quizz_".$difficulte." + 1 WHERE login = '".$username."'";
        $total_query = "UPDATE Utilisateur SET nombre_quizz = nb_quizz_facile + nb_quizz_moyen + nb_quizz_difficile WHERE login = '".$username."'";
        $connection = pg_connect($confi);
        $result = pg_query($query);
        $total_result = pg_query($total_query);
        
        if (!$result || $total_result) {
            echo pg_last_error();
        }
        
        pg_close($connection);
    }
    
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
        $icon_lvl = $tribe; // get the icon for the character
        
        $db_connection = pg_connect($confi);
        
        // SQL query
        $insert_query = "   INSERT INTO Utilisateur (
                                login,
                                email,
                                motdepasse,
                                admini,
                                avatar,
                                badge_niveau,
                                nombre_points,
                                nombre_quizz,
                                nb_quizz_facile,
                                nb_quizz_moyen,
                                nb_quizz_difficile,
                                classement,
                                ip) 
                            VALUES ('".$enc_username."',
                                    '".$email."',
                                    '".$hash_password."',
                                    false,
                                    '".$icon_lvl."',
                                    1,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    '')"; 
        
        $result_query = pg_query($db_connection, $insert_query);
        
        // the query failed
        if(!$result_query) {
            echo pg_last_error();
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
                $_SESSION['badge_niveau'] = $row[6];
                $_SESSION['exp'] = $row[7];
                $_SESSION['classement'] = "";
            }
        }
        pg_close($db_connection);
    }
    
    /**
     * Verifie si l'utilisateur est connect�
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
     * Verifie si la BD ne contient pas la valeur pass&eacute;e en param&egrave;tres
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
                                    <a  href=\"?delete_id=".$row[key($row)]."&delete_name=".next($row)."\"
                                        onclick=\"return confirm('Voulez-vous vraiment supprimer le theme".current($row)."')\"
                                        class=\"icon\">
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
                "id_theme" => $row[4]
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
                    "reponse" => $row[0]
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
                    "reponse_4" => $row[7]
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
                    "reponse_correct3" => $row[3]
                );
            }
        }
        pg_close($dbconn);
        return $donnees;
    }
    
    function get_names_table($colum_name,$table_name) {
        include '../include/postgres.conf.inc.php';
        
        $names = array();
        $query = "SELECT ".$colum_name." FROM ".$table_name;
        
        $connection = pg_connect($confi);        
        $result = pg_query($query);
        while ($row = pg_fetch_array($result)) {
            if (!in_array($row[0], $names)) {
                array_push($names, $row[0]);
            }
        }
        
        pg_free_result($result);
        pg_close($connection);
        
        return $names;
    }
    
    function upload_bd($req){  //***INSERT OU UPDATE DES DONNES DANS LA BD
        include '../include/postgres.conf.inc.php';
        $dbconn = pg_connect($confi);
        pg_query($dbconn,$req);
        pg_close($dbconn);
    }
    
    function fetch_user_answers($id_question){  //RECUPERER LES REPONSES DU JOUEUR A UNE QUESTION
        include '../include/postgres.conf.inc.php';
        $req="SELECT reponse_on, reponse_cm1, reponse_cm2, reponse_cm3, reponse_cm4, reponse_text FROM Reponse_utilisateur WHERE id_question=".$id_question;
        
        $dbconn = pg_connect($confi);
        $result = pg_query($req);
        
        while ($row = pg_fetch_row($result)) {
            $donnees=array(
                "vf" => $row[0],
                "rep1" => $row[1],
                "rep2" => $row[2],
                "rep3" => $row[3],
                "rep4" => $row[4],
                "txt" => $row[5]
            );
        }
        pg_close($dbconn);
        return $donnees;
    }
    
    function array_middle_shift(&$array,$key) {
        $length=(($key+1)-count($array)==0)?1:($key+1)-count($array);
        return array_splice($array,$key,$length);
    }
    
    function html_quizz($quizz, $difficulte, $theme){ //retoune le code HTML du quizz
        $max=count($quizz);
        $i=0;
        $html=' <div id="quizz">
                    <form action="treatment.php" method="post">
                       <fieldset>';
        for($i;$i<$max;$i++){
            $question=$quizz[$i];
            $type_question=$question->type_question();
            switch($type_question){
                case "question_on":
                    $html.='    <div id="on" class="question" style="display:none;">
                                    <p>Question '.($i+1).'/'.$max.' :</p>
                                    <p>Th&egrave;me : '.$theme.'</p>
                                    <p>Difficult&eacute; : '.$difficulte.'</p>

                                    <span>'.$question->text_question().'</span>

                                    <label for="vrai-'.$question->id_question().'">
                                        <input type="radio" class="q-on" id="vrai-'.$question->id_question().'" name="vf-'.$question->id_question().'" value="true">
                                        Vrai
                                    </label>
                                        
                                    <label for="faux-'.$question->id_question().'">
                                        <input type="radio" class="q-on" id="faux-'.$question->id_question().'" name="vf-'.$question->id_question().'" value="false">
                                        Faux
                                    </label>
                                </div>';
                    break;
                case "question_cm":
                    $html.='    <div id="cm" class="question" style="display:none;">
                                    <p>Question '.($i+1).'/'.$max.' :</p>
                                    <p>Th&egrave;me : '.$theme.'</p>
                                    <p>Difficult&eacute; : '.$difficulte.'</p>

                                    <span>'.$question->text_question().'</span>

                                    <div class="wholeline">
                                        <label for="rep1-'.$question->id_question().'">
                                           <input type="checkbox" class="q-cm" id="rep1-'.$question->id_question().'" name="rep1-'.$question->id_question().'" value="false">
                                           '.$question->choix_1().'
                                        </label>
                                            
                                        <label for="rep2-'.$question->id_question().'">
                                            <input type="checkbox" class="q-cm" id="rep2-'.$question->id_question().'" name="rep2-'.$question->id_question().'" value="false">
                                            '.$question->choix_2().'
                                        </label>
                                    </div>
                                    <div class="wholeline">
                                        <label for="rep3-'.$question->id_question().'">
                                            <input type="checkbox" class="q-cm" id="rep3-'.$question->id_question().'" name="rep3-'.$question->id_question().'" value="false">
                                            '.$question->choix_3().'
                                        </label>
                                            
                                        <label for="rep4-'.$question->id_question().'">
                                            <input type="checkbox" class="q-cm" id="rep4-'.$question->id_question().'" name="rep4-'.$question->id_question().'" value="false">
                                            '.$question->choix_4().'
                                        </label>
                                    </div>
                                </div>';
                    break;
                    
                case "question_texte":
                    $html.='    <div id="txt" class="question" style="display:none;">
                                    <p>Question '.($i+1).'/'.$max.' :</p>
                                    <p>Th&egrave;me : '.$theme.'</p>
                                    <p>Difficult&eacute; : '.$difficulte.'</p>

                                    <span>'.$question->text_question().'</span>

                                    <label for="txt-'.$question->id_question().'">
                                        <input type="text" class="q-txt" id="txt-'.$question->id_question().'" name="txt-'.$question->id_question().'" placeholder="Ex: Rouge - 12:00 - 50 000,25">
                                    </label>
                                </div>';
                    break;
            }
        }
        
        $html .= "  <input type=\"hidden\" name=\"max\" value=\"".$max."\"/>
                    <input type=\"hidden\" name=\"difficulte\" value=\"".$difficulte."\"/>
                    <input type=\"button\" id=\"confirm\" onclick=\"getAnswer()\" value=\"Confirmer\" />
                    <input type=\"button\" id=\"validate\" value=\"Suivant\"/>
                    <input type=\"submit\" value=\"Terminer\">
                </fieldset>
	       </form>
 	  </div>";
        return $html;
        
    }
    
    function return_questions_of_quizz($theme, $nb_question, $difficulte){ //RETOURNE UN TABLEAU D OBJETS QUESTIONS
        $i=0;
        $quizz = array(); //quizz est un tableau de questions
        $doublons = array(); //stock les id des questions pour ne pas avoir de doublons
        $suppress = false;
        $boucle = false;
        
        for ($i;$i<$nb_question;$i++){
            $rand= rand (0,2);
            switch($rand){
                case 0: $id_questions= random_id(0,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions ON du thème correspondant
                $max=count($id_questions); //taille du tableau
                $suppress = false;
                do{
                    if ($suppress == true) {
                        unset($id_questions[$rand2]);
                        array_middle_shift($id_questions,$rand2);
                        if (count($id_questions) == 0) {
                            $i -= 1;
                            $boucle=true;
                            break;
                        }
                    }
                    $suppress = true;
                    
                    $rand2=rand(0,count($id_questions)-1); 		 //on choisit un ID_question au hasard
                    $id_courant = $id_questions[$rand2];
                }
                while(in_array($id_courant,$doublons));
                if($boucle == true){
                    break;
                }
                array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
                
                $donnees_question = return_donnees_question($id_courant);
                $donnees_question_on = return_donnees_question_sup($id_courant, 0);
                $question_courante = new Question_on($donnees_question, $donnees_question_on);
                break;
                
                case 1: $id_questions= random_id(1,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions CM du thème correspondant
                $max=count($id_questions); //taille du tableau
                $suppress = false;
                do{
                    if ($suppress == true) {
                        unset($id_questions[$rand2]);
                        array_middle_shift($id_questions,$rand2);
                        
                        if (count($id_questions) == 0) {
                            $i -= 1;
                            $boucle=true;
                            break;
                        }
                    }
                    $suppress = true;
                    
                    $rand2=rand(0,count($id_questions)-1); 		 //on choisit un ID_question au hasard
                    $id_courant=$id_questions[$rand2];
                }
                while(in_array($id_courant,$doublons));
                if($boucle == true){
                    break;
                }
                array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
                $donnees_question = return_donnees_question($id_courant);
                $donnees_question_cm = return_donnees_question_sup($id_courant, 1);
                $question_courante = new Question_cm($donnees_question, $donnees_question_cm);
                break;
                
                case 2: $id_questions= random_id(2,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions TXT du thème correspondant
                $max=count($id_questions); //taille du tableau
                $suppress = false;
                do{
                    if ($suppress == true) {
                        unset($id_questions[$rand2]);
                        array_middle_shift($id_questions,$rand2);
                        
                        if (count($id_questions) == 0) {
                            $i -= 1;
                            $boucle=true;
                            break;
                        }
                    }
                    $suppress = true;
                    $rand2=rand(0,count($id_questions)-1); 		 //on choisit un ID_question au hasard
                    $id_courant=$id_questions[$rand2];
                }
                while(in_array($id_courant,$doublons));
                if($boucle == true){
                    break;
                }
                array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
                $donnees_question = return_donnees_question($id_courant);
                $donnees_question_txt = return_donnees_question_sup($id_courant, 2);
                $question_courante = new Question_txt($donnees_question, $donnees_question_txt);
                break;
            }
            if($boucle == true){
                $boucle=false;
                continue;
            }
            $quizz[]=$question_courante; //on stocke cette question dans un tableau de questions
            
        }
        return $quizz;
    }
    
    function simple_quizz_form() {
        $form = "<form action=\"./simple.php\" method=\"get\">
                    <fieldset>
                        <legend>Choisissez les param&egrave;tres du quizz</legend>
        
                        <label for=\"theme\">Le th&egrave;me</label>
                        <select name=\"theme\" id=\"theme\">";
        $nom_themes = get_names_table("nom_theme", "Theme");
        
        for ($index = 0; $index < count($nom_themes); $index++) {
            $form .= "<option value=\"".$nom_themes[$index]."\">".$nom_themes[$index]."</option>";
        }
		$form .= "    </select>
				
    				<label for=\"diff\">La difficult&eacute;</label>
    				<select name=\"difficulte\" id=\"diff\">
                		<option value=\"facile\">Facile</option>
                		<option value=\"moyen\">Moyen</option>
                		<option value=\"difficile\">Difficile</option>
    				</select>
    				
    				<label for=\"nb\">Nombre de questions</label>
    				<select name=\"nombre\" id=\"nb\">
                		<option value=\"5\">5</option>
                		<option value=\"10\">10</option>
                		<option value=\"15\">15</option>
                		<option value=\"20\">20</option>
    				</select>
    				
    				<input type=\"submit\" value=\"Commencer\">
    			</fieldset>
            <form action=\"./simple.php\" method=\"get\">";
		
		return $form;
    }
?>