<?php
include 'Conexion.php';
    $Matricula = $_POST["Matricula"];
    $Nombre = $_POST["Nombre"];
    $Correo = $_POST["Correo"];
    $Password = $_POST["Password"];
    $ConfirmaPassword = $_POST["ConfirmaPassword"];

    if($Password == $ConfirmaPassword){
        echo 'correcto';
    }else{
        echo 'error';
    }

    $insetar = "INSERT INTO alumno (Matricula, Nombre, Correo, Password) VALUES ('$Matricula', '$Nombre','$Correo', '$Password')";
    $resultado = mysqli_query($conexion, $insetar);
    if (!$resultado){
      echo 'Error al registrarse';

    }else {
      header("location:equipos.html");
    }
    mysqli_close($conexion);
?>