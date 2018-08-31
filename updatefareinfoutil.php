<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	$str = explode('.', $q);
	$sql="SELECT farePerKM FROM fareinfo WHERE trainType='$str[0]' AND classCode='$str[1]'";
	$result=$conn->query($sql);
	$farePerKM="";
	while($row=$result->fetch_assoc()){
		$farePerKM=$row["farePerKM"];					
	}
	$hint="<div class=\"form-group\">
				<label><strong>Enter Fare :</strong></label>
				<input type=\"text\" id=\"inputField\" class=\"form-control\" name=\"trainFare\" placeholder=\"$farePerKM\" required>
			</div>";

		
		echo $hint;
?>