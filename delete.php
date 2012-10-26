<?php
$bild = htmlspecialchars($_POST["bild"]);
unlink (htmlspecialchars("bilder/$bild"));
echo "<meta http-equiv=\"refresh\" content=\"0; URL=Gesture-Controlled-Black-Board\">";
?>