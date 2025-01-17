<?php
session_start();
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
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
  
  <title>Coevaluación</title>
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
      <h2 class="font-weight-light mt-3 h2">Evalua a tu compañero</h2>
    </div>

    <div class="row justify-content-center">
      <!-- Cuestionario -->
      <div class="col-12 col-md-10 col-lg-10">
        <div class="card shadow">
          <div class="card-body">
            <div>
              <h2 class="h5 mb-3 pb-2 text-dark border-bottom border-secondary">
                Las coevaluaciones son anónimas por lo que te pedimos evaluar honestamente
              </h2>
            </div>

            <!-- Cuestionario -->
            <form id="cuestionario" action="../config/php/procesa_cuestionario.php" method="POST">
              <input type="hidden" name="idEquipo" value="<?php echo $_POST['idEquipo']; ?>">
              <input type="hidden" name="matricula_compañero" value="<?php echo $_POST['matricula_compañero']; ?>">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>En la escala del 1 al 5 ¿que tan buena fue la comunicación con el equipo?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="comunicacion" id="comunicacion" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>En la escala del 1 al 5 ¿Que tan puntual fue al entregar trabajos?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="puntualidad" id="puntualidad" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>En la escala del 1 al 5 ¿Que tan buena fue la calidad del trabajo de tu compañero?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="calidad_trabajo" id="calidad_trabajo" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>En la escala del 1 al 5 ¿Que tanto aporto al equipo?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="aportes" id="aportes" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>En la escala del 1 al 5 ¿Que tan buena fue la dispocición de tu compañero para trabajar?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="disposicion" id="disposicion" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  <tr>
                    <th scope="row">6</th>
                    <td>En la escala del 1 al 5 ¿Que tanto practicó el respeto entre compañeros?
                      <div class="form-group">
                        <div class="input-group">
                          <select class="custom-select" name="respeto" id="respeto" required>
                            <option selected disabled value="">Selecciona una calificacion...
                            </option>
                            <option value="1">Malo </option>
                            <option value="2">Puede Mejorar </option>
                            <option value="3">Regular</option>
                            <option value="4">Bueno</option>
                            <option value="5">Excelente</option>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="text-center">
                <button type="submit" class="btn btn-info">Terminar Coevaluación</button>
                <a class="btn btn-outline-secondary" href="ver_equipo.php" role="button">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>

</html>