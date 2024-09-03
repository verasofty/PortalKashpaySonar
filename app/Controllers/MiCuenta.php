<?php

namespace App\Controllers;

class MiCuenta extends BaseController{
	
	public function index(){
		//if (session('idRol') == 3) {
			//subafiliado 
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

			$curlCuenta = curl_init();			  

			curl_setopt_array($curlCuenta, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/get?sirioId='.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=0daa4c50c83dc3f9487daced4b8f'
			  ),
			));

			$responseCuenta = curl_exec($curlCuenta);
			curl_close($curlCuenta);

			$curl_subafiliado = curl_init();

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

			$responseSubafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);


			$datos = array('subafiliados'=> json_decode($responseSubafiliado),'giros'=>json_decode($response),'cuenta'=>json_decode($responseCuenta), 'regimenFiscal'=>json_decode($response_regimenFiscal));
		
		//var_dump($responseCuenta);
		if (session('idUser')!='') {
			return view('miCuenta/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}	
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

	public function searchSucursal($subafiliado,$entidad){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice/getBranchOfficeByAffiliationAndEntity?idSubAffiliation='.$subafiliado.'&idEntity='.$entidad,
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

	public function updateAccount(){
		$curl = curl_init();
		
		//subafiliado
		if (session('idRol') == 3) {
			$arrayRep2 = array();
			$arrayCom2 = array();
			$arraySop2 = array();
			$arrayFin2 = array();
			$arrayContactos2 = array();
			$arrayContactos = '';
			$vacioCont = 0;
			$vacioFac = 0;
			$diaFac = '';
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';
			$dispersion = '"dispersionAccount": ""';
			$liquidacion = '"liquidationLevel": "0",';
			$tradeBilling = array();
			$tradeBilling2 = '';
			$tradeBillingForm = array();
			


			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
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
			    	"id" => intval($_POST['idContactFin']),
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
			    	"id" => intval($_POST['idContCom']),
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
			    	"id" => intval($_POST['idContactSop']),
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
			//echo $_POST['facturacion'];
			if ($_POST['facturacion'] != "publicoGen") {
				$vacioFac = $vacioFac+1;
				//var_dump( $_POST['diasPerFac']);

				if (isset($_POST['diasPerFac'])) {
					for ($iDiasFac=0; $iDiasFac < count($_POST['diasPerFac']) ; $iDiasFac++) { 
						$diaFac .= $_POST['diasPerFac'][$iDiasFac].'|';
					}
					$diaFac = substr($diaFac, 0, -1);
				}	
				//var_dump($diaFac);
				if ($_POST['monto'] == '') {
					$_POST['monto'] == 0.0;
				}
				
				if($_POST['idFac'] == ''){
					$_POST['idFac'] = 0;
				}
				$amount=$_POST['monto'];
				$amount2=str_replace(',','',$amount);  

				$tradeBillingForm = [
					"idTradeBilling" => $_POST['idFac'],
					"period" => $_POST['perFac'],
					"days" => $diaFac,
					"amount" => $amount2
				];
				array_push($tradeBilling, $tradeBillingForm);
			}else{
				$vacioFac = $vacioFac+1;
	
				$tradeBillingForm = null;
				array_push($tradeBilling, $tradeBillingForm);
			}

			//var_dump($tradeBillingForm);

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
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/updateData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'PUT',
				CURLOPT_POSTFIELDS =>'{
					"idCommerceDetail": '.$_POST['idCommerceDetail'].',
				    "nameCommerce": "'.$_POST['nombre'].'",
					"idBussinesLine": '.intval($_POST['giro']).',
				    "idActivity": '.intval($_POST['actividad']).',
					"phoneNumber": "'.$_POST['tel'].'",
					"rfc": "'.$_POST['rfc'].'",
					"businessName": "'.$_POST['razonSFiscal'].'",
				    "fiscalRegime": "'.$_POST['regFiscal'].'",
				    "typeAffiliation": '.$_POST['typeSub'].',
				    "idbusinessModel": '.$_POST['modelo'].',
					"liquidationLevel": "0",
					'.$dispersion.',
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
				  'Authorization: Basic YWRtaW46c2VjcmV0',
				  'Content-Type: application/json',
				  'Cookie: JSESSIONID=aec2e359b6d6ca7b34f10780df17'
				),
			  ));
			  
		
		
		}

		//entidad
		if (session('idRol') == 4) {
			$arrayRep2 = array();
			$arrayCom2 = array();
			$arraySop2 = array();
			$arrayFin2 = array();
			$arrayContactos2 = array();
			$arrayContactos = '';
			$vacioCont = 0;
			$vacioFac = 0;
			$diaFac = '';
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';
			$dispersion = '"dispersionAccount": ""';
			$liquidacion = '"liquidationLevel": "0",';
			$tradeBilling = array();
			$tradeBilling2 = '';
			$tradeBillingForm = array();
			


			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
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
			    	"id" => intval($_POST['idContactFin']),
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
			    	"id" => intval($_POST['idContCom']),
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
			    	"id" => intval($_POST['idContactSop']),
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
			//echo $_POST['facturacion'];
			if ($_POST['facturacion'] != "publicoGen") {
				$vacioFac = $vacioFac+1;
				//var_dump( $_POST['diasPerFac']);

				if (isset($_POST['diasPerFac'])) {
					for ($iDiasFac=0; $iDiasFac < count($_POST['diasPerFac']) ; $iDiasFac++) { 
						$diaFac .= $_POST['diasPerFac'][$iDiasFac].'|';
					}
					$diaFac = substr($diaFac, 0, -1);
				}	
				//var_dump($diaFac);
				if ($_POST['monto'] == '') {
					$_POST['monto'] == 0.0;
				}
				
				if($_POST['idFac'] == ''){
					$_POST['idFac'] = 0;
				}
				$amount=$_POST['monto'];
				$amount2=str_replace(',','',$amount);  

				$tradeBillingForm = [
					"idTradeBilling" => $_POST['idFac'],
					"period" => $_POST['perFac'],
					"days" => $diaFac,
					"amount" => $amount2
				];
				array_push($tradeBilling, $tradeBillingForm);
			}else{
				$vacioFac = $vacioFac+1;
	
				$tradeBillingForm = null;
				array_push($tradeBilling, $tradeBillingForm);
			}

			//var_dump($tradeBillingForm);

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
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/updateData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'PUT',
				CURLOPT_POSTFIELDS =>'{
					"idCommerceDetail": '.$_POST['idCommerceDetail'].',
				    "nameCommerce": "'.$_POST['nombre'].'",
					"idBussinesLine": '.intval($_POST['giro']).',
				    "idActivity": '.intval($_POST['actividad']).',
					"phoneNumber": "'.$_POST['tel'].'",
					"rfc": "'.$_POST['rfc'].'",
					"businessName": "'.$_POST['razonSFiscal'].'",
				    "fiscalRegime": "'.$_POST['regFiscal'].'",
				    "typeAffiliation": '.$_POST['typeSub'].',
				    "idbusinessModel": '.$_POST['modelo'].',
					"liquidationLevel": "0",
					'.$dispersion.',
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
				  'Authorization: Basic YWRtaW46c2VjcmV0',
				  'Content-Type: application/json',
				  'Cookie: JSESSIONID=aec2e359b6d6ca7b34f10780df17'
				),
			));
		}

		//sucursal
		if (session('idRol') == 5) {

			$arrayRep2 = array();
			$arrayCom2 = array();
			$arraySop2 = array();
			$arrayFin2 = array();
			$arrayContactos2 = array();
			$arrayContactos = '';
			$vacioCont = 0;
			$vacioFac = 0;
			$diaFac = '';
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';
			$dispersion = '"dispersionAccount": ""';
			$liquidacion = '"liquidationLevel": "0",';
			$tradeBilling = array();
			$tradeBilling2 = '';
			$tradeBillingForm = array();
			


			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
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
			    	"id" => intval($_POST['idContactFin']),
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
			    	"id" => intval($_POST['idContCom']),
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
			    	"id" => intval($_POST['idContactSop']),
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
			//echo $_POST['facturacion'];
			if ($_POST['facturacion'] != "publicoGen") {
				$vacioFac = $vacioFac+1;
				//var_dump( $_POST['diasPerFac']);

				if (isset($_POST['diasPerFac'])) {
					for ($iDiasFac=0; $iDiasFac < count($_POST['diasPerFac']) ; $iDiasFac++) { 
						$diaFac .= $_POST['diasPerFac'][$iDiasFac].'|';
					}
					$diaFac = substr($diaFac, 0, -1);
				}	
				//var_dump($diaFac);
				if ($_POST['monto'] == '') {
					$_POST['monto'] == 0.0;
				}
				
				if($_POST['idFac'] == ''){
					$_POST['idFac'] = 0;
				}
				$amount=$_POST['monto'];
				$amount2=str_replace(',','',$amount);  

				$tradeBillingForm = [
					"idTradeBilling" => $_POST['idFac'],
					"period" => $_POST['perFac'],
					"days" => $diaFac,
					"amount" => $amount2
				];
				array_push($tradeBilling, $tradeBillingForm);
				
			}else{
				$vacioFac = $vacioFac+1;
	
				$tradeBillingForm = null;
				array_push($tradeBilling, $tradeBillingForm);
			}

			//var_dump($tradeBillingForm);

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
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/updateData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'PUT',
				CURLOPT_POSTFIELDS =>'{
					"idCommerceDetail": '.$_POST['idCommerceDetail'].',
				    "nameCommerce": "'.$_POST['nombre'].'",
					"idBussinesLine": '.intval($_POST['giro']).',
				    "idActivity": '.intval($_POST['actividad']).',
					"phoneNumber": "'.$_POST['tel'].'",
					"rfc": "'.$_POST['rfc'].'",
					"businessName": "'.$_POST['razonSFiscal'].'",
				    "fiscalRegime": "'.$_POST['regFiscal'].'",
				    "typeAffiliation": '.$_POST['typeSub'].',
				    "idbusinessModel": '.$_POST['modelo'].',
					"liquidationLevel": "0",
					'.$dispersion.',
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
				  'Authorization: Basic YWRtaW46c2VjcmV0',
				  'Content-Type: application/json',
				  'Cookie: JSESSIONID=aec2e359b6d6ca7b34f10780df17'
				),
			));

		}	

		//caja
		if (session('idRol') == 6) {
			$arrayRep2 = array();
			$arrayCom2 = array();
			$arraySop2 = array();
			$arrayFin2 = array();
			$arrayContactos2 = array();
			$arrayContactos = '';
			$vacioCont = 0;
			$vacioFac = 0;
			$diaFac = '';
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';
			$dispersion = '"dispersionAccount": ""';
			$liquidacion = '"liquidationLevel": "0",';
			$tradeBilling = array();
			$tradeBilling2 = '';
			$tradeBillingForm = array();
			

			//contactos
			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
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
			    	"id" => intval($_POST['idContactFin']),
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
			    	"id" => intval($_POST['idContCom']),
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
			    	"id" => intval($_POST['idContactSop']),
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
			//facturacion;
			if ($_POST['facturacion'] != "publicoGen") {
				$vacioFac = $vacioFac+1;
				//var_dump( $_POST['diasPerFac']);

				if (isset($_POST['diasPerFac'])) {
					for ($iDiasFac=0; $iDiasFac < count($_POST['diasPerFac']) ; $iDiasFac++) { 
						$diaFac .= $_POST['diasPerFac'][$iDiasFac].'|';
					}
					$diaFac = substr($diaFac, 0, -1);
				}	
				//var_dump($diaFac);


				if ($_POST['monto'] == '') {
					$_POST['monto'] == 0.0;
				}
				
				if($_POST['idFac'] == ''){
					$_POST['idFac'] = 0;
				}
				$amount=$_POST['monto'];
				$amount2=str_replace(',','',$amount);  

				$tradeBillingForm = [
					"idTradeBilling" => $_POST['idFac'],
					"period" => $_POST['perFac'],
					"days" => $diaFac,
					"amount" => $amount2
				];
				array_push($tradeBilling, $tradeBillingForm);
			}else{
				$vacioFac = $vacioFac+1;
	
				$tradeBillingForm = null;
				array_push($tradeBilling, $tradeBillingForm);
			}

			//var_dump($tradeBillingForm);

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
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/updateData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'PUT',
				CURLOPT_POSTFIELDS =>'{
					"idCommerceDetail": '.$_POST['idCommerceDetail'].',
				    "nameCommerce": "'.$_POST['nombre'].'",
					"paternalSurname": "'.$_POST['aPaterno'].'",
    				"maternalSurname": "'.$_POST['aMaterno'].'",
					"idBussinesLine": '.intval($_POST['giro']).',
				    "idActivity": '.intval($_POST['actividad']).',
					"phoneNumber": "'.$_POST['tel'].'",
					"rfc": "'.$_POST['rfc'].'",
					"businessName": "'.$_POST['razonSFiscal'].'",
				    "fiscalRegime": "'.$_POST['regFiscal'].'",
				    "typeAffiliation": '.$_POST['typeSub'].',
				    "idbusinessModel": '.$_POST['modelo'].',
					"liquidationLevel": "0",
					'.$dispersion.',
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
				  'Authorization: Basic YWRtaW46c2VjcmV0',
				  'Content-Type: application/json',
				  'Cookie: JSESSIONID=aec2e359b6d6ca7b34f10780df17'
				),
			));
		}


		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
	}
}
