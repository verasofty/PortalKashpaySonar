<?php

namespace App\Controllers;

class AddBotonpago extends BaseController{
	
	public function index(){
     	return view('addBotonpago/index');
	}

	public function searchLink(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => WS_KASPAYSERVICES.'/KashPay/v2/checkout/'.$_POST['referencia'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'AuthorizationToken: Bearer 1234345'
		),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);

		$datos['rows']= json_decode($response);
		echo json_encode($datos);

    
	}
}
