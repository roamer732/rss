<!DOCTYPE html>
<html>
	<head>
		<title>Add new class in a Train Info</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		<?php
			include("header.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$classCodeErr = $trainNumErr = $coachNumErr = "";
			$classCode = $trainNum = $coachNum = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				include("config.php");
				$flag=true;
				//for class code
				if (empty($_POST["classCode"])){
					$classCodeErr = "Class Code is required";
					$flag=false;
				}
				else 
					$classCode = $_POST["classCode"];
				
				//for train number
				if (empty($_POST["trainNum"])){
					$trainNumErr = "train number is required";
					$flag=false;
				}
					$trainNum = $_POST["trainNum"];
				
				//number of coaches
				if (empty($_POST["coachNum"])){
					$coachNumErr = "Number of coaches is required";
					$flag=false;
				}
				else 
					$coachNum= $_POST["coachNum"];
				
				if($flag){
					$sql="INSERT INTO trainclass VALUES('$trainNum','$classCode','$coachNum')";
					if($conn->query($sql))
						echo "<div class=\"alert alert-success alert-dismissible\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<strong>Successfully Added !</strong></div>";
					else
						echo "<script type='text/javascript'>alert('failed!')</script>";
				}
			}
		?>
				
		<script>
			function upperCase(a){
					setTimeout(function(){
					a.value = a.value.toUpperCase();
					},1);
				}
		</script>
		
		<style>
			.form-control{
				position:absolute;
				margin: -34px 250px;
				width:270px;
			}
			
			.close{
				font-size:25px;
			}
			
			#navbarHeader{
				font-size:25px;
			}
			
			.error{
				position:absolute;
				color: #FF0000;
			}
			
			#numOfBerthsID{
				width:80px;
			}
			
			#errID1{
				margin:-3px 402px;
			}
			#errID2{
				margin:-3px 417px;
			}
			#errID3{
				margin:0px 392px;
			}
			
			.containerSelect{
				padding:0px 38px;
				font-size:18px;
			}
			
			.well{
				font-size:18px;
				padding:16px 60px;
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
  
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<strong><p id="navbarHeader">Welcome Admin !</p></strong>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="adminpanel.php"><p id="fontID">Admin Panel<p></a></li>
					<li><a href="trainInfo.php"><p id="fontID">Add Train Info<p></a></li>
					<li class="active"><a href="addtrainclassquota.php"><p id="fontID">Add class in Train Info<p></a></li>
					<li><a href="addNewClass.php"><p id="fontID">Add Class<p></a></li>
					<li><a href="addNewQuota.php"><p id="fontID">Add Quota<p></a></li>
					<li><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<strong><p id="title">Add a new class in Train Info. :</p></strong><hr>
					<div class="form-group">
						<label><strong>Add Train Number :</strong></label>
							<input type="number" class="form-control" name="trainNum" maxlength="5" size="5" onkeydown="upperCase(this)" >
							<span class="error" id="errID1"><?php echo "*".$trainNumErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Add Class Code :</strong></label>
							<input type="text" class="form-control" name="classCode" onkeydown="upperCase()" >
							<span class="error" id="errID2"><?php echo "*".$classCodeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Number of Coaches :</strong></label>
							<input type="number" class="form-control" name="coachNum" >
							<span class="error" id="errID3"><?php echo "*".$coachNumErr;?></span>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Add</button>
			</form>
	</div>
	<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>