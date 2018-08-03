<?php

class Database{	

	private $bd;

	/** SE CONNECTER ET SE DÉCONNECTER DE LA BASE DE DONNÉES **/
	public function openConnexion()
	{
		/* se connecter à la bd */
		try
		{
			$this->bd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	/** OPÉRATIONS DANS LA BASE DE DONNÉES **/
	public function submitSomeone($nom,$email,$mdp) /* au moment de l'inscription */
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$statut='usager';
			$stmt = $this->bd->prepare("INSERT INTO Usagers(nom,email,mdp,statut) VALUES (?,?,?,?)");
			$stmt->bindParam(1,$nom);
			$stmt->bindParam(2,$email);
			$stmt->bindParam(3,$mdp);
			$stmt->bindParam(4,$statut);
			$stmt->execute();
		}
		catch(Exception $e)
		{
			echo '<body onLoad="alert(\'Nom ou email dupliqué ! \')">'; 
			echo '<meta http-equiv="refresh" content="0;URL= ../inscription.php">';
  			die($e->getMessage());  			
		}
		
	}

	/* cette fonction retourne un datas[] */
	public function searchDataUser($value)
	{
		try
		{
			/* set la requete pour trouver le nom ou l'email */
			if(filter_var($value, FILTER_VALIDATE_EMAIL))
			{
				$requete="SELECT * FROM usagers WHERE email = ?;";
			}
			else
			{
				$requete="SELECT * FROM usagers WHERE nom = ?;";
			}
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$value);
			$stmt->execute();
			$donnees = $stmt->fetch();
			return $donnees;

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
		}
	}	

	/** REQUETES POUR LE PHP DEMANDES VIDEO **/
	public function submitDemande($titre,$langue,$id)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$requete= "INSERT INTO Demandes(nom_video,langue,usagersID) VALUES (?,?,?)";
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$titre);
			$stmt->bindParam(2,$langue);
			$stmt->bindParam(3,$id);
			$stmt->execute();
		}
		catch(Exception $e)
		{
  			die($e->getMessage());  			
		}
	}

	/* retourne les données de n'importe quelle table */
	public function searchDatas($tablename)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="SELECT * FROM " . $tablename;
			$stmt = $this->bd->prepare($requete);
			$stmt->execute();
			$donnees = $stmt->fetchAll();
			return $donnees;

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
		}
	}

	/* LES SUPPRESSIONS */
	public function deleteUser($nom)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="DELETE FROM usagers WHERE nom = ?;";
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$nom);
			$stmt->execute();
			return "success";

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
  			return "error";
		}

	}	

	public function deleteVideo($titre)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="DELETE FROM videos WHERE titre = ?;";
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$titre);
			$stmt->execute();
			return "success";

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
  			return "error";
		}

	}	

	/* LES AJOUTS DE VIDEO */
	public function addVideo($title,$url) /* au moment de l'inscription */
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$stmt = $this->bd->prepare("INSERT INTO Videos(titre,url) VALUES (?,?)");
			$stmt->bindParam(1,$title);
			$stmt->bindParam(2,$url);
			$stmt->execute();
			return "success";
		}
		catch(Exception $e)
		{
  			die($e->getMessage());
  			return "error";  			
		}
		
	}

	// TROUVER LA VIDEO POUR APPRECIATION
	public function searchVideo($titre)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="SELECT * FROM videos WHERE titre = ?;";
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$titre);
			$stmt->execute();
			$donnees = $stmt->fetchAll();
			return $donnees;
		}
		catch(Exception $e)
		{
  			return "error";
		}

	}


	public function searchVideoFilter($titre)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="SELECT * FROM videos WHERE titre LIKE CONCAT(?, '%')" ;
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$titre);
			$stmt->execute();
			$donnees = $stmt->fetchAll();
			return $donnees;
		}
		catch(Exception $e)
		{
  			return "error";
		}

	}

	public function insertComment($pseudo,$video,$commentaire)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			# on cherche le id associé à la vidéo
			$stmt = $this->bd->prepare("SELECT id FROM videos WHERE titre = ?;");
			$stmt->bindParam(1,$video);
			$stmt->execute();
			$videoId = $stmt->fetch(); 
			# on cherche le id associé à l'usager
			$stmt = $this->bd->prepare("SELECT id FROM usagers WHERE nom = ?;");
			$stmt->bindParam(1,$pseudo);
			$stmt->execute();
			$userId = $stmt->fetch(); 
			# insertion de notre commentaire
			$stmt = $this->bd->prepare("INSERT INTO commentaires(commentaire,usagersID,videosID) VALUES (?,?,?)");
			$stmt->bindParam(1,$commentaire);
			$stmt->bindParam(2,$userId["id"]);
			$stmt->bindParam(3,$videoId["id"]);
			$stmt->execute();
			return "success";
		}
		catch(Exception $e)
		{
			die("Failed: " . $e->getMessage());
  			return "error";
		}
	}

	/* INSERER LA NOTE */
	public function insertNote($note,$video,$pseudo)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			# on cherche le id associé à la vidéo
			$stmt = $this->bd->prepare("SELECT id FROM videos WHERE titre = ?;");
			$stmt->bindParam(1,$video);
			$stmt->execute();
			$videoId = $stmt->fetch(); 
			# on cherche le id associé à l'usager
			$stmt = $this->bd->prepare("SELECT id FROM usagers WHERE nom = ?;");
			$stmt->bindParam(1,$pseudo);
			$stmt->execute();
			$userId = $stmt->fetch(); 
			# insertion de notre commentaire
			$stmt = $this->bd->prepare("INSERT INTO evaluations(note,usagersID,videosID) VALUES (?,?,?)");
			$stmt->bindParam(1,$note);
			$stmt->bindParam(2,$userId["id"]);
			$stmt->bindParam(3,$videoId["id"]);
			$stmt->execute();
			return "success";
		}
		catch(Exception $e)
		{
			die("Failed: " . $e->getMessage());
  			return "error";
		}
	}

	public function afficherComments($video)
	{
		try
		{
			# on cherche le id associé à la vidéo
			$stmt = $this->bd->prepare("SELECT id FROM videos WHERE titre = ?;");
			$stmt->bindParam(1,$video);
			$stmt->execute();
			$videoId = $stmt->fetch(); 			
			$stmt = $this->bd->prepare("SELECT * FROM commentaires WHERE videosID = ? ORDER BY id DESC;");
			$stmt->bindParam(1,$videoId["id"]);
			$stmt->execute();
			$donnees = $stmt->fetchAll();
			return $donnees;

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
		}
	}

	public function searchUserById($usagerId)
	{
		try
		{
			# on cherche le id associé à la vidéo
			$stmt = $this->bd->prepare("SELECT nom FROM usagers WHERE id = ?;");
			$stmt->bindParam(1,$usagerId);
			$stmt->execute();
			return $stmt->fetch()["nom"];		
			

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
		}
	}

	public function noteMoyenne($idVideo)
	{
		try
		{
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$requete="SELECT AVG(note),videosID,usagersID FROM evaluations WHERE videosID=?";
			$stmt = $this->bd->prepare($requete);
			$stmt->bindParam(1,$idVideo);
			$stmt->execute();
			$donnees = $stmt->fetchAll();
			return $donnees;

		}
		catch(Exception $e)
		{
  			die("Failed: " . $e->getMessage());
		}
	}
}