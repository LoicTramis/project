<?php
    // get the session
    session_start();
    // delet the session
    session_unset();
    session_destroy();
    // redirection
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: ./index.php");
    
    exit();
?>
