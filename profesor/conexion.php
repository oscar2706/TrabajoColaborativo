<?php
	
	try{
		$conn = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
		
		
	}catch(PDOexception $e){
		echo"ERROR: ".$e->getMessage();
	}



?>