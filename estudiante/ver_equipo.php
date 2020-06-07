<?php
	require('../config/php/Conexion.php');
	$matricula = 205784657;
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
 	 $idEquipo = $_POST['idEquipo'];
 	 $nombreCurso = $_POST['nombreCurso'];
 	 $nombrePeriodo = $_POST['nombrePeriodo'];
 	 $year = $_POST['year'];
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
  <title>Equipo Colaborativo</title>
</head>

<body>
  <!-- Barra de navegación -->
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark border-bottom shadow">
    <h5 class="ml-lg-5 pl-lg-5 my-0 mr-md-auto font-weight-normal text-white">CES</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="px-2 text-white" href="equipos.html">Inicio</a>
      <a class="px-2 text-white" href="resultados.html">Resultados</a>
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_estudiante.html">Salir</a>
    </nav>
  </div>
  <!-- Contenido -->
  <div class="container-xl">
    <!-- Titulo -->
    <div class="row mb-3 justify-content-center">
      <div class="text-center">
        <h1 class="font-weight-light mt-3 h2">Equipo de Trabajo</h1>
        <p class="my-0 h6"> <?php echo $nombreCurso ?></p>
        <p class="text-secondary my-0"> <?php echo $nombrePeriodo.' '; echo $year; ?></p>
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- Lista de equipos -->
      <div class="col-12 col-md-6 col-lg-8">
        <div class="card shadow">
          <div class="card-body">
            <div>
              <h2 class="h5 mb-3 pb-2 text-dark border-bottom border-secondary">
                Integrantes del equipo
              </h2>
            </div>
            <!-- Tabla de integrantes -->

            <table class="table table-striped">
              
              <?php
              $contador = 0;
              $sqlIntegrantes = 'SELECT * FROM equipo_integrante where idEquipo = "'.$idEquipo.'"';
              foreach ($conn->query($sqlIntegrantes) as $row) {
              $matriculaCompanero = $row['matricula'];	
              $contador = $contador + 1;


              $sqlNombreCompanero = 'SELECT nombre FROM alumno where matricula = "'.$matriculaCompanero.'"';
              foreach ($conn->query($sqlNombreCompanero) as $row2) {
              	$nombreCompanero = $row2['nombre'];

              }

              echo '<tbody>';
                echo '<tr>';
                  echo '<th scope="row"> '.$contador.'</th>';
                  echo '<td> '.$nombreCompanero.'</td>';
                  echo '<td>';
                  if($matriculaCompanero!=$matricula ){
                  	echo '<button type="button" class="btn btn-outline-info" data-toggle="modal"';
                    echo 'data-target="#evaluacionModal">';
                    echo 'Realizar coevaluación';
                    echo '</button>';
                  }
                  echo '</td>';
                echo '</tr>';

              echo '</tbody>';
              }
              ?>

            </table>

            <!-- Confirmación realiza coevaluación Modal -->
            <div class="modal fade" id="evaluacionModal" tabindex="-1" role="dialog"
              aria-labelledby="evaluacionModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="evaluacionModalLabel">Comenzar
                      Coevaluación
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center">
                    <p class="m-0 h6">¿Desea iniciar la coevaluación de este alumno?</p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-info" href="cuestionario.html" role="button">Evaluar</a>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>