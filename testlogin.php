<!DOCTYPE html>
<html>
    <head>
		<title>
			ONLINE RAILWAY RESERVATION
		</title>
		
		<style>
		/* Bordered form */
		form {
			border: 3px solid red;
			margin: 0px 130px 0px 4px;
			padding: 0px 0px 293px 34px;
		}

		div.headSection{
			border: 3px solid #f1f1f1;
			padding: 10px;
		margin: 70px 0px 0px 0px;
		}

		div.loginPanel{
			border: solid green;
			margin: 11px 115px;
			padding: 68px 435px 265px 24px;
		}

		div.fairChartSection{
			text-align: center;
			margin: 0px 0px 0px 0px;
			padding: 0px 0px 0px 0px;
		}

		/* Full-width inputs */
		input[type=text], input[type=password] {
			width: 300px;
			padding: 8px 12px;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		/* Input buttons section */
			input.i1{
			margin: 8px 8px 8px 12px;
		}
		input.i2{
			margin: 8px 8px 8px 12px;
		}

		/* Set a style for all buttons */
		button.loginButton{
			background-color: #4CAF50;
			color: white;
			margin: 8px 10px 8px 62px;
			border: none;
			cursor: pointer;
		}	

		button.signUpButton{
			background-color: red;
			color: white;
			padding: 10px 15px;
			margin: 5px 8px 8px 130px;
			border: none;
			cursor: pointer;
		}
		
		/* Add a hover effect for buttons */
		button:hover {
		opacity: 0.8;
		}

		/* Center the avatar image inside this container */
		div.imgContainer {
			text-align: center;
			margin:0px 0px 0px 0px;
			padding:0px 0px 0px 0px;
		}

		/* Avatar image */
		img.avatar {
			width: 100px;
			border-radius: 200px;
			margin: 18px 20px 0px -10px;
		}

		/* Add padding to containers */
		.container {
		padding: 15px;
		}

		/* The "Forgot password" text */
		span.psw {
			float: left;
			padding-top: 0px;
		}
		
		div.con{
			margin:8px -4px 0px -38px;
			padding:11px 0px 15px 40px;
		
		}
		</style>
			
	</head>
	
	<body> 
	
	<div class="headSection" >ONLINE RAILWAY RESERVATION SYSTEM</div>
	<hr>
	
	<div class="loginPanel">
	<form method="POST" action="confirm.php" >
	
		<div class="imgContainer">
			<img src="img_avatar2.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
			<label><b>Username : </b></label>
			<input type="text" class="i1" placeholder="Enter Username" name="username" required>
            <br>
			<label><b>Password :  </b></label>
			<input type="password" class="i2" placeholder="Enter Password" name="password" required>
            <br>
			<button type="submit" class="loginButton" name="submit">Login</button>
			<br>
			<label>
				<input type="checkbox" checked="checked"> Remember me
			</label>
		</div>
        
		<div class="con" style="background-color:#f1f1f1">
			<span class="psw">Forgot <a href="#">password ?</a> OR sign up to create new account</span>
		<button class="signUpButton" onclick="location.href='signup.php';">SIGN UP</button>
		</div>
	</div>
	</form>
	
	<div class="fairChartSection" style="background-color:#f1f1f1"><a href="fareChart.php">fare chart</a> </div>
	</body>
</html>
	    