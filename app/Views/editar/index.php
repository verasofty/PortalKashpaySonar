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
                  <a href="dashboard">Editar Comisiones</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Editar Comisiones</li>
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
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <form id="form_updateComision" name="form_updateComision" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Comisiones</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;">Débito</h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h6>Tarjeta Presente</h6>
                    </div>
                  </div>
                  <?php 

                  //echo WS_SALDOS.'/Entities/fees/get/'.$_GET['validate'];
                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                    CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.$_GET['validate'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                      'Authorization: Basic YWRtaW46c2VjcmV0',
                      'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
                    ),
                  ));

                  $response = json_decode( curl_exec($curl));
                  curl_close($curl);

                  //print_r($response);
                  $visaTPD = '<input type="text" name="tasaVisaTP" id="tasaVisaTP" class="monto form-control event-name br-light light" value="0">';
                  $visaED = '<input type="text" name="tasaVisaE" id="tasaVisaE" class="monto form-control event-name br-light light" value="0">';
                  $visaTPC = '<input type="text" name="tasaVisaTPC" id="tasaVisaTPC" class="monto form-control event-name br-light light" value="0">';
                  $visaEC = '<input type="text" name="tasaVisaEC" id="tasaVisaEC" class="monto form-control event-name br-light light" value="0">';   
                  $idVisaTPD ='<input type="hidden" name="idVisaTP" id="idVisaTP" value="0">';
                  $idVisaED ='<input type="hidden" name="idVisaE" id="idVisaE" value="0">';
                  $idVisaTPC ='<input type="hidden" name="idVisaTPC" id="idVisaTPC" value="0">';
                  $idVisaEC ='<input type="hidden" name="idVisaEC" id="idVisaEC" value="0">';

                  $masterTPD = '<input type="text" name="tasaMCTP" id="tasaMCTP" class="monto form-control event-name br-light light" value="0">';
                  $masterED = '<input type="text" name="tasaMCE" id="tasaMCE" class="monto form-control event-name br-light light" value="0">';
                  $masterTPC = '<input type="text" name="tasaMCTPC" id="tasaMCTPC" class="monto form-control event-name br-light light" value="0">';
                  $masterEC = '<input type="text" name="tasaMCEC" id="tasaMCEC" class="monto form-control event-name br-light light" value="0">';
                  $idMasterTPD = '<input type="hidden" name="idMCTP" id="idMCTP" value="0">';
                  $idMasterED = '<input type="hidden" name="idMCE" id="idMCE" value="0">';
                  $idMasterTPC = '<input type="hidden" name="idMCTPC" id="idMCTPC" value="0">';
                  $idMasterEC = '<input type="hidden" name="idMCEC" id="idMCEC" value="0">';

                  $amexTPD = '<input type="text" name="tasaAMEXTP" id="tasaAMEXTP" class="monto form-control event-name br-light light" value="0">';
                  $amexED = '<input type="text" name="tasaAMEXE" id="tasaAMEXE" class="monto form-control event-name br-light light" value="0">';
                  $amexTPC = '<input type="text" name="tasaAMEXTPC" id="tasaAMEXTPC" class="monto form-control event-name br-light light" value="0">';
                  $amexEC = '<input type="text" name="tasaAMEXEC" id="tasaAMEXEC" class="monto form-control event-name br-light light" value="0">';
                  $idAmexTPD = '<input type="hidden" name="idAMEXTP" id="idAMEXTP" value="0">';
                  $idAmexED = '<input type="hidden" name="idAMEXE" id="idAMEXTP" value="0">';
                  $idAmexTPC = '<input type="hidden" name="idAMEXTPC" id="idAMEXTP" value="0">';
                  $idAmexEC = '<input type="hidden" name="idAMEXEC" id="idAMEXTP" value="0">';

                  $valesTPD = '<input type="text" name="tasaValesTP" id="tasaValesTP" class="monto form-control event-name br-light light" value="0">';
                  $valesED = '<input type="text" name="tasaValesE" id="tasaValesE" class="monto form-control event-name br-light light" value="0">';
                  $valesTPC = '<input type="text" name="tasaValesTPC" id="tasaValesTPC" class="monto form-control event-name br-light light" value="0">';
                  $valesEC = '<input type="text" name="tasaValesEC" id="tasaValesEC" class="monto form-control event-name br-light light" value="0">';
                  $idValesTPD = '<input type="hidden" name="idValesTP" id="idValesTP" value="0">';
                  $idValesED = '<input type="hidden" name="idValesE" id="idValesE" value="0">';
                  $idValesTPC = '<input type="hidden" name="idValesTPC" id="idValesTPC" value="0">';
                  $idValesEC = '<input type="hidden" name="idValesEC" id="idValesEC" value="0">';

                  $interTPD = '<input type="text" name="tasaInterTP" id="tasaInterTP" class="monto form-control event-name br-light light" value="0">';
                  $interED = '<input type="text" name="tasaInterE" id="tasaInterE" class="monto form-control event-name br-light light" value="0">';
                  $interTPC = '<input type="text" name="tasaInterTPC" id="tasaInterTPC" class="monto form-control event-name br-light light" value="0">';
                  $interEC = '<input type="text" name="tasaInterEC" id="tasaInterEC" class="monto form-control event-name br-light light" value="0">';
                  $idInterTPD = '<input type="hidden" name="idIntTP" id="idIntTP" value="0">';
                  $idInterED = '<input type="hidden" name="idIntE" id="idIntE" value="0">';
                  $idInterTPC = '<input type="hidden" name="idIntTPC" id="idIntTPC" value="0">';
                  $idInterEC = '<input type="hidden" name="idIntEC" id="idIntEC" value="0">';
                  if (isset($response)) { 
                    for ($i=0; $i < count($response) ; $i++) { 
                      //visa
                      if ($response[$i]->operationType == 22) {
                        //tarjeta presente
                        if ($response[$i]->cardCondition == 'CardPresent') {
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $visaTPD = '<input type="text" name="tasaVisaTP" id="tasaVisaTP" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idVisaTPD ='<input type="hidden" name="idVisaTP" id="idVisaTP" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $visaTPC = '<input type="text" name="tasaVisaTPC" id="tasaVisaTPC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idVisaTPC ='<input type="hidden" name="idVisaTPC" id="idVisaTPC" value="'.$response[$i]->id.'">';
                          }
                        //ecommerce
                        }else{
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $visaED = '<input type="text" name="tasaVisaE" id="tasaVisaE" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idVisaED ='<input type="hidden" name="idVisaE" id="idVisaE" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $visaEC = '<input type="text" name="tasaVisaEC" id="tasaVisaEC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idVisaEC ='<input type="hidden" name="idVisaEC" id="idVisaEC" value="'.$response[$i]->id.'">';
                          }
                        }
                      }
                      //mc
                      if ($response[$i]->operationType == 27) {
                        //tarjeta presente
                        if ($response[$i]->cardCondition == 'CardPresent') {
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $masterTPD = '<input type="text" name="tasaMCTP" id="tasaMCTP" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idMasterTPD ='<input type="hidden" name="idMCTP" id="idMCTP" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $masterTPC = '<input type="text" name="tasaMCTPC" id="tasaMCTPC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idMasterTPC ='<input type="hidden" name="idMCTPC" id="idMCTPC" value="'.$response[$i]->id.'">';
                          }
                        //ecommerce
                        }else{
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $masterED = '<input type="text" name="tasaMCE" id="tasaMCE" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idMasterED ='<input type="hidden" name="idMCE" id="idMCE" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $masterEC = '<input type="text" name="tasaMCEC" id="tasaMCEC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idMasterEC ='<input type="hidden" name="idMCEC" id="idMCEC" value="'.$response[$i]->id.'">';
                          }
                        }
                      }
                      //amex
                      if ($response[$i]->operationType == 23) {
                        //tarjeta presente
                        if ($response[$i]->cardCondition == 'CardPresent') {
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $amexTPD = '<input type="text" name="tasaAMEXTP" id="tasaAMEXTP" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idAmexTPD = '<input type="hidden" name="idAMEXTP" id="idAMEXTP" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $amexTPC = '<input type="text" name="tasaAMEXTPC" id="tasaAMEXTPC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idAmexTPC = '<input type="hidden" name="idAMEXTPC" id="idAMEXTPC" value="'.$response[$i]->id.'">';
                          }
                        //ecommerce
                        }else{
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $amexED = '<input type="text" name="tasaAMEXE" id="tasaAMEXE" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idAmexED = '<input type="hidden" name="idAMEXE" id="idAMEXE" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $amexEC = '<input type="text" name="tasaAMEXEC" id="tasaAMEXEC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idAmexEC = '<input type="hidden" name="idAMEXEC" id="idAMEXEC" value="'.$response[$i]->id.'">';
                          }
                        }                   
                      }
                      //vales
                      if ($response[$i]->operationType == 56) {
                        if ($response[$i]->cardCondition == 'CardPresent') {
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $valesTPD = '<input type="text" name="tasaValesTP" id="tasaValesTP" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idValesTPD = '<input type="hidden" name="idValesTP" id="idValesTP" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $valesTPC = '<input type="text" name="tasaValesTPC" id="tasaValesTPC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idValesTPC = '<input type="hidden" name="idValesTPC" id="idValesTPC" value="'.$response[$i]->id.'">';
                          }
                        //ecommerce
                        }else{
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $valesED = '<input type="text" name="tasaValesE" id="tasaValesE" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idValesED = '<input type="hidden" name="idValesE" id="idValesE" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $valesEC = '<input type="text" name="tasaValesEC" id="tasaValesEC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idValesEC = '<input type="hidden" name="idValesEC" id="idValesEC" value="'.$response[$i]->id.'">';
                          }
                        } 
                      }
                      //inter
                      if ($response[$i]->operationType == 57) {
                        if ($response[$i]->cardCondition == 'CardPresent') {
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $interTPD = '<input type="text" name="tasaInterTP" id="tasaInterTP" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idInterTPD = '<input type="hidden" name="idIntTP" id="idIntTP" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $interTPC = '<input type="text" name="tasaInterTPC" id="tasaInterTPC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idInterTPC = '<input type="hidden" name="idIntTPC" id="idIntTPC" value="'.$response[$i]->id.'">';
                          }
                        //ecommerce
                        }else{
                          //debito
                          if ($response[$i]->accountabilityNature == 'Debit') {
                            $interED = '<input type="text" name="tasaInterE" id="tasaInterE" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idInterED = '<input type="hidden" name="idIntE" id="idIntE" value="'.$response[$i]->id.'">';
                          //credito
                          }else{
                            $interEC = '<input type="text" name="tasaInterEC" id="tasaInterEC" class="monto form-control event-name br-light light" value="'.($response[$i]->percentage / 100).'">';
                            $idInterEC = '<input type="hidden" name="idIntEC" id="idIntEC" value="'.$response[$i]->id.'">';
                          }
                        } 
                      }
                    }
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaVisaTP">Comisión Visa*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $visaTPD.$idVisaTPD ?>
                          <input type="hidden" name="contextSon" id="contextSon" value="<?php echo $_GET['validate']?>">
                          <input type="hidden" name="level" id="level" value="<?php echo $_GET['level']?>">
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaVisaTPHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaMCTP">Comisión Mastercard*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $masterTPD.$idMasterTPD ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaMCTPHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaAMEXTP">Comisión AMEX*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $amexTPD.$idAmexTPD ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaAMEXTPHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaValesTP">Comisión Vales*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $valesTPD.$idValesTPD ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaValesTPHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaInterTP">Comisión Internacional*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $interTPD.$idInterTPD ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaInterTPHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h6>Ecommerce</h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaVisaE">Comisión Visa*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $visaED.$idVisaED ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaVisaEHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaMCE">Comisión Mastercard*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $masterED.$idMasterED ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaMCEHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaAMEXE">Comisión AMEX*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $amexED.$idAmexED ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaAMEXEHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaValesE">Comisión Vales*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $valesED.$idValesED ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaValesEHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaInterE">Comisión Internacional*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $interED.$idInterED ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaInterEHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="sameCom">¿Desea usar los mismo valores en comisiones de crédito?</label>
                      <div class="option-group field">
                        <div class="col-md-12">
                          <label class="option block option-primary">
                            <input class="copiarInfo" type="checkbox" id="sameCom" name="sameCom" value="">
                            <span class="checkbox"></span> Si
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div style="height: 30px;"></div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;">Crédito</h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h6>Tarjeta Presente</h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaVisaTPC">Comisión Visa*</label>
                        <label for="name21" class="field prepend-icon">
                           <?php echo $visaTPC.$idVisaTPC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaVisaTPCHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaMCTPC">Comisión Mastercard*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $masterTPC.$idMasterTPC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaMCTPCHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaAMEXTPC">Comisión AMEX*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $amexTPC.$idAmexTPC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaAMEXTPCHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaValesTPC">Comisión Vales*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $valesTPC.$idValesTPC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaValesTPCHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaInterTPC">Comisión Internacional*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $interTPC.$idInterTPC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaInterTPCHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h6>Ecommerce</h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaVisaEC">Comisión Visa*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $visaEC.$idVisaEC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaVisaECHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaMCEC">Comisión Mastercard*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $masterEC.$idMasterEC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaMCECHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaAMEXEC">Comisión AMEX*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $amexEC.$idAmexEC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaAMEXECHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaValesEC">Comisión Vales*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $valesEC.$idValesEC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaValesECHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section mb10">
                        <label for="tasaInterEC">Comisión Internacional*</label>
                        <label for="name21" class="field prepend-icon">
                          <?php echo $interEC.$idInterEC ?>
                          <label for="name21" class="field-icon"> 
                            <span style="color: #c7924b;font-weight: bold">%</span> 
                          </label>
                        </label>
                        <small id="tasaInterECHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <!--div style="height: 30px;"></div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;">Liquidación</h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="fin">¿Esta cuenta recibira las liquidaciones?</label>
                      <div class="option-group field">
                        <div class="col-md-12">
                          <label class="option block option-primary">
                            <?php
                            if ($_GET['level'] == 3) {
                              $liquidacion = '0';
                            }else if ($_GET['level'] == 4) {
                              $liquidacion = '1';
                            }else if ($_GET['level'] == '5') {
                              $liquidacion = 2;
                            }else if ($_GET['level'] == '6') {
                              $liquidacion = '3';
                            }
                            ?>
                            <input type="checkbox" name="liquidacion" value="<?php echo $liquidacion?>">
                            <span class="checkbox"></span> Si
                          </label>
                        </div>
                      </div>
                    </div>
                  </div-->
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/editar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>