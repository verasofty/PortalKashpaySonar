<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<header id="topbar" class="alt">
      <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="dashboard">WebHook</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">WebHook</li>
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
        <!-- -------------- Spec Form -------------- -->
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="va-m">URL</th>
                        <th class="va-m">Protocolo</th>
                        <th class="va-m">Tipo SSL</th>
                        <th class="va-m">Fecha Alta</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>https://apiquality.brio.lat/redkash-proxy/api/red-kash-transaction</td>
                        <td>POST</td>
                        <td>Mutua SSL</td>
                        <td>02 Mar 2021</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- -------------- /Spec Form -------------- -->
        
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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addSpei.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

<script type="text/javascript">
   function BootboxContent(){    
    var frm_str = '<form id="addprom-form">'
                    + '<div id="message"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="cuenta">Cuenta*</label>'+
                                  '<input type="text" class="form-control" id="cuenta" name="cuenta">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  ' <button type="button" class="btn btn-primary btn-block btn_addAfiliacion">Buscar</button>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12 cuentaEncontrada">'+
                                '<div class="form-group">'+
                                  '<p><b>Cuenta encontrada.</b></p>'+
                                  '<div class="panel" style="padding: 10px;text-align: center;">'+
                                    '<p>123456789987456321</p>'+
                                    '<p>BBVA</p>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'+                              
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<p>Debe ingresar una cuenta clabe de cualquier banco.</p>'+
                                  '<p>Número de cuenta CLABE Interbancaria - 18 dígitos.</p>'+
                                '</div>'+
                              '</div>'+
                          + '</div>'
                      + '</div>'
                    + '</div>'
                + '</form>';
    var object = $('<div/>').html(frm_str).contents();
    return object
  }
</script>
</body>

</html>

<?=$this->endsection()?>