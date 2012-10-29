<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();
$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
$direction = "index.php";
header("Location: http://$host$uri/$direction");
?>
