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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

  <!-- Reference to inscripcion.js -->
  <script src="../config/js/inscripcion.js"></script>
  <!-- Reference to login.js -->
  <script src="../config/js/login.js"></script>

  <title>Inscripción</title>
</head>

<body>
  <?php
      //Check if session is started ohterwise, program returns user to student's login page.
      session_start();
      if(isset($_SESSION['matricula'])) {
  ?>
  <script type="text/javascript">
    var Suser_id = <?php echo $_SESSION['matricula']; ?>;
    console.log("El usuario que está en el sistema es: " + Suser_id);
  </script>
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
  <div class="container-md">
    <!-- Título -->
    <div class="row justify-content-center align-items-center my-3">
      <h1 class="font-weight-light text-center mr-3">Inscribirse a un curso</h1>
    </div>
    <!-- Formulario -->
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-6">
        <form class="card shadow px-3 py-4">

          <!-- Código -->
          <div class="form-group m-0" id="grpCodigo">
            <label for="codigo">Código del curso</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="codigo" required>
              <div class="input-group-append">
              </div>
            </div>
          </div>
          <div class="text-right">
            <button class="btn btn-info" id="cursoInscripcion" >Aceptar</button>
            <a href="equipos.php" class="btn btn-outline-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php 
    //IF (isset($_SESSION['matricula'])) ENDS
    } 
    //ELSE STARTS
    else
    {
      header("location:login_estudiante.html");
      //ELSE ENDS
    }   
  ?>
</body>

</html>