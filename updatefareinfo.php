<!DOCTYPE html>
<html>
	<head>
		<title>Update fare</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$trainType = $classCode = $trainFare = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$trainType=$_POST["trainType"];
				$classCode=$_POST["classCode"];
				$trainFare=$_POST["trainFare"];
				$sql="UPDATE fareinfo SET farePerKM='$trainFare' WHERE classCode='$classCode' AND trainType='$trainType'";
				if(!($result=$conn->query($sql)))
					echo "<script type='text/javascript'>alert('Error getting seats number per Coach')</script>";
				else
					echo "<div class=\"alert alert-success alert-dismissible\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<strong>Successfully Updated !</strong></div>";					
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
			
			p.serif {
				font-family: "Times New Roman", Times, serif;
				color:green;
				font-size:33px;
				position:absolute;
				margin:0px 32px;
			}
			
			.well{
				height:70px;
			}
			
			#trainType,#trainClass{	
				width:218px;
				margin:-31px 94px 0px 143px;
			}
			#inputField{
				width:218px;
				margin:-32px 143px;
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
					<li><a href="updatetrainInfo.php"><strong>Update Train Information</strong></a></li>
					<li><a href="updatetrainclass.php"><strong>Update Train Class</strong></a></li>
					<li class="active"><a href="updatefareinfo.php"><strong>Update Fare Information</strong></a></li>
					<li><a href="updatestationinfo.php"><strong>Update Station Information</strong></a></li>
				</ul>
			</div>
		</nav>
	
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Update Fare Info :</p><hr>
					<div class="form-group">
						<label><strong>Select Train Type :</strong></label>
							<select id="trainType" type="text" class="form-control" name="trainType">
								<option value="">-</option>
								<?php
									$sql="SELECT type FROM traintype";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["type"]."\">".$row["type"]."</option>";
									}
									else
										echo "No data available for train type";
								?>
							</select>							
					</div>
					<div class="form-group">
						<label><strong>Select Train Class :</strong></label>
							<select id="trainClass" type="text" class="form-control" name="classCode">
								<option value="">-</option>
								<?php
									$sql="SELECT classCode,className FROM class";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["classCode"]."\">".$row["className"]."</option>";
									}
									else
										echo "No data available for train type";
								?>
							</select>							
					</div>
					<div id="txtHint"></div>
					<script>
						$(document).ready(function(){
							$("#trainClass").change(function(){
								var str1=document.getElementById("trainType").value;
								var str2=document.getElementById("trainClass").value;
								var str=(str1.concat(".")).concat(str2);
								//alert(str);
								var xhttp;
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("txtHint").innerHTML = this.responseText;
									}
								};
								xhttp.open("GET", "updatefareinfoutil.php?q="+str, true);
								xhttp.send();
							});
						});
					</script>
				</div>
				<button type="submit" class="btn btn-success">Update</button>
			</form>
	</div>
	<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>