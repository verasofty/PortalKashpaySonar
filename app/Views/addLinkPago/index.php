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
<style>
.form-group > label {
  bottom: 0px !important;
  left: 0px !important;
  position: relative !important;
  background-color: white !important;
  padding: 0px 5px 0px 5px !important;
  font-size: 1.1em !important;
  transition: 0.2s;
  pointer-events: none !important;
}
</style>

<?php
}else{
?>
<header id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a href="dashboard">
          <span class="fa fa-home"></span>
        </a>
      </li>
      <li class="breadcrumb-active">
        <a href="dashboard">Link de Pago</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Crear Link de Pago</li>
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

  <!-- -------------- /Topbar -------------- -->

    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <form id="form_addlinkpago" name="form_addlinkpago" method="post" enctype="multipart/form-data">
              <div class="panel panel-visible">
                <div class="panel-body pn" id="formulario">
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <a href="#" class="">
                        <div class="tooltipsGen check_option_pay" data-value="transfer">  
                          <label class="circulo"> 
                            <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/linkPago.png">
                            <p>Link de Pago</p>
                          </label>
                        </div>
                      </a>    
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="panel">
                        <p>Genera un link de pago para compartir y recibe pagos a cualquier momento en cualquier lugar.</p>
                      </div>
                      
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <h6 class="text-dorado">Ingresa los datos</h6>
                      <div style=""></div>
                    </div>
                    <div class="col-md-2"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 ">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="nombre">Nombre*</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp">
                              <input type="hidden" value="<?php echo $_GET['email'] ?>" class="form-control" id="email" name="email">
                              <input type="hidden" value="<?php echo $_GET['validate'] ?>" class="form-control" id="entitySonID" name="entitySonID">
                              <input type="hidden" value="<?php echo $_GET['ordering'] ?>" class="form-control" id="cuentaSession" name="cuentaSession">
                              <small id="nombreHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="apaterno">Apellido Paterno*</label>
                              <input type="text" class="form-control" id="apaterno" name="apaterno" aria-describedby="apaternoHelp">
                              <small id="apaternoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="amaterno">Apellido Materno*</label>
                              <input type="text" class="form-control" id="amaterno" name="amaterno" aria-describedby="amaternoHelp">
                              <small id="amaternoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Correo Electrónico*</label>
                              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                              <small id="emailHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="tel">Teléfono*</label>
                              <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp">
                              <small id="telHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="monto">Monto*</label>
                              <input type="text" class="form-control monto" id="monto" name="monto" aria-describedby="montoHelp">
                              <small id="montoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="concepto">Concepto*</label>
                              <input type="text" class="form-control" id="concepto" name="concepto" aria-describedby="conceptoHelp">
                              <small id="conceptoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="referencia">Referencia*</label>
                              <input type="text" value="<?php echo $referencia?>" maxlength="6" class="form-control soloNum" id="referencia" name="referencia" aria-describedby="referenciaHelp">
                              <small id="referenciaHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="logo">Logo</label>
                              <input type="file" name="logo" id="logo" class="form-control">
                              <small id="logoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="fechaVig">Fecha de Vigencia*</label>
                            <label for="fechaVig" class="field prepend-icon">
                              <input type="text" id="fechaVig" name="fechaVig" class="gui-input">
                                <label class="field-icon">
                                  <i class="fa fa-calendar"></i>
                                </label>
                            </label>
                            <small id="fechaVigHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="horario">Horario*</label>
                              <label for="horario" class="field prepend-icon">
                                <input type="text" id="horario" name="horario" class="gui-input">
                                <label class="field-icon">
                                    <i class="imoon imoon-clock"></i>
                                </label>
                              </label>
                              <small id="horarioHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            
                          </div>
                          <div class="col-md-6">
                            <button type="button" id="btn-add" class="pull-right btn-block btn btn-azul">Crear</button>
                          </div>
                        </div>
                      
                    </div>
                    <div class="col-md-2"></div>
                    
                  </div>
                </div>

                <div class="panel-body pn" id="informacion">
                  <div class="row">
                    <div class="co-md-12">
                      <div class="alert alert-info pastel alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <i class="fa fa-info pr10"></i>
                          ¡Link de pago generado!
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4>De clic en la url generada o comparta el link para concluir el proceso de pago.</h4>
                    </div>
                    <div class="col-md-12" id="btn-link">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Copia el siguiente código para compartirlo o insertarlo en tu página web.</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10">
                      <textarea id="texto_a_copiar" disabled class="form-control"></textarea>
                    </div>
                    <div class="col-md-2">
                      <div class="btn-group">
                        <button type="button" class="btn btn-info" id="copytext" onclick="copyClipboard('#texto_a_copiar')">
                            <i class="fa fa-copy"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Compartir en:</h4>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-4 text-center" id="whats">

                      </div>
                      <div class="col-md-4 text-center" id="twitter">
                        
                      </div>
                      <div class="col-md-4 text-center" id="face">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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