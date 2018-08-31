<!DOCTYPE html>
<html>
	<head>
		<title>Add Fare</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$classCodeErr = $trainTypeErr = $fareChargeErr = "";
			$classCode = $trainType = $fareCharge = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$flag=true;
				//for class code
				if (empty($_POST["classCode"])){
					$classCodeErr = "Class Code is required";
					$flag=false;
				}
				else 
					$classCode = $_POST["classCode"];
				
				//for train type
				if (empty($_POST["trainType"])){
					$trainTypeErr = "train type is required";
					$flag=false;
				}
					$trainType = $_POST["trainType"];
				
				//for fare charge
				if (empty($_POST["fareCharge"])){
					$fareChargeErr = "Number of Berths is required";
					$flag=false;
				}
				else 
					$fareCharge= $_POST["fareCharge"];
				
				if($flag){
					$sql="INSERT INTO fareinfo VALUES('$trainType','$classCode','$fareCharge')";
					if($conn->query($sql))
						echo "<div class=\"alert alert-success alert-dismissible\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<strong>Successfully Added !</strong></div>";
						//<script type='text/javascript'>alert('submitted successfully!')</script>";
					else
						echo "<script type='text/javascript'>alert('already exist !')</script>";
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
				width:235px;
				margin-top:-32px;
				margin-left:160px;
			}
			
			.error{
				position:absolute;
				color: #FF0000;
			}
			
			#error1{
				margin:-3px 327px;
			}
			#error2{
				margin:-3px 319px;
			}
			#error3{
				margin:-3px 250px;
			}
			
			p.serif {
				font-family: "Times New Roman", Times, serif;
				color:green;
				font-size:33px;
				position:absolute;
				margin:0px 32px;
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
					<li><a href="addNewClass.php"><p id="fontID">Add Class<p></a></li>
					<li><a href="addNewQuota.php"><p id="fontID">Add Quota<p></a></li>
					<li class="active"><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Add Fare Details :</p><hr>
					<div class="form-group">
						<label><strong>Train Type :</strong></label>
							<select type="text" class="form-control" name="trainType">
								<?php
									$sql="SELECT * FROM traintype";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["type"]."\">".$row["type"]."</option>";
									}
									else
										echo "No data available for train class";
								?>
							</select>
							<span class="error" id="error1"><?php echo "*".$trainTypeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Class Code :</strong></label>
							<select type="text" class="form-control" name="classCode">
								<?php
									$sql="SELECT classCode FROM class";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["classCode"]."\">".$row["classCode"]."</option>";
									}
									else
										echo "No data available for train class";
								?>
							</select>
							<span class="error" id="error2"><?php echo "*".$classCodeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Enter fare rate per KM :</strong></label>
							<input type="text" class="form-control" name="fareCharge" >
							<span class="error" id="error3"><?php echo "*".$fareChargeErr;?></span>
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