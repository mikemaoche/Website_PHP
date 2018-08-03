<?php 	

	require_once("action/AjaxConnexion.php");
	$ajaxConnexion = New AjaxConnexion(new Database);

	echo json_encode($ajaxConnexion->getVideo());
