<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d");
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<header id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a href="dashboard">
          <span class="fa fa-home"></span>
        </a>
      </li>
      <li class="breadcrumb-active">
        <a href="dashboard">Enviar</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Enviar</li>
    </ol>
  </div>
  <div class="topbar-right">
    <div class="ib topbar-dropdown">
    </div>
    <div class="ml15 ib va-m" id="sidebar_right_toggle">
    </div>
  </div>
</header>
  <!-- -------------- /Topbar -------------- -->
<?php
?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class=" panel">
              <div class="panel-body pn" id="formulario">
                <div class="row">
                  <div class="col-md-12" >
                    <h5 class="text-dorado">Enviar</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3" >
                                      
                  </div>
                  <div class="col-md-3">
                    <a href="spei" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">                     
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px; height: 100px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Enviar/Grupo 4613.png">
                          <p>Cuenta o celular</p>
                        </label>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="#" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">                     
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px; height: 100px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Enviar/Grupo 4413.png">
                          <p>Otros Paises</p>
                        </label>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-3">
                    
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <!-- -------------- /Spec Form -------------- -->
        </div>
      </div>
        <!-- -------------- /Column Center -------------- -->
    </section>
    <!-- -------------- /Content -------------- -->



    <!-- -------------- /Page Footer -------------- -->

  </section>
    <!-- -------------- /Main Wrapper -------------- -->
</div>
<!-- -------------- /Body Wrap  -------------- -->

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<style>
    /*page demo styles*/
    .wizard .steps .fa,
    .wizard .steps .glyphicon,
    .wizard .steps .glyphicon {
        display: none;
    }
</style>

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addLinkPago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagoDistancia.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>
  function copyClipboard(element) {
    console.log('copy');
    var co_link = $('#copy_link').text();
    console.log('co_link = '+co_link);
    var $bridge = $("<input>")
    $("body").append($bridge);
    //$bridge.val(co_link);
    document.execCommand("copy");
    $bridge.remove();
  }
  function verModal(operation, event){
    event.preventDefault();
    console.log('hi '+operation);
    var idcopy = "'#copy_link'";
    var listaLinks = '<div class="">'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8">'+
                            '<p>De clic en la url generada o comparta el link para concluir el proceso de pago.</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 panel">'+
                            '<p style="text-align:justify" id="copy_link">'+$("#"+operation).data("link")+'</p>'+
                            '<!--a type="button" class=" pull-right btn btn-primary" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('+idcopy+')">'+
                              '<i class="far fa-copy"></i>'+
                            '</a-->'+ 
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                            var estatus = '';
                            switch ($("#"+operation).data("estatuss")) {
                              case 'PAGADA':
                                estatus = '<p class="text-green">Pagada</p>';
                                break;
                              case 'CREADA':
                                estatus = '<p class="text-dorado">Pendiente de Pago</p>';
                                  break;
                              case 'EXPIRADA':
                                estatus = '<p class="text-grey">Expirada</p>';
                                    break;
                              case 'CANCELADA':
                                estatus = '<p class="text-red">Cancelada</p>';
                                    break;
                              default:
                                break;
                            }
                            listaLinks += estatus;
                listaLinks += '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                          if ($("#"+operation).data("estatuss") != 'PAGADA') {
                            var fecha = $("#"+operation).data("fechaa").split(' ');                                      
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }else{
                            var fecha = $("#"+operation).data("fechamod").split(' ');                                      
                            
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }
              listaLinks +='</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Monto</p>'+
                            '<p class="">$'+$("#"+operation).data("amount")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Concepto</p>'+
                            '<p class="">'+$("#"+operation).data("description")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<button class="btn btn-default">Cancelar</button>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                      '</div>';
                    
    bootbox.alert({
      message: listaLinks
    });

  }
</script>
</body>

</html>

<?=$this->endsection()?>