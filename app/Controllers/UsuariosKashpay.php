<?php

namespace App\Controllers;

class UsuariosKashpay extends BaseController{
	
	public function index(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/getGiros',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$curl_subafiliado = curl_init();

		if (session('idRol') == 2) {
			curl_setopt_array($curl_subafiliado, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/subAffiliation/getAll',
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
		}else{
			curl_setopt_array($curl_subafiliado, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/subAffiliation/getById?idSubAffiliation='.session('idContext'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));
		}

		$response_subafiliado = curl_exec($curl_subafiliado);

		curl_close($curl_subafiliado);

		$curl_regimenFiscal = curl_init();

		curl_setopt_array($curl_regimenFiscal, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/fiscalRegimes/getAll',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=790BD80086F44AA07F3AB7BB1C6ABAC3'
		  ),
		));

		$response_regimenFiscal = curl_exec($curl_regimenFiscal);

		curl_close($curl_regimenFiscal);

		$datos = array('giros'=>json_decode($response), 'subafiliados'=>json_decode($response_subafiliado), 'regimenFiscal'=>json_decode($response_regimenFiscal));
		//var_dump($datos);

		//if (session('idRol') == 2) {
			return view('usuariosKashpay/index',$datos);
		/*}else{
			return redirect()->to(base_url().'/');
		}*/
	}

	public function searchLocalidad($cp){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/localidades/'.$cp,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'catLocalidadesServiceImpl: ',
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=DD02876BF805B5465F3308E8DEE27698'
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

	public function registrar(){

		$arrayRep2 = array();
		$arrayCom2 = array();
		$arraySop2 = array();
		$arrayFin2 = array();
		$arrayContactos2 = array();
		$arrayContactos = '';
		$vacioCont = 0;
		$diasCom = '';
		$diasFin ='';
		$diasSop = '';

		//$tasa = ($_POST['tasa']*100);

		
		if ($_POST['nombreRep'] != "") {
			$vacioCont = $vacioCont+1;

		    $arrayRep2 = [
		    		"type" => 1,
		            "name" => $_POST['nombreRep'],
		            "paternalSurname" => $_POST['aPaternoRep'],
		            "maternalSurname" => $_POST['aMaternoRep'],
		            "phoneNumber" => $_POST['telRep'],
		            "additionaPhoneNumber" => $_POST['telAdiRep'],
		            "email" => $_POST['emailRep'],
		            "address" => array (
		                "street" => $_POST['calleRep'],
		                "exteriorNumber" => $_POST['numExtRep'],
		                "interiorNumber" => $_POST['numIntRep'],
		                "idLocation" => $_POST['colRep']
		            )
		    ];

		    array_push($arrayContactos2, $arrayRep2);
		}
		if ($_POST['nombreFin'] != "") {
			$vacioCont = $vacioCont+1;
			if (isset($_POST['diasF'])) {
				for ($ifin=0; $ifin < count($_POST['diasF']) ; $ifin++) { 
					$diasFin .= $_POST['diasF'][$ifin].'|';
				}
				$diasFin = substr($diasFin, 0, -1);
			}	
			

	        $arrayFin2 = [
		    	"type" => 4,
	            "name" => $_POST['nombreFin'],
	            "paternalSurname" => $_POST['aPaternoFin'],
	            "maternalSurname" => $_POST['aMaternoFin'],
	            "phoneNumber" => $_POST['telFin'],
	            "additionaPhoneNumber" => $_POST['telAdiFin'],
	            "email" => $_POST['emailFin'],
	            "startTime" => $_POST['inicioFin'],
	            "endTime" => $_POST['finFin'],
	            "days" => $diasFin
		    ];
		    
		    array_push($arrayContactos2, $arrayFin2);
		}
		if ($_POST['nombreCom'] != "") {
			$vacioCont = $vacioCont+1;

			if (isset($_POST['diasC'])) {
				for ($icom=0; $icom < count($_POST['diasC']) ; $icom++) { 
					$diasCom .= $_POST['diasC'][$icom].'|';
				}
				$diasCom = substr($diasCom, 0, -1);
			}	
			
	        $arrayCom2 = [
		    	"type" => 2,
	            "name" => $_POST['nombreCom'],
	            "paternalSurname" => $_POST['aPaternoCom'],
	            "maternalSurname" => $_POST['aMaternoCom'],
	            "phoneNumber" => $_POST['telCom'],
	            "additionaPhoneNumber" => $_POST['telAdiCom'],
	            "email" => $_POST['emailCom'],
	            "startTime" => $_POST['inicioCom'],
	            "endTime" => $_POST['finCom'],
	            "days" => $diasCom
		    ];
		    array_push($arrayContactos2, $arrayCom2);
		}
		if ($_POST['nombreSop'] != "") {
			$vacioCont = $vacioCont+1;
			if (isset($_POST['diasS'])) {
				for ($iSop=0; $iSop < count($_POST['diasS']) ; $iSop++) { 
					$diasSop .= $_POST['diasS'][$iSop].'|';
				}
				$diasSop = substr($diasSop, 0, -1);
			}	
			
	        $arraySop2 = [
		    	"type" => 3,
	            "name" => $_POST['nombreSop'],
	            "paternalSurname" => $_POST['aPaternoSop'],
	            "maternalSurname" => $_POST['aMaternoSop'],
	            "phoneNumber" => $_POST['telSop'],
	            "additionaPhoneNumber" => $_POST['telAdiSop'],
	            "email" => $_POST['emailSop'],
	            "startTime" => $_POST['inicioSop'],
	            "endTime" => $_POST['finSop'],
	            "days" => $diasSop
		    ];
		    array_push($arrayContactos2, $arraySop2);
		}
		
		if ($vacioCont > 0 ) {
			$arrayContactos .= ',"contacts": '.json_encode($arrayContactos2);
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idContext": '.$_POST['safiliacion'].',
		    "nameCommerce": "'.$_POST['namecommerce'].'",
		    "businessName": "'.$_POST['razonSFiscal'].'",
		    "idBussinesLine": '.$_POST['giro'].',
		    "idActivity": '.$_POST['actividad'].',
		    "email": "'.$_POST['email'].'",
		    "password": "'.$_POST['contrasena'].'",
		    "phoneNumber": "'.$_POST['tel'].'",
		    "rfc": "'.$_POST['rfc'].'",
		    "fiscalRegime": "'.$_POST['regFiscal'].'",
		    "assignClabeAccount": true,
		    "commerceFees": [
			    {
			        "operationType": 22,	
			        "percentage": '.($_POST['tasaVisaTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 27,	
			        "percentage": '.($_POST['tasaMCTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 22, 
			        "percentage": '.($_POST['tasaVisaE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 23, 
			        "percentage": '.($_POST['tasaAMEXE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 57, 
			        "percentage": '.($_POST['tasaInterE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": 0
			    },
				{
			        "operationType": 56, 
			        "percentage": '.($_POST['tasaValesE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": 0
			    }		
			],
		    "address": {
		        "street": "'.$_POST['calle'].'",
		        "exteriorNumber": "'.$_POST['numExt'].'",
		        "interiorNumber": "'.$_POST['numInt'].'",
		        "idLocation": "'.$_POST['col'].'"
		    }'.$arrayContactos.'
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
	}

	public function searchSubafiliado(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/subAffiliation/getAll',
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
}
