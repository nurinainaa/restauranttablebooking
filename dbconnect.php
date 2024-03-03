<?php	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "restaurantdb2";
	
	// Create connection_aborted
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Chec cnnection
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";
?>
	