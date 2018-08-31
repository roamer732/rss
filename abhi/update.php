<?php
$host="localhost";
$user="root";
$pass="";
$db="rrs";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn)
	die("couldn't connect");

$userid=$_POST["username"];
$new=$_POST["pass"];
$confirm=$_POST["conf_pass"];

if($confirm!=$new)
	echo "password doesn't match";
else
{
$sql= "update users set password='$new' where user_id='$userid' " ;

$ret=mysqli_num_rows(mysqli_query($conn,$sql));

 if($ret>0)
{
	 echo "password updated successfully";
  echo $sql;
}
 else 
	 echo "there is some error, password is not updated";
}
?>
