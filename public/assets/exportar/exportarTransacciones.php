<?php
$today_hora = date("Y-m-d H:i:s"); 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Type: application/vnd.ms-excel; ");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=Transacciones-".$today_hora.".xls");

if ($_GET['bin'] != '') {
  $bin = substr($_GET['bin'], 0, -10);
}else{
  $bin = '';
}

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


$curl = curl_init();

if ($_GET['fechaIni']!='') {
    $porciones_ini = explode(" ", $_GET['fechaIni']);
    $porciones_fin = explode(" ", $_GET['fechaFin']);

    $location = curl_escape($curl, $porciones_ini[0].' '.$porciones_ini[1]);
    $location2 = curl_escape($curl, $porciones_fin[0].' '.$porciones_fin[1]);
}else{
    $location = '';
    $location2 = '';
}


//echo '*'.$location.'*'.$location2.'*';

echo $_GET['urlRep'].'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_GET['subafiliado'].'&idEntity='.$_GET['entidad'].'&idTerminal='.$_GET['sucursal'].'&idTerminalUser='.$_GET['caja'].'&typeOperation='.$_GET['operacion'].'&amount='.$_GET['monto'].'&responseCode='.$_GET['edoTransaccion'].'&referenceNumber='.$_GET['referencia'].'&authorizationNumber='.$_GET['autorizacion'].'&bin='.$bin.'&startDate='.$location.'&endDate='.$location2.'&status='.$_GET['type'].'&searchBy='.$_GET['mood'].'&page=&size='.$_GET['size'];
    

curl_setopt_array($curl, array(
  CURLOPT_URL => $_GET['urlRep'].'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_GET['subafiliado'].'&idEntity='.$_GET['entidad'].'&idTerminal='.$_GET['sucursal'].'&idTerminalUser='.$_GET['caja'].'&typeOperation='.$_GET['operacion'].'&amount='.$_GET['monto'].'&responseCode='.$_GET['edoTransaccion'].'&referenceNumber='.$_GET['referencia'].'&authorizationNumber='.$_GET['autorizacion'].'&bin='.$bin.'&startDate='.$location.'&endDate='.$location2.'&status='.$_GET['type'].'&searchBy='.$_GET['mood'].'&page=&size='.$_GET['size'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic YWRtaW46c2VjcmV0'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$datos['rows']= json_decode($response);
//var_dump($datos['rows']);
$html = '<table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead class="bg-dark">
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
                      </tr>
                    </thead>
                    <tbody id="rowsTrasnsacciones">';
                    

for ($i=0; $i < count($datos['rows']->content) ; $i++) { 
  $btn_imp = '';
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

                    if ($datos['rows']->content[$i]->operationSirio != null) {
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->systemSource != null) {
                            $iva = $datos['rows']->content[$i]->operationSirio->acquiringOperation->systemSource;
                        }
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionType != null) {
                            $transactionType = $datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionType;
                        }
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionSubType != null) {
                            $transactionSubType = $datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionSubType;
                        } 
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionID != null) {
                            $transactionID = $datos['rows']->content[$i]->operationSirio->acquiringOperation->transactionID;
                        }
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->timestamp != null) {
                            $timestamp = $datos['rows']->content[$i]->operationSirio->acquiringOperation->timestamp;
                        }
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->systemTraceAuditNumber != null) {
                            $systemTraceAudit = $datos['rows']->content[$i]->operationSirio->acquiringOperation->systemTraceAuditNumber;
                        }
                        if ($datos['rows']->content[$i]->operationSirio->acquiringOperation->settleAmount != null) {
                            $settleAmount = $datos['rows']->content[$i]->operationSirio->acquiringOperation->settleAmount;
                        }
                    }
                    
                  

                    switch($_GET['rolId']) {
                        //admin
                        case '2':
                            $com1 = 0;
                            $com2 = 0;
                            $com3 = 0;
                            break;
                        //suba
                        case '3':
                            $com1 = (number_format($transactionType,2) + number_format($transactionSubType,2));
                            $com2 = $transactionID;
                            $com3 = (number_format($timestamp) + number_format($systemTraceAudit));
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
                        
	$html .=  '<tr>
                <td>$ '.number_format($datos['rows']->content[$i]->amount,2).'</td>
                <td>'.$datos['rows']->content[$i]->authorizationNumber.'</td>
                <td>'.$datos['rows']->content[$i]->card.'</td>
                <td>'.$datos['rows']->content[$i]->authorizationRrcext.'</td>
                <td>'.$datos['rows']->content[$i]->authorizationDate.'</td>
                <td>'.$datos['rows']->content[$i]->status.'</td>
                <td>'.$datos['rows']->content[$i]->institution.'</td>
                <td>'.$datos['rows']->content[$i]->brand.'</td>
                <td>'.$datos['rows']->content[$i]->nature.'</td>
                <td>'.$datos['rows']->content[$i]->entityName.'</td>
                <td>'.$datos['rows']->content[$i]->terminalName.'</td>
                <td>'.$datos['rows']->content[$i]->transactiontype.'</td>
                <td>'.$datos['rows']->content[$i]->entryMode.'</td>
                <td>'.number_format($datos['rows']->content[$i]->feeAmount,2).'</td>
                <td>'.$datos['rows']->content[$i]->responseDescription.'</td>
                <td>'.$datos['rows']->content[$i]->qtPay.'</td>
                <td>'.$datos['rows']->content[$i]->planId.'</td>
                <td>'.$datos['rows']->content[$i]->graceNumber.'</td>
                <td>'.$datos['rows']->content[$i]->concept.'</td>
                <td>'.$datos['rows']->content[$i]->bin.'</td>
                <td>'.$datos['rows']->content[$i]->sendSirio.'</td>
                <td>'.$iva.'</td>
                <td>'.$com1.'</td>
                <td>'.$com2.'</td>
                <td>'.$com3.'</td>
                <td>'.$datos['rows']->content[$i]->entityOperationId.'</td>
                <td>'.$datos['rows']->content[$i]->transactionBuilder.'</td>
                <td>'.$datos['rows']->content[$i]->liquidation_id.'</td>
                <td>'.$datos['rows']->content[$i]->statusSirio.'</td>
              </tr>';
}

$html .= '</tbody>
                  </table>';

echo $html;
?>