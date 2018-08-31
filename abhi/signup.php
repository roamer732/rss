<?php
$host="localhost";
$user="root";
$pass="";
$db="rrs";
$conn=mysqli_connect($host,$user,$pass,$db);
if(!$conn)
	die("couldn't connect");

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
 $sql= "insert into users values ('$username','$password','$firstname','$middlename','$lastname','$gender','$dob','$num','$email','$city','$state')";
 
 if(mysqli_query($conn,$sql))
	 echo 'registration successful';
 else
	 echo 'there is some error';
 ?>
 