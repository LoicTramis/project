<?php
require_once '../include/header.inc.php';
require_once '../include/postgres.conf.inc.php';

function Formulaire($req,$var){
    include('../include/postgres.conf.inc.php');
    $connection = pg_connect($confi);
    $stid = pg_query($req);
    $res="<select  name='".$var."'>\n";
    $res.="<option value=\"-1\">Choisissez...</option>\n";
    while ($row = pg_fetch_array($stid)){
        $res.="<option name='".$row[1]."' value='".$row[0]."'>".$row[1]."</option>\n";
        
    }
    $res.="</select>\n";
    pg_free_result($stid);
    pg_close($connection);
    return $res;
}
?>
<section>
	<h2>G&eacute;rer le site</h2>
		<article>
			<h3>Formulaire de cr&eacute;ation de question</h3>
            <form class="creation-question" action="./create_question.php" method="get">
                <fieldset>
                    <legend>Int&eacute;grez votre question &agrave; nos quizz:</legend>

                    <p class="title">Difficult&eacute;</p>
                    <input type="radio" value="facile" name="difficulte" id="easy" autofocus="autofocus"><label for="easy">Facile</label>
                    <input type="radio" value="moyen" name="difficulte" id="middle"><label for="middle">Moyen</label>
                    <input type="radio" value="difficile" name="difficulte" id="hard"><label for="hard">Difficile</label>
    
                    <p class="title"><label for="">Th&egrave;me :</label></p>
                        <!-- recuperation des th�mes sans doublon-->
                        <?php 
                            echo Formulaire('SELECT min(id_theme),nom_theme FROM Theme GROUP BY nom_theme','nom_theme'); 
                         ?>
                    <p class="title"><label>Sous-th&egrave;me :</label></p>
                        <!-- recuperation des sous th�mes -->
                        <?php
                            echo Formulaire("SELECT id_theme, sous_theme FROM Theme WHERE sous_theme<>'' ","sous_theme");
                        ?>
    
                    <p class="title"><label for="description">Enonc&eacute; de votre question :</label></p>
                    <textarea name="description" id="description" placeholder="Ex: Quel est le 25e pr&eacute;sident de la r&eacute;publique fran&ccedil;aise ?" required></textarea>
    
                    <p class="title">Type de question :</p>
                    <div class="line">
            	        <input type="radio" onclick="javascript:typeCheck();" id="radioON" name="type_question" value="question_on"> <label for="radioON">Question ferm&eacute;e</label>
        	            <input type="radio" onclick="javascript:typeCheck();" id="radioTXT" name="type_question" value="question_texte"> <label for="radioTXT">Question ouverte</label>
    	                <input type="radio" onclick="javascript:typeCheck();" id="radioCM" name="type_question" value="question_cm"> <label for="radioCM">Question &agrave; choix multiples</label>
                    </div>
                     <!-- -----------------Formulaire Question Vrai/Faux------- -->
                    <div id="divON" style="display: none;">
                        <p  class="title">R&eacute;ponse correcte :</p>
                        <input type="radio" id="true" name="reponse" value="true" checked> <label for="true">Vrai</label>
                        <input type="radio" id="false" name="reponse" value="false"> <label for="false">Faux</label>
                    </div>
                
                     <!-- -----------------Formulaire Question texte------- -->       
                    <div id="divTXT" style="display: none;">
                    	<p class="title">La bonne r&eacute;ponse puis d'autres r&eacute;ponses possibles :</p>
                        <label for="answer0">R&eacute;ponse exacte :</label>
                        <input type="text" id="answer0" name="answer0" value="" placeholder="Ex: Emmanuel Macron - 10 512,86 km - 12h00min">
                        <label for="answer1">R&eacute;ponse approximative n&deg;1 :</label>
                        <input type="text" id="answer1" name="answer1" value="" placeholder="Ex: M.Emmanuel Macron - 10 513 km - 12h00">
                        <label for="answer2">R&eacute;ponse approximative n&deg;2 :</label>
                        <input type="text" id="answer2" name="answer2" value="" placeholder="Ex: Monsieur Macron - 10 512 km - 12h">
                        <label for="answer3">R&eacute;ponse approximative n&deg;3 :</label>
                        <input type="text" id="answer3" name="answer3" value="" placeholder="Ex: M.Macron - 10 500 km - 12:00">
                        
                    </div>
    
                    <!-- Formulaire Question Choix multiple -->
                    <div id="divCM" style="display: none;"> 
                    	<p class="title">Donnez plusieurs choix :</p>        
                        <label for="choice1">Choix A :</label>
                        <input type="text" id="choice1" name="choice1" placeholder="Ex: Emmanuel Macron">
                        <label for="choice2">Choix B :</label>
                        <input type="text" id="choice2" name="choice2" placeholder="Ex: Nicolas Sarkozy">
                        <label for="choice3">Choix C :</label>
                        <input type="text" id="choice3" name="choice3" placeholder="Ex: Fran&ccedil;ois Hollande">
                        <label for="choice4">Choix D :</label>
                        <input type="text" id="choice4" name="choice4" placeholder="Ex: Jacques Chirac">
                        
                        <p class="title">Cochez les bonnes r&eacute;ponses (au moins une) :</p>
                        <input type="checkbox" id="rep1" name="answer1" value="answer1" onclick="javascript:boxCheck();"><label for="rep1">R&eacute;ponse A</label>
    
                        <input type="checkbox" id="rep2" name="answer2" value="answer2" onclick="javascript:boxCheck();"><label for="rep2">R&eacute;ponse B</label>
    
                        <input type="checkbox" id="rep3" name="answer3" value="answer3" onclick="javascript:boxCheck();"><label for="rep3">R&eacute;ponse C</label>
    
                        <input type="checkbox" id="rep4" name="answer4" value="answer4" onclick="javascript:boxCheck();"><label for="rep4">R&eacute;ponse D</label>   
                    </div>  
                    <p><input type="submit" value="Soumettre"></p>
                </fieldset>
            </form>
		</article>
	<?php	
		$dbconn = pg_connect($confi);

if(isset($_GET['difficulte']) && isset($_GET['type_question'])) {
    /*si choisi un sous thème on fait une requete qui
     recupère l'id du thème correspondant au sous_thème*/
    if(isset($_GET['nom_theme']) && !empty($_GET['nom_theme'])) {
        $nom_theme = $_GET['nom_theme'];
        $sous_theme = $_GET['sous_theme'];
        
        if (isset($_GET['sous_theme']) && ($_GET['sous_theme'] != "Choisissez...")) {
            // $id =$_GET['s_theme'];
            $query = "SELECT id_theme FROM Theme WHERE nom_theme = '$nom_theme' AND sous_theme='$sous_theme'";
            
            $result = pg_query($query);
            $data = pg_fetch_row($result);
            $id_theme = $data[0];
            //echo "le theme est ".$id_theme;
        }
        //si non choisi sous th�me
        else if($_GET['sous_theme'] == "Choisissez..."){
                $query = "SELECT id_theme FROM Theme WHERE nom_theme = '$nom_theme' AND sous_theme=''";
                $result = pg_query($query);
                $data = pg_fetch_row($result);
                $id_theme = $data[0];
        }
    }
    
    
    $niveau = $_GET['difficulte'];//Niveau de difficulté
    
    $type_question = pg_escape_string($_GET['type_question']);//type de question
    $text_question = pg_escape_string($_GET['description']);//enoncé du question
    
    //Retourne true ou false en fonction de la session adminis et utilisateur
    $publie = (is_admin()) ? 'TRUE' : 'FALSE';
    
    $reponse = isset($_GET['reponse']) ? pg_escape_string($_GET['reponse']) : '';//reponse vrai/faux
    
    //reponse question texte
    $answerTxt_exact = pg_escape_string($_GET['answer0']);//reponse exact
    $answerTxt_approx1 = pg_escape_string($_GET['answer1']);//reponse approximative 1
    $answerTxt_approx2 = pg_escape_string($_GET['answer2']);//reponse approximative 2
    $answerTxt_approx3 = pg_escape_string($_GET['answer3']);//reponse approximative 3
    
    //Question checkbox
    $choix1 = pg_escape_string($_GET['choice1']);//choix reponse 1
    $choix2 = pg_escape_string($_GET['choice2']);//choix reponse 2
    $choix3 = pg_escape_string($_GET['choice3']);//choix reponse 3
    $choix4 = pg_escape_string($_GET['choice4']);//choix reponse 4
    
    if (isset($_GET['answer1']) && $_GET['answer1'] == "true")
        $reponse1 = pg_escape_string($_GET['answer1']);//reponse 1
        else $reponse1 =  pg_escape_string('false');
        if (isset($_GET['answer2']) && $_GET['answer2'] == "true")
            $reponse2 = pg_escape_string($_GET['answer2']);//reponse 2
            else $reponse2 =  pg_escape_string('false');
            if (isset($_GET['answer3']) && $_GET['answer3'] == "true")
                $reponse3 = pg_escape_string($_GET['answer3']);//reponse 3
                else $reponse3 =  pg_escape_string('false');
                if (isset($_GET['answer4']) && $_GET['answer4'] == "true")
                    $reponse4 = pg_escape_string($_GET['answer4']);//reponse 4
                    else $reponse4 =  pg_escape_string('false');
                    
                    //Insertion des données dans la table Question et retourne l'id de la question
                    $insert_question = "INSERT INTO Question (type_question,text_question,difficulte,publie,id_theme) VALUES ('".$type_question."','".$text_question."','".$niveau."','".$publie."','".$id_theme."') RETURNING id_question";
                    //execution de la requete table Question
                    $req=pg_query($dbconn,$insert_question);
                    //recuperation id de la question inserée
                    $id_quest = pg_fetch_row($req);
                    
                    if($_GET['type_question'] == "question_on"){
                        //Insertion des données dans la table Question_ON et retourne l'id de la question
                        $insert_questON = "INSERT INTO Question_ON (reponse,id_question) VALUES ('".$reponse."','".$id_quest[0]."')";
                        //execution de la requete
                        $req=pg_query($dbconn,$insert_questON);
                    }
                    else  if($_GET['type_question'] == "question_texte"){
                        //Insertion des données Question Texte
                        $insert_questTexte = "INSERT INTO Question_Texte (reponse_exacte,reponse_correct1,reponse_correct2,reponse_correct3,id_question) VALUES ('".$answerTxt_exact."','".$answerTxt_approx1."','".$answerTxt_approx2."','".$answerTxt_approx3."','".$id_quest[0]."')";
                        //execution de la requete
                        $req=pg_query($dbconn,$insert_questTexte);
                    }
                        else{//Insertion des données Question choix multiples
                            
                            $insert_questcm = "INSERT INTO Question_CM (choix_1,choix_2,choix_3,choix_4,reponse_1,reponse_2,reponse_3,reponse_4,id_question) VALUES ('".$choix1."','".$choix2."','".$choix3."','".$choix4."','".$reponse1."','".$reponse2."','".$reponse3."','".$reponse4."','".$id_quest[0]."')";
                            //execution de la requete
                            $req=pg_query($dbconn,$insert_questcm);
                        }
                        
                        //Teste la requete
                        if(!$req) {
                            echo pg_last_error();
                        }
                        else {
                            echo "  <article>
                                        <h3>R&eacute;sultat :</h3>
                                        <p class=\"success\">Enregistrement r&eacute;ussi avec succ&egrave;s</p>\n
                                    </article>";
                            echo $id_quest[0];
                        }
                        pg_close();
}
?>
</section>

    </body>

</html>
    
