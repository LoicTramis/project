<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
    
	function affichequizz($theme, $difficulte, $nbquestion){
		
		include('../include/postgres.conf.inc.php');
		$dbconn =pg_connect($confi);
		$quizz="";
		
		$doublons=array();
		for ($i=0;$i<$nbquestion;$i++){
			$rand= rand(0,2);
			$quizz.="<label for=\"question\">Question ".($i+1)." :</label><br>";
			switch ($rand){
				case 0: $id_questions= random_id(0,$difficulte,$theme); //fonction qui retourne le tableau qui contient tous les ID_questions des questions ON du thème correspondant
						$max=count($id_questions); //taille du tableau
						echo "LE MAX : ".$max;
						do{
							$rand2=rand(0,$max-1); 		 //on choisit un ID_question au hasard
							$id_courant=$id_questions[$rand2];
						}
						while(in_array($id_courant,$doublons));						
						array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
						$req='SELECT text_question FROM Question WHERE id_question='.$id_courant;
						$res=pg_query($dbconn, $req); 
							while ($row = pg_fetch_row($res)) {
							  $text_question=$row[0];
							}
						$question='<div class="question" style="display:none;">
										<span>'.$text_question.'</span>
										<p>Vrai ou faux ?</p>
										<input type="radio" id="true" name="answer" value="true" checked> <label for="true">Vrai</label>
								 		<input type="radio" id="false" name="answer" value="false"> <label for="false">Faux</label>
								 		<br>
							 		</div>';    
						$quizz.=$question;
						break;            

				case 1: $id_questions=  random_id(1,$difficulte,$theme);; //fonction qui retourne le tableau qui contient tous les ID_questions des questions CM du thème correspondant
						$max=count($id_questions); //taille du tableau
						do{
							$rand2=rand(0,$max-1); 		 //on choisit un ID_question au hasard
							$id_courant=$id_questions[$rand2];
						}
						while(in_array($id_courant,$doublons));						
						array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
						$req='SELECT text_question FROM Question WHERE id_question='.$id_courant;		 
						$res=pg_query($dbconn,$req);
							while ($row = pg_fetch_row($res)) {
							  $text_question=$row[0];
							}
						$req='SELECT choix_1 FROM Question_cm WHERE id_question='.$id_courant;
						$res=pg_query($dbconn,$req); 
							while ($row = pg_fetch_row($res)) {
							 $choix1=$row[0];
							}
						$req='SELECT choix_2 FROM Question_cm WHERE id_question='.$id_courant;		 
						$res=pg_query($dbconn,$req); 
							while ($row = pg_fetch_row($res)) {
							  $choix2=$row[0];
							}  
						$req='SELECT choix_3 FROM Question_cm WHERE id_question='.$id_courant;		 
						$res=pg_query($dbconn,$req); 
							while ($row = pg_fetch_row($res)) {
							  $choix3=$row[0];
							} 
						$req='SELECT choix_4 FROM Question_cm WHERE id_question='.$id_courant;	
						$res=pg_query($dbconn,$req); 
							while ($row = pg_fetch_row($res)) {
							  $choix4=$row[0];
							}	   
						$question='<div class="question" style="display:none;">
									<span>'.$text_question.'</span>
							  		<p>Cochez les réponses correctes:</p>
							 		<input type="checkbox" id="rep1" name="answer1" value=""><label for="rep1">'.$choix1.'</label><br>
							 		<input type="checkbox" id="rep2" name="answer2" value=""><label for="rep2">'.$choix2.'</label><br>
							 		<input type="checkbox" id="rep3" name="answer3" value=""><label for="rep3">'.$choix3.'</label><br>
							 		<input type="checkbox" id="rep4" name="answer4" value=""><label for="rep4">'.$choix4.'</label><br>
						 		</div>';
						$quizz=$question;
						break;


				case 2: $id_questions= random_id(2,$difficulte,$theme);; //fonction qui retourne le tableau qui contient tous les ID_questions des questions TXT du thème correspondant
						$max=count($id_questions); //taille du tableau
						do{
							$rand2=rand(0,$max-1); 		 //on choisit un ID_question au hasard
							$id_courant=$id_questions[$rand2];
						}
						while(in_array($id_courant,$doublons));						
						array_push($doublons, $id_courant); //on stocke l'id de la question inscrite dans le quizz pour ne pas la réobtenir
						$req='SELECT text_question FROM Question WHERE id_question='.$id_courant; 
						$res=pg_query($dbconn,$req);
							while ($row = pg_fetch_row($res)) {
							  $text_question=$row[0];
							}          
						$question='<div class="question" style="display:none;">
									<span>'.$text_question.'</span>
							 		<label for="answer">Taper votre réponse (attention aux fautes de saisie) :</label>
									<input type="text" id="answer" name="answer" value="non"><br>
						 		</div>';
						$quizz.=$question;
						break;  
			}
		}
		pg_close($dbconn);
		return $quizz;
	}
?>
<section>
	<h2>Quizz</h2>
	<article>
		<h3>Question</h3>
    	<?php 
    	   echo affichequizz("Espace", "facile", 2);
    	?>
	</article>
</section>
