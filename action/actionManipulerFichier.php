<?php

class File{

	private $file;

	function __construct($object)
	{
		$this->file = $object;
	}

	public function ecrireAnnonce($texte)
	{
		$textFinal = "<div class='sousAnnonce'>" . $texte . "</div>";
		file_put_contents($this->file, $textFinal, FILE_APPEND | LOCK_EX);
	}

	public function afficherAnnonce()
	{
		$data = file_get_contents($this->file);
		echo $data;
	}
}
