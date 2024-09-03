<?php

namespace App\Controllers;

class Segmento extends BaseController{
	
	public function index(){
     	return view('segmento/index');
	}

	public function addSegmento(){
     
		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_URL => URL_SERVICES.'/AldebaranServices/affiliation',
		    CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => '',
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 0,
	      CURLOPT_FOLLOWLOCATION => true,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => 'POST',
	      CURLOPT_POSTFIELDS =>'{
            "bussinesName": "'.$_POST['bussinesName'].'",
            "bussinesNameShort": "'.$_POST['bussinesNameShort'].'",
            "applicationBundle": "'.$_POST['applicationBundle'].'",
            "fatherId": "'.$_POST['fatherId'].'",
            "type": 7,
            "assignClabeAccount": false
        }',
	      CURLOPT_HTTPHEADER => array(
	        'Content-Type: application/json'
	      ),
    ));
		
		$response = curl_exec($curl);
		
		curl_close($curl);

		$datos['rows']= json_decode($response);
		echo json_encode($datos);

    
	}
}
