<?php

	// get the q parameter from URL
	include("config.php");
	$q = $_REQUEST["q"];
	$hint="";
	if($q!=""){
					$hint ="<hr><div id=\"id1\"><p id=\"id1Title\">Update :</p></div>
							<div id=\"trainInfoID\" >
						<div class=\"form-group\">
							<label><strong>Train Number :</strong></label>
								<input type=\"number\" class=\"form-control\" name=\"trainNum\" value=\"$q\" disabled>
						</div>
						<div class=\"form-group\">
						<label><strong>Select Train Class :</strong></label>";

						$temp="<select type=\"text\" class=\"form-control\" name=\"classCode\" oninput=\"displayClassInputField()\">
								<option value=\"-\">-</option>";
		
						$sql="SELECT classCode,numOfCoach FROM trainclass WHERE trainNum=$q";
						$result=$conn->query($sql);
						while($row=$result->fetch_assoc()){
							$classCode=$row["classCode"];
							$numOfCoach=$row["numOfCoach"];
							$temp.="<option value=\"$classCode\" >$classCode</option>";
						}
						
						$intemp="<div id=\"hideInputField\">
										<label><strong>Enter Number of Coach : </strong></label>
										<input type=\"number\" class=\"form-control\" placeholder=\"Entre number of Coach\" name=\"numOfCoach\">
									</div>";
		$temp.="</select></div>";
		$hint.=$temp;
		$hint.=$intemp;
	}

		echo $hint;
?>