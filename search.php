<?php
header("Content-Type: application/json; charset=UTF-8");

include('config.php');

if(isset($_GET["term"]))
{
$searchterm=$_GET["term"];
 $query=$con->query("select stationCode,stationName from station where stationName like '%".$searchterm."%' or stationCode like '%".$searchterm."%'");
 
 while ($row=$query->fetch_assoc()) 
 {
    $data[]=$row['stationName'].'-'.$row['stationCode'];
 }
 echo json_encode($data);
}
else 
{
 echo "No Suggestion";
}
 ?>