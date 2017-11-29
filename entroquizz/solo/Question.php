<?php

class Question

{

  private $_id_question;

  private $_type_question;

  private $_text_question;

  private $_difficulte;

  private $_id_theme;


  public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}
  

	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).

  public function hydrate(array $donnees)  //CETTE FONCTION INITIALISE UN OBJET

  {
	  foreach ($donnees as $key => $value)

	  {

		// On récupère le nom du setter correspondant à l'attribut.

		$method = 'set'.ucfirst($key);

		    

		// Si le setter correspondant existe.

		if (method_exists($this, $method))

		{

		  // On appelle le setter.

		  $this->$method($value);

		}

	  }	
	 
  }


  public function id_question() { return $this->_id_question; }

  public function type_question() { return $this->_type_question; }

  public function text_question() { return $this->_text_question; }

  public function difficulte() { return $this->_difficulte; }

  public function id_theme() { return $this->_id_theme; }


  public function setId_question($id_question)

  {

    // L'identifiant de la question sera, quoi qu'il arrive, un nombre entier.
    $this->_id_question = (int) $id_question;

  }

        

  public function setType_question($type_question)

  {

    // On vérifie qu'il s'agit bien d'une chaîne de caractères.

    // Dont la longueur est inférieure à 30 caractères.

    if (is_string($type_question) && strlen($type_question) <= 30)

    {

      $this->_type_question = $type_question;

    }

  }


  public function setText_question($text_question)

  {

    // On vérifie qu'il s'agit bien d'une chaîne de caractères.

    // Dont la longueur est inférieure à 30 caractères.

    if (is_string($text_question) && strlen($text_question) <= 1000)

    {

      $this->_text_question = $text_question;

    }

  }


  public function setDifficulte($difficulte)

  {

    // On vérifie qu'il s'agit bien d'une chaîne de caractères.

    // Dont la longueur est inférieure à 30 caractères.

    if (is_string($difficulte) && strlen($difficulte) <= 30)

    {

      $this->_difficulte = $difficulte;

    }

  }


  public function setId_theme($id_theme)

  {

    // On vérifie qu'il s'agit bien d'une chaîne de caractères.

    // Dont la longueur est inférieure à 30 caractères.



      $this->_id_theme = $id_theme;


  }



}

?>
