<?php
$bv = "pics";
$pp = "prepics";
$directory = opendir($bv);
$pics = array();
$pics2 = array();
$pics3 = array();
while (($datei = readdir($directory)) !== false) {
  if (preg_match("/\.jpe?g$/", $datei)) {
    $pics[] = $datei;
  }
  //für png und gifs
  elseif (preg_match("/\.png$/", $datei)) {
    $pics2[] = $datei;
  }
  elseif (preg_match("/\.gif$/", $datei)) {
    $pics3[] = $datei;
  }
}
closedir($directory);
foreach ($pics as $pic) {
  $b = imagecreatefromjpeg("$bv/$pic");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $bild<br />";
  imagejpeg($neuesbild, "$pp/$pic");
  imagedestroy($neuesbild);
}
//für png und gifs
foreach ($pics2 as $pic) {
  $b = imagecreatefrompng("$bv/$pic");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $pic<br />";
  imagepng($neuesbild, "$pp/$pic");
  imagedestroy($neuesbild);
}
foreach ($pics3 as $pic) {
  $b = imagecreatefromgif("$bv/$pic");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $pic<br />";
  imagegif($neuesbild, "$pp/$pic");
  imagedestroy($neuesbild);
}
?>