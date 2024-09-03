<?php

namespace App\Controllers;

class AddColaborador extends BaseController{
	
	public function index(){
		if (session('idUser') != '') {
			
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

			$datos = array('subafiliados'=>json_decode($response_subafiliado));
			//var_dump($datos);

			//return view('addSucursal/index',$datos);
			if (session('idRol') != 6) {
				return view('addColaborador/index', $datos);
			}else{
				return redirect()->to(base_url().'/');
			}
			
		}else{
			return redirect()->to(base_url().'/');
		}
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

	public function searchEntidad($subafiliado){
		if (session('idUser') != '') {
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

	public function registrar(){

		$liquidacion = '"liquidationLevel": "0",';

		$ineFile = '"ineFile":"",';
		$proofOfAddressFile = '"proofOfAddressFile":""';

		if (!empty($_FILES['ine']['tmp_name'])) {
			$path = $_FILES['ine']['tmp_name'];
			$data = file_get_contents($path);
			$base64 =  base64_encode($data);
			$ineFile = '"ineFile":"'.$base64.'",';
		}

		if (!empty($_FILES['cfe']['tmp_name'])) {
			$pathCFE = $_FILES['cfe']['tmp_name'];
			$dataCFE = file_get_contents($pathCFE);
			$base64CFE =  base64_encode($dataCFE);
			$proofOfAddressFile = '"proofOfAddressFile":"'.$base64CFE.'"';
		}
		
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/collaborator',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "idContext": '.$_POST['subafiliado'].',
		    "idCommissionAgent": "'.$_POST['comisionista'].'",
		    "idEntity": '.$_POST['entidad'].',
		    "idTerminal": '.$_POST['sucursal'].',
		    "name": "'.$_POST['nombre'].'",
		    "paternalSurname": "'.$_POST['aPaterno'].'",
		    "maternalSurname": "'.$_POST['aMaterno'].'",    
		    "email": "'.$_POST['email'].'",
		    "password": "'.$_POST['contrasena'].'",
		    "assignClabeAccount": true,
		    "phoneNumber": "'.$_POST['tel'].'",
		    "rfc": "'.$_POST['rfc'].'",
		    '.$liquidacion.
		    $ineFile.
			$proofOfAddressFile.'
		}
		',
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
