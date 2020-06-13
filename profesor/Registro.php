<?php
require('../config/php/conexion.php');
$Correo = $_POST["Correo"];
$Password = $_POST["Password"];
$ConfirmaPassword = $_POST["ConfirmaPassword"];
session_start();

if ($Password == $ConfirmaPassword) {
  $sql = "INSERT INTO profesor (Correo, Password) VALUES ('$Correo', '$Password')";
  $query = $conn->exec($sql);
  $_SESSION['mensaje_exito'] = 'Usuario registrado';
  header("location:registro_profesor.php");
} else {
  $_SESSION['correo'] = $_POST["Correo"];
  $_SESSION['contraseña'] = $_POST["Password"];
  $_SESSION['mensaje_error'] = 'Las contraseñas no coinciden';
  header("location:registro_profesor.php");
}
