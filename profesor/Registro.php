<?php
include 'Conexion.php';
    $Correo = $_POST["Correo"];
    $Password = $_POST["Password"];
    $ConfirmaPassword = $_POST["ConfirmaPassword"];
 

    if ($Password == $ConfirmaPassword)
    {
        echo 'correcto';
    }else {
      echo 'incorrecto corrige wey';
    }

    $insetar = "INSERT INTO profesor (Correo, Password) VALUES ('$Correo', '$Password')";
    $resultado = mysqli_query($conexion, $insetar);
    if (!$resultado){
      echo 'Error al registrarse';

    }else {
      header("location:cursos.html");
    }
    mysqli_close($conexion);
?>