<?php 
require_once('../config/php/conexion.php');
session_start();
$matricula = $_SESSION['matricula'];

function build_table($array){
  // start table
  $html = '<table>';
  // header row
  $html .= '<tr>';
  foreach($array[0] as $key=>$value){
      $html .= '<th>' . htmlspecialchars($key) . '</th>';
  }
  $html .= '</tr>';
  // data rows
  foreach( $array as $key=>$value){
      $html .= '<tr>';
      foreach($value as $key2=>$value2){
          $html .= '<td>' . htmlspecialchars($value2) . '</td>';
      }
      $html .= '</tr>';
  }
  $html .= '</table>';
  return $html;
}

$stmt = $conn->prepare("SELECT e.idEquipo, t.nombre as 'nombreEquipo', r.nombre as 'rubro', 
                        AVG(r.calificacion) AS promedio, COUNT(r.calificacion) AS evaluacionesRecibidas
                        FROM evaluacion AS e 
                        INNER JOIN rubro AS r ON e.idEvaluacion = r.idEvaluacion
                        INNER JOIN equipo AS t ON e.idEquipo = t.idEquipo
                        WHERE matricula = ?
                        GROUP BY e.idEquipo, r.nombre");
$stmt->execute([$matricula]); 
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo build_table($data) . "<br>";

// Generación de datos para la grafica general
$calificaciones_promedio = '';
foreach ( $data as $nombre => $valor ) {
  $calificaciones_promedio = $calificaciones_promedio . strval($valor['promedio']) . ', ';
}
$calificaciones_promedio = rtrim($calificaciones_promedio, ", ");

// generación de datos para las graficas por equipo
$resultadosEquipos = [];
foreach ( $data as $key => $valor ) {
  if (array_key_exists($valor['idEquipo'], $resultadosEquipos)) {
    $resultadosEquipos[$valor['idEquipo']] = $resultadosEquipos[$valor['idEquipo']] . strval($valor['promedio']) . ', ';
  } else {
    $resultadosEquipos[$valor['idEquipo']] = strval($valor['promedio']) . ', ';
  }
}
foreach ($resultadosEquipos as $idEquipo => $resultado){
  $resultado = rtrim($resultado, ', ');
}

// Generación ids de los equipos
$idEquipos = [];
foreach ( $data as $valor ) {
  if(!in_array($valor['idEquipo'], $idEquipos))
    array_push($idEquipos, $valor['idEquipo']);
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

  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <title>Resultados</title>
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
    <div class="row justify-content-center align-items-center my-3">
      <h1 class="font-weight-light text-center mr-3">Mis resultados de coevaluaciones</h1>
    </div>
    <!-- Contenido -->
    <div class="row justify-content-center">
      <!-- Alerta - No tiene evaluaciones -->
      <?php if(!$data): ?>
        <div class="col-12 col-md-10">
          <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>¡Aún no cuentas con coevaluaciones!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      <?php else: ?>
        <!-- Rúbrica de evaluación -->
        <div class="col-12 col-md-4 col-lg-3 mb-5">
          <div class="card shadow-lg">
            <div class="card-body">
              <h2 class="h4 mb-0 pb-2 text-dark border-bottom border-secondary">
                Rúbrica de evaluación
              </h2>
              <p class="mt-3">
                  Las puntuaciones obtenidas en las coevaluaciones se evaluaron de la siguiente manera:
                  <ul>
                  <li>5 = Excelente</li>
                  <li>4 = Bueno</li>
                  <li>3 = Regular</li>
                  <li>2 = Puede mejorar</li>
                  <li>1 = Malo</li>
                  </ul>
              </p>
            </div>
          </div>
        </div>

        <!-- Evaluación general -->
        <div class="col-12 col-md-8 col-lg-9 mb-5">
          <div class="card shadow-lg">
            <div class="card-body">
              <h2 class="h4 mb-0 pb-2 text-dark border-bottom border-secondary">
                General
              </h2>
              <!-- Grafica -->
                <canvas class="mt-3 chartjs-render-monitor" id="myChart" width="200" height="120"
                      style="display: block; height: 322px; width: 129px;"></canvas>
                <script>
                  var ctx = document.getElementById("myChart");
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: ["Aportes", "Calidad del trabajo", "Comunicación", "Disposición", "Puntualidad", "Respeto"],
                      datasets: [{
                        data: [<?php echo $calificaciones_promedio; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            steps: 5,
                            stepSize: 1,
                            min: 0,
                            max: 5,
                            callback: function(label, index, labels) {
                                switch (label) {
                                    case 0:
                                        return '';
                                    case 1:
                                        return 'Malo';
                                    case 2:
                                        return 'Puede mejorar';
                                    case 3:
                                        return 'Regular';
                                    case 4:
                                        return 'Bueno';
                                    case 5:
                                        return 'Excelente';
                                }
                            }
                          }
                        }]
                      },
                      legend: {
                        display: false
                      }
                    }
                  });
                </script>
              <!-- /Grafica -->
            </div>
          </div>
        </div>

        <!-- Evaluación por equipo -->
        <div class="col-12">
          <div class="card shadow-lg mb-5">
            <div class="card-body">
              <h2 class="h4 mb-3 pb-2 text-dark border-bottom border-secondary">Por equipo</h2>
              <!-- Equipo -->
              <?php for ($i = 0; $i <sizeof($idEquipos)*6; $i=$i+6): ?>
                <div class="card mb-3">
                  <div class="card-header border-light font-weight-bolder">
                    Equipo: <?php echo $data[$i]['nombreEquipo'] ?>
                  </div>
                  <div class="card-body px-0 py-2 text-center">
                    <div class="row justify-content-center">
                      <!-- Rubros -->
                      <div class="col-12 col-md-12 col-lg-3 justify-content-center">
                        <div class="text-secondary pb-2 pl-3">
                          Compañeros que coevaluaron: <strong><?php echo $data[$i]['evaluacionesRecibidas'] ?></strong>
                        </div> 
                        <ul class="list-group list-group-flush mb-0 px-3">
                          <?php for ($j = 0; $j <= 5; $j++): ?>
                            <li class="list-group-item px-2"><?php echo ucfirst(str_replace('_', ' del ', $data[$i+$j]['rubro'])) . ' = '.substr(strval($data[$i+$j]['promedio']), 0,3) ?></li>
                          <?php endfor; ?>
                        </ul>
                      </div>
                      <!-- /Rubros -->
                      <!-- Grafica -->
                      <div class="col-12 col-md-12 col-lg-9">
                        <canvas class="mt-3 chartjs-render-monitor" id="<?php echo $data[$i]['idEquipo'] ?>-chart" width="200" height="90"
                              style="display: block; height: 222px; width: 129px;"></canvas>
                        <script>
                          var ctx = document.getElementById("<?php echo $data[$i]['idEquipo'] ?>-chart");
                          var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                              labels: ["Aportes", "Calidad del trabajo", "Comunicación", "Disposición", "Puntualidad", "Respeto"],
                              datasets: [{
                                data: [<?php echo $resultadosEquipos[$data[$i]['idEquipo']] ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                              }]
                            },
                            options: {
                              scales: {
                                yAxes: [{
                                  ticks: {
                                    steps: 5,
                                    stepSize: 1,
                                    min: 0,
                                    max: 5,
                                    callback: function(label, index, labels) {
                                        switch (label) {
                                            case 0:
                                                return '';
                                            case 1:
                                                return 'Malo';
                                            case 2:
                                                return 'Puede mejorar';
                                            case 3:
                                                return 'Regular';
                                            case 4:
                                                return 'Bueno';
                                            case 5:
                                                return 'Excelente';
                                        }
                                    }
                                  }
                                }]
                              },
                              legend: {
                                display: false
                              }
                            }
                          });
                        </script>
                      </div>
                      <!-- /Grafica -->
                    </div>
                  </div>
                </div>
              <?php endfor; ?>
              <!-- /Equipo -->
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
</body>

</html>