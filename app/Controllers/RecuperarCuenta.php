<?php

namespace App\Controllers;

class RecuperarCuenta extends BaseController{
	
	public function index(){
		return view('recuperarCuenta/index');
	}

	public function updatePassword() {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/user/updatePassword',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'PUT',
		  CURLOPT_POSTFIELDS =>'{
			"guid":"'.$_POST['guid'].'",
			"tuPassword": "'.$_POST['contrasena'].'"
		}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=ccc03bb85d66a6037878f6eb8ad9'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$datos['rows']= json_decode($response);
		echo json_encode($datos);
	}
	
}
