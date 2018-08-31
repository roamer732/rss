<?php
include('connection.php');
  $q=$_GET['q'];
  $arr=explode(".",$q);

  $trainNum=$arr[0];
  $class=$arr[1];
  $quota=$arr[2];
  $src=$arr[3];
  $dest=$arr[4];
  $seat=$arr[5];
  $status=$arr[6];
  $date=$arr[7];
  $fare=$arr[8];
  $trainName=mysqli_fetch_assoc(mysqli_query($con,"select trainName from train where trainNum='$trainNum' "))['trainName'];
  $className=mysqli_fetch_assoc(mysqli_query($con,"select className from class where classCode='$class' "))['className'];
  $s=mysqli_fetch_assoc(mysqli_query($con,"select stopNum from route where stationCode='$src' and trainNum='$trainNum'"))['stopNum']; 
  $d=mysqli_fetch_assoc(mysqli_query($con,"select stopNum from route where stationCode='$dest' and trainNum='$trainNum'"))['stopNum'];  

  $station=mysqli_query($con,"select stationCode from route where stopNum>='$s' and stopNum<'$d' and trainNum='$trainNum' ");
  $srcStationName=mysqli_fetch_assoc(mysqli_query($con,"select stationName from station 
  	                                                    where stationCode='$src'"))['stationName'];
    $destStationName=mysqli_fetch_assoc(mysqli_query($con,"select stationName from station 
  	                                                    where stationCode='$dest'"))['stationName'];

  session_start();
                $_SESSION['arr'] = $arr;
                $_SESSION['fare']=$fare;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
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
	margin-top: -35px;
    height: 34px;
    width: 111%;
    margin-left: -57px;
	}
	
  th, td 
 {
   padding: 5px;
   text-align: center;

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
	  		<div class="btn-primary" id="head"><span style="padding:10px;"><strong>Journey Details</strong></span></div>
	  		<table style="width: 100%">
	  	<tr>
	  		    <td>
	  			       <b>Train No./Name:</b>
	  			</td>
	  			
	  			<td>
	  				<?php echo $trainNum.'/'.$trainName ?> 
	  			</td>
	  			
	  			<td>
	  		       <b>Journey Date:</b>
	  			</td>
	  			<td> <?php echo $date; ?> </td>
	  			<td> <b>Class:</b> </td>
	  			<td> <?php echo $class; ?> </td>
	  	</tr>
	  		<tr>
	  				<td><b>From Station:</b></td>
	  				<td> <?php echo $srcStationName."-".$src; ?> </td>
	  				<td> <b>To station:</b> </td>
	  				<td><?php echo $destStationName."-".$dest; ?></td>
	  				<td><b>Quota:</b></td>
	  				<td><?php echo $quota;?></td>
	  		</tr>
	  	<tr>
	  		<form action="journeydetails.php" method="post">
	  				<td><b>Boarding Station:</b></td>
	  			<td>
	  				<select name="boarding">	
	  					<?php
	  					while($stCode=mysqli_fetch_assoc($station))
	  					{
	  						$code=$stCode['stationCode'];
	  						$stName=mysqli_fetch_assoc(mysqli_query($con,"select stationName from station where 
	  							                                         stationCode='$code' "))['stationName'];
	  						$name=$stName."-".$stCode['stationCode'];
	  					?>
	  					<option> <?php echo $name;?> </option>
	  					<?php
	  					}
	  					?> 
	  				 </select>
	  			</td>
	  		
	            <td> <b>Reservation Upto: </b> </td>
	            <td> <?php echo $destStationName."-".$dest; ?> </td>     
	  	 </tr>
	  		</table>
	  		
	  		<div style="height: 30px;width: 1137px;margin-left:-58px;margin-top: 40px;padding: 5px" 
	  		           class="bg-primary">
	  			<strong>Passenger Details </strong>
	  		</div>
	  		<table>
	  			<tr>
	  				<th>S.No.</th>
	  				<th>Name</th>
	  				<th>Age</th>
	  				<th>Gender</th>
	  			</tr>
	  			
	  			<?php 
	  			$i=1;
	  			if($status=='waiting')
	  			$maxPassenger=$min;
	  		    else
	  		    	$maxPassenger=6;
	  			while($i<=6&&$maxPassenger>0)
	  			{
	  			?>
	  			<tr>	
	  				<td><span class="labelfont"><?php echo $i;?></span></td> 
	  			<td>		
	  				<input type="text" class="form-control" name="passengerName[]" minlength="3" maxlength="20" >
	  			</td>
	
	  				<td> <input type="text" class="form-control only-numeric" name="age[]" minlength="2" maxlength="3"> </td>
	  				<td>
	  			        <select name="gender[]" class="form-control">
	  			        	<option value="">Select</option>
	  			        	<option value="male">Male</option>
	  			        	<option value="female">Female</option>
	  			        	<option value="transgender">Transgender</option>
	  				     </select>
	  			   </td>

	  		  </tr>

	  		  <?php $i++; $maxPassenger--; } 
	  		  ?>
	  		</table>  	

           <button class="btn btn-primary" style="margin-left:270px;margin-top: 10px" type="submit">Next</button>
         <a href="userhome1.php" class="btn btn-primary" style="margin-left:20px;margin-top: 10px">Replan</a>
    </form>
    	</div>
	  </div>

</body>
</html>