<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Cancel Ticket</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="header.css">
		<link rel="stylesheet" type="text/css" href="trainInfoCss.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

		<?php
		include("header.php");
		include("config.php");
		?>
	</head>
	
	<body>	
		<header id="headerId">
			<h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
			<h3 id="headerTitle2">An online portal to reserve your seat</h3>
			<strong><h1 id="headerTitle4">OIRRS</h1></strong>
			<p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
		</header>
		
		<nav class="navbar navbar-inverse">
 		 <div class="navbar-header">
     		 <strong><p id="navbarHeader">Welcome <?php echo $_SESSION['username']?> !</p></strong>
    	</div>
				<div class="container-fluid">
	     <ul class="nav navbar-nav" style="margin: auto;">
				<li> <a href="#" style="color: white"><b>Home</b></a> </li>
				<li class="dropdown" >		
 	<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white"><b>Services</b><b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="#">Ticket Booking</a></li>
	<li><a href="#">Quick Ticket Booking</a></li>
	<li><a href="cancelticket.php">Cancel Ticket</a></li>
	</ul>
	</li>
	<li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white"><b> Enquiries</b> <b class="caret"></b></a> 
<ul class="dropdown-menu">
<li> <a href="checkPnr.php">Check PNR Status</a></li>
<li> <a href="train_schedule.php">Find Train Schedule</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white"><b> My Profile</b><b class="caret"></b></a>
<ul class="dropdown-menu">
	<li><a href="#">Update Profile</a></li>
	<li> <a href="change_pass.php">Change Password</a> </li>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li>
	<a href="index.php" class="btn btn-lg" style="color: white" name="logout">
      <span class="glyphicon glyphicon-log-out" style="color: white"></span> Log out
      </a>
</li>
</ul>
	</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
		<p id="title">Booked Ticket Details :</p><hr>
		<?php
			$userID=$_SESSION["username"];
			$query="SELECT * FROM ticket WHERE userID='$userID'";
			$result=$conn->query($query);;
			if($result->num_rows>0){
				echo"<table class=\"table table-striped table-hover table-bordered\" >
				<tr style=\"background-color:#021f4f; color:white;\">
					<th>PNR Number</th>
					<th>Train Number</th>
					<th>Source</th>
					<th>Boarding</th>
					<th>Destination</th>
					<th>Class</th>
					<th>Quota</th>
					<th>Journey Date</th>
					<th>Booking Date</th>
					<th>Ticket Status</th>
					<th>Cancel</th>
				</tr>";
				while($row=$result->fetch_assoc()){
				    echo"<tr><td>".$row["pnrNum"]."</td><td>".$row["trainNum"]."</td><td>".$row["src"]."</td><td>".$row["boarding"]."</td>
							 <td>".$row["upto"]."</td><td>".$row["class"]."</td><td>".$row["quota"]."</td><td>".$row["journeyDate"]."</td>
							 <td>".$row["bookingDate"]."</td><td>".$row["ticketStatus"]."</td><td><button id=\"".$row["pnrNum"]."\" onclick=\"cancelTicket(this.id)\" class=\"btn btn-danger\"";
							 
							 $t=date("Y-m-d");
							 $currDate=explode("-",$t);
							 $jrnDate=explode("-",$row["journeyDate"]);
							 if(($row["ticketStatus"]=="Cancelled")||($currDate[0]>$jrnDate[0])||($currDate[1]>$jrnDate[1])||($currDate[0]==$jrnDate[0]&&$currDate[1]==$jrnDate[1]&&$currDate[2]>$jrnDate[2]))
								 echo "disabled";
							 
							 echo ">Cancel</button></td><tr>";
				}
				echo"</table>";
			}
		?>
		<p id="txtHint"></p>
		<script>
			function cancelTicket(str){
				window.location.href='cancelticketutil.php?q='+str;
			}
		</script>
		</div>
	</div>
	<hr>
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>				
	</body>
</html> 
