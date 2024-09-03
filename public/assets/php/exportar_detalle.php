<?php
$today_hora = date("Y-m-d H:i:s"); 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=DetalleSaldos-".$today_hora.".xls");

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
//var_dump($datos['rows']);
$html = '<table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead class="bg-dark">
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cuenta clabe</th>
                        <th>Cuenta virtual</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Saldo Principal</th>
                        <th>Saldo Garantia</th>    
                        <th>Saldo Pendiente</th>
                      </tr>            
                    </thead>
                    <tbody id="rowsTrasnsacciones">';
                    

                  for ($iD=0; $iD < count($datos['rows']->entities); $iD++) {   

                    $html .= '<tr>
                            <td>'.$datos['rows']->entities[$iD]->id.'</td>
                            <td>'.$datos['rows']->entities[$iD]->name.'</td>
                            <td>'.$datos['rows']->entities[$iD]->clabeAccount.'</td>
                            <td>'.$datos['rows']->entities[$iD]->virtualAccount.'</td>
                            <td>'.$datos['rows']->entities[$iD]->email.'</td>
                            <td>'.$datos['rows']->entities[$iD]->phoneNumber.'</td>
                            <td>$ '.number_format($datos['rows']->entities[$iD]->balance, 2).'</td>
                            <td>$ '.number_format($datos['rows']->entities[$iD]->warrantyBalance,2).'</td>
                            <td>$ '.number_format($datos['rows']->entities[$iD]->customerNetworkBalance,2).'</td>
                          </tr>';
                  }

$html .= '</tbody>
                  </table>';

echo $html;
?>