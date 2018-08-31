<?php
	include("config.php");
	$username=$_POST["username"];
	$password=$_POST["password"];
	$firstname=$_POST["firstname"];
	$middlename=$_POST["middlename"];
	$lastname=$_POST["lastname"];
	$gender=$_POST["gender"];
	$dob=$_POST["dob"];
	$num=$_POST["num"];
	$email=$_POST["email"];
	$city=$_POST["city"];
	$state=$_POST["state"];
	$sql= "insert into users values ('$username','$password','$firstname','$middlename','$lastname','$gender','$dob','$city','$state','$num','$email')";
	if($conn->query($sql))
		header("LOCATION:index.php?p=SignUp Successful !");
	else
		echo "Error";

 ?>
 