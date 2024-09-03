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
        <a href="dashboard">Link de Negocio</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-link">
        <a href="pagpDistancia">Pago a Distancia</a>
      </li>
      <li class="breadcrumb-current-item">Link de Negocio</li>
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
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <form id="form_addColaborador" name="form_addColaborador" method="post" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <a href="#" class="">
                        <div class="tooltipsGen check_option_pay" data-value="transfer">  
                          <label class="circulo"> 
                            <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/linkPago.png">
                            <p>Link de Negocio</p>
                          </label>
                        </div>
                      </a>    
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 panel">
                      <p>Envía tu link personalizado o publícalo para recibir pagos de manera rápida y fácil, en cualquier momento en cualquier lugar.</p>
                    </div>
                    <div class="col-md-2"></div>

                  </div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 ">
                      <p class="text-dorado">Tu link</p>
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 panel">
                      <div class="col-md-10 text-blue-link" id="texto0_a_copiar">
                       <a class="text-blue-link" href="<?php echo base_url()?>/linkNegocio?validate=<?php echo $_GET['validate']?>" target="_blank" id="texto_a_copiar"> <?php echo base_url()?>/linkNegocio?validate=<?php echo $_GET['validate']?> </a>
                      </div>
                      <div class="col-md-2 text-dorado ">
                        <a class="pull-right text-dorado notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#texto_a_copiar')">
                          <i class="far fa-copy"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row">
                    <div style="height:90px"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8 ">
                      <div class="col-md-4 text-center" id="whats">
                        <a target="_blank" href="#" class="text-blue whatsapp_mx text-20"><i class="fab fa-whatsapp"></i></a>
                      </div>
                      <div class="col-md-4 text-center email_mx" id="twitter">
                        <a target="_blank" href="#" class="text-blue text-20"><i class="fas fa-at"></i></a>                        
                      </div>
                      <div class="col-md-4 text-center" id="face">
                        <a href="javascript: history.go(-1)" class="text-blue text-20"><i class="fas fa-undo"></i></a>
                      </div>
                    </div>
                    <div class="col-md-2"></div>
                    
                  </div>
                </form>
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
<script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>

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
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-file-notifications.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/verLinkNegocio.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

<script>

</script>
</body>

</html>

<?=$this->endsection()?>