<?php

class Video{

	private $db;
	function __construct($object)
	{
		$this->db = $object;
		$this->db->openConnexion();
	}

	public function ajouterVideo($titre,$url)
	{
		if(!empty($titre) && !empty($url))
		{
			return $this->db->addVideo($titre,$url);
		}
	}

	public function afficherVideos()
	{
		return $this->db->searchDatas("videos");
	}

	public function noteMoyenne($id){
		$notes = $this->db->noteMoyenne($id);
		return $notes;
	}

}