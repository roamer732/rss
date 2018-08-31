
<?php
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		
		header('location:index.php');
	}
	
	?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	#qt
	{
		list-style-type: none;
		overflow: hidden;
		

	}
	#qt li 
	{
		display: inline;

	}
	#qt li input
	{
		margin-left: 50px;
	}
	.search
	{
		margin: auto;
		margin-top: 40px;
	}
		.search td,.search th
		{
			border: 1px solid ;
			border-collapse: collapse;
			text-align: center;
			padding: 8px;	
		}
		.search th
		{
		 color: blue;
		}
		#break
		{
			margin-top: 50px;
		}
		#break h3
		{ width:100%; text-align:center; border-bottom: 1px solid #000; line-height:0.1em; margin:10px 0 20px; }
		#break h3 span 
		{ background:#fff; padding:0 10px; }
	</style>
	<title>User account</title>
	
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<link rel="stylesheet" href="header.css">


	<style type="text/css">
		#container_id{
			padding:0px 0px 0px 0px;
			margin-top:-20px;
			width:1243px;
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

 	<nav class="navbar navbar-inverse" style="width:100%;">
 		 <div class="navbar-header">
     		 <strong><p id="navbarHeader" style="margin-left:10px;color: white;">Welcome <?php echo $_SESSION['user_id']?> !</p></strong>
    	</div>
				<div class="container-fluid">
	     <ul class="nav navbar-nav" style="margin: auto;">
				<li> <a href="#" style="color: white"><b>Home</b></a> </li>
				<li class="dropdown" >		
 	<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white"><b>Services</b><b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="#">Ticket Booking</a></li>
	<li><a href="#">Quick Ticket Booking</a></li>
	<li><a href="#">Cancel Ticket</a></li>
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

	<div class="container" id="container_id">
		<div class="jumbotron" id="jumbutron_id">
	<div class="row">
		<div class="col-sm-6" >
			<form class="form-horizontol"  method="get" action="">
				<div class="form-group">
					<label class="control-label col-sm-4" for="from_station">From Station: </label>
						<div class="col-sm-8">
					<input type="text" class="form-control" name="from" id="src">
						</div>
				</div>
			<script>
		$(function() 
		{
		    $("#src").autocomplete({
			source: "/abhi/search.php",
			autoFocus: true
		});
		});
		 </script>
		 <br>
				<div class="form-group" >
			<label class="control-label col-sm-4" for="to_station">To Station:</label>
			<div class="col-sm-8">
<input type="text" class="form-control" name="to" id="dest">
			</div>
				</div>
	<script>
   $(function()
   {
   	$("#dest").autocomplete(
   	{
   	source: "/abhi/search.php",
   	autoFocus: true
   });
   });
	
	</script>
	<br>
		<div class="form-group">
			<label class="control-label col-sm-4" for="journey_date">Journey Date:</label>
	<div class="col-sm-8">
	<input type="date" class="form-control" name="jdate" value="<?php if(isset($jdate)) echo $jdate;?>">
	</div>
		</div>
		<br>
				<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8 ">
			<div class="text-center">
			<input style="margin-top:2px;" class="btn-primary text-center" type="submit" name="submtButton" >
		</div>
			</div>
				</div>
			</form>
		</div>

		<div class="col-sm-6">
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td><h3><a href="#"><b>Cancel Ticket</b></a></h3></td>
						<td><h3><a href="bookedTicketHistory.php"><b>Booked Ticket History</b></a><h3></td>

					</tr>
					<tr>
				<td><h3><a href="checkPnr.php"><b>PNR Status</b></a></h3></td>
				<td><h3><a href="#"><b>Print Ticket</b></a></h3></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row" id="nextpage">

		<?php
	if(isset($_GET['submtButton']))
    {
    	//session_start();
 include('connection.php');
 $x=$_GET["from"];
 $y=$_GET["to"];
 $jdate=$_GET["jdate"];
  $from=substr($x,stripos($x,"-")+1);
  $to=substr($y,stripos($y,"-")+1);
 $sql="select runningday.trainNum from runningday where trainNum in (select s.trainNum from route s,route d where s.stationCode='$from' 
      and d.stationCode='$to' and s.stopNum<d.stopNum and s.trainNum=d.trainNum) and (dayName=dayname('$jdate'))";
     $ret=mysqli_query($con,$sql);
    
$days=array("sunday"=>"false","monday"=>"false","tuesday"=>"false","wednesday"=>"false","thursday"=>"false","friday"=>"false","saturday"=>"false");
if(mysqli_num_rows($ret)>0)
{
?>
<div id="break"><h3><span>Trains Between Stations</span></h3></div>

<form method="get" name="form1">
<ul id="qt">
<li> <b>Select Quota:</b></li>
 <li> <input type="radio" name="quota" value="LOWER BERTH/Sr. CITIZEN" tabindex="2"> LOWER BERTH/Sr. CITIZEN </li>
 <li> <input type="radio" name="quota" value="General" checked tabindex="2">GENERAL </li>
  <li> <input type="radio" name="quota" value="DIVYANGJAN" tabindex="2">DIVYANGJAN </li>
 <li> <input type="radio" name="quota" value="LADIES" tabindex="2">LADIES</li>
</ul>
</form>

   <script> 
    $(document).on('click','input[name="quota"]:radio',function() {
        var val = $(this).val(); 
	console.log(val)};
	); 
    </script>

    <table class="search">
  <tr id="head">
    <th>Train No.</th>
    <th>Train Name</th>
    <th>From</th>
    <th>Departure</th>
    <th>To</th>
    <th>Arrival</th>
    <th>Distance</th>
    <th>Travel Time</th>
    <th>M</th> <th>T</th> <th>W</th> <th>T</th> <th>F</th> <th>S</th> <th>S</th>
    <th>Class</th>
  </tr>
     <?php
     while($train=mysqli_fetch_assoc($ret))
     {
     	$name="select trainName from train where trainNum={$train['trainNum']} ";
     	$r1=mysqli_query($con,$name);
     	$col1=mysqli_fetch_assoc($r1);
     
  $sch="select arrival,departure,distance from route where trainNum={$train['trainNum']} and stationCode='$from'";
     	$r2=mysqli_query($con,$sch);
     	$source=mysqli_fetch_assoc($r2);
        
 $dch="select arrival,departure,distance from route where trainNum={$train['trainNum']} and stationCode='$to'";
     $r3=mysqli_query($con,$dch);
     $dest=mysqli_fetch_assoc($r3);

      $day="select dayName from runningday where trainNum={$train['trainNum']}";
      $r4=mysqli_query($con,$day);
   
     $cl="select classCode from trainclass where trainNum={$train['trainNum']}";
     $r5=mysqli_query($con,$cl);
?>
	<?php
		$st=date_create('2018-01-29 23:23:00');
		$en=date_create('2018-01-30 06:25:00');
		$diff=date_diff($st,$en);
    ?>
	<tr id='main'>
		<td id='train_no'> <?php echo $train['trainNum'] ?> </td>
		<td> <?php echo $col1['trainName'] ?> </td>
		<td> <?php echo $from ?> </td>
		<td> <?php echo $source['departure'] ?> </td>
		<td> <?php echo $to ?> </td>
		<td> <?php echo $dest['arrival'] ?> </td>
		<td> <?php echo $dest['distance']-$source['distance']; ?> </td>
		<td> <?php echo $diff->format('%H:%I:%S'); ?> </td>
    
    <?php
    
    $c=7;
     while($row4=mysqli_fetch_assoc($r4))
     {
     ?>
      <td>
    <?php 
    $days[ $row4['dayName'] ]="True";
    echo $days[ $row4['dayName'] ]; 
    $days[ $row4['dayName'] ]="false";
    $c--;
       ?> 
     </td>
     <?php
      }
      ?>
      <?php
      while(($c--)>0)
      {
      ?>
      <td>False</td>
      <?php
       }
       ?>
      <td> 
      <?php 
    while($row5=mysqli_fetch_assoc($r5))
      {
      ?>
	  <script>
	  function getQuota()
	  {
		  alert('dsffd');
		  var q=form1.quota.value;
		  return q;
	  }
	  </script>
	  <?php 
	  $quota= "demo1.php?train=".$train['trainNum']."&class=".$row5['classCode']."&date=".$_GET['jdate']."&src=".rawurlencode($_GET['from'])."&dest=".rawurlencode($_GET['to'])."&quota=";
	  ?>
     <a href=<?php echo "demo1.php?train=".$train['trainNum']."&class=".$row5['classCode']."&date=".$_GET['jdate']."&src=".rawurlencode($_GET['from'])."&dest=".rawurlencode($_GET['to'])?> style="text-decoration: none;" name="class1"> <?php echo $row5['classCode'] ?> </a>    
     <?php
      }
      ?>
     </td>
	</tr>
	<?php
    }
    ?>
</table>
 <script>
	$(document).on("click","tr td a",function()
	{	
		var trainclass=$(this).html();
		//console.log($(trainclass).html())
		main=$(this).closest('#main');
	var train_no=($(main).children('#train_no')).html();
		//console.log($(train_no).html())
		console.log('ok')
		console.log(window.location)
		str='http://localhost/abhi/userhome1.php?'+'train='+train_no;
		console.log(str)
		$.ajax({
			
			url: "demo1.php",
			data: { 'class': trainclass, 'train_num': train_no}
		});
	});
	</script>

<?php
}
else 
echo " <h4 class='text-primary' style='margin-top:40px;'>No Direct Trains Found For '$x' To '$y' on '$jdate' </h4>";

 }?>
 


	</div>
</div>
			
		</div>
<hr>
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
</body>
</html>