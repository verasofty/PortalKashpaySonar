<?php

namespace App\Controllers;

class Prepago extends BaseController{
	
	public function index(){

		/*$curlCards = curl_init();

		curl_setopt_array($curlCards, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/card?identifier=SUB165',
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

		$response = curl_exec($curlCards);

		curl_close($curlCards);
		//echo $response;
		$datos = array('cards'=>json_decode($response));*/


		return view('prepago/index');
	}

	public function addCard(){
		$curl = curl_init();
		$numCard = '';
		if ($_POST['numCard'] != '') {
			$partCard = explode('-',$_POST['numCard']);
			$numCard = $partCard[0].$partCard[1].$partCard[2].$partCard[3];
		}else{
			$numCard = '';
		}

		curl_setopt_array($curl, array(
		CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/card',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"name": "'.$_POST['nameCard'].'",
			"card": "'.$numCard.'",
			"expirationDate": "'.$_POST['mm'].'-'.$_POST['yy'].'",
			"identifier": "'.$_POST['validate'].'",
			"address": "'.$_POST['address'].'",
			"city": "'.$_POST['ciudad'].'",
			"locality": "'.$_POST['estado'].'",
			"postalCode": "'.$_POST['cp'].'",
			"email": "'.$_POST['emailCard'].'",
			"phoneNumber": "'.$_POST['telCard'].'"
		}',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Basic YWRtaW46c2VjcmV0',
			'Content-Type: application/json',
			'Cookie: JSESSIONID=82a5428367f2a6622b1dee691bfd'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}


	public function envio_form(){
		$ip = $_POST['ip'];

		if ($_POST['lat'] != '') {
			$lat = $_POST['lat'];
		}else{
			$lat = '32.7164928';
		}

		if ($_POST['lon'] != '') {
			$lon = $_POST['lon'];
		}else{
			$lon = '-117.1708497';
		}

		$ip = '127.0.0.1';

		$fname = $_POST['nameCard'];
		$lname = $_POST['nameCard'];
		$emailCard = $_POST['emailCard'];
		$telCard = $_POST['telCard'];

		$address = $_POST['address'];
		$estado = $_POST['estado'];
		$pais = $_POST['pais'];
		$ciudad = $_POST['ciudad'];
		$cp = $_POST['cp'];

		$nameCard = $_POST['nameCard'];


		if ($_POST['numCard'] != '') {
			$partCard = explode('-',$_POST['numCard']);
			$numCard = $partCard[0].$partCard[1].$partCard[2].$partCard[3];
		}else{
			$numCard = '';
		}

		$mm = $_POST['mm'];
		$yy = $_POST['yy'];
		$ccv = $_POST['ccv'];
		$amount = $_POST['amount'];
		$reference = $_POST['reference'];
		$urlCallback = $_POST['urlcallback'];
		$reference_pay = $_POST['reference_pay'];
		$urlImage = $_POST['urlImage'];
		$description = $_POST['description'];


		$paymentMethod = 3;


		//$email_cash = $_POST['email_cash'];

		//$email_transfer = $_POST['email_transfer'];

		if ($paymentMethod == 1) {
			// efec
			$email = $email_cash;
		}else if ($paymentMethod == 2) {
			// tranfer
			$email = $email_transfer;
		}else if ($paymentMethod == 3) {
			//card
			$email = $emailCard;
		}

		if (isset($_POST['typeCorrespondient'])) {
			$typeCorrespondient = $_POST['typeCorrespondient'];
		}else{
			$typeCorrespondient = 'Tarjeta de credito o debito';
		}

		/*echo'{
			"messagetype" : 90,
			"posEntryMode" : 6,
			"amount": '.$amount.',
			"otherAmount": 0.00,
			"user" :"testTomaz@gmail.com",
			"currency": "484",
			"reference_payment": "'.$reference_pay.'",
			"orderingAccount": "6506000008187324",
			"payment_type" :2,
			"paymentMethod": 3,
			"typeCorrespondient": "'.$typeCorrespondient.'", 
			"retrievalReferenceCode": "'.$reference.'",
			"customerInfo": {
			  "firstName":  "'.$fname.'",
			  "lastName":  "",
			  "middleName": "test",
			  "email":  "testTomaz@gmail.com",
			  "phone1":  "",
			  "city":  "'.$ciudad.'",
			  "address1":  "'.$address.'",
			  "postalCode":  "'.$cp.'",
			  "state":  "'.$estado.'",
			  "country":  "'.$pais.'",
			  "ip": "'.$ip.'"
			},
			"cardData": {
			  "cardNumber": "'.$numCard.'",
			  "cvv": "'.$ccv.'",
			  "cardholderName": "'.$nameCard.'",
			  "expirationYear": "'.$yy.'",
			  "expirationMonth": "'.$mm.'"
			},
			"itInformation": {
			  "so": "Android||Edge||IOS||Chrome",
			  "fab": "Xiaomi",
			  "model" : "MI 8 Lite||VersionNavegador",
			  "latitude": "'.$lat.'",
			  "longitude": "'.$lon.'"
			}
		  }';*/

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_KASPAYSERVICES.'/KashPay/v2/processTransaction',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"messagetype" : 90,
			"posEntryMode" : 6,
			"amount": '.$amount.',
			"otherAmount": 0.00,
			"user" :"testTomaz@gmail.com",
			"currency": "484",
			"reference_payment": "'.$reference_pay.'",
			"orderingAccount": "6506000008187324",
			"payment_type" : 2,
			"paymentMethod": 3,
			"typeCorrespondient": "'.$typeCorrespondient.'", 
			"retrievalReferenceCode": "'.$reference.'",
			"customerInfo": {
			  "firstName":  "'.$fname.'",
			  "lastName":  "'.$lname.'",
			  "middleName": "test",
			  "email":  "'.$email.'",
			  "phone1":  "",
			  "city":  "'.$ciudad.'",
			  "address1":  "'.$address.'",
			  "postalCode":  "'.$cp.'",
			  "state":  "'.$estado.'",
			  "country":  "'.$pais.'",
			  "ip": "'.$ip.'"
			},
			"cardData": {
			  "cardNumber": "'.$numCard.'",
			  "cvv": "'.$ccv.'",
			  "cardholderName": "'.$nameCard.'",
			  "expirationYear": "'.$yy.'",
			  "expirationMonth": "'.$mm.'"
			},
			"itInformation": {
			  "so": "Android||Edge||IOS||Chrome",
			  "fab": "Xiaomi",
			  "model" : "MI 8 Lite||VersionNavegador",
			  "latitude": "'.$lat.'",
			  "longitude": "'.$lon.'"
			}
		  }',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer 1234345',
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		$result = json_decode($response);

		//var_dump($result);

		curl_close($curl);

		if ($result->success == true) {
			//if ($paymentMethod == 3) {
				//if ($result->success == true) {
					$miArray = array(
						"success" => $result->success, 
						"reference" => "true", 
						"reference_pay" => $reference_pay, 
						"urlCallback" => $urlCallback, 
						"authorizationNumber" => $result->payOrder->authorizationResponse->authorizationNumber, 
						"urlImage" => $urlImage, 
						"user" => $fname.' '.$lname, 
						"email" => $emailCard, 
						"amount" => $amount, 
						"reference" => $reference,
						"description" => $description,
						"paymentMethod" => 3,
						"typeCorrespondient" => $typeCorrespondient
					);
					print_r(json_encode($miArray));
				//}
			//}else{
				/*if ($result->payOrder->statusOrder == 16) {
					$miArray = array(
						"success" => $result->success, 
						"reference" => "true", 
						"reference_pay" => $reference_pay, 
						"urlCallback" => $urlCallback, 
						"urlImage" => $urlImage, 
						"user" => $fname.' '.$lname, 
						"email" => $emailCard, 
						"amount" => $amount, 
						"reference" => $reference,
						"description" => $description,
						"paymentMethod" => $paymentMethod,
						"typeCorrespondient" => $typeCorrespondient
					);
					print_r(json_encode($miArray));
				}
			}*/
		}else{
			$miArray = array(
				"success" => $result->success, 
				"reference" => "false", 
				"message" => $result->error->message
			);
			print_r(json_encode($miArray));
		}
		

		//$datos['rows'] = json_decode($response);

		//echo json_encode($miArray);
	}

	public function searchCard(){

		$curlCards = curl_init();

		curl_setopt_array($curlCards, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/card?identifier='.$_POST['validate'],
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

		$response = curl_exec($curlCards);

		curl_close($curlCards);
		//echo $response;
		$datos = array('cards'=>json_decode($response));

		echo json_encode($datos);

		
	}

}
