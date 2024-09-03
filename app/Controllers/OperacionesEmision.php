<?php

namespace App\Controllers;

class OperacionesEmision extends BaseController{
	
	public function index(){
		if (session('idRol') == 1) {
			$idcontext = 0;
			$contexCombo = '';
		}else{
			
			$contexCombo = session('issueId');
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/catOperationType/getAll',
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


		$curl_combo = curl_init();

		curl_setopt_array($curl_combo, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.session('issueId').'&level=',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response_combo = curl_exec($curl_combo);

		curl_close($curl_combo);


		$datos = array('typeOpe'=>json_decode($response),'combo'=>json_decode($response_combo));

		//var_dump($datos);
		if (session('idUser') != '') {
			return view('operacionesEmision/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

}
