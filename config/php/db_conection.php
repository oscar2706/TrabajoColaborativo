<?php
	function OpenCon()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$myDB = "tc";
		$conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	}

	function CloseCon($conn)
	{
		$conn =null;
	}
?>
