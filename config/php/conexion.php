<?php
try {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "mydb";
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOexception $e) {
  echo "ERROR: " . $e->getMessage();
}
