<?php
$bv = "bilder";
$vb = "vorschaubilder";
$verzeichnis = opendir($bv);
$bilder = array();
//für png und gifs
$bilder2 = array();
$bilder3 = array();
while (($datei = readdir($verzeichnis)) !== false) {
  if (preg_match("/\.jpe?g$/", $datei)) {
    $bilder[] = $datei;
  }
  //für png und gifs
  elseif (preg_match("/\.png$/", $datei)) {
    $bilder2[] = $datei;
  }
  elseif (preg_match("/\.gif$/", $datei)) {
    $bilder3[] = $datei;
  }
}
closedir($verzeichnis);
foreach ($bilder as $bild) {
  $b = imagecreatefromjpeg("$bv/$bild");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $bild<br />";
  imagejpeg($neuesbild, "$vb/$bild");
  imagedestroy($neuesbild);
}
//für png und gifs
foreach ($bilder2 as $bild) {
  $b = imagecreatefrompng("$bv/$bild");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $bild<br />";
  imagepng($neuesbild, "$vb/$bild");
  imagedestroy($neuesbild);
}
foreach ($bilder3 as $bild) {
  $b = imagecreatefromgif("$bv/$bild");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
  // echo "Thumbnail erzeugt für $bild<br />";
  imagegif($neuesbild, "$vb/$bild");
  imagedestroy($neuesbild);
}
?>