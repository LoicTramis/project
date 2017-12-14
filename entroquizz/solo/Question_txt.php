<?php
require_once 'Question.php';

/**
 * Inheritance of the Question class. Question text type.
 * 
 * @version PHP 7.1
 * @author Beno&icirc;t
 * @author Lo&iuml;c
 *
 */
class Question_txt extends Question {
    
    /**
     * 
     * @var string $_reponse_exacte
     * @var string $_reponse_correct_1
     * @var string $_reponse_correct_2
     * @var string $_reponse_correct_3
     */
	private $_reponse_exacte, $_reponse_correct_1, $_reponse_correct_2, $_reponse_correct_3;

	/**
	 * Useful for creating an object.
	 * 
	 * @param array $donnees_question
	 * @param array $donnees_question_txt
	 */
    public function __construct(array $donnees_question, array $donnees_question_txt) {
		parent::__construct($donnees_question);
		$this->hydrate($donnees_question_txt);
    }

	/**
	 * 
	 * {@inheritDoc}
	 * @see Question::hydrate()
	 */
	public function hydrate(array $donnees) {
	    foreach ($donnees as $key => $value) {
	        // get the name of the setter
	        $method = 'set'.ucfirst($key);
	        // Si le setter correspondant existe.
	        if (method_exists($this, $method)) {
	            // On appelle le setter.
	            $this->$method($value);
	        }
	    }
	}
    /**
     * Get the right answer
     * 
     * @return string - the right answer
     */
	public function reponse_exacte() {
	    return $this->_reponse_exacte;
	}
	/**
	 * Get the 1st correct answer
	 * 
	 * @return string - the 1st correct answer
	 */
	public function reponse_correct_1() {
	    return $this->_reponse_correct_1;
	}
	/**
	 * Get the 2nd correct answer
	 *
	 * @return string - the 2nd correct answer
	 */
	public function reponse_correct_2() {
	    return $this->_reponse_correct_2;
	}
	/**
	 * Get the 3rd correct answer
	 *
	 * @return string - the 3rd correct answer
	 */
	public function reponse_correct_3() {
	    return $this->_reponse_correct_3;
	}

	/**
	 * Set the right answer.
	 * 
	 * @param string $reponse_exacte - the new right answer
	 */
	public function setReponse_exacte($reponse_exacte) {
	// Check if this a string
	// length < 30 characters
	   if (is_string($reponse_exacte) && strlen($reponse_exacte) <= 30) {
	       $this->_reponse_exacte = $reponse_exacte;
	   }
	}
	
	/**
	 * Set the 1st correct answer.
	 *
	 * @param string $reponse_exacte - the new right answer
	 */
	public function setReponse_correct_1($reponse_correct_1) {
	    // Check if this a string
	    // length < 30 characters
    	if (is_string($reponse_correct_1) && strlen($reponse_correct_1) <= 30) {
    		  $this->_reponse_correct_1 = $reponse_correct_1;
		}
	}
	
	/**
	 * Set the 2nd correct answer.
	 *
	 * @param string $reponse_exacte - the new right answer
	 */
	public function setReponse_correct_2($reponse_correct_2) {
	    // Check if this a string
	    // length < 30 characters
    	if (is_string($reponse_correct_2) && strlen($reponse_correct_2) <= 30) {
    		  $this->_reponse_correct_2 = $reponse_correct_2;
		}
	}
	
	/**
	 * Set the 3rd correct answer.
	 *
	 * @param string $reponse_exacte - the new right answer
	 */
	public function setReponse_correct_3($reponse_correct_3) {
	    // Check if this a string
	    // length < 30 characters
    	if (is_string($reponse_correct_3) && strlen($reponse_correct_3) <= 30) {
    		  $this->_reponse_correct_3 = $reponse_correct_3;
		}
    }
}
?>
