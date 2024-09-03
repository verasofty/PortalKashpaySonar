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
header("Content-Disposition: attachment; filename=Operaciones-".$today_hora.".xls");

/*
$location = curl_escape($curl, $_GET['dateInit']);
$location2 = curl_escape($curl, $_GET['dateFinish']);

$urlServices =WS_SALDOS.'/Entities/entities/'.session('entitySonID').'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE.'&dateInit='.$location.'&dateFinish='.$location2;

echo $urlServices;

//http://44.199.131.117/Entities/entities/SUB165/getoperationbytypeandstatuscustom?type=1&status=3&page=0&size=10&dateInit=2022-07-03%2000%3A00&dateFinish=2022-10-19%2000%3A00
*/
$myString = substr($_GET['name'], 0, -1);
$porciones_status = explode(",",$myString );
$porciones_statusurl = explode(",",$_GET['status'] );

$curl = curl_init();

$location = curl_escape($curl, $_GET['dateInit']);
$location2 = curl_escape($curl, $_GET['dateFinish']);

$urlServices ='http://44.199.131.117/Entities/entities/'.$_GET['id'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page=&size='.$_GET['size'].'&dateInit='.$location.'&dateFinish='.$location2;

//echo $urlServices;

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://44.199.131.117/Entities/entities/'.$_GET['id'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page=&size='.$_GET['size'].'&dateInit='.$location.'&dateFinish='.$location2,
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
//var_dump($datos['rows']);
$html = '<table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead class="bg-dark">
                      <tr>
                        <th class="va-m">Id</th>
                            <th class="va-m">Tipo</th>
                            <th class="va-m">Monto</th>
                            <th class="va-m">Estatus</th>
                            <th class="va-m">Descripción</th>
                            <th class="va-m">observación</th>
                            <th class="va-m">Fecha</th>
                            <th class="va-m">Codigo de Respuesta</th>
                            <th class="va-m">Referencia numerica</th>
                            <th class="va-m">Referencia Alfanumerica</th>
                            <th class="va-m">Nombre del Destinatario</th>
                            <th class="va-m">Id Destinatario</th>
                            <th class="va-m">targetIDCode</th>
                            <th class="va-m">targetEmail</th>
                            <th class="va-m">Referencia</th>
                            <th class="va-m">Usuario</th>
                      </tr>
                    </thead>
                    <tbody id="rowsTrasnsacciones">';
                    

for ($i=0; $i < count($datos['rows']->operations) ; $i++) { 
  $porciones_fecha = explode("T", $datos['rows']->operations[$i]->createdAt);
  $porciones_fecha2 = explode(".", $porciones_fecha[1]);
  for ($j=0; $j < count($porciones_status) ; $j++) { 
    if (in_array($datos['rows']->operations[$i]->status, $porciones_statusurl)) {
      $estatusSelect = $porciones_status[$j]; 
    }
  }
	$html .=  '<tr>
                <td>'.$datos['rows']->operations[$i]->id.'</td>
                <td>'.$datos['rows']->operations[$i]->descriptionType.'</td>
                <td>$ '.number_format($datos['rows']->operations[$i]->amount,2).'</td>
                <td>'.$estatusSelect.'</td>
                <td>'.$datos['rows']->operations[$i]->description.'</td>
                <td>'.$datos['rows']->operations[$i]->observation.'</td>
                <td>'.$porciones_fecha[0].' '.$porciones_fecha2[0].'</td>
                <td>'.$datos['rows']->operations[$i]->responseCode.'</td>
                <td>'.$datos['rows']->operations[$i]->numericReference.'</td>
                <td>'.$datos['rows']->operations[$i]->alphanumericReference.'</td>
                <td>'.$datos['rows']->operations[$i]->targetName.'</td>
                <td>'.$datos['rows']->operations[$i]->targetID.'</td>
                <td>'.$datos['rows']->operations[$i]->targetIDCode.'</td>
                <td>'.$datos['rows']->operations[$i]->targetEmail.'</td>
                <td>'.$datos['rows']->operations[$i]->internalReference.'</td>
                <td>'.$datos['rows']->operations[$i]->internalReference.'</td>
              </tr>';
}

$html .= '</tbody>
                  </table>';

echo $html;
?>