<?php

namespace App\Controllers;

class ListSubAfiliado extends BaseController{
	
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

			$datos= array('response'=>json_decode($response), 'subafiliado'=>json_decode($response_subafiliado));

		
		return view('listSubAfiliado/index', $datos);
	}

	public function searchResult(){			

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/entity/searchCommercesByLevel?sirioId=&level=3&nameCommerce=&bussinessName='.$_POST['rSocial'].'&email='.$_POST['email'].'&telefono='.$_POST['tel'].'&rfc='.$_POST['rfc'].'&startDate='.$_POST['fechaInicio'].'&endDate='.$_POST['fechaFin'],
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

		curl_close($curl);

		//var_dump($response);

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
