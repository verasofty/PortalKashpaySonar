<?php

namespace App\Controllers;

class Speiadmin extends BaseController{
	
	public function index(){

		$curl = curl_init();
		$curl_usa = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/contact/getContacts?idUser='.session('idUser').'&type=TR',
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

		

		$response = curl_exec($curl);
		$response_usa = curl_exec($curl_usa);

		curl_close($curl);
		curl_close($curl_usa);

		$datos = array('contactos'=>json_decode($response),'contactosUsa'=>json_decode($response_usa));

		if (session('idUser')) {
			return view('speiadmin/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}

		
	}

	public function searchInstitucion(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getInstitutions?value='.$_POST['cuenta'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		echo json_encode($response);
		/*$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/institutions/getInstitutions?value='.$_POST['cuenta'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=2adf3ac3b6df0015dd95fa60b0cc'
		  ),
		));

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		echo json_encode($response);*/
	}

	public function addContacto(){;

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
		    "numberPhone": "ND",
		    "typeRegister": "TR",
		    "email": "ND",
		    "typeTransfer": 1,
		    "fullName": "'.$_POST['titular'].'",
		    "nameInstitution": "'.$_POST['nameIns'].'",
		    "idInstitution": '.$_POST['idIns'].',
		    "typeAccount": "",
		    "razonSocial": "",
		    "accountNumber": "'.$_POST['accountNumber'].'"
		}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Basic YWRtaW46c2VjcmV0'
		  ),
		));

		

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		//var_dump($response);

		echo json_encode($response);
	}


	public function makeSpei(){
		if ($_POST['referencia'] == '') {
			$key = "";
		    $pattern = "1234567890";
		    $max = strlen($pattern)-1;
		    for($i = 0; $i < 6; $i++){
		        $key .= substr($pattern, mt_rand(0,$max), 1);
		    }
		    
			$_POST['referencia'] = $key;
		}
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
   
	   if($_POST['accountNumber'] == 0){
	     $_POST['accountNumber'] = $_POST['cuenta'];
	   }

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
	      "type":'.$type.', 
	      "amount":'.$amount2.', 
	      "currency":{"id":484},
	       "numericReference":"'.$_POST['referencia'].'", 
	       "alphanumericReference":"'.$refalfa.'", 
	       "targetName":"'.$_POST['titular'].'", 
	       "targetID":"'.$_POST['accountNumber'].'", 
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
				"idContext": '.session('idContext').',
				"idEntities": '.session('idEntity').',
				"idTerminal": '.session('idTerminal').',
			    "idTerminalUser": '.session('idTerminalUser').',
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
			    "aditionalReference": "'.$_POST['refAdi'].'",
			    "postalCode": "'.$_POST['cp'].'",
			    "city": "'.$_POST['ciudad'].'",
			    "state": "'.$_POST['estado'].'"
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
