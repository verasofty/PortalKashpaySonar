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
        <a href="dashboard">Mi Cuenta</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Mi Cuenta</li>
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
          <?php if (session('idRol') == 2) {
              // admin
          ?>
          <?php } ?>
          <?php if (session('idRol') == 3) { 
            // subAfiliado
            $isRLegal = 'na';
            $isComercial = 'na';
            $isSoporte = 'na';
            $isFinanzas = 'na';
            $rLegaltype = '';
            $comercialtype = '';
            $soportetype = '';
            $finanzastype = '';
            $rLegalcp = '';
            $typeAgCheck = '';
            $typeCoCheck = '';
            $typePVCheck = '';
            $modAdCheck = '';
            $modEmCheck = '';
            $modMiCheck = '';
            $facCheck = '';
            $puGnlCheck = '';
            $periodoCheck = '';
            $diasPerCheck = '';
            $montoSelect = '';
            $idFac = '';
            $enRedCheck = '';
            $fueraCheck = '';
            $oCuentaCheck = '';
            $oCuenta = '';
            $clabe = '';
            $cDestino = '';
            $aDiaSelectF = array();


            if ($cuenta->entityInfo->contacts != null) {
              for ($iCont=0; $iCont < count($cuenta->entityInfo->contacts) ; $iCont++) { 
                if ($cuenta->entityInfo->contacts[$iCont]->type == 1) {
                  $isRLegal = 'existe';
                  $rLegaltype = $iCont;
                  $rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->idLocation;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 2) {
                  $isComercial = 'existe';
                  $comercialtype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 3) {
                  $isSoporte = 'existe';
                  $soportetype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 4) {
                  $isFinanzas = 'existe';
                  $finanzastype = $iCont;
                }
              }
            }
            //echo $rLegalcp;
            if ($cuenta->entityInfo->typeAffiliation == '1') {
              $typeAgCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->typeAffiliation == '2') {
              $typeCoCheck = 'checked';
            }elseif ($cuenta->entityInfo->typeAffiliation == '3') {
              $typePVCheck = 'checked';
            }else{
              $typeAgCheck = 'checked';
            }
            if ($cuenta->entityInfo->idbusinessModel == '2') {
              $modAdCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->idbusinessModel == '1') {
              $modEmCheck = 'checked';
            }elseif ($cuenta->entityInfo->idbusinessModel == '3') {
              $modMiCheck = 'checked';
            }else{
              $modAdCheck = 'checked'; 
            }
            if ($cuenta->entityInfo->tradeBilling != null) {
              $facCheck = 'checked';
              $periodoCheck = $cuenta->entityInfo->tradeBilling->period;
              $montoSelect = $cuenta->entityInfo->tradeBilling->amount;
              $diasPerCheck = $cuenta->entityInfo->tradeBilling->days;
              $idFac = $cuenta->entityInfo->tradeBilling->idTradeBilling;
              $aDiaSelectF = explode("|",$diasPerCheck);
            }else{
              $puGnlCheck = 'checked'; 
            }

            if ($cuenta->entityInfo->dispersionAccount == 'CONC_ADQUI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            } else if ($cuenta->entityInfo->dispersionAccount == 'CONC_EMI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            }else if(strlen($cuenta->entityInfo->dispersionAccount) == 18) {
              $fueraCheck = 'checked';
              $clabe = $cuenta->entityInfo->dispersionAccount;
            }else{
              $oCuentaCheck = 'checked';
              $oCuenta = $cuenta->entityInfo->dispersionAccount;
            }
            
          ?>
            <script type="text/javascript">
              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
              var tipoEnt = '<?php echo $cuenta->entityInfo->typeAffiliation?>';
              var dispersion = '<?php echo $cuenta->entityInfo->dispersionAccount?>';
              var modelo = '<?php echo $cuenta->entityInfo->idbusinessModel?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              /*var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';*/

            </script>
            
            <form enctype="multipart/form-data" method="post" id="form-wizard-subafiliado">
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
                          <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="nombreHelp" value="<?php echo $cuenta->entityInfo->nameCommerce?>">
                          <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->entityInfo->guid?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->entityInfo->idContext?>">
                          <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->entityInfo->idEntity?>">
                          <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->entityInfo->idTerminal?>">
                          <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->entityInfo->idTerminalUser?>">
                          <input type="hidden" id="idFac" name="idFac" value="<?php echo $idFac?>">
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($cuenta->entityInfo->phoneNumber != '0') ? $cuenta->entityInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <!--div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Confirmar Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                          <small id="emailConfirmHelp" class="error form-text text-muted"></small>
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
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->entityInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->entityInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->entityInfo->address->interiorNumber != 'ND') ? $cuenta->entityInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->entityInfo->address->postalCode?>">
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
                              <input <?php echo $typeAgCheck?> type="radio" name="typeSub" value="1">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeCoCheck?> type="radio" name="typeSub" value="2">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <!--div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php //echo $typePVCheck?> type="radio" name="typeSub" value="3">
                              <span class="radio"></span> Punto de venta
                            </label>
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
                              <input <?php echo $modAdCheck?> class="tipoModelo" type="radio" name="modelo" value="2">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div> 
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modEmCheck?> class="tipoModelo" type="radio" name="modelo" value="1">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modMiCheck?> class="tipoModelo" type="radio" name="modelo" value="3">
                              <span class="radio"></span> Mixto
                            </label>
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
                              <input checked type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
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
                              <input <?php echo $enRedCheck?> class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $fueraCheck?> class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $oCuentaCheck?> class="tipoDis" type="radio" name="dispersion" value="otra">
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
                              <label for="cuentaDes">Elige la cuenta destino</label>
                              <select class="form-control" id="cuentaDes" name="cuentaDes">
                                <option></option>
                                <option value="CONC_ADQUI" selected>Cuenta Adquirente</option>
                              </select>
                              <small id="cuentaDesHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="clabeInt">Clabe Interbancaria </label>
                              <input value="<?php echo $clabeImp = ($clabe != '') ? $clabe : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="clabeInt" name="clabeInt" aria-describedby="cpHelp">
                              <small id="clabeIntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta Kash</label>
                              <input value="<?php echo $oCuenta = ($oCuenta != '') ? $oCuenta : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="cuentaKash" name="cuentaKash" aria-describedby="cpHelp">
                              <small id="cuentaKashHelp" class="error form-text text-muted"></small>
                            </div>
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
                              <input <?php echo $puGnlCheck ?> type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input <?php echo $facCheck?> type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="perFac">Elige el periodo</label>
                              <select class="form-control" id="perFac" name="perFac">
                                <option></option>
                                <?php 
                                $aDiasF = ['MES','QUINCENA','SEMANA','DIA'];
                                for ($iDFac=0; $iDFac < count($aDiasF) ; $iDFac++) { 
                                  if ($periodoCheck == $aDiasF[$iDFac]) {
                                    echo '<option selected value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }else{
                                    echo '<option value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }
                                }
                                ?>
                              </select>
                              <small id="perFacHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
                              <div class="option-group field">
                                <div class="col-md-4">
                                  <label class="option block option-primary">
                                      <input <?php echo $dLnsF = (in_array('Lun',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Lun">
                                      <span class="checkbox"></span> Lunes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMarF = (in_array('Mar',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mar">
                                      <span class="checkbox"></span> Martes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMieF = (in_array('Mie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mie">
                                      <span class="checkbox"></span> Miercoles
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dJueF = (in_array('Jue',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Jue">
                                      <span class="checkbox"></span> Jueves
                                  </label>
                                </div>
                                <div class="col-md-4">
                                  <label class="option block option-primary mt10">
                                    <input <?php echo $dVieF = (in_array('Vie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Vie">
                                    <span class="checkbox"></span> Viernes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dSabF = (in_array('Sab',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Sab">
                                      <span class="checkbox"></span> Sabado
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dDomF = (in_array('Dom',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Dom">
                                      <span class="checkbox"></span> Domingo
                                  </label>
                                </div>
                                
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="option-group field" style="margin-top:30px ">
                                <div class="col-md-12">
                                  <label class="option block option-primary">
                                    <input <?php echo $retValFacMay = ($montoSelect > 0.0) ? 'checked' : '' ; ?> type="checkbox" class="facTransa" name="facTrans" value="0">
                                    <span class="checkbox"></span> Facturar transacciones mayores a
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="divMonFac" class="col-md-4 form-group" style="margin-top:10px;">
                              <label for="montoFac">Captura el monto</label>
                              <input value="<?php echo $retValMonto = ($montoSelect > 0.0) ? number_format($montoSelect,2) : '' ; ?>"  type="text" id="monto" name="monto" class="monto form-control" />
                              <small id="perFacHelp" class="error form-text text-muted"></small>
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
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $cuenta->entityInfo->businessName?>">
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
                              if ($cuenta->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $cuenta->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $cuenta->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
                              <?php
                              if ($cuenta->entityInfo->contacts != null) {
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
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->name.'" >
                              <input type="hidden" id="idContRep" name="idContRep" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" id="idContRep" name="idContRep" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->street : "" ;
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$retVal.'" >';
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
                             $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->exteriorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->interiorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode : "" ;
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$retVal.'" >';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode.'";
                            var idLocalidadSelectedCont = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->idLocation.'";
                          </script>';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "";
                            var idLocalidadSelectedCont = "";
                          </script>';
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
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
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
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->entityInfo->ineFile == '' || $cuenta->entityInfo->ineFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->entityInfo->proofOfAddressFile == '' || $cuenta->entityInfo->proofOfAddressFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->entityInfo->constitutiveActFile == '' || $cuenta->entityInfo->constitutiveActFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
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
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->name.'" >
                             <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                             <input type="hidden" id="idContCom" name="idContCom" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
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
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$cuenta->entityInfo->contacts[$comercialtype]->startTime.'" >';
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
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$cuenta->entityInfo->contacts[$comercialtype]->endTime.'" >';
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
                              $dias = explode("|", $cuenta->entityInfo->contacts[$comercialtype]->days);
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
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="<?php echo $cuenta->entityInfo->contacts[$soportetype]->id?">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
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
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->startTime.'" >';
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
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->endTime.'" >';
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
                            $dias2 = explode("|", $cuenta->entityInfo->contacts[$soportetype]->days);
                            
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
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" id="idContactFin" name="idContactFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" id="idContactFin" name="idContactFin" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
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
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->startTime.'" >';
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
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->endTime.'" >';
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
                            $dias3 = explode("|", $cuenta->entityInfo->contacts[$finanzastype]->days);                           
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
            <!-- -------------- /Form -------------- -->
          <?php } ?>
          <?php if (session('idRol') == 4) { 
            // entidad
            $isRLegal = 'na';
            $isComercial = 'na';
            $isSoporte = 'na';
            $isFinanzas = 'na';
            $rLegaltype = '';
            $comercialtype = '';
            $soportetype = '';
            $finanzastype = '';
            $rLegalcp = '';
            $typeAgCheck = '';
            $typeCoCheck = '';
            $typePVCheck = '';
            $modAdCheck = '';
            $modEmCheck = '';
            $modMiCheck = '';
            $facCheck = '';
            $puGnlCheck = '';
            $periodoCheck = '';
            $diasPerCheck = '';
            $montoSelect = '';
            $idFac = '';
            $enRedCheck = '';
            $fueraCheck = '';
            $oCuentaCheck = '';
            $oCuenta = '';
            $clabe = '';
            $cDestino = '';
            $aDiaSelectF = array();


            if ($cuenta->entityInfo->contacts != null) {
              for ($iCont=0; $iCont < count($cuenta->entityInfo->contacts) ; $iCont++) { 
                if ($cuenta->entityInfo->contacts[$iCont]->type == 1) {
                  $isRLegal = 'existe';
                  $rLegaltype = $iCont;
                  $rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->idLocation;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 2) {
                  $isComercial = 'existe';
                  $comercialtype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 3) {
                  $isSoporte = 'existe';
                  $soportetype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 4) {
                  $isFinanzas = 'existe';
                  $finanzastype = $iCont;
                }
              }
            }
            //echo $rLegalcp;
            if ($cuenta->entityInfo->typeAffiliation == '1') {
              $typeAgCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->typeAffiliation == '2') {
              $typeCoCheck = 'checked';
            }elseif ($cuenta->entityInfo->typeAffiliation == '3') {
              $typePVCheck = 'checked';
            }else{
              $typeAgCheck = 'checked';
            }
            if ($cuenta->entityInfo->idbusinessModel == '2') {
              $modAdCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->idbusinessModel == '1') {
              $modEmCheck = 'checked';
            }elseif ($cuenta->entityInfo->idbusinessModel == '3') {
              $modMiCheck = 'checked';
            }else{
              $modAdCheck = 'checked'; 
            }
            if ($cuenta->entityInfo->tradeBilling != null) {
              $facCheck = 'checked';
              $periodoCheck = $cuenta->entityInfo->tradeBilling->period;
              $montoSelect = $cuenta->entityInfo->tradeBilling->amount;
              $diasPerCheck = $cuenta->entityInfo->tradeBilling->days;
              $idFac = $cuenta->entityInfo->tradeBilling->idTradeBilling;
              $aDiaSelectF = explode("|",$diasPerCheck);
            }else{
              $puGnlCheck = 'checked'; 
            }

            if ($cuenta->entityInfo->dispersionAccount == 'CONC_ADQUI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            } else if ($cuenta->entityInfo->dispersionAccount == 'CONC_EMI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            }else if(strlen($cuenta->entityInfo->dispersionAccount) == 18) {
              $fueraCheck = 'checked';
              $clabe = $cuenta->entityInfo->dispersionAccount;
            }else{
              $oCuentaCheck = 'checked';
              $oCuenta = $cuenta->entityInfo->dispersionAccount;
            }
            
          ?>
            <script type="text/javascript">
              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
              var tipoEnt = '<?php echo $cuenta->entityInfo->typeAffiliation?>';
              var dispersion = '<?php echo $cuenta->entityInfo->dispersionAccount?>';
              var modelo = '<?php echo $cuenta->entityInfo->idbusinessModel?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              /*var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';*/

            </script>
            
            <form enctype="multipart/form-data" method="post" id="form-wizard-entidad">
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
                            <?php
                            //var_dump($subafiliados->contextResponse);
                            for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                              if($subafiliados->contextResponse[$iSub]->idContext == $cuenta->entityInfo->idContext){
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
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="safiliacion">Nombre*</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="nombreHelp" value="<?php echo $cuenta->entityInfo->nameCommerce?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->entityInfo->idContext?>">
                          <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->entityInfo->idEntity?>">
                          <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->entityInfo->idTerminal?>">
                          <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->entityInfo->idTerminalUser?>">
                          <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->entityInfo->guid?>">
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                          <input type="hidden" id="idFac" name="idFac" value="<?php echo $idFac?>">
                        </div>
                      </div>
                      
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($cuenta->entityInfo->phoneNumber != '0') ? $cuenta->entityInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <!--div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Confirmar Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                          <small id="emailConfirmHelp" class="error form-text text-muted"></small>
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
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->entityInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->entityInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->entityInfo->address->interiorNumber != 'ND') ? $cuenta->entityInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->entityInfo->address->postalCode?>">
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
                    </div>
                  </section>
                  <!-- -------------- step 2 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Reglas
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Tipo de Entidad</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeAgCheck?> type="radio" name="typeSub" value="1">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeCoCheck?> type="radio" name="typeSub" value="2">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typePVCheck?> type="radio" name="typeSub" value="3">
                              <span class="radio"></span> Punto de venta
                            </label>
                          </div>
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
                              <input <?php echo $modAdCheck?> class="tipoModelo" type="radio" name="modelo" value="2">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div> 
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modEmCheck?> class="tipoModelo" type="radio" name="modelo" value="1">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modMiCheck?> class="tipoModelo" type="radio" name="modelo" value="3">
                              <span class="radio"></span> Mixto
                            </label>
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
                              <input checked type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
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
                              <input <?php echo $enRedCheck?> class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $fueraCheck?> class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $oCuentaCheck?> class="tipoDis" type="radio" name="dispersion" value="otra">
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
                              <label for="cuentaDes">Elige la cuenta destino</label>
                              <select class="form-control" id="cuentaDes" name="cuentaDes">
                                <option></option>
                                <option value="CONC_ADQUI" selected>Cuenta Adquirente</option>
                              </select>
                              <small id="cuentaDesHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="clabeInt">Clabe Interbancaria </label>
                              <input value="<?php echo $clabeImp = ($clabe != '') ? $clabe : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="clabeInt" name="clabeInt" aria-describedby="cpHelp">
                              <small id="clabeIntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta Kash</label>
                              <input value="<?php echo $oCuenta = ($oCuenta != '') ? $oCuenta : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="cuentaKash" name="cuentaKash" aria-describedby="cpHelp">
                              <small id="cuentaKashHelp" class="error form-text text-muted"></small>
                            </div>
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
                              <input <?php echo $puGnlCheck ?> type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input <?php echo $facCheck?> type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="perFac">Elige el periodo</label>
                              <select class="form-control" id="perFac" name="perFac">
                                <option></option>
                                <?php 
                                $aDiasF = ['MES','QUINCENA','SEMANA','DIA'];
                                for ($iDFac=0; $iDFac < count($aDiasF) ; $iDFac++) { 
                                  if ($periodoCheck == $aDiasF[$iDFac]) {
                                    echo '<option selected value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }else{
                                    echo '<option value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }
                                }
                                ?>
                              </select>
                              <small id="perFacHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
                              <div class="option-group field">
                                <div class="col-md-4">
                                  <label class="option block option-primary">
                                      <input <?php echo $dLnsF = (in_array('Lun',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Lun">
                                      <span class="checkbox"></span> Lunes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMarF = (in_array('Mar',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mar">
                                      <span class="checkbox"></span> Martes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMieF = (in_array('Mie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mie">
                                      <span class="checkbox"></span> Miercoles
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dJueF = (in_array('Jue',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Jue">
                                      <span class="checkbox"></span> Jueves
                                  </label>
                                </div>
                                <div class="col-md-4">
                                  <label class="option block option-primary mt10">
                                    <input <?php echo $dVieF = (in_array('Vie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Vie">
                                    <span class="checkbox"></span> Viernes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dSabF = (in_array('Sab',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Sab">
                                      <span class="checkbox"></span> Sabado
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dDomF = (in_array('Dom',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Dom">
                                      <span class="checkbox"></span> Domingo
                                  </label>
                                </div>
                                
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="option-group field" style="margin-top:30px ">
                                <div class="col-md-12">
                                  <label class="option block option-primary">
                                    <input <?php echo $retValFacMay = ($montoSelect > 0.0) ? 'checked' : '' ; ?> type="checkbox" class="facTransa" name="facTrans" value="0">
                                    <span class="checkbox"></span> Facturar transacciones mayores a
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="divMonFac" class="col-md-4 form-group" style="margin-top:10px;">
                              <label for="montoFac">Captura el monto</label>
                              <input value="<?php echo $retValMonto = ($montoSelect > 0.0) ? $montoSelect : '' ; ?>"  type="text" id="monto" name="monto" class="monto form-control" />
                              <small id="perFacHelp" class="error form-text text-muted"></small>
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
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $cuenta->entityInfo->businessName?>">
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
                              if ($cuenta->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $cuenta->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $cuenta->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
                              <?php
                              if ($cuenta->entityInfo->contacts != null) {
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
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->name.'" >
                              <input type="hidden" id="idContRep" name="idContRep" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" id="idContRep" name="idContRep" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->street : "" ;
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$retVal.'" >';
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
                             $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->exteriorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->interiorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode : "" ;
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$retVal.'" >';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode.'";
                            var idLocalidadSelectedCont = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->idLocation.'";
                          </script>';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "";
                            var idLocalidadSelectedCont = "";
                          </script>';
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
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
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
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->entityInfo->ineFile == '' || $cuenta->entityInfo->ineFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->entityInfo->proofOfAddressFile == '' || $cuenta->entityInfo->proofOfAddressFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->entityInfo->constitutiveActFile == '' || $cuenta->entityInfo->constitutiveActFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
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
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->name.'" >
                             <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                             <input type="hidden" id="idContCom" name="idContCom" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
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
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$cuenta->entityInfo->contacts[$comercialtype]->startTime.'" >';
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
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$cuenta->entityInfo->contacts[$comercialtype]->endTime.'" >';
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
                              $dias = explode("|", $cuenta->entityInfo->contacts[$comercialtype]->days);
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
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="<?php echo $cuenta->entityInfo->contacts[$soportetype]->id?">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
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
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->startTime.'" >';
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
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->endTime.'" >';
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
                            $dias2 = explode("|", $cuenta->entityInfo->contacts[$soportetype]->days);
                            
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
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" id="idContactFin" name="idContactFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" id="idContactFin" name="idContactFin" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
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
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->startTime.'" >';
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
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->endTime.'" >';
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
                            $dias3 = explode("|", $cuenta->entityInfo->contacts[$finanzastype]->days);                           
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
            <!-- -------------- /Form -------------- -->
          <?php } ?>
          <?php if (session('idRol') == 5) { 
            // sucursal
            $isRLegal = 'na';
            $isComercial = 'na';
            $isSoporte = 'na';
            $isFinanzas = 'na';
            $rLegaltype = '';
            $comercialtype = '';
            $soportetype = '';
            $finanzastype = '';
            $rLegalcp = '';
            $typeAgCheck = '';
            $typeCoCheck = '';
            $typePVCheck = '';
            $modAdCheck = '';
            $modEmCheck = '';
            $modMiCheck = '';
            $facCheck = '';
            $puGnlCheck = '';
            $periodoCheck = '';
            $diasPerCheck = '';
            $montoSelect = '';
            $idFac = '';
            $enRedCheck = '';
            $fueraCheck = '';
            $oCuentaCheck = '';
            $oCuenta = '';
            $clabe = '';
            $cDestino = '';
            $aDiaSelectF = array();

            if ($cuenta->entityInfo->contacts != null) {
              for ($iCont=0; $iCont < count($cuenta->entityInfo->contacts) ; $iCont++) { 
                if ($cuenta->entityInfo->contacts[$iCont]->type == 1) {
                  $isRLegal = 'existe';
                  $rLegaltype = $iCont;
                  $rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->idLocation;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 2) {
                  $isComercial = 'existe';
                  $comercialtype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 3) {
                  $isSoporte = 'existe';
                  $soportetype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 4) {
                  $isFinanzas = 'existe';
                  $finanzastype = $iCont;
                }
              }
            }
            //echo $rLegalcp;
            if ($cuenta->entityInfo->typeAffiliation == '1') {
              $typeAgCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->typeAffiliation == '2') {
              $typeCoCheck = 'checked';
            }elseif ($cuenta->entityInfo->typeAffiliation == '3') {
              $typePVCheck = 'checked';
            }else{
              $typeAgCheck = 'checked';
            }
            if ($cuenta->entityInfo->idbusinessModel == '2') {
              $modAdCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->idbusinessModel == '1') {
              $modEmCheck = 'checked';
            }elseif ($cuenta->entityInfo->idbusinessModel == '3') {
              $modMiCheck = 'checked';
            }else{
              $modAdCheck = 'checked'; 
            }
            if ($cuenta->entityInfo->tradeBilling != null) {
              $facCheck = 'checked';
              $periodoCheck = $cuenta->entityInfo->tradeBilling->period;
              $montoSelect = $cuenta->entityInfo->tradeBilling->amount;
              $diasPerCheck = $cuenta->entityInfo->tradeBilling->days;
              $idFac = $cuenta->entityInfo->tradeBilling->idTradeBilling;
              $aDiaSelectF = explode("|",$diasPerCheck);
            }else{
              $puGnlCheck = 'checked'; 
            }

            if ($cuenta->entityInfo->dispersionAccount == 'CONC_ADQUI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            } else if ($cuenta->entityInfo->dispersionAccount == 'CONC_EMI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            }else if(strlen($cuenta->entityInfo->dispersionAccount) == 18) {
              $fueraCheck = 'checked';
              $clabe = $cuenta->entityInfo->dispersionAccount;
            }else{
              $oCuentaCheck = 'checked';
              $oCuenta = $cuenta->entityInfo->dispersionAccount;
            }
            
          ?>
            <script type="text/javascript">
              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
              var tipoEnt = '<?php echo $cuenta->entityInfo->typeAffiliation?>';
              var dispersion = '<?php echo $cuenta->entityInfo->dispersionAccount?>';
              var modelo = '<?php echo $cuenta->entityInfo->idbusinessModel?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              /*var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';*/

            </script>
            <form enctype="multipart/form-data" method="post" id="form-wizard-sucursal">
                <div class="wizard steps-bg clearfix steps-left">
                  <!-- -------------- step 1 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Datos Generales
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subafiliado">Subafiliado*</label>
                        <select class="form-control" id="subafiliado" name="subafiliado" aria-describedby="subafiliadoHelp">
                          <option></option>
                          <?php
                          for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                            if($subafiliados->contextResponse[$iSub]->idContext == $cuenta->entityInfo->idContext){
                              echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }else{
                              //echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }
                          }
                          ?>
                          <script type="text/javascript">
                            var entiSelect = '<?php echo session('idEntity')?>';
                          </script>
                        </select>
                        <small id="subafiliadoHelp" class="error form-text text-muted"></small>
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
                    </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="safiliacion">Nombre*</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="nombreHelp" value="<?php echo $cuenta->entityInfo->nameCommerce?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->entityInfo->idContext?>">
                          <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->entityInfo->idEntity?>">
                          <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->entityInfo->idTerminal?>">
                          <input type="hidden" id="localidadCon" name="localidadCon" value="<?php echo $rLegalcp?>">
                          <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->entityInfo->idTerminalUser?>">
                          <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->entityInfo->guid?>">
                          <input type="hidden" id="idFac" name="idFac" value="<?php echo $idFac?>">
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($cuenta->entityInfo->phoneNumber != '0') ? $cuenta->entityInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <!--div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Confirmar Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                          <small id="emailConfirmHelp" class="error form-text text-muted"></small>
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
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->entityInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->entityInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->entityInfo->address->interiorNumber != 'ND') ? $cuenta->entityInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->entityInfo->address->postalCode?>">
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
                    </div>
                  </section>
                  <!-- -------------- step 2 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Reglas
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Tipo de Sucursal</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeAgCheck?> type="radio" name="typeSub" value="1">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeCoCheck?> type="radio" name="typeSub" value="2">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typePVCheck?> type="radio" name="typeSub" value="3">
                              <span class="radio"></span> Punto de venta
                            </label>
                          </div>
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
                              <input <?php echo $modAdCheck?> class="tipoModelo" type="radio" name="modelo" value="2">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div> 
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modEmCheck?> class="tipoModelo" type="radio" name="modelo" value="1">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modMiCheck?> class="tipoModelo" type="radio" name="modelo" value="3">
                              <span class="radio"></span> Mixto
                            </label>
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
                              <input checked type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
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
                              <input <?php echo $enRedCheck?> class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $fueraCheck?> class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $oCuentaCheck?> class="tipoDis" type="radio" name="dispersion" value="otra">
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
                              <label for="cuentaDes">Elige la cuenta destino</label>
                              <select class="form-control" id="cuentaDes" name="cuentaDes">
                                <option></option>
                                <option value="CONC_ADQUI" selected>Cuenta Adquirente</option>
                              </select>
                              <small id="cuentaDesHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="clabeInt">Clabe Interbancaria </label>
                              <input value="<?php echo $clabeImp = ($clabe != '') ? $clabe : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="clabeInt" name="clabeInt" aria-describedby="cpHelp">
                              <small id="clabeIntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta Kash</label>
                              <input value="<?php echo $oCuenta = ($oCuenta != '') ? $oCuenta : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="cuentaKash" name="cuentaKash" aria-describedby="cpHelp">
                              <small id="cuentaKashHelp" class="error form-text text-muted"></small>
                            </div>
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
                              <input <?php echo $puGnlCheck ?> type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input <?php echo $facCheck?> type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="perFac">Elige el periodo</label>
                              <select class="form-control" id="perFac" name="perFac">
                                <option></option>
                                <?php 
                                $aDiasF = ['MES','QUINCENA','SEMANA','DIA'];
                                for ($iDFac=0; $iDFac < count($aDiasF) ; $iDFac++) { 
                                  if ($periodoCheck == $aDiasF[$iDFac]) {
                                    echo '<option selected value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }else{
                                    echo '<option value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }
                                }
                                ?>
                              </select>
                              <small id="perFacHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
                              <div class="option-group field">
                                <div class="col-md-4">
                                  <label class="option block option-primary">
                                      <input <?php echo $dLnsF = (in_array('Lun',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Lun">
                                      <span class="checkbox"></span> Lunes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMarF = (in_array('Mar',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mar">
                                      <span class="checkbox"></span> Martes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMieF = (in_array('Mie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mie">
                                      <span class="checkbox"></span> Miercoles
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dJueF = (in_array('Jue',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Jue">
                                      <span class="checkbox"></span> Jueves
                                  </label>
                                </div>
                                <div class="col-md-4">
                                  <label class="option block option-primary mt10">
                                    <input <?php echo $dVieF = (in_array('Vie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Vie">
                                    <span class="checkbox"></span> Viernes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dSabF = (in_array('Sab',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Sab">
                                      <span class="checkbox"></span> Sabado
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dDomF = (in_array('Dom',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Dom">
                                      <span class="checkbox"></span> Domingo
                                  </label>
                                </div>
                                
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="option-group field" style="margin-top:30px ">
                                <div class="col-md-12">
                                  <label class="option block option-primary">
                                    <input <?php echo $retValFacMay = ($montoSelect > 0.0) ? 'checked' : '' ; ?> type="checkbox" class="facTransa" name="facTrans" value="0">
                                    <span class="checkbox"></span> Facturar transacciones mayores a
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="divMonFac" class="col-md-4 form-group" style="margin-top:10px;">
                              <label for="montoFac">Captura el monto</label>
                              <input value="<?php echo $retValMonto = ($montoSelect > 0.0) ? number_format($montoSelect,2)  : '' ; ?>"  type="text" id="monto" name="monto" class="monto form-control" />
                              <small id="perFacHelp" class="error form-text text-muted"></small>
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
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $cuenta->entityInfo->businessName?>">
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
                              if ($cuenta->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $cuenta->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $cuenta->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
                              console.log('cpSelectedCon = '+cpSelectedCon);
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
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->name.'" >
                              <input type="hidden" id="idContRep" name="idContRep" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" id="idContRep" name="idContRep" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->street : "" ;
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$retVal.'" >';
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
                             $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->exteriorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->interiorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode : "" ;
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$retVal.'" >';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode.'";
                            var idLocalidadSelectedCont = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->idLocation.'";
                          </script>';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "";
                            var idLocalidadSelectedCont = "";
                          </script>';
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
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
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
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->entityInfo->ineFile == '' || $cuenta->entityInfo->ineFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->entityInfo->proofOfAddressFile == '' || $cuenta->entityInfo->proofOfAddressFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->entityInfo->constitutiveActFile == '' || $cuenta->entityInfo->constitutiveActFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
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
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->name.'" >
                             <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                             <input type="hidden" id="idContCom" name="idContCom" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
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
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$cuenta->entityInfo->contacts[$comercialtype]->startTime.'" >';
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
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$cuenta->entityInfo->contacts[$comercialtype]->endTime.'" >';
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
                              $dias = explode("|", $cuenta->entityInfo->contacts[$comercialtype]->days);
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
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="<?php echo $cuenta->entityInfo->contacts[$soportetype]->id?">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
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
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->startTime.'" >';
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
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->endTime.'" >';
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
                            $dias2 = explode("|", $cuenta->entityInfo->contacts[$soportetype]->days);
                            
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
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" id="idContactFin" name="idContactFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" id="idContactFin" name="idContactFin" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
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
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->startTime.'" >';
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
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->endTime.'" >';
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
                            $dias3 = explode("|", $cuenta->entityInfo->contacts[$finanzastype]->days);                           
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
            <!-- -------------- /Form -------------- -->
          <?php } ?>
          <?php if (session('idRol') == 6) { 
            // caja
            $isRLegal = 'na';
            $isComercial = 'na';
            $isSoporte = 'na';
            $isFinanzas = 'na';
            $rLegaltype = '';
            $comercialtype = '';
            $soportetype = '';
            $finanzastype = '';
            $rLegalcp = '';
            $typeAgCheck = '';
            $typeCoCheck = '';
            $typePVCheck = '';
            $modAdCheck = '';
            $modEmCheck = '';
            $modMiCheck = '';
            $facCheck = '';
            $puGnlCheck = '';
            $periodoCheck = '';
            $diasPerCheck = '';
            $montoSelect = '';
            $idFac = '';
            $enRedCheck = '';
            $fueraCheck = '';
            $oCuentaCheck = '';
            $oCuenta = '';
            $clabe = '';
            $cDestino = '';
            $mDisp = '';
            $sDisp = '';
            $aDiaSelectF = array();


            if ($cuenta->entityInfo->devices != null) {
              $mDisp = $cuenta->entityInfo->devices[0]->deviceModelId;
              $sDisp = $cuenta->entityInfo->devices[0]->serialNumber;
            }
            if ($cuenta->entityInfo->contacts != null) {
              for ($iCont=0; $iCont < count($cuenta->entityInfo->contacts) ; $iCont++) { 
                if ($cuenta->entityInfo->contacts[$iCont]->type == 1) {
                  $isRLegal = 'existe';
                  $rLegaltype = $iCont;
                  $rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->idLocation;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 2) {
                  $isComercial = 'existe';
                  $comercialtype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 3) {
                  $isSoporte = 'existe';
                  $soportetype = $iCont;
                }else if ($cuenta->entityInfo->contacts[$iCont]->type == 4) {
                  $isFinanzas = 'existe';
                  $finanzastype = $iCont;
                }
              }
            }
            //echo $rLegalcp;
            if ($cuenta->entityInfo->typeAffiliation == '1') {
              $typeAgCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->typeAffiliation == '2') {
              $typeCoCheck = 'checked';
            }elseif ($cuenta->entityInfo->typeAffiliation == '3') {
              $typePVCheck = 'checked';
            }else{
              $typeAgCheck = 'checked';
            }
            if ($cuenta->entityInfo->idbusinessModel == '2') {
              $modAdCheck = 'checked'; 
            }elseif ($cuenta->entityInfo->idbusinessModel == '1') {
              $modEmCheck = 'checked';
            }elseif ($cuenta->entityInfo->idbusinessModel == '3') {
              $modMiCheck = 'checked';
            }else{
              $modAdCheck = 'checked'; 
            }
            if ($cuenta->entityInfo->tradeBilling != null) {
              $facCheck = 'checked';
              $periodoCheck = $cuenta->entityInfo->tradeBilling->period;
              $montoSelect = $cuenta->entityInfo->tradeBilling->amount;
              $diasPerCheck = $cuenta->entityInfo->tradeBilling->days;
              $idFac = $cuenta->entityInfo->tradeBilling->idTradeBilling;
              $aDiaSelectF = explode("|",$diasPerCheck);
            }else{
              $puGnlCheck = 'checked'; 
            }

            if ($cuenta->entityInfo->dispersionAccount == 'CONC_ADQUI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            } else if ($cuenta->entityInfo->dispersionAccount == 'CONC_EMI') {
              $enRedCheck = 'checked';
              $cDestino = $cuenta->entityInfo->dispersionAccount;
            }else if(strlen($cuenta->entityInfo->dispersionAccount) == 18) {
              $fueraCheck = 'checked';
              $clabe = $cuenta->entityInfo->dispersionAccount;
            }else{
              $oCuentaCheck = 'checked';
              $oCuenta = $cuenta->entityInfo->dispersionAccount;
            }
            
          ?>
            <script type="text/javascript">
              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
              var tipoEnt = '<?php echo $cuenta->entityInfo->typeAffiliation?>';
              var dispersion = '<?php echo $cuenta->entityInfo->dispersionAccount?>';
              var modelo = '<?php echo $cuenta->entityInfo->idbusinessModel?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              /*var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';
              var cpSelectedCon = '<?php echo $rLegalcp?>';*/

            </script>
            <form enctype="multipart/form-data" method="post" id="form-wizard-caja">
                <div class="wizard steps-bg clearfix steps-left">
                  <!-- -------------- step 1 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Datos Generales
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="subafiliado">SubAfiliado*</label>
                          <select class="form-control" name="subafiliado" id="subafiliado">
                            <?php
                            for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                              if ($cuenta->entityInfo->idContext == $subafiliados->contextResponse[$iSub]->idContext) {
                                echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                              }else{
                                echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                              }
                              
                            }
                            ?>
                            <script type="text/javascript">
                              var entiSelect = '<?php echo session('idEntity')?>';
                              var sucSelect = '<?php echo session('idTerminal')?>';
                            </script>
                          </select>
                          <small id="subafiliadoHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="entidad">Entidad*</label>
                          <select class="form-control" name="entidad" id="entidad">
                            <option value=""></option>
                          </select>
                          <small id="entidadHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Sucursal*</label>
                          <select class="form-control" name="sucursal" id="sucursal">
                            <option value=""></option>
                          </select>
                          <small id="sucursalHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="nombre">Nombre*</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" value="<?php echo $valname = ($cuenta->entityInfo->nameCommerce != 'ND') ? $cuenta->entityInfo->nameCommerce : '' ; ?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->entityInfo->idCommerceDetail?>">
                            <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->entityInfo->idContext?>">
                            <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->entityInfo->idEntity?>">
                            <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->entityInfo->idTerminal?>">
                            <input type="hidden" id="localidadCon" name="localidadCon" value="<?php echo $rLegalcp?>">
                            <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->entityInfo->idTerminalUser?>">
                            <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->entityInfo->guid?>">
                            <input type="hidden" id="idFac" name="idFac" value="<?php echo $idFac?>">
                            
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aPaterno">Apellido Paterno*</label>
                          <input type="text" class="form-control" id="aPaterno" name="aPaterno" aria-describedby="aPaternoHelp" value="<?php echo $valapa = ($cuenta->entityInfo->paternalSurname != 'ND') ? $cuenta->entityInfo->paternalSurname : '' ; ?>">
                          <small id="aPaternoHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="aMaterno">Apellido Materno*</label>
                          <input type="text" class="form-control" id="aMaterno" name="aMaterno" aria-describedby="aMaternoHelp" value="<?php echo $valama = ($cuenta->entityInfo->maternalSurname != 'ND') ? $cuenta->entityInfo->maternalSurname : '' ; ?>">
                          <small id="aMaternoHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">                  
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($cuenta->entityInfo->phoneNumber != '0') ? $cuenta->entityInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div-->
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Dirección</h3>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->entityInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->entityInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->entityInfo->address->interiorNumber != 'ND') ? $cuenta->entityInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->entityInfo->address->postalCode?>">
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
                    </div>
                  </section>
                  <!-- -------------- step 2 -------------- -->
                  <h4 class="wizard-section-title">
                      <i class="fa fa-user pr5"></i> Reglas
                  </h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Tipo de Caja</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="fin"></label>
                        <div class="option-group field">
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeAgCheck?> type="radio" name="typeSub" value="1">
                              <span class="radio"></span> Agregador
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typeCoCheck?> type="radio" name="typeSub" value="2">
                              <span class="radio"></span> Comisionista
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $typePVCheck?> type="radio" name="typeSub" value="3">
                              <span class="radio"></span> Punto de venta
                            </label>
                          </div>
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
                              <input <?php echo $modAdCheck?> class="tipoModelo" type="radio" name="modelo" value="2">
                              <span class="radio"></span> Adquirente
                            </label>
                          </div> 
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modEmCheck?> class="tipoModelo" type="radio" name="modelo" value="1">
                              <span class="radio"></span> Emision
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $modMiCheck?> class="tipoModelo" type="radio" name="modelo" value="3">
                              <span class="radio"></span> Mixto
                            </label>
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
                              <input checked type="checkbox" name="liquidacion" value="0">
                              <span class="checkbox"></span> Si
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
                              <input <?php echo $enRedCheck?> class="tipoDis" type="radio" name="dispersion" value="en">
                              <span class="radio"></span> En RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $fueraCheck?> class="tipoDis" type="radio" name="dispersion" value="fuera">
                              <span class="radio"></span> Fuera de RED
                            </label>
                          </div>
                          <div class="col-md-4">
                            <label class="option block option-primary">
                              <input <?php echo $oCuentaCheck?> class="tipoDis" type="radio" name="dispersion" value="otra">
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
                              <label for="cuentaDes">Elige la cuenta destino</label>
                              <select class="form-control" id="cuentaDes" name="cuentaDes">
                                <option></option>
                                <option value="CONC_ADQUI" selected>Cuenta Adquirente</option>
                              </select>
                              <small id="cuentaDesHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaFuera">
                              <label for="clabeInt">Clabe Interbancaria </label>
                              <input value="<?php echo $clabeImp = ($clabe != '') ? $clabe : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="clabeInt" name="clabeInt" aria-describedby="cpHelp">
                              <small id="clabeIntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group divCuentaOtra">
                              <label for="otraCuenta">Cuenta Kash</label>
                              <input value="<?php echo $oCuenta = ($oCuenta != '') ? $oCuenta : '' ;?>" type="text" maxlength="18" class="form-control soloNum" id="cuentaKash" name="cuentaKash" aria-describedby="cpHelp">
                              <small id="cuentaKashHelp" class="error form-text text-muted"></small>
                            </div>
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
                              <input <?php echo $puGnlCheck ?> type="radio" class="tipoF" name="facturacion" value="publicoGen">
                              <span class="radio"></span> Público en General
                            </label>
                          </div>
                          <div class="col-md-12 adiGeneral">
                          </div>
                          <div class="col-md-12">
                            <label class="option block option-primary">
                              <input <?php echo $facCheck?> type="radio" class="tipoF" name="facturacion" value="facturacion">
                              <span class="radio"></span> Facturación
                            </label>
                          </div>
                          <div class="col-md-12 adiFac">
                            <div class="col-md-4 form-group">
                              <label for="perFac">Elige el periodo</label>
                              <select class="form-control" id="perFac" name="perFac">
                                <option></option>
                                <?php 
                                $aDiasF = ['MES','QUINCENA','SEMANA','DIA'];
                                for ($iDFac=0; $iDFac < count($aDiasF) ; $iDFac++) { 
                                  if ($periodoCheck == $aDiasF[$iDFac]) {
                                    echo '<option selected value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }else{
                                    echo '<option value="'.$aDiasF[$iDFac].'">'.ucfirst($aDiasF[$iDFac]).'</option>';
                                  }
                                }
                                ?>
                              </select>
                              <small id="perFacHelp" class="error form-text text-muted"></small>
                            </div>
                            <div class="col-md-12 ">
                              <label for="fin">Selecciona los días de las transacciones a facturar:</label>
                              <div class="option-group field">
                                <div class="col-md-4">
                                  <label class="option block option-primary">
                                      <input <?php echo $dLnsF = (in_array('Lun',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Lun">
                                      <span class="checkbox"></span> Lunes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMarF = (in_array('Mar',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mar">
                                      <span class="checkbox"></span> Martes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dMieF = (in_array('Mie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Mie">
                                      <span class="checkbox"></span> Miercoles
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dJueF = (in_array('Jue',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Jue">
                                      <span class="checkbox"></span> Jueves
                                  </label>
                                </div>
                                <div class="col-md-4">
                                  <label class="option block option-primary mt10">
                                    <input <?php echo $dVieF = (in_array('Vie',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Vie">
                                    <span class="checkbox"></span> Viernes
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dSabF = (in_array('Sab',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Sab">
                                      <span class="checkbox"></span> Sabado
                                  </label>
                                  <label class="option block option-primary mt10">
                                      <input <?php echo $dDomF = (in_array('Dom',$aDiaSelectF)) ? 'checked' : '' ;?> type="checkbox" name="diasPerFac[]" value="Dom">
                                      <span class="checkbox"></span> Domingo
                                  </label>
                                </div>
                                
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="option-group field" style="margin-top:30px ">
                                <div class="col-md-12">
                                  <label class="option block option-primary">
                                    <input <?php echo $retValFacMay = ($montoSelect > 0.0) ? 'checked' : '' ; ?> type="checkbox" class="facTransa" name="facTrans" value="0">
                                    <span class="checkbox"></span> Facturar transacciones mayores a
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="divMonFac" class="col-md-4 form-group" style="margin-top:10px;">
                              <label for="montoFac">Captura el monto</label>
                              <input value="<?php echo $retValMonto = ($montoSelect > 0.0) ? number_format($montoSelect,2)  : '' ; ?>"  type="text" id="monto" name="monto" class="monto form-control" />
                              <small id="perFacHelp" class="error form-text text-muted"></small>
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
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->entityInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $cuenta->entityInfo->businessName?>">
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
                              if ($cuenta->entityInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="giro">Giro del Comercio*</label>
                          <select class="form-control" id="giro" name="giro">
                            <option></option>
                            <?php
                              $actividades = array();
                              for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                if ($giros[$iGiro]->idGiro == $cuenta->entityInfo->idBussinesLine) {
                                   echo '<option selected value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                } else {
                                   echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                }
                                $actividades = $giros;
                              }

                            ?>
                            <script type="text/javascript">
                              var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                              var actividadSelected = <?php echo $cuenta->entityInfo->idActivity?>;
                              var idLocalidadSelected = '<?php echo $cuenta->entityInfo->address->idLocation?>';
                              var cpSelected = '<?php echo $cuenta->entityInfo->address->postalCode?>';
                              console.log('cpSelectedCon = '+cpSelectedCon);
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
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->name.'" >
                              <input type="hidden" id="idContRep" name="idContRep" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp"  >
                            <input type="hidden" id="idContRep" name="idContRep" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->maternalSurname.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->street : "" ;
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$retVal.'" >';
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
                             $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->exteriorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->interiorNumber : "" ;
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$retVal.'" >';
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
                            $retVal = ($cuenta->entityInfo->contacts[$rLegaltype]->address != null) ? $cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode : "" ;
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$retVal.'" >';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->postalCode.'";
                            var idLocalidadSelectedCont = "'.$cuenta->entityInfo->contacts[$rLegaltype]->address->idLocation.'";
                          </script>';
                          }else{
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp">';
                            echo '<script type="text/javascript">
                            var cpSelectedCon = "";
                            var idLocalidadSelectedCont = "";
                          </script>';
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
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$cuenta->entityInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" >';
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
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->entityInfo->ineFile == '' || $cuenta->entityInfo->ineFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->entityInfo->proofOfAddressFile == '' || $cuenta->entityInfo->proofOfAddressFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->entityInfo->constitutiveActFile == '' || $cuenta->entityInfo->constitutiveActFile == 'ND') {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
                        </div>
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
                          <input type="text" value="<?php echo $retValm = ($mDisp != 'ND') ? $mDisp : '' ; ?>" class="form-control" id="modeloDis" name="modeloDis" aria-describedby="modeloHelp">
                          <input type="hidden" value="<?php //echo $idDisp?>" class="form-control" id="idDis" name="idDis" aria-describedby="modeloHelp">
                          <small id="modeloHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="serie">Serie</label>
                          <input type="text" value="<?php echo $retVals = ($sDisp != 'ND') ? $sDisp : '' ; ?>" class="form-control" id="serie" name="serie" aria-describedby="serieHelp">
                          <small id="serieHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- -------------- step 5 -------------- -->
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
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->name.'" >
                             <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->entityInfo->contacts[$comercialtype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp">
                             <input type="hidden" id="idContCom" name="idContCom" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$cuenta->entityInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp">';
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
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$cuenta->entityInfo->contacts[$comercialtype]->startTime.'" >';
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
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$cuenta->entityInfo->contacts[$comercialtype]->endTime.'" >';
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
                              $dias = explode("|", $cuenta->entityInfo->contacts[$comercialtype]->days);
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
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="<?php echo $cuenta->entityInfo->contacts[$soportetype]->id?">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" id="idContactSop" name="idContactSop" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$cuenta->entityInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp">';
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
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->startTime.'" >';
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
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$cuenta->entityInfo->contacts[$soportetype]->endTime.'" >';
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
                            $dias2 = explode("|", $cuenta->entityInfo->contacts[$soportetype]->days);
                            
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
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" id="idContactFin" name="idContactFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" id="idContactFin" name="idContactFin" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$cuenta->entityInfo->contacts[$finanzastype]->phoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp">';
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
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$cuenta->entityInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
                          }else{
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin">';
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
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->startTime.'" >';
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
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$cuenta->entityInfo->contacts[$finanzastype]->endTime.'" >';
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
                            $dias3 = explode("|", $cuenta->entityInfo->contacts[$finanzastype]->days);                           
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
            <!-- -------------- /Form -------------- -->
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

<!-- -------------- Plugins -------------- -->
 
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addSubAfiliado.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addSubAfiliado.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addEntidad.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addEntidad.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addSucursal.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addSucursal.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addCaja.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addCaja.min.js"></script>

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

<?php if (session('idRol') == 2) {
  // admin
?>
<?php } ?>
<?php if (session('idRol') == 3) { 
  // subAfiliado
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editSubAfiliado.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editSubAfiliado.js"></script>
<?php } ?>
<?php if (session('idRol') == 4) { 
  // entidad
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editEntidad.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editEntidad.js"></script>
<?php } ?>
<?php if (session('idRol') == 5) { 
  // sucursal
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editSucursal.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editSucursal.js"></script>
<?php } ?>
<?php if (session('idRol') == 6) { 
  // caja
?>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-editCaja.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editColaborador.js"></script> 
<?php } ?>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>