<?php
header("Content-type:application/json;charset=UTF-8");
include("config.php");

if(isset($_GET["term"])){
	$searchterm=$_GET["term"];
	$query=$conn->query("SELECT stationCode from station where stationCode like '%".$searchterm."%'");
	
	while($row=$query->fetch_assoc())
		$data[]=$row['stationCode'];
		
	echo json_encode($data);
}
else
	echo "no suggestion";
?>