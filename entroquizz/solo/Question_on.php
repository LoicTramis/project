<?php
require_once 'Question.php';

class Question_on extends Question {
	private $_reponse;

    public function __construct(array $donnees_question, array $donnees_question_on) {
			parent::__construct($donnees_question);
			$this->hydrate($donnees_question_on);
		}
		//CETTE FONCTION INITIALISE UN OBJET
	public function hydrate(array $donnees)	{
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

	public function reponse() {
	    return $this->_reponse;
	}

	public function setReponse($reponse) {

	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
	// Dont la longueur est inférieure à 30 caractères.
	if (is_string($reponse) && strlen($reponse) <= 30) {
		  $this->_reponse = $reponse;
		}
	}



}
?>
