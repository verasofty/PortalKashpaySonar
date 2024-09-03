$(function(){
    $('#crearSegmento').click(function(event){
      $.ajax({
          url: base_url+"/segmento/addSegmento",
          data: $("#form_caja").serialize(),
          type: "post",
          dataType: "json",
          success: function(respuesta){
              if (respuesta.rows.success) {
                  bootbox.alert({
                      message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Segmento creado exitosamente.</h3>",
                      locale: 'mx'
                  });
                  setTimeout(myStopFunction, 3000);
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