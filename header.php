<?php
  session_start();
  if(empty($_SESSION["username"]))
	header("LOCATION:index.php");
?>