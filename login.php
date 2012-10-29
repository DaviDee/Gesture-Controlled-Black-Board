<?php
session_start();
$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri  = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");

if (isset($_POST["name"]) 
    && $_POST["name"] == "Testy"
    && md5(sha1($_POST["password"])) == "0923968cd79a6e529e31beb129800aa0") {
   $_SESSION["name"] = "Gerrit";
   $_SESSION["login"] = "ok";
   $direction = "Gesture-Controlled-Black-Board.php";
 } else {
   $direction = "start.php?hehe=don`t make me laugh!!!";
 }
 header("Location: http://$host$uri/$direction");
 ?>
