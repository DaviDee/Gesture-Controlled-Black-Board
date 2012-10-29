<!DOCTYPE html>
<html>
 <head>
  <title>Gesture-Controlled-Black-Board</title>
  <meta charset="UTF-8" />
  <style type="text/css">
  a img { border: 0; }
  #pics { border: 1px solid gray; width: 850px; overflow: hidden; background-color: #ccc; padding-bottom: 15px;}
  #pics img { float: left; padding: 3px;  border: 1px solid; border-color: black black gray gray; margin: 15px; background-color: white;}
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
<?php include "upl.php"; ?>
<div id="pics">
<?php
$bv = "pics";
$directory = opendir($bv);
$pics = array();
while (($datei = readdir($directory)) !== false) {
  if (preg_match("/\.jpe?g$/", $datei)) {
    $pics[] = $datei;
  }
  //für png und gifs
  elseif(preg_match("/\.png$/", $datei)) {
    $pics[] = $datei;
  }
  elseif(preg_match("/\.gif$/", $datei)) {
    $pics[] = $datei;
  }
}
closedir($directory);
foreach($pics as $pic) {
  echo "<a href='pics/$pic'><img src='prepics/$pic' alt='' /></a>";
  //echo "<a class='links' href='pics/$pic'>Link</a>";
  echo "<form class=\"del\" action=\"del.php\" method=\"post\" >";
     echo "<input type=hidden name=\"pic\" value=\"$pic\" />";
     echo "<input type=\"submit\" value=\"X\" />";
  echo "</form>";
}
?>
</div>
</body>
</html>