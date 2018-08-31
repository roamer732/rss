<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	
	$sql="SELECT a.classCode,b.className FROM trainclass a,class b WHERE a.classCode=b.classCode AND a.trainNum='$q'";
	$result=$conn->query($sql);
	$hint="<div class=\"form-group\">
				<label><strong>Select Class :</strong></label>
				<select type=\"text\" class=\"form-control\" name=\"classCode\">";
	while($row=$result->fetch_assoc()){
		$classCode=$row["classCode"];
		$className=$row["className"];
		$hint.="<option value=\"$classCode\">$className</option>";	
	}
	$hint.="</select></div>";
	
	if($q=="")
		$hint="";
	echo $hint;
?>