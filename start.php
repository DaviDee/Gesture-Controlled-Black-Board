<!DOCTYPE html>
<html>
 <head>
  <title>Gesture-Controlled-Black-Board</title>
  <meta charset="UTF-8" />
<style type="text/css">
  .error { color: red; }
  </style>
  </head>
<body>
<?php
if (isset($_GET["hehe"]) && $_GET["hehe"] == "don`t make me laugh!!!") {
  echo "<p class='error'>Your login wasn`t successful!</p>";
}
?>
<form method="post" action="login.php">
Name: <br />
<input type="text" name="name" size="20" />
<br />
Password: <br />
<input type="password" name="password" size="20" /><br />
<input type="submit" value="Login" />
</form>
</body>
</html>
