/* SCRIPT CRÉATION DE TOUTES BALISES DU SITE */
/*** crée le : 27/02/2016 ***/

function creerMenuPrincipal()
{
	var balise = '<ul><li><p>MENU</p> <img src="./images/home.png" alt="home" /></li>'
	var dictionnaire = {
		"Accueil":'index.php',
		"Demander une vidéo":'demande.php',
		"Visionner":'visionnage.php',
		"Connectez vous":'login.php',
		"Inscription":'inscription.php',
		"Contact":'contact.php'
	}

	for (var key  in dictionnaire)
	{
		console.log(key)
		balise += "<li><a href="+ dictionnaire[key] +">"+ key +"</a></li>"
	}
	document.write(balise + "</ul>")
	
}


function creerButtonsLogIns()
{
	document.write('<button id="idBtnLog" type="button"><a href="login.php">login</a></button>')
    document.write('<button id="idBtnInscription" type="button"><a href="inscription.php">inscription</a></button>')
}



