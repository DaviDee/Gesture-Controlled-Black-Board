<?php
$bv = "pics";
$pp = "prepics";
$directory = opendir($bv);
$pics = array();
$pics2 = array();
$pics3 = array();
while (($file = readdir($directory)) !== false) {
  if (preg_match("/\.jpe?g$/", $file)) {
    $pics[] = $file;
  }
  elseif (preg_match("/\.png$/", $file)) {
    $pics2[] = $file;
  }
  elseif (preg_match("/\.gif$/", $file)) {
    $pics3[] = $file;
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
  imagejpeg($neuesbild, "$pp/$pic");
  imagedestroy($neuesbild);
}
foreach ($pics2 as $pic) {
  $b = imagecreatefrompng("$bv/$pic");
  $originalbreite = imagesx($b);
  $originalhoehe = imagesy($b);
  $neuebreite = 100;
  $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
  $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
  imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
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
  imagegif($neuesbild, "$pp/$pic");
  imagedestroy($neuesbild);
}
?>