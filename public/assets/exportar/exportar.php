<?php
$today_hora = date("Y-m-d H:i:s"); 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
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

$urlServices =$_GET['urlRep'].'/Entities/entities/'.$_GET['id'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page=&size='.$_GET['size'].'&dateInit='.$location.'&dateFinish='.$location2;

//echo $urlServices;

curl_setopt_array($curl, array(
    CURLOPT_URL => $_GET['urlRep'].'/Entities/entities/'.$_GET['id'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page=&size='.$_GET['size'].'&dateInit='.$location.'&dateFinish='.$location2,
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
                            <th class="va-m">Fecha</th>
                            <th class="va-m">Codigo de Respuesta</th>
                            <th class="va-m">Referencia numerica</th>
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
                          </tr>
                        </thead>
                    <tbody id="rowsTrasnsacciones">';
                    

                    for ($i=0; $i < count($datos['rows']->operations) ; $i++) { 
                            //2022-08-31T01:17:56.739+0000
                            $estatusSelect='';
                            $porciones_fecha = explode("T", $datos['rows']->operations[$i]->createdAt);
                            $porciones_fecha2 = explode(".", $porciones_fecha[1]);

                            switch ($datos['rows']->operations[$i]->status) {
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
                                      <td>'.$datos['rows']->operations[$i]->id.'</td>
                                      <td>'.$datos['rows']->operations[$i]->descriptionType.'</td>
                                      <td>$ '.number_format($datos['rows']->operations[$i]->amount,2).'</td>
                                      <td>'.$estatus.'</td>
                                      <td>'.$datos['rows']->operations[$i]->description.'</td>
                                      <td>'.$porciones_fecha[0].' '.$porciones_fecha2[0].'</td>
                                      <td>'.$datos['rows']->operations[$i]->responseCode.'</td>
                                      <td>'.$datos['rows']->operations[$i]->numericReference.'</td>
                                      <td>'.$datos['rows']->operations[$i]->alphanumericReference.'</td>
                                      <td>'.$datos['rows']->operations[$i]->targetName.'</td>
                                      <td>'.$datos['rows']->operations[$i]->targetID.'</td>
                                      <td>'.$datos['rows']->operations[$i]->targetIDCode.'</td>
                                      <td>'.$datos['rows']->operations[$i]->targetEmail.'</td>
                                      <td>'.$datos['rows']->operations[$i]->internalReference.'</td>
                                      <td>'.$datos['rows']->operations[$i]->externalReference.'</td>
                                      <td>'.$datos['rows']->operations[$i]->transactionBundler.'</td>
                                      <td>'.$datos['rows']->operations[$i]->observation.'</td>
                                      <td>'.$datos['rows']->operations[$i]->targetName.'</td>
                                      
                                      <td>';
                             
                              $html.='</td>
                                    </tr>';
                          }

$html .= '</tbody>
                  </table>';

echo $html;
?>