<?php

namespace App\Controllers;

class AddUsuario extends BaseController{
	
	public function index(){
		return view('addUsuario/index');
	}

	public function searchUser($types, $values, $values2){

		$curl = curl_init();

		if ($types == 4) {
			$valuesEx = explode('na-',$values);
			$values = $valuesEx[1];
		}
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getUsersBy?type='.$types.'&value='.$values.'&value2='.$values2,
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/getUsersBy?type='.$types.'&value='.$values.'&value2='.$values2,
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

		if ($this->session->get('idUser')) {
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

	public function updateEmail($idUser,$emailOrigin,$emailUpdate){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/updateDataUser?idUser='.$idUser.'&emailOrigin='.$emailOrigin.'&emailUpdate='.$emailUpdate,
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/updateDataUser?idUser='.$idUser.'&emailOrigin='.$emailOrigin.'&emailUpdate='.$emailUpdate,
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


		if ($this->session->get('idUser')) {
			if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}

	public function sendToken($contexto, $email, $idUser){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/sendToken',
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/sendToken',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "registerOnboardRequest": {
		        "email": "'.$email.'",
		        "dni": "",
		        "idContex": '.$contexto.'
		    }
		}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		if ($this->session->get('idUser')) {
			if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}

	public function blockUser($idUser, $contexto){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/blockUser',
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/blockUser',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"idUser": '.$idUser.',
			"idStatus": 3,
			"idContext": '.$contexto.'
			}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);


		if ($this->session->get('idUser')) {
			//if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			/*}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}*/
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}

	public function reprocesar($idUser){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/reprocessOnboarding',
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/reprocessOnboarding',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"registerOnboardRequest": {
			    "idUser": "'.$idUser.'"
			}
		  }',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);


		if ($this->session->get('idUser')) {
			//if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			/*}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}*/
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}

	public function dropUser($email){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/deleteUserTech',
		  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/deleteUserTech',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"registerOnboardRequest": {
			    "email": "'.$email.'"
			}
		  }',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);


		if ($this->session->get('idUser')) {
			//if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			/*}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}*/
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}

	public function accionesMasivas($emails,$users,$accion){
		$emailArray = explode(" ", $emails);
		$usuarioArray = explode(" ", $users);
		if ($accion == 2) {
			// reprocesar
			for ($i=0; $i < count($usuarioArray); $i++) { 
				echo 'email = '.$usuarioArray[$i];
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/reprocessOnboarding',
				  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/reprocessOnboarding',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>'{
					"registerOnboardRequest": {
					    "idUser": "'.$usuarioArray[$i].'"
					}
				  }',
				  CURLOPT_HTTPHEADER => array(
				    'Content-Type: application/json'
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
			}
			
		}else{
			// reprocesar
			for ($i=0; $i < count($emailArray); $i++) { 
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/deleteUserTech',
				  //CURLOPT_URL => 'http://sdbx-aldebaran.kashplataforma.com/AldebaranServices/deleteUserTech',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>'{
					"registerOnboardRequest": {
					    "email": "'.$emailArray[$i].'"
					}
				  }',
				  CURLOPT_HTTPHEADER => array(
				    'Content-Type: application/json'
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
			}
		}
		


		if ($this->session->get('idUser')) {
			//if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			/*}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}*/
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);

	}

	public function dropMas(){

		$response;	
		//fo


		if ($this->session->get('idUser')) {
			//if ($response != '[]') {
				$datos['rows']= json_decode($response);
				$datos['success'] = '1';
			/*}else{
				$datos['rows']= 'No se encontraron registros.';
				$datos['success'] = '0';
			}*/
		}else{
			return redirect()->to(base_url().'/');
		}
		echo json_encode($datos);
	}
}
