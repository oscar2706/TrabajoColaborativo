<?php
require('../config/php/conexion.php');
session_start();
$idProfesor = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="es_MX">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Custom styles -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
  <title>Cursos</title>
</head>

<body>
  <!-- Barra de navegación -->
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark border-bottom shadow">
    <h5 class="ml-lg-5 pl-lg-5 my-0 mr-md-auto font-weight-normal text-white">CES</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="px-2 text-white" href="cursos.php">Cursos</a>
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_profesor.html">Salir</a>
    </nav>
  </div>

  <!-- Contenido -->
  <div class="container-lg">
    <!-- Titulo -->
    <div class="row justify-content-center align-items-center my-3">
      <h1 class="font-weight-light text-center mr-3">Cursos</h1>
      <a href="nuevo_curso.php" class="btn btn-outline-info">Nuevo curso</a>
    </div>

    <!-- Cursos -->
    <?php 
    	echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">';
    	$consulta = 'SELECT * from curso WHERE idProfesor = "'.$idProfesor.'"';
		    foreach($conn->query($consulta) as $row){

  		  $nombreCurso = $row['nombre'];
	      $periodoCurso = $row['idPeriodo'];
	   	  $yearCurso = $row['year'];
		    $NFC = $row['idCurso'];
		    $estadoCurso = $row['idEstadoCurso'];

        $consultaPeriodo = 'select nombre from periodo where idPeriodo = "'.$periodoCurso.'"';
        foreach ($conn->query($consultaPeriodo) as $r) {
          $nombrePeriodo = $r['nombre'];     
        }

        $consultaEstado = 'select estado from estadocurso where idEstadoCurso = "'.$estadoCurso.'"';
        foreach ($conn->query($consultaEstado) as $r2) {
          $eCurso = $r2['estado'];        
        }      


        $consultaNumeroEstudiantes = 'select count(idCurso) from curso_alumno where idCurso = "'.$NFC.'"';  
        foreach ($conn->query($consultaNumeroEstudiantes) as $k) {
          $nEstudiantes = $k[0];
        }

        echo '<form action = "detalles_curso.php" method = POST>';
			  echo '<div class="col mb-4">';
          echo '<div class="card shadow-lg">';
          			echo '<div class="card-body text-center">';
            		echo '<h2 class="h4 font-weight-light mb-1"> '.$nombreCurso.'</h2>';
            		echo '<p class="text-secondary my-0"> '.$nombrePeriodo.' '.$yearCurso.'</p>';
            		echo '<span class="badge badge-success mt-0 mb-2"> '.$eCurso.' </span>';
            		echo '<p class="text-dark m-1">Código: '.$NFC.'</p>';
            		echo '<input type = "hidden" name = "NFC" value = "'.$NFC.'" >';
                echo '<p class="text-dark m-1 mb-3">'.$nEstudiantes.' estudiantes. </p>';
            		echo '<input type = "submit" class="btn btn-outline-info btn-block" value = "Ver Curso">';
         			echo '</div>';
        	echo '</div>';
      	echo '</div>';
        echo '</form>';
		  }
		  echo '</div>';
    ?>
    </div>
  </div>
</body>
</html>