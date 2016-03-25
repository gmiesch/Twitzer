<?php
  session_start();
  $servername = "localhost";
  $username = "unknownproject";
  $password = "hack3r1sbad";
  $database = "unknownproject";
  $link = mysql_connect($servername, $username, $password);
  mysql_select_db($database);
  mysql_query("use ". $database);
  echo $_SESSION['id'];
  $result = mysql_query("DELETE FROM sessions WHERE id=" . $_SESSION['id']);
  session_unset();
  header('Location: ../index.php');
  exit;
?>
