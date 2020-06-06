<?php
require 'conexion.php';

try {
  session_start();
  $codigo_curso = $_POST['codigo'];
  $matricula = $_SESSION['matricula'];

  //Search if the code provided exists in table curso.
  $query = $conn->prepare("SELECT count(idCurso) as total FROM curso 
                             WHERE idCurso = '" . $codigo_curso . "' ");
  $query->execute();
  $curso = $query->fetch(PDO::FETCH_OBJ);

  if ($curso->total == 1) {
    //Search if the student is already in table curso_alumno.
    $query = $conn->prepare("SELECT count(idCurso) as total FROM curso_alumno
                               WHERE idCurso = '" . $codigo_curso . "' AND matricula = '" . $matricula . "' ");
    $query->execute();
    $inscrito = $query->fetch(PDO::FETCH_OBJ);

    if($inscrito->total == 1){
      echo 'Inscrito anteriormente';
    }
    else{

      $sql = "INSERT INTO curso_alumno (idCurso, matricula)
      VALUES ('".$codigo_curso."', '".$matricula."')";
      // use exec() because no results are returned
      $query=$conn->exec($sql);
      echo 'Inscrito Correcto';
    }
    
    
  } else {
    echo 'Codigo incorrecto';
  }
  
} catch (PDOException $e) {
  echo $query . "<br>" . $e->getMessage();
  $conn = null;
}

?>