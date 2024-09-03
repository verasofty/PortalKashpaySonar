<?php

namespace App\Controllers;

class AddPrepago extends BaseController{
	
	public function index(){
     	$key = "";
		$pattern = "1234567890";
		$max = strlen($pattern)-1;
		for($i = 0; $i < 6; $i++){
			$key .= substr($pattern, mt_rand(0,$max), 1);
		}
		$datos = array('referencia'=> $key);
		return view('addPrepago/index', $datos);
	}

	public function addLink(){
		$fecha = date_create();
		$fecha_actual = date("d-m-Y");
		$fecha_actual = date("HH:mm:ss");

	    //Windows
        $url = 'C:/xampp/htdocs/adquirencia2/public/assets/img/logos_pagos/';
        //$url = "/var/www/html/adquirencia/public/assets/img/logos_pagos/";
        $urlCallback = 'https://www.google.com';
         $_POST['monto']= str_replace(',','',$_POST['monto']);  
      
		$urlImage = base_url().'/public/assets/img/logos_pagos/comercio_default.png';

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  	CURLOPT_URL => WS_KASPAYSERVICES.'/KashPay/v2/processTransaction',
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => '',
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 0,
		  	CURLOPT_FOLLOWLOCATION => true,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => 'POST',
		  	CURLOPT_POSTFIELDS =>'{
			    "messageType" : 88,
				"posEntryMode": 6,
				"user" : "'.$_POST['email'].'",
				"amount": '.$_POST['monto'].',   
          		"retrievalReferenceCode": "'.date_timestamp_get($fecha).'",
				"reference_payment" : "'.$_POST['nombre'].'",
			    "currency": "484",
				"sirioId" : "'.$_POST['entitySonID'].'",
				"otherAmount" : 0.00,
				"orderingAccount" : "'.$_POST['cuentaSession'].'",
				"payment_type" :2,
			    "customerInfo": {
				    "firstName": "'.$_POST['nombre'].'",
				    "lastName": "'.$_POST['apaterno'].'",
				    "middleName": "'.$_POST['amaterno'].'",
				    "email": "'.$_POST['email'].'",
				    "phone1": "'.$_POST['tel'].'" 
			    },
				"payInfo": {
					"unique": true,
					"reference": "'.$_POST['referencia'].'",
					"description": "'.$_POST['concepto'].'",
					"response": true,
					"expiration": "'.date("d-m-Y",strtotime($fecha_actual."+ 1 week")).' 00:00",
					"urlCallback": "",
			    	"urlImage": "'.$urlImage.'"
				}
			}',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer 1234345',
		    'Content-Type: application/json'
		  ),
		));	

		$response = curl_exec($curl);

		curl_close($curl);

		$datos = array('rows'=>json_decode($response));
		echo json_encode($datos);
	}
}
