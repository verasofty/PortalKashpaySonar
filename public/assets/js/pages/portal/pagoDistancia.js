$(function(){
  var listaLinks='';

  $('#filtro').change(function(event) {

    window.location.href = base_url+'/pagoDistancia?filtro='+$(this).val()+'&page=0&validate='+contextSearch+'&email='+emailS+'&ordering='+accountS+urlD;
  
  });

});