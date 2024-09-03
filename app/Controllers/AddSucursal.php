<?php

namespace App\Controllers;

class AddSucursal extends BaseController{
	
	public function index(){
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

		$datos = array('giros'=>json_decode($response), 'subafiliados'=>json_decode($response_subafiliado), 'regimenFiscal'=>json_decode($response_regimenFiscal));
		//var_dump($datos);

		//return view('addSucursal/index',$datos);
		//if ((session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4)) {
			return view('addSucursal/index',$datos);
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

	public function searchEntidad($subafiliado){

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getEntitiesBySubAffiliation?idSubAffiliation='.$subafiliado,
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

	public function searchComisionista($subafiliado){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/commissionAgent/getCommissionAgent?fatherId='.$subafiliado,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=58d506404c76e8c39addeec92a49'
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

	public function searchEntidadByComision($comisionista){
		if (session('idUser') != '') {
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/commissionAgent/getEntitiesByCommissionAgent?idCommissionAgent='.$comisionista,
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

			//if (session('idRol') != 6) {
				if ($response != '[]') {
					$datos['rows']= json_decode($response);
					$datos['success'] = '1';
				}else{
					$datos['rows']= 'No se encontraron resultados';
					$datos['success'] = '0';
				}

				echo json_encode($datos);
			/*}else{
				return redirect()->to(base_url().'/');
			}*/	
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function registrar(){

		$arrayRep2 = array();
		$arrayCom2 = array();
		$arraySop2 = array();
		$arrayFin2 = array();
		$arrayContactos2 = array();
		$arrayContactos = '';
		$vacioCont = 0;
		$vacioFac = 0;
		$diasCom = '';
		$diasFin ='';
		$diasSop = '';
		$diaFac = '';
		$dispersion = '"dispersionAccount": ""';

		$liquidacion = '"liquidationLevel": "0",';
		$tradeBilling = array();
		$tradeBilling2 = '';
		$tradeBillingForm = array();
		
		$entityType = '';
		$liquidationType = '';

		$ineFile = '';
		$constitutiveActFile = '';
		$proofOfAddressFile = '';
		
		if (isset($_POST['entityType'])) {
		    $entityType = '"entityType": "'.$_POST['typeSub'].'",';
		}else{
			$entityType = '"entityType": "",';
		}

		if (isset($_POST['liquidationType'])) {
		    $liquidationType = '"liquidationType": "'.$_POST['dispersion'].'",';
		}else{
			$liquidationType = '"liquidationType": "",';
		}

		if (!empty($_FILES['ine']['tmp_name'])) {
			$path = $_FILES['ine']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$ineFile = '"ineFile":"'.$base64.'",';
		}else{
			$ineFile = '"ineFile":"",';
		}

		if (!empty($_FILES['acta']['tmp_name'])) {
			$path = $_FILES['acta']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$constitutiveActFile = '"constitutiveActFile":"'.$base64.'",';
		}else{
			$constitutiveActFile = '"constitutiveActFile":"",';
		}

		if (!empty($_FILES['cfe']['tmp_name'])) {
			$path = $_FILES['cfe']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$proofOfAddressFile = '"proofOfAddressFile":"'.$base64.'",';
		}else{
			$proofOfAddressFile = '"proofOfAddressFile":"",';
		}


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

		if ($_POST['facturacion'] != "publicoGen") {
			$vacioFac = $vacioFac+1;
			if (isset($_POST['diasPerFac'])) {
				for ($iDiasFac=0; $iDiasFac < count($_POST['diasPerFac']) ; $iDiasFac++) { 
					$diaFac .= $_POST['diasPerFac'][$iDiasFac].'|';
				}
				$diaFac = substr($diaFac, 0, -1);
			}	
			
	        $tradeBillingForm = [
				"period" => $_POST['perFac'],
				"days" => $diaFac,
				"amount" => $_POST['monto']
		    ];
		    array_push($tradeBilling, $tradeBillingForm);
		}else{
			$vacioFac = $vacioFac+1;

			$tradeBillingForm = null;
		    array_push($tradeBilling, $tradeBillingForm);
		}

		
		if ($vacioCont > 0 ) {
			$arrayContactos .= ',"contacts": '.json_encode($arrayContactos2);
		}

		if ($vacioFac > 0 ) {
			$tradeBilling2 .= ',"tradeBilling": '.json_encode($tradeBillingForm);
		}

		if($_POST['dispersion'] == 'en'){
			$dispersion = '"dispersionAccount": "'.$_POST['cuentaDes'].'"';
		}else if($_POST['dispersion'] == 'fuera'){
			$dispersion = '"dispersionAccount": "'.$_POST['clabeInt'].'"';
		}else{
			$dispersion = '"dispersionAccount": "'.$_POST['cuentaKash'].'"';
		}
		
		//var_dump($tradeBilling);
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{
				"idContext": '.$_POST['subafiliado'].' ,
				"idEntity": '.$_POST['entidad'].',
				"nameCommerce": "'.$_POST['sucursal'].'",
				"idAffiliationLevel": 5,
				"typeAffiliation": '.$_POST['typeSub'].',
				"businessName": "'.$_POST['razonSFiscal'].'",
				"idBussinesLine": '.$_POST['giro'].',
				"idActivity": '.$_POST['actividad'].',
				"rfc": "'.$_POST['rfc'].'",
				"phoneNumber": "'.$_POST['tel'].'",
				"email": "'.$_POST['email'].'",
				"password": "'.$_POST['contrasena'].'",
				'.$liquidacion.'
				"fiscalRegime": "'.$_POST['regFiscal'].'",
				"assignClabeAccount": true,
				'.$dispersion.',
				"idbusinessModel": '.$_POST['modelo'].',
				"address": {
					"street": "'.$_POST['calle'].'",
					"exteriorNumber": "'.$_POST['numExt'].'",
					"interiorNumber": "'.$_POST['numInt'].'",
					"idLocation": "'.$_POST['col'].'"
				}'.
				$tradeBilling2.
				$arrayContactos.'
			}',
		  	CURLOPT_HTTPHEADER => array(
		    	'Content-Type: application/json',
		    	'Authorization: Basic YWRtaW46c2VjcmV0'
		  	),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$datos = array('rows'=>json_decode($response));
		//echo json_encode($datos);
		if($datos['rows']->success){
			//Windows
			//$url = 'C:/xampp/htdocs/adquirencia2/public/assets/files/documentosLegales/';
			$url = "/var/www/html/adquirencia/public/assets/files/documentosLegales/";
			
			$guid = $datos['rows']->accountResponse->guid;
			$filesave;

			$directorio = $url.$guid."/"; 

			//echo 'directorio = '.$directorio;
			
			if (!file_exists($directorio)) {
				//echo 'no existe';

				$dirmake = mkdir($directorio, 0777);   
				//echo 'dirmake = '.$dirmake;

				$docCFE = $guid.'_COMP_DOM.pdf';
				$docACTA = $guid.'_ACTA_CONS.pdf';
				$docINE = $guid.'_INE.pdf';

				$filesave1 = move_uploaded_file($_FILES['cfe']['tmp_name'], $directorio.$docCFE);                         
				$filesave2 = move_uploaded_file($_FILES['acta']['tmp_name'], $directorio.$docACTA);                         
				$filesave3 = move_uploaded_file($_FILES['ine']['tmp_name'], $directorio.$docINE);                         
			}

			echo json_encode($datos);
			

		}else{
			echo json_encode($datos);
		}
	}


	public function registrar2(){

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
		$liquidacion = '"liquidationLevel": "0",';

		$ineFile = '';
		$constitutiveActFile = '';
		$proofOfAddressFile = '';

		if (!empty($_FILES['ine']['tmp_name'])) {
			$path = $_FILES['ine']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$ineFile = '"ineFile":"'.$base64.'",';
		}else{
			$ineFile = '"ineFile":"",';
		}

		if (!empty($_FILES['acta']['tmp_name'])) {
			$path = $_FILES['acta']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$constitutiveActFile = '"constitutiveActFile":"'.$base64.'",';
		}else{
			$constitutiveActFile = '"constitutiveActFile":"",';
		}

		if (!empty($_FILES['cfe']['tmp_name'])) {
			$path = $_FILES['cfe']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$proofOfAddressFile = '"proofOfAddressFile":"'.$base64.'",';
		}else{
			$proofOfAddressFile = '"proofOfAddressFile":"",';
		}
		
		
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
	            "name" => $_POST['nombreRep'],
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
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idContext": '.$_POST['subafiliado'].' ,
		    "idEntity": '.$_POST['entidad'].',
		    "idCommissionAgent": "'.$_POST['comisionista'].'",
		    "nameCommerce": "'.$_POST['sucursal'].'",
		    "businessName": "'.$_POST['razonSFiscal'].'",
		    "email": "'.$_POST['email'].'",
		    "password": "'.$_POST['contrasena'].'",
		    "phoneNumber": "'.$_POST['tel'].'",
		    "rfc": "'.$_POST['rfc'].'",
		    "fiscalRegime": "'.$_POST['regFiscal'].'",
		    "assignClabeAccount": true, 
		    '.$liquidacion.
			$ineFile.
			$constitutiveActFile.
			$proofOfAddressFile.'
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

}
