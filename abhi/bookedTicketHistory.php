<!DOCTYPE html>
<html>
<head>
  <?php session_start(); ?>
	<title>Booked Ticket History</title>
	<link rel="stylesheet" href="header.css">

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
       	background-color: bg-primary;
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
     	<div style="height: 30px;width: 1137px;margin-left:-58px;margin-top: -50px;padding: 5px;" class="bg-primary">
	  			<strong>Booked Ticket Details </strong>
	  		</div>
	  		<table style="width:100%;margin-top: 10px">
	  			<tr style="font-size: 15px">
	  			<th>S.No</th>
	  			<th>Transaction ID</th>
	  			<th>PNR Number</th>
	  			<th>Train No.</th>
	  			<th>From</th>
	  			<th>To</th>
	  			<th>Date of Journey</th>
	  			<th>Reservation Status</th>
	  			<th>Date Of Booking</th>
	  		</tr>
	  		
	<?php
 include('connection.php');

 $userId=$_SESSION['user_id'];

  $sql=mysqli_query($con, 
  	                     "select ticket.pnrNum,ticket.trainNum,src,upto,journeyDate,ticketStatus,bookingDate,
  	                   transactionNum from ticket,payment where ticket.pnrNum=payment.pnrNum and userID='$userId'");
 
      $i=1;
     while($res=mysqli_fetch_assoc($sql)){
     	echo "<tr>";
      echo "<td>".$i."</td>";
      echo "<td>".$res['transactionNum']."</td>";
      echo "<td style=\"color:#337ab7;\">".$res['pnrNum']."</td>";
      echo "<td>".$res['trainNum']."</td>";
      echo "<td>".$res['src']."</td>";
      echo "<td>".$res['upto']."</td>";
      echo "<td>".$res['journeyDate']."</td>";
      echo "<td>".$res['ticketStatus']."</td>";
      echo "<td>".$res['bookingDate']."</td>";
      echo "</tr>";
      $i++;
   }
    ?>
    </table>
    <script type="text/javascript">
    	function
    </script>
</div>
</div>
</body>
</html>
