<?php
require_once 'Question.php';

/**
 * Inheritance of the Question class. Question multiple choice type.
 * 
 * @version PHP 7.1
 * @author Beno&icirc;t
 * @author Lo&iuml;c
 *
 */
class Question_cm extends Question {

    private $_choix_1;
    private $_choix_2;
    private $_choix_3;
    private $_choix_4;
    private $_reponse_1;
    private $_reponse_2;
    private $_reponse_3;
    private $_reponse_4;

    /**
     * Useful for creating an object.
     *
     * @param array $donnees_question
     * @param array $donnees_question_on
     */
    public function __construct(array $donnees_question, array $donnees_question_cm) {
        parent::__construct($donnees_question);
        $this->hydrate($donnees_question_cm);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see Question::hydrate()
     */
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);
            
            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }
    /**
     * Get choice 1
     * 
     * @return string - the 1st choice
     */
    public function choix_1() {
        return $this->_choix_1;
    }
    /**
     * Get choice 2
     *
     * @return string - the 2nd choice
     */
    public function choix_2() {
        return $this->_choix_2;
    }
    /**
     * Get choice 3
     *
     * @return string - the 3rd choice
     */
    public function choix_3() {
        return $this->_choix_3;
    }
    /**
     * Get choice 4
     *
     * @return string - the 4th choice
     */
    public function choix_4() {
        return $this->_choix_4;
    }
    /**
     * Get answer 1
     *
     * @return string - the 1st answer
     */
    public function reponse_1() {
        return $this->_reponse_1;
    }
    /**
     * Get answer 2
     *
     * @return string - the 2nd answer
     */
    public function reponse_2() {
        return $this->_reponse_2;
    }
    /**
     * Get answer 3
     *
     * @return string - the 3rd answer
     */
    public function reponse_3() {
        return $this->_reponse_3;
    }
    /**
     * Get answer 4
     *
     * @return string - the 4th answer
     */
    public function reponse_4() {
        return $this->_reponse_4;
    }
    /**
     * Set the choice 1
     * 
     * @param string $choix_1 - the 1st choice
     */
    public function setChoix_1($choix_1) {
        // Check if this a string
        // length < 30 characters
        if (is_string($choix_1) && strlen($choix_1) <= 30) {
            
            $this->_choix_1 = $choix_1;
        }
    }
    /**
     * Set the choice 2
     * 
     * @param string $choix_2 - the 2nd choice
     */
    public function setChoix_2($choix_2) {
        // Check if this a string
        // length < 30 characters
        if (is_string($choix_2) && strlen($choix_2) <= 30) {
            
            $this->_choix_2 = $choix_2;
        }
    }

    /**
     * Set the choice 3
     * 
     * @param string $choix_3 - the 3rd choice
     */
    public function setChoix_3($choix_3) {
        // Check if this a string
        // length < 30 characters
        if (is_string($choix_3) && strlen($choix_3) <= 30) {
            
            $this->_choix_3 = $choix_3;
        }
    }
    /**
     * Set the choice 4
     * 
     * @param string $choix_4 - the 4th choice
     */
    public function setChoix_4($choix_4) {
        // Check if this a string
        // length < 30 characters
        if (is_string($choix_4) && strlen($choix_4) <= 30) {
            
            $this->_choix_4 = $choix_4;
        }
    }
    /**
     * Set the answer 1
     * 
     * @param string $reponse_1 - the 1st answer
     */
    public function setReponse_1($reponse_1) {
        // Check if this a string
        // length < 30 characters
        if (is_string($reponse_1) && strlen($reponse_1) <= 30) {
            $this->_reponse_1 = $reponse_1;
        }
    }
    /**
     * Set the answer 2
     * 
     * @param string $reponse_2 - the 2nd answer
     */
    public function setReponse_2($reponse_2) {
        // Check if this a string
        // length < 30 characters
        if (is_string($reponse_2) && strlen($reponse_2) <= 30) {
            $this->_reponse_2 = $reponse_2;
        }
    }

    /**
     * Set the answer 3
     * 
     * @param string $reponse_3 - the 3rd choice
     */
    public function setReponse_3($reponse_3)  {
        // Check if this a string
        // length < 30 characters
        if (is_string($reponse_3) && strlen($reponse_3) <= 30) {
            $this->_reponse_3 = $reponse_3;
        }
    }

    /**
     * Set the answer 4
     * 
     * @param string $reponse_4 - the 4th answer
     */
    public function setReponse_4($reponse_4) {
        // Check if this a string
        // length < 30 characters
        if (is_string($reponse_4) && strlen($reponse_4) <= 30) {
            $this->_reponse_4 = $reponse_4;
        }
    }
}

?>
