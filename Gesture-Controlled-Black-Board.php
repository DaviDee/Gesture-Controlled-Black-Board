<!DOCTYPE html>
<html>
 <head>
  <title>Gesture-Controlled-Black-Board</title>
  <meta charset="UTF-8" />
  <style type="text/css">
  a img { border: 0; }
  #bilder { border: 1px solid gray; width: 850px; overflow: hidden; background-color: #ccc; padding-bottom: 15px;}
  #bilder img { float: left; padding: 3px;  border: 1px solid; border-color: black black gray gray; margin: 15px; background-color: white;}
  .del { float: left; padding: 0px;  border: 0px solid; border-color: black black gray gray; margin: 15px;}
  </style>
</head>
<body>
<h1>Gesture-Controlled-Black-Board</h1>
<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
Datei: <br />
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input type="file" name="datei" /><br />
<input type="submit" value="Hochladen" />
</form>
<?php include "upload.php"; ?>
<div id="bilder">
<?php
$bv = "bilder";
$verzeichnis = opendir($bv);
$bilder = array();
while (($datei = readdir($verzeichnis)) !== false) {
  if (preg_match("/\.jpe?g$/", $datei)) {
    $bilder[] = $datei;
  }
  //für png und gifs
  elseif(preg_match("/\.png$/", $datei)) {
    $bilder[] = $datei;
  }
  elseif(preg_match("/\.gif$/", $datei)) {
    $bilder[] = $datei;
  }
}
closedir($verzeichnis);
foreach($bilder as $bild) {
  echo "<a href='bilder/$bild'><img src='vorschaubilder/$bild' alt='' /></a>";
  //echo "<a class='links' href='bilder/$bild'>Link</a>";
  echo "<form class=\"del\" action=\"delete.php\" method=\"post\" >";
     echo "<input type=hidden name=\"bild\" value=\"$bild\" />";
     echo "<input type=\"submit\" value=\"X\" />";
  echo "</form>";
}
?>
</div>
</body>
</html>