<!DOCTYPE html>
<html>
	<head>
		<title>Delete train route</title>
		<?php
			include("header.php");
			include("config.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
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
					<li><a href="adminpanel.php"><strong>Admin Panel</strong></a></li>
					<li><a href="deltraininfo.php"><strong>Delete Train Info</strong></a></li>
					<li><a href="deltrainclass.php"><strong>Delete Train-Class</strong></a></li>
					<li><a href="delclass.php"><strong>Delete Class</strong></a></li>
					<li><a href="delquota.php"><strong>Delete Quota</strong></a></li>
					<li><a href="delfareinfo.php"><strong>Delete Fare Info</strong></a></li>
					<li class="active"><a href="deltrainroute.php"><strong>Delete train-route</strong></a></li>
					<li><a href="delstationinfo.php"><strong>Delete Station Info</strong></a></li>
				</ul>
			</div>
		</nav>
	<div class="container">
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
										xhttp.open("GET", "deltrainrouteutil.php?q="+str, true);
										xhttp.send(); 
									});
								});
							</script>
					</div>
					<script>
						function delTrain(stopNum){
							var trainNum=document.getElementById("trainNumID").value;
							var str=stopNum+"."+trainNum;

							xhttp = new XMLHttpRequest();
							xhttp.open("GET", "delrouteaction.php?q="+str, true);
							xhttp.send();
						}
						
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
				</div>
	</div>
	<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>