<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paginador.css">
<?php
$today = date("Y-m-d"); 
$today_hora = date("Y-m-d H:i:s"); 
$mesLim = date("Y-m-d H:i:s",strtotime($today."- 1 month"));  
$montoBus= str_replace(',','',$_GET['monto']);  
if ($_GET['rango'] != '') {
  $porciones_ini = explode(" / ", $_GET['rango']);
  $fechaIni = $porciones_ini[0];
  $fechaFin = $porciones_ini[1];
}else {
  $fechaIni = '';
  $fechaFin = ''; 
}   
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
  var mesLim = '<?php echo $mesLim?>';

  var rolId = '<?php echo session('idRol')?>';

  var urlTi = '<?php echo URL_TICKET?>';
  var urlRep = '<?php echo WS_KASPAYSERVICES?>';

  var mood = '<?php echo $_GET['mood']?>';
  var type = '<?php echo $_GET['type']?>';

</script>
<header id="topbar" class="alt">
      <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="#">Transacciones</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Listar Transacciones</li>
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
      <div class="chute chute-center allcp-form">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="col-md-12">
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn ">
                <form id="form_filtro" name="form_filtro" method="post">
                  <div class="row">
                    <div class="col-md-12">
                    <div id="message"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subafiliado">SubAfiliado</label>
                        <select <?php echo $retValSA = (session('idRol')!=2) ? 'disabled' : '' ; ?> class="form-control" id="subafiliado" name="subafiliado">
                          <option></option>
                          <?php
                          for ($iSub=0; $iSub < count($subafiliado->contextResponse); $iSub++) { 
                            if ($subafiliado->contextResponse[$iSub]->idContext == $_GET['subafiliado']) {
                              echo '<option selected value="'.$subafiliado->contextResponse[$iSub]->idContext.'">'.$subafiliado->contextResponse[$iSub]->contextDescription.'</option>';
                            }else{
                              echo '<option value="'.$subafiliado->contextResponse[$iSub]->idContext.'">'.$subafiliado->contextResponse[$iSub]->contextDescription.'</option>';
                            }
                            
                          }
                          ?>
                          <script type="text/javascript">
                            subAfSelect = '<?php echo $_GET['subafiliado'] ?>';
                            entidadSelect = '<?php echo $_GET['entidad']?>';
                            sucursalSelect = '<?php echo $_GET['sucursal']?>';
                            cajaSelect = '<?php echo $_GET['caja']?>';
                          </script>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="entidad">Entidad</label>
                        <select <?php echo $retValE = ( (session('idRol') == 2) || (session('idRol') == 3) ) ? '' : 'disabled' ; ?> class="form-control" id="entidad" name="entidad">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select <?php echo $retValS =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) ) ? '' : 'disabled' ; ?> class="form-control" id="sucursal" name="sucursal">
                          <option></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="caja">Caja</label>
                        <select <?php echo $retValC =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) || (session('idRol') == 5) ) ? '' : 'disabled' ; ?> class="form-control" id="caja" name="caja">
                          <option></option>
                        </select>
                        <?php 
                        if ( ($retValSA != '') ) {
                        ?>
                        <input type="hidden" value="<?php echo session('idContext')?>" name="subafiliado">
                        <?php 
                        }
                        ?>
                        <?php 
                        if ( ($retValE != '') ) {
                        ?>
                        <input type="hidden" value="<?php echo session('idEntity')?>" name="entidad">
                        <?php 
                        }
                        ?>
                        <?php 
                        if ( ($retValS != '') ) {
                        ?>
                        <input type="hidden" value="<?php echo session('idTerminal')?>" name="sucursal">
                        <?php 
                        }
                        ?>
                        <?php 
                        if ( ($retValC != '') ) {
                        ?>
                        <input type="hidden" value="<?php echo session('idTerminalUser')?>" name="caja">
                        <?php 
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="operacion">Operación</label>
                        <select class="form-control" id="operacion" name="operacion">
                          <option></option>
                          <?php 
                          for ($iType=0; $iType < count($typeTran->catTransactionTypes) ; $iType++) { 
                            if ($typeTran->catTransactionTypes[$iType]->idTransactionType == $_GET['typeOperation']) {
                              echo '<option selected value="'.$typeTran->catTransactionTypes[$iType]->idTransactionType.'">'.$typeTran->catTransactionTypes[$iType]->tTypeInternalkey.'</option>'; 
                            }else{
                              echo '<option value="'.$typeTran->catTransactionTypes[$iType]->idTransactionType.'">'.$typeTran->catTransactionTypes[$iType]->tTypeInternalkey.'</option>'; 
                            } 
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="edoTransaccion">Estado de la Transacción</label>
                        <select class="form-control" id="edoTransaccion" name="edoTransaccion">
                          <option></option>
                          <?php 
                          for ($iEdo=0; $iEdo < count($response->catResponseCodes) ; $iEdo++) { 
                            if ($response->catResponseCodes[$iEdo]->responseCode == $_GET['estatus']) {
                              echo '<option selected value="'.$response->catResponseCodes[$iEdo]->responseCode.'">'.$response->catResponseCodes[$iEdo]->respCodeDescription.'</option>';  
                            }else{
                              echo '<option value="'.$response->catResponseCodes[$iEdo]->responseCode.'">'.$response->catResponseCodes[$iEdo]->respCodeDescription.'</option>';  
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="monto">Monto</label>
                        <input value="<?php echo $_GET['monto'] ?>" type="text" class="form-control" id="monto" name="monto">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="referencia">Núm. Referencia</label>
                        <input value="<?php echo $_GET['referencia'] ?>" type="text" class="form-control" id="referencia" name="referencia">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="autorizacion">Núm. Autorización</label>
                        <input value="<?php echo $_GET['autorizacion'] ?>" type="text" class="form-control" id="autorizacion" name="autorizacion">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="numTarjeta">Núm. Tarjeta</label>
                        <input value="<?php echo $_GET['numTarjeta'] ?>" type="text" maxlength="16" class="form-control soloNum" id="numTarjeta" name="numTarjeta">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="bin">Bin</label>
                        <input value="<?php echo $_GET['bin'] ?>" type="text" class="form-control" id="bin" name="bin">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section">
                        <label for="fechaInicio">Fecha Inicio</label>
                        <input value="<?php echo $fechaIni?>" type="text" class="form-control" id="datetimepicker1" name="datetimepicker1">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section">
                        <label for="fechaInicio">Fecha Fin</label>
                        <input value="<?php echo $fechaFin?>" type="text" class="form-control" id="datetimepicker2" name="datetimepicker2">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fin">&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block buscar">Buscar</button>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fin">&nbsp;</label>
                        <button type="button" class="btn btn-danger btn-block limpiar">Limpiar filtros</button>
                      </div>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                </form>
              </div>
            </div>
            <div class="panel panel-visible" id="spy2">
              <?php
              $pageURL = $_GET['page']-1;

              $curlt = curl_init();

              if ($_GET['subafiliado'] == '') {
                $_GET['subafiliado'] = 0;
              }
              if ($_GET['entidad'] == '') {
                $_GET['entidad'] = 0;
              }
              if ($_GET['sucursal'] == '') {
                $_GET['sucursal'] = 0;
              }
              if ($_GET['caja'] == '') {
                $_GET['caja'] = 0;
              }

              if ($_GET['rango'] != '') {
                $porciones_ini = explode(" / ", $_GET['rango']);

                $porciones_i = explode(" ", $porciones_ini[0]);
                $porciones_f = explode(" ", $porciones_ini[1]);

                $location = curl_escape($curlt, $porciones_i[0].' '.$porciones_i[1]);
                $location2 = curl_escape($curlt, $porciones_f[0].' '.$porciones_f[1]);
                $_GET['type'] = '';
                $_GET['mood'] = '';
              }else {
                $location = '';
                $location2 = ''; 
              }
              
              $curlt = curl_init();
              curl_setopt_array($curlt, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_GET['subafiliado'].'&idEntity='.$_GET['entidad'].'&idTerminal='.$_GET['sucursal'].'&idTerminalUser='.$_GET['caja'].'&typeOperation='.$_GET['typeOperation'].'&amount='.$montoBus.'&responseCode='.$_GET['estatus'].'&referenceNumber='.$_GET['referencia'].'&authorizationNumber='.$_GET['autorizacion'].'&bin='.$_GET['bin'].'&card='.$_GET['numTarjeta'].'&startDate='.$location.'&endDate='.$location2.'&liquidationID=&page='.$pageURL.'&status='.$_GET['type'].'&searchBy='.$_GET['mood'],
      		      CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0',
                  'Cookie: JSESSIONID=9109f025d54b106b0025d7166c71'
                ),
              ));
              $responset = curl_exec($curlt);
              curl_close($curlt);
              
              

              $datos= array('response'=>json_decode($responset));
              
              //echo  WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_GET['subafiliado'].'&idEntity='.$_GET['entidad'].'&idTerminal='.$_GET['sucursal'].'&idTerminalUser='.$_GET['caja'].'&typeOperation='.$_GET['typeOperation'].'&&amount='.$montoBus.'&responseCode='.$_GET['estatus'].'&referenceNumber='.$_GET['referencia'].'&authorizationNumber='.$_GET['autorizacion'].'&bin='.$_GET['bin'].'&card='.$_GET['numTarjeta'].'&startDate='.$location.'&endDate='.$location2.'&liquidationID=&page='.$pageURL.'&status='.$_GET['type'].'&searchBy='.$_GET['mood'];
              
              //var_dump($datos);
              
              if ($datos['response']->numberOfElements != 0) {
                $num_total_rows = $datos['response']->totalElements;
                //$num_total_rows = 0;
              }else{
                $num_total_rows = 0;
              }

              //$num_total_rows = $datos['response']->totalItems;
              //$num_total_rows = 4;

              if ($num_total_rows > 0) {
                $page = false;

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                }

                if (!$page) {
                    $start = 0;
                    $page = 1;
                } else {
                    $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
                }
                $total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);
              ?>
              <div class="panel-body pn">
                <div class="row" style="margin-bottom: 10px;">
                  <div class="col-md-4">
                    <a href="#" class="botonExcel btn ladda-button btn-default">
                      <span class="imoon imoon-file-excel"></span> Exportar a Excel
                    </a>
                  </div>
                  <div class="col-md-4">
                    <a href="#" class="botonPDF btn ladda-button btn-default">
                      <span class="imoon imoon-file-pdf"></span> Exportar a PDF
                    </a>
                  </div>
                  <div class="col-md-4">
                    
                  </div>
                </div>
                <div class="table-responsive" style=" overflow: auto;">
                  <div id="caja21" class="text-center"></div>
                  <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="va-m">Monto</th>
                        <th class="va-m">Núm. de Autorización</th>
                        <th class="va-m">Tarjeta</th>
                        <th class="va-m">Referencia</th>
                        <th class="va-m">Fecha de Autorizacion</th>
                        <th class="va-m">Estatus</th>
                        <th class="va-m">Institución</th>
                        <th class="va-m">Marca</th>
                        <th class="va-m">Naturaleza</th>
                        <th class="va-m">Entidad</th>
                        <th class="va-m">Terminal</th>
                        <th class="va-m">Tipo de Transacción</th>
                        <th class="va-m">EntryMode</th>
                        <th class="va-m">Monto Adicional</th>
                        <th class="va-m">ResponseDescription</th>
                        <th class="va-m">QtPay</th>
                        <th class="va-m">PlanId</th>
                        <th class="va-m">GraceNumber</th>
                        <th class="va-m">Concepto</th>
                        <th class="va-m">Bin</th>
                        <th class="va-m">Send_Sirio</th>
                        <th class="va-m">IVA</th>
                        <th class="va-m">Comisión1</th>
                        <th class="va-m">Comisión2</th>
                        <th class="va-m">Comisión3</th>
                        <th class="va-m">Entity OperationId</th>
                        <th class="va-m">Transaction Builder</th>
                        <th class="va-m">Id Liquidacion</th>
                        <th class="va-m">Estatus Sirio</th>
                        <th class="va-m">Ticket</th>
                        <th class="va-m">Aclaraciones</th>
                      </tr>
                    </thead>
                    <tbody id="rowsTrasnsacciones">
                      <?php
                      for ($iT=0; $iT < count($datos['response']->content); $iT++) { 
                        $btn_imp = '';
                        $btn_imp2 = '';
                        $btn_aclara = '';
                        $com1 = 0;
                        $com2 = 0;
                        $com3 = 0;
                        $iva = 0;
                        $transactionType = 0.00;
                        $transactionSubType = 0.00;
                        $transactionID = 0.00;
                        $timestamp = 0.00;
                        $systemTraceAudit = 0.00;
                        $settleAmount = 0.00;

                        if (isset($datos['response']->content[$iT]->operationSirio->acquiringOperation)) {
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->systemSource != null) {
                                $iva = $datos['response']->content[$iT]->operationSirio->acquiringOperation->systemSource;
                            }
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionType != null) {
                                $transactionType = $datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionType;
                            }
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionSubType != null) {
                                $transactionSubType = $datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionSubType;
                            } 
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionID != null) {
                                $transactionID = $datos['response']->content[$iT]->operationSirio->acquiringOperation->transactionID;
                            }
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->timestamp != null) {
                                $timestamp = $datos['response']->content[$iT]->operationSirio->acquiringOperation->timestamp;
                            }
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->systemTraceAuditNumber != null) {
                                $systemTraceAudit = $datos['response']->content[$iT]->operationSirio->acquiringOperation->systemTraceAuditNumber;
                            }
                            if ($datos['response']->content[$iT]->operationSirio->acquiringOperation->settleAmount != null) {
                                $settleAmount = $datos['response']->content[$iT]->operationSirio->acquiringOperation->settleAmount;
                            }
                        }
                        
                        
                        $urlTi = URL_TICKET.$datos['response']->content[$iT]->authorizationRrcext.$datos['response']->content[$iT]->authorizationNumber.'.pdf';
                        
                        if ($datos['response']->content[$iT]->status == 'APROBADA') {
                          if ($datos['response']->content[$iT]->paymentLink == 'ND') {
                            /*$btn_imp .='<div class="btn-group">'.
                                      '<a target="_blank" title="Ver Ticket" href="'.$urlTi.'" class="btn btn-primary ver_tiket_modal">'.
                                          '<i class="fas fa-print"></i>'.
                                      '</a>';
                                      
                                     $btn_imp .='</div>';  */
                            /*$btn_imp .='<div class="btn-group">'.
                                      '<a title="Ver Ticket" href="#" class="btn btn-primary ver_tiket_modal" data-toggle="modal" data-target="#myModal-'.$datos['response']->content[$iT]->authorizationRrcext.'" data-url="'.$urlTi.'">'.
                                          '<i class="fas fa-print"></i>'.
                                      '</a>';
                                      
                                     $btn_imp .='</div>';    */
                            $btn_imp .='<div class="btn-group">'.
                                          '<a title="Ver Ticket" href="#" class="btn btn-primary cambiarMonto" data-authorizationnumber="'.$datos['response']->content[$iT]->authorizationNumber.'" data-entityname="'.$datos['response']->content[$iT]->entityName.'" data-card="'.$datos['response']->content[$iT]->card.'" data-authorizationdate="'.$datos['response']->content[$iT]->authorizationDate.'" data-authorizationdrcext="'.$datos['response']->content[$iT]->authorizationRrcext.'" data-amount="'.number_format($datos['response']->content[$iT]->amount,2).'">'.
                                              '<i class="fas fa-print"></i>'.
                                          '</a>'.
                                        '</div>';
							
                          }else{
                            $btn_imp .='<div class="btn-group">'.
                                      '<a title="Ver Ticket" target="_blank" href="'.$datos['response']->content[$iT]->paymentLink.'" class="btn btn-primary">'.
                                          '<i class="fas fa-print"></i>'.
                                      '</a>';
                                      
                                     $btn_imp .='</div>';    
                          }
                          
                        }else{
                            $btn_imp .='<div class="btn-group">'.
                                       '</div>';    
                        }

                        if ($datos['response']->content[$iT]->status == 'DEVUELTA') {
                          $btn_imp .='<div class="btn-group">'.
                                      '<a title="Ver Ticket" data-authorizationnumber="'.$datos['response']->content[$iT]->authorizationNumber.'" data-entityname="'.$datos['response']->content[$iT]->entityName.'" data-card="'.$datos['response']->content[$iT]->card.'" data-authorizationdate="'.$datos['response']->content[$iT]->authorizationDate.'" data-authorizationdrcext="'.$datos['response']->content[$iT]->authorizationRrcext.'" data-amount="'.number_format($datos['response']->content[$iT]->amount,2).'" href="#" class="btn btn-primary ver_tiket_modal_dev">'.
                                          '<i class="fas fa-print"></i>'.
                                      '</a>';
                                      
                                     $btn_imp .='</div>';    
                        }else{
                            $btn_imp .='<div class="btn-group">'.
                                       '</div>';    
                        }
                        
                        if ($datos['response']->content[$iT]->status == 'APROBADA' && $datos['response']->content[$iT]->transactiontype == 'VENTA') {
                          if(session('idRol') == 2 || session('idRol') == 3){
                            $btn_aclara .='<div class="btn-group">'.
                              '<a title="Aclaraciones" href="aclaracion?validate='.$datos['response']->content[$iT]->idOperation.'" class="btn btn-primary" >'.
                                '<i class="fas fa-comment-dollar"></i>'.
                            '</a>';
                            $btn_aclara .='</div>'; 
                  			  }else if(session('idRol') == 6 && session('idContext') == 83 ){
                  				  //echo 'caja';
                  			      $btn_aclara .='<div class="btn-group">'.
                                                '<a title="Aclaraciones" href="aclaracion?validate='.$datos['response']->content[$iT]->idOperation.'" class="btn btn-primary" >'.
                                                  '<i class="fas fa-comment-dollar"></i>'.
                                              '</a>';
                                              $btn_aclara .='</div>'; 
                  			  }else if(session('entitySonID') == 'SUB981645'){
                            $btn_aclara .='<div class="btn-group">'.
                                                '<a title="Aclaraciones" href="aclaracion?validate='.$datos['response']->content[$iT]->idOperation.'" class="btn btn-primary" >'.
                                                  '<i class="fas fa-comment-dollar"></i>'.
                                              '</a>';
                                              $btn_aclara .='</div>';
                          }

                            
                        }else{
                            $btn_aclara .='<div class="btn-group">'.
                                       '</div>';    
                        }
                        ?>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal-<?php echo $datos['response']->content[$iT]->authorizationRrcext?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Ticket</h4> 
                              </div>
                              <div class="modal-body">
                                <div style="text-align: center;">
                                <?php
                                 /* $urlexists = archivoExternoExiste( $urlTi );

                                  //echo ('urlexists = '.$urlexists);
                                  
                                  if ($urlexists) {
                                  ?>
                                  <embed type="application/pdf" src="https://drive.google.com/viewerng/viewer?url=<?php echo $urlTi ?>&embedded=true" frameborder="0" width="100%" height="400px"></embed>
                                  <?php
                                  } else {
                                    echo '<h6>Ticket inexistente, reporte al administrador.</h6>';
                                  }*/
                                  ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary imprimir" data-dismiss="modal">Ok</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php

                        switch(session('idRol')) {
                            //admin
                            case '2':
                                $com1 = 0;
                                $com2 = 0;
                                $com3 = 0;
                                break;
                            //suba
                            case '3':
                                $com1 = ($transactionType + $transactionSubType);
                                $com2 = $transactionID;
                                $com3 = ($timestamp + $systemTraceAudit);
                                break;
                            //enti
                            case '4':
                                $com1 = ($transactionType + $transactionSubType + $transactionID);
                                $com2 = $timestamp;
                                $com3 = $systemTraceAudit;
                                break;
                            //sucu
                            case '5':
                                $com1 = ($transactionType + $transactionSubType + $transactionID + $timestamp);
                                $com2 = $systemTraceAudit;
                                $com3 = 0;
                                break;
                            //caja
                            case '6':
                                $com1 = $settleAmount;
                                $com2 = 0;
                                $com3 = 0;
                                break;
                        }

                        echo    '<tr><td>'.number_format( $datos['response']->content[$iT]->amount,2).'</td>'.
                                '<td>'.$datos['response']->content[$iT]->authorizationNumber.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->card.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->authorizationRrcext.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->authorizationDate.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->status.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->institution.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->brand.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->nature.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->entityName.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->terminalName.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->transactiontype.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->entryMode.'</td>'.
                                '<td>'.number_format( $datos['response']->content[$iT]->feeAmount,2).'</td>'.
                                '<td>'.$datos['response']->content[$iT]->responseDescription.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->qtPay.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->planId.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->graceNumber.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->concept.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->bin.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->sendSirio.'</td>'.
                                '<td>'.$iva.'</td>'.
                                '<td>'.$com1.'</td>'.
                                '<td>'.$com2.'</td>'.
                                '<td>'.$com3.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->entityOperationId.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->transactionBuilder.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->statusSirio.'</td>'.
                                '<td>'.$datos['response']->content[$iT]->statusSirio.'</td>'.
                                '<td>'.$btn_imp.'</td>'.
                                '<td>'.$btn_aclara.'</td>'.
                                '</tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
              <?php 
                echo '<nav aria-label="Page navigation example">';
                echo '<ul class="pagination justify-content-center">';

                if ($total_pages > 1) {
                  $hrefT = 'transacciones?rango='.$_GET['rango'].'&estatus='.$_GET['type'].'&subafiliado='.$_GET['subafiliado'].'&entidad='.$_GET['entidad'].'&sucursal='.$_GET['sucursal'].'&caja='.$_GET['caja'].'&monto='.$_GET['monto'].'&typeOperation='.$_GET['type'].'&referencia='.$_GET['referencia'].'&autorizacion='.$_GET['autorizacion'].'&bin='.$_GET['bin'].'&numTarjeta='.$_GET['numTarjeta'].'&type='.$_GET['type'].'&mood='.$_GET['mood'];
                  if ($page != 1) {

                    
                    echo '<li class="page-item"><a class="page-link" href="'.$hrefT.'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="'.$hrefT.'&page='.$i.'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="'.$hrefT.'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
                  }
                }
                echo '</ul>';
                echo '</nav>';
              }else{
                echo '<h4>No se encontraron datos.</h4>';
              }
              ?>

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
<div id="divName"></div>
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
<?php 

function archivoExternoExiste($url) {
  //echo 'Entrando a fincion '.$url.'<br>';
  $headers = @get_headers($url);
  return $headers && strpos($headers[0], '200') !== false;
}

?>

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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/transacciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>


<script type="text/javascript">
  $("#example1").DataTable({
      "responsive": false, 
      "lengthChange": false, 
      "autoWidth": false,
      "searching": false,
      "order": [],
      "processing": true,
      "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Lo sentimos, no se encontraron resultados con los datos solicitados.",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No se encontraron resultados",
        "infoFiltered": "(filtered from _MAX_ total records)"
      }/*,
      "buttons": [
            {
                extend: 'excelHtml5',
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            ["print", "colvis"]
        ]*/
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  $(".botonExcel").click(function(event) {
    document.location = base_url+'/public/assets/exportar/exportarTransacciones.php?urlRep='+urlRep+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&operacion'+$('#operacion').val()+'=&edoTransaccion='+$('#edoTransaccion').val()+'&monto='+$('#monto').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&numTarjeta='+$('#numTarjeta').val()+'&bin='+$('#bin').val()+'&fechaIni='+$('#datetimepicker1').val()+'&fechaFin='+$('#datetimepicker2').val()+'&rolId=<?php echo session('idRol')?>&type='+type+'&mood='+mood+'&size=<?php echo $num_total_rows?>';
  });

  $(".botonPDF").click(function(event) {
    document.location = base_url+'/public/assets/php/exportar_pdf.php?urlRep='+urlRep+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&operacion'+$('#operacion').val()+'=&edoTransaccion='+$('#edoTransaccion').val()+'&monto='+$('#monto').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&numTarjeta='+$('#numTarjeta').val()+'&bin='+$('#bin').val()+'&fechaIni='+$('#datetimepicker1').val()+'&fechaFin='+$('#datetimepicker2').val()+'&rolId=<?php echo session('idRol')?>&type='+type+'&mood='+mood+'&size=<?php echo $num_total_rows?>';
  });
$(".ver_tiket_modal1").click(function(event) {
    var url_ticket =  $(this).data("url"); 
    var msg = '<div>'+
               '<iframe src="http://docs.google.com/gview?url='+url_ticket+'&embedded=true" style="width:500px; height:500px;" frameborder="0"></iframe>'+
             '</div>';
        
        bootbox.dialog({
        title: "Ticket",
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-primary',
                callback: function(){
                  var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                 document_html.document.write( "<html>"+msg+"</html>" );
                 document_html.document.write( printContents );
                 document_html.document.write( "</body></html>" );
                 //setTimeout(function () {
                       document_html.print();
                  // }, 3000);
                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            },
            cancel: {
                label: 'Ok',
                className: 'btn-success',
                callback: function(){
                     bootbox.hideAll();
                     //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            }
        }
    });
  });
  $(".ver_tiket_modal_dev").click(function(event) {
    $('#divName').html('');
    var msg = "<div>"+
                "<div style='font-family:Courier;'>"+
                 " <font face='Courier'>"+ 
                      "<center>"+
                          "<br>"+
                          "<table  border='0'>"+
                              "<tr>"+ 
                                  "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                              "</tr>"+          
                              "<tr > "+
                               "<td colspan='2' align='center' >"+
                                  "<font style='font-size:9px;'>"+$(this).data("entityname")+"  &nbsp;</font>  "+
                               "</td>   "+
                              "</tr>"+
                              " <tr style='font-size:9px;'>"+
                                  "<td>FECHA:</td><td align='right'>"+$(this).data("authorizationdate")+"</td> "+
                              "</tr>"+
                              "<tr>"+
                                  '<td>&nbsp;</td>'+
                              "</tr>"+
                              "<tr>"+
                                  "<td>&nbsp;</td>"+
                              "</tr>"+
                          "</table> "+
                          "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                              "<tr style='font-size:11px;'>"+
                                  "<td colspan='3' align='center' style='font-weight:bold'><center>DEVOLUCION</center></td> "+ 
                              "</tr> "+
                              "<tr style='font-size:9px;'>"+ 
                                  "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+$(this).data("card")+"</td>"+  
                              "</tr> "+
                             "<tr style='font-size:9px;'> "+
                                  "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                  "<td align='right'>$"+$(this).data("amount")+"</td> "+   
                              "</tr>  "+ 
                              "<tr style='font-size:9px;'>  "+                      
                                  "<td colspan=3 style='font-weight:bold'>APROBACION No :"+$(this).data("authorizationdrcext")+"</b></td>"+   
                              "</tr>"+           
                              "<tr >"+
                                  "<td colspan=3> "+
                                      "<table border=0 style='font-size:9px;' width=248>  "+     
                                          "<tr> "+      
                                              "<td>LOTE:</td><td>000000</td>"+
                                              "<td>&nbsp;</td>"+     
                                              "<td>&nbsp;</td>  "+      
                                              "<td align='right' colspan=4>FOLIO: :"+$(this).data('authorizationnumber')+"</td> "+      
                                         " </tr> "+      
                                          "<tr>"+        
                                              "<td>AID:</td>"+          
                                              "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                          "</tr>"+       
                                          "<tr>"+        
                                              "<td>ARQC:</td>"+
                                              "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                          "</tr>"+  
                                          "<tr>"+        
                                              "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                          "</tr>"+             
                                      "</table>"+   
                                  "</td>"+       
                              "</tr>"+  
                              "<tr style='font-size:9px;'> "+
                                  "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                  "<td align='right'>&nbsp;</td>  "+  
                              "</tr>"+     
                          "</table> "+
                          "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                              "<tr>"+ 
                                  "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                     " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                      "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                      "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                      "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                      "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                      "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                      "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                              "</tr>"+
                                 "<tr>"+ 
                                  "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                  "</td>"+
                              "</tr>"+
                              
                          '</table>'+ 
                      '</center>'+  
                  '</font>'+
              '</div>'+
             '</div>';
    $('#divName').html(msg);
    bootbox.dialog({
        title: "Ticket",
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-primary',
                callback: function(){
                  $('#divName').html('');
                  var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                  document_html.document.write( "<html>"+msg+"</html>" );
                  document_html.document.write( printContents );
                  document_html.document.write( "</body></html>" );
                  //setTimeout(function () {
                       document_html.print();
                  printDiv('divName');
                  
                }
            },
            cancel: {
                label: 'Ok',
                className: 'btn-success',
                callback: function(){
                     bootbox.hideAll();
                     //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            }
        }
    });
  });  
  var entityname, authorizationdate, card, amount, authorizationdrcext, authorizationnumber;

  $(".cambiarMonto").click(function(event) {
    entityname = $(this).data("entityname");
    authorizationdate = $(this).data("authorizationdate");
    card = $(this).data("card");
    amount = $(this).data("amount");
    authorizationdrcext = $(this).data("authorizationdrcext");
    authorizationnumber = $(this).data("authorizationnumber");
    
    /*bootbox.dialog({
        message: "Desea modificar el monto del ticket?",
        buttons: {
           buttonName: {
              label: "Si",
              className: "btn-primary",
              callback: function () {
                console.log('hi cambiarMonto');
                //event.preventDefault(); 
                exportar(event,amount);
              }
                  
            },
            cancel: {
                label: 'No',
                className: 'btn-dark',
                callback: function () {    */              
                  $('#divName').html('');
                  var msg = "<div>"+
                              "<div style='font-family:Courier;'>"+
                              " <font face='Courier'>"+ 
                                    "<center>"+
                                        "<br>"+
                                        "<table  border='0'>"+
                                            "<tr>"+ 
                                                "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                                            "</tr>"+          
                                            "<tr > "+
                                            "<td colspan='2' align='center' >"+
                                                "<font style='font-size:9px;'>"+entityname+"  &nbsp;</font>  "+
                                            "</td>   "+
                                            "</tr>"+
                                            " <tr style='font-size:9px;'>"+
                                                "<td>FECHA:</td><td align='right'>"+authorizationdate+"</td> "+
                                            "</tr>"+
                                            "<tr>"+
                                                '<td>&nbsp;</td>'+
                                            "</tr>"+
                                            "<tr>"+
                                                "<td>&nbsp;</td>"+
                                            "</tr>"+
                                        "</table> "+
                                        "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                                            "<tr style='font-size:11px;'>"+
                                                "<td colspan='3' align='center' style='font-weight:bold'><center>VENTA</center></td> "+ 
                                            "</tr> "+
                                            "<tr style='font-size:9px;'>"+ 
                                                "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+card+"</td>"+  
                                            "</tr> "+
                                          "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                                "<td align='right'>$"+amount+"</td> "+   
                                            "</tr>  "+ 
                                            "<tr style='font-size:9px;'>  "+                      
                                                "<td colspan=3 style='font-weight:bold'>APROBACION No :"+authorizationdrcext+"</b></td>"+   
                                            "</tr>"+           
                                            "<tr >"+
                                                "<td colspan=3> "+
                                                    "<table border=0 style='font-size:9px;' width=248>  "+     
                                                        "<tr> "+      
                                                            "<td>LOTE:</td><td>000000</td>"+
                                                            "<td>&nbsp;</td>"+     
                                                            "<td>&nbsp;</td>  "+      
                                                            "<td align='right' colspan=4>FOLIO: :"+authorizationnumber+"</td> "+      
                                                      " </tr> "+      
                                                        "<tr>"+        
                                                            "<td>AID:</td>"+          
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                                        "</tr>"+       
                                                        "<tr>"+        
                                                            "<td>ARQC:</td>"+
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+  
                                                        "<tr>"+        
                                                            "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+             
                                                    "</table>"+   
                                                "</td>"+       
                                            "</tr>"+  
                                            "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                                "<td align='right'>&nbsp;</td>  "+  
                                            "</tr>"+     
                                        "</table> "+
                                        "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                                            "<tr>"+ 
                                                "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                                  " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                                    "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                                    "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                                    "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                                    "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                                    "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                                    "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                                            "</tr>"+
                                              "<tr>"+ 
                                                "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                                "</td>"+
                                            "</tr>"+
                                            
                                        '</table>'+ 
                                    '</center>'+  
                                '</font>'+
                            '</div>'+
                          '</div>';
                  $('#divName').html(msg);
                  bootbox.dialog({
                      title: "Ticket",
                      message: msg,
                      onEscape: true,
                      backdrop: true,
                      buttons: {
                          confirm: {
                              label: 'Imprimir',
                              className: 'btn-primary',
                              callback: function(){
                                $('#divName').html('');
                                var printContents = document.getElementById("divName").innerHTML;
                                var document_html = window.open("");
                                document_html.document.write( "<html>"+msg+"</html>" );
                                document_html.document.write( printContents );
                                document_html.document.write( "</body></html>" );
                                //setTimeout(function () {
                                    document_html.print();
                                printDiv('divName');
                                
                              }
                          },
                          cancel: {
                              label: 'Ok',
                              className: 'btn-success',
                              callback: function(){
                                  bootbox.hideAll();
                                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                              }
                          }
                      }
                  });
                /*}
            }
        }
      });*/
  });

function exportar(event,amount){
  console.log('hi exportar');
  $('#message').html('');
  var numError = 0;
  var frm_str = '<form id="some-form">'
                      +'<div id="message"></div>'
                      + '<div class="row" >'
                        + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'
                              + '<label for="date">Monto Actual</label>'    
                              + '<input value="'+amount+'" id="montoOld"class="form-control" disabled type="email">'
                              +'<h2 id="result1"></h2>'
                            + '</div>'
                            +' <div class="col-md-12 section">'
                              + '<label for="date">Nuevo Monto</label>'
                              +'<input id="montoNew" class="form-control monto" type="text">'
                              +'<h2 id="result2"></h2>'
                            + '</div>'
                          + '</div>'
                        + '</div>'
                  + '</form>';

  
   bootbox.dialog({
        message: frm_str,
        title: "Actualizar monto",
        buttons: {
           buttonName: {
              label: "Guardar",
              className: "btn-primary",
              callback: function () {
                event.preventDefault();    
                //new_string = original_string.replace('a', '')  
                console.log('exportar callback ');              
                var montoNew = parseFloat($('#montoNew').val().replace(",", "" ));              
                var montoOld = parseFloat($('#montoOld').val().replace(",", "" ));
                console.log('montoNew = '+montoNew);              
                console.log('montoOld = '+montoOld);              
                var porcentaje = (montoOld*0.30);
                console.log('porcentaje = '+porcentaje); 
                console.log (montoNew +'>='+ porcentaje +'&&'+ montoNew +'<'+ montoOld);            

                if (montoNew >= porcentaje && montoNew < montoOld) {
                  $('#divName').html('');
                  var msg = "<div>"+
                              "<div style='font-family:Courier;'>"+
                              " <font face='Courier'>"+ 
                                    "<center>"+
                                        "<br>"+
                                        "<table  border='0'>"+
                                            "<tr>"+ 
                                                "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                                            "</tr>"+          
                                            "<tr > "+
                                            "<td colspan='2' align='center' >"+
                                                "<font style='font-size:9px;'>"+entityname+"  &nbsp;</font>  "+
                                            "</td>   "+
                                            "</tr>"+
                                            " <tr style='font-size:9px;'>"+
                                                "<td>FECHA:</td><td align='right'>"+authorizationdate+"</td> "+
                                            "</tr>"+
                                            "<tr>"+
                                                '<td>&nbsp;</td>'+
                                            "</tr>"+
                                            "<tr>"+
                                                "<td>&nbsp;</td>"+
                                            "</tr>"+
                                        "</table> "+
                                        "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                                            "<tr style='font-size:11px;'>"+
                                                "<td colspan='3' align='center' style='font-weight:bold'><center>VENTA</center></td> "+ 
                                            "</tr> "+
                                            "<tr style='font-size:9px;'>"+ 
                                                "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+card+"</td>"+  
                                            "</tr> "+
                                          "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                                "<td align='right'>$"+montoNew+"</td> "+   
                                            "</tr>  "+ 
                                            "<tr style='font-size:9px;'>  "+                      
                                                "<td colspan=3 style='font-weight:bold'>APROBACION No :"+authorizationdrcext+"</b></td>"+   
                                            "</tr>"+           
                                            "<tr >"+
                                                "<td colspan=3> "+
                                                    "<table border=0 style='font-size:9px;' width=248>  "+     
                                                        "<tr> "+      
                                                            "<td>LOTE:</td><td>000000</td>"+
                                                            "<td>&nbsp;</td>"+     
                                                            "<td>&nbsp;</td>  "+      
                                                            "<td align='right' colspan=4>FOLIO: :"+authorizationnumber+"</td> "+      
                                                      " </tr> "+      
                                                        "<tr>"+        
                                                            "<td>AID:</td>"+          
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                                        "</tr>"+       
                                                        "<tr>"+        
                                                            "<td>ARQC:</td>"+
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+  
                                                        "<tr>"+        
                                                            "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+             
                                                    "</table>"+   
                                                "</td>"+       
                                            "</tr>"+  
                                            "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                                "<td align='right'>&nbsp;</td>  "+  
                                            "</tr>"+     
                                        "</table> "+
                                        "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                                            "<tr>"+ 
                                                "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                                  " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                                    "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                                    "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                                    "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                                    "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                                    "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                                    "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                                            "</tr>"+
                                              "<tr>"+ 
                                                "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                                "</td>"+
                                            "</tr>"+
                                            
                                        '</table>'+ 
                                    '</center>'+  
                                '</font>'+
                            '</div>'+
                          '</div>';
                  $('#divName').html(msg);
                  bootbox.dialog({
                      title: "Ticket",
                      message: msg,
                      onEscape: true,
                      backdrop: true,
                      buttons: {
                          confirm: {
                              label: 'Imprimir',
                              className: 'btn-primary',
                              callback: function(){
                                $('#divName').html('');
                                var printContents = document.getElementById("divName").innerHTML;
                                var document_html = window.open("");
                                document_html.document.write( "<html>"+msg+"</html>" );
                                document_html.document.write( printContents );
                                document_html.document.write( "</body></html>" );
                                //setTimeout(function () {
                                    document_html.print();
                                printDiv('divName');
                                
                              }
                          },
                          cancel: {
                              label: 'Ok',
                              className: 'btn-success',
                              callback: function(){
                                  bootbox.hideAll();
                                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                              }
                          }
                      }
                  });
                } else {
                  bootbox.alert({
					          message: '<div style="text-align:center;">El monto capturado debe ser mayor o igual al 30% del monto original y menor al monto original del ticket</div>'
                  });
                  
                }
              }
                  
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-dark'
            }
        }
      });
}
function expolrtar(event){
}
</script>
</body>

</html>

<?=$this->endsection()?>
