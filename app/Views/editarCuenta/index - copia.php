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
                  <a href="dashboard">Editar cuenta</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Editar cuenta</li>
          </ol>
      </div>
      <div class="topbar-right">
        <div class="ib topbar-dropdown">
        </div>
        <div class="ml15 ib va-m" id="sidebar_right_toggle">
        </div>
      </div>
  </header>
  <script type="text/javascript">
    var level = '<?php echo $_GET['level']?>';
    var validate = '<?php echo $_GET['validate']?>';
  </script>
  <!-- -------------- /Topbar -------------- -->
        <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form">
            <?php if ($_GET['level'] == 2) {
              // admin
            ?>
            <?php } ?>
            <?php if ($_GET['level'] == 3) { 
              // subAfiliado
              $curlCuenta = curl_init();

              curl_setopt_array($curlCuenta, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?id='.$_GET['validate'].'&level='.$_GET['level'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=0daa4c50c83dc3f9487daced4b8f'
                ),
              ));

              $responseCuenta = curl_exec($curlCuenta);
              curl_close($curlCuenta);

              $datos['rows'] = json_decode($responseCuenta);

              //var_dump($datos);

              $isRLegal = 'na';
              $isComercial = 'na';
              $isSoporte = 'na';
              $isFinanzas = 'na';
              $rLegaltype = '';
              $comercialtype = '';
              $soportetype = '';
              $finanzastype = '';
              $rLegalcp = '';
              if ($datos['rows']->entityInfo->contacts != null) {
                for ($iCont=0; $iCont < count($datos['rows']->entityInfo->contacts) ; $iCont++) { 
                  if ($datos['rows']->entityInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    $rLegalcp = $datos['rows']->entityInfo->contacts[$iCont]->address->idLocation;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 2) {
                    $isComercial = 'existe';
                    $comercialtype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 3) {
                    $isSoporte = 'existe';
                    $soportetype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 4) {
                    $isFinanzas = 'existe';
                    $finanzastype = $iCont;
                  }
                }
              }

            ?>
              <script type="text/javascript">
                var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
              </script>
              <form method="post" enctype="multipart/form-data" id="form-wizard-subafiliado">
                <div class="wizard steps-bg clearfix steps-left">
                  <!-- -------------- step 1 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Datos Generales
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="safiliacion">Nombre*</label>
                          <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp" value="<?php echo $valnameCommerce = ($datos['rows']->entityInfo->nameCommerce != 'ND') ? $datos['rows']->entityInfo->nameCommerce : 'ss' ; ?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $datos['rows']->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="nivel" name="nivel" value="3">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $datos['rows']->entityInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $datos['rows']->entityInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $datos['rows']->entityInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $datos['rows']->entityInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $datos['rows']->entityInfo->guid?>">
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="entidad">RFC*</label>
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $datos['rows']->entityInfo->rfc?>">
                          <small id="rfcHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($datos['rows']->entityInfo->phoneNumber != '0') ? $datos['rows']->entityInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
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
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $datos['rows']->entityInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $datos['rows']->entityInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($datos['rows']->entityInfo->address->interiorNumber != 'ND') ? $datos['rows']->entityInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $datos['rows']->entityInfo->address->postalCode?>">
                            <small id="cpHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="col">Colonia*</label>
                            <select class="form-control" id="col" name="col">
                              <option></option>
                            </select>
                            <small id="colHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="del">Municipio/Alcaldia*</label>
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
                            <label for="edo">Estado*</label>
                            <select class="form-control" id="edo" name="edo">
                              <option></option>
                            </select>
                            <small id="edoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                  </section>
                  <!-- -------------- step 2 -------------- -->
                  <h4 class="wizard-section-title">
                        <i class="fa fa-user pr5"></i> Reglas
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Tipo de Sub Afiliado</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="agregador">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="comisionista">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="puntoVenta">
                              <span class="radio"></span> Punto de venta
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Dispersión de transacciones</h3>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="otra">
                              <span class="radio"></span> RED otra cuenta
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <div class="form-group divElemento">
                              <label for="elemento">Elige un elemento</label>
                              <select class="form-control" id="elemento" name="elemento">
                                <option></option>
                              </select>
                              <small id="elementoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="fueraCuenta">Cuenta</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                              <small id="cpHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                              <small id="cpHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Liquidación de Transacciones</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin">¿Esta cuenta recibira las liquidaciones?*</label>
                        <div class="option-group field">
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Facturación de Transacciones</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="option-group field">
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="elemento">Elige el periodo</label>
                              <select class="form-control" id="elemento" name="elemento">
                                <option></option>
                                <option>Mes</option>
                                <option>Quincena</option>
                                <option>Semana</option>
                                <option>Día</option>
                              </select>
                              <small id="elementoHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
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
                          <!--div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" name="dispersion" value="otra">
                              <span class="radio"></span> RED otra cuenta
                            </label>
                          </div>
                          <div class="col-md-12 adi">
                          </div-->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Modelo de Negocio</h3>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="emision">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="adquirente">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="mixto">
                              <span class="radio"></span> Mixto
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </section>
                  <!-- -------------- step 3 -------------- -->
                  <h4 class="wizard-section-title">
                    <i class="fa fa-user-secret pr5"></i> Datos Legales
                  </h4>
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
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="ine" name="ine" aria-describedby="ineHelp">
                          <small id="ineHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cfe">Comprobante de Domicilio</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="cfe" name="cfe" aria-describedby="cfeHelp">
                          <small id="cfeHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="acta">Acta Constitutiva</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="acta" name="acta" aria-describedby="actaHelp">
                          <small id="actaHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->constitutiveActFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- -------------- step 4 -------------- -->
                  <h4 class="wizard-section-title">
                    <i class="fa fa-file-text pr5"></i> Contactos
                  </h4>
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

                </div>
                <!-- -------------- /Wizard -------------- -->
              </form>
              <!-- -------------- /Form -------------- -->
            <?php } ?>
            <?php if ($_GET['level'] == 4) { 
              // entidad
              $curlCuenta = curl_init();

              curl_setopt_array($curlCuenta, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?id='.$_GET['validate'].'&level='.$_GET['level'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=ac48d2d3406bcb7cc60a6ecd6daa'
                ),
              ));

              $responseCuenta = curl_exec($curlCuenta);
              curl_close($curlCuenta);

              $datos['rows'] = json_decode($responseCuenta);

              //print_r($datos);

              $isRLegal = 'na';
              $isComercial = 'na';
              $isSoporte = 'na';
              $isFinanzas = 'na';
              $rLegaltype = '';
              $comercialtype = '';
              $soportetype = '';
              $finanzastype = '';
              $rLegalcp = '';
              if ($datos['rows']->entityInfo->contacts != null) {
                for ($iCont=0; $iCont < count($datos['rows']->entityInfo->contacts) ; $iCont++) { 
                  if ($datos['rows']->entityInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    $rLegalcp = $datos['rows']->entityInfo->contacts[$iCont]->address->idLocation;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 2) {
                    $isComercial = 'existe';
                    $comercialtype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 3) {
                    $isSoporte = 'existe';
                    $soportetype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 4) {
                    $isFinanzas = 'existe';
                    $finanzastype = $iCont;
                  }
                }
              }
            ?>
              <form method="post" enctype="multipart/form-data" id="form-wizard-entidad">
                <div class="wizard steps-bg clearfix steps-left">
                  <!-- -------------- step 1 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Datos Generales
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Nombre del Comercio*</label>
                          <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp" value="<?php echo $valnameCommerce = ($datos['rows']->entityInfo->nameCommerce != 'ND') ? $datos['rows']->entityInfo->nameCommerce : 'ss' ; ?>">
                          <input type="hidden" id="nivel" name="nivel" value="4">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $datos['rows']->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $datos['rows']->entityInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $datos['rows']->entityInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $datos['rows']->entityInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $datos['rows']->entityInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $datos['rows']->entityInfo->guid?>">
                          <small id="namecommerceHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $datos['rows']->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $datos['rows']->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $datos['rows']->entityInfo->address->postalCode?>';
                              <?php
                              if ($datos['rows']->entityInfo->contacts != null) {
                              ?>
                              var cpSelectedCon = '<?php echo$rLegalcp?>';
                              <?php
                              }else{
                              ?>
                              var cpSelectedCon = '';
                              <?php
                              }
                              ?>
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
                          <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $datos['rows']->entityInfo->phoneNumber?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $datos['rows']->entityInfo->email?>">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailConfirm">Confirmar Correo electrónico*</label>
                          <input type="text" class="form-control" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                          <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <div class="row">
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="contrasena">Contraseña*</label>
                          <div class="smart-widget sm-right smr-160">
                            <label class="field">
                              <input type="password" name="contrasena" id="contrasena" class="gui-input">
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
                          <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
                          <small id="confPassHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
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
                          <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $datos['rows']->entityInfo->address->street?>">
                          <small id="calleHelp" class="error form-text text-muted"></small>
                        </div>
                        <script type="text/javascript">
                          var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
                        </script>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExt">Número Exterior</label>
                          <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $datos['rows']->entityInfo->address->exteriorNumber?>">
                          <small id="numExtHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numInt">Número Interior</label>
                          <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($datos['rows']->entityInfo->address->interiorNumber != 'ND') ? $datos['rows']->entityInfo->address->interiorNumber : '' ; ?>">
                          <small id="numIntHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cp">Código Postal</label>
                          <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $valcp = ($datos['rows']->entityInfo->address->postalCode != '0') ? $datos['rows']->entityInfo->address->postalCode : '' ; ?>">
                          <small id="cpHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="col">Colonia</label>
                          <select class="form-control" id="col" name="col">
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
                  </section>
                  <!-- -------------- step 2 -------------- -->
                  <h4 class="wizard-section-title">
                    <i class="fa fa-user pr5"></i> Reglas
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Tipo de Sub Afiliado</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="agregador">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="comisionista">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input type="radio" name="typeSub" value="puntoVenta">
                              <span class="radio"></span> Punto de venta
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Dispersión de transacciones</h3>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="dispersion" value="otra">
                              <span class="radio"></span> RED otra cuenta
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <div class="form-group divElemento">
                              <label for="elemento">Elige un elemento</label>
                              <select class="form-control" id="elemento" name="elemento">
                                <option></option>
                              </select>
                              <small id="elementoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="fueraCuenta">Cuenta</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                              <small id="cpHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                              <small id="cpHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Liquidación de Transacciones</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin">¿Esta cuenta recibira las liquidaciones?*</label>
                        <div class="option-group field">
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Facturación de Transacciones</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="option-group field">
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="elemento">Elige el periodo</label>
                              <select class="form-control" id="elemento" name="elemento">
                                <option></option>
                                <option>Mes</option>
                                <option>Quincena</option>
                                <option>Semana</option>
                                <option>Día</option>
                              </select>
                              <small id="elementoHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
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
                          <!--div class="col-md-12">
                            <label class="option block option-primary">
                              <input type="radio" name="dispersion" value="otra">
                              <span class="radio"></span> RED otra cuenta
                            </label>
                          </div>
                          <div class="col-md-12 adi">
                          </div-->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Modelo de Negocio</h3>
                      </div>
                    </div>        
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="emision">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="adquirente">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input class="tipoDis" type="radio" name="modelo" value="mixto">
                              <span class="radio"></span> Mixto
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </section>
                  <!-- -------------- step 3 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user-secret pr5"></i> Datos Legales
                  </h4>
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
                          <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $datos['rows']->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $datos['rows']->entityInfo->businessName?>">
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
                              if ($datos['rows']->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
                                echo '<option selected value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                              }else{
                                echo '<option value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                              }
                              
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->name.'" >
                            <input type="hidden" name="idContRep" name="idContRep" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" name="idContRep" name="idContRep" value="0">';
                          }
                          ?>
                          
                          <small id="nombreRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoRep">Apellido Paterno</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoRep">Apellido Materno</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp">';
                          }
                          ?>
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->street.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" >';
                          }
                          ?>
                          <small id="calleRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExtRep">Número Exterior</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->exteriorNumber.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp">';
                          }
                          ?>
                          <small id="numExtRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numIntRep">Número Interior</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->interiorNumber.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp">';
                          }
                          ?>
                          <small id="numIntRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cpRep">Código Postal</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->postalCode.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                          }
                          ?>
                          
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" >';
                          }
                          ?>
                          
                          <small id="emailRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telRep">Teléfono</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
                          }
                          ?>
                          
                          <small id="telRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiRep">Teléfono Adicional</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
                          }
                          ?>
                          
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
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="ine" name="ine" aria-describedby="ineHelp">
                          <small id="ineHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cfe">Comprobante de Domicilio</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="cfe" name="cfe" aria-describedby="cfeHelp">
                          <small id="cfeHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="acta">Acta Constitutiva</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="acta" name="acta" aria-describedby="actaHelp">
                          <small id="actaHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->constitutiveActFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
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
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->name.'" >
                            <input type="hidden" name="idContCom" name="idContCom" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                            <input type="hidden" name="idContCom" name="idContCom" value="0">';
                          }
                          ?>
                          
                          <small id="nombreComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoCom">Apellido Paterno</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp">';
                          }
                          ?>
                          <small id="aPaternoComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoCom">Apellido Materno</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailCom">Correo Electrónico</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp">';
                          }
                          ?>
                          
                          <small id="emailComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telCom">Teléfono</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
                          }
                          ?>
                          
                          <small id="telComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiCom">Teléfono Adicional</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
                          }
                          ?>
                          
                          <small id="telAdiComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioCom">Inicio</label>
                          <label for="inicioCom" class="field prepend-icon">
                            <?php 
                            if ($isComercial == 'existe') {
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->startTime.'" >';
                            }else{
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input" >';
                            }
                            ?>
                            
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
                            <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                            if ($isComercial == 'existe') {
                              $dias = explode("|", $datos['rows']->entityInfo->contacts[$comercialtype]->days);
                            }else{
                              $dias = array();
                            }
                            ?>
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMar = (in_array('Mar',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMie = (in_array('Mie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valJue = (in_array('Jue',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valVie = (in_array('Vie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valSab = (in_array('Sab',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valDom = (in_array('Dom',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Dom">
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
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" name="idContSop" name="idContSop" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->id.'">';

                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" name="idContSop" name="idContSop" value="0">';
                          }
                          ?>
                          
                          <small id="nombreSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoSop">Apellido Paterno</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoSopHElp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoSop">Apellido Materno</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>   
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailSop">Correo Electrónico</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp">';
                          }
                          ?>
                          
                          <small id="emailSopHElp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telSop">Teléfono</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
                          }
                          ?>
                          <small id="telSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiSop">Teléfono Adicional</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
                          }
                          ?>
                          
                          <small id="telAdiSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioSop">Inicio</label>
                          <label for="inicioCom" class="field prepend-icon">
                            <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->startTime.'" >';
                          }else{
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input">';
                          }
                          ?>
                            
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
                        <?php 
                          if ($isSoporte == 'existe') {
                            $dias2 = explode("|", $datos['rows']->entityInfo->contacts[$soportetype]->days);
                            
                          }else{
                            $dias2 = array();
                          }
                          ?>
                        <label for="fin">Dias*</label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMar = (in_array('Mar',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMie = (in_array('Mie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valJue = (in_array('Jue',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valVie = (in_array('Vie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valSab = (in_array('Sab',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valDom = (in_array('Dom',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Dom">
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
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" name="idContFin" name="idContFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" name="idContFin" name="idContFin" value="0">';
                          }
                          ?>
                          
                          <small id="nombreFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoFin">Apellido Paterno</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoFin">Apellido Materno</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailFin">Correo Electrónico</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp">';
                          }
                          ?>
                          
                          <small id="emailFinHelp"  class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telFin">Teléfono</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
                          }
                          ?>
                          <small id="telFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiFin">Teléfono Adicional</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
                          }
                          ?>
                          
                          <small id="telAdiFin" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioFin">Inicio</label>
                          <label for="inicioFin" class="field prepend-icon">
                            <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->startTime.'" >';
                          }else{
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input">';
                          }
                          ?>
                            
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
                        <?php 
                          if ($isFinanzas == 'existe') {
                            $dias3 = explode("|", $datos['rows']->entityInfo->contacts[$finanzastype]->days);                           
                          }else{
                            $dias3 = array();
                          }
                          ?>
                        
                        <label for="fin">Dias*</label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Mar',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Mie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Jue',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Vie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Sab',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diaF[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Dom',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Dom">
                                <span class="checkbox"></span> Domingo
                            </label>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                <!-- -------------- /Wizard -------------- -->
              </form>
            <?php } ?>
            <?php if ($_GET['level'] == 5) { 
              // sucursal
              $curl_cuenta = curl_init();
              curl_setopt_array($curl_cuenta, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?id='.$_GET['validate'].'&level='.$_GET['level'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=72a6655e6fbbe659772c1e5e63de'
                ),
              ));
              $response_cuenta = curl_exec($curl_cuenta);
              curl_close($curl_cuenta);
              $datos['rows'] = json_decode($response_cuenta);

              //print_r($datos);

              $isRLegal = 'na';
              $isComercial = 'na';
              $isSoporte = 'na';
              $isFinanzas = 'na';
              $rLegaltype = '';
              $comercialtype = '';
              $soportetype = '';
              $finanzastype = '';
              $rLegalcp = '';
              if ($datos['rows']->entityInfo->contacts != null) {
                for ($iCont=0; $iCont < count($datos['rows']->entityInfo->contacts) ; $iCont++) { 
                  if ($datos['rows']->entityInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    $rLegalcp = $datos['rows']->entityInfo->contacts[$iCont]->address->postalCode;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 2) {
                    $isComercial = 'existe';
                    $comercialtype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 3) {
                    $isSoporte = 'existe';
                    $soportetype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 4) {
                    $isFinanzas = 'existe';
                    $finanzastype = $iCont;
                  }
                }
              }
            ?>
            <form method="post" enctype="multipart/form-data" id="form-wizard-sucursal">
              <div class="wizard steps-bg clearfix steps-left">
                <!-- -------------- step 1 -------------- -->
                <h4 class="wizard-section-title">
                    <i class="fa fa-user pr5"></i> Datos Generales
                </h4>
                <section class="wizard-section">
                  <div class="row">
                    <!--div class="col-md-4">
                      <div class="form-group">
                        <label for="subafiliado">Subafiliado*</label>
                        <select class="form-control" id="subafiliado" name="subafiliado" aria-describedby="subafiliadoHelp">
                          <option></option-->
                          <?php
                          /*for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                            if($subafiliados->contextResponse[$iSub]->idContext == $datos['rows']->entityInfo->idContext){
                              echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }else{
                              echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }
                            
                          }*/
                          ?>
                          <script type="text/javascript">
                              var actividadSelected = <?php echo $datos['rows']->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $datos['rows']->entityInfo->address->postalCode?>';
                              <?php
                              if ($datos['rows']->entityInfo->contacts != null) {
                              ?>
                              var cpSelectedCon = '<?php echo$rLegalcp?>';
                              <?php
                              }else{
                              ?>
                              var cpSelectedCon = '';
                              <?php
                              }
                              ?>
                            </script>
                        </select>
                        <!--small id="subafiliadoHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="entidad">Entidad*</label>
                        <select class="form-control" id="entidad" name="entidad">
                          <option></option>
                        </select>
                        <small id="nameComercioHelp" class="error form-text text-muted"></small>
                      </div>
                    </div-->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sucursal">Nombre de Sucursal*</label>
                        <input type="text" class="form-control" id="sucursal" name="sucursal" aria-describedby="sucursalHelp" value="<?php echo $datos['rows']->entityInfo->nameCommerce?>">
                        <input type="hidden" id="nivel" name="nivel" value="5">
                         <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $datos['rows']->entityInfo->idCommerceDetail?>">
                         <input type="hidden" id="idContext" name="idContext" value="<?php echo $datos['rows']->entityInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $datos['rows']->entityInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $datos['rows']->entityInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $datos['rows']->entityInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $datos['rows']->entityInfo->guid?>">
                        <small id="sucursalHelp" class="error form-text text-muted"></small>
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tel">Teléfono*</label>
                        <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $datos['rows']->entityInfo->phoneNumber?>">
                        <small id="telHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>

                  <!--div class="row">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email">Correo electrónico*</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $datos['rows']->entityInfo->email?>">
                        <small id="emailHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="emailConf">Confirmar Correo electrónico*</label>
                        <input type="email" class="form-control" id="emailConf" name="emailConf" aria-describedby="emailConfHelp">
                        <small id="emailConfHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div-->
                  <!--div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tel">Teléfono*</label>
                        <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php //echo $datos['rows']->entityInfo->phoneNumber?>">
                        <small id="telHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="contrasena">Contraseña*</label>
                        <div class="smart-widget sm-right smr-160">
                          <label class="field">
                            <input type="password" name="contrasena" id="contrasena" class="gui-input">
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
                        <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
                        <small id="confPassHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div-->
                  <div class="row">
                      <div class="col-md-12">
                        <h3>Dirección</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="calle">Calle*</label>
                          <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $datos['rows']->entityInfo->address->street?>">
                          <small id="calleHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExt">Número Exterior*</label>
                          <input type="text" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $datos['rows']->entityInfo->address->exteriorNumber?>">
                          <small id="numExtHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numInt">Número Interior</label>
                          <input type="text" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $retVal = ($datos['rows']->entityInfo->address->interiorNumber != 'ND') ? $datos['rows']->entityInfo->address->interiorNumber : '' ; ?>">
                          <small id="numIntHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cp">Código Postal*</label>
                          <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $datos['rows']->entityInfo->address->idLocation?>">
                          <small id="cpHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="col">Colonia*</label>
                          <select class="form-control" id="col" name="col">
                            <option></option>
                          </select>
                          <small id="colHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="del">Municipio/Alcaldia*</label>
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
                          <label for="edo">Estado*</label>
                          <select class="form-control" id="edo" name="edo">
                            <option></option>
                          </select>
                          <small id="edoHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                  <!--<div class="row">
                    <div class="col-md-12">
                      <h3>Afiliaciones</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <button type="button" class="btn btn-primary btn-block btn_addAfiliacion">Agregar Afiliación</button>
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
                                  <th class="br-t-n pl30">Afiliación</th>
                                  <th class="br-t-n hidden-xs">Procesador</th>
                                  <th class="br-t-n">Crédito</th>
                                  <th class="br-t-n">Débito</th>
                                  <th class="br-t-n">Tipo</th>
                                  <th class="br-t-n">Regla</th>
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
                  </div> -->
                </section>
                <!-- -------------- step 2 -------------- -->
                <h4 class="wizard-section-title">
                    <i class="fa fa-user pr5"></i> Reglas
                </h4>
                <section class="wizard-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Tipo de Sub Afiliado</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="fin"></label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input type="radio" name="typeSub" value="agregador">
                            <span class="radio"></span> Agregador
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input type="radio" name="typeSub" value="comisionista">
                            <span class="radio"></span> Comisionista
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input type="radio" name="typeSub" value="puntoVenta">
                            <span class="radio"></span> Punto de venta
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Dispersión de transacciones</h3>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <label for="fin"></label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="dispersion" value="en">
                            <span class="radio"></span> En RED
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="dispersion" value="fuera">
                            <span class="radio"></span> Fuera de RED
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="dispersion" value="otra">
                            <span class="radio"></span> RED otra cuenta
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="fin"></label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <div class="form-group divElemento">
                            <label for="elemento">Elige un elemento</label>
                            <select class="form-control" id="elemento" name="elemento">
                              <option></option>
                            </select>
                            <small id="elementoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group divCuentaFuera">
                            <label for="fueraCuenta">Cuenta</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                            <small id="cpHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group divCuentaOtra">
                            <label for="otraCuenta">Cuenta</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                            <small id="cpHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Liquidación de Transacciones</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="fin">¿Esta cuenta recibira las liquidaciones?*</label>
                      <div class="option-group field">
                        <div class="col-md-12">
                          <label class="option block option-primary">
                            <input type="checkbox" name="liquidacion" value="0">
                            <span class="checkbox"></span> Si
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Facturación de Transacciones</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="option-group field">
                        <div class="col-md-12">
                          <label class="option block option-primary">
                            <input type="radio" class="tipoF" name="facturacion" value="publicoGen">
                            <span class="radio"></span> Público en General
                          </label>
                        </div>
                        <div class="col-md-12 adiGeneral">
                        </div>
                        <div class="col-md-12">
                          <label class="option block option-primary">
                            <input type="radio" class="tipoF" name="facturacion" value="facturacion">
                            <span class="radio"></span> Facturación
                          </label>
                        </div>
                        <div class="col-md-12 adiFac">
                          <div class="col-md-4 form-group">
                            <label for="elemento">Elige el periodo</label>
                            <select class="form-control" id="elemento" name="elemento">
                              <option></option>
                              <option>Mes</option>
                              <option>Quincena</option>
                              <option>Semana</option>
                              <option>Día</option>
                            </select>
                            <small id="elementoHelp" class="error form-text text-muted"></small>
                          </div>
                          <div class="col-md-12 ">
                            <label for="fin">Selecciona los días de las transacciones a facturar:</label>
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
                        <!--div class="col-md-12">
                          <label class="option block option-primary">
                            <input type="radio" name="dispersion" value="otra">
                            <span class="radio"></span> RED otra cuenta
                          </label>
                        </div>
                        <div class="col-md-12 adi">
                        </div-->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Modelo de Negocio</h3>
                    </div>
                  </div>        
                  <div class="row">
                    <div class="col-md-12">
                      <label for="fin"></label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="modelo" value="emision">
                            <span class="radio"></span> Emision
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="modelo" value="adquirente">
                            <span class="radio"></span> Adquirente
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary">
                            <input class="tipoDis" type="radio" name="modelo" value="mixto">
                            <span class="radio"></span> Mixto
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </section>
                <!-- -------------- step 3 -------------- -->
                <h4 class="wizard-section-title">
                  <i class="fa fa-user-secret pr5"></i> Datos Legales
                </h4>
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
                        <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $datos['rows']->entityInfo->rfc?>">
                        <small id="rfc
                        Help" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="razonSFiscal">Razón Social</label>
                        <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $datos['rows']->entityInfo->businessName?>">
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
                            if ($datos['rows']->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
                              echo '<option selected value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                            }else{
                              echo '<option value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                            }
                            
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
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->name.'" >
                          <input type="hidden" name="idContRep" name="idContRep" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->id.'">';
                          ?>
                          <script>
                            var idLocalidadSelectedLeg = '<?php echo $datos['rows']->entityInfo->contacts[$rLegaltype]->address->idLocation?>';
                          </script>
                          <?php
                        }else{
                          echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                          <input type="hidden" name="idContRep" name="idContRep" value="0">';
                          ?>
                          <script>
                            var idLocalidadSelectedLeg = '';
                          </script>
                          <?php 
                        }
                        ?>
                        
                        <small id="nombreRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aPaternoRep">Apellido Paterno</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp">';
                        }
                        ?>
                        
                        <small id="aPaternoRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aMaternoRep">Apellido Materno</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp">';
                        }
                        ?>
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
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->street.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" >';
                        }
                        ?>
                        <small id="calleRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="numExtRep">Número Exterior</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->exteriorNumber.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp">';
                        }
                        ?>
                        <small id="numExtRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="numIntRep">Número Interior</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->interiorNumber.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp">';
                        }
                        ?>
                        <small id="numIntRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="cpRep">Código Postal</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="" >';
                        }else{
                          echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                        }
                        ?>
                        
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
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->email.'" >';
                        }else{
                          echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" >';
                        }
                        ?>
                        
                        <small id="emailRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telRep">Teléfono</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
                        }
                        ?>
                        
                        <small id="telRepHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telAdiRep">Teléfono Adicional</label>
                        <?php 
                        if ($isRLegal == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
                        }
                        ?>
                        
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
                        <label style="display: block;" for="ine">Identificación Oficial</label>
                        <input type="file" accept=".pdf"  class="form-control file" id="ine" name="ine" aria-describedby="ineHelp">
                        <small id="ineHelp" class="error form-text text-muted"></small>
                        <?php
                        if ($datos['rows']->entityInfo->ineFile != '') {
                        ?>
                        <a href="<?php echo $datos['rows']->entityInfo->ineFile?>">
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                        </a>
                        <?php
                        }else{
                        ?>
                        <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="cfe">Comprobante de Domicilio</label>
                        <input type="file" accept=".pdf"  class="form-control file" id="cfe" name="cfe" aria-describedby="cfeHelp">
                        <small id="cfeHelp" class="error form-text text-muted"></small>
                        <?php
                        if ($datos['rows']->entityInfo->proofOfAddressFile != '') {
                        ?>
                        <a href="<?php echo $datos['rows']->entityInfo->proofOfAddressFile?>">
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                        </a>
                        <?php
                        }else{
                        ?>
                        <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="acta">Acta Constitutiva</label>
                        <input type="file" accept=".pdf"  class="form-control file" id="acta" name="acta" aria-describedby="actaHelp">
                        <small id="actaHelp" class="error form-text text-muted"></small>
                        <?php
                        if ($datos['rows']->entityInfo->constitutiveActFile != '') {
                        ?>
                        <a href="<?php echo $datos['rows']->entityInfo->constitutiveActFile?>">
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                        </a>
                        <?php
                        }else{
                        ?>
                        <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- -------------- step 4 -------------- -->
                <h4 class="wizard-section-title">
                    <i class="fa fa-file-text pr5"></i> Contactos
                </h4>
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
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->name.'" >
                          <input type="hidden" name="idContCom" name="idContCom" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->id.'">';
                        }else{
                          echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                          <input type="hidden" name="idContCom" name="idContCom" value="0">';
                        }
                        ?>
                        
                        <small id="nombreComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aPaternoCom">Apellido Paterno</label>
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp">';
                        }
                        ?>
                        <small id="aPaternoComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aMaternoCom">Apellido Materno</label>
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp">';
                        }
                        ?>
                        
                        <small id="aMaternoComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="emailCom">Correo Electrónico</label>
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->email.'" >';
                        }else{
                          echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp">';
                        }
                        ?>
                        
                        <small id="emailComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telCom">Teléfono</label>
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
                        }
                        ?>
                        
                        <small id="telComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telAdiCom">Teléfono Adicional</label>
                        <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="tel"  maxlength="10"class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
                        }
                        ?>
                        
                        <small id="telAdiComHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inicioCom">Inicio</label>
                        <label for="inicioCom" class="field prepend-icon">
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->startTime.'" >';
                          }else{
                            echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input" >';
                          }
                          ?>
                          
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
                          <?php 
                        if ($isComercial == 'existe') {
                          echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->endTime.'" >';
                        }else{
                          echo '<input type="text" id="finCom" name="finCom" class="gui-input">';
                        }
                        ?>
                          
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
                          <?php 
                          if ($isComercial == 'existe') {
                            $dias = explode("|", $datos['rows']->entityInfo->contacts[$comercialtype]->days);
                          }else{
                            $dias = array();
                          }
                          ?>
                          <label class="option block option-primary">
                              <input <?php echo $valLun = (in_array('Lun',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Lun">
                              <span class="checkbox"></span> Lunes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valMar = (in_array('Mar',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mar">
                              <span class="checkbox"></span> Martes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valMie = (in_array('Mie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mie">
                              <span class="checkbox"></span> Miercoles
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valJue = (in_array('Jue',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Jue">
                              <span class="checkbox"></span> Jueves
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary mt10">
                            <input <?php echo $valVie = (in_array('Vie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Vie">
                            <span class="checkbox"></span> Viernes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valSab = (in_array('Sab',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Sab">
                              <span class="checkbox"></span> Sabado
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valDom = (in_array('Dom',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Dom">
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
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->name.'" >
                          <input type="hidden" name="idContSop" name="idContSop" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->id.'">';
                        }else{
                          echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                          <input type="hidden" name="idContSop" name="idContSop" value="0">';
                        }
                        ?>
                        
                        <small id="nombreSopHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aPaternoSop">Apellido Paterno</label>
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp">';
                        }
                        ?>
                        
                        <small id="aPaternoSopHElp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aMaternoSop">Apellido Materno</label>
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp">';
                        }
                        ?>
                        
                        <small id="aMaternoSopHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>   
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="emailSop">Correo Electrónico</label>
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->email.'" >';
                        }else{
                          echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp">';
                        }
                        ?>
                        
                        <small id="emailSopHElp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telSop">Teléfono</label>
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
                        }
                        ?>
                        <small id="telSopHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telAdiSop">Teléfono Adicional</label>
                        <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
                        }
                        ?>
                        
                        <small id="telAdiSopHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inicioSop">Inicio</label>
                        <label for="inicioCom" class="field prepend-icon">
                          <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->startTime.'" >';
                        }else{
                          echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input">';
                        }
                        ?>
                          
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
                          <?php 
                        if ($isSoporte == 'existe') {
                          echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->endTime.'" >';
                        }else{
                          echo '<input type="text" id="finSop" name="finSop" class="gui-input">';
                        }
                        ?>
                          
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
                      <?php 
                        if ($isSoporte == 'existe') {
                          $dias2 = explode("|", $datos['rows']->entityInfo->contacts[$soportetype]->days);
                          
                        }else{
                          $dias2 = array();
                        }
                        ?>
                      <label for="fin">Dias*</label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <label class="option block option-primary">
                              <input <?php echo $valLun = (in_array('Lun',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Lun">
                              <span class="checkbox"></span> Lunes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valMar = (in_array('Mar',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mar">
                              <span class="checkbox"></span> Martes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valMie = (in_array('Mie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mie">
                              <span class="checkbox"></span> Miercoles
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valJue = (in_array('Jue',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Jue">
                              <span class="checkbox"></span> Jueves
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary mt10">
                            <input <?php echo $valVie = (in_array('Vie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Vie">
                            <span class="checkbox"></span> Viernes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valSab = (in_array('Sab',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Sab">
                              <span class="checkbox"></span> Sabado
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valDom = (in_array('Dom',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Dom">
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
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->name.'" >
                          <input type="hidden" name="idContFin" name="idContFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->id.'">';
                        }else{
                          echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                          <input type="hidden" name="idContFin" name="idContFin" value="0">';
                        }
                        ?>
                        
                        <small id="nombreFinHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aPaternoFin">Apellido Paterno</label>
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp">';
                        }
                        ?>
                        
                        <small id="aPaternoFinHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="aMaternoFin">Apellido Materno</label>
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
                        }else{
                          echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp">';
                        }
                        ?>
                        
                        <small id="aMaternoFinHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="emailFin">Correo Electrónico</label>
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->email.'" >';
                        }else{
                          echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp">';
                        }
                        ?>
                        
                        <small id="emailFinHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telFin">Teléfono</label>
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
                        }
                        ?>
                        <small id="telFinHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telAdiFin">Teléfono Adicional</label>
                        <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                        }else{
                          echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
                        }
                        ?>
                        
                        <small id="telAdiFin" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inicioFin">Inicio</label>
                        <label for="inicioFin" class="field prepend-icon">
                          <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->startTime.'" >';
                        }else{
                          echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input">';
                        }
                        ?>
                          
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
                          <?php 
                        if ($isFinanzas == 'existe') {
                          echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->endTime.'" >';
                        }else{
                          echo '<input type="text" id="finFin" name="finFin" class="gui-input">';
                        }
                        ?>
                          
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
                      <?php 
                        if ($isFinanzas == 'existe') {
                          $dias3 = explode("|", $datos['rows']->entityInfo->contacts[$finanzastype]->days);                           
                        }else{
                          $dias3 = array();
                        }
                        ?>
                      
                      <label for="fin">Dias*</label>
                      <div class="option-group field">
                        <div class="col-md-4">
                          <label class="option block option-primary">
                              <input <?php echo $valLun = (in_array('Lun',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Lun">
                              <span class="checkbox"></span> Lunes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Mar',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mar">
                              <span class="checkbox"></span> Martes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Mie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mie">
                              <span class="checkbox"></span> Miercoles
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Jue',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Jue">
                              <span class="checkbox"></span> Jueves
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label class="option block option-primary mt10">
                            <input <?php echo $valLun = (in_array('Vie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Vie">
                            <span class="checkbox"></span> Viernes
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Sab',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diaF[]" value="Sab">
                              <span class="checkbox"></span> Sabado
                          </label>
                          <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Dom',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Dom">
                              <span class="checkbox"></span> Domingo
                          </label>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </form>
            <?php } ?>
            <?php if ($_GET['level'] == 6) { 
              // caja
              $curl = curl_init();

              curl_setopt_array($curl, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?id='.$_GET['validate'].'&level='.$_GET['level'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=88937f48d2ccab21583d749efb0b'
                ),
              ));

              $response = curl_exec($curl);
              $datos['rows'] = json_decode($response);

              //var_dump($datos['rows']);
            ?>
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <form id="form_addColaborador" name="form_addColaborador" enctype="multipart/form-data" method="post">
                  <div class="wizard steps-bg clearfix steps-left">
                    <!-- -------------- step 1 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user pr5"></i> Datos Generales
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="subafiliado">SubAfiliado*</label>
                            <select class="form-control" id="subafiliado" name="subafiliado" aria-describedby="subafiliadoHelp">
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
                            <script type="text/javascript">
                              var entiSelect = '<?php echo session('idEntity')?>';
                              var terminalSelect = '<?php echo session('idTerminal') ?>';
                            </script>
                            <small id="subafiliadoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="entidad">Entidad*</label>
                            <select class="form-control" name="entidad" id="entidad">
                              <option value=""></option>
                            </select>
                            <small id="entidadHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="sucursal">Sucursal*</label>
                            <select class="form-control" name="sucursal" id="sucursal">
                              <option value=""></option>
                            </select>
                            <small id="sucursalHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="username">RFC*</label>
                            <input type="text" maxlength="13" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp">
                            <small id="rfcHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nombre">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp">
                            <small id="nombreHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="aPaterno">Apellido Paterno*</label>
                            <input type="text" class="form-control" id="aPaterno" name="aPaterno" aria-describedby="aPaternoHelp">
                            <small id="aPaternoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="aMaterno">Apellido Materno*</label>
                            <input type="text" class="form-control" id="aMaterno" name="aMaterno" aria-describedby="aMaternoHelp">
                            <small id="aMaternoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tipoCola">Tipo de Colaborador*</label>
                            <select class="form-control" name="tipoCola" id="tipoCola">
                              <option value=""></option>
                              <option value="2">Gerente</option>
                              <option value="3">Cajero</option>
                              <option value="4">Finanzas</option>
                            </select>
                            <small id="amaternoHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tel">Teléfono*</label>
                            <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp">
                            <small id="telHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">Correo Electronico*</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="emailConfirm">Confirmar Correo Electronico*</label>
                            <input type="email" class="form-control" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                            <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="contrasena">Contraseña*</label>
                            <div class="smart-widget sm-right smr-160">
                              <label class="field">
                                <input type="password" name="contrasena" id="contrasena" class="gui-input">
                              </label>
                              <button type="button" class="button btn-primary generatePass">Generar</button>
                            </div>
                            <code id="vercontrasena"></code>
                            <small id="contrasenaHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="confPass">Confirmar Contraseña*</label>
                            <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
                            <small id="confPassHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- -------------- step 2 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user pr5"></i> Reglas
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Tipo de Sub Afiliado</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin"></label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input type="radio" name="typeSub" value="agregador">
                                <span class="radio"></span> Agregador
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input type="radio" name="typeSub" value="comisionista">
                                <span class="radio"></span> Comisionista
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input type="radio" name="typeSub" value="puntoVenta">
                                <span class="radio"></span> Punto de venta
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Dispersión de transacciones</h3>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin"></label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="dispersion" value="en">
                                <span class="radio"></span> En RED
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="dispersion" value="fuera">
                                <span class="radio"></span> Fuera de RED
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="dispersion" value="otra">
                                <span class="radio"></span> RED otra cuenta
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label for="fin"></label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <div class="form-group divElemento">
                                <label for="elemento">Elige un elemento</label>
                                <select class="form-control" id="elemento" name="elemento">
                                  <option></option>
                                </select>
                                <small id="elementoHelp" class="error form-text text-muted"></small>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group divCuentaFuera">
                                <label for="fueraCuenta">Cuenta</label>
                                <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                                <small id="cpHelp" class="error form-text text-muted"></small>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group divCuentaOtra">
                                <label for="otraCuenta">Cuenta</label>
                                <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp">
                                <small id="cpHelp" class="error form-text text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Liquidación de Transacciones</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin">¿Esta cuenta recibira las liquidaciones?*</label>
                          <div class="option-group field">
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="checkbox" name="liquidacion" value="0">
                                <span class="checkbox"></span> Si
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Facturación de Transacciones</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="option-group field">
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="radio" class="tipoF" name="facturacion" value="publicoGen">
                                <span class="radio"></span> Público en General
                              </label>
                            </div>
                            <div class="col-md-12 adiGeneral">
                            </div>
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="radio" class="tipoF" name="facturacion" value="facturacion">
                                <span class="radio"></span> Facturación
                              </label>
                            </div>
                            <div class="col-md-12 adiFac">
                              <div class="col-md-4 form-group">
                                <label for="elemento">Elige el periodo</label>
                                <select class="form-control" id="elemento" name="elemento">
                                  <option></option>
                                  <option>Mes</option>
                                  <option>Quincena</option>
                                  <option>Semana</option>
                                  <option>Día</option>
                                </select>
                                <small id="elementoHelp" class="error form-text text-muted"></small>
                              </div>
                              <div class="col-md-12 ">
                                <label for="fin">Selecciona los días de las transacciones a facturar:</label>
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
                            <!--div class="col-md-12">
                              <label class="option block option-primary">
                                <input type="radio" name="dispersion" value="otra">
                                <span class="radio"></span> RED otra cuenta
                              </label>
                            </div>
                            <div class="col-md-12 adi">
                            </div-->
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Modelo de Negocio</h3>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <label for="fin"></label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="modelo" value="emision">
                                <span class="radio"></span> Emision
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="modelo" value="adquirente">
                                <span class="radio"></span> Adquirente
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoDis" type="radio" name="modelo" value="mixto">
                                <span class="radio"></span> Mixto
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </section>
                    <!-- -------------- step 3 -------------- -->
                    <h4 class="wizard-section-title">
                      <i class="fa fa-user-secret pr5"></i> Datos Legales
                    </h4>
                    <section class="wizard-section">
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
                        </div>
                      </div>
                  
                    </section>
                    <!-- -------------- step 4 -------------- -->
                    <h4 class="wizard-section-title">
                      <i class="fa fa-file-text pr5"></i> Dispositivo
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" aria-describedby="modeloHelp">
                            <small id="modeloHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="serie">Serie</label>
                            <input type="text" class="form-control" id="serie" name="serie" aria-describedby="serieHelp">
                            <small id="serieHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- -------------- step 5 -------------- -->
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

                  </div> 
                </form>
              </div>
            </div>
            <?php } ?>

            <?php if ($_GET['level'] == 7) { 
              // entidad
              $curlCuenta = curl_init();

              curl_setopt_array($curlCuenta, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?id='.$_GET['validate'].'&level='.$_GET['level'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=ac48d2d3406bcb7cc60a6ecd6daa'
                ),
              ));

              $responseCuenta = curl_exec($curlCuenta);
              curl_close($curlCuenta);

              $datos['rows'] = json_decode($responseCuenta);

              //print_r($datos);

              $isRLegal = 'na';
              $isComercial = 'na';
              $isSoporte = 'na';
              $isFinanzas = 'na';
              $rLegaltype = '';
              $comercialtype = '';
              $soportetype = '';
              $finanzastype = '';
              $rLegalcp = '';
              if ($datos['rows']->entityInfo->contacts != null) {
                for ($iCont=0; $iCont < count($datos['rows']->entityInfo->contacts) ; $iCont++) { 
                  if ($datos['rows']->entityInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    $rLegalcp = $datos['rows']->entityInfo->contacts[$iCont]->address->idLocation;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 2) {
                    $isComercial = 'existe';
                    $comercialtype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 3) {
                    $isSoporte = 'existe';
                    $soportetype = $iCont;
                  }else if ($datos['rows']->entityInfo->contacts[$iCont]->type == 4) {
                    $isFinanzas = 'existe';
                    $finanzastype = $iCont;
                  }
                }
              }
            ?>
              <form method="post" enctype="multipart/form-data" id="form-wizard-entidad">
                <div class="wizard steps-bg clearfix steps-left">
                  <!-- -------------- step 1 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Datos Generales
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="safiliacion">Subafiliado*</label>
                          <select class="form-control" id="safiliacion" name="safiliacion" aria-describedby="safiliacionHelp">
                            <?php
                            //var_dump($subafiliados->contextResponse);
                            /*for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                              if($subafiliados->contextResponse[$iSub]->idContext == $datos['rows']->entityInfo->idContext){
                                echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                              }else{
                                echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                              }
                            }*/
                            ?>
                          </select>
                          <small id="safiliacionHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Nombre del Comercio*</label>
                          <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp" value="<?php echo $valnameCommerce = ($datos['rows']->entityInfo->nameCommerce != 'ND') ? $datos['rows']->entityInfo->nameCommerce : 'ss' ; ?>">
                          <input type="hidden" id="nivel" name="nivel" value="4">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $datos['rows']->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $datos['rows']->entityInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $datos['rows']->entityInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $datos['rows']->entityInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $datos['rows']->entityInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $datos['rows']->entityInfo->guid?>">
                          <small id="namecommerceHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $datos['rows']->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $datos['rows']->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $datos['rows']->entityInfo->address->postalCode?>';
                              <?php
                              if ($datos['rows']->entityInfo->contacts != null) {
                              ?>
                              var cpSelectedCon = '<?php echo$rLegalcp?>';
                              <?php
                              }else{
                              ?>
                              var cpSelectedCon = '';
                              <?php
                              }
                              ?>
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
                          <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $datos['rows']->entityInfo->phoneNumber?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $datos['rows']->entityInfo->email?>">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailConfirm">Confirmar Correo electrónico*</label>
                          <input type="text" class="form-control" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                          <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <div class="row">
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="contrasena">Contraseña*</label>
                          <div class="smart-widget sm-right smr-160">
                            <label class="field">
                              <input type="password" name="contrasena" id="contrasena" class="gui-input">
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
                          <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
                          <small id="confPassHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
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
                          <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $datos['rows']->entityInfo->address->street?>">
                          <small id="calleHelp" class="error form-text text-muted"></small>
                        </div>
                        <script type="text/javascript">
                          var idLocalidadSelected = '<?php echo $datos['rows']->entityInfo->address->idLocation?>';
                        </script>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExt">Número Exterior</label>
                          <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $datos['rows']->entityInfo->address->exteriorNumber?>">
                          <small id="numExtHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numInt">Número Interior</label>
                          <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($datos['rows']->entityInfo->address->interiorNumber != 'ND') ? $datos['rows']->entityInfo->address->interiorNumber : '' ; ?>">
                          <small id="numIntHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cp">Código Postal</label>
                          <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $valcp = ($datos['rows']->entityInfo->address->postalCode != '0') ? $datos['rows']->entityInfo->address->postalCode : '' ; ?>">
                          <small id="cpHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="col">Colonia</label>
                          <select class="form-control" id="col" name="col">
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
                  </section>

                  <!-- -------------- step 2 -------------- -->
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
                          <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $datos['rows']->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $datos['rows']->entityInfo->businessName?>">
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
                              if ($datos['rows']->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
                                echo '<option selected value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                              }else{
                                echo '<option value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                              }
                              
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->name.'" >
                            <input type="hidden" name="idContRep" name="idContRep" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" name="idContRep" name="idContRep" value="0">';
                          }
                          ?>
                          
                          <small id="nombreRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoRep">Apellido Paterno</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoRep">Apellido Materno</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp">';
                          }
                          ?>
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->street.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" >';
                          }
                          ?>
                          <small id="calleRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExtRep">Número Exterior</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->exteriorNumber.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp">';
                          }
                          ?>
                          <small id="numExtRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numIntRep">Número Interior</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->interiorNumber.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp">';
                          }
                          ?>
                          <small id="numIntRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cpRep">Código Postal</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->address->postalCode.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                          }
                          ?>
                          
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
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" >';
                          }
                          ?>
                          
                          <small id="emailRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telRep">Teléfono</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
                          }
                          ?>
                          
                          <small id="telRepHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiRep">Teléfono Adicional</label>
                          <?php 
                          if ($isRLegal == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$datos['rows']->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
                          }
                          ?>
                          
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
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="ine" name="ine" aria-describedby="ineHelp">
                          <small id="ineHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cfe">Comprobante de Domicilio</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="cfe" name="cfe" aria-describedby="cfeHelp">
                          <small id="cfeHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="acta">Acta Constitutiva</label>
                          <input type="file" accept=".pdf"  class="form-control file" id="acta" name="acta" aria-describedby="actaHelp">
                          <small id="actaHelp" class="error form-text text-muted"></small>
                          <?php
                          if ($datos['rows']->entityInfo->constitutiveActFile != '') {
                          ?>
                          <a href="<?php echo $datos['rows']->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%; margin-top:10px ;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- -------------- step 3 -------------- -->
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
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->name.'" >
                            <input type="hidden" name="idContCom" name="idContCom" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                            <input type="hidden" name="idContCom" name="idContCom" value="0">';
                          }
                          ?>
                          
                          <small id="nombreComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoCom">Apellido Paterno</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp">';
                          }
                          ?>
                          <small id="aPaternoComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoCom">Apellido Materno</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailCom">Correo Electrónico</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp">';
                          }
                          ?>
                          
                          <small id="emailComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telCom">Teléfono</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
                          }
                          ?>
                          
                          <small id="telComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiCom">Teléfono Adicional</label>
                          <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
                          }
                          ?>
                          
                          <small id="telAdiComHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioCom">Inicio</label>
                          <label for="inicioCom" class="field prepend-icon">
                            <?php 
                            if ($isComercial == 'existe') {
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->startTime.'" >';
                            }else{
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input" >';
                            }
                            ?>
                            
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
                            <?php 
                          if ($isComercial == 'existe') {
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$comercialtype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                            if ($isComercial == 'existe') {
                              $dias = explode("|", $datos['rows']->entityInfo->contacts[$comercialtype]->days);
                            }else{
                              $dias = array();
                            }
                            ?>
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMar = (in_array('Mar',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMie = (in_array('Mie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valJue = (in_array('Jue',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valVie = (in_array('Vie',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valSab = (in_array('Sab',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valDom = (in_array('Dom',$dias)) ? 'checked' : '' ; ?> type="checkbox" name="diasC[]" value="Dom">
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
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" name="idContSop" name="idContSop" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->id.'">';

                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" name="idContSop" name="idContSop" value="0">';
                          }
                          ?>
                          
                          <small id="nombreSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoSop">Apellido Paterno</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoSopHElp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoSop">Apellido Materno</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>   
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailSop">Correo Electrónico</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp">';
                          }
                          ?>
                          
                          <small id="emailSopHElp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telSop">Teléfono</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
                          }
                          ?>
                          <small id="telSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiSop">Teléfono Adicional</label>
                          <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
                          }
                          ?>
                          
                          <small id="telAdiSopHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioSop">Inicio</label>
                          <label for="inicioCom" class="field prepend-icon">
                            <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->startTime.'" >';
                          }else{
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                          if ($isSoporte == 'existe') {
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$soportetype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input">';
                          }
                          ?>
                            
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
                        <?php 
                          if ($isSoporte == 'existe') {
                            $dias2 = explode("|", $datos['rows']->entityInfo->contacts[$soportetype]->days);
                            
                          }else{
                            $dias2 = array();
                          }
                          ?>
                        <label for="fin">Dias*</label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMar = (in_array('Mar',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valMie = (in_array('Mie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valJue = (in_array('Jue',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valVie = (in_array('Vie',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valSab = (in_array('Sab',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valDom = (in_array('Dom',$dias2)) ? 'checked' : '' ; ?> type="checkbox" name="diasS[]" value="Dom">
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
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" name="idContFin" name="idContFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" name="idContFin" name="idContFin" value="0">';
                          }
                          ?>
                          
                          <small id="nombreFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaternoFin">Apellido Paterno</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp">';
                          }
                          ?>
                          
                          <small id="aPaternoFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaternoFin">Apellido Materno</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
                          }else{
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp">';
                          }
                          ?>
                          
                          <small id="aMaternoFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailFin">Correo Electrónico</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->email.'" >';
                          }else{
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp">';
                          }
                          ?>
                          
                          <small id="emailFinHelp"  class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telFin">Teléfono</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
                          }
                          ?>
                          <small id="telFinHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdiFin">Teléfono Adicional</label>
                          <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" maxlength="10" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
                          }
                          ?>
                          
                          <small id="telAdiFin" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inicioFin">Inicio</label>
                          <label for="inicioFin" class="field prepend-icon">
                            <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->startTime.'" >';
                          }else{
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input">';
                          }
                          ?>
                            
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
                            <?php 
                          if ($isFinanzas == 'existe') {
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$datos['rows']->entityInfo->contacts[$finanzastype]->endTime.'" >';
                          }else{
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input">';
                          }
                          ?>
                            
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
                        <?php 
                          if ($isFinanzas == 'existe') {
                            $dias3 = explode("|", $datos['rows']->entityInfo->contacts[$finanzastype]->days);                           
                          }else{
                            $dias3 = array();
                          }
                          ?>
                        
                        <label for="fin">Dias*</label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                                <input <?php echo $valLun = (in_array('Lun',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Lun">
                                <span class="checkbox"></span> Lunes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Mar',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mar">
                                <span class="checkbox"></span> Martes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Mie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Mie">
                                <span class="checkbox"></span> Miercoles
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Jue',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Jue">
                                <span class="checkbox"></span> Jueves
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary mt10">
                              <input <?php echo $valLun = (in_array('Vie',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Vie">
                              <span class="checkbox"></span> Viernes
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Sab',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diaF[]" value="Sab">
                                <span class="checkbox"></span> Sabado
                            </label>
                            <label class="option block option-primary mt10">
                                <input <?php echo $valLun = (in_array('Dom',$dias3)) ? 'checked' : '' ; ?> type="checkbox" name="diasF[]" value="Dom">
                                <span class="checkbox"></span> Domingo
                            </label>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                <!-- -------------- /Wizard -------------- -->
              </form>
            <?php } ?>
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
<script src="<?php echo base_url()?>/public/assets/js/plugins/c3charts/d3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/c3charts/c3.min.js"></script>
<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addSubAfiliado.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addSubAfiliado.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addEntidad.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addEntidad.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addSucursal.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addSucursal.min.js"></script>

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

<?php if ($_GET['level'] == 2) {
  // admin
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaSubAfiliado.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaSubAfiliado.js"></script>

<?php } ?>
<?php if ($_GET['level'] == 3) { 
  // subAfiliado
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaSubAfiliado.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaSubAfiliado.js"></script>
<?php } ?>
<?php if ($_GET['level'] == 4) { 
  // entidad
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaEntidad.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaEntidad.js"></script>
<?php } ?>
<?php if ($_GET['level'] == 5) { 
  // sucursal
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaSucursal.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaSucursal.js"></script>
<?php } ?>
<?php if ($_GET['level'] == 6) { 
  // caja
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaSucursal.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaColaborador.js"></script> 
<?php } ?>
<?php if ($_GET['level'] == 7) { 
  // entidad
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCuentaComisionista.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editCuentaComisionista.js"></script>
<?php } ?>

<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>