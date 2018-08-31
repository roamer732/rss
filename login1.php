<html>
<head>
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<link rel="stylesheet" href="header.css">
	</head>   
    <body>
	<header id="headerId">
    <h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
    <h3 id="headerTitle2">An online portal to reserve your seat</h3>
    <p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
	<strong><h1 id="headerTitle4">OIRRS</h1></strong>
  </header>
    <nav class="navbar" style="width:100%;background-color: #009688">
                <div class="container">
         <ul class="nav navbar-nav" style="margin: auto;">
                <li> <a href="#" style="color: black"><b>Home</b></a> </li>
                <li> <a href="#" style="color: black"><b>Services</b></a> </li>
        <li class="dropdown">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b>Enquiries</b> 
                <b class="caret"></b></a> 
                <ul class="dropdown-menu">
                <li> <a href="#">Check PNR Status</a></li>
                <li> <a href="train_schedule.php">Find Train Schedule</a></li>
                </ul>
        </li>
  <ul class="nav navbar-nav navbar-right">
      <li>
            <a href="login.html" class="btn btn-lg" style="color: black" name="logout">
            <span class="glyphicon glyphicon-log-in" style="color: black"></span> Log in
           </a>
    </li>
</ul>
</ul>

    <div class="loginbox">
        
        <h1>Login Here</h1>
        <form action="login.php" method="post">
        <p>User name</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="pass" placeholder=" Enter password">
            <input type="submit" name="submitButton" value="Login" class="btn btn-primary">
            <a href="#">Lost your password? </a><br>
            <a href="#">Don't have an account</a>
        </form>
        </div>
    </body>
    </head>
    </html> 