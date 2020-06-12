<?php
  require('../config/php/conexion.php');
  session_start();
  $idProfesor=$_SESSION['userid'];

  if(!empty($_POST['nombre']) && !empty($_POST['codigo']) && !empty($_POST['periodo'])){
    $nombre=$_POST['nombre'];
    $codigo=$_POST['codigo'];
    $periodo=$_POST['periodo'];
    if($periodo=="Primavera"){
      $periodo="1";
    }
    elseif($periodo=="Verano"){
      $periodo="2";
    }
    else{
      $periodo="3";
    }

    $ano="2020";
    $estadoCurso="1";
    $result1=$conn->query("INSERT INTO curso (idCurso,nombre,year,idPeriodo,idProfesor,idEstadoCurso) VALUES ('$codigo','$nombre','$ano','$periodo','$idProfesor','$estadoCurso')");
    
    header("location: cursos.php");
    
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
  <script type="text/javascript">
  window.addEventListener("load", cargaPagina);
  function cargaPagina() {
      var btn = document.getElementById("generar").addEventListener("click", cambiaValores);
  }
  function cambiaValores() {
      var inputNombre = document.getElementById("codigo");
      var str = "1234567890";
      var clave="";
      //Reconstruimos la contraseña segun la longitud que se quiera
      for($i=0;$i<8;$i++) {
        clave+=str.charAt(Math.random()*str.length);
        } 
      inputNombre.value=clave;
  }
</script>
  <!-- Barra de navegación -->
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark border-bottom shadow">
    <h5 class="ml-lg-5 pl-lg-5 my-0 mr-md-auto font-weight-normal text-white">CES</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="px-2 text-white" href="cursos.php">Cursos</a>
      <!-- En duda -->
      <a class="px-2 text-white" href="#">Equipos</a>
      <a class="px-2 text-white" href="#">Alumnos</a>
      <!--  -->
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_profesor.html">Salir</a>
    </nav>
  </div>

  <!-- Contenido -->
  <div class="container-md">
    <!-- Título -->
    <div class="row justify-content-center align-items-center my-3">
      <h1 class="font-weight-light text-center mr-3">Nuevo curso</h1>
    </div>
    <!-- Formulario -->
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-6">
        <form action="" class="card shadow px-3 py-4" method="POST">
          <!-- Nombre -->
          <div class="form-group">
            <label for="nombre">Nombre del curso</label>
            <input required type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <!-- Periodo -->
          <div class="form-group">
            <label for="periodo">Periodo</label>
            <div class="input-group">
              <select class="custom-select" id="periodo" required name="periodo">
                <option selected disabled value="">Selecciona un periodo...</option>
                <option value="Primavera">Primavera</option>
                <option value="Verano">Verano</option>
                <option value="Otono">Otoño</option>
              </select>
              <div class="input-group-append">
                <span class="input-group-text">2020</span>
              </div>
            </div>
          </div>
          <!-- Código -->
          <div class="form-group">
            <label for="codigo">Código</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="codigo" required name="codigo">
              <div class="input-group-append">
                <button class="btn btn-outline-info" type="button" id="generar">Generar código</button>
              </div>
            </div>
          </div>
          <div class="text-right">
            <input type="submit" class="btn btn-info" value="Aceptar">
            <a href="cursos.php" class="btn btn-outline-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>