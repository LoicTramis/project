<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
    
    function chargerClasse($classe) {
        include './'.$classe.'.php'; // On inclut la classe correspondante au paramètre passé.
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
    			case "question_on": $html.='<div class="question" style="display:none;">
    								<p>Question '.($i+1).' :</p>
    								<span>'.$question->text_question().'</span>
    								<p>Vrai ou faux ?</p>
    								<input type="radio" id="true" name="answer" value="true" checked> <label for="true">Vrai</label>
    						 		<input type="radio" id="false" name="answer" value="false"> <label for="false">Faux</label>
    						 		<br>
    					 		</div>';    
    				break;
    
    			case "question_cm": $html.='<div class="question" style="display:none;">
    									<p>Question '.($i+1).' :</p>
    									<span>'.$question->text_question().'</span>
    							  		<p>Cochez les réponses correctes:</p>
    							 		<input type="checkbox" id="rep1" name="answer1" value=""><label for="rep1">'.$question->choix_1().'</label><br>
    							 		<input type="checkbox" id="rep2" name="answer2" value=""><label for="rep2">'.$question->choix_2().'</label><br>
    							 		<input type="checkbox" id="rep3" name="answer3" value=""><label for="rep3">'.$question->choix_3().'</label><br>
    							 		<input type="checkbox" id="rep4" name="answer4" value=""><label for="rep4">'.$question->choix_4().'</label><br>
    						 	</div>';
    				break;
    
    			case "question_texte": $html.='<div class="question" style="display:none;">
    									<p>Question '.($i+1).' :</p>
    									<span>'.$question->text_question().'</span>
    							 		<label for="answer">Taper votre réponse (attention aux fautes de saisie) :</label>
    									<input type="text" id="answer" name="answer" value="non"><br>
    						 		</div>';
    				break;
    
    
    		}
    
    	}
    	$html.='<input type="button" id="validate" value="Est-ce votre dernier mot" />
    	</fieldset>
    	</form>
     	</div>
     	<script>
    		var questions= document.querySelectorAll(" #quizz .question ");
    		var i=0;
    
    		window.onload=function(){ questions[0].style.display="block"; }
    
    		validate.addEventListener("click", function(e){
    			questions[i].style.display="none";
    			i++;
    			if(i<questions.length) questions[i].style.display="block";
    		});
     	</script>
     	</body>
     	</html>';
    	return $html;
    
    }

    function return_questions_of_quizz ($theme, $nb_question, $difficulte){ //RETOURNE UN TABLEAU D OBJETS QUESTIONS
    	$i=0;
    	$quizz = array(); //quizz est un tableau de questions	
    	$doublons = array(); //stock les id des questions pour ne pas avoir de doublons
    	for ($i;$i<$nb_question;$i++){
    		$rand= rand (0,2);
    		switch($rand){
    			case 0: $id_questions= random_id(0,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions ON du thème correspondant
    					$max=count($id_questions); //taille du tableau
    					do{
    						$rand2=rand(0,$max-1); 		 //on choisit un ID_question au hasard
    						$id_courant=$id_questions[$rand2];
    					}
    					while(in_array($id_courant,$doublons));						
    					array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
    					$donnees_question = return_donnees_question($id_courant);
    					$donnees_question_on = return_donnees_question_sup($id_courant, 0);
    					$question_courante = new Question_on($donnees_question, $donnees_question_on);
    				break;
    
    			case 1: $id_questions= random_id(1,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions CM du thème correspondant
    					$max=count($id_questions); //taille du tableau
    					do{
    						$rand2=rand(1,$max-1); 		 //on choisit un ID_question au hasard
    						$id_courant=$id_questions[$rand2];
    					}
    					while(in_array($id_courant,$doublons));						
    					array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
    					$donnees_question = return_donnees_question($id_courant);
    					$donnees_question_cm = return_donnees_question_sup($id_courant, 1);
    					$question_courante = new Question_cm($donnees_question, $donnees_question_cm);
    				break;
    
    			case 2: $id_questions= random_id(2,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions TXT du thème correspondant
    					$max=count($id_questions); //taille du tableau
    					do{
    						$rand2=rand(2,$max-1); 		 //on choisit un ID_question au hasard
    						$id_courant=$id_questions[$rand2];
    					}
    					while(in_array($id_courant,$doublons));						
    					array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
    					$donnees_question = return_donnees_question($id_courant);
    					$donnees_question_txt = return_donnees_question_sup($id_courant, 2);
    					$question_courante = new Question_txt($donnees_question, $donnees_question_txt);
    				break;
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
		  $html_code= html_quizz(return_questions_of_quizz("Espace", 2, "facile" ));
		  echo $html_code;
		?>
	</article>
</section>
