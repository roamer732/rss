<!DOCTYPE html>
<html>
	<head>
		<title>Add class</title>
		<?php
			include("header.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$classCodeErr = $classNameErr = $numOfBerthsErr = "";
			$classCode = $className = $numOfBerths = "";
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
				
				//class name
				if (empty($_POST["className"])){
					$classNameErr = "Class Name is required";
					$flag=false;
				}
					$className = $_POST["className"];
				
				//number of berths
				if (empty($_POST["numOfBerths"])){
					$numOfBerthsErr = "Number of Berths is required";
					$flag=false;
				}
				else 
					$numOfBerths= $_POST["numOfBerths"];
				
				if($flag){
					$sql="INSERT INTO class VALUES('$classCode','$className','$numOfBerths')";
					if($conn->query($sql))
						echo "<div class=\"alert alert-success alert-dismissible\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<strong>Successfully Added !</strong></div>";
						//<script type='text/javascript'>alert('submitted successfully!')</script>";
					else
						echo "<script type='text/javascript'>alert('failed!')</script>";
				}
			}
		?>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
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
				margin:-3px 445px;
				color: #FF0000;
			}
			
			#numOfBerthsID{
				width:80px;
			}
			
			#numOfBerthsErr{
				margin:0px 112px;
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
					<li><a href="addtrainclassquota.php"><p id="fontID">Add class in Train Info<p></a></li>
					<li class="active"><a href="addNewClass.php"><p id="fontID">Add Class<p></a></li>
					<li><a href="addNewQuota.php"><p id="fontID">Add Quota<p></a></li>
					<li><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<div class="well well-sm">
				<p id="title">Existing class :</p><hr>
					<?php
						$sql="SELECT * From class";
						include("config.php");
						$result=$conn->query($sql);
						if($result->num_rows>0)
							while($row=$result->fetch_assoc())
								echo "<label class=\"containerSelect\">".$row["classCode"]." - ".$row["className"]."</label><br>";
					?>
			</div>
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Add a new class :</p><hr>
					<div class="form-group">
						<label><strong>Class Code :</strong></label>
							<input type="text" class="form-control" name="classCode" maxlength="5" size="5" onkeydown="upperCase(this)" >
							<span class="error"><?php echo "*".$classCodeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Class Name :</strong></label>
							<input type="text" class="form-control" name="className" onkeydown="upperCase(this)" >
							<span class="error"><?php echo "*".$classNameErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Number of Berths in Each Coach :</strong></label>
							<input type="number" class="form-control" id="numOfBerthsID" name="numOfBerths" >
							<span class="error" id="numOfBerthsErr"><?php echo "*".$numOfBerthsErr;?></span>
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