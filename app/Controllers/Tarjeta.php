<?php

namespace App\Controllers;

class Tarjeta extends BaseController{
	
	public function index(){

		if (session('idUser')) {
			if (session('idRol') == 2) {
				$idcontext = 0;
				$contexCombo = '';
			}else{
				//$idcontext = session('idcontextResponse')[0];
				$contexCombo = session('entitySonID');
			}
	
			$curl_combo = curl_init();
	
			curl_setopt_array($curl_combo, array(
			CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.$contexCombo.'&level=',
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
		
			$datos = array('combo'=>json_decode($response_combo));
			
			return view('tarjeta/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function searchCard($card,$context){
		if (session('idRol') == 2) {
			$urlSer = URL_SERVICES.'/AldebaranServices/getCards?value='.$card.'&id_context='.$context;
		}else{
			$urlSer = URL_SERVICES.'/AldebaranServices/getCards?value='.$card.'&id_context='.session('entitySonID');
		}


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $urlSer,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET'
		));

		$response = curl_exec($curl);

		var_dump($response);

		curl_close($curl);

	
		if (session('idUser')) {		
			if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			}else{
				$datos['rows']= 'No se encontraron resultados';
				$datos['success'] = '0';
			}

		}else{
			return redirect()->to(base_url().'/');
		}

		echo json_encode($datos);
	}

	public function searchStatus($card, $context){
		if (session('idRol') == 2) {
			$urlSer = URL_SERVICES.'/AldebaranServices/getStatusByCard?value='.$card.'&sirioId='.$context;
		}else{
			$urlSer = URL_SERVICES.'/AldebaranServices/getStatusByCard?value='.$card.'&sirioId='.session('entitySonID');
		}
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $urlSer,
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/getStatusByCard?value='.$card,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET'
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

	public function searchMarcas($card, $context){
		
		$urlSer = URL_SERVICES.'/AldebaranServices/getMarcas?value='.$card.'&sirioId='.$context;
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $urlSer,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET'
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
