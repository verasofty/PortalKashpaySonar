<?php

namespace App\Controllers;

class TransaccionesEmision extends BaseController{
	
	public function index(){

		if (session('idRol') == 2) {
			$idcontext = 0;
			$contexCombo = '';
		}else{
			//$idcontext = session('idcontextResponse')[0];
			$contexCombo = session('issueId');
		}

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
		

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  //CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/catOperationType',
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/catOperationType',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));
		//$response = json_encode( curl_exec($curl));
		$response = curl_exec($curl);

		curl_close($curl);
		//echo json_encode($response);*/

		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/catStatusOperations',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));
		//$response = json_encode( curl_exec($curl));
		$response2 = curl_exec($curl2);

		curl_close($curl2);

		


		$datos = array('rows'=>json_decode($response),'rows2'=>json_decode($response2),'combo'=>json_decode($response_combo));
		//$datos = array('rows2'=>json_decode($response2));

		//var_dump($datos);

		if (session('idUser')) {
			return view('transaccionesEmision/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
		
	}

	public function searchOpe($type_operation,$id_status,$idContext,$amount,$auth_number,$num_cuenta,$init_date,$end_date){
		if ($type_operation == 'na') {
			$type_operation = '';
		}
		if ($id_status == 'na') {
			$id_status = '';
		}
		if ($num_cuenta == 'na') {
			$num_cuenta = '';
		}
		if ($amount == 'na') {
			$amount = '';
		}
		if ($auth_number == 'na') {
			$auth_number = '';
		}
		if ($init_date == 'na') {
			$init_date = '';
		}
		if ($end_date == 'na') {
			$end_date = '';
		}
		if ($idContext == 'na') {
			$idContext = '';
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  //CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/getOperations?type_operation='.$type_operation.'&id_status='.$id_status.'&id_context='.$idContext.'&amount='.$amount.'&auth_number='.$auth_number.'&num_cuenta='.$num_cuenta.'&init_date='.$init_date.'&end_date='.$end_date,
		  CURLOPT_URL => URL_SERVICES.'getOperations?type_operation='.$type_operation.'&id_status='.$id_status.'&amount='.$amount.'&auth_number='.$auth_number.'&num_cuenta='.$num_cuenta.'&init_date='.$init_date.'&end_date='.$end_date,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET'
		));
		//$response = json_encode( curl_exec($curl));
		$response = curl_exec($curl);

		curl_close($curl);
		
		$datos = array('rows'=>json_decode($response));

		if (session('idUser')) {
			if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			}else{
				$datos['rows']= json_decode($response);
				$datos['success'] = '0';
			}
		}else{
			return redirect()->to(base_url().'/');
		}

		echo json_encode($datos);

	}
}
