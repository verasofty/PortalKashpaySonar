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
                  <a href="dashboard">Mi cuenta</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Mi cuenta</li>
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
              // print_r($cuenta->subAffiliationInfo);
              $isRLegal = 'na';
              $isComercial = 'na';
              $isSoporte = 'na';
              $isFinanzas = 'na';
              $rLegaltype = '';
              $comercialtype = '';
              $soportetype = '';
              $finanzastype = '';
              $rLegalcp = '';
              //var_dump($cuenta->subAffiliationInfo);
              if ($cuenta->subAffiliationInfo->contact != null) {
                
                  //if ($cuenta->subAffiliationInfo->contact->type == 1) {
                    $isRLegal = 'existe';
                    //$rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->postalCode;
                  //}
              }
              //print_r($cuenta->subAffiliationInfo);
            ?>
              <script type="text/javascript">
                var cpSelected = '<?php echo $cuenta->subAffiliationInfo->address->postalCode?>';
                var idLocalidadSelected = '<?php echo $cuenta->subAffiliationInfo->address->idLocation?>';
              </script>
              <form method="post" action="/" id="form-wizard-subafiliado">
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
                          <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="nombreHelp" value="<?php echo $cuenta->subAffiliationInfo->name?>">
                          <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->subAffiliationInfo->guid?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->subAffiliationInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->subAffiliationInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->subAffiliationInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->subAffiliationInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->subAffiliationInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->subAffiliationInfo->guid?>">
                          <small id="nombreHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="entidad">RFC*</label>
                          <input type="text" name="rfc" id="rfc" class="form-control rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->subAffiliationInfo->rfc?> ">
                          <small id="rfcHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="sucursal">Teléfono*</label>
                          <input type="tel" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valTel = ($cuenta->subAffiliationInfo->phoneNumber != '0') ? $cuenta->subAffiliationInfo->phoneNumber : '' ; ?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                    </div>
                    <!--<div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $cuenta->subAffiliationInfo->email?>">
                          <small id="emailHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="namecommerce">Confirmar Correo electrónico*</label>
                          <input type="email" class="form-control" id="emailConfirm" name="emailConfirm" aria-describedby="emailConfirmHelp">
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
                    </div> -->
                    <div class="row">
                      
                      <!--<div class="col-md-4">
                        <div class="form-group">
                          <label for="confPass">Confirmar Contraseña*</label>
                          <input type="password" class="form-control" id="confPass" name="confPass" aria-describedby="confPassHelp">
                          <small id="confPassHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                          <h3>Dirección</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="calle">Calle*</label>
                            <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->subAffiliationInfo->address->street?>">
                            <small id="calleHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numExt">Número Exterior*</label>
                            <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->subAffiliationInfo->address->exteriorNumber?>">
                            <small id="numExtHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="numInt">Número Interior</label>
                            <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->subAffiliationInfo->address->interiorNumber != 'ND') ? $cuenta->subAffiliationInfo->address->interiorNumber : '' ; ?>">
                            <small id="numIntHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="cp">Código Postal*</label>
                            <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->subAffiliationInfo->address->postalCode?>">
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
                      <i class="fa fa-file-text pr5"></i> Contactos</h4>
                  <section class="wizard-section">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Contacto</h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="nameContactC">Nombre</label>
                          <?php
                            if ($isRLegal == 'existe') {
                                echo '<input type="text" class="form-control soloText" id="nombreCont" name="nombreCont" aria-describedby="nombreContCHelp" value="'.$cuenta->subAffiliationInfo->contact->name.'">
                                 <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->subAffiliationInfo->contact->id.'">';
                            }else{
                                echo '<input type="text" class="form-control soloText" id="nombreCont" name="nombreCont" aria-describedby="nombreContCHelp">
                                <input type="hidden" id="idContCom" name="idContCom" value="0">';
                            }
                          ?>
                          <small id="nombreContHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="apaternoContactC">Apellido Paterno</label>
                          <?php
                            if ($isRLegal == 'existe') {
                                echo '<input type="text" class="form-control soloText" id="aPaternoCont" name="aPaternoCont" aria-describedby="aPaternoContHelp" value="'.$cuenta->subAffiliationInfo->contact->paternalSurname.'">';
                            }else{
                                echo '<input type="text" class="form-control soloText" id="aPaternoCont" name="aPaternoCont" aria-describedby="aPaternoContHelp">';
                            }
                          ?>
                          
                          <small id="aPaternoContHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="amaternoContactC">Apellido Materno</label>
                          <?php
                            if ($isRLegal == 'existe') {
                                echo '<input type="text" class="form-control soloText" id="aMaternoCont" name="aMaternoCont" aria-describedby="aMaternoContHelp" value="'.$cuenta->subAffiliationInfo->contact->maternalSurname.'">';
                            }else{
                                echo '<input type="text" class="form-control soloText" id="aMaternoCont" name="aMaternoCont" aria-describedby="aMaternoContHelp">';
                            }
                          ?>
                          
                          <small id="aMaternoContHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="emailCont">Correo Electronico</label>
                          <?php
                            if ($isRLegal == 'existe') {
                                echo '<input type="email" class="form-control" id="emailCont" name="emailCont" aria-describedby="emailContHelp" value="'.$cuenta->subAffiliationInfo->contact->email.'">';
                            }else{
                                echo '<input type="email" class="form-control" id="emailCont" name="emailCont" aria-describedby="emailContHelp" >';
                            }
                          ?>
                          
                          <small id="emailContHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telCont">Teléfono</label>
                          <?php
                            if ($isRLegal == 'existe') {
                                echo '<input type="tel" maxlength="10" class="form-control soloNum" id="telCont" name="telCont" aria-describedby="telContHelp" value="'.$cuenta->subAffiliationInfo->contact->phoneNumber.'">';
                            }else{
                                echo '<input type="tel" maxlength="10" class="form-control soloNum" id="telCont" name="telCont" aria-describedby="telContHelp">';
                            }
                          ?>
                          
                          <small id="telContHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="telAdContactC">Teléfono Adicional</label>
                          <?php

                            if ($isRLegal == 'existe') {
                              $retVal = ($cuenta->subAffiliationInfo->contact->additionaPhoneNumber != 'ND') ? $cuenta->subAffiliationInfo->contact->additionaPhoneNumber : '' ;
                                echo '<input type="tel" maxlength="10" class="form-control soloNum" id="telAdiCont" name="telAdiCont" aria-describedby="telAdiContHelp" value="'.$retVal.'">';
                            }else{
                                echo '<input type="tel" maxlength="10" class="form-control soloNum" id="telAdiCont" name="telAdiCont" aria-describedby="telAdiContHelp" >';
                            }
                          ?>
                          
                          <small id="telAdiContHelp" class="error form-text text-muted"></small>
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
                        <code>** Los documentos legales no se pueden editar en esta sección, solo mostrarlos **</code>
                      </div>
                      <div style="height: 30px;"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->subAffiliationInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->subAffiliationInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->subAffiliationInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->subAffiliationInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->subAffiliationInfo->constitutiveActFile == '' || $cuenta->subAffiliationInfo->constitutiveActFile == 'ND' ) {
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }else{
                          ?>
                          <a href="<?php echo $cuenta->subAffiliationInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }
                          ?>
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
              //var_dump($cuenta->entityInfo->contacts);
              if ($cuenta->entityInfo->contacts != null) {
                for ($iCont=0; $iCont < count($cuenta->entityInfo->contacts) ; $iCont++) { 
                  if ($cuenta->entityInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    //$rLegalcp = $cuenta->entityInfo->contacts[$iCont]->address->postalCode;
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
            ?>
              <form  method="post" action="/" id="form-wizard-entidad">
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
                          <label for="namecommerce">Nombre del Comercio*</label>
                          <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp" value="<?php echo $valnameCommerce = ($cuenta->entityInfo->nameCommerce != 'ND') ? $cuenta->entityInfo->nameCommerce : 'ss' ; ?>">
                          <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->entityInfo->idCommerceDetail?>">
                          <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->entityInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->entityInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->entityInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->entityInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->entityInfo->guid?>">
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
                    </div>
                    <div class="row">
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
                          <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $cuenta->entityInfo->phoneNumber?>">
                          <small id="telHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <!--div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Correo electrónico*</label>
                          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $cuenta->entityInfo->email?>">
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
                    <!--div class="row">
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
                          <label for="calle">Calle</label>
                          <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->entityInfo->address->street?>">
                          <small id="calleHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExt">Número Exterior</label>
                          <input type="text" maxlength="6" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->entityInfo->address->exteriorNumber?>">
                          <small id="numExtHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numInt">Número Interior</label>
                          <input type="text" maxlength="6" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $valNumInt = ($cuenta->entityInfo->address->interiorNumber != 'NA') ? $cuenta->entityInfo->address->interiorNumber : '' ; ?>">
                          <small id="numIntHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cp">Código Postal</label>
                          <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $valcp = ($cuenta->entityInfo->address->postalCode != '0') ? $cuenta->entityInfo->address->postalCode : '' ; ?>">
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
                          <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->entityInfo->rfc?>">
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
                        <code>** Los documentos legales no se pueden editar en esta sección, solo mostrarlos **</code>
                      </div>
                      <div style="height: 30px;"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->entityInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->entityInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->entityInfo->constitutiveActFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->entityInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
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
                            <input type="hidden" id="idContactFin" name="idContactFin" value="<?php echo $cuenta->entityInfo->contacts[$finanzastype]->id?>">';
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
              if ($cuenta->branchOfficeInfo->contacts != null) {
                for ($iCont=0; $iCont < count($cuenta->branchOfficeInfo->contacts) ; $iCont++) { 
                  if ($cuenta->branchOfficeInfo->contacts[$iCont]->type == 1) {
                    $isRLegal = 'existe';
                    $rLegaltype = $iCont;
                    $rLegalcp = $cuenta->branchOfficeInfo->contacts[$iCont]->address->postalCode;
                  }else if ($cuenta->branchOfficeInfo->contacts[$iCont]->type == 2) {
                    $isComercial = 'existe';
                    $comercialtype = $iCont;
                  }else if ($cuenta->branchOfficeInfo->contacts[$iCont]->type == 3) {
                    $isSoporte = 'existe';
                    $soportetype = $iCont;
                  }else if ($cuenta->branchOfficeInfo->contacts[$iCont]->type == 4) {
                    $isFinanzas = 'existe';
                    $finanzastype = $iCont;
                  }
                }
              }
              //echo 'rLegalcp = '.$rLegalcp;
            ?>
            <form method="post" id="form-wizard-sucursal">
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
                            if($subafiliados->contextResponse[$iSub]->idContext == $cuenta->branchOfficeInfo->idContext){
                              echo '<option selected value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }else{
                              echo '<option value="'.$subafiliados->contextResponse[$iSub]->idContext.'">'.$subafiliados->contextResponse[$iSub]->contextDescription.'</option>';
                            }
                            
                          }
                          ?>
                          <script type="text/javascript">
                            var idLocalidadSelected = '<?php echo $cuenta->branchOfficeInfo->address->idLocation?>';
                            var cpSelected = '<?php echo $cuenta->branchOfficeInfo->address->postalCode?>';idLocalidadSelected
                            var entiSelect = '<?php echo session('idEntity')?>';
                            <?php
                              if ($cuenta->branchOfficeInfo->contacts != null) {
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
                        <label for="sucursal">Nombre de Sucursal*</label>
                        <input type="text" class="form-control" id="sucursal" name="sucursal" aria-describedby="sucursalHelp" value="<?php echo $cuenta->branchOfficeInfo->nameCommerce?>">
                        <input type="hidden" id="idCommerceDetail" name="idCommerceDetail" value="<?php echo $cuenta->branchOfficeInfo->idCommerceDetail?>">
                        <input type="hidden" id="idContext" name="idContext" value="<?php echo $cuenta->branchOfficeInfo->idContext?>">
                         <input type="hidden" id="idEntity" name="idEntity" value="<?php echo $cuenta->branchOfficeInfo->idEntity?>">
                         <input type="hidden" id="idTerminal" name="idTerminal" value="<?php echo $cuenta->branchOfficeInfo->idTerminal?>">
                         <input type="hidden" id="idTerminalUser" name="idTerminalUser" value="<?php echo $cuenta->branchOfficeInfo->idTerminalUser?>">
                         <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->branchOfficeInfo->guid?>">
                        <small id="sucursalHelp" class="error form-text text-muted"></small>
                      </div>
                    </div> 
                  </div>
                  <!--div class="row">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email">Correo electrónico*</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $cuenta->branchOfficeInfo->email?>">
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
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tel">Teléfono*</label>
                        <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $cuenta->branchOfficeInfo->phoneNumber?>">
                        <small id="telHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
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
                          <label for="calle">Calle*</label>
                          <input type="text" class="form-control" id="calle" name="calle" aria-describedby="calleHelp" value="<?php echo $cuenta->branchOfficeInfo->address->street?>">
                          <small id="calleHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numExt">Número Exterior*</label>
                          <input type="text" class="form-control" id="numExt" name="numExt" aria-describedby="numExtHelp" value="<?php echo $cuenta->branchOfficeInfo->address->exteriorNumber?>">
                          <small id="numExtHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="numInt">Número Interior</label>
                          <input type="text" class="form-control" id="numInt" name="numInt" aria-describedby="numIntHelp" value="<?php echo $cuenta->branchOfficeInfo->address->interiorNumber?>">
                          <small id="numIntHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="cp">Código Postal*</label>
                          <input type="text" maxlength="5" class="form-control soloNum" id="cp" name="cp" aria-describedby="cpHelp" value="<?php echo $cuenta->branchOfficeInfo->address->postalCode?>">
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
                          <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $cuenta->branchOfficeInfo->rfc?>">
                          <small id="rfc
                          Help" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="razonSFiscal">Razón Social</label>
                          <input type="text" class="form-control" id="razonSFiscal" name="razonSFiscal" aria-describedby="razonSFiscalHelp" value="<?php echo $cuenta->branchOfficeInfo->businessName?>">
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
                              if ($cuenta->branchOfficeInfo->fiscalRegime == $regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime) {
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
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->name.'" >
                            <input type="hidden" id="idContLeg" name="idContLeg" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreRep" name="nombreRep" aria-describedby="nombreRepHelp">
                            <input type="hidden" id="idContLeg" name="idContLeg" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoRep" name="aPaternoRep" aria-describedby="aPaternoRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoRep" name="aMaternoRep" aria-describedby="aMaternoRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->maternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="calleRep" name="calleRep" aria-describedby="calleRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->address->street.'" >';
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
                            echo '<input type="text" class="form-control" id="numExtRep" name="numExtRep" aria-describedby="numExtRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->address->exteriorNumber.'" >';
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
                            echo '<input type="text" class="form-control" id="numIntRep" name="numIntRep" aria-describedby="numIntRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->address->interiorNumber.'" >';
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
                            echo '<input type="text" class="form-control" id="cpRep" name="cpRep" aria-describedby="cpRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->address->postalCode.'" >';
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
                            echo '<input type="email" class="form-control" id="emailRep" name="emailRep" aria-describedby="emailRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telRep" name="telRep" aria-describedby="telRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->phoneNumber.'" >';
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
                            echo '<input type="tel" class="form-control" id="telAdiRep" name="telAdiRep" aria-describedby="telAdiRepHelp" value="'.$cuenta->branchOfficeInfo->contacts[$rLegaltype]->additionaPhoneNumber.'" >';
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
                        <code>** Los documentos legales no se pueden editar en esta sección, solo mostrarlos **</code>
                      </div>
                      <div style="height: 30px;"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="ine">Identificación Oficial</label>
                          <?php
                          if ($cuenta->branchOfficeInfo->ineFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->branchOfficeInfo->ineFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                          <?php
                          if ($cuenta->branchOfficeInfo->proofOfAddressFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->branchOfficeInfo->proofOfAddressFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-center">
                          <label style="display: block;" for="acta">Acta Constitutiva</label>
                          <?php
                          if ($cuenta->branchOfficeInfo->constitutiveActFile != '') {
                          ?>
                          <a href="<?php echo $cuenta->branchOfficeInfo->constitutiveActFile?>">
                            <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                          </a>
                          <?php
                          }else{
                          ?>
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
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
                            echo '<input type="text" class="form-control" id="nombreCom" name="nombreCom" aria-describedby="nombreComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->name.'" >
                            <input type="hidden" id="idContCom" name="idContCom" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->id.'">';
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
                            echo '<input type="text" class="form-control" id="aPaternoCom" name="aPaternoCom" aria-describedby="aPaternoComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoCom" name="aMaternoCom" aria-describedby="aMaternoComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailCom" name="emailCom" aria-describedby="emailComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telCom" name="telCom" aria-describedby="telComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->phoneNumber.'" >';
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
                            echo '<input type="tel" class="form-control" id="telAdiCom" name="telAdiCom" aria-describedby="telAdiComHelp" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->additionaPhoneNumber.'" >';
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
                              echo '<input type="text" id="inicioCom" name="inicioCom" class="gui-input"  value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->startTime.'" >';
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
                            echo '<input type="text" id="finCom" name="finCom" class="gui-input" value="'.$cuenta->branchOfficeInfo->contacts[$comercialtype]->endTime.'" >';
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
                              $dias = explode("|", $cuenta->branchOfficeInfo->contacts[$comercialtype]->days);
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
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->name.'" >
                            <input type="hidden" id="idContSop" name="idContSop" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreSop" name="nombreSop" aria-describedby="nombreSopHelp" >
                            <input type="hidden" id="idContSop" name="idContSop" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoSop" name="aPaternoSop" aria-describedby="aPaternoSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoSop" name="aMaternoSop" aria-describedby="aMaternoSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailSop" name="emailSop" aria-describedby="emailSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telSop" name="telSop" aria-describedby="telSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->phoneNumber.'" >';
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
                            echo '<input type="tel" class="form-control" id="telAdiSop" name="telAdiSop" aria-describedby="telAdiSopHelp" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->additionaPhoneNumber.'" >';
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
                            echo '<input type="text" id="inicioSop" name="inicioSop" class="gui-input" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->startTime.'" >';
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
                            echo '<input type="text" id="finSop" name="finSop" class="gui-input" value="'.$cuenta->branchOfficeInfo->contacts[$soportetype]->endTime.'" >';
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
                            $dias2 = explode("|", $cuenta->branchOfficeInfo->contacts[$soportetype]->days);
                            
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
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->name.'" >
                            <input type="hidden" id="idContFin" name="idContFin" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->id.'">';
                          }else{
                            echo '<input type="text" class="form-control" id="nombreFin" name="nombreFin" aria-describedby="nombreFinHelp">
                            <input type="hidden" id="idContFin" name="idContFin" value="0">';
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
                            echo '<input type="text" class="form-control" id="aPaternoFin" name="aPaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->paternalSurname.'" >';
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
                            echo '<input type="text" class="form-control" id="aMaternoFin" name="aMaternoFin" aria-describedby="aPaternoFinHelp" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->maternalSurname.'" >';
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
                            echo '<input type="email" class="form-control" id="emailFin" name="emailFin" aria-describedby="emailFinHelp" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->email.'" >';
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
                            echo '<input type="tel" class="form-control" id="telFin" name="telFin" aria-describedby="telFinHelp" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->phoneNumber.'" >';
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
                            echo '<input type="tel" class="form-control" id="telAdiFin" name="telAdiFin" aria-describedby="telAdiFin" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->additionaPhoneNumber.'" >';
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
                            echo '<input type="text" id="inicioFin" name="inicioFin" class="gui-input" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->startTime.'" >';
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
                            echo '<input type="text" id="finFin" name="finFin" class="gui-input" value="'.$cuenta->branchOfficeInfo->contacts[$finanzastype]->endTime.'" >';
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
                            $dias3 = explode("|", $cuenta->branchOfficeInfo->contacts[$finanzastype]->days);                           
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

                <!-- -------------- step 4 -------------- 
                <h4 class="wizard-section-title">
                    <i class="fa fa-file-text pr5"></i> Pagos Mensuales</h4>
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
                </section> -->

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
                </section>-->
              </div>
            </form>
            <?php } ?>
            <?php if (session('idRol') == 6) { 
              // caja
              //var_dump($cuenta->collaboratorInfo);
            ?>
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <form id="form_addColaborador" name="form_addColaborador" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Datos Generales</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="subafiliado">SubAfiliado*</label>
                        <select class="form-control" name="subafiliado" id="subafiliado">
                          <?php
                          for ($iSub=0; $iSub < count($subafiliados->contextResponse); $iSub++) { 
                            if ($cuenta->collaboratorInfo->idContext == $subafiliados->contextResponse[$iSub]->idContext) {
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
                        <input type="text" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp" value="<?php echo $valrfc = ($cuenta->collaboratorInfo->rfc != 'ND') ? $cuenta->collaboratorInfo->rfc : '' ; ?>">
                        <small id="rfcHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nombre">Nombre*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" value="<?php echo $valname = ($cuenta->collaboratorInfo->name != 'ND') ? $cuenta->collaboratorInfo->name : '' ; ?>">
                        <input type="hidden" id="guid" name="guid" value="<?php echo $cuenta->collaboratorInfo->guid?>">
                        <small id="nombreHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="aPaterno">Apellido Paterno*</label>
                        <input type="text" class="form-control" id="aPaterno" name="aPaterno" aria-describedby="aPaternoHelp" value="<?php echo $valapa = ($cuenta->collaboratorInfo->paternalSurname != 'ND') ? $cuenta->collaboratorInfo->paternalSurname : '' ; ?>">
                        <small id="aPaternoHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="aMaterno">Apellido Materno*</label>
                        <input type="text" class="form-control" id="aMaterno" name="aMaterno" aria-describedby="aMaternoHelp" value="<?php echo $valama = ($cuenta->collaboratorInfo->maternalSurname != 'ND') ? $cuenta->collaboratorInfo->maternalSurname : '' ; ?>">
                        <small id="aMaternoHelp" class="error form-text text-muted"></small>
                      </div>
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
                        <input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel" aria-describedby="telHelp" value="<?php echo $valtel = ($cuenta->collaboratorInfo->phoneNumber != 'ND') ? $cuenta->collaboratorInfo->phoneNumber : '' ; ?>">
                        <small id="telHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  
                  <!--div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Correo Electronico*</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $valemail = ($cuenta->collaboratorInfo->email != 'ND') ? $cuenta->collaboratorInfo->email : '' ; ?>">
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
                  </div-->
                  <!--div class="row">
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
                  </div-->
                  
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Datos del Dispositivo</h3>
                    </div>
                  </div>
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
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Documentos Legales</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <code>** Los documentos legales no se pueden editar en esta sección, solo mostrarlos **</code>
                    </div>
                    <div style="height: 30px;"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group text-center">
                        <label style="display: block;" for="ine">Identificación Oficial</label>
                        <?php
                        if ($cuenta->collaboratorInfo->ineFile != '') {
                        ?>
                        <a href="<?php echo $cuenta->collaboratorInfo->ineFile?>">
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                        </a>
                        <?php
                        }else{
                        ?>
                        <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group text-center">
                        <label style="display: block;" for="cfe">Comprobante de Domicilio</label>
                        <?php
                        if ($cuenta->collaboratorInfo->proofOfAddressFile != '') {
                        ?>
                        <a href="<?php echo $cuenta->collaboratorInfo->proofOfAddressFile?>">
                          <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                        </a>
                        <?php
                        }else{
                        ?>
                        <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/no_pdf_icon.png'?>">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editColaborador.js"></script> 
<?php } ?>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>