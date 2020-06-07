<?php
	
	try{
		$conn = new PDO('mysql:host=localhost:3306;dbname=tc', 'root', '');
		
		
	}catch(PDOexception $e){
		echo"ERROR: ".$e->getMessage();
	}



?>