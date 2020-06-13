<?php
include '../config/php/conexion.php';

$Matricula = $_POST["Matricula"];
$Nombre = $_POST["Nombre"];
$Correo = $_POST["Correo"];
$Password = $_POST["Password"];
$ConfirmaPassword = $_POST["ConfirmaPassword"];
session_start();

if ($Password == $ConfirmaPassword) {
  try{
    $sql = "INSERT INTO alumno (Matricula, Nombre, Correo, Password) VALUES ('$Matricula', '$Nombre','$Correo', '$Password')";
    $query = $conn->exec($sql);
    $_SESSION['mensaje_exito'] = 'Usuario registrado';
  } catch (PDOexception $e){
    $_SESSION['mensaje_error'] = 'Esta matricula ya esta registrada';
  }
  header("location:registro_estudiante.php");
} else {
  $_SESSION['matricula'] = $_POST["Matricula"];
  $_SESSION['nombre'] = $_POST["Nombre"];
  $_SESSION['correo'] = $_POST["Correo"];
  $_SESSION['password'] = $_POST["Password"];
  $_SESSION['mensaje_error'] = 'Las contraseñas no coinciden';
  header("location:registro_estudiante.php");
}
