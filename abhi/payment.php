<!DOCTYPE html>
<html>
	<head>
		<title>Add class</title>
		<?php
			include("header.php");
			include("config.php");
			$username=$_SESSION['username'];
			$arr=$_SESSION['arr'];
			$passengerName=$_SESSION['passenger'];
			$age=$_SESSION['age'];
			$gender= $_SESSION['gender'];
			$boarding=$_SESSION['boarding'];
			$trainNum=$arr[0];
			$class=$arr[1];
			$quota=$arr[2];
			$src=$arr[3];
			$dest=$arr[4];
			$minSeat=$arr[5];
			$status=$arr[6];
			$journeyDate=$arr[7];
			$minSeatStop=$arr[9];
			$fare=$_SESSION['tfare'];
			$numOfPassenger=$_SESSION['passengerCount'];
			$boardingCode=substr($boarding,stripos($boarding,"-")+1);

			$trainName=mysqli_fetch_assoc(mysqli_query($conn,"select trainName from train where trainNum='$trainNum' "))['trainName'];
			$className=mysqli_fetch_assoc(mysqli_query($conn,"select className from class where classCode='$class' "))['className'];
			$sd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stationCode='$boardingCode' and trainNum='$trainNum'"))['distance'];
			$dd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stationCode='$dest' and trainNum='$trainNum'"))['distance'];
			$departure=mysqli_fetch_assoc(mysqli_query($conn,"select departure from route where trainNum='$trainNum' and stationCode='$src'"))['departure'];
			$arrival=mysqli_fetch_assoc(mysqli_query($conn,"select arrival from route where trainNum='$trainNum' and stationCode='$dest'"))['arrival'];
			$sourceStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$src'"))['stopNum'];
			$destStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$dest'"))['stopNum'];

			if(isset($_POST['submitButton'])){
				$transactionLength = 10;   
				$found = false;  
				// Define possible characters.  
				$possible_chars = "23456789BCDFGHJKMNPQRSTVWXYZ";  

				while (!$found) {  
					$transactionNum= "";     
					$i = 0;       
					while ($i < $transactionLength){    
						$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);    // Pick a random character from the $possible_chars list  
						$transactionNum .= $char;  
						$i++;  
					}  
					$query = "SELECT transactionNum FROM payment WHERE transactionNum='".$transactionNum."' ";  
					$result = mysqli_query($conn,$query) ;
					if (mysqli_num_rows($result)==0)     
						$found = true; // We've found a unique number. Lets set the $unique_ref_found   
				}
 
				//for PNR generation
				$pnrLength = 10;   
				$unique_ref_found = false;  
				$possible_chars = "0123456789";  

				while (!$unique_ref_found) {  
					$pnr = "";     
					$i = 0;       
					while ($i < $pnrLength){    
						$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);    
						$pnr.=$char;  
						$i++;  
					}  
					
					$query = "SELECT pnrNum FROM ticket WHERE pnrNum='".$pnr."' ";  
					$result = mysqli_query($conn,$query) ;
					if (mysqli_num_rows($result)==0)     
						$unique_ref_found = true;      // We've found a unique number. Lets set the $unique_ref_found  
				} 

				$ticketStatus="Booked";

				$seatsPerCoach=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(seatsPerCoach) seatsPerCoach FROM quotasinclass WHERE classCode='$class'"))['seatsPerCoach'];
				$numOfCoach=mysqli_fetch_assoc(mysqli_query($conn,"SELECT numOfCoach FROM trainclass WHERE trainNum='$trainNum' and classCode='$class'"))['numOfCoach'];

				$totalSeats=$seatsPerCoach*$numOfCoach;
				
				
				$id=mysqli_fetch_assoc(mysqli_query($conn,"Select train_ID from traindate WHERE trainNum='$trainNum' and date='$journeyDate'"))['train_ID'];
				 $availableSeats=mysqli_fetch_assoc(mysqli_query($conn,"Select sum(numOfSeats) availableSeats from seatsavailinfo WHERE train_ID='$id' 
  	                                    and classCode='$class' and stopNum='$minSeatStop'"))['availableSeats'];
				
				$j=$numOfPassenger;
				$coachNum=array();
				$seatNum=array();
				$quotaResult=array();
				$bookingStatus=array();
				
				if($status=='Available'){
					$i=0; 
					while($minSeat>0&&$numOfPassenger>0){	
					array_push($coachNum,floor(($totalSeats-$availableSeats)/$seatsPerCoach)+1);
					array_push($seatNum,($totalSeats-$availableSeats)%$seatsPerCoach+1);
					array_push($bookingStatus,"CNF");
					
					$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
					$i++;
					mysqli_query($conn,"update seatsavailinfo set numOfSeats=(numOfSeats-1) where train_ID='$id' and classCode='$class' 
			                and quotaCode='$quota' and stopNum>='$sourceStop' and stopNum<='$destStop' ");
					$availableSeats--;
					$minSeat--;
					$numOfPassenger--;
					}
					
					if($minSeat==0&&$numOfPassenger!=0&&$class!='1A')
						$status='RAC';
					else
						$status='waiting';

					if($status=='RAC'){
						while($numOfPassenger>0){
							$racCoachNum=floor(($totalSeats-$availableSeats)/$seatsPerCoach)+1;
							$racSeatNum=(($totalSeats-$availableSeats)%$seatsPerCoach)+1;

							//to check partial filled or not
							 $sqlForPnr="SELECT a.pnrNum FROM ticket a,passengerinfo b 
													WHERE a.pnrNum=b.pnrNum AND a.class='$class' AND a.quota='$quota' 
														AND b.coachNum='$racCoachNum' 
														AND b.seatNum='$racSeatNum' AND a.trainNum='$trainNum' 
															AND a.journey_date='$journeyDate'";
							$resultForPnr=$conn->query($sqlForPnr);
							$check=false;
							
							while($rowForPnr=$resultForPnr->fetch_assoc()){
								//Checking seat result
								$resultPnr=$rowForPnr["pnrNum"];
								
								$sqlForSrcDest="SELECT src,upto FROM ticket WHERE pnrNum='$resultPnr'";
								$resultForSrcDest=$conn->query($sqlForSrcDest);
								$rowForSrcDest=$resultForSrcDest->fetch_assoc();
								$resultSrc=$rowForSrcDest["src"];
								$resultDest=$rowForSrcDest["upto"];
								$sStop=mysqli_fetch_assoc(mysqli_query($con,"select stopNum from route where trainNum='$trainNum' and stationCode='$resultSrc'"))['stopNum'];
								$dStop=mysqli_fetch_assoc(mysqli_query($con,"select stopNum from route where trainNum='$trainNum' and stationCode='$resultDest'"))['stopNum'];
								
								if($destStop<=$dStop||($sourceStop>=$sStop))
									$check=false;
								else{
									$check=true;
									break;
								}
							}
							
							//fresh seat
							if(!$check){     
								//Full allocation of seat
								if($numOfPassenger>1){
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
								
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$numOfPassenger-=2;
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;	
									$availableSeats--;
									mysqli_query($conn,"update seatsavailinfo set numOfSeats=(numOfSeats-1) 
						                    where train_ID='$id' and classCode='$class' 
			                              and quotaCode='RAC' and stopNum>='$sourceStop' and stopNum<='$destStop' ");
										  
								}
								else
								{
									//partial allocation
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$numOfPassenger--;
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;		
								}
							}
							else{
								    array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;
									$availableSeats--;
									$numOfPassenger--;
									mysqli_query($conn,"update seatsavailinfo set numOfSeats=(numOfSeats-1) 
									where train_ID='$id' and classCode='$class' 
									and quotaCode='RAC' and stopNum>='$sourceStop' and stopNum<='$destStop' ");
								
							   }
						}
					}
					if($status=="waiting")
					{
						while($numOfPassenger>0)
					{
					   array_push($coachNum,"-");
					   array_push($seatNum,"-");
					   array_push($bookingStatus,"WL".(36-$minSeat));
					  
					   mysqli_query($conn,"update trainwaitingseatinfo set waiting=(waiting-1) 
									where train_ID='$id' and classCode='$class' 
									and stopNum>='$sourceStop' and stopNum<='$destStop' ");
                       $minSeat--;
                       $numOfPassenger--;
                       $minSeat--;	
                       $i++	;				   
					}
						
					}
				}
				else if($status=='RAC'){
					$i=0;
						while($numOfPassenger>0&&$minSeat>0){
							$racCoachNum=floor(($totalSeats-$availableSeats)/$seatsPerCoach)+1;
							$racSeatNum=(($totalSeats-$availableSeats)%$seatsPerCoach)+1;

							//to check partial filled or not
							 $sqlForPnr="SELECT a.pnrNum FROM ticket a,passengerinfo b 
													WHERE a.pnrNum=b.pnrNum AND a.class='$class' AND a.quota='$quota' 
														AND b.coachNum='$racCoachNum' 
														AND b.seatNum='$racSeatNum' AND a.trainNum='$trainNum' 
															AND a.journey_date='$journeyDate'";
							$resultForPnr=$conn->query($sqlForPnr);
							$check=false;
							
							while($rowForPnr=$resultForPnr->fetch_assoc()){
								//Checking seat result
								$resultPnr=$rowForPnr["pnrNum"];
								
								$sqlForSrcDest="SELECT src,upto FROM ticket WHERE pnrNum='$resultPnr'";
								$resultForSrcDest=$con->query($sqlForSrcDest);
								$rowForSrcDest=$resultForSrcDest->fetch_assoc();
								$resultSrc=$rowForSrcDest["src"];
								$resultDest=$rowForSrcDest["upto"];
								$sStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$resultSrc'"))['stopNum'];
								$dStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$resultDest'"))['stopNum'];
								
								if($destStop<=$sStop||($sourceStop>=$dStop))
									$check=false;
								else{
									$check=true;
									break;
								}
							}
							
							//fresh seat
							if(!$check){     
								//Full allocation of seat
								if($numOfPassenger>1){
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;
									
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$numOfPassenger-=2;
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;	
									$availableSeats--;
									mysqli_query($conn,"update seatsavailinfo set numOfSeats=(numOfSeats-1) 
						                    where train_ID='$id' and classCode='$class' 
			                              and quotaCode='RAC' and stopNum>='$sourceStop' and stopNum<='$destStop' ");
										  
								}
								else
								{
									//partial allocation
									array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$numOfPassenger--;
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;		
								}
							}
							else{
								   array_push($coachNum,$racCoachNum);
					                array_push($seatNum,$racSeatNum);
					                array_push($bookingStatus,"RAC");
									$seatStatus[$i]=$class."/".$coachNum[$i]."/".$seatNum[$i];
									$i++;
									$availableSeats--;
									$numOfPassenger--;
									mysqli_query($conn,"update seatsavailinfo set numOfSeats=(numOfSeats-1) 
									where train_ID='$id' and classCode='$class' 
									and quotaCode='RAC' and stopNum>='$sourceStop' and stopNum<='$destStop' ");	
								
							   }
						}
				}
				else
				{
					$i=0;
					while($numOfPassenger>0)
					{
					   array_push($coachNum,"-");
					   array_push($seatNum,"-");
					   array_push($bookingStatus,"WL".(36-$minSeat));
					    mysqli_query($conn,"update trainwaitingseatinfo set waiting=(waiting-1) 
									where train_ID='$id' and classCode='$class' 
									and stopNum>='$sourceStop' and stopNum<='$destStop' ");
                       
                       $numOfPassenger--;
                       $minSeat--;	
                       $i++	;				   
					}
				}

	           mysqli_query($conn,"insert into ticket values ('$pnr','$username','$trainNum','$src','$boardingCode','$dest','$quota','$class','$journeyDate',CURDATE(),'$ticketStatus')");
			  mysqli_query($conn,"insert into payment values ('$transactionNum','$pnr','$fare')");				
				
			        for($i=0;$i<$j;$i++)
					{
					$k=$i+1;
			mysqli_query($conn,"insert into passengerinfo values ('$k','$pnr','$passengerName[$i]','$gender[$i]','$age[$i]','$coachNum[$i]','$seatNum[$i]','$bookingStatus[$i]','$bookingStatus[$i]')");
               		
					}
					
					$_SESSION['t']=$transactionNum;
					$_SESSION['p']=$pnr;
					header('location:ticket.php');
					
	}	
	?>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		<script>
			function upperCase(a){
					setTimeout(function(){
					a.value = a.value.toUpperCase();
					},1);
				}
		</script>
			
		<style>
			#headerID{
				background-image: url(headerofpayment.JPG);
				background-repeat: no-repeat;
				background-size:1368px 168px;
				background-position:-23px 15px;
				margin-bottom:0px;
				margin-top:0px;
				padding:101px 0px 117px 0px;
			}
			
			#headID{
				position:absolute;
				font-size:22px;
				font-family:"Times New Roman";
				margin:38px 491px;
			}
			#fareID1{
				position:absolute;
				font-size:15px;
				font-family:"Times New Roman";
				margin:-23px 400px;
			}
			#fareID2{
				position:absolute;
				font-size:15px;
				font-family:"Times New Roman";
				margin:-20px 529px;
			}
			#fareValue{
				height:41px;
				width:408px;
				margin:76px 463px;
				position:absolute;
				border-radius:40px;
				padding:0px 21px;
			}
			.form-group{
				height:155px;
			}
			.btn{
				position:absolute;
				border-radius:46px;
				width:99px;
			}
				
			#btn1{
				margin:145px 555px;
			}
			#btn2{
				margin:145px 668px;
			}
			#footerId{
				background-image:url(footerofpayment.jpg);
				background-repeat:no-repeat;
				background-position:0px,0px;
				background-size:1364px 210px;
				margin-top:0px;
				margin-bottom:0px;
				padding-top:260px;
				padding-bottom:0px;
			}
		</style>
	</head>
	<body>
		<header id="headerID"></header>
			
				<h1 id="fareID1">You will receive a payment request for<?php echo "<b>"." Rs. ".$fare."</b>";//$_POST["fare"] ?> from irctc@axisbank in your UPI app.</h1>
				<br>
				<h1 id="fareID2">Kindly complete payment within 3 minutes.</h1>
				<h1 id="headID"><strong>Enter Virtual Payment Address (VPA)</strong></h1>
				
				<form class="form-group" action="" method="post">
					<input type="text" id="fareValue" placeholder="xyz@axis" maxlength="5" size="5" oninput="maxLengthTime(this)" required>
	                <input type="submit" id="btn1" class="btn btn-primary" name="submitButton" value="Submit">
		            <input type="cancel" id="btn2" class="btn btn-primary" value="Cancel">
	            </form>
	
	          <footer id="footerId"></footer>

	</body>
</html>