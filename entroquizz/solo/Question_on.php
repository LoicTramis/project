<?php
require_once 'Question.php';

/**
 * Inheritance of the Question class. Question open type.
 * 
 * @version PHP 7.1
 * @author Beno&icirc;t
 * @author Lo&iuml;c
 *
 */
class Question_on extends Question {
    /**
     * 
     * @var string - could be on a boolean form
     */
    private $_reponse;

    /**
	 * Useful for creating an object.
	 * 
     * @param array $donnees_question
     * @param array $donnees_question_on
     */
    public function __construct(array $donnees_question, array $donnees_question_on) {
			parent::__construct($donnees_question);
			$this->hydrate($donnees_question_on);
		}
		
	/**
	 * 
	 * {@inheritDoc}
	 * @see Question::hydrate()
	 */
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
    /**
     * Get the answer
     * 
     * @return string - the answers
     */
	public function reponse() {
	    return $this->_reponse;
	}
    
	/**
	 * Set the answer
	 * 
	 * @param string $reponse - the answer
	 */
	public function setReponse($reponse) {
	    // Check if this a string
	    // length < 30 characters
	    if (is_string($reponse) && strlen($reponse) <= 30) {
	        $this->_reponse = $reponse;
	    }
	}
}
?>
