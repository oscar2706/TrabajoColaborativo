$(document).ready(function () {

  $('#cursoInscripcion').on('click', function (event) {
    event.preventDefault();
    var codigo = $('#codigo').val();
    console.log("codigo: " + codigo);
    

    $.ajax({
      url: '../config/php/inscripcion.php',
      type: 'POST',
      data: {
        'codigo': codigo,
      },
      success: function (response) {
        $('#codigo').val('');
        var myEle = document.getElementById("Alert");
        var myEleSuccess = document.getElementById("AlertSuccess");
        if(myEle){
          document.getElementById("Alert").remove();
        }
        if(myEleSuccess){
          document.getElementById("AlertSuccess").remove();
        }
        if (response == 'Inscrito Correcto') {
          console.log(response);
          console.log("login Correcto");
          if(! ($('#AlertSuccess').length) ){
            $("#grpCodigo").after(
              '<div class="alert alert-success alert-dismissible fade show" role="alert" id="AlertSuccess">'
              +'  <strong>¡Te has inscrito al curso con el código '+ codigo +' !</strong>'
              +'  <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
              +'    <span aria-hidden="true">&times;</span>'
              +'  </button>'
              +'</div>'
            );
          }
          $('#AlertSuccess').on('closed.bs.alert', function () {
            window.location.href = "equipos.php";
          })

        } else if (response == 'Inscrito anteriormente') {
          $('#codigo').val('');
           
          if(! ($('#Alert').length) ){
            $("#grpCodigo").after(
              '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="Alert">'
              +'  <strong>¡Ya está inscrito en este curso!</strong>'
              +'  <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
              +'    <span aria-hidden="true">&times;</span>'
              +'  </button>'
              +'</div>'
            );
          }
          console.log(response);
          console.log("Codigo Inscrito Anteriormente");
        } else if (response == 'Codigo incorrecto') {
          $('#codigo').val('');
          if(! ($('#Alert').length) ){
            
            $("#grpCodigo").after(
              '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="Alert">'
              +'  <strong>¡El curso con el código '+ codigo +' no existe!</strong>'
              +'  <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
              +'    <span aria-hidden="true">&times;</span>'
              +'  </button>'
              +'</div>'

            );
          }
          console.log(response);
          console.log("Codigo Incorrecto");
        } 
      }
    });
  });

  


});