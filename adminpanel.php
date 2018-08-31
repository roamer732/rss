<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			include("config.php");
			include("header.php");
			if($_SESSION["username"]!="admin"&&$_SESSION["password"]!="master123")
				header("LOCATION:logout.php");
		?>
		
		<meta charset="utf-8">
		<title>Admin Panel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		<script>
			$(document).ready(function(){
				$("#flip1").click(function(){
					$("#panel2").slideUp("slow");
					$("#panel3").slideUp("slow");
					$("#panel1").slideDown("slow");
				});
			});
			
			$(document).ready(function(){
				$("#flip2").click(function(){
					$("#panel1").slideUp("slow");
					$("#panel3").slideUp("slow");
					$("#panel2").slideToggle("slow");
				});
			});
				$(document).ready(function(){
				$("#flip3").click(function(){
					$("#panel1").slideUp("slow");
					$("#panel2").slideUp("slow");
					$("#panel3").slideToggle("slow");
				});
			});
			
			function forClassQuota(str){
				
				if(str=="cqmb3")
				 window.location="addNewClass.php";
				else if(str=="cqmb2")
				 window.location="addNewQuota.php";
				else
				 window.location="addtrainclassquota.php";
			}
		</script>
		<style>
			div.container{
				background-color:#f3f4ed;
				margin: 35px 50px 0px 78px;
				height: 500px;
				width: 88%;
				border-radius: 25px;
				background: url(6359219226453491021470707808_train.jpg) no-repeat;
				background-size: 1187px 500px;
			}
			
			.row{
				background-color:#e0fce8;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				border-radius: 25px;
			}

			.r1,.r2,.r3{
				margin-right: 60px;
				margin-left: 670px;
			}
			
			.r1{
				margin-top: 85px;
			}
			
			.r2{
				margin-top: 10px;
				margin-bottom: 10px;
			}
			
			.r3{
				margin-bottom: 50px;
			}
			
			.col-sm-4{
				margin-right:10px;
				margin-left:10px;
				padding: 10px 10px 10px 10px;
				width: 324px;
			}
			
			a:link {
				color: green;
				background-color: transparent;
				text-decoration: none;
			}
			
			a:hover {
				color: red;
				background-color: transparent;
				text-decoration: underline;
			}
			
			a:active {
				color: yellow;
				background-color: transparent;
				text-decoration: underline;
			}
			
			#panel1,#panel2,#panel3 {
				padding:10px;
				display: none;
				margin-right:10px;
			}
			
			#p{
				border-style: outset;
				display: inline-block;
				border-radius: 4px;
				background-color: #1a4f00;
				color: white;
				transition: 0.7s;
				cursor: pointer;
				width:277px;
				height:31px;
			}
			
			.logOutButton{
				display: inline-block;
				border-radius: 4px;
				background-color: #f4511e;
				border: none;
				color: white;
				text-align: center;
				font-size: 20px;
				padding: 2px;
				width: 100px;
				transition: 0.5s;
				cursor: pointer;
				position:absolute;
				margin: -27px 10px 10px 880px;
			}
			
			.logOutButton:hover {opacity: 0.7}
			#p:hover {opacity: 0.7}
			
			
			div.classQuotaModelBody{
				background-color:#f3f4ed;
				margin: 5px 50px 5px 55px;
				height: 500px;
				width: 80%;
				border-radius: 25px;
				background-size: 1075px 501px;
			}
			
			#cqmb1,#cqmb2,#cqmb3{
				margin-left:50px;
				padding-top:11px;
				height: 70px;
				width: 60%;
				position:absolute;
				font-size: 20px;
				text-align:center;
				transition:0.5s;
				cursor:pointer;
				background-color:#3ba308;
			}
			
			#cqmb1{
				margin-top:120px;
			}
			
			#cqmb2{
				margin-top:205px;
			}
			#cqmb3{
				margin-top:36px;
			}
			#cqmb3:hover {opacity: 0.7}
			#cqmb2:hover {opacity: 0.7}
			#cqmb1:hover {opacity: 0.7}
		</style>
	</head>
	
	<body>	
	<header id="headerId">
    <h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
    <h3 id="headerTitle2">An online portal to reserve your seat</h3>
    <p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
	<strong><h1 id="headerTitle4">OIRRS</h1></strong>
  </header>
  
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <strong><p id="navbarHeader">Welcome Admin !</p></strong>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Change password</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </div>
</nav>
	
	<script>
		
			
	</script>
	<div class="container">
			<div id="divId">
			<div class="r1">
				<div class="row">
					<div class="col-sm-4" id="flip1" style="font-size:18px; font-weight: bold;">ADD
					<div id="panel1">
						<button id="p" onclick="window.location.href='trainInfo.php'">Add Train Information</button>
						<button id="p" data-toggle="modal" data-target="#classQuotaModel">Add Class-Quota</button>
							<div id="classQuotaModel" class="modal fade" role="dialog">
								<div class="modal-dialog .modal-lg">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title"><strong>Add Class-Quota</strong></h4>
										</div>
										<div class="modal-body">
											<div class="classQuotaModelBody">
												<div onclick="forClassQuota()" class="row" id="cqmb1">
													<p style="color:white;"><strong>Add new class-Quota to a train information</strong></p>
												</div>
			
												<div onclick="forClassQuota(this.id)" class="row" id="cqmb2">
													<p style="color:white;"><strong>Add a new Quota to database</strong></p>
												</div>
												<div onclick="forClassQuota(this.id)" class="row" id="cqmb3">
													<p style="color:white;"><strong>Add a new class to database</strong></p>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" style="background-color: #f4511e;color:white;" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						<button id="p" onclick="window.location.href='addFare.php'">Add Fare Information</button>
						<button id="p" onclick="window.location.href='addNewRoute.php'">Add a new station in Route</button>
						<button id="p" onclick="window.location.href='addNewStation.php'">Add Station Information</button>
					</div>
					</div>
				</div>
			</div>
			
			<div class="r2">
				<div class="row">
					<div class="col-sm-4" id="flip2" style="font-size:18px; font-weight: bold;">UPDATE
					<div id="panel2">
						<button id="p" onclick="window.location.href='updatetrainInfo.php'">Update Train Information</button>
						<button id="p" onclick="window.location.href='updatetrainclass.php'">Update Train Class</button>
						<button id="p" onclick="window.location.href='updatefareinfo.php'">Update Fare Information</button>
						<button id="p" onclick="window.location.href='updatestationinfo.php'">Update Station Information</button>
					</div>
					</div>
				</div>
			</div>
			
			<div class="r3">
				<div class="row">
					<div class="col-sm-4" id="flip3" style="font-size:18px; font-weight: bold;">DELETE
					<div id="panel3">
						<button id="p" onclick="window.location.href='deltrainInfo.php'">Delete Train Information</button>
						<button id="p" onclick="window.location.href='deltrainclass.php'">Delete a Class from Train</button>
						<button id="p" onclick="window.location.href='delclass.php'">Delete Class</button>
						<button id="p" onclick="window.location.href='delquota.php'">Delete Quota</button>
						<button id="p" onclick="window.location.href='delfareinfo.php'">Delete Fare Information</button>
						<button id="p" onclick="window.location.href='deltrainroute.php'">Delete Train Route</button>
						<button id="p" onclick="window.location.href='delstationinfo.php'">Delete Station Information</button>
					</div>
					</div>
				</div>
			</div>
			
			<button class="logOutButton" onclick="window.location.href='logout.php'">logout</button>
		</div>
	</div>
<hr>	
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>
	</body>
</html>