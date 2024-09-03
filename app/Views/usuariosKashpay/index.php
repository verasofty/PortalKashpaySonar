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
                  <a href="dashboard">Usuarios Kashpay</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Usuarios Kashpay</li>
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
                <form id="form_addColaborador" name="form_addColaborador" method="post">
                  <div class="row">
                    <div class="col-md-12">

                    <section class="wizard-section">
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="safiliacion">Nombre de Usuario*</label>
                            <input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" required>
                            <small id="nombreSopHelp" class="error form-text text-muted"></small>
                          </div>
                          </div>
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="aPaternoSop">Apellido Paterno</label>
                            <input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" required>
                            <small id="aPaternoSopHElp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="aMaternoSop">Apellido Materno</label>
                            <input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" required>
                            <small id="aMaternoSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        </div>
                              
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="actividad">Empresa*</label>
                            <input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" required>
                            <small id="nombreSopHelp" class="error form-text text-muted"></small>
                          </div>
                          </div>
                         
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Puesto*</label>
                            <input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" required>
                            <small id="nombreSopHelp" class="error form-text text-muted"></small>
                          </div>
                          </div>                   
                      
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailConfirm">Correo Electrónico*</label>
                            <input type="text" class="form-control" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp" required>
                            <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="contrasena">Contraseña*</label>
                            <div class="smart-widget sm-right smr-160">
                              <label class="field">
                                <input type="password" name="contrasena" id="contrasena" class="gui-input" required>
                              </label>
                              <button type="button" class="button btn-primary generatePass">Generar</button>
                            </div>
                            <code id="vercontrasena"></code>
                            <small id="contrasenaHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="confPass">Confirmar Contraseña*</label>
                            <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp" required>
                            <small id="confPassHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Dirección</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" required>
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" >
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" >
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" required>
                            <small id="cpHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="col">Colonia</label>
                            <select class="form-control" id="col" name="col" required>
                              <option></option>
                            </select>
                            <small id="colHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="del">Municipio/Alcaldia</label>
                            <select class="form-control" id="del" name="del" required>
                              <option></option>
                            </select>
                            <small id="delHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="edo">Estado</label>
                            <select class="form-control" id="edo" name="edo" required>
                              <option></option>
                            </select>
                            <small id="edoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </section>

                    <div class="row">
                    <div class="col-md-6">
                      
                    </div>
                    <div class="col-md-6">
                      <button type="button" id="btn-add" class="pull-right btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- Plugins -------------- -->

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addEntidad.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addEntidad.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-addEntidad.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addEntidad.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>