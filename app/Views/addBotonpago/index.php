<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
if (!isset($_GET['isMovil'])) {
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
<header style="background: #333F50;" id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <button onclick="history.back()" class="text-blanco backPrepago" style="font-size: 22px;" href="#">
          <i class="fas fa-arrow-left"></i>
        </button>
      </li>
    </ol>
  </div>
  <div class="topbar-right">
    <div class="ib topbar-dropdown">
    </div>
    <div class="ml15 ib va-m" id="sidebar_right_toggle">
    </div>
  </div>
</header>
<?php
}
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
        <a href="dashboard">Boton de Pago</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Crear boton de Pago</li>
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

    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class="panel panel-visible">
              <div class="panel-body pn" id="formulario">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <a href="#" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">  
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/botonPago.png">
                          <p>Botón de Pago</p>
                        </label>
                      </div>
                    </a>    
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 panel">
                    <p>¡Personaliza tu link de negocio! Crea tu propio botón de pago </p>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 ">
                    <form id="form_addlinkpago" name="form_addlinkpago" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="nombre">Tu <b>Link de Negocio</b> es:</label>
                            <div class="panel">
                              <a class="text-blue-link" href="<?php echo base_url()?>/linkNegocio?validate=<?php echo $_GET['validate']?>" target="_blank" id="texto_a_copiar"> <?php echo base_url()?>/linkNegocio?validate=<?php echo $_GET['validate']?> </a>
                            </div>
                            <input type="hidden" disable class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" value="<?php echo base_url()?>/linkNegocio?validate=<?php echo $_GET['validate']?>">
                            <small id="nombreHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>                        
                      </div>
                      <div style="height:30px;"></div>
                      <div class="row">
                        <div class="col-md-12">
                          <p>Selecciona el tipo de botón que deseas establecer a tus cobros</p>
                        </div>
                      </div>
                      <div style="height:30px;"></div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="btn-select" data-clase="btn-azul">
                            <a class="pull-right btn-block btn-opcion btn btn-azul">Pagar con Kash</a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="btn-select" data-clase="btn-azul-degradado">
                            <a class="pull-right btn-block btn btn-azul-degradado">Pagar con Kash</a>
                          </div>
                        </div>
                      </div>
                      <div style="height:30px;"></div>

                      <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                          <div class="btn-select" data-clase="btn-blanco">
                            <a class="pull-right btn-block btn btn-blanco">Pagar con Kash</a>
                          </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                      </div>
                      <div style="height:90px;"></div>
                      
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <button type="button" id="btn-add" class="pull-right btn-block btn btn-azul">Generar Boton</button>
                        </div>
                        <div class="col-md-3"></div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-2"></div>
                </div>
              </div>

              <div class="panel-body pn" id="detalleBoton">
                <div class="row">
                  <div class="col-md-2 mb-5"></div>
                  <div class="col-md-8 mb-5">
                    <div class="panel panel-visible">
                      <div class="panel-body pn areaForm">
                        <div class="row">
                          <div class="col-md-12 mb-5">
                            <div class="col-md-12">
                              <a id="btn-pago" class="pull-right btn-block btn-opcion btn">Pagar con Kash</a>
                            </div>
                            <div class="col-md-12">
                              <div style="height:15px;"></div>
                              <p class="text-center">Débito | crédito | efectivo | SPEI</p>
                            </div>
                            <div class="col-md-12">
                              <img style="width:100%;padding: 15px 0px;" src="<?php echo base_url()?>/public/assets/img/linkPago/marcas.png">
                            </div>
                            <div class="col-md-12">
                              <div style="height:15px;"></div>
                              <textarea id="copy_link" class="form-control codebtn"></textarea>
                              <a style="margin-top: 10px;" type="button" class=" pull-right text-dorado notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_link')">
                                <i class="far fa-copy"></i>
                              </a>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                    </div>
                    <div class="row" id="detalles">
                        
                    </div>
                  </div>
                  <div class="col-md-2 mb-5"></div>
                </div>
              </div>
              <div class="row" id="detalle"></div>
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
<script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-file-notifications.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addBotonPago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

<script>
  var formData = new FormData(document.getElementById("form_addlinkpago"));

  function validarEmail(valor) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
     $('#mail').css('border','1px solid #ced4da');
      $('#error_mail').html('');
    } else {
     $('#mail').css('border','1px solid red');
     $('#error_mail').html('Ingresa un email válido.');
    }
  }

</script>
</body>

</html>

<?=$this->endsection()?>