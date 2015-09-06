<?php
	session_start();
	$serverName = '127.0.0.1';
	$username = 'root';
	$password = 'root123';


	$conn =  new mysqli($serverName, $username, $password);
	mysqli_select_db($conn, 'ShopBuddy'); 
	$_SESSION["dbConnection"] = $conn; 

	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	echo "connected";
?>
