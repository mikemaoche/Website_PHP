/* CONTIENT LES SEULEMENTS LES EVENTS */



function editerProfil()
{

	var champNom = document.getElementById('idNom');
	var champEmail = document.getElementById('idEmail');

	if(champNom.disabled == false && champEmail.disabled == false)
	{
		champNom.disabled = true
		champEmail.disabled = true
	}else{
		champNom.disabled = false
		champEmail.disabled = false
	}
}