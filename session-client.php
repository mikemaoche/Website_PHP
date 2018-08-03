<?php
	require_once("partial/header.php");
	if(!empty($_SESSION["visibility"]) < 1)
	{
		header("location:login.php?error=1");
	}
	
?>
	<!-- fin -->
	<div class="container">
		<div class="editerProfil">
			<?php require_once("partial/upload-image.php");  ?>
		</div>
		<div class="editerProfil">
			<div class="divDroite">
				<div class="divDroiteSous">
					<p>Nom</p><input id="idNom" type="text" name="nom" placeholder=<?=$_SESSION['login']?> disabled>
					<p>E-mail</p><input id="idEmail" type="text" name="email" placeholder=<?=$_SESSION['email']?> disabled>
					<button onclick="editerProfil()">Editer</button>
				</div>				
			</div>
		</div>
	</div>

<?php
	require_once("partial/footer.php");
?>