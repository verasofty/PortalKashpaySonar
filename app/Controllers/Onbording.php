<?php

namespace App\Controllers;

class Onbording extends BaseController{
	
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

		$datos = array('giros'=>json_decode($response), 'regimenFiscal'=>json_decode($response_regimenFiscal));
		//var_dump($datos);
		return view('onbording/index',$datos);
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

	public function validarToken($token){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/validate?guid='.$token,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
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

	public function registrar(){

		$arrayEntidad = array();
		$arrayEntidad2 = '';
		$arraySucursal = array();
		$arraySucursal2 = '';
		$arrayColaborador = array();
		$arrayColaborador2 = '';
		$arrayContactos = array();
		$arrayContactos2 = '';
		$vacioCont = 0;

		if ($_POST['numIntSub'] == '') {
			$_POST['numIntSub'] = "ND";
		}
		if ($_POST['numIntEnt'] == '') {
			$_POST['numIntEnt'] = "ND";
		}

		$taza = (TASA_DEFAULT*100);
		

		$arrayContactos = array(
			"idContext" => $_POST['idContext'],
			"rfc" => $_POST['rfcSub'],
			"address" => array(
				"idLocation"=> $_POST['colSub'],
				"street"=> $_POST['calleSub'],
				"exteriorNumber"=> $_POST['numExtSub'],
				"interiorNumber"=> $_POST['numIntSub']
			)
		);

		if ($_POST['namecommerce'] != '') {
			$vacioCont = $vacioCont + 1;
   		    $arrayContactos['entity'] = array(
				"idBussinesLine"=> $_POST['giro'],
	            "idActivity" => $_POST['actividad'],
	            "nameCommerce" => $_POST['namecommerce'],
	            "phoneNumber"=> $_POST['telEnt'],
	            "email" => $_POST['emailEnt'],
	            "password" => $_POST['contrasenaEnti'],
	            "assignClabeAccount"=> true,
    			"feeID"=> $taza,
	            "address" => array(
	            	"idLocation"=> $_POST['colEnt'],
					"street"=> $_POST['calleEnt'],
					"exteriorNumber"=> $_POST['numExtEnt'],
					"interiorNumber"=> $_POST['numIntEnt']
	            )
			);
		}

		if (isset($_POST['nombreSuc'])) {
			if ($_POST['nombreSuc'] != '') {
				$vacioCont = $vacioCont + 1;
				$arrayContactos['branchOffice'] = array(
			    	"email" => $_POST['emailSuc'],
		            "password" => $_POST['contrasena'],
		            "nameCommerce" => $_POST['nombreSuc'],
		            "phoneNumber"=> $_POST['telSuc'],
		            "rfc" => $_POST['rfc'],
		            "assignClabeAccount"=> true,
	    			"feeID"=> $taza,
		            "businessName" => $_POST['razonSocialSuc'],
		            "fiscalRegime" => $_POST['regimenFis'],
		            "address" => array(
		            	"idLocation"=> $_POST['colSuc'],
						"street"=> $_POST['calleSuc'],
						"exteriorNumber"=> $_POST['numExtSuc'],
						"interiorNumber"=> $_POST['numIntSuc']
		            )
			    );
			}
		}

		if (isset($_POST['nombreCol'])) {
			if ($_POST['nombreCol'] != '') {
				$vacioCont = $vacioCont + 1;
				$arrayContactos['collaborator'] = array(
			    	"email" => $_POST['emailCol'],
		            "password" => $_POST['contrasenaCol'],
		            "name" => $_POST['nombreCol'],
		            "phoneNumber"=> $_POST['telCol'],
		            "paternalSurname" => $_POST['apaternoCol'],
		            "maternalSurname" => $_POST['amaternoCol'],
		            "assignClabeAccount"=> true,
	    			"feeID"=> $taza,
		            "idTypeUser" => 4
			    );
			}
		}

		//var_dump($arrayContactos);

		$arrayContactos2 .= json_encode($arrayContactos);
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/onboarding',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$arrayContactos2,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Basic YWRtaW46c2VjcmV0'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);	
		$datos = array('rows'=>json_decode($response));
		echo json_encode($datos);

		//var_dump($arrayContactos2);
	}

}
