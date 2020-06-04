<?php
	function OpenCon()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$myDB = "mydb";
		$conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}

	function CloseCon($conn)
	{
		$conn =null;
	}
