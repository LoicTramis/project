<?php
require_once '../include/header.inc.php';
require_once '../include/fonctions.inc.php';

function chargerClasse($classe) {
    include './'.$classe.'.php'; // On inclut la classe correspondante au paramètre passé.
}
function array_middle_shift(&$array,$key) {
    $length=(($key+1)-count($array)==0)?1:($key+1)-count($array);
    return array_splice($array,$key,$length);
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

function html_quizz($quizz){ //retoune le code HTML du quizz
    $max=count($quizz);
    $i=0;
    $html='
        <div id="quizz">
        <form action="" method="" >
        <fieldset>';
    for($i;$i<$max;$i++){
        $question=$quizz[$i];
        $type_question=$question->type_question();
        switch($type_question){
            case "question_on":
                $html.='<div id="on" class="question" style="display:none;">
                                <p>Question '.($i+1).' :</p>
                                <span>'.$question->text_question().'</span>
                                <p>Vrai ou faux ?</p>
                                <input type="radio" class="q-on" id="vrai-'.$question->id_question().'" name="vf-'.$question->id_question().'" value="true" checked> <label for="vrai-'.$question->id_question().'">Vrai</label>
                                 <input type="radio" class="q-on" id="faux-'.$question->id_question().'" name="vf-'.$question->id_question().'" value="false"> <label for="faux-'.$question->id_question().'">Faux</label>
                             </div>';
                break;
            case "question_cm":
                $html.='<div id="cm" class="question" style="display:none;">
                                    <p>Question '.($i+1).' :</p>
                                    <span>'.$question->text_question().'</span>
                                      <p>Cochez les r�ponses correctes:</p>
                                     <input type="checkbox" class="q-cm" id="rep1-'.$question->id_question().'" name="rep1-'.$question->id_question().'" value="false"><label for="rep1-'.$question->id_question().'">'.$question->choix_1().'</label><br>
                                     <input type="checkbox" class="q-cm" id="rep2-'.$question->id_question().'" name="rep2-'.$question->id_question().'" value="false"><label for="rep2-'.$question->id_question().'">'.$question->choix_2().'</label><br>
                                     <input type="checkbox" class="q-cm" id="rep3-'.$question->id_question().'" name="rep3-'.$question->id_question().'" value="false"><label for="rep3-'.$question->id_question().'">'.$question->choix_3().'</label><br>
                                     <input type="checkbox" class="q-cm" id="rep4-'.$question->id_question().'" name="rep4-'.$question->id_question().'" value="false"><label for="rep4-'.$question->id_question().'">'.$question->choix_4().'</label><br>
                            </div>';
                break;
                
            case "question_texte":
                $html.='<div id="txt" class="question" style="display:none;">
                                    <p>Question '.($i+1).' :</p>
                                    <span>'.$question->text_question().'</span>
                                     <label for="txt-'.$question->id_question().'">Taper votre r�ponse (attention aux fautes de saisie) :</label>
                                    <input type="text" class="q-txt" id="txt-'.$question->id_question().'" name="txt-'.$question->id_question().'" value="non"><br>
                                 </div>';
                break;
        }
        
    }
    $html .= "</fieldset>
    	</form>
     	</div>";
    return $html;
    
}

function return_questions_of_quizz ($theme, $nb_question, $difficulte){ //RETOURNE UN TABLEAU D OBJETS QUESTIONS
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
?>
<section>
	<h2>Quizz (POO)</h2>
	<article>
		<h3>Question</h3>
		<?php
		
		  if (isset($_GET['theme']) && isset($_GET['difficulte']) && isset($_GET['nombre'])) {
		      echo html_quizz(return_questions_of_quizz($_GET['theme'], $_GET['nombre'], $_GET['difficulte']));
		  } else {
		      echo "<p class=\"error\">Mauvais param&egrave;tres.</p>";
		  }
		?>
		<p id="re"></p>
		<p id="non"></p>
		<input type="button" id="confirm" onclick="getAnswer()" value="Confirmer" />
		<input type="button" id="validate" value="Suivant" />
	</article>
</section>

