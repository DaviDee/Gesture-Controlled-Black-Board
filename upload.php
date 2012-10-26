<?php
if (isset($_FILES["datei"]) AND ! $_FILES["datei"]["error"]  AND  ($_FILES["datei"]["size"] < 10000000 )) {
    $bildinfo = getimagesize($_FILES["datei"]["tmp_name"]);
	$width = $bildinfo[0];
	$height =$bildinfo[1];
    if ($bildinfo === false) {
      die("Das ist doch kein Bild!");
    } 
	else {
      $mime = $bildinfo["mime"];
      $mimetypen = array (
        "image/jpeg" => "jpg",
	    "image/gif" => "gif",
	    "image/png" => "png"
	);
     if (!isset($mimetypen[$mime])) {
       die("nicht das richtige Format");
     } 
	/*elseif($width != 1080 || $height !=1920){
		die("Um die beste Qualität zu garantieren,
		     darf das Bild nur im HD-Format (1080 x 1920) sein.<br/>
			 Bitte nutzen Sie jpg,png oder gif!!!");
	} */ else {
       $endung = $mimetypen[$mime];
     }

     $neuername = basename($_FILES["datei"]["name"]);
     $neuername = preg_replace("/\.(jpe?g|gif|png)$/i", "", $neuername);  
     $neuername = preg_replace("/[^a-zA-Z0-9_-]/", "", $neuername);     
     $neuername .= ".$endung";
     $ziel = "bilder/$neuername";
     while (file_exists($ziel)) {
       $neuername = "kopie_$neuername";
       $ziel = "bilder/$neuername";
     }
      if (@move_uploaded_file($_FILES["datei"]["tmp_name"], $ziel)) {
        echo "Dateiupload hat geklappt";
		include "Show_Me.php";
     } else {
       echo "Dateiupload hat nicht geklappt";
	   include "Show_Me.php";
    }
  }
}
?>