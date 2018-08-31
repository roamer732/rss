<html>
	<head>
		<meta charset="utf-8">
		<title>Online Indian Railway Reservation System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="header.css">
		
		<style>
			body {font-family: Arial, Helvetica, sans-serif;}
			form {border: 3px solid #f1f1f1;}

			input[type=text], input[type=password] {
				position:absolute;
			width: 20%;
			padding: 9px 20px;
			margin: -38px 0px 20px 207px;
			display: inline-block;
			border: 1px solid grey;
			border-radius:18px;
			box-sizing: border-box;
			}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}


.container {
    padding: 16px;
}

	#titleID{
		margin:25px 0px 0px 48px;
		color: black;
		font-size:26px;
	}
	
	.btn{
		width:7%;
		margin:26px 363px;
	}
	#test1{
		margin:20px 0px 0px 735px;
		position:absolute;
	}
	#test2{
		margin:20px 0px 0px 0px;
		position:absolute;
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
					<strong><p id="navbarHeader">Welcome !</p></strong>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="#"><p id="fontID">Home<p></a></li>
					<li class="active"><a href="#"><p id="fontID">Services<p></a></li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: white">
							<b>Enquiries</b> 
							<b class="caret"></b>
						</a> 
						<ul class="dropdown-menu">
							<li> <a href="checkPnr.php">Check PNR Status</a></li>
							<li> <a href="train_schedule.php">Find Train Schedule</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	<div class="container">
		<div class="jumbotron">
			<div class="loginbox">
			<p id="title">Login Here</p><hr style="border:solid">
				<form action="confirm.php" method="POST">
					<p id="titleID">User name :</p>
					<input type="text" name="username" style="color:black" placeholder="Enter Username" autocomplete="off" required="true">
					<p id="titleID">Password :</p>
					<input type="password" name="password" style="color: black" placeholder=" Enter password" required="true">
					<button type="submit" class="btn btn-success">Login</button>
					<?php
						if (!empty($_GET["q"]))
								echo "<p style=\"color:red;font-size:15px;margin-left:25px\">".$_GET["q"]."</p>";

						if (!empty($_GET["p"]))
								echo "<p style=\"color:red;font-size:15px;margin-left:25px\">".$_GET["p"]."</p>";
					?>
					<br>
					<p id="test1"><a href="#" style="color: black"><b>Forgot your password?</a> </p>
					<p id="test2"><a href="registration.html" style="color: black"><b>Don't have an account?</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>
	<hr>
	<footer id="footerId">
		<p id="footerId1">Copyright © 2018 - www.oirrs.co.in. All Rights Reserved</p>
		<p id="footerId2">Designed and Hosted by hitech Corp.</p>
	</footer>	
	</body>
</html> 