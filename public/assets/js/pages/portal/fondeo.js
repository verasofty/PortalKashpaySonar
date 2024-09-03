$(function(){

    $('#crearCaja').click(function(event){
      console.log('hei');
      $.ajax({
          url: base_url+"/fondeo/addCaja",
          data: $("#form_caja").serialize(),
          type: "post",
          dataType: "json",
          success: function(respuesta){
              if (respuesta != null) {
                  bootbox.alert({
                      message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Caja creada exitosamente.</h3>",
                      locale: 'mx'
                  });
                  setTimeout(myStopFunction, 3000);
                  //setTimeout("window.location.href = '"+urlEdit+"'", 3000);fondeo?validate=SUB1241692&level=4
              }else{
                  bootbox.alert({
                      message: "Algo salio mal, intente más tarde.",
                      locale: 'mx'
                  });
              }
              
          }
      }); 

            
    });
});


function myStopFunction() {
    location.reload();
  }