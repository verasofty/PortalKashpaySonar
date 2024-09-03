<?php

namespace App\Controllers;

class MiCuenta extends BaseController{
	
	public function index(){
		if (session('idRol') == 3) {
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

			$datos = array('giros'=>json_decode($response),'cuenta'=>json_decode($responseCuenta), 'regimenFiscal'=>json_decode($response_regimenFiscal));



		}else if (session('idRol') == 4) {
			// entidad
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

			$curlCuenta = curl_init();

			//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('idEntity');

			curl_setopt_array($curlCuenta, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getInfo?sirioId='.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=ac48d2d3406bcb7cc60a6ecd6daa'
			  ),
			));

			$responseCuenta = curl_exec($curlCuenta);
			curl_close($curlCuenta);

			//var_dump(json_decode($responseCuenta));


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

			$datos = array('giros'=>json_decode($response),'cuenta'=>json_decode($responseCuenta), 'subafiliados'=> json_decode($responseSubafiliado), 'regimenFiscal'=>json_decode($response_regimenFiscal));

		}else if (session('idRol') == 7) {
			// comisionista
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

			$curlCuenta = curl_init();

			//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('idEntity');

			//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('commissionAgentID');

			curl_setopt_array($curlCuenta, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('commissionAgentID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=ac48d2d3406bcb7cc60a6ecd6daa'
			  ),
			));

			$responseCuenta = curl_exec($curlCuenta);
			curl_close($curlCuenta);

			//var_dump(json_decode($responseCuenta));


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

			$datos = array('giros'=>json_decode($response),'cuenta'=>json_decode($responseCuenta), 'subafiliados'=> json_decode($responseSubafiliado), 'regimenFiscal'=>json_decode($response_regimenFiscal));

		}else if (session('idRol') == 5) {
			//sucursal
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

			$curl_cuenta = curl_init();

			//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('idEntity').'&terminalID='.session('idTerminal');

			curl_setopt_array($curl_cuenta, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice/getInfo?userID='.session('idUser').'&contextID='.session('idContext').'&entityID='.session('idEntity').'&terminalID='.session('idTerminal'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=72a6655e6fbbe659772c1e5e63de'
			  ),
			));

			$response_cuenta = curl_exec($curl_cuenta);

			curl_close($curl_cuenta);

			$datos = array('giros'=>json_decode($response),'subafiliados'=>json_decode($response_subafiliado), 'regimenFiscal'=>json_decode($response_regimenFiscal), 'cuenta'=>json_decode($response_cuenta));

		}else if (session('idRol') == 6) {
			// caja
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

			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/collaborator/getInfo?idCollaborator='.session('idTerminalUser').'&userId='.session('idUser'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=88937f48d2ccab21583d749efb0b'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			$datos = array('subafiliados'=>json_decode($response_subafiliado), 'cuenta'=>json_decode($response));
		}else{
			$datos = array('subafiliados'=>'', 'cuenta'=>'');
		}

		
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
		//admin
		if (session('idRol') == 2) {
		}

		//subafiliado
		if (session('idRol') == 3) {
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/subAffiliation/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
			  "idUser": '.session('idUser').',
			  "idCommerceDetail": '.$_POST['idCommerceDetail'].',
			  "name": "'.$_POST['nombre'].'",
			  "rfc": "'.$_POST['rfc'].'",
			  "phoneNumber": "'.$_POST['tel'].'",
			  "email": null,
			  "password": null,
			  "guid":"'.$_POST['guid'].'",
			  "address": {
			    "street": "'.$_POST['calle'].'",
			    "exteriorNumber": "'.$_POST['numExt'].'",
			    "interiorNumber": "'.$_POST['numInt'].'",
			    "idLocation": "'.$_POST['col'].'"
			  },
			  "contact": {
			    "id": '.$_POST['idContCom'].',
			    "idContext": '.$_POST['idContext'].',
			    "name": "'.$_POST['nombreCont'].'",
			    "paternalSurname": "'.$_POST['aPaternoCont'].'",
			    "maternalSurname": "'.$_POST['aMaternoCont'].'",
			    "phoneNumber": "'.$_POST['telCont'].'",
			    "additionaPhoneNumber": "'.$_POST['telAdiCont'].'",
			    "email": "'.$_POST['emailCont'].'"
			  }
			}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
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
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';

			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
			    		"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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

			//echo $arrayContactos;

			/*curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
			  "idCommerceDetail": '.$_POST['idCommerceDetail'].',
			  "idUser": '.session('idUser').',
			  "nameCommerce": "'.$_POST['nameCommerce'].'",
			  "idBussinesLine": '.intval($_POST['giro']).',
			  "idActivity": '.intval($_POST['actividad']).',
			  "email": null,
			  "password": null,
			  "guid": null,
			  "phoneNumber": "'.$_POST['tel'].'",
			  "address": {
			    "street": "'.$_POST['calle'].'",
			    "exteriorNumber": "'.$_POST['numExt'].'",
			    "interiorNumber": "'.$_POST['numInt'].'",
			    "idLocation": "'.$_POST['col'].'"
			  },
			  "rfc": "'.$_POST['rfc'].'",
			  "businessName": "'.$_POST['razonSFiscal'].'",
			  "fiscalRegime": "'.$_POST['regFiscal'].'"
			  '.$arrayContactos.'
			}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));*/

			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
				  "idCommerceDetail": '.intval($_POST['idCommerceDetail']).',
				  "idUser": '.session('idUser').',
				  "nameCommerce": "'.$_POST['namecommerce'].'",
				  "idBussinesLine": '.intval($_POST['giro']).',
				  "idActivity": '.intval($_POST['actividad']).',
				  "email": null,
				  "password": null,
				  "guid": null,
				  "phoneNumber": "'.$_POST['tel'].'",
				  "address": {
				    "street": "'.$_POST['calle'].'",
				    "exteriorNumber": "'.$_POST['numExt'].'",
				    "interiorNumber": "'.$_POST['numInt'].'",
				    "idLocation": "'.$_POST['col'].'"
				  },
				  "rfc": "'.$_POST['rfc'].'",
				  "businessName": "'.$_POST['razonSFiscal'].'",
				  "fiscalRegime": "'.$_POST['regFiscal'].'"
				  '.$arrayContactos.'
				}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));

			/*echo('{
				  "idCommerceDetail": '.$_POST['idCommerceDetail'].',
				  "idUser": '.session('idUser').',
				  "nameCommerce": "'.$_POST['namecommerce'].'",
				  "idBussinesLine": '.intval($_POST['giro']).',
				  "idActivity": '.intval($_POST['actividad']).',
				  "email": null,
				  "password": null,
				  "guid": null,
				  "phoneNumber": "'.$_POST['tel'].'",
				  "address": {
				    "street": "'.$_POST['calle'].'",
				    "exteriorNumber": "'.$_POST['numExt'].'",
				    "interiorNumber": "'.$_POST['numInt'].'",
				    "idLocation": "'.$_POST['col'].'"
				  },
				  "rfc": "'.$_POST['rfc'].'",
				  "businessName": "'.$_POST['razonSFiscal'].'",
				  "fiscalRegime": "'.$_POST['regFiscal'].'"
				  '.$arrayContactos.'		  
				}');*/

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
			$diasCom = '';
			$diasFin ='';
			$diasSop = '';
		
			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;

			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => $_POST['idContLeg'],
			    		"idContext" => $_POST['idContext'],
					    "idEntity" => $_POST['idEntity'],
					    "idTerminal" => $_POST['idTerminal'],
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
			    	"id" => $_POST['idContFin'],
			    	"idContext" => $_POST['idContext'],
					"idEntity" => $_POST['idEntity'],
					"idTerminal" => $_POST['idTerminal'],
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
			    	"id" => $_POST['idContCom'],
			    	"idContext" => $_POST['idContext'],
					"idEntity" => $_POST['idEntity'],
					"idTerminal" => $_POST['idTerminal'],
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
			    	"id" => $_POST['idContSop'],
			    	"idContext" => $_POST['idContext'],
					"idEntity" => $_POST['idEntity'],
					"idTerminal" => $_POST['idTerminal'],
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

			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/branchOffice/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
				  "idCommerceDetail": '.intval($_POST['idCommerceDetail']).',
				  "idUser": '.session('idUser').',
				  "nameCommerce": "'.$_POST['sucursal'].'",
				  "idBussinesLine": 0,
				  "idActivity": 0,
				  "email": null,
				  "password": null,
				  "guid": null,
				  "phoneNumber": "'.$_POST['tel'].'",
				  "address": {
				    "street": "'.$_POST['calle'].'",
				    "exteriorNumber": "'.$_POST['numExt'].'",
				    "interiorNumber": "'.$_POST['numInt'].'",
				    "idLocation": "'.$_POST['col'].'"
				  },
				  "rfc": "'.$_POST['rfc'].'",
				  "businessName": "'.$_POST['razonSFiscal'].'",
				  "fiscalRegime": "'.$_POST['regFiscal'].'"
				  '.$arrayContactos.'
				}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=69b92a12c4d05454b486f787b274'
			  ),
			));
		}	

		//caja
		if (session('idRol') == 6) {
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/collaborator/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
			  "idUser": '.session('idUser').',
			  "idTerminalUser": '.session('idTerminalUser').',
			  "phoneNumber": "'.$_POST['phoneNumber'].'",
			  "email": null,
			  "password": null,
			  "guid": null,
			  "rfc": "'.$_POST['rfc'].'",
			  "name": "'.$_POST['name'].'",
			  "paternalSurname": "'.$_POST['paternalSurname'].'",
			  "maternalSurname": "'.$_POST['maternalSurname'].'"
			}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=69b92a12c4d05454b486f787b274'
			  ),
			));
		}

		//comisionista
		if (session('idRol') == 7) {
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

			if ($_POST['nombreRep'] != "") {
				$vacioCont = $vacioCont+1;
			    $arrayRep2 = [
			    		"type" => 1,
			    		"id" => intval($_POST['idContRep']),
			    		"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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
			    	"idContext"=> intval($_POST['idContext']),
			            "idEntity"=> intval($_POST['idEntity']),
			            "idTerminal"=> intval($_POST['idTerminal']),
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

			//echo $arrayContactos;

			/*curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
			  "idCommerceDetail": '.$_POST['idCommerceDetail'].',
			  "idUser": '.session('idUser').',
			  "nameCommerce": "'.$_POST['nameCommerce'].'",
			  "idBussinesLine": '.intval($_POST['giro']).',
			  "idActivity": '.intval($_POST['actividad']).',
			  "email": null,
			  "password": null,
			  "guid": null,
			  "phoneNumber": "'.$_POST['tel'].'",
			  "address": {
			    "street": "'.$_POST['calle'].'",
			    "exteriorNumber": "'.$_POST['numExt'].'",
			    "interiorNumber": "'.$_POST['numInt'].'",
			    "idLocation": "'.$_POST['col'].'"
			  },
			  "rfc": "'.$_POST['rfc'].'",
			  "businessName": "'.$_POST['razonSFiscal'].'",
			  "fiscalRegime": "'.$_POST['regFiscal'].'"
			  '.$arrayContactos.'
			}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));*/

			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/updateInfo',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PUT',
			  CURLOPT_POSTFIELDS =>'{
				  "idCommerceDetail": '.intval($_POST['idCommerceDetail']).',
				  "idUser": '.session('idUser').',
				  "nameCommerce": "'.$_POST['namecommerce'].'",
				  "idBussinesLine": '.intval($_POST['giro']).',
				  "idActivity": '.intval($_POST['actividad']).',
				  "email": null,
				  "password": null,
				  "guid": null,
				  "phoneNumber": "'.$_POST['tel'].'",
				  "address": {
				    "street": "'.$_POST['calle'].'",
				    "exteriorNumber": "'.$_POST['numExt'].'",
				    "interiorNumber": "'.$_POST['numInt'].'",
				    "idLocation": "'.$_POST['col'].'"
				  },
				  "rfc": "'.$_POST['rfc'].'",
				  "businessName": "'.$_POST['razonSFiscal'].'",
				  "fiscalRegime": "'.$_POST['regFiscal'].'"
				  '.$arrayContactos.'
				}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Basic YWRtaW46c2VjcmV0'
			  ),
			));

			/*echo('{
				  "idCommerceDetail": '.$_POST['idCommerceDetail'].',
				  "idUser": '.session('idUser').',
				  "nameCommerce": "'.$_POST['namecommerce'].'",
				  "idBussinesLine": '.intval($_POST['giro']).',
				  "idActivity": '.intval($_POST['actividad']).',
				  "email": null,
				  "password": null,
				  "guid": null,
				  "phoneNumber": "'.$_POST['tel'].'",
				  "address": {
				    "street": "'.$_POST['calle'].'",
				    "exteriorNumber": "'.$_POST['numExt'].'",
				    "interiorNumber": "'.$_POST['numInt'].'",
				    "idLocation": "'.$_POST['col'].'"
				  },
				  "rfc": "'.$_POST['rfc'].'",
				  "businessName": "'.$_POST['razonSFiscal'].'",
				  "fiscalRegime": "'.$_POST['regFiscal'].'"
				  '.$arrayContactos.'		  
				}');*/

		}

		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
	}
}
