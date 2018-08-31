<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	$arr=explode(".",$q);
	$stopNum=$arr[0];
	$trainNum=$arr[1];
	$sql="DELETE FROM route WHERE stopNum='$stopNum' AND trainNum='$trainNum'";
	$conn->query($sql);
	$sqlForUpdate="UPDATE route SET stopNum=stopNum-1 WHERE stopNum>'$stopNum' AND trainNum='$trainNum'";
	$conn->query($sqlForUpdate);
?>