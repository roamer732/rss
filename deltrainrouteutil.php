<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	$sql="SELECT * FROM route WHERE trainNum='$q'";
	$result=$conn->query($sql);
	$hint ="<hr><h2>Route :</h2><br><table class=\"table table-striped table-hover\" id=\"tableID\">
			<thead>
				<tr>
					<th>Stop num</th>
					<th>StationCode</th>
					<th>arrival</th>
					<th>departure</th>
					<th>distance</th>
					<th> - </th>
				</tr>
			</thead>";

	while($row=$result->fetch_assoc()){
		$stopNum=$row["stopNum"];
		$trainNum=$row["trainNum"];
		$stationCode=$row['stationCode'];
		if($row["arrival"]!="")
			$arrival=$row['arrival'];
		else
			$arrival="-";
		if($row["departure"]!="")
			$departure=$row['departure'];
		else
			$departure="-";
		$distance=$row['distance'];
		$hint=$hint."<tr>
			<td>$stopNum</td>
			<td>$stationCode</td>
			<td>$arrival</td>
			<td>$departure</td>
			<td>$distance</td>
			<td><button type=\"submit\" class=\"btn btn-primary\" id=\"$stopNum\" onclick=\"delTrain(this.id)\">delete</button></td>
		</tr>";
}

$hint.="</table>";

if($q=="")
	$hint="";

echo $hint;
?>