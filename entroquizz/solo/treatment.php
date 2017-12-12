<?php
    require_once '../include/header.inc.php';
    require_once '../include/postgres.conf.inc.php';
    require_once '../include/fonctions.inc.php';
    
    function chargerClasse($classe) {
        include './'.$classe.'.php'; // On inclut la classe correspondante au paramètre passé.
    }
    
?>
<section>
	<h2>R&eacute;sultat</h2>
    <article>
   		<h3>Vos r&eacute;ponses</h3>
        <?php 
        // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
        spl_autoload_register('chargerClasse'); 
        
        $questions = array();
        $user_answers = array();
        $score = 0;
        
        foreach($_POST as $k => $v){
            if (isset($_POST[$k]) && $k !== 'max' && $k !== 'difficulte') {
                $pieces = explode("-",$k); //pieces[0] nous donne le type de la question | pieces[1] nous donne l ID de la question
                $type=$pieces[0];
                $id=$pieces[1];
                $reponse_question=$v;
                
                //Nous allons ajouter les réponses du joueur dans la BD, ainsi que récupérer les objets questions du quizz grâce à leur ID afin de traiter les réponses du joueur côté serveur
                switch($type){
                    case "vf": 
                        $req="INSERT INTO reponse_utilisateur (id_question, reponse_on) VALUES (".$id.",'".$v."')";
                        upload_bd($req);
                        $question= new Question_on(return_donnees_question($id),return_donnees_question_sup($id, 0));
                        $questions[]=$question;
                        break;
                    case "rep1":
                        $req="INSERT INTO reponse_utilisateur (id_question, reponse_cm1, reponse_cm2, reponse_cm3, reponse_cm4) VALUES (".$id.",'true','false','false','false')";
                        upload_bd($req);
                        
                        if( empty($_POST['rep2-'.$id]) && empty($_POST['rep3-'.$id]) && empty($_POST['rep4-'.$id])) {
                            $question= new Question_cm(return_donnees_question($id),return_donnees_question_sup($id, 1));
                            $questions[]=$question;
                        }
                        break;
                    case "rep2": 
                        if( empty($_POST['rep1-'.$id])){
                            $req="INSERT INTO reponse_utilisateur (id_question, reponse_cm1, reponse_cm2, reponse_cm3, reponse_cm4) VALUES (".$id.",'false','true','false','false')";
                            upload_bd($req);
                        } else { 
                            $req="UPDATE reponse_utilisateur SET reponse_cm2='false' WHERE id_question=".$id ;
                            upload_bd($req);
                        }
                        if(empty($_POST['rep3-'.$id]) && empty($_POST['rep4-'.$id])) {
                            $question= new Question_cm(return_donnees_question($id),return_donnees_question_sup($id, 1));
                            $questions[]=$question;
                        }
                        break;
                    case "rep3": 
                        if( empty($_POST['rep1-'.$id]) && (empty($_POST['rep2-'.$id]))) {
                            $req="INSERT INTO reponse_utilisateur (id_question, reponse_cm1, reponse_cm2, reponse_cm3, reponse_cm4) VALUES (".$id.",'false','false','true','false')";
                            upload_bd($req);
                        } else {
                            $req="UPDATE reponse_utilisateur SET reponse_cm3='false' WHERE id_question=".$id ;
                            upload_bd($req);
                        }
                        if( empty($_POST['rep4-'.$id])){
                            $question= new Question_cm(return_donnees_question($id),return_donnees_question_sup($id, 1));
                            $questions[]=$question;
                        }
                        break;
                    case "rep4":
                        if( empty($_POST['rep1-'.$id]) && empty($_POST['rep1-'.$id]) && empty($_POST['rep3-'.$id]) ){
                            $req="INSERT INTO reponse_utilisateur (id_question, reponse_cm1, reponse_cm2, reponse_cm3, reponse_cm4) VALUES (".$id.",'false','false','false','true')";
                            upload_bd($req);
                        } else {
                            $req="UPDATE reponse_utilisateur SET reponse_cm4='false' WHERE id_question=".$id ;
                            upload_bd($req);
                        }
                        $question = new Question_cm(return_donnees_question($id),return_donnees_question_sup($id, 1));
                        $questions[] = $question;
                        break;
                    case "txt":
                        $req="INSERT INTO reponse_utilisateur (id_question, reponse_text) VALUES (".$id.",'".$v."')";
                        upload_bd($req);
                        $question = new Question_txt(return_donnees_question($id),return_donnees_question_sup($id, 2));
                        $questions[] = $question;
                        break;
                    default:
                        echo "<p class=\"error\">Aucun des cas erreur</p>";
                        break;
                }
            }
        }
    
		$end=count($questions);
		$i=0;
		
		while($i<$end){
		    $q=$questions[$i];
		    $id=$q->id_question();
		    $type=$q->type_question();
		    
		    $answers=fetch_user_answers($id);
		    
		    switch ($type) {
		        case 'question_on':
		            if(strcasecmp($answers["vf"], $q->reponse()) == 0){
		                $score++;
		            }
		            break;
	            case 'question_cm':
		                $temp_grade=0;
		                if(strcasecmp($answers["rep1"], $q->reponse_1()) == 0){
		                    $temp_grade+=0.25;
		                } else{
		                    $temp_grade-=0.25;
		                }
		                if(strcasecmp($answers["rep2"], $q->reponse_2()) == 0){
		                    $temp_grade+=0.25;
		                } else {
		                    $temp_grade-=0.25;
		                }
		                if(strcasecmp($answers["rep3"], $q->reponse_3()) == 0){
		                    $temp_grade+=0.25;
		                } else {
		                    $temp_grade-=0.25;
		                }
		                if(strcasecmp($answers["rep4"], $q->reponse_4()) == 0){
		                    $temp_grade+=0.25;
		                } else {
		                    $temp_grade-=0.25;
		                }
		                if($temp_grade <= 0){
		                    break;
		                } else {
		                    $score += $temp_grade;
		                }
		                break;
		        case 'question_texte':
		            if(strcasecmp( $answers["txt"] , $q->reponse_exacte()) == 0){
		                $score++;
		            } else if(strcasecmp( $answers["txt"] , $q->reponse_correct_1()) == 0){
		                $score++;
		            } else if(strcasecmp( $answers["txt"] , $q->reponse_correct_2()) == 0){
		                $score++;
		            } else if(strcasecmp( $answers["txt"] , $q->reponse_correct_3()) == 0){
		                $score++;
		            }
		            break;
		    }
		    $i++;
		  }
		  if (isset($_POST['difficulte']) && isset($_POST['max'])) {
    		  $difficulte = $_POST['difficulte'];
    		  $bonus = calcul_bonus($difficulte);
    		  $final_score = $score * $bonus;
    		  
    		  
    		  echo "<p>R&eacute;sultat : ".$score." bonnes r&eacute;ponses sur ".$_POST['max']."</p>
                    <p>Bonus difficult&eacute; : x".$bonus."</p>
                    <p>Score final : ".$final_score."</p>";
    		  
    		  if (is_connected()) {
        		  update_quizz($difficulte, $_SESSION['username']);
    		      echo "<p class=\"success\">Exp&eacute;rience : ".update_exp($final_score, $_SESSION['username'])."</p>";
    		  } else {
    		      echo "<p class=\"warning\">Connectez-vous pour cumuler de l'exp&eacute;rience et montrer votre puissance aux autre joueurs ! </p>";
    	   	  }
		  } else {
	   	      echo "<p class=\"error\">Vous avez d&eacute;j&agrave; r&eacute;pondu &agrave; un quizz ou vous &ecirc;tes un petit malin. -_-</p>";
	   	  }
		?>
	</article>	
</section>
