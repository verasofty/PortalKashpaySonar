<?php 
require('../fpdf/fpdf.php');

$today_hora = date("Y-m-d H:i:s"); 

class PDF extends FPDF
{


// Una tabla más completa
function ImprovedTable($header)
{
    // Anchuras de las columnas
    $w = array(40, 70, 40, 40, 60, 40, 40, 40, 40);
    // Cabeceras
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Datos

        
	$curl = curl_init();

    $urlServices = $_GET['urlRep'].'/Entities/entities/all?fatherID='.$_GET['fatherID'].'&type='.$_GET['type'].'&status='.$_GET['status'].'&page=&size='.$_GET['total'];

	//echo $urlServices;

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

	curl_close($curl);

	$datos['rows']= json_decode($response);	   


    for ($iD=0; $iD < count($datos['rows']->entities); $iD++) {   
          $this->Cell($w[0],6,$datos['rows']->entities[$iD]->id );
          $this->Cell($w[1],6,$datos['rows']->entities[$iD]->name );
          $this->Cell($w[2],6,$datos['rows']->entities[$iD]->clabeAccount );
          $this->Cell($w[3],6,$datos['rows']->entities[$iD]->virtualAccount );
          $this->Cell($w[4],6,$datos['rows']->entities[$iD]->email );
          $this->Cell($w[5],6,$datos['rows']->entities[$iD]->phoneNumber );
          $this->Cell($w[6],6,'$ '.number_format($datos['rows']->entities[$iD]->balance,2) );
          $this->Cell($w[7],6,'$ '.number_format($datos['rows']->entities[$iD]->warrantyBalance,2) );
          $this->Cell($w[8],6,'$ '.number_format($datos['rows']->entities[$iD]->customerNetworkBalance,2) );
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

$pdf = new PDF('L','mm',array(480,300));
// Títulos de lasPcolumnas
$header = array('ID','Nombre','Cuenta Clabe','Cuenta virtual','Email','Teléfono','Saldo Principal','Saldo Garantia','Saldo Pendiente');
// Carga de datos
//$data = $pdf->LoadData('paises.txt');
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('DetalleSaldo_'.$today_hora);
$pdf->AddPage();
$pdf->ImprovedTable($header);
$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output('I','DetalleSaldo_'.$today_hora,true);

?>