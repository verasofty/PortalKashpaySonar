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
                  <a href="dashboard">Comisionista</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Agregar Comisionista</li>
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
          <div class="allcp-form">

              <form method="post" id="form-wizard" enctype="multipart/form-data">
                  <div class="wizard steps-bg clearfix steps-left">
                    <!-- -------------- step 1 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user pr5"></i> Datos Generales
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="safiliacion">Subafiliado*</label>
                            <select class="form-control" id="safiliacion" name="safiliacion" aria-describedby="safiliacionHelp">
                              <option></option>
                              <?php
                              for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                                if (session('idContext') == $subafiliados->contextResponse[$iSub]->idContext ) {
                                  echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                                }else{
                                  echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                                }
                                
                              }
                              ?>
                            </select>
                            <small id="safiliacionHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <!--div class="col-md-4">
                          <div class="form-group">
                            <label for="comisionista">Comisionista*</label>
                            <input type="text" class="form-control" id="comisionista" name="comisionista" aria-describedby="comisionistaHelp">
                            <small id="comisionistaHelp" class="error form-text text-muted"></small>
                          </div>
                        </div-->
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="namecommerce">Nombre del Comercio*</label>
                            <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp">
                            <small id="namecommerceHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="giro">Giro del Comercio*</label>
                            <select class="form-control" id="giro" name="giro">
                              <option></option>
                              <?php
                                $actividades = array();
                                for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                  echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                  $actividades = $giros;
                                }

                              ?>
                              <script type="text/javascript">
                                var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              </script>
                            </select>
                            <small id="giroHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="actividad">Especifica tu Actividad*</label>
                            <select class="form-control" id="actividad" name="actividad">
                              <option></option>
                            </select>
                            <small id="actividadHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                                            
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="tel">Teléfono*</label>
                            <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp">
                            <small id="telHelp" class="error form-text text-muted"></small>
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Correo electrónico*</label>
                            <input type="text" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailConfirm">Confirmar Correo electrónico*</label>
                            <input type="text" class="form-control mail" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                            <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="contrasena">Contraseña*</label>
                            <div class="smart-widget sm-right smr-160">
                              <label class="field">
                                <input type="password" name="contrasena" id="contrasena" class="gui-input espacios">
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
                            <input type="password" class="espacios form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
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
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                            <small id="cpHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="col">Colonia</label>
                            <select class="form-control" id="col" name="col">
                              <option></option>
                            </select>
                            <small id="colHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="del">Municipio/Alcaldia</label>
                            <select class="form-control" id="del" name="del">
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
                            <select class="form-control" id="edo" name="edo">
                              <option></option>
                            </select>
                            <small id="edoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Liquidación</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="fin">¿Esta cuenta recibira las liquidaciones?*</label>
                          <div class="option-group field">
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="checkbox" name="liquidacion" value="1">
                                <span class="checkbox"></span> Si
                              </label>
                            </div>
                          </div>
                        </div>
                        <!--div class="col-md-6">
                          <label for="fin">¿Esta cuenta recibira las ?*</label>
                          <div class="option-group field">
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="checkbox" name="liquidacion" value="1">
                                <span class="checkbox"></span> Si
                              </label>
                            </div>
                          </div>
                        </div-->
                      </div>
                    </section>
                    <!-- -------------- step 3 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user-secret pr5"></i> Datos Legales</h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Datos Fiscales</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="rfcFiscal">RFC</label>
                            <input type="text" maxlength="13" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp">
                            <small id="rfc
                            Help" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="razonSFiscal">Razón Social</label>
                            <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp">
                            <small id="razonSFiscalHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="regFiscal">Regimen Fiscal</label>
                            <select class="form-control" id="regFiscal" name="regFiscal">
                              <option></option>
                              <?php
                              for ($iregFis=0; $iregFis < count($regimenFiscal->catFiscalRegimes); $iregFis++) { 
                                echo '<option value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                              }
                              ?>
                            </select>
                            <small id="regFiscalHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Representante Legal</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nombreRep">Nombre</label>
                            <input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp">
                            <small id="nombreRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aPaternoRep">Apellido Paterno</label>
                            <input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp">
                            <small id="aPaternoRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aMaternoRep">Apellido Materno</label>
                            <input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp">
                            <small id="aMaternoRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Dirección del Representante Legal</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calleRep">Calle</label>
                            <input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp">
                            <small id="calleRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExtRep">Número Exterior</label>
                            <input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp">
                            <small id="numExtRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numIntRep">Número Interior</label>
                            <input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp">
                            <small id="numIntRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cpRep">Código Postal</label>
                            <input type="text" class="form-control soloNum" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">
                            <small id="cpRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="colRep">Colonia</label>
                            <select class="form-control" id="colRep" name="colRep">
                              <option></option>
                            </select>
                            <small id="colRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="delRep">Municipio/Alcaldia</label>
                            <select class="form-control" id="delRep" name="delRep">
                              <option></option>
                            </select>
                            <small id="delRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="edoRep">Estado</label>
                            <select class="form-control" id="edoRep" name="edoRep">
                              <option></option>
                            </select>
                            <small id="edoRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Contacto del Representante Legal</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailRep">Correo Electronico</label>
                            <input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp">
                            <small id="emailRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telRep">Teléfono</label>
                            <input type="tel" maxlength="10" class="form-control soloNum" id="telRep" name="telRep" aria-describedby="telRepHelp">
                            <small id="telRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telAdiRep">Teléfono Adicional</label>
                            <input type="tel" maxlength="10" class="form-control soloNum" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp">
                            <small id="telAdiRepHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Documentos Legales</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <code>** Los documentos legales no son obligatorios pero deben ser compartidos via correo electrónico para su validación **</code>
                        </div>
                        <div style="height: 30px;"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ine">Identificación Oficial</label>
                            <input type="file" class="form-control file" id="ine" name="ine" aria-describedby="ineHelp">
                            <small id="ineHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cfe">Comprobante de Domicilio</label>
                            <input type="file" class="form-control file" id="cfe" name="cfe" aria-describedby="cfeHelp">
                            <small id="cfeHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="acta">Acta Constitutiva</label>
                            <input type="file" class="form-control file" id="acta" name="acta" aria-describedby="actaHelp">
                            <small id="actaHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- -------------- step 4 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-file-text pr5"></i> Contactos</h4>
                    <section class="wizard-section">

                      <div class="row">
                        <div class="col-md-12">
                          <h3>Contacto Comercial</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nombreCom">Nombre</label>
                            <input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                            <small id="nombreComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aPaternoCom">Apellido Paterno</label>
                            <input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp">
                            <small id="aPaternoComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aMaternoCom">Apellido Materno</label>
                            <input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp">
                            <small id="aMaternoComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailCom">Correo Electrónico</label>
                            <input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp">
                            <small id="emailComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telCom">Teléfono</label>
                            <input type="tel" class="form-control soloNum" maxlength="10" id="telCom" name="telCom" aria-describedby="telComHelp">
                            <small id="telComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telAdiCom">Teléfono Adicional</label>
                            <input type="tel" class="form-control soloNum" maxlength="10" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">
                            <small id="telAdiComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inicioCom">Inicio</label>
                            <label for="inicioCom" class="field prepend-icon">
                              <input type="text" id="inicioCom" name="inicioCom" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="inicioComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="finCom">Fin</label>
                            <label for="finCom" class="field prepend-icon">
                              <input type="text" id="finCom" name="finCom" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="finComHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin">Dias*</label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                  <input type="checkbox" name="diasC[]" value="Lun">
                                  <span class="checkbox"></span> Lunes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasC[]" value="Mar">
                                  <span class="checkbox"></span> Martes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasC[]" value="Mie">
                                  <span class="checkbox"></span> Miercoles
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasC[]" value="Jue">
                                  <span class="checkbox"></span> Jueves
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary mt10">
                                <input type="checkbox" name="diasC[]" value="Vie">
                                <span class="checkbox"></span> Viernes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasC[]" value="Sab">
                                  <span class="checkbox"></span> Sabado
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasC[]" value="Dom">
                                  <span class="checkbox"></span> Domingo
                              </label>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Contacto de Soporte</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nombreSop">Nombre</label>
                            <input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp">
                            <small id="nombreSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aPaternoSop">Apellido Paterno</label>
                            <input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp">
                            <small id="aPaternoSopHElp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aMaternoSop">Apellido Materno</label>
                            <input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp">
                            <small id="aMaternoSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>   
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailSop">Correo Electrónico</label>
                            <input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp">
                            <small id="emailSopHElp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telSop">Teléfono</label>
                            <input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">
                            <small id="telSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telAdiSop">Teléfono Adicional</label>
                            <input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">
                            <small id="telAdiSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inicioSop">Inicio</label>
                            <label for="inicioCom" class="field prepend-icon">
                              <input type="text" id="inicioSop" name="inicioSop" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="inicioSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="finSop">Fin*</label>
                            <label for="finSop" class="field prepend-icon">
                              <input type="text" id="finSop" name="finSop" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="finSopHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin">Dias*</label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                  <input type="checkbox" name="diasS[]" value="Lun">
                                  <span class="checkbox"></span> Lunes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasS[]" value="Mar">
                                  <span class="checkbox"></span> Martes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasS[]" value="Mie">
                                  <span class="checkbox"></span> Miercoles
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasS[]" value="Jue">
                                  <span class="checkbox"></span> Jueves
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary mt10">
                                <input type="checkbox" name="diasS[]" value="Vie">
                                <span class="checkbox"></span> Viernes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasS[]" value="Sab">
                                  <span class="checkbox"></span> Sabado
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasS[]" value="Dom">
                                  <span class="checkbox"></span> Domingo
                              </label>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Contacto Financiero</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nombreFin">Nombre</label>
                            <input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <small id="nombreFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aPaternoFin">Apellido Paterno</label>
                            <input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp">
                            <small id="aPaternoFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="aMaternoFin">Apellido Materno</label>
                            <input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp">
                            <small id="aMaternoFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="emailFin">Correo Electrónico</label>
                            <input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp">
                            <small id="emailFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telFin">Teléfono</label>
                            <input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">
                            <small id="telFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="telAdiFin">Teléfono Adicional</label>
                            <input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">
                            <small id="telAdiFin" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inicioFin">Inicio</label>
                            <label for="inicioFin" class="field prepend-icon">
                              <input type="text" id="inicioFin" name="inicioFin" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="inicioFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="finFin">Fin</label>
                            <label for="finFin" class="field prepend-icon">
                              <input type="text" id="finFin" name="finFin" class="gui-input">
                              <label class="field-icon">
                                  <i class="imoon imoon-clock"></i>
                              </label>
                            </label>
                            <small id="finFinHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin">Dias*</label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                  <input type="checkbox" name="diasF[]" value="Lun">
                                  <span class="checkbox"></span> Lunes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasF[]" value="Mar">
                                  <span class="checkbox"></span> Martes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasF[]" value="Mie">
                                  <span class="checkbox"></span> Miercoles
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasF[]" value="Jue">
                                  <span class="checkbox"></span> Jueves
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary mt10">
                                <input type="checkbox" name="diasF[]" value="Vie">
                                <span class="checkbox"></span> Viernes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diaF[]" value="Sab">
                                  <span class="checkbox"></span> Sabado
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="diasF[]" value="Dom">
                                  <span class="checkbox"></span> Domingo
                              </label>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </section>

                    <!-- -------------- step 4 -------------- 
                    <h4 class="wizard-section-title">
                        <i class="fa fa-file-text pr5"></i> Promociones</h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-4">
                          <button type="button" class="btn btn-primary btn-block btn_addPromo">Agregar Promociones</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div style="height: 30px;"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="panel-body pn">
                            <div class="bs-component">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead class="bg-primary br6">
                                  <thead class="bg-dark">
                                    <tr>
                                      <th class="br-t-n pl30">Criterio</th>
                                      <th class="br-t-n hidden-xs">Condición</th>
                                      <th class="br-t-n">Monto Mínimo</th>
                                      <th class="br-t-n">Plazo</th>
                                      <th class="br-t-n">Plan</th>
                                      <th class="br-t-n">Plan</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td class="pl30">#4551</td>
                                      <td class="hidden-xs">Oct 10, 2014</td>
                                      <td>Oct 10, 2015</td>
                                      <td><span class="label label-success ml5">Done</span></td>
                                      <td><span class="label label-success ml5">Done</span></td>
                                      <td><span class="label label-success ml5">Done</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>-->

                    <!-- -------------- step 6 -------------- 
                    <h4 class="wizard-section-title">
                        <i class="fa fa-file-text pr5"></i> Módulos</h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                  <input type="checkbox" name="mobile" value="iphone5">
                                  <span class="checkbox"></span> Lunes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5c">
                                  <span class="checkbox"></span> Martes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Miercoles
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Jueves
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary mt10">
                                <input type="checkbox" name="mobile" value="iphone5s">
                                <span class="checkbox"></span> Viernes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Sabado
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Domingo
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary mt10">
                                <input type="checkbox" name="mobile" value="iphone5s">
                                <span class="checkbox"></span> Viernes
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Sabado
                              </label>
                              <label class="option block option-primary mt10">
                                  <input type="checkbox" name="mobile" value="iphone5s">
                                  <span class="checkbox"></span> Domingo
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section> -->
                  </div>
                  <!-- -------------- /Wizard -------------- -->
              </form>
              <!-- -------------- /Form -------------- -->

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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addComisionista.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addComisionista.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.locales.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-addComisionista.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addComisionista.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>