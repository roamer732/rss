<?php
	session_start();
	include("config.php");
	if($stmt = $conn->prepare("SELECT userID FROM users WHERE userID = ? AND password = ?")){
		$stmt->bind_param("ss",$_POST["username"],$_POST["password"]);
		$stmt->execute();
		$stmt->store_result();
		$result = $stmt->num_rows;
		$stmt->bind_result($userID);
		$stmt->fetch();
		$stmt->close();

  if($result == 1){
    $_SESSION["username"] = $userID; 
	if($userID=="admin"&&$_POST["password"]=="master123")
		header("LOCATION:adminpanel.php");
	else
		header("LOCATION:userhome.php");
  }
  else 
	header("LOCATION:index.php?q=*Invalid username or password");
}
?>