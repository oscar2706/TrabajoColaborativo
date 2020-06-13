<?php
require('../config/php/conexion.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $codigoMateria = $_POST['NFC'];
}





$idProfesor = $_SESSION['userid'];




$consulta = 'SELECT * from curso WHERE idCurso = "'.$codigoMateria.'"';
foreach($conn->query($consulta) as $row){
        $nombreCurso = $row['nombre'];
        $periodoCurso = $row['idPeriodo'];
        $yearCurso = $row['year'];
        $NFC = $codigoMateria;
        $estadoCurso = $row['idEstadoCurso'];
}


        $consultaPeriodo = 'select nombre from periodo where idPeriodo = "'.$periodoCurso.'"';
        foreach ($conn->query($consultaPeriodo) as $r) {
          $nombrePeriodo = $r['nombre'];  //Nombre del periodo (Primavera, Verano u Otoño)
        }

        $consultaEstado = 'select estado from estadocurso where idEstadoCurso = "'.$estadoCurso.'"';
        foreach ($conn->query($consultaEstado) as $r2) {
          $eCurso = $r2['estado']; //estado del curso (Activo o Finalizado)
        }

        $consultaNumeroEstudiantes = 'select count(idCurso) from curso_alumno where idCurso = "'.$NFC.'"';  
        foreach ($conn->query($consultaNumeroEstudiantes) as $k) {
          $nEstudiantes = $k[0]; //Numero de estudiantes
        }

        $consultaNumeroEquipos = 'select count(idCurso) from equipo where idCurso = "'.$NFC.'"';  
        foreach ($conn->query($consultaNumeroEquipos) as $k2) {
          $nEquipos = $k2[0]; //Numero de estudiantes
        }

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
      <!-- En duda -->
      <a class="px-2 text-white" href="#">Euipos</a>
      <a class="px-2 text-white" href="#">Alumnos</a>
      <!--  -->
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_profesor.html">Salir</a>
    </nav>
  </div>
  <!-- Contenido -->
  <div class="container-xl">

    <!-- Barra de ubicación -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 py-2 pl-1 justify-content-center">
        <li class="breadcrumb-item"><a href="cursos.php">Cursos</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $NFC ?></li>
      </ol>
    </nav>

    <!-- Titulo -->
    <div class="row mb-3">
      <div class="col-12 text-center">
        <h1 class="font-weight-light m-0 h2"><?php echo utf8_encode($nombreCurso); ?></h1>
        <h6 class="text-muted pl-2 mt-1 m-0"><?php echo $nombrePeriodo."&nbsp;".$yearCurso; ?></h6>
        <div class="d-flex justify-content-center">
          <h5 class="pl-2 mt-1 m-0">Código: <?php echo $NFC; ?></h5>
          <button type="button" class="ml-2 btn btn-outline-secondary btn-sm p-1">Copiar</button>
        </div>
        <span class="badge badge-success mt-2 mb-2"> <?php echo $eCurso ?> </span>
      </div>
    </div>
    <div class="row">

      <!-- Lista de alumnos -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="h4 mb-0 pb-2 text-dark border-bottom border-secondary">
              Alumnos <span class="badge badge-pill badge-secondary"> <?php echo $nEstudiantes ?></span>
            </h2>
            <ul class="list-group list-group-flush">
              <?php
                $consultaAlumnosMateria = 'Select matricula from curso_alumno where idcurso = "'.$NFC.'"';
                foreach ($conn->query($consultaAlumnosMateria) as $r3) {
                  $matricula = $r3['matricula'];

                  $consultaNombreAlumno = 'SELECT nombre FROM alumno where matricula = "'.$matricula.'"';
                  foreach ($conn->query($consultaNombreAlumno) as $r4) {
                    $nombre = $r4['nombre'];                   
                  }                  
                  echo '<li class="list-group-item py-2">'.$nombre.'</li>';
                }

              ?>

            </ul>
          </div>
        </div>
      </div>

      <!-- Lista de equipos -->
      <div class="col-12 col-md-6 col-lg-8">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="h4 mb-3 pb-2 text-dark border-bottom border-secondary">
              Equipos <span class="badge badge-pill badge-secondary"> <?php echo $nEquipos ?></span>
              <a href="asignar_equipos.html" class="btn btn-outline-info">Gestionar equipos</a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#evaluacionModal">
                Habilitar evaluación
              </button>

              <!-- Evaluación Modal -->
              <div class="modal fade" id="evaluacionModal" tabindex="-1" role="dialog"
                aria-labelledby="evaluacionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-dark">
                      <h5 class="modal-title text-white" id="evaluacionModalLabel">Habilitar
                        evaluación</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-center">
                      <p class="m-0 h6">¿Habilitar la evaluación para el curso
                        <strong> <?php echo $nombreCurso." - ".$nombrePeriodo." ".$yearCurso; ?> </strong>?</p>
                    </div>
                    <div class="modal-footer">
                    
                      <form action="detalles_curso.php" method = "POST">
                      	
                      	<?php
                      	
                      	if(isset($_POST['habilitar'])){
            							$sqlHabilitarCurso = 'UPDATE curso SET idEstadoCurso = 2 WHERE idCurso = "'.$codigoMateria.'"';
						              $conn->query($sqlHabilitarCurso);
                        }

                      	?> 
                        <input type = "hidden" name = "NFC" value = <?php echo $codigoMateria; ?>>
                      	<input type = "hidden" name = "habilitar">
                      	<input type = "submit" class="btn btn-info" value = "Aceptar">
         			  </form>

                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    
                    </div>
                  </div>
                </div>
              </div>
            </h2>

            <!-- Equipos -->

            <?php
              $consultaEquiposMateria = 'SELECT * FROM equipo where idCurso = "'.$NFC.'"';
              foreach ($conn->query($consultaEquiposMateria) as $r5) {
                $idEquipo = $r5['idEquipo'];
                $nombreEquipo = $r5['nombre'];

              
                echo '<div class="card mb-3">';
                echo '<div class="card-header border-light font-weight-bolder"> '.$nombreEquipo.'</div>';
                echo '<div class="card-body px-0 py-2">';
                echo '<ul class="mb-0">';

                $consultaAlumnosEquipo = 'SELECT matricula FROM equipo_integrante where idEquipo = "'.$idEquipo.'"';
                foreach ($conn->query($consultaAlumnosEquipo) as $r6) {
                  $matriculaEquipo = $r6['matricula'];

                  $consultaNombreAlumno2 = 'SELECT nombre FROM alumno where matricula = "'.$matriculaEquipo.'"';
                  foreach ($conn->query($consultaNombreAlumno2) as $r7) {
                    $nombreAlumno2 = $r7['nombre'];
                  }
                  
                  echo '<li> '.$nombreAlumno2.'</li>';
                }
                echo '</ul>';
                echo '</div>';
                echo '</div>';
              }
            ?>
          </div>
        </div>
      </div>
    </div>
</body>

</html>