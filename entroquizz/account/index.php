<?php
    require_once '../include/header.inc.php';
    require_once '../include/fonctions.inc.php';
?>
<section>
	<h2><i class="fa fa-id-card-o"></i>Mon compte</h2>
	<article>
		<h3>Vos donn&eacute;es &amp; statistiques</h3>
		<?php 
		  if (is_connected()) {
		      echo "<div class=\"card\">
                        <div class=\"data\">
                            <p class=\"subtitle\"><i class=\"fa fa-user\"></i>Pseudonyme :</p>
                            <p class=\"info\">".$_SESSION['username']."</p>
                            <p class=\"subtitle\"><i class=\"fa fa-envelope\"></i>Email :</p>
                            <p class=\"info\">".$_SESSION['email']."</p>
                            <p class=\"subtitle\"><i class=\"fa fa-lock\"></i>Mot de passe :</p>
                            <p class=\"info\">***********</p>
                            <p class=\"subtitle\"><i class=\"fa fa-key\"></i>Status :</p>
                            <p class=\"info\">".(is_admin() ? "Administrateur" : "Joueur")."</p>
                            <p class=\"subtitle\"><i class=\"fa fa-cog\"></i>Pr&eacute;f&eacute;rences :</p>
                            <p class=\"info\">&Agrave; venir</p>
                        </div>
                        <div class=\"stats\">
                            <p class=\"subtitle\"><i class=\"fa fa-user-circle-o\"></i>Progression :</p>
                            <figure class=\"dragonball\">
                                <img src=\"".get_icon($_SESSION['avatar'], $_SESSION['badge_niveau'])."\">
                                <legend class=\"hidden\">".$_SESSION['avatar']."</legend>
                            </figure>
                                <span>Nom : ".ucfirst($_SESSION['avatar'])."</span>
                                <span>Forme : ".get_form($_SESSION['avatar'], $_SESSION['badge_niveau'])."</span>
                            <p class=\"subtitle\"><i class=\"fa fa-inbox\"></i>Score :</p>
                            <p class=\"info\">".get_exp($_SESSION['username'])."</p>
                            <p class=\"subtitle\"><i class=\"fa fa-sort-amount-asc\"></i>Classement :</p>
                            <p class=\"info\">".get_solo_ranking($_SESSION['username'])."</p>
                            <p class=\"subtitle\"><i class=\"fa fa-area-chart\"></i>Statistques :</p>
                            <p class=\"info\"><a href=\"../stats/\">Statistique</a></p>
                            <p class=\"subtitle\"><i class=\"fa fa-history\"></i>Historique :</p>
                            <p class=\"info\"><a href=\"../\">Histo</a></p>
                        </div>
                    </div>";
		  } else {
		      echo "pas connecté";
		  }
		?>
		<a href="loggout.php">Deconnexion</a>
	</article>
</section>

<?php 
    require_once '../include/footer.inc.php';
?>