<?php

namespace App\Controllers;

class Detalle extends BaseController{
	public function index(){
		$curl = curl_init();
		$curl_combo = curl_init();
		$curl_cuentas = curl_init();
		//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/getConcentratorAccounts?sirioId='.session('entitySonID');
		if (session('idBusinessModel') == 1) {
			if (session('idRol') == 2) {
				//onsigna
				curl_setopt_array($curl, array(
				  //CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/getBalance/com.onsigna',
				  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/com.onsigna',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'GET'
				));	
				curl_setopt_array($curl_combo, array(
					CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId=com.onsigna&level=',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
				));
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
			}else{
				curl_setopt_array($curl, array(
				  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('issueId'),
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'GET'
				));	

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
			}
			
		}else if (session('idBusinessModel') == 2) {
			if (session('idRol') == 2) {
				//onsigna
				curl_setopt_array($curl, array(
					//CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/getBalance/com.onsigna',
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/com.onsigna',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
				  ));	
				  curl_setopt_array($curl_combo, array(
					  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId=com.onsigna&level=',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET',
				  ));
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
			}else{
				curl_setopt_array($curl, array(
					//CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/getBalance/'.session('entitySonID'),
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
					));	

					curl_setopt_array($curl_combo, array(
						CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.session('entitySonID').'&level=',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'GET',
					));

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
			}
		}else if (session('idBusinessModel') == 3) {
			if (session('idRol') == 2) {
				//onsigna
				curl_setopt_array($curl, array(
					//CURLOPT_URL => 'http://aldebaran.kashplataforma.com/AldebaranServices/getBalance/com.onsigna',
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/com.onsigna',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
				  ));	
				  curl_setopt_array($curl_combo, array(
					  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId=com.onsigna&level=',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET',
				  ));
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
			}else{
				curl_setopt_array($curl, array(
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('issueId'),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
				  ));	
  
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
			}
		}

		$response = curl_exec($curl);
		curl_close($curl);
				
		$response_combo = curl_exec($curl_combo);
		curl_close($curl_combo);
      
		$response_cuentas = curl_exec($curl_cuentas);
		curl_close($curl_cuentas);
   
		//$datos['rows']= json_decode($response);
		$datos = array('rows'=>json_decode($response),'combo'=>json_decode($response_combo),'cuentas'=>json_decode($response_cuentas));
    

		if (session('idUser')) {
			return view('detalle/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}
	
}
