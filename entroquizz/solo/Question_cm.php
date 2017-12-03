<?php
require_once 'Question.php';

class Question_cm extends Question {

    private $_choix_1;
    private $_choix_2;
    private $_choix_3;
    private $_choix_4;
    private $_reponse_1;
    private $_reponse_2;
    private $_reponse_3;
    private $_reponse_4;

    public function __construct(array $donnees_question, array $donnees_question_cm) {
        parent::__construct($donnees_question);
        $this->hydrate($donnees_question_cm);
    }
    
    // CETTE FONCTION INITIALISE UN OBJET
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

    public function choix_1() {
        return $this->_choix_1;
    }

    public function choix_2() {
        return $this->_choix_2;
    }

    public function choix_3() {
        return $this->_choix_3;
    }

    public function choix_4() {
        return $this->_choix_4;
    }

    public function reponse_1() {
        return $this->_reponse_1;
    }

    public function reponse_2() {
        return $this->_reponse_2;
    }

    public function reponse_3() {
        return $this->_reponse_3;
    }

    public function reponse_4() {
        return $this->_reponse_4;
    }

    public function setChoix_1($choix_1) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($choix_1) && strlen($choix_1) <= 30) {
            
            $this->_choix_1 = $choix_1;
        }
    }

    public function setChoix_2($choix_2) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($choix_2) && strlen($choix_2) <= 30) {
            
            $this->_choix_2 = $choix_2;
        }
    }

    public function setChoix_3($choix_3) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($choix_3) && strlen($choix_3) <= 30) {
            
            $this->_choix_3 = $choix_3;
        }
    }

    public function setChoix_4($choix_4) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($choix_4) && strlen($choix_4) <= 30) {
            
            $this->_choix_4 = $choix_4;
        }
    }

    public function setReponse_1($reponse_1) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($reponse_1) && strlen($reponse_1) <= 30) {
            $this->_reponse_1 = $reponse_1;
        }
    }

    public function setReponse_2($reponse_2) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($reponse_2) && strlen($reponse_2) <= 30) {
            $this->_reponse_2 = $reponse_2;
        }
    }

    public function setReponse_3($reponse_3)  {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($reponse_3) && strlen($reponse_3) <= 30) {
            $this->_reponse_3 = $reponse_3;
        }
    }

    public function setReponse_4($reponse_4) {
        
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($reponse_4) && strlen($reponse_4) <= 30) {
            $this->_reponse_4 = $reponse_4;
        }
    }
}

?>
