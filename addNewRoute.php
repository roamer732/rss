<!DOCTYPE html>
<html>
	<head>
		<title>Add New Route</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$stopNumErr = $stationCodeErr = $arrErr = $depErr= $distErr= "";
			$stopNum = $stationCode = $arr = $dep = $dist = $trainNum= "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$flag=true;
				//for stationCode code
				if (empty($_POST["stationCode"])){
					$stationCodeErr = "Station Code is required";
					$flag=false;
				}
				else 
					$stationCode = $_POST["stationCode"];
				
				//for stop Number
				if (empty($_POST["stopNum"])){
					$stopNumErr = "Stop number is required";
					$flag=false;
				}
					$stopNum = $_POST["stopNum"];
				
				//for arrival time
				if (empty($_POST["arrivalTime"])){
					$arrErr = "Arrival Time is required";
					$flag=false;
				}
				else 
					$arr= $_POST["arrivalTime"];
				
				//for depart time
				if (empty($_POST["departTime"])){
					$depErr = "Departure time is required";
					$flag=false;
				}
					$dep = $_POST["departTime"];
				
				//for distance
				if (empty($_POST["distance"])){
					$distErr = "Distance is required";
					$flag=false;
				}
				else 
					$dist= $_POST["distance"];
				
				$trainNum=$_POST["trainNum"];
				
				if($flag){
					$sqlForRoute="INSERT INTO route VALUES('$stopNum','$trainNum','$stationCode','$arr','$dep','$dist')";
					$sqlForUpdate="UPDATE route SET stopNum=stopNum+1 WHERE stopNum>='$stopNum' AND trainNum='$trainNum'";
					if(!($conn->query($sqlForUpdate)))
						echo "Error updating route";
					if($conn->query($sqlForRoute))
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
				width:235px;
				margin-top:-32px;
				margin-left:160px;
			}
			
			.error{
				position:absolute;
				color: #FF0000;
			}
			
			#error1{
				margin:-3px 308px;
			}
			#error2{
				margin:-3px 310px;
			}
			#error3{
				margin:-3px 316px;
			}
			#error4{
				margin:-3px 295px;
			}
			#error5{
				margin:-3px 339px;
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
			
			#tableID{	
				width:531px;
				margin:-18px 99px 0px 99px;
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
					<li><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li class="active"><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
		<div class="container">
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Add New Route Details in a Train Info :</p><hr>
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
										xhttp.open("GET", "gethintforroute.php?q="+str, true);
										xhttp.send(); 
									});
								});
							</script>
					</div>
					<div class="form-group">
						<label><strong>Stop Number :</strong></label>
							<input type="number" class="form-control" name="stopNum" >
							<span class="error" id="error1"><?php echo "*".$stopNumErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Station Code :</strong></label>
							<input type="text" class="form-control" name="stationCode" maxlength="5" size="5"  onkeydown="upperCase(this)" >
							<span class="error" id="error2"><?php echo "*".$stationCodeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Arrival Time :</strong></label>
							<input type="text" class="form-control" name="arrivalTime" maxlength="5" size="5" onkeypress="return isNumeric(event)" oninput="maxLengthTime(this)" >
							<span class="error" id="error3"><?php echo "*".$arrErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Departure Time :</strong></label>
							<input type="text" class="form-control" name="departTime" maxlength="5" size="5" onkeypress="return isNumeric(event)" oninput="maxLengthTime(this)" >
							<span class="error" id="error4"><?php echo "*".$depErr;?></span>
					</div>
					<script>
						function maxLengthTime(object) {
							setTimeout(function(){
							if((object.value.length==2)&&object.value[object.value.length-1]!=':')
								object.value=object.value.concat(":");
								},1);
				
							if (object.value.length > object.maxLength)
								object.value = object.value.slice(0, object.maxLength)
						}
					
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
					<div class="form-group">
						<label><strong>Distance :</strong></label>
							<input type="text" class="form-control" name="distance" >
							<span class="error" id="error5"><?php echo "*".$distErr;?></span>
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