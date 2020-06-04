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

    $query = $conn->prepare("SELECT count(matricula) as total, matricula, correo FROM alumno 
                      WHERE correo = '" . $email . "' AND password  = '" . $password . "' ");
    $query->execute();
    $registro = $query->fetch(PDO::FETCH_OBJ);

    if ($registro->total == 1) {
      $_SESSION['matricula'] = $registro->matricula;
      echo 'Login Correct';
      mysqli_close($conn);
    } else {
      echo 'Contraseña o usuario incorrecto';
      mysqli_close($conn);
    }
  }
} catch (PDOException $e) {
  echo $query . "<br>" . $e->getMessage();
  mysqli_close($conn);
}
