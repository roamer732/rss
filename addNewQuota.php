<!DOCTYPE html>
<html>
	<head>
		<title>Add Quota</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
			
			$quotaCodeErr = $quotaNameErr = $classErr = $numOfBerthsErr ="";
			$quotaCode = $quotaName = $class = $numOfBerths= "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//form validations
				$flag=true;
				//for quota code
				if (empty($_POST["quotaCode"])){
					$quotaCodeErr = "Quota Code is required";
					$flag=false;
				}
				else 
					$quotaCode = $_POST["quotaCode"];
				
				//quota name
				if (empty($_POST["quotaName"])){
					$quotaNameErr = "Quota Name is required";
					$flag=false;
				}
				else
					$quotaName = $_POST["quotaName"];
				
				//for classes
				if (empty($_POST["class"])){
					$classErr = "Select classes";
					$flag=false;
				}
				else	
					$class=$_POST["class"];
				
				function checkEmpty($str){
					foreach($str as $temp)
						if($temp!="")
							return false;
					return true;
				}
				//for Berth Number
				if (checkEmpty($_POST["berthNum"])){
					$numOfBerthsErr = "Please enter number of Berths";
					$flag=false;
				}
				else
					$numOfBerths= $_POST["berthNum"];
				
				
				//Inserting quota in classwise manner
				if($flag){
					$qsql="INSERT INTO quota VALUES('$quotaCode','$quotaName')";
					if($conn->query($qsql))
						echo "<div class=\"alert alert-success alert-dismissible\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<strong>Successfully Added !</strong></div>";
					else
						echo "<script type='text/javascript'>alert('failed!')</script>";
					
					//Getting values of berths in an php array
					$berthArray=array();
					foreach($numOfBerths as $x)
						if($x!="")
							array_push($berthArray,$x);
					
					
					//Adding new Quota in Selected Class					
					$i=0;
					$stmt=$conn->prepare("INSERT INTO quotasinclass VALUES(?,?,?)");
					foreach($class as $temp){
						$stmt->bind_param("ssi",$quotaCode,$temp,$berthArray[$i]);
						if(!$stmt->execute())
							echo "failed adding quotasinclass";
						
						//getting value of berths of general Quota
						$getGenSeatNum="SELECT seatsPerCoach FROM quotasinclass WHERE quotaCode='GN' AND classCode='$temp'";
						$result=$conn->query($getGenSeatNum);
						$row=$result->fetch_assoc();
						$num=$row["seatsPerCoach"];
						$num=(int)($num)-(int)($berthArray[$i]);
						
						//Updating seats in general quota
						$updateQuery="UPDATE quotasinclass SET seatsPerCoach='$num' WHERE quotaCode='GN' AND classCode='$temp'";
						$conn->query($updateQuery);
						$i++;
					}
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
				
			function check(str){
					var y="classInputId"+str;
					var x=document.getElementById(y);
					if(x.style.display==="inline-block")
						x.style.display="none";
					else
						x.style.display="inline-block";
				}
		</script>
		
		<style>
			
			.containerSelect {
				display: block;
				position: relative;
				padding-left: 31px;
				margin-top:-11px;
				margin-bottom:-28px;
				cursor: pointer;
				font-size: 14px;
				margin-left:51px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			.containerSelect input {
				position: absolute;
				opacity: 0;
				cursor: pointer;
			}

			.checkmark {
				position: absolute;
				top: 0;
				left: 0;
				height: 20px;
				width: 20px;
				background-color: #eee;
			}

			.containerSelect:hover input ~ .checkmark {
				background-color: #ccc;
			}

			.containerSelect input:checked ~ .checkmark {
				background-color: #2196F3;
			}

			.checkmark:after {
				content: "";
				position: absolute;
				display: none;
			}

			.containerSelect input:checked ~ .checkmark:after {
				display: block;
			}

			.containerSelect .checkmark:after {
				left: 9px;
				top: 5px;
				width: 5px;
				height: 10px;
				border: solid white;
				border-width: 0 3px 3px 0;
				-webkit-transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				transform: rotate(45deg);
			}
			
			.form-control{
				position:absolute;
				margin: -34px 103px;
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
				margin:-3px 293px;
				color: #FF0000;
			}
			
			#numOfBerthsID{
				width:80px;
			}
			
			#numOfBerthsErr{
				margin:0px 112px;
			}
			
			.classField{
				margin: -18px 0px 0px 262px;
				width:255px;
				padding:6px 40px;
				position: absolute;
				border-radius:4px;
				border: 1px solid #ccc;
				display: none;
				box-sizing: border-box;
			}
					
			.quotaClass{
				padding:0px 38px;
				font-size:18px;
			}
			
			#classErrID{
				position:absolute;
				margin:-37px 486px;
				font-size:20px;
			}
			
			#berthNumErrID{
				position:absolute;
				margin:-37px 48px;
				font-size:20px;
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
					<li class="active"><a href="addNewQuota.php"><p id="fontID">Add Quota<p></a></li>
					<li><a href="addFare.php"><p id="fontID">Add Fare<p></a></li>
					<li><a href="addNewRoute.php"><p id="fontID">Add new station in route<p></a></li>
					<li><a href="addNewStation.php"><p id="fontID">Add Station<p></a></li>
				</ul>
			</div>
		</nav>
		
	<div class="container">
			<div class="jumbotron">
				<p id="title">Train Info :</p><hr>
					<?php
						$sql="SELECT * From quota";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$i=1;
							while($row=$result->fetch_assoc()){
								echo "<label class=\"quotaClass\">".$i.". ".$row["quotaCode"]." - ".$row["quotaName"]."</label><br>";
								$i++;
							}
						}
					?>
			</div>
			
			<form method="POST" class="form-horizontal">
				<div class="jumbotron">
					<p id="title">Add Quota :</p><hr>
					<div class="form-group">
						<label><strong>Quota Code :</strong></label>
							<input type="text" class="form-control" name="quotaCode" maxlength="5" size="5" onkeydown="upperCase(this)" >
							<span class="error"><?php echo "*".$quotaCodeErr;?></span>
					</div>
					
					<div class="form-group">
						<label><strong>Quota Name :</strong></label>
							<input type="text" class="form-control" name="quotaName" onkeydown="upperCase()" >
							<span class="error"><?php echo "*".$quotaNameErr;?></span>
					</div>
				</div>
				<div class="jumbotron well well-sm">
					<span id="classErrID" class="error"><?php echo "*".$classErr;?></span>
					<span id="berthNumErrID" class="error"><?php echo "*".$numOfBerthsErr;?></span>
					<p id="title">Select Classes in which Quota is to be included :</p><hr>
					<?php
						$sql="SELECT * From class";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$i=0;
							while($row=$result->fetch_assoc()){
							echo "<label class=\"containerSelect\"><input type=\"checkbox\" onclick=\"check(this.id)\" id=\"".$i."\" class=\"classCoachNum\" name=\"class[]\" value=\"".$row["classCode"]."\"> ".$row["className"]."<span class=\"checkmark\"></span></label><br>";
							echo "<input type=\"text\" class=\"classField\" id=\"classInputId".$i."\" placeholder=\"Enter no. of berths\" name=\"berthNum[]\"><hr id=\"hrId\">";
							$i++;
							}
						}
					?>
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