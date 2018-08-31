<!DOCTYPE html>
	<head>
		<title>FAIR CHART</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		<style>
			#titleID{
				color:Green;
				font-size:56px;
				margin-left:400px;
				padding: 0px 0px 0px 0px;
			}
		</style>
	</head>
	<body>
		<header id="headerId">
			<h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
			<h3 id="headerTitle2">An online portal to reserve your seat</h3>
			<strong><h1 id="headerTitle4">OIRRS</h1></strong>
			<p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
		</header>
  
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<strong><p id="navbarHeader">Welcome User !</p></strong>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="adminpanel.php"><strong>Admin Panel</strong></a></li>
					<li><a href="addNewClass.php"><strong>Add New Class</strong></a></li>
					<li><a href="addNewQuota.php"><strong>Add New Quota</strong></a></li>
					<li class="active"><a href="addtrainclassquota.php"><strong>Add Class-Quota in a Train Info</strong></a></li>
				</ul>
			</div>
		</nav>
		
		<div class="well well-sm" id="fareTitleID"><h1 id="titleID">Fare rate per KM</h1></div>
		<div class="container">
			<div class="jumbotron">
		<?php
			include("config.php");
			$query="SELECT a.trainType,a.classCode,b.className,a.farePerKM FROM fareinfo a,class b WHERE a.classCode=b.classCode";
			$result=$conn->query($query);;
			if($result->num_rows>0){
				echo"<table class=\"table table-striped table-hover\" >
				<tr>
					<th>train type</th>
					<th>class</th>
					<th>class name</th>
					<th>charges Rs/km</th>
				</tr>";
				while($row=$result->fetch_assoc())
				    echo"<tr><td>".$row["trainType"]."</td><td>".$row["classCode"]."</td><td>".$row["className"]."</td><td>".$row["farePerKM"]."</td></tr>";
				echo"</table>";
			}
			else
				echo"0 results";			
		?>
			</div>
		</div>
		<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>	
	</body>
</html>