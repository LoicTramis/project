<?php
  function bdd_connect() {

//     $dsn = 'pgsql:host=10.40.128.23 port=5432 dbname=db2017l3i_tramisl';
//     $user = 'y2017l3i_tramisl';
//     $password = 'A123456#';
    $dsn = 'pgsql:host=localhost port=5433 dbname=postgres';
    $user = 'postgres';
    $password = 'pass';
    try {
      $bdd = new PDO($dsn, $user, $password);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        echo 'Échec lors de la connexion : ' . $e->getMessage();
    }

    return $bdd;
  }
  
  
  function delete_msg() {
    $bdd = bdd_connect();
    $time_out = time()-900;
    $sql ="SELECT * FROM chat_messages WHERE timestamp < :time";
    $recup_message = $bdd->prepare($sql);
    $recup_message->execute(array(
    'time' => $time_out
    ));
    $sql1 ="INSERT INTO ancien_message (login,message,date_heure) VALUES (:login, :message, :date_heure)";
    while ($message = $recup_message->fetch()) {
      $query_1 = $bdd->prepare($sql1);
      $query_1->execute(array(
      'login' => $message['login'],
      'message' => $message['message'],
       'date_heure' => $message['date_heure'],
      ));
    }
    $query = $bdd->prepare("DELETE FROM chat_messages WHERE timestamp < :time");
    $query->execute(array(
        'time' => $time_out
        ));
   
  }


  function smiley($texte) {
    $texte = str_replace(' :) ', '<img src="./image/sourire.png" />', $texte);
    $texte = str_replace(':) ', '<img src="./image/sourire.png" />', $texte);
    $texte = str_replace(':)', '<img src="./image/sourire.png"  />', $texte);
    $texte = str_replace(' :)', '<img src="./image/sourire.png" />', $texte);
    $texte = str_replace(' ;) ', '<img src="./image/clin.png" />', $texte);
    $texte = str_replace(';) ', '<img src="./image/clin.png" />', $texte);
    $texte = str_replace(';)', '<img src="./image/clin.png" />', $texte);
    $texte = str_replace(' ;)', '<img src="./image/clin.png" />', $texte);
    $texte = str_replace(' :p ', '<img src="./image/langue.png" />', $texte);
    $texte = str_replace(':p ', '<img src="./image/langue.png" />', $texte);
    $texte = str_replace(' :p', '<img src="./image/langue.png" />', $texte);
    $texte = str_replace(':p', '<img src="./image/langue.png" />', $texte);
    $texte = str_replace(' :d ', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(':d ', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(' :d', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(':d', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(' :D ', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(':D ', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(' :D', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(':D', '<img src="./image/rigole.png" />', $texte);
    $texte = str_replace(' <3 ', '<img src="./image/coeur.png" />', $texte);
    $texte = str_replace('<3 ', '<img src="./image/coeur.png" />', $texte);
    $texte = str_replace(' <3', '<img src="./image/coeur.png" />', $texte);
    $texte = str_replace('<3', '<img src="./image/coeur.png" />', $texte);
    $texte = str_replace('^^', '<img src="./image/hihi.png" />', $texte);
    $texte = str_replace(' ^^', '<img src="./image/hihi.png" />', $texte);
    $texte = str_replace('^^ ', '<img src="./image/hihi.png" />', $texte);
    $texte = str_replace(' ^^ ', '<img src="./image/hihi.png" />', $texte);
    return $texte;
  }


?>
