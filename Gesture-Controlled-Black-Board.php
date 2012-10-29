<?php
session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
?>
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
File: <br />
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input type="file" name="file" /><br />
<input type="submit" value="Upload" />
</form>
<?php include "upl.php"; ?>
<div id="pics">
<?php
$bv = "pics";
$directory = opendir($bv);
$pics = array();
while (($file = readdir($directory)) !== false) {
  if (preg_match("/\.jpe?g$/", $file)) {
    $pics[] = $file;
  }
  elseif(preg_match("/\.png$/", $file)) {
    $pics[] = $file;
  }
  elseif(preg_match("/\.gif$/", $file)) {
    $pics[] = $file;
  }
}
closedir($directory);
foreach($pics as $pic) {
  echo "<a href='pics/$pic'><img src='prepics/$pic' alt='' /></a>";
  echo "<form class=\"del\" action=\"del.php\" method=\"post\" >";
     echo "<input type=hidden name=\"pic\" value=\"$pic\" />";
     echo "<input type=\"submit\" value=\"X\" />";
  echo "</form>";
}
?>
</div>
<p><a href="logout.php">Logout</p>
</body>
</html>
<?php
} else {
  $host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
  $uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
  $direction = "start.php";
  header("Location: http://$host$uri/$direction");
}
?>