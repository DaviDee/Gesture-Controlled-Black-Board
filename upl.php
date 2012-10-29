<?php
if (isset($_FILES["datei"]) AND ! $_FILES["datei"]["error"]  AND  ($_FILES["datei"]["size"] < 10000000 )) {
    $bildinfo = getimagesize($_FILES["datei"]["tmp_name"]);
	$width = $bildinfo[0];
	$height =$bildinfo[1];
    if ($bildinfo === false) {
      die("That`s not a picture!");
    } 
	else {
      $mime = $bildinfo["mime"];
      $mimetypen = array (
        "image/jpeg" => "jpg",
	    "image/gif" => "gif",
	    "image/png" => "png"
	);
     if (!isset($mimetypen[$mime])) {
       die("This is not the right format!");
     } 
	elseif($width != 1080 || $height !=1920){
		die("To guarantee the best quality,
			the photo should only be in HD-format (1080 x 1920). <br/>
			Please use jpg, png or gif!");
	} else {
       $endung = $mimetypen[$mime];
     }

     $neuername = basename($_FILES["datei"]["name"]);
     $neuername = preg_replace("/\.(jpe?g|gif|png)$/i", "", $neuername);  
     $neuername = preg_replace("/[^a-zA-Z0-9_-]/", "", $neuername);     
     $neuername .= ".$endung";
     $ziel = "pics/$neuername";
     while (file_exists($ziel)) {
       $neuername = "copy_$neuername";
       $ziel = "pics/$neuername";
     }
      if (@move_uploaded_file($_FILES["datei"]["tmp_name"], $ziel)) {
        echo "File-Upload was successful!";
		include "showme.php";
     } else {
       echo "File-Upload was not successful!";
	   include "showme.php";
    }
  }
}
?>