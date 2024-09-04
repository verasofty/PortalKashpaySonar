<?php

namespace App\Controllers;

class AddLinkPago extends BaseController{
	
	public function index(){
     $key = "";
		    $pattern = "1234567890";
		    $max = strlen($pattern)-1;
		    for($i = 0; $i < 6; $i++){
		        $key .= substr($pattern, mt_rand(0,$max), 1);
		    }
		$datos = array('referencia'=> $key);
		return view('addLinkPago/index', $datos);
	}

	public function addLink(){
		$fecha = date_create();
	    //Windows
        $url = 'C:/xampp/htdocs/adquirencia2/public/assets/img/logos_pagos/';
        //$url = "/var/www/html/adquirencia/public/assets/img/logos_pagos/";
        $urlCallback = 'https://www.google.com';
         $_POST['monto']= str_replace(',','',$_POST['monto']);  

        $logoImg = $_FILES["logo"];

        //var_dump($logoImg);

       /* if ($logoImg['name'] != null) {
            $tmp_name = $logoImg["tmp_name"];
            $name = $logoImg["name"];
            $newfilename = $_POST['referencia'].'.jpg';
            $logoImg["name"] = $newfilename;
            $ruta_img = $url.$newfilename;

            //$move = move_uploaded_file($tmp_name, $ruta_img);
            $move =move_uploaded_file($_FILES['logo']['tmp_name'], $ruta_img);
           
            //Windows
            $urlImage = base_url().'/public/assets/img/logos_pagos/'.$newfilename;

            //Ubuntu
            //$urlImage = base_url().str_replace("/var/www/kashportal/kashpay/", "", $ruta_img);
            
        }else{
            //Windows*/
            $urlImage = base_url().'/public/assets/img/logos_pagos/comercio_default.png';

            //Ubuntu
            //$urlImage = base_url().'uploads/comercio_default.png';            
        //}

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
				"user" : "'.$_POST['email'].'",
				"amount": '.$_POST['monto'].',   
          		"retrievalReferenceCode": "'.date_timestamp_get($fecha).'",
			    "currency": "484",
				"sirioId" : "'.$_POST['entitySonID'].'",
				"otherAmount" : 0.00,
				"orderingAccount" : "'.$_POST['cuentaSession'].'",
				"payment_type" :1,
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
					"expiration": "'.$_POST['fechaVig'].' '.$_POST['horario'].'",
					"urlCallback": "'.$urlCallback.'",
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
