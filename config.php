<?php
 
	$conn=new mysqli("localhost","root","","rrs");
	
	if(mysqli_connect_errno()){
		printf("Connection failed: %s\n",mysqli_connect_errno());
		exit();
	}
?>