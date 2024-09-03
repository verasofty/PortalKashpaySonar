<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d"); 
$today_hora = date("Y-m-d H:i:s"); 
$mesLim = date("Y-m-d",strtotime($today."- 2 month"));   
$porciones_type = explode(",", $_GET['type']);
$porciones_status = explode(",", $_GET['status']);
$porciones_ini = explode(" ", $_GET['dateInit']);
$porciones_fin = explode(" ", $_GET['dateFinish']);
$nameStatus = array();
$statusSelect = array();
$typeSelect = array();
$idStatus = array();
$nameStatusurl = '';
$myStatus;
$mytype;
for ($jStatus = 0; $jStatus<count($porciones_status); $jStatus++) {
  $myStatus = $porciones_status[$jStatus];
  array_push($statusSelect,$myStatus);
}
for ($jtype = 0; $jtype<count($porciones_type); $jtype++) {
  $mytype = $porciones_type[$jtype];
  array_push($typeSelect,$mytype);
}
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
  var mesLim = '<?php echo $mesLim?>';
 
  var fechaIniUrl = '<?php echo $porciones_ini[0].' '.$porciones_ini[1]?>';
  var fechaFinUrl = '<?php echo $porciones_fin[0].' '.$porciones_fin[1]?>';

  var urlRep = '<?php echo WS_SALDOS?>';
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
                  <a href="#">Operaciones</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Listar Operaciones</li>
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="subafiliado">SubAfiliado*</label>
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
                            <?php
                            if (session('idRol') == 2 || session('idRol') == 3) {
                            ?>
                            subAfSelect = '<?php echo $_GET['subafiliado'] ?>';
                            entidadSelect = '<?php echo $_GET['entidad']?>';
                            sucursalSelect = '<?php echo $_GET['sucursal']?>';
                            cajaSelect = '<?php echo $_GET['caja']?>';
                            <?php
                            } else {
                            ?>
                            subAfSelect = '<?php echo session('idContext') ?>';
                            entidadSelect = '<?php echo session('idEntity')?>';
                            sucursalSelect = '<?php echo session('idTerminal')?>';
                            cajaSelect = '<?php echo session('idTerminalUser')?>';
                            <?php
                            }
                            ?>
                          </script>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="entidad">Entidad*</label>
                        <select <?php echo $retValE = ( (session('idRol') == 2) || (session('idRol') == 3) ) ? '' : 'disabled' ; ?> class="form-control" id="entidad" name="entidad">
                          <option></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">			   
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select <?php echo $retValS =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) ) ? '' : 'disabled' ; ?> class="form-control" id="sucursal" name="sucursal">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="typeOperacion">Tipo de operación*</label>
                        <select multiple="multiple" class="form-control select2-multiple" id="typeOperacion" name="typeOperacion">
                          <option value=""></option>
                          <?php 
                          /*for ($iT=0; $iT < count($porciones_type) ; $iT++) { 
                            for ($i=0; $i < count($typeOpe->catOperationTypes); $i++) { 
                              if ($porciones_type[$iT] == $typeOpe->catOperationTypes[$i]->idOperationType) {
                                echo '<option selected value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->name.'</option>';
                              }else{
                                echo '<option value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->name.'</option>';
                              }
                            }
                          }*/
                          for ($i=0; $i < count($typeOpe->catOperationTypes); $i++) { 
                            if (in_array($typeOpe->catOperationTypes[$i]->idOperationType, $typeSelect)) {
                              echo '<option selected value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->descriptionApp.'</option>';
                            }else{
                                echo '<option value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->descriptionApp.'</option>';
                            }
                          }
                            var_dump($typeOpe);
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="edoTransaccion">Estatus de Operación*</label>
                        <select multiple="multiple" class="form-control select2-multiple" id="estatus" name="estatus">
                          <option value=""></option>
                          <?php 
                          $statusArray = array ('Procesando', 'Denegado', 'Reversado', 'Cancelado', 'Reversando', 'Devuelto', 'Aprobado', 'Creado', 'Pendiente de envío', 'Enviado', 'Rechazado', 'Confirmado', 'Conciliado', 'Liquidado', 'Cerrado', 'Tarifa dividida');
                          $statusidArray = array ('5','6','7','8','10','11','15','25','26','27','28','29','30','31','32','33');
                          /*for ($iS=0; $iS < count($porciones_status) ; $iS++) { 
                            for ($iStatus=0; $iStatus < count($statusArray) ; $iStatus++) { 
                              if ($porciones_status[$iS] == $statusidArray[$iStatus]) {
                                echo '<option selected value="'.$statusidArray[$iStatus].'">'.$statusArray[$iStatus].'</option>';
                                array_push($nameStatus,$statusArray[$iStatus]);
                                array_push($idStatus,$statusidArray[$iStatus]);
                                $nameStatusurl .= $statusArray[$iStatus].',';
                              }else{
                                echo '<option value="'.$statusidArray[$iStatus].'">'.$statusArray[$iStatus].'</option>';
                              }
                            }*/
                          for ($iS=0; $iS < count($statusArray) ; $iS++) { 
                            if (in_array( $statusidArray[$iS], $statusSelect)) {
                              echo '<option selected value="'.$statusidArray[$iS].'">'.$statusArray[$iS].'</option>';
                                array_push($nameStatus,$statusArray[$iS]);
                                array_push($idStatus,$statusidArray[$iS]);
                                $nameStatusurl .= $statusArray[$iS].',';
                            }else{
                                echo '<option value="'.$statusidArray[$iS].'">'.$statusArray[$iS].'</option>';
                            }
                          }
                          
                          ?>
                          <!--option value="3">APROBADA</option>
                          <option value="5">DECLINADA</option>
                          <option value="6">REVERSADA</option>
                          <option value="7">CANCELADA</option>
                          <option value="10">DEVUELTA</option>                    
                          <option value="12">DEVOLUCION PARCIAL</option>                    
                          <option value="13">CREADA</option>                    
                          <option value="14">PAGADA</option-->                    
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="section">
                        <label for="fechaInicio">Fecha Inicio*</label>
                        <input type="text" value="<?php echo $_GET['dateInit']?>" class="form-control" id="datetimepicker1" name="datetimepicker1">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="section">
                        <label for="fechaFin">Fecha Fin*</label>
                        <input type="text" value="<?php echo $_GET['dateFinish']?>" class="form-control" id="datetimepicker2" name="datetimepicker2">
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

              $curl = curl_init();

              $location = curl_escape($curl, $porciones_ini[0].' '.$porciones_ini[1]);
              $location2 = curl_escape($curl, $porciones_fin[0].' '.$porciones_fin[1]);
              $idSirio = 'SUB'.$_GET['subafiliado'];
              if ($_GET['entidad'] != 0) {
                $idSirio.=$_GET['entidad'];
              }
              if ($_GET['sucursal'] != 0) {
                $idSirio.=$_GET['sucursal'];
              }
              if ($_GET['caja'] != 0) {
                $idSirio.=$_GET['caja'];
              }

              $urlServices =WS_SALDOS.'/Entities/entities/'.$idSirio.'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE.'&dateInit='.$location.'&dateFinish='.$location2;

              //echo $urlServices;
              //http://44.199.131.117/Entities/entities/SUB165/getoperationbytypeandstatuscustom?type=1&status=3&page=0&size=10&dateInit=2022-07-03%2000%3A00&dateFinish=2022-10-19%2000%3A00

              curl_setopt_array($curl, array(
                CURLOPT_URL => $urlServices,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
              ));

              $response = curl_exec($curl);

              $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

              curl_close($curl);
              $num_total_rows = 0;
            if ($httpcode == 200) {               
              $datos= array('response'=>json_decode($response));

              //var_dump($response);

              //curl_close($curl);

              if ($response != null) {
                $num_total_rows = $datos['response']->totalItems;
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
                <div class="row">
                  <div class="col-md-4">
                    <a href="#" class="botonExcel btn ladda-button btn-default">
                      <span class="imoon imoon-file-excel"></span> Exportar a Excel
                    </a>
                  </div>
                </div>
                <div style="height: 30px;"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" style=" overflow: auto;">
                      <div id="caja21" class="text-center"></div>
                      <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead class="bg-dark">
                          <tr>
                            <th class="va-m" data-toggle="tooltip" title="ID">Id</th>
                            <!-- Generated markup by the plugin -->
                            <div class="tooltip top" role="tooltip">
                              <div class="tooltip-arrow"></div>
                              <div class="tooltip-inner">
                                Some tooltip text!
                              </div>
                            </div>
                            <th class="va-m" data-toggle="tooltip" title="Tipo">Tipo</th>
                           
                            <th class="va-m" data-toggle="Venta Neta">Venta Neta</th>
                            
                            <th class="va-m" data-toggle="Monto">Monto</th>
                           
                            <th class="va-m">Estatus</th>
                            <th class="va-m">Descripción</th>
                            <th class="va-m">Fecha</th>
                            <th class="va-m">Codigo de Respuesta</th>
                            <th class="va-m">Referencia Numerica</th>
                            <th class="va-m">Referencia Alfanumerica</th>
                            <th class="va-m">Nombre del Destinatario</th>
                            <th class="va-m">Id Destinatario</th>
                            <th class="va-m">targetIDCode</th>
                            <th class="va-m">targetEmail</th>
                            <th class="va-m">Referencia Interna</th>
                            <th class="va-m">Referencia Externa</th>
                            <th class="va-m">TransactionBundler</th>
                            <th class="va-m">Observación</th>
                            <th class="va-m">Usuario</th>
                            <th class="va-m">Usuario Origen</th>
                            <th class="va-m">Email Origen</th>
                            <th class="va-m">Detalle</th>
                            
                          </tr>
                        </thead>
                        <tbody id="rowsTrasnsacciones">
                          <?php 
                          $html = '';
                          $compro = '';
                          //var_dump($datos['response']->operations);
                          for ($i=0; $i < count($datos['response']->operations) ; $i++) { 
                            //2022-08-31T01:17:56.739+0000
                            $estatusSelect='';
                            $porciones_fecha = explode("T", $datos['response']->operations[$i]->createdAt);
                            $porciones_fecha2 = explode(".", $porciones_fecha[1]);


                            $banco = '';

                            switch ($datos['response']->operations[$i]->targetIDCode) {
                              case '37006':
                                  $banco = 'BANCOMEXT';
                                  break;
                              case '37009':
                                  $banco = 'BANOBRAS';
                                  break;
                              case '37019':
                                  $banco = 'BANJERCITO';
                                  break;
                              case '37135':
                                  $banco = 'NAFIN';
                                  break;
                              case '37166':
                                  $banco = 'BANSEFI';
                                  break;
                              case '37168':
                                  $banco = 'HIPOTECARIA FED';
                                  break;
                              case '40002':
                                  $banco = 'BANAMEX';
                                  break;
                              case '40012':
                                  $banco = 'BBVA BANCOMER';
                                  break;
                              case '40014':
                                  $banco = 'SANTANDER';
                                  break;
                              case '40021':
                                  $banco = 'HSBC';
                                  break;
                              case '40030':
                                  $banco = 'BAJIO';
                                  break;
                              case '40036':
                                  $banco = 'INBURSA';
                                  break;
                              case '40037':
                                  $banco = 'INTERACCIONES';
                                  break;
                              case '40042':
                                  $banco = 'MIFEL';
                                  break;
                              case '40044':
                                  $banco = 'SCOTIABANK';
                                  break;
                              case '40058':
                                  $banco = 'BANREGIO';
                                  break;
                              case '40059':
                                  $banco = 'INVEX';
                                  break;
                              case '40060':
                                  $banco = 'BANSI';
                                  break;
                              case '40062':
                                  $banco = 'AFIRME';
                                  break;
                              case '40072':
                                  $banco = 'BANORTE/IXE';
                                  break;
                              case '40102':
                                  $banco = 'INVESTA BANK';
                                  break;
                              case '40103':
                                  $banco = 'AMERICAN EXPRES';
                                  break;
                              case '40106':
                                  $banco = 'BA-MSA';
                                  break;
                              case '40108':
                                  $banco = 'TOKYO';
                                  break;
                              case '40110':
                                  $banco = 'JP MORGAN';
                                  break;
                              case '40112':
                                  $banco = 'BMONEX';
                                  break;
                              case '40113':
                                  $banco = 'VE POR MAS';
                                  break;
                              case '40124':
                                  $banco = 'DEUTSCHE';
                                  break;
                              case '40126':
                                  $banco = 'CREDIT SUISSE';
                                  break;
                              case '40127':
                                  $banco = 'AZTECA';
                                  break;
                              case '40128':
                                  $banco = 'AUTOFIN';
                                  break;
                              case '40129':
                                  $banco = 'BARCLAYS';
                                  break;
                              case '40130':
                                  $banco = 'COMPARTAMOS';
                                  break;
                              case '40131':
                                  $banco = 'BANCO FAMSA';
                                  break;
                              case '40132':
                                  $banco = 'MULTIVA BANCO';
                                  break;
                              case '40133':
                                  $banco = 'ACTINVER';
                                  break;
                              case '40136':
                                  $banco = 'INTERCAM BANCO';
                                  break;
                              case '40137':
                                  $banco = 'BANCOPPEL';
                                  break;
                              case '40138':
                                  $banco = 'ABC CAPITAL';
                                  break;
                              case '40140':
                                  $banco = 'CONSUBANCO';
                                  break;
                              case '40141':
                                  $banco = 'VOLKSWAGEN';
                                  break;
                              case '40143':
                                  $banco = 'CIBANCO';
                                  break;
                              case '40145':
                                  $banco = 'BBASE';
                                  break;
                              case '40147':
                                  $banco = 'BANKAOOL';
                                  break;
                              case '40148':
                                  $banco = 'PAGATODO';
                                  break;
                              case '40150':
                                  $banco = 'INMOBILIARIO';
                                  break;
                              case '40151':
                                  $banco = 'DONDE';
                                  break;
                              case '40152':
                                  $banco = 'BANCREA';
                                  break;
                              case '40154':
                                  $banco = 'BANCO FINTERRA';
                                  break;
                              case '40155':
                                  $banco = 'ICBC';
                                  break;
                              case '40156':
                                  $banco = 'SABADELL';
                                  break;
                              case '40158':
                                  $banco = 'MIZUHO BANK';
                                  break;
                              case '40903':
                                  $banco = 'ONSIGNA KASH';
                                  break;
                              case '90600':
                                  $banco = 'MONEXCB';
                                  break;
                              case '90601':
                                  $banco = 'GBM';
                                  break;
                              case '90602':
                                  $banco = 'MASARI';
                                  break;
                              case '90605':
                                  $banco = 'VALUE';
                                  break;
                              case '90606':
                                  $banco = 'ESTRUCTURADORES';
                                  break;
                              case '90608':
                                  $banco = 'VECTOR';
                                  break;
                              case '90613':
                                  $banco = 'MULTIVA CBOLSA';
                                  break;
                              case '90614':
                                  $banco = 'ACCIVAL';
                                  break;
                              case '90616':
                                  $banco = 'FINAMEX';
                                  break;
                              case '90617':
                                  $banco = 'VALMEX';
                                  break;
                              case '90620':
                                  $banco = 'PROFUTURO';
                                  break;
                              case '90621':
                                  $banco = 'CB ACTINVER';
                                  break;
                              case '90623':
                                  $banco = 'SKANDIA';
                                  break;
                              case '90626':
                                  $banco = 'CBDEUTSCHE';
                                  break;
                              case '90627':
                                  $banco = 'ZURICH';
                                  break;
                              case '90628':
                                  $banco = 'ZURICHVI';
                                  break;
                              case '90630':
                                  $banco = 'CB INTERCAM';
                                  break;
                              case '90631':
                                  $banco = 'CI BOLSA';
                                  break;
                              case '90634':
                                  $banco = 'FINCOMUN';
                                  break;
                              case '90636':
                                  $banco = 'HDI SEGUROS';
                                  break;
                              case '90637':
                                  $banco = 'ORDER';
                                  break;
                              case '90638':
                                  $banco = 'AKALA';
                                  break;
                              case '90640':
                                  $banco = 'CB JPMORGAN';
                                  break;
                              case '90642':
                                  $banco = 'REFORMA';
                                  break;
                              case '90646':
                                  $banco = 'STP';
                                  break;
                              case '90648':
                                  $banco = 'EVERCORE';
                                  break;
                              case '90649':
                                  $banco = 'OSKNDIA';
                                  break;
                              case '90652':
                                  $banco = 'ASEA';
                                  break;
                              case '90653':
                                  $banco = 'KUSPIT';
                                  break;
                              case '90655':
                                  $banco = 'SOFIEXPRESS';
                                  break;
                              case '90656':
                                  $banco = 'UNAGRA';
                                  break;
                              case '90659':
                                  $banco = 'ASP INTEGRA OPC';
                                  break;
                              case '90670':
                                  $banco = 'LIBERTAD';
                                  break;
                              case '90671':
                                  $banco = 'HUASTECAS';
                                  break;
                              case '90674':
                                  $banco = 'AXA';
                                break;
                              case '90677':
                                  $banco = 'CAJA POP MEXICA';
                                break;
                              case '90678':
                                  $banco = 'SURA';
                                break;
                              case '90679':
                                  $banco = 'FND';
                                break;
                              case '90680':
                                  $banco = 'CRISTOBAL COLON';
                                break;
                              case '90681':
                                  $banco = 'PRINCIPAL';
                                break;
                              case '90683':
                                  $banco = 'CAJA TELEFONIST';
                                break;
                              case '90684':
                                  $banco = 'TRANSFER';
                                break;
                              case '90685':
                                  $banco = 'FONDO (FIRA)';
                                break;
                              case '90686':
                                  $banco = 'INVERCAP';
                                break;
                              case '90687':
                                  $banco = 'INFONAVIT';
                                break;
                              case '90689':
                                  $banco = 'FOMPED';
                                break;
                              case '90901':
                                  $banco = 'CLS';
                                break;
                              case '90902':
                                  $banco = 'INDEVAL';
                                break;                                      
                              default:
                                break;
                            }


                            switch ($datos['response']->operations[$i]->status) {
                              case '5':
                                $estatus = 'Procesando';
                                break;
                              case '6':
                                $estatus = 'Denegado';
                                break;
                              case '7':
                                $estatus = 'Reversado';
                                break;
                              case '8':
                                $estatus = 'Cancelado';
                                break;
                              case '10':
                                $estatus = 'Reversando';
                                break;
                              case '11':
                                $estatus = 'Devuelto';
                                break;
                              case '15':
                                $estatus = 'Aprobado';
                                break;
                              case '25':
                                $estatus = 'Creado';
                                break;
                              case '26':
                                $estatus = 'Pendiente de envío';
                                break;
                              case '27':
                                $estatus = 'Enviado';
                                break;
                                case '28':
                                $estatus = 'Rechazado';
                                break;
                              case '29':
                                $estatus = 'Confirmado';
                                break;
                              case '30':
                                $estatus = 'Conciliado';
                                break;
                              case '31':
                                $estatus = 'Liquidado';
                                break;
                              case '32':
                                $estatus = 'Cerrado';
                                break;
                              case '33':
                                $estatus = 'Tarifa dividida';
                                break;                                      
                              default:
                                break;
                            }

                            $html.='<tr>
                                      <td>'.$datos['response']->operations[$i]->id.'</td>
                                      <td>'.$datos['response']->operations[$i]->descriptionType.'</td>
                                      <td>$ '.number_format($datos['response']->operations[$i]->amount,2).'</td>
                                      <td>'.$datos['response']->operations[$i]->processingCode.'</td>
                                      <td>'.$estatus.'</td>
                                      <td>'.$datos['response']->operations[$i]->description.'</td>
                                      <td>'.$porciones_fecha[0].' '.$porciones_fecha2[0].'</td>
                                      <td>'.$datos['response']->operations[$i]->responseCode.'</td>
                                      <td>'.$datos['response']->operations[$i]->numericReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->alphanumericReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetName.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetID.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetIDCode.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetEmail.'</td>
                                      <td>'.$datos['response']->operations[$i]->internalReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->externalReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->transactionBundler.'</td>
                                      <td>'.$datos['response']->operations[$i]->observation.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetName.'</td>
                                      <td>'.$datos['response']->operations[$i]->originalUsername.'</td>
                                      <td>'.$datos['response']->operations[$i]->originalEmail.'</td>
                                      <td>';
                                      if ($datos['response']->operations[$i]->type == 10008) {
                                        $html.='<a title="Detalle de Operacion" href="detalleOperacion?validate='.$datos['response']->operations[$i]->numericReference.'&page=1" class="btn btn-primary">'.
                                                  '<i class="fas fa-coins"></i>'.
                                                '</a>';
                                      }else if ($datos['response']->operations[$i]->type == 1) {
                                        $posicion_coincidencia = strpos($datos['response']->operations[$i]->description, '|');
                                        if ($posicion_coincidencia === false) {
                                          $description = $datos['response']->operations[$i]->description;
                                        }else{
                                          $pieces = explode('|', $datos['response']->operations[$i]->description);
                                          $description= $pieces[2];
                                        }
                                        $html.='<a title="Comprobante Spei" href="#" class="btn btn-primary comprobante" data-fecha="'.$porciones_fecha[0].'" data-hora="'.$porciones_fecha2[0].'" data-monto="'.number_format($datos['response']->operations[$i]->amount,2).'" data-name="'.$datos['response']->operations[$i]->targetName.'" data-cuenta="'.$datos['response']->operations[$i]->targetID.'" data-comision="'.$datos['response']->operations[$i]->settleAmount.'" data-currency="'.$datos['response']->operations[$i]->currency->alphabeticCode.'" data-banco="'.$banco.'" data-concepto="'.$description.'" data-referencia="'.$datos['response']->operations[$i]->numericReference.'" data-origen="'.$datos['response']->operations[$i]->originalUsername.'" data-autorizacion="'.$datos['response']->operations[$i]->id.'" data-externalReference="'.$datos['response']->operations[$i]->externalReference.'">'.
                                                  '<i class="fas fa-file-invoice-dollar"></i>'.
                                                '</a>';
                                      }else if ($datos['response']->operations[$i]->type == 10) {
                                        $html.='<a title="Recarga TAE" href="#" class="btn btn-primary comprobante_r" data-fecha="'.$porciones_fecha[0].' '.$porciones_fecha2[0].'" data-monto="'.number_format($datos['response']->operations[$i]->amount,2).'" data-name="'.$datos['response']->operations[$i]->observation.'" data-cuenta="" data-banco="'.$estatus.'" data-concepto="'.$datos['response']->operations[$i]->description.'" data-referencia="'.$datos['response']->operations[$i]->internalReference.'" data-origen="" data-autorizacion="'.$datos['response']->operations[$i]->id.'" data-comision="'.$datos['response']->operations[$i]->settleAmount.'">'.
                                                  '<i class="fas fa-file-invoice-dollar"></i>'.
                                                '</a>';
                                      }else if ($datos['response']->operations[$i]->type == 11) {
                                        $html.='<a title="Pago de Servicio" href="#" class="btn btn-primary comprobante_ps" data-fecha="'.$porciones_fecha[0].' '.$porciones_fecha2[0].'" data-monto="'.number_format($datos['response']->operations[$i]->amount,2).'" data-name="'.$datos['response']->operations[$i]->observation.'" data-cuenta="" data-banco="'.$estatus.'" data-concepto="'.$datos['response']->operations[$i]->description.'" data-referencia="'.$datos['response']->operations[$i]->internalReference.'" data-origen="" data-autorizacion="'.$datos['response']->operations[$i]->id.'" data-comision="'.$datos['response']->operations[$i]->settleAmount.'">'.
                                                  '<i class="fas fa-file-invoice-dollar"></i>'.
                                                '</a>';
                                      }
                              $html.='</td>
                                    </tr>';


                              $compro.='<div id="figuras_spei_'.$datos['response']->operations[$i]->id.'" style="background: #fff;" class="row p-3 border rounded m-10">
                                        <!--html-->
                                          <div class="row p-3 border rounded m-10" style="display:block;
                                              page-break-before:always;">
                                            <div class="col-md-12">
                                              <div class="row">
                                                <div class="col-md-12" >
                                                  <div style="background:#000; padding: 10px;">
                                                    <img style="width: 33%;  padding: 10px;" src="'.base_url().'/public/assets/img/logo_kashpay.png" />
                                                  </div>
                                                </div>
                                                <div class="col-md-12" >
                                                  <div style="height: 20px;"></div>
                                                </div>
                                              </div>
                                              <div  class="row ">
                                                <div class="col-md-12" >
                                                  <h3>Comprobante de transferencia</h3>
                                                </div>
                                                <div class="col-md-12" >
                                                  <div style="height: 20px;"></div>
                                                </div>
                                              </div>
                                              <div  class="row ">
                                                <div class="col-md-6" >
                                                  <p><b>Transferencia realizada por: </b> '.$datos['response']->operations[$i]->originalUsername.'</p>  
                                                </div>
                                                <div class="col-md-6" >
                                                  <p><b>Fecha: </b> '.$porciones_fecha[0].'</p>
                                                  <p><b>Hora: </b> '.$porciones_fecha2[0].'</p>   
                                                </div>
                                                <div class="col-md-12" >
                                                  <div style="height: 20px;"></div>
                                                </div>
                                              </div>
                                              <div  class="row ">
                                                <div class="col-md-12" >
                                                  <h5>'.$datos['response']->operations[$i]->descriptionType.'</h5>
                                                </div>
                                                <div class="col-md-12" >
                                                  <div style="height: 20px;"></div>
                                                </div>
                                              </div>
                                              <div  class="row ">
                                                <div class="col-md-12">
                                                  <div style="background:#27bd22; padding: 10px;">
                                                    <p style="color:#fff">Esta transferencia ha sido aceptada con numero de autorizacion #89998 </p>
                                                    <p style="color:#fff">Para validarla consulta tu comprobante electronico de pago (CEP)</p>
                                                  </div>
                                                </div>
                                                <div class="col-md-12" >
                                                  <div style="height: 20px;"></div>
                                                </div>
                                              </div>
                                              <div  class="row ">
                                                <div class="col-md-12">
                                                  <table class="table">
                                                    <tr>
                                                      <td>Cuentas</td>
                                                      <td colspan="2">
                                                        <p><b>Cuenta retiro</b></p>
                                                        <p>'.$banco.'</p>
                                                        <p>Clabe emisor **7854</p>
                                                        <p><b>Cuenta deposito beneficiario</b></p>
                                                        <p>'.$banco.' beneficiario</p>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td>Datos de la transferencia</td>
                                                      <td>
                                                        <p><b>Monto</b></p>
                                                        <p><b>Clave de rastreo</b></p>
                                                        <p><b>Tipo de cuenta</b></p>
                                                        <p><b>Tipo de beneficiario**</b></p>
                                                        <p><b>Referencia numerica</b></p>
                                                        <p><b>Concepto de pago</b></p>
                                                        <p><b>Plazo</b></p>
                                                      </td>
                                                      <td>
                                                        <p>$'.number_format($datos['response']->operations[$i]->amount,2).' '.$datos['response']->operations[$i]->currency->alphabeticCode.'</p>
                                                        <p>'.$datos['response']->operations[$i]->externalReference.'</p>
                                                        <p>Tarjeta</p>
                                                        <p>Persona fisica**</p>
                                                        <p>'.$datos['response']->operations[$i]->numericReference.'</p>
                                                        <p>'.$datos['response']->operations[$i]->description.'</p>
                                                        <p>NA</p>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <!-- /html-->
                                      </div>';
                          }
                          echo $html;
                          
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                    
                <script type="text/javascript">
                </script>                
              </div>
              <?php 
                echo '<nav>';
                echo '<ul class="pagination">';

                if ($total_pages > 1) {
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="operaciones?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.($page-1).'&dateInit='.$location.'&dateFinish='.$location2.'&subafiliado='.$_GET['subafiliado'].'&entidad='.$_GET['entidad'].'&sucursal='.$_GET['sucursal'].'&caja='.$_GET['caja'].'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="operaciones?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.$i.'&dateInit='.$location.'&dateFinish='.$location2.'&subafiliado='.$_GET['subafiliado'].'&entidad='.$_GET['entidad'].'&sucursal='.$_GET['sucursal'].'&caja='.$_GET['caja'].'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="operaciones?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.($page+1).'&dateInit='.$location.'&dateFinish='.$location2.'&subafiliado='.$_GET['subafiliado'].'&entidad='.$_GET['entidad'].'&sucursal='.$_GET['sucursal'].'&caja='.$_GET['caja'].'"><span aria-hidden="true">&raquo;</span></a></li>';
                  }
                }
                echo '</ul>';
                echo '</nav>';
              }else{
                echo '<h4>No se encontraron datos.</h4>';
              }
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
<div  id="divName">

</div>


<div id="elementH"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

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

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-additional-inputs.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/operaciones2.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>

function printDiv(nombreDiv) {
  $('#'+nombreDiv).show();

       var contenido= document.getElementById(nombreDiv).innerHTML;
       var contenidoOriginal= document.body.innerHTML;

       document.body.innerHTML = contenido;

       window.print();

       document.body.innerHTML = contenidoOriginal;
     /*var doc = new jsPDF();
                  var elementHTML = $('#divName').html();
                  var specialElementHandlers = {
                      '#elementH': function (element, renderer) {
                          return true;
                      }
                  };
                  doc.fromHTML(elementHTML, 15, 15, {
                      'width': 170,
                      'elementHandlers': specialElementHandlers
                  });

                  // Save the PDF
                  doc.save('sample-document.pdf');*/

    //$('#'+nombreDiv).hide();

  }
</script>
<script language="javascript">

$(document).ready(function() {

  $('[data-toggle="tooltip"]').tooltip();

  $(".botonExcel").click(function(event) {
    var type = $('#type').val();
    var status = $('#status').val();
    if (type == undefined) {
      type = '';
    }
    if (status == undefined) {
      status = '';
    }
    console.log('type = '+urlRep);
    document.location = base_url+'/public/assets/exportar/exportar.php?urlRep='+urlRep+'&type=<?php echo $_GET["type"]?>&status=<?php echo $_GET["status"]?>&page=&size=<?php echo $num_total_rows?>&id=<?php echo $idSirio?>&dateInit=<?php echo $_GET["dateInit"]?>&dateFinish=<?php echo $_GET["dateFinish"]?>&name=<?php echo $nameStatusurl?>';
  
  });

  $(".comprobante").click(function(event) {
    var auto= $(this).data("autorizacion");
    var msg = '<div>'+
                '<div id="figuras_spei" style="background: #fff;" class="row p-3 border rounded m-10">'+
                  '<div class="row p-3 border rounded m-10" style="display:block; page-break-before:always;">'+
                    '<div class="col-md-12">'+
                      '<div class="row">'+
                        '<div class="col-md-12" >'+
                          '<div style="background:#333f50; padding: 10px;">'+
                            '<img style="width: 40%;  padding: 0px;" src="'+base_url+'/public/assets/img/logo_kashpay_sobra.png" />'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<p><b>Fecha: </b> '+$(this).data("fecha")+'</p>'+
                          '<p><b>Hora: </b> '+$(this).data("hora")+'</p>   '+
                        '</div>'+
                       ' <div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<div style="background:#fff; padding: 10px;">'+
                            '<p style="color:#000">Su transferencia ha sido aplicada con número de autorización #'+$(this).data("autorizacion")+'</p>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<h5>'+$(this).data("origen")+'</h5>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<table class="table">'+
                            '<tr>'+
                              '<td>Cuentas</td>'+
                              '<td colspan="2">'+
                                '<p><b>Cuenta retiro</b></p>'+
                                '<p>KASHPAY</p>'+
                                '<p>Clabe emisor **7854</p>'+
                                '<p><b>Cuenta deposito beneficiario</b></p>'+
                                '<p>'+$(this).data("banco")+' beneficiario</p>'+
                              '</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Datos de la transferencia</td>'+
                              '<td>'+
                                '<p><b>Monto</b></p>'+
                                '<p><b>Clave de rastreo</b></p>'+
                                '<p><b>Tipo de cuenta</b></p>'+
                                '<p><b>Tipo de beneficiario**</b></p>'+
                                '<p><b>Referencia numerica</b></p>'+
                                '<p><b>Concepto de pago</b></p>'+
                                '<p><b>Plazo</b></p>'+
                              '</td>'+
                              '<td>'+
                                '<p>$'+$(this).data("monto")+' '+$(this).data("currency")+'</p>'+
                                '<p>'+$(this).data("externalReference")+'</p>'+
                                '<p>Tarjeta</p>'+
                                '<p>Persona fisica**</p>'+
                                '<p>'+$(this).data("referencia")+'</p>'+
                                '<p>'+$(this).data("concepto")+'</p>'+
                                '<p>NA</p>'+
                              '</td>'+
                            '</tr>'+
                          '</table>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
             '</div>';
             $('#divName').html(msg);
     bootbox.dialog({
        title: "",
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-blue',
                callback: function(){
                  /*var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                 document_html.document.write( "<html>"+msg+"</html>" );
                 document_html.document.write( printContents );
                 document_html.document.write( "</body></html>" );*/
                 //setTimeout(function () {
                       //document_html.print();
                  // }, 3000);*/
                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                  //console.log('figuras_spei_'+auto);
                  printDiv('divName');
                  
                }
            },
            cancel: {
                label: 'Ok',
                className: 'btn-primari',
                callback: function(){
                     bootbox.hideAll();
                     //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            }
        }
    });
  });


  $(".comprobante_ps").click(function(event) {
    var fechaSpei = $(this).data("fecha");
    const splitString = fechaSpei.split(" ");
    var msg = '<div>'+
                '<div id="figuras_spei" style="background: #fff;" class="row p-3 border rounded m-10">'+
                  '<div class="row p-3 border rounded m-10" style="display:block; page-break-before:always;">'+
                    '<div class="col-md-12">'+
                      '<div class="row">'+
                        '<div class="col-md-12" >'+
                          '<div style="background:#333f50; padding: 10px;">'+
                            '<img style="width: 40%;  padding: 0px;" src="'+base_url+'/public/assets/img/logo_kashpay_sobra.png" />'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<p><b>Fecha: </b> '+splitString[0]+'</p>'+
                          '<p><b>Hora: </b> '+splitString[1]+'</p>   '+
                        '</div>'+
                       ' <div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<div style="background:#fff; padding: 10px;">'+
                            '<p style="color:#000">Su pago de servicio ha sido aplicado con número de autorización #'+$(this).data("autorizacion")+'</p>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<h5>Pago de servicio '+$(this).data("concepto")+'</h5>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<table class="table">'+
                            '<tr>'+
                              '<td>Datos del Pago de servicio</td>'+
                              '<td>'+
                                '<p><b>Monto</b></p>'+
                                '<p><b>Concepto</b></p>'+
                                '<p><b>Referencia</b></p>'+
                                '<p><b>Estatus</b></p>'+
                              '</td>'+
                              '<td>'+
                                '<p>$ '+$(this).data("monto")+'</p>'+
                                '<p> Pago de servicio '+$(this).data("concepto")+'</p>'+
                                '<p>'+$(this).data("name")+'</p>'+
                                '<p>'+$(this).data("banco")+'</p>'+
                              '</td>'+
                            '</tr>'+
                          '</table>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
             '</div>';
             $('#divName').html(msg);
             $('#divName').hide();
    
              /*'<div>'+
                '<div style="background:#c7924b; border-radius:0px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                    '<h4 style="color:#fff">Pago de servicio</h4>'+
                    '<p>'+fechaSpei+'</p>'+
                    '<p><b>$'+$(this).data("monto")+'</b></p>'+
                '</div>'+
                '<div style="text-align: center; background:#000;">'+
                    '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                '</div>'+
                '<div style="text-align: left;">'+
                    '<p>Descripción</p>'+
                    '<p>'+$(this).data("name")+'</p>'+
                    '<p>'+'</p>'+
                    '<p>Concepto:'+'</p>'+
                    '<p>Pago de Servicio '+$(this).data("concepto")+'</p>'+
                    '<br>'+
                    '<p>Datos de Autorización: </p>'+$(this).data("referencia")+'</p>'+
                    '<p>Descripción: '+$(this).data("banco")+'</p>'+
                '</div>'+
             '</div>';*/
     bootbox.dialog({
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-primary',
                callback: function(){
                  $('#divName').show();
                  var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                  document_html.document.write( "<html>"+msg+"</html>" );
                  //document_html.document.write( printContents );
                  document_html.document.write( "</body></html>" );
                  //setTimeout(function () {
                  document_html.print();
                  $('#divName').html('');
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

  $(".comprobante_r").click(function(event) {
    var fechaSpei = $(this).data("fecha");
    var msg = '<div>'+
                '<div id="figuras_spei" style="background: #fff;" class="row p-3 border rounded m-10">'+
                  '<div class="row p-3 border rounded m-10" style="display:block; page-break-before:always;">'+
                    '<div class="col-md-12">'+
                      '<div class="row">'+
                        '<div class="col-md-12" >'+
                          '<div style="background:#333f50; padding: 10px;">'+
                            '<img style="width: 40%;  padding: 0px;" src="'+base_url+'/public/assets/img/logo_kashpay_sobra.png" />'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<p><b>Fecha: </b> '+$(this).data("fecha")+'</p>'+
                          '<p><b>Hora: </b> '+$(this).data("hora")+'</p>   '+
                        '</div>'+
                       ' <div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<div style="background:#fff; padding: 10px;">'+
                            '<p style="color:#000">Su recarga ha sido aplicada con número de autorización #'+$(this).data("autorizacion")+'</p>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      
                      '<div  class="row ">'+
                        '<div class="col-md-12" >'+
                          '<h5>'+$(this).data("origen")+'</h5>'+
                        '</div>'+
                        '<div class="col-md-12" >'+
                          '<div style="height: 20px;"></div>'+
                        '</div>'+
                      '</div>'+
                      '<div  class="row ">'+
                        '<div class="col-md-12">'+
                          '<table class="table">'+
                            '<tr>'+
                              '<td>Datos de la recarga</td>'+
                              '<td>'+
                                '<p><b>Monto</b></p>'+
                                '<p><b>Concepto de la recarga</b></p>'+
                                '<p><b>Referencia</b></p>'+
                                '<p><b>Estatus</b></p>'+
                              '</td>'+
                              '<td>'+
                                '<p>$'+$(this).data("monto")+' '+$(this).data("currency")+'</p>'+
                                '<p>'+$(this).data("concepto")+'</p>'+
                                '<p>'+$(this).data("name")+'</p>'+
                                '<p>'+$(this).data("banco")+'</p>'+
                                '<p>NA</p>'+
                              '</td>'+
                            '</tr>'+
                          '</table>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
             '</div>';
             $('#divName').html(msg);
              
              /*'<div>'+
                '<div style="text-align: center; background:#000;">'+
                    '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                '</div>'+
                '<div style=" border-radius:0px; color:#000; padding: 10px;text-align: center; margin-top:10px;">'+
                    '<h4 style="color:#000">Recarga Telefónica</h4>'+
                    '<p>'+fechaSpei+'</p>'+
                    '<p><b>$'+$(this).data("monto")+'</b></p>'+
                '</div>'+
                '<div style="text-align: left;">'+
                    '<p>Descripción</p>'+
                    '<p>Número Telefónico: </p>'+$(this).data("name")+'</p>'+
                    '<p>'+'</p>'+
                    '<p>Concepto:'+'</p>'+
                    '<p>Recarga telefónica '+$(this).data("concepto")+'</p>'+
                    '<br>'+
                    '<p>Datos de Autorización:</p>'+
                    '<p>'+$(this).data("referencia")+'</p>'+
                    '<p>Descripción: '+'</p>'+$(this).data("banco")+'</p>'+
                    '<p>Comision: </p>'+'$ '+$(this).data("comision")+'</p>'+
                '</div>'+
             '</div>';*/
     bootbox.dialog({
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
    

});
function comprobante(){
  $(function(){
    
  });
}
</script> 

</body>

</html>
<?=$this->endsection()?>