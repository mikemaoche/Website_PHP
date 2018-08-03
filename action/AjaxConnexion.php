<?php
	require_once("database.php");

class AjaxConnexion{
	private $db;

	function __construct($object)
	{
		$this->db = $object;	
		$this->db->openConnexion();
	}

    function getVideo(){
    	$resultat = $this->db->searchVideoFilter($_POST["video"]);
    	return $resultat;
    	/*if($resultat == null) {
        	return "Aucun résultat trouvé";
    	}else{
    		return $resultat;
    	}*/
    }
}

