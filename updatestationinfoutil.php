<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	
	$sql="SELECT * FROM station WHERE stationCode='$q'";
	$result=$conn->query($sql);
	$hint="";
	while($row=$result->fetch_assoc()){
		$stationCode=$row["stationCode"];
		$stationName=$row["stationName"];
		$hint="<div class=\"form-group\">
				<label><strong>Enter Station Code :</strong></label>
				<input type=\"text\" id=\"inputField\" class=\"form-control\" name=\"stationCode\" value=\"$stationCode\" onkeydown=\"upperCase(this)\" required>
			</div>
			<div class=\"form-group\">
				<label><strong>Enter Station Name :</strong></label>
				<input type=\"text\" id=\"inputField\" class=\"form-control\" name=\"stationName\" value=\"$stationName\" onkeydown=\"upperCase(this)\" required>
			</div>";	
	}
		
	echo $hint;
?>