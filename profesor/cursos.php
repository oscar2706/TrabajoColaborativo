<?php
  $link=new mysqli("localhost","root","","tc");
  if ($link->connect_errno) {
    echo "Fallo: ".$link->connect_error;
  }
  session_start();
  if(!$_SESSION['Correo'] && !$_SESSION['Contraseña']){
    echo "Error: ";
  }
  else{
    $correo=$_SESSION['Correo'];
    $contraseña=$_SESSION['Contraseña'];
    if($result1=$link->query("SELECT * FROM profesor WHERE correo='$correo' AND password='$contraseña'")){
      $row1=$result1->fetch_array(MYSQLI_ASSOC);
      $idProfesor=$row1['idProfesor'];
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
      <a class="px-2 text-white" href="cursos.html">Cursos</a>
      <!-- En duda -->
      <a class="px-2 text-white" href="#">Equipos</a>
      <a class="px-2 text-white" href="#">Alumnos</a>
      <!--  -->
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_profesor.php">Salir</a>
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
      $result2=$link->query("SELECT * FROM curso WHERE Profesor_idProfesor='$idProfesor'");
      $row2=$result2->fetch_array(MYSQLI_ASSOC);
      if(empty($row2)){
        echo "No hay materias creadas";
      }
      else{
        ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
        <?php
        $result3=$link->query("SELECT * FROM curso WHERE Profesor_idProfesor='$idProfesor'");
        
        while ($row3=$result3->fetch_array(MYSQLI_ASSOC)){
          $auxNombre=utf8_encode($row3['nombre']);
          $auxAño=utf8_encode($row3['ano']);
            echo "<div class='col mb-4'>";
              echo "<div class='card shadow-lg'>";
                echo "<div class='card-body text-center'>";
                  echo "<h2 class='h4 font-weight-light mb-1'>".$auxNombre."</h2>";
                  echo "<p class='text-secondary my-0'>".$row3['periodo']."&nbsp;".$auxAño."</p>";
                  echo "<span class='badge badge-success mt-0 mb-2'>Activo</span>";
                  echo "<p class='text-dark m-1'>Código: ".$row3['idCurso']."</p>";
                  echo "<p class='text-dark m-1 mb-3'>26 estudiantes</p>";
                  echo "<a href='detalles_curso.php?clave=".$row3['idCurso']."' class='btn btn-outline-info btn-block'>Ver curso</a>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
        }
        ?>
        </div>
        <?php
      }
    ?>

    <!--
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Trabajo colaborativo</h2>
            <p class="text-secondary my-0">Primavera 2020</p>
            <span class="badge badge-success mt-0 mb-2">Finalizado</span>
            <p class="text-dark m-1">Código: KPRCC3</p>
            <p class="text-dark m-1 mb-3">26 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Herramientas web</h2>
            <p class="text-secondary my-0">Verano 2020</p>
            <span class="badge badge-primary mt-0 mb-2">Activo</span>
            <p class="text-dark m-1">Código: KPRCC3</p>
            <p class="text-dark m-1 mb-3 text-muted">Sin estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Pruebas de software</h2>
            <p class="text-secondary my-0">Primavera 2019</p>
            <span class="badge badge-success mt-0 mb-2">Finalizado</span>
            <p class="text-dark m-1">Código: KDA8GA</p>
            <p class="text-dark m-1 mb-3">35 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Herramientas web</h2>
            <p class="text-secondary my-0">Primavera 2019</p>
            <span class="badge badge-warning mt-0 mb-2">En evaluación</span>
            <p class="text-dark m-1">Código: J3C463</p>
            <p class="text-dark m-1 mb-3">30 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Trabajo colaborativo</h2>
            <p class="text-secondary my-0">Primavera 2020</p>
            <span class="badge badge-success mt-0 mb-2">Finalizado</span>
            <p class="text-dark m-1">Código: KPRCC3</p>
            <p class="text-dark m-1 mb-3">26 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Herramientas web</h2>
            <p class="text-secondary my-0">Verano 2020</p>
            <span class="badge badge-primary mt-0 mb-2">Activo</span>
            <p class="text-dark m-1">Código: KPRCC3</p>
            <p class="text-dark m-1 mb-3 text-muted">Sin estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Pruebas de software</h2>
            <p class="text-secondary my-0">Primavera 2019</p>
            <span class="badge badge-success mt-0 mb-2">Finalizado</span>
            <p class="text-dark m-1">Código: KDA8GA</p>
            <p class="text-dark m-1 mb-3">35 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <h2 class="h4 font-weight-light mb-1">Herramientas web</h2>
            <p class="text-secondary my-0">Primavera 2019</p>
            <span class="badge badge-warning mt-0 mb-2">En evaluación</span>
            <p class="text-dark m-1">Código: J3C463</p>
            <p class="text-dark m-1 mb-3">30 estudiantes</p>
            <a href="detalles_curso.html" class="btn btn-outline-info btn-block">Ver curso</a>
          </div>
        </div>
      </div>
    -->

  </div>
</body>

</html>