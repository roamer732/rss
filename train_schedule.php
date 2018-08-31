<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#detail th,#detail td
		{
			border: 1px solid ;
			border-collapse: collapse;
			text-align: center;
			padding: 8px;	
		}
		#sch th,#sch td
		{
			border: 1px solid ;
			border-collapse: collapse;
			text-align: center;
			padding: 7px;	
		}
		#els
		{
		color: red;
		margin-top:40px;
		}
	</style>
	<meta charset="utf-8">
		<title>Online Indian Railway Reservation System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		
		<?php
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
			<div class="container-fluid">
				<div class="navbar-header">
					<strong><p id="navbarHeader">Welcome User !</p></strong>
				</div>
				<ul class="nav navbar-nav" style="margin: auto;">
					<li> <a href="index.php" style="color: white"><p id="fontID">Home</p></a> </li>
					<li class="dropdown" >    
						<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white"><b>Services</b><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="userhome.php">Ticket Booking</a></li>
							<li><a href="userhome.php">Quick Ticket Booking</a></li>
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
				</ul>
			</div>
  </nav>

	<div class="container">
		<div class="jumbotron">
		<p id="title">Train Schedule Enquiry :</p><hr>
<form class="form-inline" action="" method="get">
  <div class="form-group">
    <label for="train_num">Enter Train Number : </label>
   <input type="text" class="form-control" id="num" name="train_num">
     <button type="submit" class="btn btn-primary" name="submtButton">Find Train Schedule</button>
  </div>
<hr>
</form>
<?php
	if(isset($_GET['submtButton'])){
		$num=$_GET["train_num"];

		$ret=mysqli_query($conn,"select trainName,source,destination from train where trainNum='$num' ");
		if(mysqli_num_rows($ret)>0){
		?>
	<br><br>
	<table id="detail" style="margin:auto;">
 	<tr>
 		<th>Train Number</th>
		<th>Train Name</th>
		<th>Source Station</th>
		<th>Destination Station</th>
		<th colspan="7">Runs From Source On</th>
 	</tr>

 		<?php

 		    $r1=mysqli_fetch_assoc($ret);
 		    
 		   $src_name=$r1['source'];
 		   $dest_name=$r1['destination'];
 		  
 		  $s=(mysqli_fetch_assoc(mysqli_query($conn,"select stationName from station where stationCode='$src_name' ")))['stationName'];
 		  
 		  $d=(mysqli_fetch_assoc(mysqli_query($conn,"select stationName from station where stationCode='$dest_name' ")))['stationName'];
            
           $r2=mysqli_query($conn,"select dayName from runningday where trainNum='$num' order by dayName ");
            
            $days=array("sunday"=>"Sun","monday"=>"Mon","tuesday"=>"Tue","wednesday"=>"Wed","thursday"=>"Thu","friday"=>"Fri","saturday"=>"Sat");
            $sday=array('sunday' =>0,'monday'=>1,'tuesday'=>2,'wednesday'=>3,'thursday'=>4,'friday'=>5,'saturday'=>6 );
            $arr= array("--","--","--","--","--","--","--" );

       while ($run=mysqli_fetch_assoc($r2)) 
      {

         $arr[$sday[strtolower($run['dayName'])]]=$days[ strtolower($run['dayName'])];
      }
     
 		?>
   <tr>
      <td><?php echo $num; ?> </td>
      <td> <?php echo $r1['trainName']; ?> </td>
      <td> <?php echo $s; ?> </td>
      <td> <?php echo $d; ?> </td>
      <?php
      	for($i=0;$i<7;$i++)
      	{
      ?>
  <td> 
         <?php 
         echo $arr[$i] ;
         ?> 
  </td>
  <?php } ?>
 </tr>
 </table>
 <br><br><br>
 <table id="sch" style="margin: auto;">
 	<tr>
 		<th>Stop_No</th>
 		<th>Station Code</th>
 		<th>Station Name</th>
 		<th>Arrival Time</th>
 		<th>Departure Time</th>
 		<th>Halt Time(In minutes)</th>
 		<th>Distance</th>
 	</tr>
 
 <?php
 $route=mysqli_query($conn,"select stopNum,stationCode,arrival,departure,distance from route where trainNum='$num' order by stopNum");
 while($res=mysqli_fetch_assoc($route)) 
 {
 	$sc=$res['stationCode'];
 	$name=mysqli_fetch_assoc(mysqli_query($conn,"select stationName from station where stationCode='$sc' "))['stationName'];

 	$from_time=strtotime($res['arrival']);
 
 	$to_time=strtotime($res['departure']);
 ?>

 	<tr> 
 	  <td> <?php echo $res['stopNum'];?>  </td>
 	  <td> <?php echo $res['stationCode'];?>  </td>
 	  <td> <?php echo $name;?> </td>
 	  <td> 
 	       <?php  
 	       if($res['arrival']!=NULL&&$res['arrival']!='00:00:00')
 	       echo $res['arrival'];
 	       else
 		   echo "--";
        	?>  
      </td>
 	  <td> 
 	     	<?php 
            if($res['departure']!=NULL&&$res['departure']!='00:00:00')
 	        echo $res['departure'];
 	        else
 	  	    echo "--";
 	  	    ?>  
 	 </td>
 	  
 	  <td> 
 	       <?php 
 	if(($res['arrival']!=NULL)&&($res['departure']!=NULL)&&$res['departure']!='00:00:00'&&$res['arrival']!='00:00:00')
 	       echo round(abs($to_time-$from_time)/60,2);
           else
    	   echo "--";
         	?>  
     </td>
 	 
   <td> <?php echo $res['distance'];?>  </td>
 	
 	</tr>
<?php	
 }
 ?>
</table>
</div>
</div>
<?php
}
else
 echo "<h4 id='els'>"."**No train Details Found" ."</h4>";
}

?>	
</body>
</html>
