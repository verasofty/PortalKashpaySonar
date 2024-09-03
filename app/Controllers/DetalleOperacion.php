<?php

namespace App\Controllers;

class DetalleOperacion extends BaseController{
	
	public function index(){
        return view('detalleOperacion/index.php');

    }

    public function getDetalle($validate){
    	$curl = curl_init();

    	curl_setopt_array($curl, array(
            CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?liquidationID='.$validate.'&idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser'),
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

    //echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?liquidationID='.$validate.'&idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser');
		
		$datos['rows']= json_decode($response);
		echo json_encode($datos);
    }

}