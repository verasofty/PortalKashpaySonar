<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
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
        <a href="dashboard">Estado de Cuenta</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Estado de Cuenta</li>
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
  
$mesCurso = date('m');
$anio = date('Y');
  $retVal = (session('idRol') == 1) ? 'col-sm-12 col-lg-3 col-md-3' : 'col-sm-12 col-lg-4 col-md-4' ; 
  $retVal2 = (session('idRol') == 1) ? '' : 'style="display: none;"' ; 
  ?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class=" center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class=" panel">
              <form id="fom_filter" name="fom_filter" method="post">
                <div id="message"></div>
                <div class="row">
                  <div class="col-sm-12 col-md-3" <?php //echo $retVal2?>>
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Entidad</label>
                      <select class="searchFil form-control" id="idContext" name="idContext">
                        <option value=""></option>
                        <?php
                        $contexCombo = '';
                        //var_dump($cuentas);
                          if (session('idBusinessModel') == 2) {
                            $idcontext = 0;
                            $contexCombo = session('entitySonID');
                            //$contexCombo = '';
                            echo '<option selected value="'.$contexCombo.'">'.session('userNAme').'</option>';
                          }else{
                            //$idcontext = session('idcontextResponse')[0];
                            $contexCombo = session('issueId');
                            for ($iC=0; $iC < count($cuentas) ; $iC++) { 
                              if(isset($cuentas[$iC]->idSirio)){            
                                $saldoSes = ($contexCombo == $cuentas[$iC]->idSirio) ? 'selected' : '' ;
                                $nameSes = ($cuentas[$iC]->idbusinessModel == 1) ? 'Cuenta Emisora' : 'Cuenta Adquirente' ;
                                echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
  
                              }
                            }
                          }
                          
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-5">
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="mes">Mes</label>
                        <select class=" form-control" name="mes" id="mes">
                          <option></option>
                          <?php
                          $mes = array('1','2','3','4','5','6','7','8','9','10','11','12');
                          for ($iMes=0 ; $iMes < count($mes) ; $iMes++ ) { 
                            echo '<option value="'.$mes[$iMes].'">'.$mes[$iMes].'</option>';
                          }
                          ?>
                        </select>
                        <input type="hidden" id="clabe" name="clabe" />
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="anio">Año</label>
                        <select class=" form-control" name="anio" id="anio">
                          <option></option>
                          <?php
                          for ($iAnio=($anio-10) ; $iAnio <= $anio ; $iAnio++) { 
                            echo '<option value="'.$iAnio.'">'.$iAnio.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-2">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary descargaPDF">
                        <i class="far fa-file-pdf"></i> PDF
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-2">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary descargaExcel">
                        <i class="far fa-file-excel"></i> EXCEL
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class=" panel">
              
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/tarjetas.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagoDistancia.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>
$( document ).ready(function() {

  $.ajax({
    url: base_url+"/estadoCuenta/getSaldo",
    data: $("#fom_filter").serialize(),
    type: "post",
    dataType: "json",
    success: function(respuesta){
      if (respuesta.rows) {
        $('#clabe').val(respuesta.rows.clabeAccount);
      }else{
        bootbox.alert({
            message: respuesta.rows.error.message,
            locale: 'mx'
        });
      }
    }
  });
});
$(".descargaPDF").click(function(event){
  $.ajax({
    url: base_url+"/estadoCuenta/generarPDF",
    data: $("#fom_filter").serialize(),
    type: "post",
    dataType: "json",
    success: function(respuesta){
      if (respuesta.rows.success) {

      }else{
        bootbox.alert({
            message: respuesta.rows.error.message,
            locale: 'mx'
        });
      }
    }
  });
  
});
$("#idContext").change(function(event){
  $.ajax({
    url: base_url+"/estadoCuenta/getSaldo",
    data: $("#fom_filter").serialize(),
    type: "post",
    dataType: "json",
    success: function(respuesta){
      if (respuesta.rows) {
        $('#clabe').val(respuesta.rows.clabeAccount);
      }else{
        bootbox.alert({
            message: respuesta.rows.error.message,
            locale: 'mx'
        });
      }
    }
  });
});
</script>
</body>

</html>

<?=$this->endsection()?>