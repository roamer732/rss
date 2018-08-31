<!DOCTYPE html>
<html>
	<head>
		<title>delete class</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$classCode = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$classCode=$_POST["classCode"];
				$sql="DELETE FROM class WHERE classCode='$classCode'";
				if(!($result=$conn->query($sql)))
					echo "<script type='text/javascript'>alert('Error Deleting')</script>";
				else
					echo "<div class=\"alert alert-success alert-dismissible\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<strong>Successfully Deleted !</strong></div>";					
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
					<li class="active"><a href="delclass.php"><strong>Delete Class</strong></a></li>
					<li><a href="delquota.php"><strong>Delete Quota</strong></a></li>
					<li><a href="delfareinfo.php"><strong>Delete Fare Info</strong></a></li>
					<li><a href="deltrainroute.php"><strong>Delete train-route</strong></a></li>
					<li><a href="delstationinfo.php"><strong>Delete Station Info</strong></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Delete Class :</p><hr>
					<div class="form-group">
						<label><strong>Select Class :</strong></label>
							<select type="text" class="form-control" name="classCode">
								<?php
									$sql="SELECT classCode,className FROM class";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["classCode"]."\">".$row["classCode"]." - ".$row["className"]."</option>";
									}
									else
										echo "No data available for train type";
								?>
							</select>							
					</div>
				</div>
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
	<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>