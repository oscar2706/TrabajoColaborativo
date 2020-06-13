<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es_MX">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Custom styles -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <title>Registro profesor</title>
</head>

<body class="container bg-light">
  <div class="row justify-content-center mt-4">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
      <br>
      <h1 class="text-center h2 mb-3">Crear cuenta como profesor</h1>
      <div class="card shadow-lg mb-3 bg-white">
        <div class="card-body">

          <form action="Registro.php" method="POST">
            <div class="form-group">
              <label for="Correo">Correo</label>
              <input type="text" class="form-control" name="Correo" id="Correo" required autofocus value="<?php if (isset($_SESSION['correo'])) echo $_SESSION['correo']; ?>">
            </div>
            <div class="form-group">
              <label for="Password">Contraseña</label>
              <input type="password" class="form-control" name="Password" id="Contraseña" required autofocus value="<?php if (isset($_SESSION['contraseña'])) echo $_SESSION['contraseña']; ?>">
            </div>
            <div class="form-group">
              <label for="ConfirmaPassword">Confirmar contraseña</label>
              <input type="password" class="form-control" name="ConfirmaPassword" id="ConfirmaPassword" aria-describedby="helpId" placeholder="" required autofocus>
            </div>
            <?php if (isset($_SESSION['mensaje_exito'])) : ?>
              <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <?php echo $_SESSION['mensaje_exito'] ?><br>
                <a href="login_profesor.html">Inicar sesión</a>
              </div>
              <?php unset($_SESSION['mensaje_exito']) ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['mensaje_error'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <?php echo $_SESSION['mensaje_error'] ?>
              </div>
              <?php unset($_SESSION['mensaje_error']) ?>
            <?php endif; ?>
            <button class="btn btn-info btn-block py-3 font-weight-bolder">Registrarme</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php unset($_SESSION['correo']) ?>
<?php unset($_SESSION['contraseña']) ?>