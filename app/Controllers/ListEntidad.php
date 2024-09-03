<?php

namespace App\Controllers;

class ListEntidad extends BaseController{
	
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

		}else if (session('idRol') == 7) {
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
		return view('listEntidad/index', $datos);
	}

	public function searchResult(){
		$prefijo = '';

		if ($_POST['subafiliado'] != '') {
			$prefijo = 'SUB';
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/searchCommercesByLevel?sirioId='.$prefijo.$_POST['subafiliado'].'&level=4&nameCommerce='.$_POST['nameComerce'].'&bussinessName=&email='.$_POST['email'].'&telefono='.$_POST['tel'].'&rfc='.$_POST['rfc'].'&startDate='.$_POST['fechaInicio'].'&endDate='.$_POST['fechaFin'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=8e39a1ecf6378f6a11bfbbbd8f7a'
		  ),
		));
		

		$response = curl_exec($curl);

		//var_dump($response);

		curl_close($curl);

		if ($response != null) {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= 'No se encontraron resultados';
			$datos['success'] = '0';
		}

		echo json_encode($datos);
	}
}
