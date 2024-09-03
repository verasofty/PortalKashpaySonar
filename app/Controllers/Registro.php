<?php

namespace App\Controllers;

class Registro extends BaseController{
	
	public function index(){
		return view('registro/index');
	}

	public function registrar(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idContext": 34,
		    "nameCommerce": "'.$_POST['nombre'].'",
		    "phoneNumber": "'.$_POST['tel'].'",
		    "email": "'.$_POST['email'].'",
		    "assignClabeAccount": true,
		    "password": "'.$_POST['contrasena'].'",
		    "environment": "http://kashplataforma.com.mx/"
		}
		',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Basic YWRtaW46c2VjcmV0'
		  ),
		));

		$response = curl_exec($curl);

		//var_dump($response);
		$datos = array('rows'=>json_decode($response));

		curl_close($curl);

		echo json_encode($datos);

	}
}
