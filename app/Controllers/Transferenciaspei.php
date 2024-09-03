<?php

namespace App\Controllers;

class Transferenciaspei extends BaseController{
	
	public function index(){
		$curl = curl_init();
		$curl_combo = curl_init();
		$curlSaldo = curl_init();
		$curl_cuentas = curl_init();
		echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/getConcentratorAccounts?sirioId='.session('entitySonID');
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
				curl_setopt_array($curlSaldo, array(
					
					CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/com.onsigna',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
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

				curl_setopt_array($curlSaldo, array(	
					CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.session('issueId'),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET'
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
				  curl_setopt_array($curlSaldo, array(
					  
					  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/com.onsigna',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET'
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

					curl_setopt_array($curlSaldo, array(	
						CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.session('entitySonID'),
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'GET'
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
				  curl_setopt_array($curlSaldo, array(
					  
					  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/com.onsigna',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET'
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
  
				  curl_setopt_array($curlSaldo, array(	
					  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.session('issueId'),
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET'
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

      	$responseSaldo = curl_exec($curlSaldo);
      	curl_close($curlSaldo);
      
		$response_cuentas = curl_exec($curl_cuentas);
		curl_close($curl_cuentas);
   
		//$datos['rows']= json_decode($response);
		$datos = array('rows'=>json_decode($response),'combo'=>json_decode($response_combo),'saldo'=>json_decode($responseSaldo),'cuentas'=>json_decode($response_cuentas));
    

		if (session('idUser')) {
			return view('transferenciaspei/index', $datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function infoSpei(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.$_POST['cuentaOr'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$curlSaldo = curl_init();

	      curl_setopt_array($curlSaldo, array(
	        
	        CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.$_POST['cuentaOr'],
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => '',
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => 'GET'
	      ));

	      $responseSaldo = curl_exec($curlSaldo);

	      curl_close($curlSaldo);


		$datos = array('rows'=>json_decode($response),'rowsSaldo'=>json_decode($responseSaldo));

		echo json_encode($datos);

	}
  
  	public function combo(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
  		CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.$_POST['cuenta'].'&level=',
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => '',
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 0,
  		CURLOPT_FOLLOWLOCATION => true,
  		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$curlSaldo = curl_init();

	      curl_setopt_array($curlSaldo, array(
	        
	        CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.$_POST['cuenta'],
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => '',
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => 'GET'
	      ));

	      $responseSaldo = curl_exec($curlSaldo);

	      curl_close($curlSaldo);


		$datos = array('rows'=>json_decode($response),'rowsSaldo'=>json_decode($responseSaldo));

		echo json_encode($datos);
   

	}

	public function infoSpeiCuenta(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.$_POST['cuenta'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$curlSaldo = curl_init();

	      curl_setopt_array($curlSaldo, array(
	        
	        CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.$_POST['cuenta'],
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => '',
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => 'GET'
	      ));

	      $responseSaldo = curl_exec($curlSaldo);

	      curl_close($curlSaldo);


		$datos = array('rows'=>json_decode($response),'rowsSaldo'=>json_decode($responseSaldo));

		echo json_encode($datos);

	}

}
