<!DOCTYPE html>
<html>
	<head>
		<title>Update Train Class</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$trainNum = $trainClass = $numOfCoach = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$trainNum=$_POST["trainNum"];
				$classCode=$_POST["classCode"];
				$numOfCoach=$_POST["numOfCoach"];
				echo $numOfCoach." ".$trainNum;
				$sqlToGetBirthNumber="SELECT quotaCode,seatsPerCoach FROM quotasinclass WHERE classCode='$classCode'";
				if(!($result=$conn->query($sqlToGetBirthNumber)))
					echo "<script type='text/javascript'>alert('Error getting seats number per Coach')</script>";
				
				while($row=$result->fetch_assoc()){
					$num=$numOfCoach*$row["seatsPerCoach"];
					$quotaCode=$row["quotaCode"];
					$sqlToUpdateSeats="UPDATE seatsavailinfo SET numOfSeats='$num' WHERE classCode='$classCode' AND quotaCode='$quotaCode' AND train_ID IN 
											(SELECT train_ID FROM `traindate` WHERE trainNum='$trainNum')";
					if(!($conn->query($sqlToUpdateSeats))){
						echo "<script type='text/javascript'>alert('failed!')</script>";
						break;
					}
				}
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
			#trainInfoID{	
				width:531px;
				margin:21px 94px 0px 15px;
			}
			#hideInputField{
				display:none;
				margin:0px -14px;
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
					<li class="active"><a href="updatetrainclass.php"><strong>Update Train Class</strong></a></li>
					<li><a href="updatefareinfo.php"><strong>Update Fare Information</strong></a></li>
					<li><a href="updatestationinfo.php"><strong>Update Station Information</strong></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Update Train Class :</p><hr>
					<div class="form-group">
						<label><strong>Select Train :</strong></label>
							<select id="trainNumID" type="text" class="form-control" name="trainNum">
								<option value="">-</option>
								<?php
									$sql="SELECT trainNum FROM train";
									$result=$conn->query($sql);
									if($result->num_rows>0){
										while($row=$result->fetch_assoc())
											echo"<option value=\"".$row["trainNum"]."\">".$row["trainNum"]."</option>";
									}
									else
										echo "No data available for train class";
								?>
							</select>
							<div id="txtHint"></div>
							<script>
								$(document).ready(function(){
									$("#trainNumID").change(function(){
										var str=document.getElementById("trainNumID").value;
										var xhttp;
										xhttp = new XMLHttpRequest();
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
												document.getElementById("txtHint").innerHTML = this.responseText;
											}
										};
										xhttp.open("GET", "updatetrainclassutil.php?q="+str, true);
										xhttp.send(); 
									});
								});
								
								function displayClassInputField(){
									var x=document.getElementById("hideInputField");
									x.style.display="block";
								}
							</script>
					</div>
					
					<script>					
					function isNumeric(evt) {
						var theEvent = evt || window.event;
						var key = theEvent.keyCode || theEvent.which;
						key = String.fromCharCode (key);
						var regex = /[0-9]|\./;
						if ( !regex.test(key) ) {
							theEvent.returnValue = false;
						if(theEvent.preventDefault) theEvent.preventDefault();
						}
					}
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