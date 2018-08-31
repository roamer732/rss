<?php
include('config.php');
include('header.php');
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
   $transactionId=$_SESSION['t'];
   $pnrNumber=$_SESSION['p'];
   

  $trainName=mysqli_fetch_assoc(mysqli_query($conn,"select trainName from train where trainNum='$trainNum' "))['trainName'];
  $className=mysqli_fetch_assoc(mysqli_query($conn,"select className from class where classCode='$class' "))['className'];
   $sd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stationCode='$boardingCode' and trainNum='$trainNum'"))['distance'];
     $dd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stationCode='$dest' and trainNum='$trainNum'"))['distance'];
     $departure=mysqli_fetch_assoc(mysqli_query($conn,"select departure from route where trainNum='$trainNum' and stationCode='$src'"))['departure'];
       $arrival=mysqli_fetch_assoc(mysqli_query($conn,"select arrival from route where trainNum='$trainNum' and stationCode='$dest'"))['arrival'];
       $sourceStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$class'"))['stopNum'];
    $destStop=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where trainNum='$trainNum' and stationCode='$dest'"))['stopNum'];
   $bookingStatus=array();
   
   for($i=1;$i<=$numOfPassenger;$i++)
   {
	 
 $sql=mysqli_query($conn,"select coachNum,seatNum,bookingStatus from passengerinfo 
				                    where pnrNum='$pnrNumber' and passengerNum=$i ");
										
	$coach=mysqli_fetch_assoc(mysqli_query($conn,"select coachNum from passengerinfo 
				                    where pnrNum='$pnrNumber' and passengerNum=$i "))['coachNum'];
    $seat=mysqli_fetch_assoc(mysqli_query($conn,"select seatNum from passengerinfo 
				                    where pnrNum='$pnrNumber' and passengerNum=$i "))['seatNum'];
									
	$status=mysqli_fetch_assoc(mysqli_query($conn,"select bookingStatus from passengerinfo 
				                    where pnrNum='$pnrNumber' and passengerNum=$i "))['bookingStatus'];
		
		if($coach==0||$seat==0)
			array_push($bookingStatus,$status);
		else
			array_push($bookingStatus,$status."/".$class."-".$coach."/".$seat);
			
   }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="header.css">
  <style type="text/css">
  	#passenger
	{
		margin-top: 10px;
		width: 100%;
	}
	th, td 
   {
   padding: 5px;
   text-align: center;
   }
   #passenger th,#passenger td
   {
   	border: 1px solid black;
   	border-collapse: collapse;
   }
  </style>
</head>
<body>
	   <header id="headerId">
    <h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
    <h3 id="headerTitle2">An online portal to reserve your seat</h3>
    <p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
	<strong><h1 id="headerTitle4">OIRRS</h1></strong>
  </header>

 	<nav class="navbar" style="width:100%;background-color: #009688">
 		 <div class="navbar-header">
     		 <strong><p id="navbarHeader" style="margin-left:10px;color: white;">Welcome <?php echo $_SESSION['username']?> !</p></strong>
    	</div>
				<div class="container-fluid">
	     <ul class="nav navbar-nav" style="margin: auto;">
				<li> <a href="userhome.php" style="color: black"><b>Home</b></a> </li>
				<li class="dropdown" >		
 	<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b>Services</b><b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="userhome.php">Ticket Booking</a></li>
	<li><a href="userhome.php">Quick Ticket Booking</a></li>
	<li><a href="cancelticket.php">Cancel Ticket</a></li>
	</ul>
	</li>
	<li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b> Enquiries</b> <b class="caret"></b></a> 
<ul class="dropdown-menu">
<li> <a href="checkPnr.php">Check PNR Status</a></li>
<li> <a href="train_schedule.php">Find Train Schedule</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b> My Profile</b><b class="caret"></b></a>
<ul class="dropdown-menu">
	<li><a href="#">Update Profile</a></li>
	<li> <a href="change_pass.php">Change Password</a> </li>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li>
	<a href="index.php" class="btn btn-lg" style="color: black" name="logout">
      <span class="glyphicon glyphicon-log-out" style="color: black"></span> Log out
      </a>
</li>
</ul>
	</div>
	</nav>

	<div class="container">
		<div class="jumbotron">
			<div style="height: 30px;width: 1137px;margin-left:-58px;padding: 5px;margin-top: -20px" class="bg-primary">
	  			<strong>Ticket Details </strong>
	  		</div>
	  		<table style="width: 100%">
	  			<?php
	  			echo "<tr>";
	  			echo "<td>"."<b>"."Transaction ID:"."</b></td> <td>".$transactionId."</td>";
	  	        echo "<td>"."<b>"."PNR No:"."</b></td><td> ".$pnrNumber."</td>";
	  	        echo "<td>"."<b>"."Train No./Name:"."</b></td><td>".$trainNum."/".$trainName."</td>";
	  	        echo "</tr>";
	  	        echo "<tr>";
	  	        echo "<td>"."<b>"."Date Of Booking:"."</b></td><td>".date('d-F-Y')."</td>";
	  	        echo "<td>"."<b>"."Class:"."</b></td><td>".$className."</td>";
	  	        echo "<td>"."<b>"."Quota:"."</b></td><td>".$quota."</td>";
	  	        echo "</tr>"."<tr>";
	  	        echo "<td>"."<b>"."Date Of Journey:"."</b></td><td> ".$journeyDate."</td>";
	  	        $stationName=mysqli_fetch_assoc(mysqli_query($conn,"select stationName from station 
	  	        	                                        where stationCode='$src'"))['stationName'];
	  	        echo "<td>"."<b>"."From:"."</b></td><td>".$stationName."-".$src."</td>" ;
	  	        $stationName=mysqli_fetch_assoc(mysqli_query($conn,"select stationName from station 
	  	        	                                        where stationCode='$dest'"))['stationName'];
	  	        echo "<td>"."<b>"."To:"."</b></td><td> ".$stationName."-".$dest."</td>";

	  	        echo "</tr>"."<tr>";

	  	        echo "<td>"."<b>"."Boarding At:"."</b></td><td>".$boarding."</td>";
				
	  	        echo "<td>"."<b>"."Date Of Boarding:"."</b></td><td>".$journeyDate."</td>";

	  	         echo "<td>"."<b>"."Reservation Upto:"."</b></td><td>".$stationName."-".$dest."</td>";
	  	          echo "</tr>"."<tr>";
	  	         echo "<td>"."<b>"."Distance:"."</b></td><td>".($dd-$sd)."</td>";
	  	         echo "<td>"."<b>"."Scheduled Departure:"."</b></td><td> ".$departure."</td>";
	  	         echo "<td>"."<b>"."Scheduled Arrival:"."</b></td><td> ".$arrival."</td>";
	  	          echo "</tr>"."<tr>";
	  	         echo "<td>"."<b>"."Total Fare:"."</b></td><td> ".$fare."</td>";
	  	         echo "<td>"."<b>"."No. Of Passenger:"."</b></td><td>".$numOfPassenger."</td>";
	  	         echo "</tr>";
	  			?>
	  		</table>

	  		<div style="height: 30px;width: 1137px;margin-left:-58px;margin-top: 40px;padding: 5px;" class="bg-primary">
	  			<strong>Passenger Details </strong>
	  		</div>
	  		<table style="width: 100%" id="passenger">
	  			<tr>
	  				<th>S.No.</th>
	  				<th>Name</th>
	  				<th>Age</th>
	  				<th>Gender</th>
	  				<th>Booking Status</th>
	  			</tr>
	  		    <?php
				
	  	    $i=0;
		 foreach($passengerName as $passenger)
		 {
		 	if($passenger!="")
		 	{
		 	    $j=$i+1;	
		 		echo "<tr>";
                echo "<td>".$j."</td>";
                echo "<td>".$passenger."</td>";
		 		echo "<td>".$age[$i]."</td>";
		 		echo "<td>".$gender[$i]."</td>";
				
		 		echo "<td>".$bookingStatus[$i]."</td>";
		      	echo "</tr>";
		      	$i++;
		 	} 
		  }
	  	?>
	  	</table>
	  	<button style="margin-left:435px;margin-top:20px;" class="btn btn-primary" onclick="myPrint()">Print</button>
	  	<script type="text/javascript">
	  		function myPrint()
	  		{
	  			window.print();
	  		}
	  	</script>
		</div>
	</div>

</body>
</html>