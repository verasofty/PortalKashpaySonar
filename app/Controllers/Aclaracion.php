<?php

namespace App\Controllers;

class Aclaracion extends BaseController{
	
	public function index(){
		if (session('idRol') == 2 || session('idRol') == 3 || session('entitySonID') == 'SUB981645') {
			return view('aclaracion/index');
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function searchMotivo($type){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/clarification/getClarificationCatalog?idTransactionType='.$type,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=A58782BB5F83A4A77F3D2E07BD078C72'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		if ($response != '[]') {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= 'No se encontraron resultados';
			$datos['success'] = '0';
		}

		echo json_encode($datos);
	}

	public function add(){
		//var_dump($_FILES['evidencia']);
		if ($_POST['tipo'] != 'DP') {
			$monto = $_POST['montoHidden'];
		}else{
			$monto = $_POST['monto'];
		}

		$amount2=str_replace(',','',$monto);  

		$fileEvi = '';
		    
		if (!empty($_FILES['evidencia']['tmp_name'][0])) {
			$fileEvi .= ',"files": [';

			for ($iEvi=0; $iEvi < count($_FILES['evidencia']) ; $iEvi++) { 
				if (!empty($_FILES['evidencia']['tmp_name'][$iEvi])) {
					$path = $_FILES['evidencia']['tmp_name'][$iEvi];
					$type = pathinfo($path, PATHINFO_EXTENSION);
					$data = file_get_contents($path);
					$base64 =  base64_encode($data);
					$fileEvi .= '"'.$base64.'",';
				}
			}

			$fileEvi = substr($fileEvi, 0, -1);
			//echo $cadena; //retorna 1,5,9,6,8
			
			$fileEvi .= ']';
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/clarification/saveClarification',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idOperation": "'.$_POST['idOperation'].'",
		    "idTransactionType": "'.$_POST['tipo'].'",
		    "idCatClarification": '.$_POST['motivo'].',
		    "authorizationPan": "'.$_POST['card'].'",
		    "amount": '.$amount2.',
		    "observations": "'.$_POST['observaciones'].'",
		    "lastUserModify": "'.session('idUser').'",
		    "idTerminalUser": '.$_POST['tuuser'].',
		    "authNumber": "'.$_POST['authorizationNumber'].'",
		    "retrievalReferenceCode": "'.$_POST['authorizationRrcext'].'"
		    '.$fileEvi.'
		  }',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Basic YWRtaW46c2VjcmV0'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$datos = array('rows'=>json_decode($response));
		echo json_encode($datos);
		//var_dump($response);
	}
 

	public function addEvidencia(){

		$fileEvi = '';
		    
		if (!empty($_FILES['evidenciaSa']['tmp_name'][0])) {
			$fileEvi .= ',"files": [';

			for ($iEvi=0; $iEvi < count($_FILES['evidenciaSa']) ; $iEvi++) { 
				if (!empty($_FILES['evidenciaSa']['tmp_name'][$iEvi])) {
					$path = $_FILES['evidenciaSa']['tmp_name'][$iEvi];
					$type = pathinfo($path, PATHINFO_EXTENSION);
					$data = file_get_contents($path);
					$base64 =  base64_encode($data);
					$fileEvi .= '"'.$base64.'",';
				}
			}

			$fileEvi = substr($fileEvi, 0, -1);
			//echo $cadena; //retorna 1,5,9,6,8
			
			$fileEvi .= ']';
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/clarification/updateClarification',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS =>'{
			"idClarification": '.$_POST['idClarification'].',
    		"idOperation": "'.$_POST['idOperation'].'"'.
			$fileEvi.
		'}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Basic YWRtaW46c2VjcmV0'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;


	}
}
