<?php

	//get the q parameter from URL
	include("config.php");
	include("header.php");
	$q = $_REQUEST["q"];
	$arr=explode(".",$q);
	$pnrNum=$arr[0];
	$passengerNum=$arr[1];
	$coachNum=$arr[2];
	$seatNum=$arr[3];
	$classCode=$arr[4];
	$currentStatus=$arr[5];
	$trainNum=$arr[6];
	$journeyDate=$arr[7];
	$src=$arr[8];
	$dest=$arr[9];
	$quotaCode=$arr[10];
	$hint="";
	$hint.="Coach $coachNum Seat $seatNum";
	$srcNum=$destNum="";
	
	//sql to get src-dest stopNum
	$sqlGetSrcDest="SELECT a.stopNum srcNum,b.stopNum destNum FROM route a,route b 
					WHERE a.trainNum='$trainNum' AND a.stationCode='$src' AND b.trainNum='$trainNum'
					AND b.stationCode='$dest'";
	if(!($resulForGetSrcDest=$conn->query($sqlGetSrcDest)))
		$hint.="<br>ErrorGetting srcdst";
	
	while($rowForGetSrcDest=$resulForGetSrcDest->fetch_assoc()){
		$srcNum=$rowForGetSrcDest["srcNum"];
		$destNum=$rowForGetSrcDest["destNum"];
	}
	
	//Getting Max RAC value
	$sqlForMaxRAC="SELECT a.seatsPerCoach,b.numOfCoach FROM quotasinclass a,trainclass b 
					WHERE b.trainNum='$trainNum' AND b.classCode='$classCode' AND a.classCode='$classCode' AND a.quotaCode='RAC'";
	$result=$conn->query($sqlForMaxRAC);
	$seatStatus="RAC/";
	while($row=$result->fetch_assoc())
		$seatStatus.=$row["seatsPerCoach"]*$row["numOfCoach"];
	
	//cancel the booking of selected passenger
	$sql="UPDATE passengerinfo SET currentStatus=\"Cancelled\" WHERE pnrNum='$pnrNum' AND passengerNum='$passengerNum'";
	$conn->query($sql);
	$flagRAC=false;
	$rCoachNum=$rSeatNum="";
	
	//if current status was CNF
	if($currentStatus=="CNF"){
		if($classCode!="1A"){
			//SQL to get all RAC users of same class, train number and date
			$sqlForRAC="SELECT a.passengerNum,a.pnrNum,a.currentStatus,c.stopNum srcStop,d.stopNum dstStop
					FROM passengerinfo a,ticket b,route c,route d
					WHERE b.trainNum=c.trainNum AND b.src=c.stationCode AND b.trainNum=d.trainNum
					AND b.upto=d.stationCode AND a.pnrNum=b.pnrNum 
					AND b.trainNum='$trainNum' AND b.journeyDate='$journeyDate'
					AND b.class='$classCode' AND currentStatus LIKE 'RAC%' ORDER BY currentStatus ASC";
			$resultForRAC=$conn->query($sqlForRAC);
			$flag=false;
		
			//updating RAC of other users if existed
			if($resultForRAC->num_rows>0){
				$flagRAC=true;
				while($row=$resultForRAC->fetch_assoc()){
					if(($row["srcStop"]==$srcNum)&&($row["dstStop"]==$destNum)){
						//Getting passenger number and PNR number details
						$pNum=$row["passengerNum"];
						$pnr=$row["pnrNum"];
					
						//Upgrading RACs
						if($flag){
							$temp=explode("/",$row["currentStatus"]);
							$temp[1]--;
							$str=$temp[0]."/".$temp[1];
							$sqlForRACUpgrade="UPDATE passengerinfo SET currentStatus='$str' WHERE passengerNum='$pNum' AND pnrNum='$pnr'";
							$conn->query($sqlForRACUpgrade);
						}
						else{
							//Getting seat-coach info of selected RAC
							$sqlToGetSeatCoach="SELECT coachNum,seatNum FROM passengerinfo WHERE passengerNum='$pNum' AND pnrNum='$pnr'";
							$resultToGetSeatCoach=$conn->query($sqlToGetSeatCoach);
							while($row=$resultToGetSeatCoach->fetch_assoc()){
								$rCoachNum=$row["coachNum"];
								$rSeatNum=$row["seatNum"];
							}
							$sqlForUpgradation="UPDATE passengerinfo SET coachNum='$coachNum',seatNum='$seatNum',currentStatus=\"CNF\" 
								WHERE passengerNum='$pNum' AND pnrNum='$pnr'";
							$conn->query($sqlForUpgradation);
							$coachNum=$rCoachNum;
							$seatNum=$rSeatNum;
							$flag=true;
						}
					}
				}
			}
			else{
				$sqlToUpdateSeats="UPDATE seatsavailinfo SET numOfSeats=1+numOfSeats WHERE stopNum>='$srcNum'
									AND stopNum<='$destNum' AND classCode='$classCode' AND quotaCode='$quotaCode'
									AND train_ID IN (SELECT train_ID FROM traindate WHERE trainNum='$trainNum' AND date='$journeyDate')";
				if($conn->query($sqlToUpdateSeats));
					//$hint.="fhgfhf";
			}
		}
			
		if($flagRAC||$classCode=='1A'){
			//SQL to get Waiting details of passengers of same class,train and date
			$sqlForWL="SELECT a.passengerNum,a.pnrNum,a.currentStatus,c.stopNum srcStop,d.stopNum dstStop
				FROM passengerinfo a,ticket b,route c,route d
				WHERE b.trainNum=c.trainNum AND b.src=c.stationCode AND b.trainNum=d.trainNum
				AND b.upto=d.stationCode AND a.pnrNum=b.pnrNum 
				AND b.trainNum='$trainNum' AND b.journeyDate='$journeyDate'
				AND b.class='$classCode' AND currentStatus LIKE 'WL%' ORDER BY currentStatus ASC";
				$resultForWL=$conn->query($sqlForWL);
				$flag=false;
			
				//updating WL of other users if existed
				if($resultForWL->num_rows>0){
					$flag=false;
					while($row=$resultForWL->fetch_assoc()){
						if(($destNum==$row["dstStop"])&&($srcNum==$row["srcStop"])){
							//Getting passenger number and PNR number details
							$pNum=$row["passengerNum"];
							$pnr=$row["pnrNum"];
					
							//Upgrading WLs
							if($flag){
								$temp=explode("/",$row["currentStatus"]);
								$temp[1]--;
								$str=$temp[0]."/".$temp[1];
								$sqlForWLUpgrade="UPDATE passengerinfo SET currentStatus='$str' WHERE passengerNum='$pNum' AND pnrNum='$pnr'";
								$conn->query($sqlForWLUpgrade);
							}
							else{
								if($classCode=="1A")
									$seatStatus="CNF";
								$sqlForUpgradation="UPDATE passengerinfo SET coachNum='$coachNum',seatNum='$seatNum',currentStatus=\"$seatStatus\" 
								WHERE passengerNum='$pNum' AND pnrNum='$pnr'";
								$conn->query($sqlForUpgradation);
								$flag=true;
							}
						}
					}
					
					$sqlToUpdateSeats="UPDATE trainwaitingseatinfo SET waiting=waiting+1
										WHERE stopNum>=$srcNum AND stopNum<=$destNum AND classCode='$classCode' AND train_ID 
										IN (SELECT train_ID FROM traindate WHERE trainNum='$trainNum' AND date='$journeyDate')";
					$conn->query($sqlToUpdateSeats);
				}
				else{
					$quotaCode="RAC";
					if($classCode=="1A")
						$quotaCode="GN";
					$sqlToUpdateSeats="UPDATE seatsavailinfo SET numOfSeats=1+numOfSeats WHERE stopNum>=srcNum
									AND stopNum<=destNum AND classCode='$classCode' AND quotaCode='$quotaCode'
									AND train_ID IN (SELECT train_ID FROM traindate WHERE trainNum='$trainNum' AND date='$journeyDate')";
					$conn->query($sqlToUpdateSeats);
				}
		}
	}
	
	//Updating ticket status
	$countCancel=0;
	$countBooked=0;
	$sql="SELECT currentStatus FROM passengerinfo WHERE pnrNum='$pnrNum'";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		if($row["currentStatus"]=="Cancelled")
			$countCancel++;
		else
			$countBooked++;
	}
	$ticketstatus="";
	if($countCancel>0&&$countBooked==0)
		$ticketstatus="Cancelled";
	else
		$ticketstatus="Partial Cancelled";
	
	$conn->query("UPDATE ticket SET ticketstatus='$ticketstatus' WHERE pnrNum='$pnrNum'");
	echo "<p id=\"title\">Hello user ! your ticket has been cancelled successfully.<br>Press ctrl+R or do refresh to check Current Status.</p>";
?>