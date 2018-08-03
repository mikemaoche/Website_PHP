<?php
require_once("database.php"); # importation de la librairie database


/* la classe candidat va servir à inscrire */
class Candidat{
	private $nom="";
	private $email="";
	private $mdp1="";
	private $mdp2="";

	public function inscrire($nom, $email, $mdp1, $mdp2)
	{
		$this->nom = $nom;
		$this->email = $email;
		$this->mdp1 = $mdp1;
		$this->mdp2 = $mdp2;
	}

	public function afficher()
	{
		echo "Bienvenue ! ". $this->nom . ". Votre email est " . $this->email . ".";
	}

	public function getData()
	{
		$dictionary= array(0=>$this->nom,1=>$this->email,2=>$this->mdp1);
		return $dictionary;
	}
}

$candidat = new Candidat;
$db = new Database;
$db->openConnexion();
if(!empty($_POST["password1"]) === !empty($_POST["password2"]))
{
	if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	    //L'email est bonne
		$candidat->inscrire(htmlspecialchars($_POST["nom"],ENT_QUOTES),htmlspecialchars($_POST["email"],ENT_QUOTES),htmlspecialchars($_POST["password1"],ENT_QUOTES),htmlspecialchars($_POST["password2"],ENT_QUOTES));
		$mdpEncrypte= password_hash($candidat->getData()[2],PASSWORD_DEFAULT); /* bcrypt */
		$db->submitSomeone($candidat->getData()[0],$candidat->getData()[1],$mdpEncrypte);
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<title>Inscription terminée</title>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width,initial_scale=1">
				<link rel="stylesheet" type="text/css" href="../css/decor.css">
				
			</head>
			<body>
				<div class="compteCree">
					<h2>Votre compte a été créé avec succés !</h2>
					<p><?= $candidat->afficher()?></p>
					<a href="../index.php">retourner au site</a>
				</div>
			</body>
		</html>
<?php
		}else{ # l'email est invalide
			echo '<body onLoad="alert(\'Email invalide \')">';
			echo '<meta http-equiv="refresh" content="0;URL= ../inscription.php">';
		}
	}else{ # l'un des champs est non remplie ou n'existe pas
		echo '<body onLoad="alert(\' Les mots de passe ne correspondent pas \')">';
		echo '<meta http-equiv="refresh" content="0;URL= ../inscription.php">';
	}
?>
