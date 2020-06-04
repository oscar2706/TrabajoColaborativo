
$(document).ready(function () {
  $('#loginStartProf').on('click', function (event) {
    event.preventDefault();
    var email = $('#Correo').val();
    console.log("Correo: " + email);
    var password = $('#Contraseña').val();
    console.log("Contraseña: " + password);

    $.ajax({
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'Correo': email,
        'Contraseña': password
      },
      success: function (response) {
        $('#Correo').val('');
        $('#Contraseña').val('');
        if (response == 'Login Correct') {
          console.log(response);
          console.log("login Correcto");
          window.location.href = "cursos.php";
        } else if (response != 'Contraseña o usuario incorrectos') {
          $('#Correo').val('');
          $('#Contraseña').val('');
          if(! ($('#Error').length) ){
            $("#Contraseña").after(
              '<div class="alert alert-danger" id="Error">'
              +'    <strong>¡Error!</strong> <br>El correo o la contraseña son incorrectos.'
              +'</div>'
            );
          }
          console.log(response);
          console.log("login Incorrecto");
        }
      }
    });
  });

  $('#loginStartEst').on('click', function (event) {
    event.preventDefault();
    var email = $('#Correo').val();
    console.log("Correo: " + email);
    var password = $('#Contraseña').val();
    console.log("Contraseña: " + password);

    $.ajax({
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'Correo': email,
        'Contraseña': password
      },
      success: function (response) {
        $('#Correo').val('');
        $('#Contraseña').val('');
        if (response == 'Login Correct') {
          console.log(response);
          console.log("login Correcto");
          
          window.location.href = "equipos.html";
        } else if (response != 'Contraseña o usuario incorrectos') {
          $('#Correo').val('');
          $('#Contraseña').val('');
          if(! ($('#Error').length) ){
            $("#Contraseña").after(
              '<div class="alert alert-danger" id="Error">'
              +'    <strong>¡Error!</strong> <br>El correo o la contraseña son incorrectos.'
              +'</div>'
            );
          }
          console.log(response);
          console.log("login Incorrecto");
          
        }
      }
    });
  });

  $('#btnSignOutProf').on('click', function (event) {
    event.preventDefault();
    $.ajax({
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'bye': 1001
      },
      success: function (response) {
        if (response == 'Correct_Bye') {
          console.log(response);
          console.log("Bye");
          window.location.href = "login_profesor.html";
        } else if (response == 'Error') {
          console.log(response);
          console.log("Error bye");
        }
      }
    });
  });

  $('#btnSignOutEst').on('click', function (event) {
    event.preventDefault();
    $.ajax({
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'bye': 1001
      },
      success: function (response) {
        if (response == 'Correct_Bye') {
          console.log(response);
          console.log("Bye");
          window.location.href = "login_estudiante.html";
        } else if (response == 'Error') {
          console.log(response);
          console.log("Error bye");
        }
      }
    });
  });


});