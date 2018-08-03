<?php
require_once("action/database.php"); # importation de la librairie database

class Demande{

	private $demandes;
	private $db;
	function __construct($object)
	{
		$this->db = $object;
		$this->db->openConnexion();
	}

	public function envoyer()
	{
		$name = isset($_SESSION["login"]) ? $_SESSION["login"] : '';
		$datas = $this->db->searchDataUser($name);
		#var_dump($datas["id"]);
		if(!empty($_GET["nomVideo"]) && !empty($_GET["langue"]))
		{
			$this->db->submitDemande(htmlspecialchars($_GET["nomVideo"],ENT_QUOTES),htmlspecialchars($_GET["langue"],ENT_QUOTES),$datas["id"]);
		}
	}

	public function voirDemandes()
	{
		$this->demandes = $this->db->searchDatas("demandes");
		return $this->demandes;
	}
}
	
$demande = new Demande(new Database);
$demande->envoyer();

