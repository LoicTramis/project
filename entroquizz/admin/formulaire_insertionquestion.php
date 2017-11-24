<?php
    require_once '../include/header.inc.php';
    function Formulaire($req,$var){
        include('../include/postgres.conf.inc.php');
        $connection = pg_connect($confi);
        $stid = pg_query($req);
        $res="<select id ='" .$var."' name='".$var."'>\n";
        $res.="<option value='-1'>Choisissez...</option>\n";
        while ($row = pg_fetch_array($stid)){
            $res.="<option value='".$row[0]."'>".$row[1]."</option>\n";
        }
        $res.="</select>\n";
        pg_free_result($stid);
        pg_close($connection);
        return $res;
    }

?>       
<section> 
        <form action="scriptinsertquestion.php" method="get">
            <fieldset>
                <legend>Intégrez votre question à nos quizz:</legend>
                <label for="difficulte">Difficulte du quizz:</label>
                <select name="difficulte" id="difficulte" required>
                    <option value="-1">Choisissez...</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                </select>

                <p><label>Choisissez un thème :</label>
                    <!-- recuperation des thèmes -->
                    <?php echo Formulaire('SELECT id_theme, nom_theme FROM Theme','id_theme') ?>
                </p>

                <label for="description">Enoncé de votre question:</label><br>
                <textarea name="description" style="width:80%; height:100px;" id="description"></textarea>

                <p>Quel est le type de votre question ?</p>
                <input type="radio" onclick="javascript:typeCheck();" id="radioON" name="type_question" value="question_on"> <label for="radioON">Question vrai/faux</label>
                <input type="radio" onclick="javascript:typeCheck();" id="radioTXT" name="type_question" value="question_texte"> <label for="radioTXT">Question ouverte</label>
                <input type="radio" onclick="javascript:typeCheck();" id="radioCM" name="type_question" value="question_cm"> <label for="radioCM">Question à choix multiples</label>
               
                 <!-- -----------------Formulaire Question Vrai/Faux------- -->
                <div id="divON" style="display: none;">
                    <p>Réponse correcte à votre question:</p>
                    <input type="radio" id="true" name="reponse" value="true" checked> <label for="true">Vrai</label>
                    <input type="radio" id="false" name="reponse" value="false"> <label for="false">Faux</label><br>
                </div>
            
                 <!-- -----------------Formulaire Question texte------- -->       
                <div id="divTXT" style="display: none;">
                    <label for="answer0">Réponse exacte à votre question:</label>
                    <input type="text" id="answer0" name="answer0" value=""><br>
                    <label for="answer1">Réponse approximative N°1 à votre question:</label>
                    <input type="text" id="answer1" name="answer1" value=""><br>
                    <label for="answer2">Réponse approximative N°2 à votre question:</label>
                    <input type="text" id="answer2" name="answer2" value=""><br>
                    <label for="answer3">Réponse approximative N°3 à votre question:</label>
                    <input type="text" id="answer3" name="answer3" value=""><br>
                    
                </div>

                <!-- Formulaire Question Choix multiple -->
                <div id="divCM" style="display: none;">          
                    <label for="choice1">Choix de r�ponse A:</label>
                    <input type="text" id="choice1" name="choice1" placeholder="choix 1"><br>
                    <label for="choice2">Choix de r�ponse B:</label>
                    <input type="text" id="choice2" name="choice2" placeholder="choix 2"><br>
                    <label for="choice3">Choix de r�ponse C:</label>
                    <input type="text" id="choice3" name="choice3" placeholder="choix 3"><br>
                    <label for="choice4">Choix de r�ponse D:</label>
                    <input type="text" id="choice4" name="choice4" placeholder="choix 4"><br>
                    <br>
                    <p>Cochez les r�ponses correctes:</p>
                    <input type="checkbox" id="rep1" name="answer1" value="answer1" onclick="javascript:boxCheck();"><label for="rep1">R�ponse A</label><br>

                    <input type="checkbox" id="rep2" name="answer2" value="answer2" onclick="javascript:boxCheck();"><label for="rep2">R�ponse B</label><br>

                    <input type="checkbox" id="rep3" name="answer3" value="answer3" onclick="javascript:boxCheck();"><label for="rep3">R�ponse C</label><br>

                    <input type="checkbox" id="rep4" name="answer4" value="answer4" onclick="javascript:boxCheck();"><label for="rep4">R�ponse D</label><br>   
                </div>  
                <p><input type="submit" value="Valider"></p>
            </fieldset>
        </form>
</section>

    </body>

</html>
    
