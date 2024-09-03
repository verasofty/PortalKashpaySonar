<?php

namespace App\Controllers;

class Liquidacion extends BaseController{
	
	public function index(){
        return view('liquidacion/index');

    }
public function searchOperations(){


    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL =>WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?idContext=147&idEntity=0&idTerminal=0&idTerminalUser=0&typeOperation=&amount=&responseCode=&referenceNumber=&authorizationNumber=&bin=&startDate=&endDate=',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic YWRtaW46c2VjcmV0',
        'Cookie: JSESSIONID=76e6bf81b9bf5d29e3c0a3d36a26'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $datos["rows"] = json_decode($response);
    $datos["success"] = 1;
    echo (json_encode($datos));
    
}
}