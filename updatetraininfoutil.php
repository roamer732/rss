<?php

// get the q parameter from URL
include("config.php");
$q = $_REQUEST["q"];

					$hint ="<hr><div id=\"id1\"><p id=\"id1Title\">Update :</p></div>
							<div id=\"trainInfoID\" ><div class=\"form-group\">
							<label><strong>Train Number :</strong></label>
								<input type=\"number\" class=\"form-control\" name=\"trainNum\" value=\"$q\" disabled>
								<span class=\"error\" id=\"error1\"><?php echo \"*\".\$trainNumErr;?></span>
						</div>";

						$temp="<select type=\"text\" class=\"form-control\" name=\"trainType\">";
						$sqlfortype="SELECT * FROM traintype";
						$resultfortype=$conn->query($sqlfortype);
						while($row=$resultfortype->fetch_assoc()){
							$trainType=$row["type"];
								$temp.="<option value=\"$trainType\">$trainType</option>";
						}
						$temp.="</select>";

$sql="SELECT * FROM train WHERE trainNum='$q'";
$result=$conn->query($sql);						
while($row=$result->fetch_assoc()){
	$trainName=$row["trainName"];
	$type=$row["type"];
	$source=$row['source'];
	$dest=$row['Destination'];
				$hint.="<div class=\"form-group\">
							<label><strong>Train Name :</strong></label>
								<input type=\"text\" class=\"form-control\" name=\"trainName\" value=\"$trainName\" onkeydown=\"upperCase(this)\">
								<span class=\"error\" id=\"error2\"><?php echo \"*\".\$trainNameErr;?></span>
						</div>
						
						<div class=\"form-group\">
							<label><strong>Train Type :</strong></label>";
					$hint.=$temp;
					$hint.="<span class=\"error\" id=\"error3\"><?php echo \"*\".\$trainTypeErr;?></span>
						</div>
						<div class=\"form-group\">
							<label><strong>Source Station :</strong></label>
								<input type=\"text\" class=\"form-control\" name=\"source\" value=\"$source\" onkeydown=\"upperCase(this)\">
								<span class=\"error\" id=\"error4\"><?php echo \"*\".\$sourceErr;?></span>
						</div>
						<div class=\"form-group\">
							<label><strong>Destination Station :</strong></label>
								<input type=\"text\" class=\"form-control\" name=\"destination\" value=\"$dest\" onkeydown=\"upperCase(this)\">
								<span class=\"error\" id=\"error5\"><?php echo \"*\".\$destErr;?></span>
						</div></div>";
}

		if($q=="")
			$hint="";

		echo $hint;
?>