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
                  <a href="dashboard">Caja</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Agregar Caja</li>
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

              <form method="post" action="/" id="form-wizard" enctype="multipart/form-data">
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
                        <div class="col-md-12">
                          <div class="option-group field" style="margin-bottom: 40px;">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input checked class="alias" type="radio" name="cAlias" value="2">
                                <span class="radio"></span> Usar correo electrónico activo 
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row emailUsarNo">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">Correo electrónico*</label>
                            <input type="email" class="form-control mail" id="email" name="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="namecommerce">Confirmar Correo electrónico*</label>
                            <input type="email" class="form-control mail" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
                            <small id="emailConfirmHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="option-group field" style="margin-bottom: 50px;">
                            <div class="col-md-12">
                              <label class="option block option-primary">
                                <input class="alias" type="radio" name="cAlias" value="1">
                                <span class="radio"></span> Usar alias
                                <span class="error" style="display:block">Se creará un alias para el registro y el correo de activación llegará a la Entidad o Sub Afiliado que corresponda.</span>
                              </label>
                            </div>                            
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
                                <input checked type="radio" name="typeSub" value="1">
                                <span class="radio"></span> Agregador
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input type="radio" name="typeSub" value="2">
                                <span class="radio"></span> Comisionista
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input type="radio" name="typeSub" value="3">
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
                      <?php 
                        $desAd = '';
                        $desEmi = '';
                        $checkAd = '';
                        $checkEmi = '';
                        $sCuentaD = '';
                        if(session('idBusinessModel') == 2){
                          $desAd = 'disabled="disabled"';
                          $checkAd = '';
                          $checkEmi = 'checked';
                          $sCuentaD = '<option value="CONC_ADQUI" selected>Cuenta Adquirente</option>';
                        }
                        if(session('idBusinessModel') == 1){
                          $desEmi = 'disabled="disabled"';
                          $checkAd = 'checked';
                          $checkEmi = '';
                          $sCuentaD = '<option value="CONC_EMI" selected>Cuenta Emisor</option>';
                        }
                        if(session('idBusinessModel') == 3){
                          $desEmi = '';
                          $desEmi = '';
                          $checkAd = 'checked';
                          $checkEmi = '';
                          $sCuentaD = '<option value="CONC_ADQUI" selected>Cuenta Adquirente</option>';
                        }
                        
                      ?>
                        <div class="col-md-12">
                          <label for="fin"></label>
                          <div class="option-group field">
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input <?php echo $desEmi.' '.$checkEmi?> class="tipoModelo" type="radio" name="modelo" value="2">
                                <span class="radio"></span> Adquirente
                              </label>
                            </div> 
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input <?php echo $desAd.' '.$checkAd?> class="tipoModelo" type="radio" name="modelo" value="1">
                                <span class="radio"></span> Emision
                              </label>
                            </div>
                            <div class="col-md-4">
                              <label class="option block option-primary">
                                <input class="tipoModelo" type="radio" name="modelo" value="3">
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
                                <input checked class="tipoDis" type="radio" name="dispersion" value="en">
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
                                <label for="cuentaDes">Elige la cuenta destino</label>
                                <select class="form-control" id="cuentaDes" name="cuentaDes">
                                  <option></option>
                                  <?php echo $sCuentaD;?>
                                </select>
                                <small id="cuentaDesHelp" class="error form-text text-muted"></small>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group divCuentaFuera">
                                <label for="clabeInt">Clabe Interbancaria </label>
                                <input type="text" maxlength="18" class="form-control soloNum" id="clabeInt" name="clabeInt" aria-describedby="cpHelp">
                                <small id="clabeIntHelp" class="error form-text text-muted"></small>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group divCuentaOtra">
                                <label for="otraCuenta">Cuenta</label>
                                <input type="text" maxlength="5" class="form-control soloNum" id="cuentaKash" name="cuentaKash" aria-describedby="cpHelp">
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
                                <input checked type="radio" class="tipoF" name="facturacion" value="publicoGen">
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
                                <label for="perFac">Elige el periodo</label>
                                <select class="form-control" id="perFac" name="perFac">
                                  <option></option>
                                  <option value="MES">Mes</option>
                                  <option value="QUINCENA">Quincena</option>
                                  <option value="SEMANA">Semana</option>
                                  <option value="DIA">Día</option>
                                </select>
                                <small id="perFacHelp" class="error form-text text-muted"></small>
                              </div>
                              <div class="col-md-12 ">
                                <label for="fin">Selecciona los días de las transacciones a facturar:</label>
                                <div class="option-group field">
                                  <div class="col-md-4">
                                    <label class="option block option-primary">
                                        <input type="checkbox" name="diasPerFac[]" value="Lun">
                                        <span class="checkbox"></span> Lunes
                                    </label>
                                    <label class="option block option-primary mt10">
                                        <input type="checkbox" name="diasPerFac[]" value="Mar">
                                        <span class="checkbox"></span> Martes
                                    </label>
                                    <label class="option block option-primary mt10">
                                        <input type="checkbox" name="diasPerFac[]" value="Mie">
                                        <span class="checkbox"></span> Miercoles
                                    </label>
                                    <label class="option block option-primary mt10">
                                        <input type="checkbox" name="diasPerFac[]" value="Jue">
                                        <span class="checkbox"></span> Jueves
                                    </label>
                                  </div>
                                  <div class="col-md-4">
                                    <label class="option block option-primary mt10">
                                      <input type="checkbox" name="diasPerFac[]" value="Vie">
                                      <span class="checkbox"></span> Viernes
                                    </label>
                                    <label class="option block option-primary mt10">
                                        <input type="checkbox" name="diasPerFac[]" value="Sab">
                                        <span class="checkbox"></span> Sabado
                                    </label>
                                    <label class="option block option-primary mt10">
                                        <input type="checkbox" name="diasPerFac[]" value="Dom">
                                        <span class="checkbox"></span> Domingo
                                    </label>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="option-group field" style="margin-top:30px ">
                                  <div class="col-md-12">
                                    <label class="option block option-primary">
                                      <input type="checkbox" class="facTransa" name="facTrans" value="0">
                                      <span class="checkbox"></span> Facturar transacciones mayores a
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div id="divMonFac" class="col-md-4 form-group" style="margin-top:10px;">
                                <label for="montoFac">Captura el monto</label>
                                <input type="text" id="monto" name="monto" class="monto form-control" />
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
                      <i class="fa fa-file-text pr5"></i> Dispositivo
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modeloDis" name="modeloDis" aria-describedby="modeloHelp">
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
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addCaja.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addCaja.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-addCaja.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addCaja.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>
$(function(){
    $('.emailUsarNo').show();
    $('.alias').on('change', function() {
        var valTipo = $('input[name=cAlias]:checked', '#form-wizard').val();
        if(valTipo == '1') {
            $('.emailUsarNo').hide();
            bootbox.alert({
                message: "Se creará un alias para el registro y el correo de activación llegará a la Entidad o Sub Afiliado que corresponda.",
                locale: 'mx'
            });
        }else{
            $('.emailUsarNo').show();
        }
    });
});
</script>
</body>

</html>

<?=$this->endsection()?>