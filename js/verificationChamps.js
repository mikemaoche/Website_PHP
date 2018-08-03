function verifier(){
	/* Ce code permet de vérifier si les champs ont été rempli */

	nom = document.getElementById('idNom')
	email = document.getElementById('idEmail')
	mdp1 = document.getElementById('idMdp1')
	mdp2 = document.getElementById('idMdp2')

	// changer les couleurs 
	borderColor(nom,4);
	borderColor(email,1);
	borderColor(mdp1,9);
	borderColor(mdp2,9);

	//console.log(nom + "," + email + "," + mdp1 + "," + mdp2)	
	if(nom.value.length >= 4 && email.value.length >= 1 && mdp1.value.length >= 9 && mdp2.value.length >= 9){
		document.getElementById('idInscrire').disabled=false;
	}
	else{
		document.getElementById('idInscrire').disabled=true;
	}
}

function borderColor(elem,size){
	if( elem.value.length >= size){
		elem.style.outline = "3px green solid";
		$(elem).notify("Ce champ a été rempli avec succés",{className: 'success', position: 'right',autoHide:false,showDuration: 0})
	}
	else{
		elem.style.outline = "3px red solid";
		$(elem).notify("Remplissez ce champ au minimum " + size + " caractère(s)",{className: 'error', position: 'right',autoHide:false,showDuration: 0})
	}
}