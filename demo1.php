
<!DOCTYPE html>
<html>
<head>
  <style>
table,th, td {
    border: 1px solid black;
    border-collapse: collapse;

}
th, td 
{
    padding: 5px;
    text-align: center;
}
#fare
{
  width: 100%;
}
#fare th
{
  text-align: center;
}
</style>
	<title>Seat availability</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="header.css">
<style>
	#head
	{
	margin-top: -20px;
    height: 34px;
    width: 111%;
    margin-left: -57px;
	}
</style>
</head>
<body>
  <?php
   include('config.php');
   include('header.php');
   $train=$_GET['train'];
   $class=$_GET['class'];
   $date=$_GET['date'];
   $src=$_GET['src'];
   $dest=$_GET['dest'];
   $quota='GN';
  ?>
      <header id="headerId">
    <h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
    <h3 id="headerTitle2">An online portal to reserve your seat</h3>
    <p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
  <strong><h1 id="headerTitle4">OIRRS</h1></strong>
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

  <div class="btn-primary" id="head" style="margin-top: -47px"><span style="padding:10px;">Availability of Seats</span></div>
  <?php
	$quota=$_GET["values"];
    $from=substr($src,stripos($src,"-")+1);
    $to=substr($dest,stripos($dest,"-")+1);
     
     $s=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where stationCode='$from' and trainNum='$train'"))['stopNum']; 
   
     $d=mysqli_fetch_assoc(mysqli_query($conn,"select stopNum from route where stationCode='$to' and trainNum='$train'"))['stopNum'];  

     $dt=mysqli_query($conn,"select date from traindate where date>='$date' and trainNum='$train' order by date"); 

     $f=mysqli_fetch_assoc(mysqli_query($conn,"select farePerKm from train,fareinfo where trainNum='$train' and train.type=fareinfo.trainType and classCode='$class'"))['farePerKm'];
     $sd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stopNum='$s' and trainNum='$train'"))['distance'];
     $dd=mysqli_fetch_assoc(mysqli_query($conn,"select distance from route where stopNum='$d' and trainNum='$train'"))['distance'];
     $fare=floor($f*($dd-$sd));
     $rc=40;
    $tc=0;
     if($class=='SL')
      $rc=20;
    if($quota=='TQ')
      $tc=100;
    $totalFare=$fare+$rc+$tc;

      echo "<table style=\"width: 100%;margin-top:8px;\">";
      echo "<tr>"; 
      echo "<th style=\"text-align: center\";>Date</th>";
      echo "<th colspan=\"2\" style=\"text-align: center\";>Availability</th>";
      echo "</tr>";

	$c=1;
	 while($bookingDate=mysqli_fetch_assoc($dt)) 
	{
		$date=$bookingDate['date'];
		if($c>5)
		break;
			
       $id=mysqli_fetch_assoc(mysqli_query($conn,"select train_ID from traindate 
                                          where trainNum='$train' and date='$date' "))['train_ID'];


   
   $st=mysqli_query($conn,"select NumOfSeats,stopNum from seatsAvailInfo where stopNum>='$s' 
               and stopNum<= '$d' and train_ID='$id' and classCode='$class' and quotaCode='$quota' ");

   
      $min=99999;
      $status='Available';
     	while($ret=mysqli_fetch_assoc($st))
     	{
        if($min>$ret['NumOfSeats']&&$ret['NumOfSeats']>=0)
        {
          $min=$ret['NumOfSeats'];
          $minSeatStop=$ret['stopNum'];
        }
          $status='Available';
     	}
		$seatStaus="Available-".$min;
  
      if($min==0&&$status=='Available')
      {
        // for RAC seats
         $st=mysqli_query($conn,"select NumOfSeats,stopNum from seatsAvailInfo 
		                       where stopNum>='$s' and stopNum<='$d' and train_ID='$id' and 
                               classCode='$class' and quotaCode='RAC' ");
			
			$total=mysqli_fetch_assoc(mysqli_query($conn,"select sum(numOfSeats) numOfSeats from seatsAvailInfo 
			                                         where stopNum>='$s' and stopNum<='$d' and train_ID='$id' and 
                                                     classCode='$class' and quotaCode='RAC' "))['numOfSeats'];
									  
        while($ret=mysqli_fetch_assoc($st))
        {
             $min=9999;
             if($min>$ret['NumOfSeats']&&$ret['NumOfSeats']>=0)
          {
            $min=$ret['NumOfSeats'];
            $minSeatStop=$ret['stopNum'];
          }
            $status='RAC';
        }
		$seatStaus="RAC-".($total-$min+1);
     }
 
      if($min==0&&$status=='RAC')
        {
          $st=mysqli_query($conn,"select waiting,stopNum from trainwaitingseatinfo 
		                              where train_ID='$id' and stopNum>='$s' and stopNum<='$d' 
                                      and classCode='$class' ");
          while($ret=mysqli_fetch_assoc($st))
          {
            $min=999;
            if($min>$ret['waiting'])
            {
              $min=$ret['waiting'];
              $minSeatStop=$ret['stopNum'];
            }
            $status='waiting';
          }	 
        }
     if($status=='waiting')
	 {
		 if($min==0)
		 $seatStaus="Not Available";   
	     else
			 $seatStaus="GNWL".(36-$min);
	 }

    echo "<tr>";
    echo "<td>".$date."</td>";  
    echo "<td>".$seatStaus."</td>";
	
	if($seatStaus=="Not Available")
	               echo  "<td> <div class=\"btn btn-default\" style=\"pointer-events:none;\">Book Now</div> </td>";
	 else
           echo "<td> <button class=\"btn btn-success\" id=\"$train.$class.$quota.$from.$to.$min.$status.$date.$totalFare.$minSeatStop\" 
                             onclick=\"redirectBooking(this.id)\"> Book Now </button> </td>";
	 echo "</tr>";				 					
    	$c++; 
    }		
	echo "</table>";	
          if($c==1)
          echo "data not found";  	
    ?>
    
	<script type="text/javascript">
     function redirectBooking(str)
     {

      window.location="booking.php?q="+str;
     }
     </script>
	
  
    <div style="border: 1px solid;text-align: center;margin-top: 15px;" class="btn-primary"> 
     Fare Train Number:&nbsp <?php echo $train.", Class: ".$class." ,Quota: ".$quota;?> 
    </div>
 
 <table id="fare" style="margin-top: 8px;">
  <tr>
    <th>Base Fare</th>
    <th>Reservation Charge</th>
    <th>Tatkal Charge</th>
    <th>Other Cahrge</th>
    <th>Total Fare</th>
  </tr>

    <?php
    echo "<tr>";
    echo "<td>".$fare."</td>";
    echo "<td>".$rc."</td>";
    echo "<td>".$tc."</td>";
    echo "<td>"."0"."</td>";
    echo "<td>".$totalFare."</td>";
    echo "</tr>";
    ?>
 </table>

</div>
</div>
</body>
</html>
