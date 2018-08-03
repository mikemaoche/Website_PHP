<?php

function uploadImage()
{
	$valid=0;
	$type = !empty($_FILES["file"]["type"]) ? $_FILES["file"]["type"] : '';
	$size = !empty($_FILES["file"]["size"])  ? $_FILES["file"]["size"] : 0;
	#var_dump($_SESSION["photoProfil"]);
	
	if(!isset($_SESSION["photoProfil"]))
	{
		$_SESSION["photoProfil"] = "imagesProfils/defaut.jpg";
	} 
	if ((($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/pjpeg"))
		&& ($size < 100000)) # octects
	{
		  if (!empty($_FILES["file"]["error"]) > 0){
		    	$valid=0; # file error
		    }else {
			  if (file_exists("images/".$_FILES["file"]["name"])){
				   $valid=0;
				}else {	# on store l'image à un endroit
					$valid=1;
				   move_uploaded_file($_FILES["file"]["tmp_name"],"imagesProfils/". $_FILES["file"]["name"]);
				   $_SESSION["photoProfil"] = "imagesProfils/" . $_FILES['file']['name'];
					#echo "Stored in: " . "images/" . $_FILES["file"]["name"]."<br />";
				}
			}
	}else {
		  	$valid=0;
		  	#echo "Invalid file detail ::<br> file type ::".$_FILES["file"]["type"]." , file size::: ".$_FILES["file"]["size"];
		}
	$_SESSION["imgValue"] = $valid;
}


#echo "Upload File Name:  " . $_FILES["file"]["name"] . "<br />";
#echo "File Type:         " . $_FILES["file"]["type"] . "<br />";
#echo "File Size:         " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";		  
#echo "File Description:: ".$_POST['description']."<br />";
#echo "File Error :  " . $_FILES["file"]["error"] . "<br />";
#echo "<b>".$_FILES["file"]["name"] . " already exists. </b>";