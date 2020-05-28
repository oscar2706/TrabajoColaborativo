<?php
include 'Conexion.php';
    $Correo = $_POST["Correo"];
    $Password = $_POST["Password"];

    $insetar = "INSERT INTO profesor (Correo, Password) VALUES ('$Correo', '$Password')";
    $resultado = mysqli_query($conexion, $insetar);
    if (!$resultado){
      echo 'Error al registrarse';

    }else {
      header("location:cursos.html");
    }
    mysqli_close($conexion);
?>