<?php
	
	require_once("partial/header.php");
?>
	<div class="info_aide">
		<p>Cette page contient un plan du site et des informations sur l'auteur en question.
			Pour plus d'information cliquer sur les liens ci-dessous.</p>
		<nav>
			<ul>
				<li><a href="#plan_du_site">Plan du site</a></li>
				<li><a href="#regles">Les règles à respecter</a></li>
				<li><a href="#auteur">L'auteur</a></li>
				<li><a href="#but">Le but de cette page</a></li>
			</ul>
		</nav>
		<div id="plan_du_site">
			<p>Vous pouvez cliquer sur les liens ci-dessous</p>
			<ul>
				<li><a href="index.php">Accueil : contient des nouveautés sur les séries animées.</a></li>
				<li><a href="demande.php">Demander une vidéo : ajouter votre vidéo en nous envoyant votre demande.</a></li>
				<li><a href="visionnage.php">Visionner : voir des vidéos.</a></li>
				<li><a href="inscription.php">Inscription : devenir un membre.</a></li>
			</ul>
		</div>
		
		<div id="regles">
			<p>Toutes personnes qui publient des contenus choquant ou adoptent de mauvais comportements seront bannies du site. Un minimum de respect doit être présent envers la communauté.</p>
		</div>
		
		<div id="auteur">
			<ul>
				<li>Nom : Mike</li>
				<li>Pays d'origine : Polynésie française</li> 
				<li>Collaborateurs : aucun pour le moment</li>
			</ul>
		</div>

		<div id="but">
			<p>L'objectif de cette page est de donner une agréable expérience de l'utilisateur. Ce site diffuse des animes
				assez populaires. On vous souhaite de bien vous amuser et de profiter pleinement.</p>
		</div>

		<p><a href="index.php">retour</a></p>
	</div>
<?php
	require_once("partial/footer.php");
?>