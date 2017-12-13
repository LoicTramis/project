<?php
    require_once '../include/header.inc.php';
?>
<section>
	<h2>Bienvenue sur EntroQuizz le meilleur site de quizz</h2>
	<article>
		<h3 class="solo"><i class="fa fa-user"></i> Solo</h3>
		<div class="solo-part">
    		<div class="mode">
    			<a href="../solo/simple.php">Simple</a>
    		</div>
    		<div class="mode">
    			<a href="../solo/random.php">Al&eacute;atoire</a>
    		</div>	
    		<div class="mode">
    			<a href="../solo/timer.php">Chronom&eacute;tr&eacute;e</a>
    		</div>		
		</div>
	</article>	
	
	<article>
		<h3 class="mutli"><i class="fa fa-users"></i> Multi</h3>
		<div class="multi-part">
    		<div class="mode">
    			<a href="../multi/countdown.php">Compte &agrave; rebours</a>
    		</div>
    		<div class="mode death">
    			<a href="../mutli/suddendeath.php">Mort subite</a>
    		</div>	
    		<div class="mode unbalanced">
    			<a href="../mutli/unbalance.php">D&eacute;s&eacute;quilibre</a>
    		</div>		
    		<div class="mode">
    			<a href="../multi/expansion.php">Expansion (&agrave; venir)</a>
    		</div>	
		</div>
	</article>
</section>
<?php 
    require_once '../include/footer.inc.php';
?>