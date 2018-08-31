<?php
include('connection.php');
  $passengerName=$_POST['passengerName'];
  $age=$_POST['age'];
  $gender=$_POST['gender'];
  session_start();
  $arr=$_SESSION['arr'];
  $boarding=$_POST['boarding'];
  $trainNum=$arr[0];
  $class=$arr[1];
  $quota=$arr[2];
  $src=$arr[3];
  $dest=$arr[4];
  $seat=$arr[5];
  $status=$arr[6];
  $date=$arr[7];
  $fare=$_SESSION['fare'];
  
  $_SESSION['passenger']=$passengerName;
  $_SESSION['age']=$age;
  $_SESSION['gender']=$gender;
  $_SESSION['boarding']=$boarding;
  
  $trainName=mysqli_fetch_assoc(mysqli_query($con,"select trainName from train where trainNum='$trainNum' "))['trainName'];
  $className=mysqli_fetch_assoc(mysqli_query($con,"select className from class where classCode='$class' "))['className'];
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Journey Details</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="header.css">
  <style type="text/css">
	#head
	{
	margin-top: -30px;
    height: 32px;
    width: 111%;
    margin-left: -57px;
	}
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
     		 <strong><p id="navbarHeader" style="margin-left:10px;color: white;">Welcome <?php echo $_SESSION['user_id']?> !</p></strong>
    	</div>
				<div class="container-fluid">
	     <ul class="nav navbar-nav" style="margin: auto;">
				<li> <a href="#" style="color: black"><b>Home</b></a> </li>
				<li class="dropdown" >		
 	<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b>Services</b><b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="#">Ticket Booking</a></li>
	<li><a href="#">Quick Ticket Booking</a></li>
	<li><a href="#">Cancel Ticket</a></li>
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
		<div class="btn-primary" id="head"><span style="padding:10px;"><strong>Journey Details</strong></span>
		</div>
		<table id="journey" style="width: 100%">
			<tr>
				<td><strong>Train No./TrainName:</strong></td>
				<td><?php echo $trainNum."/".$trainName; ?></td>
				<td><b>Journey Date:</b></td>
				<td><?php echo $date; ?></td>
				<td><b>Class:</b></td>
				<td><?php echo $className;?></td>
			</tr>	
			<tr>
				<td><b>From Station:</b> </td>
				<td><?php echo $src; ?> </td>
				<td><b>To Station:</b> </td>
				<td><?php echo $dest; ?> </td>
				<td><b>Quota:</b> </td>
				<td><?php echo $quota; ?> </td>
			</tr>
			<tr>	
				<td> <b>Boarding Station:</b> </td>
				<td> <?php echo $boarding; ?> </td>
				<td> <b>Reserve Upto Station:</b> </td>
				<td> <?php echo $dest;?> </td>
			</tr>
		</table>
		<div style="height: 30px;width: 1137px;margin-left:-58px;margin-top: 40px" class="bg-primary">
	  			<strong>Passenger Details </strong>
	  		</div>
	<table id="passenger">
			<tr>
				<th>S.No.</th>
				<th>Name</th>
				<th>Age</th>
				<th>Gender</th>
			</tr>
		
		<?php
		 
		 $i=0;
		 foreach($passengerName as $passenger)
		 {
		 	if($passenger!="")
		 	{
		 		
		 		echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$passenger."</td>";
		 		echo "<td>".$age[$i]."</td>";
		 		echo "<td>".$gender[$i]."</td>";
		      	echo "</tr>";
		      	$i++;
		 	}
		    
		  }
		  $numOfPassenger=$i;
		  $_SESSION['passengerCount']= $numOfPassenger;
		 ?>

		</table>

		<div class="row">
			<div class="col-sm-8 col-md-8">
				<div class="btn-primary" style="padding:5px;margin-left:-58px;margin-top: 20px"> <b>Availability Details</b> </div>
				<table style="width: 100%">
				<?php
				echo "<tr>";
				echo "<td>"."<b>"."Availability:"."</b>"."</td>";
				echo "<td>".$status."-".$seat."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>"."<b>"."Availability At:"."</b>"."</td>";
				date_default_timezone_set("Asia/Calcutta");
				echo "<td>".date("F j, Y, l,g:i A")."</td>";
				?>
			</table>
	  		</div>	
			
			<div class="col-md-4 col-sm-4">
				<div class="btn-primary" style="padding:5px;margin-top: 20px;width: 380px"> <b>Fare Details</b> </div>
				<table style="width:100%">
					<?php
					$fare=$fare*$i;
					echo "<tr>";
					echo "<td>"."<b>"."Ticket Fare:"."</b>"."</td>";
					echo "<td>".$fare."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>"."<b>"."Service Charge:"."</b>"."</td>";
					echo "<td>".floor($fare*0.05)."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>"."<b>"."Total Fare:"."</b>"."</td>";
					echo "<td>".($fare+floor($fare*0.05))."</td>";
					echo "</tr>";

	                $_SESSION['tfare']=($fare+floor($fare*0.05));
					?>
				</table>
				
			</div>
		</div>
		<div class="row" style="margin-top: 10px">
			<div class="col-sm-4 col-md-4"> </div>
			<div class="col-sm-4 col-md-4">
		<a href="userhome1.php"> <div class="btn btn-primary" value="Replan"> Replan </div> </a>&nbsp&nbsp&nbsp
		<a href="payment.php"> <div class="btn btn-primary" value="MakePayment">Make Payment</div> </a>
		</div>

		</div>
</div>

</body>
</html>