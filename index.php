<?php
	require_once("partial/header.php");
	require_once("action/actionManipulerFichier.php");
	$file = new File("annonce.txt");
?>
	<div class="annonce">
		<div class="introAnnonce">
			<h1>L'actualité</h1>
			<marquee>Vous pouvez voir des annonces liés aux séries animés, ces publications ont été rédigé par l'administrateur du site.</marquee>
		</div>
		<?= $file->afficherAnnonce() ?>
	</div>
<?php
	require_once("partial/footer.php");
?>