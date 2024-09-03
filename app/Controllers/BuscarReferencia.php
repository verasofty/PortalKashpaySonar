<?php

namespace App\Controllers;

class BuscarReferencia extends BaseController{
	
	public function index(){
		if (session('idUser') != '') {
			$curlToken = curl_init();

			curl_setopt_array($curlToken, array(
			  CURLOPT_URL => WS_AUTHENTICATE.'authenticate',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
			    "entity": "'.AUTH_ENTITY.'",
			    "password": "'.AUTH_PASSWORD.'",
			    "user": "'.AUTH_USER.'"
			  }',
			  CURLOPT_HTTPHEADER => array(
			  	'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));

			$responseToken = curl_exec($curlToken);

			curl_close($curlToken);

			$datos = array('auth_token'=>json_decode($responseToken));

			return view('buscarReferencia/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}
	public function searchReference(){
		$myId = explode('SUB', session('entitySonID'));
		//$myId = '"PROVV0011712091"';
		$fechaOpe = date('Ymd');
		//$fechaOpe = '211221';
		//var_dump($myId);211221
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  //CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/searchReference',
		  CURLOPT_URL => WS_REFERENCE.'searchReference',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "alphanumericReference": "'.$myId[1].'",
		    "referenceCreatedPayment": "'.$_POST['referencia'].'",
		    "dateTransaction": "'.$fechaOpe.'"
		  }',
		  CURLOPT_HTTPHEADER => array(
		  	'Content-Type: application/json',
		  	"Entity-i: com.onsigna",
		    'Authorization: Bearer '.$_POST['token']
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		/*echo '{
		    "alphanumericReference": "'.$myId[1].'",
		    "referenceCreatedPayment": "'.$_POST['referencia'].'",
		    "dateTransaction": "'.$fechaOpe.'"
		  }';*/


		if ($response != null) {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= 'No se encontraron resultados';
			$datos['success'] = '0';
		}

		echo json_encode($datos);

	}

	public function pagarReferencia(){
		$myId = explode('SUB', session('entitySonID'));
		$fechaOpe = date('Ymd');

		//ar_dump($_POST);

		$curlToken = curl_init();

			curl_setopt_array($curlToken, array(
			  CURLOPT_URL => WS_AUTHENTICATE.'authenticate',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
			    "entity": "'.AUTH_ENTITY.'",
			    "password": "'.AUTH_PASSWORD.'",
			    "user": "'.AUTH_USER.'"
			  }',
			  CURLOPT_HTTPHEADER => array(
			  	'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));

			$responseToken = json_decode(curl_exec($curlToken));

			curl_close($curlToken);


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  //CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/searchReference',
		  CURLOPT_URL => WS_REFERENCE.'createOrder',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idEntity": '.$myId[1].',
		    "typeTransaction": 20,
		    "numericReference": "'.$_POST['numericReference'].'",
		    "referenceCreatedPayment": "'.$_POST['referenceCreatedPayment'].'",
		    "dateTransaction": "'.$fechaOpe.'"
		  }',
		  CURLOPT_HTTPHEADER => array(
		  	'Content-Type: application/json',
		  	"Entity-i: com.onsigna",
		    'Authorization: Bearer '.$responseToken->authenticationResponse->token
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		if ($response != null) {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= 'No se encontraron resultados';
			$datos['success'] = '0';
		}

		echo json_encode($datos);
	}

}