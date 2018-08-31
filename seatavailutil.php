<!DOCTYPE html>
<html>
	<head>
	</head>
<body>
	<?php
		include("config.php");
		include("header.php");
		
		echo $_GET["trainNum"];
		//adding and generating train-date		
		$date=date("Y-m-d");
		foreach($_GET["day"] as $selected){
			//getting train number
			$trainNum=$_GET["trainNum"];
			//getting class
			$class=$_GET["class"];
			//getting number ofcoaches
			$coachNum=array();
			foreach($_GET["coachNum"] as $t)
			if($t!="")
				array_push($coachNum,$t);
			
			while(true){
				$temp=strtotime($date);
				$dayname=date('l',$temp);
				if($dayname==$selected){
					forTrainDateID($date,$class,$coachNum,$trainNum,$n);
					break;
				}
				$date=strtotime("+1 day", strtotime($date));
				$date=date("Y-m-d", $date);
			}
		}
		
		function forTrainDateId($temp,$class,$coachNum,$trainNum,$stopNum){
			include("config.php");
			$stmtForTrainDate=$conn->prepare("INSERT INTO traindate VALUES(?,?,?)");
			$i=0;
			$j=0;
			while($i<2)
			{
				$x=strtotime("+$j day", strtotime($temp));
				$x=date("y-m-d", $x);
				$trainDateID=$trainNum.$x;
				$stmtForTrainDate->bind_param("sss",$trainDateID,$trainNum,$x);
				$stmtForTrainDate->execute();
				forClassQuotaId($trainDateID,$class,$coachNum,$stopNum);
				$i++;
				$j+=7;
			}
			$stmtForTrainDate->close();
			echo "train date information added successfully ! <br>";
		}
		
		function forClassQuotaId($trainDateID,$class,$coachNum,$stopNum){
			$j=0;
			foreach($class as $classCode){
				switch($classCode){
					case "SL":
						forSleeper($trainDateID,$classCode,$coachNum[$j],$stopNum);
						break;
							
					case "3A":
						for3A($trainDateID,$classCode,$coachNum[$j],$stopNum);
						break;
								
					case "2A":
						for2A($trainDateID,$classCode,$coachNum[$j],$stopNum);
						break;
								
					case "1A":
						for1A($trainDateID,$classCode,$coachNum[$j],$stopNum);
						break;
				}
				$j++;
			}
		}
		
		function forSleeper($trainDateID,$classCode,$coachNum,$stopNum){
			include("config.php");
			$sql="SELECT seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
			$stmtForSL=$conn->prepare("INSERT INTO sleeper VALUES(?,?,?,?,?,?,?)");
			if(!($result=$conn->query($sql)))
				echo "something went wrong ! can't execute query for sleeper class<br>";
			$tmp=array();
			while($row=$result->fetch_assoc())
				array_push($tmp,($row["seatsPerCoach"]*$coachNum));
			
			$i=1;
			while($i<$stopNum+2){
				$stmtForSL->bind_param("siiiiii",$trainDateID,$i,$tmp[0],$tmp[1],$tmp[2],$tmp[3],$tmp[4]);
				$stmtForSL->execute();
				$i++;
			}
			$stmtForSL->close();
			echo "executed for sleeper<br>";
		}
		
		function for3A($trainDateID,$classCode,$coachNum,$stopNum){
			include("config.php");
			$sql="SELECT seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
			$stmtFor3A=$conn->prepare("INSERT INTO ac3tier VALUES(?,?,?,?,?)");
			if(!($result=$conn->query($sql)))
				echo "something went wrong ! can't execute query for sleeper class<br>";
			$tmp=array();
			while($row=$result->fetch_assoc())
				array_push($tmp,($row["seatsPerCoach"]*$coachNum));
			
			$i=1;
			while($i<$stopNum){
				$stmtFor3A->bind_param("siiii",$trainDateID,$i,$tmp[0],$tmp[1],$tmp[2]);
				$stmtFor3A->execute();
				$i++;
			}
			$stmtFor3A->close();
			echo "executed for 3A class<br>";
		}
		
		function for2A($trainDateID,$classCode,$coachNum,$stopNum){
			include("config.php");
			$sql="SELECT seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
			$stmtFor2A=$conn->prepare("INSERT INTO ac2tier VALUES(?,?,?,?,?)");
			if(!($result=$conn->query($sql)))
				echo "something went wrong ! can't execute query for sleeper class<br>";
			$tmp=array();
			while($row=$result->fetch_assoc())
				array_push($tmp,($row["seatsPerCoach"]*$coachNum));
			
			$i=1;
			while($i<$stopNum){
				$stmtFor2A->bind_param("siiii",$trainDateID,$i,$tmp[0],$tmp[1],$tmp[2]);
				$stmtFor2A->execute();
				$i++;
			}
			$stmtFor2A->close();
			echo "executed for 2 tier<br>";
		}
		
		function for1A($trainDateID,$classCode,$coachNum,$stopNum){
			include("config.php");
			$sql="SELECT seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
			$stmtFor1A=$conn->prepare("INSERT INTO firstclassac VALUES(?,?,?)");
			if(!($result=$conn->query($sql)))
				echo "something went wrong ! can't execute query for sleeper class<br>";
			$tmp=array();
			while($row=$result->fetch_assoc())
				array_push($tmp,($row["seatsPerCoach"]*$coachNum));
			
			$i=1;
			while($i<$stopNum){
				$stmtFor1A->bind_param("sii",$trainDateID,$i,$tmp[0]);
				$stmtFor1A->execute();
				$i++;
			}
			$stmtFor1A->close();
			echo "executed for firstclassac<br>";
		}
	?>
</body>
</html>