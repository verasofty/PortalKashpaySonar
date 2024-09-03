<?php

namespace App\Controllers;

class Transacciones extends BaseController{
	
	public function index(){
		$curlTipoTran = curl_init();

		curl_setopt_array($curlTipoTran, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/catTransactionType/getAll',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=152d2bb9346c619c67ac8b063043'
		  ),
		));

		$responseTipoTrans = curl_exec($curlTipoTran);
		curl_close($curlTipoTran);
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/catResponseCode/getAll',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=152d2bb9346c619c67ac8b063043'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		if (session('idRol') == 2) {
			$curl_subafiliado = curl_init();
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
			    'Cookie: JSESSIONID=152d2bb9346c619c67ac8b063043'
			  ),
			));
			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);

			$datos= array('typeTran'=>json_decode($responseTipoTrans), 'response'=>json_decode($response), 'subafiliado'=>json_decode($response_subafiliado));

		}else if (session('idRol') == 3) {
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
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=6606daaa9c3fb83fec7c046aa09d'
			  ),
			));
			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);
			$datos= array('typeTran'=>json_decode($responseTipoTrans), 'response'=>json_decode($response),'subafiliado'=>json_decode($response_subafiliado));

		}else if (session('idRol') == 4) {
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
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=6606daaa9c3fb83fec7c046aa09d'
			  ),
			));
			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);
			$datos= array('typeTran'=>json_decode($responseTipoTrans), 'response'=>json_decode($response),'subafiliado'=>json_decode($response_subafiliado));

		}else if (session('idRol') == 5) {
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
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=6606daaa9c3fb83fec7c046aa09d'
			  ),
			));
			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);
			$datos= array('typeTran'=>json_decode($responseTipoTrans), 'response'=>json_decode($response),'subafiliado'=>json_decode($response_subafiliado));

		}else if (session('idRol') == 6) {
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
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=6606daaa9c3fb83fec7c046aa09d'
			  ),
			));
			$response_subafiliado = curl_exec($curl_subafiliado);
			curl_close($curl_subafiliado);
			$datos= array('typeTran'=>json_decode($responseTipoTrans), 'response'=>json_decode($response),'subafiliado'=>json_decode($response_subafiliado));

		}

		if (session('idUser')) {
			return view('transacciones/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}
		
	}

	public function searchTransaccion(){

		$curl = curl_init();

		if ($_POST['subafiliado'] == '') {
			$_POST['subafiliado'] = 0;
		}
		if ($_POST['entidad'] == '') {
			$_POST['entidad'] = 0;
		}
		if ($_POST['sucursal'] == '') {
			$_POST['sucursal'] = 0;
		}
		if ($_POST['caja'] == '') {
			$_POST['caja'] = 0;
		}

		if ($_POST['datetimepicker1'] != '') {
			$porciones_ini = explode(" ", $_POST['datetimepicker1']);
			$location = curl_escape($curl, $porciones_ini[0].' '.$porciones_ini[1]);
		}else {
			$location = '';
		}
		if ($_POST['datetimepicker2'] != '') {
			$porciones_fin = explode(" ", $_POST['datetimepicker2']);
			$location2 = curl_escape($curl, $porciones_fin[0].' '.$porciones_fin[1]);
		}else {
			$location2 = '';
		}

		
		//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_POST['subafiliado'].'&idEntity='.$_POST['entidad'].'&idTerminal='.$_POST['sucursal'].'&idTerminalUser='.$_POST['caja'].'&typeOperation='.$_POST['operacion'].'&amount='.$_POST['monto'].'&responseCode='.$_POST['edoTransaccion'].'&referenceNumber='.$_POST['referencia'].'&authorizationNumber='.$_POST['autorizacion'].'&bin='.$bin.'&startDate='.$_POST['fechaInicio'].'&endDate='.$_POST['fechaFin'];

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/searchOperations?idContext='.$_POST['subafiliado'].'&idEntity='.$_POST['entidad'].'&idTerminal='.$_POST['sucursal'].'&idTerminalUser='.$_POST['caja'].'&typeOperation='.$_POST['operacion'].'&card='.$_POST['numTarjeta'].'&amount='.$_POST['monto'].'&responseCode='.$_POST['edoTransaccion'].'&referenceNumber='.$_POST['referencia'].'&authorizationNumber='.$_POST['autorizacion'].'&bin='.$_POST['bin'].'&startDate='.$location.'&endDate='.$location2,
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
		
		$datos['rows']= json_decode($response);
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

	public function searchCaja($idTerminal){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/collaborator/getCollaboratorByBranchOffice?idTerminal='.$idTerminal,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=26c206a2b3151e87103394842391'
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
