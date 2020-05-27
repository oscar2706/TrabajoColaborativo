<?php 
  session_start();
  $link=new mysqli("localhost","root","","tc");
  if ($link->connect_errno) {
    echo "Fallo: ".$link->connect_error;
  }
   if(!$_SESSION['Correo'] && !$_SESSION['Contraseña']){
    echo "Error: ";
  }
  else{
    $correo=$_SESSION['Correo'];
    $contraseña=$_SESSION['Contraseña'];
    if($result1=$link->query("SELECT * FROM profesor WHERE correo='$correo' AND password='$contraseña'")){
      $row1=$result1->fetch_array(MYSQLI_ASSOC);
      $idProfesor=$row1['idProfesor'];
      if( isset($_GET["clave"]) ){
        $claveCurso=$_GET['clave'];
        $result2=$link->query("SELECT * FROM curso WHERE idCurso='$claveCurso'");
        $row2=$result2->fetch_array(MYSQLI_ASSOC);
        $nombreCurso=$row2['nombre'];
        $periodoCurso=$row2['periodo'];
        $anoCurso=$row2['ano'];
      }
    }
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
        <li class="breadcrumb-item active" aria-current="page"><?php echo $claveCurso ?></li>
      </ol>
    </nav>

    <!-- Titulo -->
    <div class="row mb-3">
      <div class="col-12 text-center">
        <h1 class="font-weight-light m-0 h2"><?php echo utf8_encode($nombreCurso); ?></h1>
        <h6 class="text-muted pl-2 mt-1 m-0"><?php echo $periodoCurso."&nbsp;".$anoCurso; ?></h6>
        <div class="d-flex justify-content-center">
          <h5 class="pl-2 mt-1 m-0">Código: <?php echo $claveCurso; ?></h5>
          <button type="button" class="ml-2 btn btn-outline-secondary btn-sm p-1">Copiar</button>
        </div>
        <span class="badge badge-success mt-2 mb-2">Finalizado</span>
      </div>
    </div>
    <div class="row">

      <!-- Lista de alumnos -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="h4 mb-0 pb-2 text-dark border-bottom border-secondary">
              Alumnos <span class="badge badge-pill badge-secondary">14</span>
            </h2>
            <ul class="list-group list-group-flush">
              <li class="list-group-item py-2">JAVIER NUÑEZ ALBEROLA</li>
              <li class="list-group-item py-2">JOSE MANUEL CANTERO HERNAN</li>
              <li class="list-group-item py-2">GONZALO AUGUSTO ESPINOSA</li>
              <li class="list-group-item py-2">JAVIER HURTADO ANDUJAR</li>
              <li class="list-group-item py-2">JUAN MANUEL TORRICO PARREÑO</li>
              <li class="list-group-item py-2">GABRIEL BORREGUERO BELLES</li>
              <li class="list-group-item py-2">VICTORIA MELO PIÑA</li>
              <li class="list-group-item py-2">SARA VIEIRA GALIANA</li>
              <li class="list-group-item py-2">LORENA GAGO BORRELL</li>
              <li class="list-group-item py-2">ROSA POZUELO CUBILLO</li>
              <li class="list-group-item py-2">ROSARIO TAMAYO FIGUERAS</li>
              <li class="list-group-item py-2">INES PINTO MATESANZ</li>
              <li class="list-group-item py-2">JOAN SECO COBOS</li>
              <li class="list-group-item py-2">DIEGO CAÑAS ARMERO</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Lista de equipos -->
      <div class="col-12 col-md-6 col-lg-8">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="h4 mb-3 pb-2 text-dark border-bottom border-secondary">
              Equipos <span class="badge badge-pill badge-secondary">3</span>
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
                        <strong>TrabajoColaborativo - Primavera2020</strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info">Aceptar</button>
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
            </h2>
            <!-- Equipo -->
            <div class="card mb-3">
              <div class="card-header border-light font-weight-bolder">Alfa</div>
              <div class="card-body px-0 py-2">
                <ul class="mb-0">
                  <li>LORENA GAGO BORRELL</li>
                  <li>ROSA POZUELO CUBILLO</li>
                  <li>ROSARIO TAMAYO FIGUERAS</li>
                  <li>INES PINTO MATESANZ</li>
                </ul>
              </div>
            </div>
            <!-- Equipo -->
            <div class="card mb-3">
              <div class="card-header border-light font-weight-bolder">Delta</div>
              <div class="card-body px-0 py-2">
                <ul class="mb-0">
                  <li>LORENA GAGO BORRELL</li>
                  <li>ROSA POZUELO CUBILLO</li>
                  <li>ROSARIO TAMAYO FIGUERAS</li>
                  <li>INES PINTO MATESANZ</li>
                </ul>
              </div>
            </div>
            <!-- Equipo -->
            <div class="card mb-3">
              <div class="card-header border-light font-weight-bolder">Dinamita</div>
              <div class="card-body px-0 py-2">
                <ul class="mb-0">
                  <li>LORENA GAGO BORRELL</li>
                  <li>ROSA POZUELO CUBILLO</li>
                  <li>ROSARIO TAMAYO FIGUERAS</li>
                  <li>INES PINTO MATESANZ</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>