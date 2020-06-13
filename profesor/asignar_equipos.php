<?php
  require('../config/php/conexion.php');
  if(isset($_GET['clave'])){
    $idCurso = $_GET['clave'];
  }
  $_SESSION['userid'] =1; //Este será el id del profesor
  $idProfesor = $_SESSION['userid'];


  $consultaNumeroEstudiantes = 'select count(idCurso) from curso_alumno where idCurso = "'.$idCurso.'"';  
  foreach ($conn->query($consultaNumeroEstudiantes) as $k) {
    $nEstudiantes = $k[0]; //Numero de estudiantes
  }

  $consultaNumeroEquipos = 'select count(idCurso) from equipo where idCurso = "'.$idCurso.'"';  
  foreach ($conn->query($consultaNumeroEquipos) as $k2) {
    $nEquipos = $k2[0]; //Numero de estudiantes
  }

  $suma=0;
  $consultaNumeroSinEquipo= 'SELECT * FROM equipo where idCurso = "'.$idCurso.'"';
  foreach ($conn->query($consultaNumeroSinEquipo) as $r5) {
    $idEquipo = $r5['idEquipo'];
    $nombreEquipo = $r5['nombre'];

    $consultaAlumnosEquipo = 'SELECT matricula FROM equipo_integrante where idEquipo = "'.$idEquipo.'"';
    foreach ($conn->query($consultaAlumnosEquipo) as $r6) {
      $matriculaEquipo = $r6['matricula'];

      $consultaNombreAlumno2 = 'SELECT count(matricula) FROM alumno where matricula = "'.$matriculaEquipo.'"';
      foreach ($conn->query($consultaNombreAlumno2) as $r7) {
        $nombreAlumno2 = $r7[0];
        $suma=$suma+$nombreAlumno2;
        
      }      
    }
  }

  $consultaNumeroEstudiantes = 'select count(idCurso) from curso_alumno where idCurso = "'.$idCurso.'"';  
  foreach ($conn->query($consultaNumeroEstudiantes) as $k) {
    $nEstudiantes = $k[0];
  }
  if($suma<0){
    $suma=0;
  }
  else{
    $suma=$nEstudiantes-$suma;
  }
  
  if(isset($_GET['idEliminar'])){
    $idEliminar=$_GET['idEliminar'];
    echo "Eliminar: ".$idEliminar;
    $eliminarIntegrantes=$conn->query("DELETE from equipo_integrante  where idEquipo='$idEliminar'");
    $eliminarEquipo=$conn->query("DELETE from equipo where idEquipo='$idEliminar'");


    header('location: asignar_equipos.php?clave='.$idCurso);
  }
  


 //$alumnosNuevoEquipo=;
  if(!empty($_POST['alumnosNuevoEquipo'])) {
    $alumnosNuevoEquipo=$_POST['alumnosNuevoEquipo'];
    $N = count($alumnosNuevoEquipo);
    $consultaNumeroEquipos = 'select count(idCurso) from equipo where idCurso = "'.$idCurso.'"';  
    foreach ($conn->query($consultaNumeroEquipos) as $k2) {
      $nEquipos = $k2[0]; //Numero de estudiantes
    }
    $nEquipos=$nEquipos+1;
    $IdEquipoNuevo="Equipo ".$nEquipos;
    $result1=$conn->query("INSERT INTO equipo (nombre,idCurso) VALUES ('$IdEquipoNuevo','$idCurso')");

    $consultaIdEquipo = 'Select idEquipo from equipo order by idEquipo desc';
    foreach ($conn->query($consultaIdEquipo) as $k2) {
      $IdEquipoNuevo= $k2[0];
      break;
    }

    for($i=0; $i < $N; $i++){
      $alumnoNuevo=$alumnosNuevoEquipo[$i];
      $result2=$conn->query("INSERT INTO equipo_integrante (idEquipo,matricula) VALUES ('$IdEquipoNuevo','$alumnoNuevo')");
    }
    header('location: asignar_equipos.php?clave='.$idCurso);
  }


  if(!empty($_POST['customRadioInline1']) ){
    $tipoDeEquipo= $_POST['customRadioInline1'];
    if($tipoDeEquipo=="azar" && $suma>0){
      $numeroEquipos= $_POST['noEquipos'];
      
      
      $arregloMatriculasConEquipo;
      $consultaMatriculasConEquipo= 'SELECT matricula from equipo_integrante left join equipo on equipo_integrante.idEquipo=equipo.idEquipo where equipo.idCurso="'.$idCurso.'"';
      foreach ($conn->query($consultaMatriculasConEquipo) as $r5) {
        $matricula = $r5['matricula'];
        $arregloMatriculasConEquipo[]=$matricula;
      }
      $consultaAnidada="";
      $longitud=count($arregloMatriculasConEquipo);
      if($longitud>1){
        for ($i=0; $i <$longitud; $i++) {
          if($i<$longitud-1){
            $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i] ." and";                    
          }
          else{
            $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i];
          }                  
        }
        $arregloMatriculasSinEquipo;
        $consultaAlumnosEquipo3 = 'SELECT * from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'" and '.$consultaAnidada;
        foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
          $nombreAlumno2= $r7['nombre'];
          $matriculaAlumno2= $r7['matricula'];
          $arregloMatriculasSinEquipo[]=$matriculaAlumno2;
        }
      }
      else{
        $consultaAlumnosEquipo3 = 'SELECT * from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'"';
        foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
          $nombreAlumno2= $r7['nombre'];        
          $matriculaAlumno2= $r7['matricula'];
          $arregloMatriculasSinEquipo[]=$matriculaAlumno2;
        }
      }
      
      $numeroSinEquipo=count($arregloMatriculasSinEquipo);
      

      $rand = range(0, $numeroSinEquipo-1);
      shuffle($rand);
      $orden;
      foreach ($rand as $val) {
        $orden[]=$val;
      }
      
      for ($i=0; $i <$numeroSinEquipo; $i++) { 
        //echo $arregloMatriculasSinEquipo[$orden[$i]]." - ";
      }
      $numeroIntegrantes=floor($numeroSinEquipo/$numeroEquipos);
      $numeroRestantes=$numeroSinEquipo%$numeroEquipos;
      echo "Numero sin equipo: ".$numeroSinEquipo.'<br>';
      echo "Numero de equipos: ".$numeroEquipos."<br>";
      echo "Numero de integrantes: ".$numeroIntegrantes."<br>";
      echo "Numero de restantes: ".$numeroRestantes."<br>";
      echo "Arreglo de matriculas por asignar: ";
      print_r($arregloMatriculasSinEquipo);
      //echo $numeroEquipos;
      echo "<br>Arreglo del orden por asignar: ";
      print_r($orden);
      
      /*echo "<br>";
      echo "Numero de estudiantes por equipo ".$N;
      echo "<br>Numero de estudiantes sobrantes ".$numeroAlumnosSinEquipo;
      echo "<br>Numero de equipos ".$numeroEquipos;*/

      $auxPosicion=0;
      for ($i=0; $i <$numeroEquipos; $i++) { 
        $nEquipos=$nEquipos+1;
        $IdEquipoNuevo="Equipo ".$nEquipos;
        $result1=$conn->query("INSERT INTO equipo (nombre,idCurso) VALUES ('$IdEquipoNuevo','$idCurso')");
        $consultaIdEquipo = 'Select idEquipo from equipo order by idEquipo desc';
        foreach ($conn->query($consultaIdEquipo) as $k2) {
          $IdEquipoNuevo= $k2[0];
          break;
        }
        $auxAdicional=0;
        for($j=0; $j<$numeroIntegrantes; $j++) {
          $alumnoNuevo=$arregloMatriculasSinEquipo[$orden[$auxPosicion]];
          $result2=$conn->query("INSERT INTO equipo_integrante (idEquipo,matricula) VALUES ('$IdEquipoNuevo','$alumnoNuevo')");
          $auxPosicion++;
          if($numeroRestantes > 0 && $auxAdicional==0){
            $alumnoNuevo=$arregloMatriculasSinEquipo[$orden[$auxPosicion]];
            $result2=$conn->query("INSERT INTO equipo_integrante (idEquipo,matricula) VALUES ('$IdEquipoNuevo','$alumnoNuevo')");
            $auxPosicion++;
            $numeroRestantes--;
            $auxAdicional=1;
          }
        }
      }
      header('location: asignar_equipos.php?clave='.$idCurso);
    }
    else{
      $aConEquipo=0;
      $arregloCalificacion;
      $arregloMatriculasCalificadas;
      $alumnosConEquipo=$conn->query("SELECT count(*) from equipo_integrante left join equipo on equipo_integrante.idEquipo=equipo.idEquipo where equipo.idCurso='$idCurso'");
      foreach($alumnosConEquipo as $r1){
        $aConEquipo=$r1[0];
      }
      /*echo "aConEquipo: ".$aConEquipo;
      echo "<br>nEstudiantes: ".$nEstudiantes;*/
      if($aConEquipo==$nEstudiantes){
        $matriculaConEquipo;
        $idEquipoAlumno;
        $alumnosConEquipo2=$conn->query("SELECT * from equipo_integrante left join equipo on equipo_integrante.idEquipo=equipo.idEquipo where equipo.idCurso='$idCurso'");
        foreach($alumnosConEquipo2 as $r2){
          $matriculaConEquipo=$r2['matricula'];
          $idEquipoAlumno=$r2['idEquipo'];
          $idEvaluacion;
          $evaluacionAlumno=$conn->query("SELECT idEvaluacion from evaluacion where idEquipo='$idEquipoAlumno' and matricula='$matriculaConEquipo'");
          foreach($evaluacionAlumno as $r3){
            $idEvaluacion=$r3['idEvaluacion'];
            $sumaEvaluacion=0;
            $promedioEvaluacion=0;
            $evaluacion=$conn->query("SELECT calificacion from rubro where idEvaluacion='$idEvaluacion'");
            foreach($evaluacion as $r4){
              $sumaEvaluacion=$sumaEvaluacion+$r4['calificacion'];
            }
            $eliminarRubro=$conn->query("DELETE from rubro where idEvaluacion='$idEvaluacion'");
            $sumaEvaluacion=$sumaEvaluacion/6;
            $promedioEvaluacion=($promedioEvaluacion+$sumaEvaluacion)/2;
          }
          $eliminarEvaluacionAlumno=$conn->query("DELETE from evaluacion where idEquipo='$idEquipoAlumno'");
          $eliminarIntegrantes2=$conn->query("DELETE from equipo_integrante where idEquipo='$idEquipoAlumno' and matricula='$matriculaConEquipo'");
          
          $arregloCalificacion[]=$promedioEvaluacion;
          $arregloMatriculasCalificadas[]=$matriculaConEquipo;          
        }
        $eliminarEquipo2=$conn->query("DELETE from equipo where idCurso='$idCurso'");
        
        echo "Matriculas: ";
        print_r($arregloMatriculasCalificadas);
        echo "<br>Calificaciones: ";
        print_r($arregloCalificacion);
        $arregloDirecciones;
        for ($i=0; $i <$nEstudiantes; $i++) { 
          $arregloDirecciones[]=$i;
        }
        echo "<br>Direcciones: ";
        print_r($arregloDirecciones);
        echo "<br>Calificaciones Ordenado: ";
        arsort($arregloCalificacion,1);
        print_r($arregloCalificacion);
        
        $result3=$conn->query("SELECT count(*) from curso_alumno where idCurso='$idCurso'");
        foreach ($result3 as $r3) {
          $nEstudiantes=$r3[0];
        }
        $arregloAsociado=[];
        $arregloAsociado=array_replace_recursive($arregloCalificacion,$arregloMatriculasCalificadas);
        //for ($i=0; $i<$nEstudiantes; $i++) { 
          //$arregloAsociado[$arregloCalificacion[$i]]=$arregloMatriculasCalificadas[$i];
        //}

        $arregloFinal;
        foreach ($arregloAsociado as $k1) {
          $arregloFinal[]=$k1;
        }
        echo "<br>Arreglo asociado ordenado: ";
        print_r($arregloAsociado);
        echo "<br>Arreglo Final: ";
        print_r($arregloFinal);

        /*echo "<br>Arreglo asociado: ";
        print_r($arregloAsociado);
        echo "<br>Arreglo asociado ordenado: ";
        arsort($arregloAsociado);
        print_r($arregloAsociado);
        for ($i=0; $i <$nEstudiantes ; $i++) { 
          echo $arregloAsociado[];
        }*/
        $numeroEquipos= $_POST['noEquipos'];
        echo "<br>Numero de equipos ".$numeroEquipos;

        $consultaNumeroEquipos = 'select count(idCurso) from equipo where idCurso = "'.$idCurso.'"';  
        foreach ($conn->query($consultaNumeroEquipos) as $k2) {
          $nEquipos = $k2[0]; //Numero de estudiantes
        }

        for ($i=0; $i <$numeroEquipos; $i++) { 
          $nEquipos=$nEquipos+1;
          $IdEquipoNuevo="Equipo ".$nEquipos;
          $result1=$conn->query("INSERT INTO equipo (nombre,idCurso) VALUES ('$IdEquipoNuevo','$idCurso')");
          $consultaIdEquipo = 'Select idEquipo from equipo order by idEquipo desc';
          foreach ($conn->query($consultaIdEquipo) as $k2) {
            $IdEquipoNuevo= $k2[0];
            break;
          }
          
          for($j=$i; $j<$numeroEquipos; $j++) {
            $alumnoNuevo=$arregloFinal[$j];
            $result2=$conn->query("INSERT INTO equipo_integrante (idEquipo,matricula) VALUES ('$IdEquipoNuevo','$alumnoNuevo')");
            $posicionNuevo=count($arregloFinal)-$i-1;
            do {
              $alumnoNuevo=$arregloFinal[$posicionNuevo];
              $result2=$conn->query("INSERT INTO equipo_integrante (idEquipo,matricula) VALUES ('$IdEquipoNuevo','$alumnoNuevo')");
              $posicionNuevo=$posicionNuevo-$numeroEquipos;
            } while ($posicionNuevo>=$numeroEquipos);
          break;
            
            
          }
        }
        header('location: asignar_equipos.php?clave='.$idCurso);
        
        
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Cursos</title>
</head>

<body>
  <!-- Barra de navegación -->
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark border-bottom shadow">
    <h5 class="ml-lg-5 pl-lg-5 my-0 mr-md-auto font-weight-normal text-white">CES</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="px-2 text-white" href="cursos.html">Cursos</a>
      <a class="mr-lg-5 pr-lg-5 pl-4 text-light" href="login_profesor.html">Salir</a>
    </nav>
  </div>

  <!-- Contenido -->
  <div class="container-md">
    <!-- Barra de ubicación -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 py-2 pl-1 justify-content-center">
        <li class="breadcrumb-item"><a href="cursos.php">Cursos</a></li>
        <li class="breadcrumb-item"><a href="detalles_curso.php"><?php echo $idCurso;?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Equipos</li>
      </ol>
    </nav>
    <!-- Título -->
    <div class="row justify-content-center align-items-center mb-3">
      <h1 class="font-weight-light text-center mr-3">Equipos</h1>
      <!-- Boton modal asignación automatica -->
      <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#asignacionAutomaticaModal">
        Generador de equipos
      </button>
      <!-- Boton ayuda - asignación automatica-->
      <a tabindex="0" class="btn btn-outline-secondary" role="button" data-toggle="popover" data-trigger="focus"
        title="Generación automatica" data-content="Solo se asignarán a los integrantes que aún no tienen equipo
                ">?</a>

      <!-- Generador equipo Modal -->
      <div class="modal fade" id="asignacionAutomaticaModal" tabindex="-1" role="dialog"
        aria-labelledby="asignacionAutomaticaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h5 class="modal-title text-white" id="asignacionAutomaticaModalLabel">
                Generar equipos
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST">
                <div class="form-group">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="azar">
                    <label class="custom-control-label" for="customRadioInline1">Al azar</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="inteligente">
                    <label class="custom-control-label" for="customRadioInline2">Inteligente</label>
                    <!-- Boton ayuda - asignación inteligente-->
                    <a tabindex="0" class="ml-2 btn btn-outline-secondary btn-sm" role="button" data-toggle="popover"
                      data-trigger="focus" title="Asignación inteligente"
                      data-content="Se asignan los equipos utilizando las evaluaciones de los alumnos en la plataforma.">?</a>
                  </div>
                </div>
                <div class="form-group">
                  <label for="integrantes">Numero de equipos</label>
                  <!-- Boton ayuda - asignación inteligente-->
                  <a tabindex="0" class="btn btn-outline-secondary btn-sm" role="button" data-toggle="popover"
                    data-trigger="focus"
                    data-content="En caso de no completar el número de integrantes se formara un equipo con los restantes.">?</a>
                  <input type="number" name="noEquipos" id="integrantes" class="form-control" value="1" <?php //$auxMaximo=intdiv($suma,2); if($auxMaximo==0){$auxMaximo=1;} echo 'min="1" max="'.$auxMaximo.'"'; ?>>
                </div>
              
            </div>
            <div class="modal-footer">
              <input type="submit" value="Generar equipos" class="btn btn-info">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>

    </div>
    <div class="row">

      <!-- Lista de alumnos -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="h4 mb-0 pb-2 text-dark border-bottom border-secondary">
              Alumnos sin equipo <span class="badge badge-pill badge-secondary"> <?php if($suma<0){$suma=0; } echo $suma; ?></span>
            </h2>
            <ul class="list-group list-group-flush">
              <?php
              if($nEquipos ==0)
                $arregloMatriculasConEquipo[]=null;
              else
                $arregloMatriculasConEquipo;

                $consultaMatriculasConEquipo= 'SELECT matricula from equipo_integrante left join equipo on equipo_integrante.idEquipo=equipo.idEquipo where equipo.idCurso="'.$idCurso.'"';
                foreach ($conn->query($consultaMatriculasConEquipo) as $r5) {
                  $matricula = $r5['matricula'];
                  $arregloMatriculasConEquipo[]=$matricula;
                }
                $consultaAnidada="";
                
  
                  $longitud=count($arregloMatriculasConEquipo);

                if($longitud>1){
                  for ($i=0; $i <$longitud; $i++) {
                    if($i<$longitud-1){
                      $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i] ." and";                    
                    }
                    else{
                      $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i];
                    }                  
                  }
                  $consultaAlumnosEquipo3 = 'SELECT nombre from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'" and '.$consultaAnidada;
                  foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
                    $nombreAlumno2= $r7['nombre'];        
                    echo '<li class="list-group-item py-2">'.$nombreAlumno2.'</li>';
                  }
                }
                else{
                  $consultaAlumnosEquipo3 = 'SELECT nombre from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'"';
                  foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
                    $nombreAlumno2= $r7['nombre'];        
                    echo '<li class="list-group-item py-2">'.$nombreAlumno2.'</li>';
                  }
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
              Equipos <span class="badge badge-pill badge-secondary"><?php echo $nEquipos ?></span>

              <!-- Boton modal nuevo equipo -->
              <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#nuevoEquipoModal">
                Nuevo equipo
              </button>
            </h2>

            <!-- Nuevo equipo Modal -->
            <div class="modal fade" id="nuevoEquipoModal" tabindex="-1" role="dialog"
              aria-labelledby="nuevoEquipoModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="nuevoEquipoModalLabel">
                      Nuevo equipo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                      <div class="form-group">
                      <?php 
                      if($suma==0){
                        ?>
                        <div class="alert alert-danger" role="alert">
                          Todos los alumnos tienen equipo
                        </div>
                        <?php
                      }
                      else{
                        ?>

                      
                        <label class="form-label">
                          Selecciona a los integrantes:
                        </label>
                        <?php

                        $arregloMatriculasConEquipo;
                        $consultaMatriculasConEquipo= 'SELECT matricula from equipo_integrante left join equipo on equipo_integrante.idEquipo=equipo.idEquipo where equipo.idCurso="'.$idCurso.'"';
                        foreach ($conn->query($consultaMatriculasConEquipo) as $r5) {
                          $matricula = $r5['matricula'];
                          $arregloMatriculasConEquipo[]=$matricula;
                        }
                        $consultaAnidada="";
                        $longitud=count($arregloMatriculasConEquipo);
                        if($longitud>1){
                          for ($i=0; $i <$longitud; $i++) {
                            if($i<$longitud-1){
                              $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i] ." and";                    
                            }
                            else{
                              $consultaAnidada=$consultaAnidada." alumno.matricula <> ".$arregloMatriculasConEquipo[$i];
                            }                  
                          }
                          $consultaAlumnosEquipo3 = 'SELECT * from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'" and '.$consultaAnidada;
                          foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
                            $nombreAlumno2= $r7['nombre'];
                            $matriculaAlumno2= $r7['matricula'];
                            
                            echo "<div class='form-check my-2'>";
                              echo "<input class='form-check-input' type='checkbox' value='".$matriculaAlumno2."' id='GONZALO' name='alumnosNuevoEquipo[]'>";
                                echo "<label class='form-check-label' for='GONZALO'>".$nombreAlumno2."</label>";
                              
                            echo "</div>";
                          }
                        }
                        else{
                          $consultaAlumnosEquipo3 = 'SELECT * from alumno left join curso_alumno on alumno.matricula=curso_alumno.matricula where idCurso="'.$idCurso.'"';
                          foreach ($conn->query($consultaAlumnosEquipo3) as $r7) {
                            $nombreAlumno2= $r7['nombre'];
                            $matriculaAlumno2= $r7['matricula'];
                    
                            echo "<div class='form-check my-2'>";
                              echo "<input class='form-check-input' type='checkbox' value='".$matriculaAlumno2."' id='GONZALO' name='alumnosNuevoEquipo[]'>";
                                echo "<label class='form-check-label' for='GONZALO'>".$nombreAlumno2."</label>";
                              echo "</input>";
                            echo "</div>";
                          }
                        }
                        ?>
                        
                        <?php
                      }
                      ?>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Aceptar" class="btn btn-info">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Equipos -->
            <?php
              $consultaEquiposMateria = 'SELECT * FROM equipo where idCurso = "'.$idCurso.'"';
              foreach ($conn->query($consultaEquiposMateria) as $r5) {
                $idEquipo = $r5['idEquipo'];
                $nombreEquipo = $r5['nombre'];
              
              
                echo '<div class="card mb-3">';
                echo '<div class="card-header border-light font-weight-bolder"> '.$nombreEquipo.'<span class="ml-5 float-right"><a href="asignar_equipos.php?clave='.$idCurso.'&idEliminar='.$idEquipo.'" class="btn btn-outline-danger">Eliminar</a></span></div>';
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

<script>
  $(function () {
    $('[data-toggle="popover"]').popover()
  })
  $('.popover-dismiss').popover({
    trigger: 'focus'
  })
</script>