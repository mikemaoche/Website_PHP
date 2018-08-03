<?php
	require_once("partial/header.php");
	require_once("action/actionDemandeVideo.php");
	
?>

	<!-- CADRE DEMANDE D'AJOUT D'UNE VIDÉO -->
	<div id="idCadreDemande" class="cadreDemande">
		<form method="get" action="#">
			<h3>Demander votre vidéo</h3>
			<div class="divDemandeInput">
				<input id="idNomVideo" type="text" name="nomVideo" placeholder="nom de la vidéo" >
				<input id="idLangue" type="text" name="langue" placeholder="langue : fr">
			</div>			
			<div class="clearboth"></div>
			<input id="idEnvoyer" type="submit" name="formDemande" value="envoyer">
		</form>
	</div>
	<div class="cadreAfficherDemande">
		<h3>Tableau des demandes</h3>
		<p>Titre</p>
		<p>Langue</p>
		<p>Membre</p>
		<?php 
			$list = $demande->voirDemandes();
			#print_r($list[2]["nom_video"]);
			foreach($list as $id => $item)
			{
				?>
				<p><?=$item["nom_video"]?></p>
				<p><?=$item["langue"]?></p>
				<p><?=$item["usagersID"]?></p>
				<?php
			}
		?>
	</div>
<?php
	$visible = isset($_SESSION["visibility"]) ? $_SESSION["visibility"] : 0;
	if($visible < 1)
	{
		?>
		<script type="text/javascript">
			document.getElementById('idNomVideo').disabled="disabled";
			document.getElementById('idLangue').disabled="disabled";
			document.getElementById('idEnvoyer').disabled="disabled";
		</script>
		<?php
	}
	require_once("partial/footer.php");
	
?>