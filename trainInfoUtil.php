<!DOCTYPE html>
<html>
	<head>
		<title>TRAININFO</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="header.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
<body>

	<header id="headerId">
			<h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
			<h3 id="headerTitle2">An online portal to reserve your seat</h3>
			<strong><h1 id="headerTitle4">OIRRS</h1></strong>
			<p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
		</header>
  
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<strong><p id="navbarHeader">Welcome Admin !</p></strong>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="adminpanel.php">Admin Panel</a></li>
					<li class="active"><a href="trainInfo.php">TrainInfo</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
			</div>
		</nav>
	<?php
		include("config.php");
		include("header.php");
		ini_set('max_execution_time', 300);
		//php variables
		
		//train info
		$trainName=$_POST["trainName"];
		$trainNum=$_POST["trainNum"];
		$source=$_POST["source"];
		$sourceName=$_POST["sourceName"];
		$dest=$_POST["dest"];
		$destName=$_POST["destName"];
		$trainType=$_POST["trainType"];
		$class=$_POST["class"];
		$coachNum=$_POST["coachNum"];
		
		echo "<div class='container'>Train Number : $trainNum<br>Train Name : $trainName<br>Train Type : $trainType<br>Source : $source<br>Destination : $dest<br></div>";
		
		function forTrainDateId($temp,$class,$coachNum,$trainNum,$stopNum){
			include("config.php");
			$stmtForTrainDate=$conn->prepare("INSERT INTO traindate VALUES(?,?,?)");
			$i=0;
			$j=0;
			while($i<2)
			{
				$x=strtotime("+$j day", strtotime($temp));
				$y=date("y-m-d", $x);
				$x=date("Y-m-d", $x);
				$trainDateID=$trainNum.$y;
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
			$i=-1;
			include("config.php");
			$stmt=$conn->prepare("INSERT INTO seatsavailinfo VALUES(?,?,?,?,?)");
			$stmtForWait=$conn->prepare("INSERT INTO trainwaitingseatinfo VALUES(?,?,?,?)");
			
			while($i<$stopNum){
				$j=0;
				$k=$i+2;
				foreach($class as $classCode){
					//SQL for Quotas of selected class
					$sql="SELECT quotaCode,seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
					if(!($result=$conn->query($sql)))
						echo "something went wrong ! can't execute query for sleeper class<br>";
					
					//inserting waiting info
					$num=35;
					$stmtForWait->bind_param("sisi",$trainDateID,$k,$classCode,$num);
					$stmtForWait->execute();
					
					//inserting seatsavailinfo
					while($row=$result->fetch_assoc()){
						$num=$row["seatsPerCoach"]*$coachNum[$j];
						$stmt->bind_param("isssi",$k,$trainDateID,$classCode,$row["quotaCode"],$num);
						$stmt->execute();
					}
					$j++;
				}
				$i++;
			}
		}
		
		$searchStmtForStation=$conn->prepare("SELECT stationCode FROM station WHERE stationCode=?");
		$insertStmtForStation=$conn->prepare("INSERT INTO station VALUES(?,?)");
		
		//inserting source station if doesn't exist
		$flagSource=false;
		$searchStmtForStation->bind_param("s",$source);
		$searchStmtForStation->execute();
		$result=$searchStmtForStation->get_result();
		
		if($result->num_rows==0){
			$insertStmtForStation->bind_param("ss",$source,$sourceName);
				if($insertStmtForStation->execute()){
					echo "Source added<br>";
					$flagSource=true;
				}
				else
					echo "error adding source<br>";
		}
		else
			$flagSource=true;
		
		if($flagSource){
			//inserting destination station if doesn't exist
			$flagDest=false;
			$searchStmtForStation->bind_param("s",$dest);
			$searchStmtForStation->execute();
			$result=$searchStmtForStation->get_result();
			
			if($result->num_rows==0){
				$insertStmtForStation->bind_param("ss",$dest,$destName);
					if($insertStmtForStation->execute()){
						echo "<br>Destination added<br>";
						$flagDest=true;
					}
					else
						echo "<br>error adding destination<br>";
			}
			else
				$flagDest=true;
			
			$searchStmtForStation->close();
			$insertStmtForStation->close();
			
			if($flagDest){	
				//inserting train information
				$queryForTrainInfo="insert into train values('$trainNum','$trainName','$trainType','$source','$dest')";
				$flagTrain=false;
				if(mysqli_query($conn,$queryForTrainInfo)){
					echo "<br>Traininfo added successfully<br>";
					$flagTrain=true;
				}
				else
					echo "<br>Failed adding traininfo<br>";
		
				
				if($flagTrain){
					//inserting train's class
					$stmtForClass=$conn->prepare("INSERT INTO trainClass VALUES(?,?,?)");
					if(!$stmtForClass)
						echo "error parsing Class <br>";
					//getting number ofcoaches
					$coachNum=array();
					foreach($_POST["coachNum"] as $t)
						if($t!="")
							array_push($coachNum,$t);
					$j=0;
					foreach($class as $n){
						$stmtForClass->bind_param("isi",$trainNum,$n,$coachNum[$j]);
						$stmtForClass->execute();
						$j++;
					}
					$stmtForClass->close();
					
					//inserting running day
					$stmtForDays=$conn->prepare("INSERT INTO runningday VALUES(?,?)");
					if(!$stmtForDays)
						echo "<br>error parsing Running day <br>";
					foreach($_POST["day"] as $selected){
						$stmtForDays->bind_param("is",$trainNum,$selected);
						echo "day $selected added<br>";
						$stmtForDays->execute();
					}
					$stmtForDays->close();
					
					
					
				    //Adding route
					$n=0;
					$stationCode=array();
					$arrTime=array();
					$depTime=array();
					$distance=array();
					foreach($_POST["stationCode"] as $a){
						array_push($stationCode,$a);
						echo $a." ";
						$n++;
					}
					foreach($_POST["arr"] as $c)
						array_push($arrTime,$c);
					foreach($_POST["depart"] as $d)
						array_push($depTime,$d);
					foreach($_POST["dist"] as $e)
						array_push($distance,$e);
			 
					$stmtForRoute=$conn->prepare("INSERT INTO route VALUES(?,?,?,?,?,?)");
					if(!$stmtForRoute)
						echo "<br>error parsing Route <br>";
					for($i=0; $i<$n; $i++){
						$j=$i+2;
						$k=$i+1;
						echo $i." ".$trainNum." ".$stationCode[$i]." ".$arrTime[$i]." ".$depTime[$i+1]." ".$distance[$i+1]."<br>";
						$stmtForRoute->bind_param("iisssi",$j,$trainNum,$stationCode[$i],$arrTime[$i],$depTime[$k],$distance[$k]);
						if($stmtForRoute->execute())
							  echo "executed".$i." ".$stationCode[$i];
					}
					
					$temp="";
					$j=1;$k=0;
					$stmtForRoute->bind_param("iisssi",$j,$trainNum,$source,$temp,$depTime[$k],$k);
					$stmtForRoute->execute();
					$j=$n+2;
					$stmtForRoute->bind_param("iisssi",$j,$trainNum,$dest,$arrTime[$n],$temp,$distance[$n]);
					$stmtForRoute->execute();
					$stmtForRoute->close();
					
					//adding and generating train-date		
					$date=date("Y-m-d");
					foreach($_POST["day"] as $selected){
						//getting train number
						$trainNum=$_POST["trainNum"];
						//getting class
						$class=$_POST["class"];
						//getting number ofcoaches
						$coachNum=array();
						foreach($_POST["coachNum"] as $t)
							if($t!="")
								array_push($coachNum,$t);
						//getting num of stations
						$n=0;
						foreach($_POST["stationCode"] as $a)
							$n++;
			
						while(true){
							$temp=strtotime($date);
							$dayname=date('l',$temp);
							if($dayname==$selected){
								forTrainDateID($date,$class,$coachNum,$trainNum,$n);
								$date=date("Y-m-d");
								break;
							}
							$date=strtotime("+1 day", strtotime($date));
							$date=date("Y-m-d", $date);
						}
					}
				}
			}
		}		
	
	?>
	<hr>
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>	
</body>
</html>