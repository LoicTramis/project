<?php
require_once 'Question.php';

class Question_txt extends Question

{
	private $_reponse_exacte;
 	private $_reponse_correct_1;
 	private $_reponse_correct_2;
 	private $_reponse_correct_3;

    public function __construct(array $donnees_question, array $donnees_question_txt) {
			parent::__construct($donnees_question);
			$this->hydrate($donnees_question_txt);
		}



		//CETTE FONCTION INITIALISE UN OBJET
	public function hydrate(array $donnees) {
	  foreach ($donnees as $key => $value) {

		// On récupère le nom du setter correspondant à l'attribut.
		$method = 'set'.ucfirst($key);

		// Si le setter correspondant existe.
		if (method_exists($this, $method)) {

		  // On appelle le setter.
		  $this->$method($value);
		}
	  }	
	}

	public function reponse_exacte() {
	    return $this->_reponse_exacte;
	}
	public function reponse_correct_1() {
	    return $this->_reponse_correct_1;
	}
	public function reponse_correct_2() {
	    return $this->_reponse_correct_2;
	}
	public function reponse_correct_3() {
	    return $this->_reponse_correct_3;
	}

	public function setReponse_exacte($reponse_exacte) {
	// On vérifie qu'il s'agit bien d'une chaîne de caractères.

	// Dont la longueur est inférieure à 30 caractères.

	if (is_string($reponse_exacte) && strlen($reponse_exacte) <= 30) {
		  $this->_reponse_exacte = $reponse_exacte;
		}
	}

	public function setReponse_correct_1($reponse_correct_1) {
	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
	// Dont la longueur est inférieure à 30 caractères.
	if (is_string($reponse_correct_1) && strlen($reponse_correct_1) <= 30) {
		  $this->_reponse_correct_1 = $reponse_correct_1;
		}
	}
	
	public function setReponse_correct_2($reponse_correct_2) {
	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
	// Dont la longueur est inférieure à 30 caractères.
	if (is_string($reponse_correct_2) && strlen($reponse_correct_2) <= 30) {
		  $this->_reponse_correct_2 = $reponse_correct_2;
		}
	}

	public function setReponse_correct_3($reponse_correct_3) {

	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
	// Dont la longueur est inférieure à 30 caractères.
	if (is_string($reponse_correct_3) && strlen($reponse_correct_3) <= 30) {
		  $this->_reponse_correct_3 = $reponse_correct_3;
		}
	}

}
?>
