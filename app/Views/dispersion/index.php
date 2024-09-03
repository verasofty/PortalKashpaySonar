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
                  <a href="dashboard">Dispersión Nómoina</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Dispersión Nómina</li>
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
  .form-controll {
  display: block;
  width: auto;
  height: 36px;
  padding: 6px 15px;
  font-size: 14px;
  line-height: 1.49;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #dddddd;
  border-radius: 3px;
  -webkit-appearance: none;
  -webkit-transition: border-color ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s;
  transition: border-color ease-in-out .15s;
}
  </style>
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
            <div class="panel panel-visible" id="spy2">
              <form id="form_nomina" name="form_nomina" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <?php //if (session('idRol') == 1) {
                    ?>
                    <div class="form-group" id="infoOrg">
                      <label for="tipoCola">Cuenta Origen*</label>
                      <select class="form-control" id="afiliacion" name="afiliacion">
                        <option value=""></option>
                        <?php 
                          for ($iC=0; $iC < count($combo) ; $iC++) {
                            if ($combo[$iC]->type == 3 || $combo[$iC]->type == 4) {
                              $saldoSes = (session('issueId') == $combo[$iC]->bundle) ? 'selected' : '' ;
                              echo '<option '.$saldoSes.' value="'.$combo[$iC]->affiliationId.'">'.$combo[$iC]->bussinesName.'</option>';
                            } 
                          }
                        ?>
                      </select>
                    </div>
                    <?php
                    //}else{
                    ?>
                    <!--input type="hidden" id="afiliacion" name="afiliacion" value="<?php //echo $cuentas->onsignaEntity->affiliationId;?>"-->
                    <?php 
                    //} 
                    ?>
                    <div class="section">
                      <label class="field prepend-icon file">
                        <span class="button btn-primary">Seleccionar Archivo</span>
                        <input type="file" class="gui-file" name="customFile" id="customFile" onchange="document.getElementById('uploader2').value = this.value;">
                        <input type="text" class="gui-input" id="uploader2" placeholder="Seleccionar Archivo">
                        <input type="hidden" id="dateTime" name="dateTime" value="<?php echo $today_hora = date("YmdHis");?>">
                        <label class="field-icon">
                          <i class="fas fa-cloud-upload-alt text-blue"></i>
                        </label>
                      </label>
                    </div>
                    <!--div class="form-group">
                      <label for="customFile">Archivo de Dispersión</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="customFile">
                        
                        <label class="custom-file-label" for="customFile">Selecciona un Archivo</label>
                      </div>
                    </div-->
                    <div class="btn-group pull-right">
                      <a href="dashboard" class="btn btn-danger" id="cancel">
                        Cancelar
                      </a>
                      <a href="#" class="btn btn-primary" id="btn-add">
                        Aceptar
                      </a>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                </div>
              </form>    
            </div>
          </div>
          <!-- -------------- /Spec Form -------------- -->
        </div>
      </div>
        <!-- -------------- /Column Center -------------- -->
    </section>
    <!-- -------------- /Content -------------- -->

<?php 
//}else{
?>
<script>
//setTimeout("window.location.href = '"+base_url+"'", 1000);

</script>
<?php
//}
?>

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

<!-- -------------- Time/Date Dependencies JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/globalize/globalize.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/moment/moment.js"></script>

<!-- -------------- BS Dual Listbox JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- -------------- Bootstrap Maxlength JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/maxlength/bootstrap-maxlength.min.js"></script>

<!-- -------------- Select2 JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/select2/select2.min.js"></script>

<!-- -------------- Typeahead JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/typeahead/typeahead.bundle.min.js"></script>

<!-- -------------- TagManager JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/tagmanager/tagmanager.js"></script>

<!-- -------------- DateRange JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/daterange/daterangepicker.min.js"></script>

<!-- -------------- DateTime JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>

<!-- -------------- BS Colorpicker JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- -------------- MaskedInput JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/jquerymask/jquery.maskedinput.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-additional-inputs.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/nomina.js"></script>

<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>