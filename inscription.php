
<?php
	require_once("partial/header.php");
?>
	<!-- CADRE D'INSCRIPTION -->
	<div id="idCadreInscription" class="cadreInscription">
		<form id="formInscription" method="post" action="action/actionInscription.php" onclick="setInterval(function(){verifier();},1500);">
			<h3>INSCRIVEZ-VOUS</h3>
			<div class="divInscriptionText">
				<p>Pseudo</p>
				<p>Courriel électronique</p>
				<p>Mot de passe</p>
				<p>Tapez à nouveau le mot de passe</p>
			</div>
			<div class="divInscriptionInput">
				<input id="idNom" type="text" name="nom" placeholder="Nom">
				<input id="idEmail" type="text" name="email" placeholder="E-mail">
				<input id="idMdp1" type="password" name="password1" placeholder="Mot de passe">
				<input id="idMdp2" type="password" name="password2" placeholder="confirmez à nouveau">
			</div>			
			<div class="clearboth"></div>
			<input id="idInscrire" type="submit" name="inscrire" value="Valider" disabled>
			<a href="login.php">Avez-vous déjà un compte ? Connectez-vous.</a>
		</form>
	</div>
	<script>

	</script>
	<script type="text/javascript" src="js/verificationChamps.js">
	</script>
<?php
	require_once("partial/footer.php");
?>