<?php
require_once("action/database.php"); # importation de la librairie database

class SessionAdmin{

	private $db;
	function __construct($object)
	{
		$this->db = $object;
		$this->db->openConnexion();
	}

	public function afficher($nomTable)
	{
		$datas = $this->db->searchDatas($nomTable);
		return $datas;		
	}

	public function supprimerUsager($nom)
	{
		$this->suppression = $this->db->deleteUser($nom);
		return $this->suppression;
	}

	public function supprimerVideo($titre)
	{
		$this->suppression = $this->db->deleteVideo($titre);
		return $this->suppression;
	}
}
	



