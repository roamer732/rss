<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>PNR Status</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="header.css">
<style type="text/css">
		table,th, td 
	{
     border: 1px solid black;
     border-collapse: collapse;
    }

th, td {
        padding: 5px;
       text-align: center;
       }
       th
       {
       	color: green;
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
         <strong><p id="navbarHeader" style="margin-left:10px;color: white;">Welcome <?php echo $_SESSION['user_id']?> !</p></strong>
      </div>
        <div class="container-fluid">
       <ul class="nav navbar-nav" style="margin: auto;">
        <li> <a href="userhome1.php" style="color: black"><b>Home</b></a> </li>
        <li class="dropdown" >    
  <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b>Services</b><b class="caret"></b></a>
  <ul class="dropdown-menu">
  <li><a href="userhome1.php">Ticket Booking</a></li>
  <li><a href="userhome1.php">Quick Ticket Booking</a></li>
  <li><a href="userhome1.php">Cancel Ticket</a></li>
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
 				<div style="height: 30px;width: 1137px;margin-left:-58px;margin-top:-47px;" class="bg-primary">
	  			<strong>PNR Enquiry</strong>
	  			</div>
	  		<form class="form-inline" action="" method="post">
	 				<div class="form-group" style="margin-top: 30px">
    				<label for="train_num">Enter PNR Number:</label>
   					<input type="text" class="form-control" name="pnr">&nbsp&nbsp&nbsp&nbsp
     				<button type="submit" class="btn btn-primary" name="submtButton">Get PNR Status</button>
      				</div>
   			</form>
   			<?php
   			if(isset($_POST['submtButton']))
   			{
   			include('connection.php');
   			$pnr=$_POST['pnr'];
   			$sql=mysqli_query($con,"select * from ticket where pnrNum='$pnr' ");
   			$result=mysqli_fetch_assoc($sql);
   			$num=$result['trainNum'];
   			$train_name=mysqli_fetch_assoc(mysqli_query($con,"select trainName from train 
   				                                            where trainNum='$num'"))['trainName'];
   			$count=mysqli_fetch_assoc(mysqli_query($con,"select count(pnrNum) num from passengerinfo 
       	                                            where pnrNum='$pnr'"))['num'];
   			echo "<table style=\"width:100%;margin-top:20px\">";
   			echo "<tr>";
   			echo "<td><b>PNR Number</b></td>";
   			echo "<td>".$result['pnrNum']."</td>";
   			echo "<td><b>Journey Date</b></td>";
   			echo "<td>".$result['journeyDate']."</td>";
   			echo "</tr>";
   			echo "<td><b>Train Number</b></td>";
 			echo "<td>".$result['trainNum']."</td>";
 			echo "<td><b>Train Name</b></td>";
 			echo "<td>".$train_name."</td>";
 			echo "</tr>";
 			echo "<td><b>From Station</b></td>";
 			echo "<td>".$result['src']."</td>";
 			echo "<td><b>To Station</b></td>";
 			echo "<td>".$result['upto']."</td>";
 			echo "</tr>";
 		    echo "<td><b>Boarding Station</b></td>";
 		    echo "<td>".$result['boarding']."</td>";
 		    echo "<td><b>Reservation Upto</b></td>";
 		    echo "<td>".$result['upto']."</td>";
 		    echo "</tr><tr>";
 		    echo "<td><b>Class</b></td>";
 		    echo "<td>".$result['class']."</td>";

 		     echo "<td><b>No. Of Passenger</b></td>";
 		     echo "<td>".$count."</td>";
 		     echo "</tr><tr>";
 		     echo "<td><b>Charting Status</b></td>";
 		     echo "<td>Chart Not Prepared</td>";
 		     echo "<td><b>Quota</b></td>";
 		    echo "<td>".$result['quota']."</td>";
 		    echo "</tr>";
 		    echo "</table>";
           
   	 echo "<div style=\"height: 30px;width: 1137px;margin-left: -58px;margin-top: 30px;\" class=\"bg-primary\">";
	     echo "<strong>Status Report</strong>";
	  echo "</div>";
     echo "<table style=\"width: 100%;margin-top: 10px\">";
     	echo "<tr>";
     		echo "<th>S.No.</th>";
     		echo "<th>Passenger Name</th>";
     		echo "<th>Age</th>";
     		echo "<th>Booking Status</th>";
     		echo "<th>Current Status</th>";
     	echo "</tr>";
 
   $pnrNumber=$result['pnrNum'];
  
   for($i=1;$i<=$count;$i++)
   {
	 
 $sql=mysqli_query($con,"select name,age,coachNum,seatNum,bookingStatus,currentStatus from passengerinfo 
				                    where pnrNum='$pnrNumber' and passengerNum='$i' ");
 
   $details=mysqli_fetch_assoc($sql);
   $coach=$details['coachNum'];
   $seat=$details['seatNum'];

   if($coach==0||$seat==0)
   {
	$bstatus=$details['bookingStatus'];
	$cstatus=$details['currentStatus'];
   }
	 else
    {
    $bstatus=$details['bookingStatus']."/".$result['class']."-".$coach."/".$seat;
    $cstatus=$details['currentStatus']."/".$result['class']."-".$coach."/".$seat;
	}

     echo "<tr>";
     echo "<td>".$i."</td>";
     echo "<td>".$details['name']."</td>";
     echo "<td>".$details['age']."</td>";
     echo "<td>".$bstatus."</td>";
      echo "<td>".$cstatus."</td>";
      echo "</tr>";
   }
   echo "</table>";
 }
?>

  </div> 
 </div>
 </body>
 </html>