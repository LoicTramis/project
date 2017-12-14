<?php
/**
 * Manage all the question. Opened, close &amp; with multiple choice.
 * 
 * @version PHP 7.1
 * @author Beno&icirc;t
 * @author Lo&iuml;c
 *
 */
class Question {
    /**
     * 
     * @var integer $_id_question
     * @var string $_type_question
     * @var string $_text_question
     * @var string $_difficulte
     * @var integer $_id_theme
     */
    private $_id_question, $_type_question, $_text_question, $_difficulte, $_id_theme;

    /**
     * Useful for creating an object
     * 
     * @param array $donnees
     */
    public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	/**
	 * Initialize an object.
	 * 
	 * @param array $donnees
	 */
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
    		// get the name of the setter
    		$method = 'set'.ucfirst($key);
    		// if the sette exists
    		if (method_exists($this, $method)) {
    		    // call the setter
    		    $this->$method($value);
    		}
        }
    }
    
    /**
     * get the ID of the question
     * 
     * @return number - ID of the question
     */
    public function id_question() {
        return $this->_id_question;
    }
    
    /**
     * Get the type of the question
     * 
     * @return string - the type of the question
     */
    public function type_question() {
        return $this->_type_question;
    }
    
    /**
     * Get the wording of the question
     * 
     * @return string - the wording of the question
     */
    public function text_question() {
        return $this->_text_question;
    }
    
    /**
     * Get the difficulty of the question
     * 
     * @return string - the difficulty of the question
     */
    public function difficulte() {
        return $this->_difficulte;
    }
    
    /**
     * Get the ID of the theme
     * 
     * @return number - the ID of the theme
     */
    public function id_theme() {
        return $this->_id_theme;
    }
    
    /**
     * Set the ID of the question
     * 
     * @param integer $id_question - the ID of the question
     */
    public function setId_question($id_question) {
        // L'identifiant de la question sera, quoi qu'il arrive, un nombre entier.
        $this->_id_question = (int) $id_question;
    }
    
    /**
     * Set the type of the question
     * 
     * @param string $type_question - the type of the question
     */
    public function setType_question($type_question) {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($type_question) && strlen($type_question) <= 30)  {
            $this->_type_question = $type_question;
        }
    }
    
    /**
     * Set the text of the question
     * 
     * @param string $text_question - the type of the question
     */
    public function setText_question($text_question) {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($text_question) && strlen($text_question) <= 1000) {
            $this->_text_question = $text_question;
        }
    }
    
    /**
     * Set the difficulty of the question
     * 
     * @param string $difficulte - the difficulty of the question
     */
    public function setDifficulte($difficulte) {
        // Check if this a string
        // length < 30 characters
        if (is_string($difficulte) && strlen($difficulte) <= 30)  {
            $this->_difficulte = $difficulte;
        }
    }
    
    /**
     * Set the ID of the theme
     * 
     * @param integer $id_theme - the ID of the theme
     */
    public function setId_theme($id_theme) {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        $this->_id_theme = $id_theme;
    }
}

?>
