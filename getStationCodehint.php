<?php
	include("config.php");
	$sql="SELECT * FROM station";
	$result=$conn->query($sql);
	
	$q = $_REQUEST["q"];
	$p=$_REQUEST["p"];
	$hint="";

	if($q!==""&&($result->num_rows>0)){
		$q = strtolower($q);
		$len=strlen($q);
		
		while($row=$result->fetch_assoc()){
			if($row["stationCode"]){
				if (stristr($q, substr($row["stationCode"], 0, $len))) {
					if ($hint===""){
						$hint=$row["stationCode"];
						$name=$row["stationName"];
						$hint="<div class=\"statCodeResult\" id=\"$p.$name.$hint\" onclick=\"selectStat(this.id)\">$hint</div>";
					}
					else{   
						$temp=$row["stationCode"];
						$name=$row["stationName"];
						$hint.="<div class=\"statCodeResult\" id=\"$p.$name.$temp\" onclick=\"selectStat(this.id)\">$temp</div>";
					}
			}
			}
		}
	}
	
	echo $hint === "" ? "no suggestion" : $hint;
?>