<?php
	require_once("partial/header.php");
	require_once("action/actionVisionnage.php");
	$video = new Video(new Database);


		#$ratingValue = $video->noteMoyenne(34);
		#var_dump($ratingValue);exit;

?>
	<div class="cadreVideo">
		<div class="barreRecherche">
			<button id="idBtnFilter" type="button"><img src="./images/filter.png" alt="home" /></button>
			<input id="idSearchBar" type="search" placeholder="Recherchez ..."></input>
		</div>
		<div id="resultat" style="width:60%;margin:auto;outline:1px solid rgba(255,0,255,0.6);text-align:center;" >
			<h3>Affichage des vidéos trouvées</h3>
		</div>
		<div class="cadreIFrames">

			<?php
				$list = $video->afficherVideos();
		  		foreach($list as $key => $item)
				{ 
					$i = 0;
			?>		<div  class="unFrame">
						<form method="GET" action="appreciation.php">
							<input type="text" name="videoTitre" value=<?= '"' . $item["titre"] . '"'?> style="display:none;"/>
							<input style="display:none;" type="text" name="score" value=<?php 
								if($video->noteMoyenne($item["id"])[$i]["videosID"] == $item["id"] ){
									echo $video->noteMoyenne($item["id"])[$i]['AVG(note)'];
								}else{
									echo "NA" . "/10";
								}?> />
							<h3><?=$item["titre"]?></h3>
							<p>Publié le : <?=$item["datant"]?></p>
							<p>Score : <?php 
								if($video->noteMoyenne($item["id"])[$i]["videosID"] == $item["id"]){
									echo $video->noteMoyenne($item["id"])[$i]['AVG(note)'];
								}else{
									echo "NA" . "/10";
								}
							?></p>
							<?=$item["url"]?>
							<input type="submit" value="Appréciation" />
						</form>
					</div>
			<?php
				$i++;
				}
			?>			
		</div>
		<!-- AJAX pour la BARRE DE RECHERCHE -->
		<script>

			$(document).ready(function(){
				$("#idSearchBar").keyup(function(){
					console.log($("#idSearchBar").val())
					$.ajax({
						url: 'converter.php',
						type: 'POST',
						data:{
							video: $("#idSearchBar").val()
						}
					}).done(function(reponse){
						reponse = JSON.parse(reponse)
						entete = "<h3>Affichage des vidéos trouvées</h3>"
						if($("#idSearchBar").val().length > 0){
							for(var i = 0 ; i < reponse.length ; i++){
								console.log(reponse[i]["titre"])
								
								titre = "<p>" + reponse[i]["titre"] + "</p>"
								video = reponse[i]["url"]
								date = "<p>Publié le : " + reponse[i]["datant"] + "</p>"
								resultat += entete + titre + video + date
								
							}
							$("#resultat").html(resultat)
							resultat=""
						}else{
							$("#resultat").html("<p>aucun résultat</p>")
						}
						
						
					});
				});

			});
		</script>
	</div>
<?php
	require_once("partial/footer.php");
?>