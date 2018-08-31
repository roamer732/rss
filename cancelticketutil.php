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
		<p id="title">Passengers Details :</p><hr>
		<?php
			$userID=$_SESSION["username"];
			$pnrNum=$_GET["q"];
			$query="SELECT a.passengerNum,a.name,a.age,a.gender,a.bookingStatus,a.currentStatus,a.coachNum,a.seatNum,
			b.class,b.quota,b.trainNum,b.journeyDate,b.src,b.upto FROM passengerinfo a,ticket b WHERE b.pnrNum='$pnrNum' AND a.pnrNum=b.pnrNum";
			$result=$conn->query($query);;
			if($result->num_rows>0){
				echo"<table class=\"table table-striped table-hover table-bordered\" >
				<tr style=\"background-color:#021f4f; color:white;\">
					<th>Passenger No.</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Class</th>
					<th>Quota</th>
					<th>Coach Number</th>
					<th>Seat Number</th>
					<th>Booking Status</th>
					<th>Current Status</th>
					<th>Cancel</th>
				</tr>";
				while($row=$result->fetch_assoc()){
				    echo"<tr><td>".$row["passengerNum"]."</td><td>".$row["name"]."</td><td>".$row["gender"]."</td><td>".$row["age"]."</td>
							 <td>".$row["class"]."</td><td>".$row["quota"]."</td><td>".$row["coachNum"]."</td><td>".$row["seatNum"]."</td>
							 <td>".$row["bookingStatus"]."</td><td>".$row["currentStatus"]."</td><td><button id=\"".$pnrNum.".".$row["passengerNum"].".".$row["coachNum"]."."
							 .$row["seatNum"].".".$row["class"].".".$row["currentStatus"].".".$row["trainNum"].".".$row["journeyDate"]."."
							 .$row["src"].".".$row["upto"].".".$row["quota"]."\" onclick=\"cancelTicket(this.id)\" class=\"btn btn-danger\"";
							 
							 if($row["currentStatus"]=="Cancelled")
								 echo "disabled";
							 echo ">Cancel</button></td><tr>";
				}
				echo"</table>";
			}
		?>
		<hr>
		<p id="txtHint"></p>
		<script>
			function cancelTicket(str){
				if(confirm("Confirm to cancel")){
					xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
												document.getElementById("txtHint").innerHTML = this.responseText;
											}
										};
					xhttp.open("GET", "cancelticketaction.php?q="+str, true);
					xhttp.send();
				}
				else
					alert("Ticket cancellation request aborted !");
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
