
//$.noConflict();
$(document).ready(function() {

  $('#loginStart').on('click', function(event){
    event.preventDefault();
    console.log("funcion cargada");
    var email = $('#Correo').val();
    console.log("Correo: "+email);
    var password = $('#Contraseña').val();
    console.log("Contraseña: "+password);

    // proceed with form submission
    $.ajax({
      //ruta del archivo desde login_profesor
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'Correo' : email,
        'Contraseña' : password
      },
      success: function(response){
        $('#Correo').val('');
        $('#Contraseña').val('');
       
        if (response == 'Login Correct' ) {
          console.log(response);
          console.log("login Correcto");
          alert('Login Correcto');
          window.location.href = "cursos.php";
          
        }else if (response != 'Contraseña o usuario incorrectos') {
          
          console.log(response);
          console.log("login Incorrecto");
          alert("Contraseña o usuario incorrectos");


        }
        
      }
    });
      
  });

 
$('#btnSignOut').on('click', function(event){
    event.preventDefault();
    console.log("Cerrando Sesión");


    // proceed with form submission
    $.ajax({
      url: '../config/php/login_profesor.php',
      type: 'POST',
      data: {
        'bye' : 1001
      },
      success: function(response){
       
        if (response == 'Correct_Bye' ) {
          console.log(response);
          console.log("Bye");
          window.location.href = "../index.html";
          
        }else if (response == 'Error') {
          
          console.log(response);
          console.log("Error bye");
 


        }
        
      }
    });
      
  });


});