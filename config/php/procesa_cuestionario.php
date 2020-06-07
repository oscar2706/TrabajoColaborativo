<?php
require_once('conexion.php');
session_start();

$rubros = [
  "comunicacion" => $_POST['comunicacion'],
  "puntualidad" => $_POST['puntualidad'],
  "calidad_trabajo" => $_POST['calidad_trabajo'],
  "aportes" => $_POST['aportes'],
  "disposicion" => $_POST['disposicion'],
  "respeto" => $_POST['respeto']
];

$stmt = $conn->prepare("SELECT idEvaluacion FROM evaluacion 
                      WHERE idEquipo=? and matricula=? and matricula_evaluador=? LIMIT 1");
$stmt->execute([$_POST['idEquipo'], $_POST['matricula_compañero'], $_SESSION['matricula']]);
$evaluado = $stmt->fetch();

if ($evaluado != null) { 
  // YA SE HABÍA EVALUADO
  $_SESSION['mensaje_advertencia'] = 'El compañero ya había sido evaluado';
} else {
  // SE REGISTRA LA EVALUACIÓN
  $sql = "INSERT INTO evaluacion (idEquipo, matricula, matricula_evaluador) VALUES (?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_POST['idEquipo'], $_POST['matricula_compañero'], $_SESSION['matricula']]);
  
  $stmt = $conn->prepare("SELECT idEvaluacion FROM evaluacion 
                      WHERE idEquipo=? and matricula=? and matricula_evaluador=? LIMIT 1");
  $stmt->execute([$_POST['idEquipo'], $_POST['matricula_compañero'], $_SESSION['matricula']]);
  $evaluado = $stmt->fetch();
  
  foreach ($rubros as $rubro => $calificacion) {
    $sql = "INSERT INTO rubro (idEvaluacion, nombre, calificacion) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$evaluado['idEvaluacion'], $rubro, $calificacion]);
  }
  $_SESSION['mensaje_exito'] = 'Evaluación exitosa';
}

$host  = $_SERVER['HTTP_HOST'];
header("Location: http://$host/TrabajoColaborativo/estudiante/ver_equipo.php");
