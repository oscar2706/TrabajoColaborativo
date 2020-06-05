<?php
require 'conexion.php';

try {
  session_start();
  if (isset($_POST['bye'])) {
    session_destroy();
    echo 'Correct_Bye';
  } else {
    $email = $_POST['Correo'];
    $password = $_POST['Contraseña'];

    $query = $conn->prepare("SELECT count(idProfesor) as total, idProfesor, correo FROM profesor 
                    WHERE correo = '" . $email . "' AND password  = '" . $password . "' ");
    $query->execute();
    $registro = $query->fetch(PDO::FETCH_OBJ);

    if ($registro->total == 1) {
      $_SESSION['userid'] = $registro->idProfesor;
      echo 'Login Correct';
      $conn = null;
    } else {
      echo 'Contraseña o usuario incorrecto';
      $conn = null;
    }
  }
} catch (PDOException $e) {
  echo $query . "<br>" . $e->getMessage();
  $conn = null;
}
