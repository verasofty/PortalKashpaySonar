<?php 
require('../fpdf/fpdf.php');

$today_hora = date("Y-m-d H:i:s"); 

class PDF extends FPDF
{


// Una tabla más completa
function ImprovedTable($header)
{
    // Anchuras de las columnas
    $w = array(20, 20, 20, 35, 35, 20, 40, 20, 20, 40, 40, 30, 20, 30, 20,20,20,20,20,20,20,20,20,20,20,20,20,40,40);
    // Cabeceras
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Datos
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
	//echo $_GET['urlRep'].'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_GET['subafiliado'].'&idEntity='.$_GET['entidad'].'&idTerminal='.$_GET['sucursal'].'&idTerminalUser='.$_GET['caja'].'&typeOperation='.$_GET['operacion'].'&amount='.$_GET['monto'].'&responseCode='.$_GET['edoTransaccion'].'&referenceNumber='.$_GET['referencia'].'&authorizationNumber='.$_GET['autorizacion'].'&bin='.$bin.'&startDate='.$location.'&endDate='.$location2.'&status='.$_GET['type'].'&searchBy='.$_GET['mood'].'&page=&size='.$_GET['size'];


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
	                        
		
                $this->Cell($w[0],6,number_format($datos['rows']->content[$i]->amount,2));
                $this->Cell($w[1],6,$datos['rows']->content[$i]->authorizationNumber);
                $this->Cell($w[2],6,$datos['rows']->content[$i]->card);
                $this->Cell($w[3],6,$datos['rows']->content[$i]->authorizationRrcext);
                $this->Cell($w[4],6,$datos['rows']->content[$i]->authorizationDate);
                $this->Cell($w[5],6,$datos['rows']->content[$i]->status);
                $this->Cell($w[6],6,$datos['rows']->content[$i]->institution);
                $this->Cell($w[7],6,$datos['rows']->content[$i]->brand);
                $this->Cell($w[8],6,$datos['rows']->content[$i]->nature);
                $this->Cell($w[9],6,$datos['rows']->content[$i]->entityName);
                $this->Cell($w[10],6,$datos['rows']->content[$i]->terminalName);
                $this->Cell($w[11],6,$datos['rows']->content[$i]->transactiontype);
                $this->Cell($w[12],6,$datos['rows']->content[$i]->entryMode);
                $this->Cell($w[13],6,number_format($datos['rows']->content[$i]->feeAmount,2));
                $this->Cell($w[14],6,$datos['rows']->content[$i]->responseDescription);
                $this->Cell($w[15],6,$datos['rows']->content[$i]->qtPay);
                $this->Cell($w[16],6,$datos['rows']->content[$i]->planId);
                $this->Cell($w[17],6,$datos['rows']->content[$i]->graceNumber);
                $this->Cell($w[18],6,$datos['rows']->content[$i]->concept);
                $this->Cell($w[19],6,$datos['rows']->content[$i]->bin);
                $this->Cell($w[20],6,$datos['rows']->content[$i]->sendSirio);
                $this->Cell($w[21],6,$iva);
                $this->Cell($w[22],6,$com1);
                $this->Cell($w[23],6,$com2);
                $this->Cell($w[24],6,$com3);
                $this->Cell($w[25],6,$datos['rows']->content[$i]->entityOperationId);
                $this->Cell($w[26],6,$datos['rows']->content[$i]->transactionBuilder);
                $this->Cell($w[27],6,$datos['rows']->content[$i]->liquidation_id);
                $this->Cell($w[28],6,$datos['rows']->content[$i]->statusSirio);
             $this->Ln();
	}

    // Línea de cierre
    //$this->Cell(580,0,'','T');
    //$this->Cell(20, 10, 'Title', 1, 1, 'C');
    $this->Cell(array_sum($w),0,'','T');
}

/* Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(40, 35, 45, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}*/
}

$pdf = new PDF('L','mm',array(800,300));
// Títulos de lasPcolumnas
$header = array('Monto','Autorización','Tarjeta','Referencia','Fecha Autorizacion','Estatus','Institución','Marca','Naturaleza','Entidad','Terminal','Tipo Transacción','EntryMode','Monto Adicional','ResponseDescription','QtPay','PlanId','GraceNumber','Concepto','Bin','Send_Sirio','IVA','Comisión1','Comisión2','Comisión3','Entity OperationId','Transaction Builder','Id Liquidacion','Estatus Sirio');
// Carga de datos
//$data = $pdf->LoadData('paises.txt');
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('Transacciones_'.$today_hora);
$pdf->AddPage();
$pdf->ImprovedTable($header);
$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output('I','Transacciones_'.$today_hora,true);

?>