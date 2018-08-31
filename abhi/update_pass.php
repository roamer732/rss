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
  		var newpass=document.getElementById("newpass");
  		var conpass=document.getElementById("conpass");
  		if(newpass!=conpass)
  		{
  			document.getElementById("conf").innerHTML="**Password Does not match";
  			return false;
  		}

  	}
  </script>
</head>
<body>

	<div class="container">
		<div class="btn-primary" style="margin-top:15px;padding: 12px;">Change Password</div>


    <form class="well form-horizontal" action="" method="post"  id="update_form" onsubmit="return validation()">

  <div class="form-group">
  <label class="col-md-4 control-label">Old Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="old" placeholder="Old Password" class="form-control"  type="text" id="oldpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="oldpassword" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">New Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="new" placeholder="New Password" class="form-control"  type="text" id="newpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="newpassword" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Confirm Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="confirm" placeholder="Confirm Password" class="form-control"  type="text" id="conpass" required="true" autocomplete="off" minlength="6" maxlength="10">
  <span id="conf" class="text-danger font-weight-bold"></span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>





</body>
</html>