<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TRAININFO</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="header.css">
		<link rel="stylesheet" type="text/css" href="trainInfoCss.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

		<?php
		include("header.php");
		include("config.php");
		if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
			header("LOCATION:logout.php");
		?>
		
		<script src="routeForm.js"></script>
		<script src="trainInfoJS.js"></script>
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
					<li class="active"><a href="trainInfo.php"><p id="fontID">Add Train Info<p></a></li>
					<li><a href="addtrainclassquota.php"><p id="fontID">Add class in Train Info<p></a></li>
					<li><a href="addNewClass.php"><p id="fontID">Add Class<p></a></li>
					<li><a href="addNewQuota.php"><p id="fontID">Add Quota<p></a></li>
					<li><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<form method="POST" class="form-horizontal" action="trainInfoUtil.php">
				<div class="jumbotron">
					<strong><p id="title">Train Info :</p></strong><hr>
					
					<div class="form-group">
						<label><strong>Train Number :</strong></label>
							<input type="text" class="form-control" name="trainNum" maxlength="5" size="5" required>
					</div>
					
					<div class="form-group">
						<label><strong>Train Name :</strong></label>
							<input type="text" class="form-control" name="trainName" onkeydown="upperCase(this)" required>
					</div>
					
					<div class="form-group">
						<label><strong>Source Station Code :</strong></label>
							<input type="text" class="form-control" id="srcId" value="" name="source" maxlength="4" size="4" onkeydown="upperCase(this)" required>
					</div>
					<div class="form-group">
						<label><strong>Source Station Name :</strong></label>
							<input type="text" class="form-control" id="srcNameId" value="" name="sourceName" onkeydown="upperCase(this)" required>
					</div>
					<div class="form-group">
						<label><strong>Destination Station Code :</strong></label>
							<input type="text" class="form-control" id="dstId" name="dest" maxlength="4" size="4" onkeydown="upperCase(this)" required>
					</div>
					<div class="form-group">
						<label><strong>Destination Station Name :</strong></label>
							<input type="text" class="form-control" id="dstNameId" name="destName" onkeydown="upperCase(this)" required>
					</div>
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
					</div>
				</div>
			
				<hr>
				<div class="jumbotron well well-sm">
				<strong><p id="title">Select Class</p></strong><hr>
					<?php
						$sql="SELECT * From class";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$i=0;
							while($row=$result->fetch_assoc()){
							echo "<label class=\"containerSelect\"><input type=\"checkbox\" onclick=\"check(this.id)\" id=\"".$i."\" class=\"classCoachNum\" name=\"class[]\" value=\"".$row["classCode"]."\"> ".$row["className"]."<span class=\"checkmark\"></span></label><br>";
							echo "<input type=\"text\" class=\"classField\" id=\"classInputId".$i."\" placeholder=\"Enter no. of coaches\" name=\"coachNum[]\" ><hr id=\"hrId\">";
							$i++;
							}
						}
					?>
				</div>
				
				<hr>
				<div class="jumbotron well well-sm">
					<strong><p id="title">Select Running Day</p></strong><hr>
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Sunday"> Sunday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Monday"> Monday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Tuesday"> Tuesday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Wednesday"> Wednesday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Thursday"> Thursday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Friday"> Friday<br>
						<span class="checkmark"></span>
					</label>
					
					<hr id="hrId">
					<label class="containerSelect" id="dayId">
						<input type="checkbox" name="day[]" value="Saturday"> Saturday<br>
						<span class="checkmark"></span>
					</label>
					<hr id="hrId">
				</div>
				
				<div class="jumbotron">
					<p id="p_id"></p>
					<div id="id_">
						<strong><p id="title">Enter number of Halts :</p></strong> 
						<hr>
						<input type="number" name="num" id="snum" onkeypress="return isNumeric(event)" maxLength="3" oninput="maxLengthCheck(this)">
						<input type="button" value="click" onclick="routeForm()">
					</div>
					<span id="span_id"></span>
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
