<?php
	require_once("action/indexAction.php");
	$error= isset($_GET['error']) ? $_GET['error']: '';
	require_once("action/session-uploadAction.php");
	#var_dump($_SESSION["visibility"]);
	$visible = isset($_SESSION["visibility"]) ? $_SESSION["visibility"] : 0;
	uploadImage();
	if($visible == 0 && !empty($_GET["error"])){
		$error = $_GET["error"];
	}
	#var_dump($_SESSION["photoProfil"]);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>MyAnimTV</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial_scale=1">
	<link rel="stylesheet" type="text/css" href="css/decor.css">
	<script type="text/javascript" src="js/creationBalises.js"></script>
	<script type="text/javascript" src="js/events.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<script type="text/javascript" src="js/notify.js"></script>
	<!-- change le texte du input file (par défaut : "choississez un fichier") -->
	<script type="text/javascript">
		function getfile(){
	        document.getElementById('idFile').click();
	    }
	</script>
</head>
<body>
<?php 
	if($visible == 1)
	{
?>
<div class="entete">
	<header>
		<h1>MyAnimTv</h1>
		<div class="cadreLogge">
			<a href="session-client.php"><img alt="imgClient" src=<?php 
			$img = !empty($_SESSION["photoProfil"]) ? $_SESSION["photoProfil"] : '';
			echo  $img ?>></a>
			<div class="logout">
				<a href="session-client.php"><?=$_SESSION['login']?></a>
				<a title="déconnexion" href="index.php?etatConnexion=0&action=true"><img alt="imgLogout" src="images/logout.png"></a>
			</div>
		</div>
	</header>
	<div class="englobeMenu">
		<nav id="menuPrincipal" class="menuPrincipal"><script>creerMenuPrincipal();</script></nav>
	</div>
</div>
<?php
	}
	else if($visible == 0)
	{
?>
<div class="entete">
	<header>
		<h1>MyAnimTv</h1>	
		<div class="bouttonsLogIns">
			<script>
				creerButtonsLogIns();
			</script>
		</div>
	</header>
	<div class="englobeMenu">
		<nav id="menuPrincipal" class="menuPrincipal"><script>creerMenuPrincipal();</script></nav>
	</div>
</div>

<?php 
	}
	else if($visible == 3)
	{
?>
	<div class="entete">
			<header>
				<h1>MyAnimTv</h1>
				<div class="cadreLogge">
					<a href="session-admin.php"><img alt="imgClient" src=<?php 
					$img = !empty($_SESSION["photoProfil"]) ? $_SESSION["photoProfil"] : "aucun";
					echo  $img ?>></a>
					<div class="logout">
						<a href="session-admin.php"><?=$_SESSION['login']?></a>
						<a title="déconnexion" href="index.php?etatConnexion=0&action=true"><img alt="imgLogout" src="images/logout.png"></a>
					</div>
				</div>
			</header>
		<div class="englobeMenu">
			<nav id="menuPrincipal" class="menuPrincipal"><script>creerMenuPrincipal();</script></nav>
		</div>
	</div>
<?php
	}
	switch ($error) {
		case 1:
			?>
			<script>$.notify("Attention: Membre non reconnu",{className:"warn",position:"top center"});</script>
			<?php
			break;
		case 2:
			?>
			<script>$.notify("Vous avez été déconnecté avec succés",{className:"success",position:"top center"});</script>
			<?php
			break;
		case 3:
			?>
			<script>$.notify("Erreur: Mauvais login ou mot de passe",{className:"error",position:"top center"});</script>
			<?php
			break;
		case 4:
			?>
			<script>$.notify("Attention: Vous devez être connecté",{className:"warn",position:"top center"});</script>
			<?php
			break;
		}