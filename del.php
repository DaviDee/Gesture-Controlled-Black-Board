<?php
$pic = htmlspecialchars($_POST["pic"]);
unlink (htmlspecialchars("pics/$pic"));
echo "<meta http-equiv=\"refresh\" content=\"0; URL=Gesture-Controlled-Black-Board.php\">";
?>