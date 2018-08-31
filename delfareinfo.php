<!DOCTYPE html>
<html>
	<head>
		<title>Delete Fare Info</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$classCode = $trainType ="";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$flag=true;
				//variables
				$classCode = $_POST["classCode"];
				$trainType = $_POST["trainType"];
					
				$sql="DELETE FROM fareinfo WHERE trainType='$trainType' AND classCode='$classCode'";
				if($conn->query($sql))
					echo "<div class=\"alert alert-success alert-dismissible\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<strong>Successfully Added !</strong></div>";
				else
					echo "<script type='text/javascript'>alert('failed!')</script>";
			}
		?>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		<style>
			.form-control{
				position:absolute;
				width:235px;
				margin-top:-32px;
				margin-left:160px;
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
					<li><a href="adminpanel.php"><strong>Admin Panel</strong></a></li>
					<li><a href="deltraininfo.php"><strong>Delete Train Info</strong></a></li>
					<li><a href="deltrainclass.php"><strong>Delete Train-Class</strong></a></li>
					<li><a href="delclass.php"><strong>Delete Class</strong></a></li>
					<li><a href="delquota.php"><strong>Delete Quota</strong></a></li>
					<li class="active"><a href="delfareinfo.php"><strong>Delete Fare Info</strong></a></li>
					<li><a href="deltrainroute.php"><strong>Delete train-route</strong></a></li>
					<li><a href="delstationinfo.php"><strong>Delete Station Info</strong></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Delete Fare :</p><hr>
					<div class="form-group">
					<label><strong>Existing fare details :</strong></label>
					<?php
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
					<hr>
					<div class="form-group">
						<label><strong>Select train type :</strong></label>
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
					</div>
					
					<div class="form-group">
						<label><strong>Select class code :</strong></label>
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
					</div>
				</div>
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
	</div>
	<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>