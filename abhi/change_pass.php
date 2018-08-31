<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript">
  	function validation()
  	{
  		var newpass=document.getElementById('newpass').value;
  		var conpass=document.getElementById('conpass').value;
  		if(newpass!=conpass)
  		{
  			document.getElementById("conf").innerHTML="**Password Does not match";
  			return false;
  		}
  		
  	}
  </script>
  <link rel="stylesheet" href="header.css">
</head>
<body>
  <?php session_start(); ?>
   <header id="headerId">
    <h1 id="headerTitle1"><strong>Online Indian Railway Reservation System</strong></h1>
    <h3 id="headerTitle2">An online portal to reserve your seat</h3>
    <p id="headerTitle3">(An organisation of the ministry of Railway, Govt. of India )</p>
  <strong><h1 id="headerTitle4">OIRRS</h1></strong>
  </header>
  <nav class="navbar" style="width:100%;background-color: #009688">
     <div class="navbar-header">
         <strong><p id="navbarHeader" style="margin-left:10px;color: white;">Welcome <?php echo $_SESSION['user_id']?> !</p></strong>
      </div>
        <div class="container-fluid">
       <ul class="nav navbar-nav" style="margin: auto;">
        <li> <a href="userhome1.php" style="color: black"><b>Home</b></a> </li>
        <li class="dropdown" >    
  <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b>Services</b><b class="caret"></b></a>
  <ul class="dropdown-menu">
  <li><a href="userhome1.php">Ticket Booking</a></li>
  <li><a href="userhome1.php">Quick Ticket Booking</a></li>
  <li><a href="userhome1.php">Cancel Ticket</a></li>
  </ul>
  </li>
  <li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b> Enquiries</b> <b class="caret"></b></a> 
<ul class="dropdown-menu">
<li> <a href="checkPnr.php">Check PNR Status</a></li>
<li> <a href="train_schedule.php">Find Train Schedule</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: black"><b> My Profile</b><b class="caret"></b></a>
<ul class="dropdown-menu">
  <li><a href="#">Update Profile</a></li>
  <li> <a href="change_pass.php">Change Password</a> </li>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li>
  <a href="index.php" class="btn btn-lg" style="color: black" name="logout">
      <span class="glyphicon glyphicon-log-out" style="color: black"></span> Log out
      </a>
</li>
</ul>
  </div>
  </nav>

	<div class="container">
		<div class="btn-primary" style="margin-top:-8px;padding: 12px;">Change Password</div>


    <form class="well form-horizontal" action="" method="post"  id="update_form" onsubmit="return validation()">

  <div class="form-group">
  <label class="col-md-4 control-label">Old Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="old" placeholder="Old Password" class="form-control"  type="password" id="oldpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="oldpassword" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">New Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="new" placeholder="New Password" class="form-control"  type="password" id="newpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="newpassword" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Confirm Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="confirm" placeholder="Confirm Password" class="form-control"  type="password" id="conpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="conf" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    <button type="submit" class="btn btn-warning" name="submitbutton"> SUBMIT <span class="glyphicon glyphicon-send"></span> </button>
  </div>
</div>
</form>
  
  <?php
   if(isset($_POST['submitbutton']))
   {
   	include('connection.php');
   	
   	$id=$_SESSION['user_id'];
   $pass=$_POST["new"];
   $old=$_POST["old"];
   $ret=mysqli_fetch_assoc(mysqli_query($con,"select password from users where userID='$id' "))['password'];
   if($ret==$old)
   {
   	
   mysqli_query($con,"update users set password='$pass' where userID='$id' ");
   echo "<span class=\"text-success\"> password updated successfully</span>";
   }
   else
   	echo "Password is not updated";   
   }
  ?>

</div>


</body>
</html>