<?php
require 'db_conection.php';

try {
  session_start();

  if (isset($_POST['bye'])) {
    session_destroy();
    echo 'Correct_Bye';
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = OpenCon();

    $query = $conn->prepare("SELECT count(user_id) as total, user_id, user, type FROM user 
                    WHERE email = '" . $email . "' AND password  = '" . $password . "' ");
    $query->execute();
    $registro = $query->fetch(PDO::FETCH_OBJ);

    if ($registro->total == 1) {
      $_SESSION['user_id'] = $registro->user_id;
      $_SESSION['user'] = $registro->user;
      $_SESSION['type'] = $registro->type;
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
