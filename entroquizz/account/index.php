<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2>Bienvenue Michoubichi</h2>
	<article>
	 <h3>infos pour la bd</h3>
	 <?php 
	   if (isset($_POST['c_login']) && isset($_POST['c_password'])) {
	       connect_user();
	       // user is in the database
    	   
	           // mettre les infos dans une session
    	       
           // user is not in the database
       }
       if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && isset($_SESSION['username'])) {
           echo "  <p>".$_SESSION['username']."</p>
                       <p>".$_SESSION['admin']."OUI ADMIN</p>";
       } else if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
           echo "<p>NON TA MERE</p>";
       }
	   
	   if (isset($_POST['r_username']) && isset($_POST['r_email']) && isset($_POST['r_password']) && isset($_POST['r_repassword']) && isset($_POST['r_tribe'])) {
           if ($_POST['r_password'] == $_POST['r_repassword'] && !empty($_POST['r_password']) && !empty($_POST['r_repassword'])) {
    	       $username = $_POST['r_username'];
    	       $email = $_POST['r_email'];
    	       $password = $_POST['r_password'];
    	       $tribe = $_POST['r_tribe'];
    	       // user is not in the database
    	       if (!is_in_database($username)) {
    	           // enreistrer dans la BD
    	           register_user($username, $email, $password, $tribe);
    	           connect_user();
    	       }
	       // the user is already in the database
           } else {
       
           }
	   }
	 ?>
	<a href="loggout.php">Deconnexion</a>
	</article>
</section>

<?php 
    require_once '../include/footer.inc.php';
?>