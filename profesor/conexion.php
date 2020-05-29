<?php
	
	try{
		$conn = new PDO('mysql:host=localhost;dbname=tc', 'root', '');
		
		
	}catch(PDOexception $e){
		echo"ERROR: ".$e->getMessage();
	}



?>