<?php

    require_once '../include/header.inc.php';
    
    require('../include/postgres.conf.inc.php');
   ?>
   <section>
<?php            if(isset($_GET['difficulte']) AND isset($_GET['type_question'])){
                $dbconn = pg_connect($confi);
                //include('postgres.conf.inc.php');

                $id_theme = $_GET['id_theme'];//id du thème
                $niveau = $_GET['difficulte'];//Niveau de difficulté

                $type_question = pg_escape_string($_GET['type_question']);//type de question
                $text_question = pg_escape_string($_GET['description']);//enoncé du question
                $reponse = pg_escape_string($_GET['reponse']);//reponse vrai/faux

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
                $reponse1 = pg_escape_string($_GET['answer1']);//reponse 1 
                $reponse2 = pg_escape_string($_GET['answer2']);//reponse 2
                $reponse3 = pg_escape_string($_GET['answer3']);//reponse 3
                $reponse4 = pg_escape_string($_GET['answer4']);//reponse 4



                //Insertion des données dans la table Question et retourne l'id du quizz
                $insert_quizz="INSERT INTO Quizz (difficulte,id_theme) VALUES ('".$niveau."','".$id_theme."')  RETURNING id_quizz";
                //execution de la requete table Quizz
                $req = pg_query($dbconn,$insert_quizz);
                //recuperation id du quizz inseré
                $id_quizzquest = pg_fetch_row($req);

                //Insertion des données dans la table Question et retourne l'id de la question 
                $insert_question = "INSERT INTO Question (type_question,text_question,id_quizz) VALUES ('".$type_question."','".$text_question."','".$id_quizzquest[0]."') RETURNING id_question";
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
                
               /* else{//Insertion des données Question choix multiples
                    $insert_questcm = "INSERT INTO Question_CM (choix_1,choix_2,choix_3,choix_4,reponse_1,reponse_2,reponse_3,reponse_4,id_question) VALUES ('".$choix1."','".$choix1."','".$choix2."','".$choix4."','".$reponse1."','".$reponse2."','".$reponse3."','".$reponse4."','".$id_quest[0]."')";
                    //execution de la requete
                    $req=pg_query($dbconn,$insert_questcm);
                }*/


                //Teste la requete 
                if(!$req) {
                    echo pg_last_error();
                } 
                else {
                    echo "Enregistrement réussi avec succès\n";
                    echo $id_quest[0];
                }
                   
                pg_close();
               
            }

        ?>
          </section>
       
    </body>

</html>
    
