<?php

class Appreciation{

	private $db;
	function __construct($object){
		$this->db = $object;
		$this->db->openConnexion();
	}

	public function trouverVideo($titre){
		if(!empty($titre)){
			return $this->db->searchVideo($titre);
		}
	}

	public function insererCommentaire(){
		if(!empty($_GET["videoTitre"]) && !empty($_SESSION["login"]) && !empty($_POST["editor1"])){
			$commentaire = html_entity_decode($_POST["editor1"]);
			$pseudo = $_SESSION["login"];
			$video = $_GET["videoTitre"];
			$this->db->insertComment($pseudo,$video,$commentaire);
		}
		#var_dump($_POST["note"]);exit;
		if(!empty($_POST["note"])){
			$this->db->insertNote($_POST["note"],$_GET["videoTitre"],$_SESSION["login"]);
		}
	}

	public function afficherCommentaires(){
		return $this->db->afficherComments($_GET["videoTitre"]);
	}

	public function trouverUsager($usagerId)
	{
		return $this->db->searchUserById($usagerId);
	}
}
