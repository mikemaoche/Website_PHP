<?php
	require_once("partial/header.php");
	if(!empty($_SESSION["visibility"]) < 1){
		header("location:login.php?error=4");
	}
	require_once("action/actionAppreciation.php");
	$apprecie = new Appreciation(new Database);
	$apprecie->insererCommentaire();
?>
	<div class="cadreVideo">
		<div class="cadreIFrames">
			<?php
				$list = $apprecie->trouverVideo($_GET["videoTitre"]);
		  		foreach($list as $key => $item)
				{ 
			?>		<div class="unFrameEvaluer">
						<h1><?=$item["titre"]?></h1>
						<?=$item["url"]?>
						<p>Publié le : <?=$item["datant"]?></p>
						<p>Score : <?=$_GET["score"]?></p>
						<div class="commentaire">
							<form method="POST">
					           <textarea name="editor1" id="editor1">
					           </textarea>
					           <div class="sousCommentaire">
									<span>NOTER </span><input name="note" type="number" min="1" max="10">
									<input name="commenter" type="submit" value="commenter" />
								</div>					  
					   		</form>
				   			<div id="message" class="messages">
				   				<h3>Commentary session : <?=$_GET["videoTitre"]?></h3>
								<?php 
									$list = $apprecie->afficherCommentaires();
						  			foreach($list as $key => $item){
								?>
									<div>
										<b><?php echo $apprecie->trouverUsager($item["usagersID"]) ?> a publié le : <?=$item["datant"]?></b>
										<?=$item["commentaire"]?>
									</div>
								<?php

									}
								?>
							</div> <!-- DIV QUI S'ACTUALISE TOUTES LES 1 SECONDES -->
				   		</div>
					</div>	
				<?php
					}
				?>
		</div>
	</div>
	<script src="ckeditor_public/ckeditor.js"></script>
    <script>CKEDITOR.replace( 'editor1' );</script>
    <!-- AJAX pour refresh les commentaires -->
    <script>
    	 /*$(document).ready(
            function() {
                setInterval(function() {
                    $('#message').html(
                    	"<?php $list = $apprecie->afficherCommentaires();
                    	foreach($list as $key => $item){ ?><div>
                    		<b><?php echo $apprecie->trouverUsager($item['usagersID']) ?> a publié le : <?=$item['datant']?></b>
                    		<?=$item['commentaire']?></div><?php }	?>"
                    	);
                }, 3000);
            });*/
    </script>
<?php
	require_once("partial/footer.php");
?>