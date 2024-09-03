<?php

namespace App\Controllers;

class EstadoCuenta extends BaseController{
	
	public function index(){
		if (session('idUser')) {
			$curl_cuentas = curl_init();

			curl_setopt_array($curl_cuentas, array(
				CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/getConcentratorAccounts?sirioId='.session('entitySonID'),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Basic YWRtaW46c2VjcmV0',
					'Cookie: JSESSIONID=721e177c735e9cd50092cea864dd'
				),
			));

			$response_cuentas = curl_exec($curl_cuentas);
			curl_close($curl_cuentas);

			$datos = array('cuentas'=>json_decode($response_cuentas));

			return view('estadoCuenta/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function generarPDF(){
		$curl_cuentas = curl_init();
    
    	curl_setopt_array($curl_cuentas, array(
    		CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/getAccountStatus?reportType=PDF&month='.$_POST['mes'].'&year='.$_POST['anio'].'&sirioId='.$_POST['idContext'].'&clabe='.$_POST['clabe'],
    	    CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic YWRtaW46c2VjcmV0',
				'Cookie: JSESSIONID=cd263dbe87c336adc25619531e05'
			),
    	));

    	$response_cuentas = curl_exec($curl_cuentas);
    	curl_close($curl_cuentas);

		$datos['rows']= json_decode($response_cuentas);

		echo json_encode($datos);

	}

	public function getSaldo(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.$_POST['idContext'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
			  'Authorization: Basic YWRtaW46c2VjcmV0',
			  'Cookie: JSESSIONID=4e41529996b751bd88ef3c81ff33'
			)
		));

			$response = curl_exec($curl);

			curl_close($curl);

			$datos['rows']= json_decode($response);


			$_SESSION['cuentaSession'] = $datos['rows']->virtualAccount;
			$_SESSION['balance'] = $datos['rows']->balance;

			//echo $datos['rows']->onsignaEntity->clabeAccount;


			echo json_encode($datos);
	}

}
