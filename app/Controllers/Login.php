<?php

namespace App\Controllers;

class Login extends BaseController{
	
	public function __construct(){
		helper('form');
		$this->session = \Config\Services::session();
	}

	public function index(){
		return view('login');
	}
	
	public function searchAccount(){
		$curl = curl_init();

		$url = WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/user/login';

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/user/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"email": "'.$_POST['user_login'].'",
			"password": "'.$_POST['password_login'].'"
		}',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Content-Type: application/json',
		    'Cookie: JSESSIONID=D85924E31F132B8C77D289A48F1EDFFB'
		  ),
		));

		$response = curl_exec($curl);
   
		curl_close($curl);
		$datos = json_decode($response);

		//var_dump($datos);

		if ($datos->success) {

			if ($datos->terminalInfo->idBusinessModel == 1) {
				$entS = $datos->terminalInfo->issueId;
			}else {
				$entS = $datos->terminalInfo->entitySonID;
			}
	
			if ($datos->terminalInfo->affiliationLevelID == 2) {
				$entS = 'com.onsigna';
			}
	
			//echo 'entS = '.$entS;
	
			$curlBalance = curl_init();
			curl_setopt_array($curlBalance, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.$entS,
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
	
			
			$responseBalance = curl_exec($curlBalance);
	
			curl_close($curlBalance);
			$datosBalance = json_decode($responseBalance);
	   
			if($datos->terminalInfo->affiliationLevelID == 2){
				$datosBalance->virtualAccount == '';
			}

			$dataSession = [
				            "idUser"=> $datos->terminalInfo->userID,
				            "idContext"=> $datos->terminalInfo->contextID,
				            "idEntity"=> $datos->terminalInfo->entityID,
				            "idTerminal"=> $datos->terminalInfo->terminalID,
				            "idTerminalUser"=> $datos->terminalInfo->terminalUserID,
				            "idRol"=> $datos->terminalInfo->affiliationLevelID,
				            "mail"=> $_POST['user_login'],
                    		"tel"=> $datos->terminalInfo->phoneNumber,
				            "userNAme"=> $datos->terminalInfo->merchantName,
				            "validate"=> $datos->terminalInfo->guid,
				            "entitySonID"=> $datos->terminalInfo->entitySonID,
							"issueId"=> $datos->terminalInfo->issueId,
				            "cuenta"=> $datosBalance->virtualAccount,
				            'inSession'=>'true',
				            'success'=> true,
				            'message'=>'existe',
				            'idBusinessModel'=>$datos->terminalInfo->idBusinessModel,
				            'idTypeAffiliation'=>$datos->terminalInfo->idTypeAffiliation,
				            "idStatus"=> $datos->terminalInfo->statusID
						];
			$session = session();
			$session->set($dataSession);
		}else{
			$dataSession = [
				'idUser'=>'',
				'message'=>$datos->error->message,
				'inSession'=>'false',
				'existe'=>0,
				"idStatus"=>0
			];
		}
		echo json_encode($dataSession);
	}
	public function searchAccountt(){
		
		$users = array('admin@onsigna.com','subafiliado@onsigna.com','entidad@onsigna.com','sucursal@onsigna.com','colaborador@onsigna.com');

		$passs = array('admin123','subafiliado123','entidad123','sucursal123','colaborador123');

		$c = array_combine($passs, $users);

		if (array_key_exists($_POST['password_login'], $c)) {
		    $clave = array_search($_POST['user_login'], $c); // $clave = 2;
		 
		    $existe = 0;
			$noExiste = 0;

		    if ($clave == $_POST['password_login']) {
		    	if ($_POST['user_login'] == "admin@onsigna.com") {
		    		$dataSession = [
						"idUser"=> 1,
			            "idContext"=> 1,
			            "idEntity"=> 1,
			            "idTerminal"=> 1,
			            "idTerminalUser"=> 1,
			            "idRol"=> 2,
			            "mail"=> $_POST['user_login'],
			            "userNAme"=> 'Onsigna',
			            'inSession'=>'true',
			            'success'=> true,
			            'message'=>'existe',
			            "idStatus"=> 0
					];
				}else if ($_POST['user_login'] == 'subafiliado@onsigna.com') {
					$dataSession = [
						"idUser"=> 1,
			            "idContext"=> 1,
			            "idEntity"=> 1,
			            "idTerminal"=> 1,
			            "idTerminalUser"=> 1,
			            "idRol"=> 3,
			            "mail"=> $_POST['user_login'],
			            "userNAme"=> 'Onsigna',
			            'inSession'=>'true',
			            'success'=> true,
			            'message'=>'existe',
			            "idStatus"=> 0
					];
		    	}else if ($_POST['user_login'] == 'entidad@onsigna.com') {
					$dataSession = [
						"idUser"=> 1,
			            "idContext"=> 1,
			            "idEntity"=> 1,
			            "idTerminal"=> 1,
			            "idTerminalUser"=> 1,
			            "idRol"=> 4,
			            "mail"=> $_POST['user_login'],
			            "userNAme"=> 'Onsigna',
			            'inSession'=>'true',
			            'success'=> true,
			            'message'=>'existe',
			            "idStatus"=> 0
					];
		    	}else if ($_POST['user_login'] == 'sucursal@onsigna.com') {
					$dataSession = [
						"idUser"=> 1,
			            "idContext"=> 1,
			            "idEntity"=> 1,
			            "idTerminal"=> 1,
			            "idTerminalUser"=> 1,
			            "idRol"=> 5,
			            "mail"=> $_POST['user_login'],
			            "userNAme"=> 'Onsigna',
			            'inSession'=>'true',
			            'success'=> true,
			            'message'=>'existe',
			            "accountCreatedFromPortal"=> true,
			            "registrationCompleted"=> 0
					];
		    	}else if ($_POST['user_login'] == 'entidad@onsigna.com') {
					$dataSession = [
						"idUser"=> 1,
			            "idContext"=> 1,
			            "idEntity"=> 1,
			            "idTerminal"=> 1,
			            "idTerminalUser"=> 1,
			            "idRol"=> 6,
			            "mail"=> $_POST['user_login'],
			            "userNAme"=> 'Onsigna',
			            'inSession'=>'true',
			            'success'=> true,
			            'message'=>'existe',
			            "idStatus"=> 0
					];
		    	}
				$session = session();
				$session->set($dataSession);
			}else{
				$dataSession = [
					'idUser'=>'',
					'message'=>'Credenciales no validad',
					'inSession'=>'false',
					'existe'=>0
				];
				$datos['mensaje'] = 'Mensaje';
				//return redirect()->to(base_url().'/');
			}

			
		}else{
			$dataSession = [
				'idUser'=>'',
				'mail'=>'Credenciales no validas',
				'inSession'=>'false',
				'existe'=>'0
				'
			];
			//return redirect()->to(base_url().'/');
		}

		echo json_encode($dataSession);
		
	}

	public function destroyAccount(){
		$this->session->destroy();

		echo json_encode('fin');
		//return redirect()->to(base_url().'/');
	}

	public function getSaldo(){
		$curl = curl_init();

		if (session('idRol') == 2) {
			//onsigna
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/com.onsigna',
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
		}else{
			if (session('idBusinessModel') == 1) {
				curl_setopt_array($curl, array(
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('issueId'),
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
			}else if (session('idBusinessModel') == 2) {
				curl_setopt_array($curl, array(
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
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
			}else if (session('idBusinessModel') == 3) {
				curl_setopt_array($curl, array(
					CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
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
			}	
		}
			$response = curl_exec($curl);

			curl_close($curl);

			$datos['rows']= json_decode($response);


			$_SESSION['cuentaSession'] = $datos['rows']->virtualAccount;
			$_SESSION['balance'] = $datos['rows']->balance;

			//echo $datos['rows']->onsignaEntity->clabeAccount;


			echo json_encode($datos);
	}

	public function forgotPassword(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/user/forgotPassword?email='.$_POST['email'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Cookie: JSESSIONID=ccc03bb85d66a6037878f6eb8ad9'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$datos['rows']= json_decode($response);

		echo json_encode($datos);
	}
}
