<?php

namespace App\Controllers;

class Internacional extends BaseController{
	
	public function index(){
		$curl_usa = curl_init();

		curl_setopt_array($curl_usa, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/contact/getContacts?idUser='.session('idUser').'&type=TR_INT',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=4e41529996b751bd88ef3c81ff33'
		  ),
		));

		$response_usa = curl_exec($curl_usa);

		curl_close($curl_usa);
   
   
   if (session('idRol') == 2) {
			$idcontext = 0;
			$contexCombo = '';
		}else{
			//$idcontext = session('idcontextResponse')[0];
			$contexCombo = session('entitySonID');
		}
   
   $curl_cuentas = curl_init();

		curl_setopt_array($curl_cuentas, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/getConcentratorAccounts?sirioId='.session('entitySonID'),
	    CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic YWRtaW46c2VjcmV0',
        'Cookie: JSESSIONID=721e177c735e9cd50092cea864dd'
      ),
		));

		$response_cuentas = curl_exec($curl_cuentas);

		curl_close($curl_cuentas);
   


		$datos = array('contactosUsa'=>json_decode($response_usa),'cuentas'=>json_decode($response_cuentas));

		if (session('idUser')) {
			return view('internacional/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}

		
	}

	public function makeSpei(){
		//if ($_POST['referencia'] == '') {
			$keyR = "";
		    $patternR = "1234567890";
		    $maxR = strlen($patternR)-1;
		    for($iR = 0; $iR < 6; $iR++){
		        $keyR .= substr($patternR, mt_rand(0,$maxR), 1);
		    }
		    
			$_POST['referencia'] = $keyR;
		//}
		$key = "";
	    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
	    $max = strlen($pattern)-1;
	    for($i = 0; $i < 6; $i++){
	        $key .= substr($pattern, mt_rand(0,$max), 1);
	    }

	    $type = 1;
		if ($_POST['idIns'] == 40903) {
			$type = 4;
		}

		$refalfa = $key;

		$amount=$_POST['monto'];
		$amount2=str_replace(',','',$amount);  

		$curl = curl_init();

		if (session('idRol') == 1) {
			$entity = 'com.onsigna';
		}else{
			$entity = session('entitySonID');
		}

		$dateSpei = date('ymd');
   
	   if($_POST['accountNumber'] == '0'){
	     $_POST['accountNumber'] = $_POST['cuenta'];
	   }
	    /*echo '{ 
	      "type":58, 
	      "amount":'.$amount2.', 
	      "currency":{"id":484},
	       "numericReference":"'.$_POST['referencia'].'", 
	       "alphanumericReference":"'.$refalfa.'", 
	       "targetName":"'.$_POST['titular'].'", ';
	       /*"targetID":"'.$_POST['cuenta'].'", 
	       "target_origin_ID":"'.$entity.'", 
	       "targetIDCode":"'.$_POST['idIns'].'", 
	       "targetEmail":"support@onsigna.com", 
	       "description": "'.$_POST['concepto'].'", 
	       "observation": "'.session('mail').'", 
	       "status":0, 
	       "citi":false, 
	       "credit":false 
	       }';*/

		curl_setopt_array($curl, array(
	      CURLOPT_URL => WS_SALDOS.'/Entities/entities/'.$entity.'/operations',
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => '',
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 0,
	      CURLOPT_FOLLOWLOCATION => true,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => 'POST',
	      CURLOPT_POSTFIELDS =>'{ 
	      "type":58, 
	      "amount":'.$amount2.', 
	      "currency":{"id":484},
	       "numericReference":"'.$_POST['referencia'].'", 
	       "alphanumericReference":"'.$refalfa.'", 
	       "targetName":"'.$_POST['titular'].'", 
	       "targetID":"'.$_POST['cuenta'].'", 
	       "target_origin_ID":"'.$entity.'", 
	       "targetIDCode":"'.$_POST['idIns'].'", 
	       "targetEmail":"support@onsigna.com", 
	       "description": "'.$_POST['concepto'].'", 
	       "observation": "'.session('mail').'", 
	       "status":0, 
	       "citi":false, 
	       "credit":false 
	       }',
	      CURLOPT_HTTPHEADER => array(
	        'Content-Type: application/json'
	      ),
	    ));

		$response = curl_exec($curl);

		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		//var_dump($response);
		curl_close($curl);
		if ($httpcode == 200) {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= json_decode($response);
			$datos['success'] = '0';
		}
		
		echo json_encode($datos);
	}


	/*
	*USA* 
	*/

	public function addContactoUSA(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/contact',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
				"idUser": '.session('idUser').',
			    "nameAlias": "'.$_POST['alias'].'",
			    "cardNumberMask": "'.$_POST['cuenta'].'",
			    "numberPhone": "'.$_POST['tel'].'",
			    "typeRegister": "TR_INT",
			    "email": "'.$_POST['email'].'",
			    "typeTransfer": 0,
			    "fullName": "'.$_POST['titular'].'",
			    "nameInstitution": "'.$_POST['nameIns'].'",
			    "idInstitution": 0,
			    "typeAccount": "",
			    "razonSocial": "",
			    "intenationalCode": "'.$_POST['institucion'].'",
			    "street": "'.$_POST['calle'].'",
			    "exteriorNumber": "'.$_POST['numExt'].'",
			    "interiorNumber": "'.$_POST['numInt'].'",
			    "city": "'.$_POST['ciudad'].'",
			    "state": "'.$_POST['estado'].'",
				"postalCode": "'.$_POST['cp'].'",
				"accountNumber": "0",
				"aditionalData": {
					"addressBank": {
						"street": "'.$_POST['calleB'].'",
						"exteriorNumber": "'.$_POST['numExtB'].'",
						"interiorNumber": "'.$_POST['numIntB'].'",
						"city": "'.$_POST['ciudadB'].'",
						"state": "'.$_POST['estadoB'].'",
						"postalCode": "'.$_POST['cpB'].'"
					},
					"aditionalReferences": [
						"'.$_POST['numRefB'].'",
						"'.$_POST['refAdiB'].'",
						"'.$_POST['descAdiB'].'"
					],
					"destinationCountry": "'.$_POST['paisDes'].'",
					"intermediaryBank": "'.$_POST['bancoInter'].'"
				}
			}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=682e962f1e168b18cb178da87f7a'
			  ),
			));
		

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		//var_dump($response);

		echo json_encode($response);
	}
	public function searchInstitucionUSA(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/bank/getBySwiftOrBicCode/'.$_POST['swift'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=682e962f1e168b18cb178da87f7a'
		  ),
		));

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		echo json_encode($response);
	}

	public function searchLocalidad($cp){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/canis/getZipCodeInfo/'.$cp,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=b82dc652615ec27836e331bb2320'
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

	public function tipoCambio($monto){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/bank/getCurrencyExchange',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=5efe90cebf4791ca8d0f450da51b'
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

}
