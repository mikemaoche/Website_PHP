<?php
require_once("database.php"); # importation de la librairie database


session_start ();

##########################
function connecter()
{
	$_SESSION['visibility']=0; # par défaut invité
	if (isset($_POST['login']) && isset($_POST['pwd'])) {
		$db = new Database;
		$db->openConnexion();
		$datas = $db->searchDataUser($_POST['login']);
		$login = htmlspecialchars($_POST['login'],ENT_QUOTES);
		$pwd = htmlspecialchars($_POST['pwd'],ENT_QUOTES);
		// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
		if (($datas["nom"] == $login || $datas["email"] == $login)
			&& password_verify($pwd, $datas["mdp"])) {
			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd)
			$_SESSION['login'] = $login;
			$_SESSION['pwd'] = $pwd;
			$_SESSION['email'] = $datas['email'];
			$_SESSION['visibility']=1; # vaut membre
			$path= 'location: session-client.php';
			if($datas['statut'] == "admin")
			{
				$_SESSION['visibility']=3; # vaut admin
				$path= 'location: session-admin.php';
			}
			// on redirige notre visiteur vers une page de notre section membre
			header($path);
			exit;
		}
		else {
			// Le visiteur n'a pas été reconnu comme étant membre de notre site.
			header('location: login.php?error=3');#login='.$login);
		}
	}
}

function deconnecter()
{
	if(!empty($_SESSION["visibility"]) && $_SESSION["visibility"] > 0)
	{
		if (!empty($_GET["action"]) && $_GET["action"]){
			session_unset();
			session_destroy();
			session_start();
			$_GET["error"] = 2; // pour dire vous avez été déconnecté avec succés
		}
	}
}

if(!empty($_GET["etatConnexion"]) == 1)
{
	connecter();
}
else if(!empty($_GET["etatConnexion"]) == 0)
{
	deconnecter();
}
