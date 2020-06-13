<?php
  require('../config/php/conexion.php');
  session_start();
  $matricula = $_SESSION['matricula'];
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idEquipo = $_POST['idEquipo'];
    $_SESSION['idEquipo'] = $idEquipo;
    
    $nombreCurso = $_POST['nombreCurso'];
    $_SESSION['nombreCurso'] = $nombreCurso;
    
    $nombrePeriodo = $_POST['nombrePeriodo'];
    $_SESSION['nombrePeriodo'] = $nombrePeriodo;
    
    $year = $_POST['year'];
    $_SESSION['year'] = $year;
	} else {
    $idEquipo = $_SESSION['idEquipo'];
    $nombreCurso = $_SESSION['nombreCurso'];
    $nombrePeriodo = $_SESSION['nombrePeriodo'];
    $year = $_SESSION['year'];
  }

?>

<!DOCTYPE html>
<html lang="es_MX">

<head runat="server">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Custom styles -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
      <a class="px-2 text-white" href="equipos.php">Inicio</a>
      <a class="px-2 text-white" href="resultados.php">Resultados</a>
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
      <!-- Alerta de alumno -->
      <div class="col-12 col-md-10 col-xl-8">
        <?php if(isset($_SESSION['mensaje_exito'])): ?>
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong><?php echo $_SESSION['mensaje_exito'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" disabled>
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['mensaje_exito']) ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['mensaje_advertencia'])): ?>
          <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong><?php echo $_SESSION['mensaje_advertencia'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['mensaje_advertencia']) ?>
        <?php endif; ?>
      </div>

      <!-- Lista de equipos -->
      <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow">
          <div class="card-body p-0">
            <div>
              <h2 class="h5 m-0 p-3 pb-2 text-dark border-bottom border-secondary">
                Integrantes del equipo
              </h2>
            </div>

            <!-- Tabla de integrantes -->
            <div class="table-responsive">
              <table class="table table-striped m-0">
                <tbody>
                <?php
                $contador = 0;
                $sqlIntegrantes = 'SELECT * FROM equipo_integrante where idEquipo = "'.$idEquipo.'"';
                foreach ($conn->query($sqlIntegrantes) as $row) {
                $matriculaCompanero = $row['matricula'];	
                $contador = $contador + 1;

                //$idEquipo
                $query = $conn->prepare('SELECT count(matricula) as total FROM evaluacion WHERE matricula_evaluador = "'.$matricula.'" and matricula = "'.$matriculaCompanero.'"');
                $query->execute();
                $sqlEvaluacion = $query->fetch(PDO::FETCH_OBJ);
               
               

                $sqlNombreCompanero = 'SELECT nombre FROM alumno where matricula = "'.$matriculaCompanero.'"';
                foreach ($conn->query($sqlNombreCompanero) as $row2) {
                  $nombreCompanero = $row2['nombre'];



                }

                if($sqlEvaluacion->total == 1){
                  echo '<tr>';
                    echo '<td class="p-align-middle"> '.$nombreCompanero.'</td>';
                    echo '<td class="text-center align-middle"> '.$matriculaCompanero.'</td>';
                    echo '<td class="text-center">';
                    if($matriculaCompanero!=$matricula ){
                      //                          id="'.$matriculaCompanero.'"
                      echo '<button type="button" id="'.$matriculaCompanero.'" name="button" class="btn btn-outline-info" data-toggle="modal" disabled';
                      echo 'data-target="#evaluacionModal'.$matriculaCompanero.'">';
                      echo 'Realizar coevaluación';
                      echo '</button>';

                      
                    }
                    echo '</td>';
                  echo '</tr>';
                }else{
                  echo '<tr>';
                    echo '<td class="p-align-middle"> '.$nombreCompanero.'</td>';
                    echo '<td class="text-center align-middle"> '.$matriculaCompanero.'</td>';
                    echo '<td class="text-center">';
                    if($matriculaCompanero!=$matricula ){
                      //                          id="'.$matriculaCompanero.'"
                      echo '<button type="button" id="'.$matriculaCompanero.'" name="button" class="btn btn-outline-info" data-toggle="modal"';
                      echo 'data-target="#evaluacionModal'.$matriculaCompanero.'">';
                      echo 'Realizar coevaluación';
                      echo '</button>';
                    }
                    echo '</td>';
                  echo '</tr>';
                }

                
                
                // Modal
                echo '<!-- Confirmación realiza coevaluación Modal -->';
                echo '<div class="modal fade" id="evaluacionModal'.$matriculaCompanero.'" tabindex="-1" role="dialog"';
                echo 'aria-labelledby="evaluacionModalLabel" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-centered">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header bg-dark">';
                echo '<h5 class="modal-title text-white" id="evaluacionModalLabel">Comenzar coevaluación';
                echo '</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body text-center">';
                echo '<p class="m-0 h6">¿Desea iniciar la coevaluación de este alumno?</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<form action="cuestionario.php" method="post">';
                echo '<input type="hidden" name="idEquipo" value="'.$idEquipo.'">';
                echo '<input type="hidden" name="matricula_compañero" value="'.$matriculaCompanero.'">';
                echo '<button type="submit" id="C'.$matriculaCompanero.'" class="btn btn-info">Evaluar</button>';
                echo '</form>';
                echo '<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>