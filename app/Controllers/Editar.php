<?php

namespace App\Controllers;

class Editar extends BaseController{
	
	public function index(){

		return view('editar/index');
		
	}

	public function updateComision(){
		//"liquidationLevel": "'.$_POST['liquidacion'].'",
		
		$idVisaTP; $idMCTP;$idAMEXTP;$idIntTP;$idValesTP;
		if ($_POST['idVisaTP'] != 0) {
			$idVisaTP = '"id": '.$_POST['idVisaTP'].',';
		}else{
			$idVisaTP = '';
		}
		if ($_POST['idMCTP'] != 0) {
			$idMCTP = '"id": '.$_POST['idMCTP'].',';
		}else{
			$idMCTP = '';
		}
		if ($_POST['idAMEXTP'] != 0) {
			$idAMEXTP = '"id": '.$_POST['idAMEXTP'].',';
		}else{
			$idAMEXTP = '';
		}
		if ($_POST['idIntTP'] != 0) {
			$idIntTP = '"id": '.$_POST['idIntTP'].',';
		}else{
			$idIntTP = '';
		}
		if ($_POST['idValesTP'] != 0) {
			$idValesTP = '"id": '.$_POST['idValesTP'].',';
		}else{
			$idValesTP = '';
		}

		$idVisaE; $idMCE;$idAMEXE;$idIntE;$idValesE;
		if ($_POST['idVisaE'] != 0) {
			$idVisaE = '"id": '.$_POST['idVisaE'].',';
		}else{
			$idVisaE = '';
		}
		if ($_POST['idMCE'] != 0) {
			$idMCE = '"id": '.$_POST['idMCE'].',';
		}else{
			$idMCE = '';
		}
		if ($_POST['idAMEXE'] != 0) {
			$idAMEXE = '"id": '.$_POST['idAMEXE'].',';
		}else{
			$idAMEXE = '';
		}
		if ($_POST['idIntE'] != 0) {
			$idIntE = '"id": '.$_POST['idIntE'].',';
		}else{
			$idIntE = '';
		}
		if ($_POST['idValesE'] != 0) {
			$idValesE = '"id": '.$_POST['idValesE'].',';
		}else{
			$idValesE = '';
		}
		//CRED
		$idVisaTPC; $idMCTPC;$idAMEXTPC;$idIntTPC;$idValesTPC;
		if ($_POST['idVisaTPC'] != 0) {
			$idVisaTPC = '"id": '.$_POST['idVisaTPC'].',';
		}else{
			$idVisaTPC = '';
		}
		if ($_POST['idMCTPC'] != 0) {
			$idMCTPC = '"id": '.$_POST['idMCTPC'].',';
		}else{
			$idMCTPC = '';
		}
		if ($_POST['idAMEXTPC'] != 0) {
			$idAMEXTPC = '"id": '.$_POST['idAMEXTPC'].',';
		}else{
			$idAMEXTPC = '';
		}
		if ($_POST['idIntTPC'] != 0) {
			$idIntTPC = '"id": '.$_POST['idIntTPC'].',';
		}else{
			$idIntTPC = '';
		}
		if ($_POST['idValesTPC'] != 0) {
			$idValesTPC = '"id": '.$_POST['idValesTPC'].',';
		}else{
			$idValesTPC = '';
		}

		$idVisaEC; $idMCEC;$idAMEXEC;$idIntEC;$idValesEC;
		if ($_POST['idVisaEC'] != 0) {
			$idVisaEC = '"id": '.$_POST['idVisaEC'].',';
		}else{
			$idVisaEC = '';
		}
		if ($_POST['idMCEC'] != 0) {
			$idMCEC = '"id": '.$_POST['idMCEC'].',';
		}else{
			$idMCEC = '';
		}
		if ($_POST['idAMEXEC'] != 0) {
			$idAMEXEC = '"id": '.$_POST['idAMEXEC'].',';
		}else{
			$idAMEXEC = '';
		}
		if ($_POST['idIntEC'] != 0) {
			$idIntEC = '"id": '.$_POST['idIntEC'].',';
		}else{
			$idIntEC = '';
		}
		if ($_POST['idValesEC'] != 0) {
			$idValesEC = '"id": '.$_POST['idValesEC'].',';
		}else{
			$idValesEC = '';
		}

		/*echo '[
		  	
			  	{
					'.$idVisaTP.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idMCTP.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{

					'.$idAMEXTP.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idIntTP.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idValesTP.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},			
				{
					'.$idVisaE.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idMCE.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idAMEXE.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idIntE.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idValesE.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
			    },
			    {
					'.$idVisaTPC.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idMCTPC.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{

					'.$idAMEXTPC.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idIntTPC.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idValesTPC.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},			
				{
					'.$idVisaEC.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idMCEC.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idAMEXEC.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idIntEC.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idValesEC.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
			    }
		  ]';*/
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_SALDOS.'/Entities/fees/add/'.$_POST['contextSon'],
		  //CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/account/updateFees',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'[
			  	{
					'.$idVisaTP.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idMCTP.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{

					'.$idAMEXTP.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idIntTP.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idValesTP.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesTP']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},			
				{
					'.$idVisaE.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idMCE.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idAMEXE.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idIntE.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
				},
				{
					'.$idValesE.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesE']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Debit"
			    },
			    {
					'.$idVisaTPC.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idMCTPC.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{

					'.$idAMEXTPC.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idIntTPC.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idValesTPC.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesTPC']*100).',
			        "cardCondition": 0,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},			
				{
					'.$idVisaEC.'
			        "operationType": 22,
			        "percentage": '.($_POST['tasaVisaEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idMCEC.'
			        "operationType": 27,
			        "percentage": '.($_POST['tasaMCEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idAMEXEC.'
			        "operationType": 23,
			        "percentage": '.($_POST['tasaAMEXEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idIntEC.'
			        "operationType": 57,
			        "percentage": '.($_POST['tasaInterEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
				},
				{
					'.$idValesEC.'
			        "operationType": 56,
			        "percentage": '.($_POST['tasaValesEC']*100).',
			        "cardCondition": 1,
			        "periodType": 0,
			        "accountabilityNature": "Credit"
			    }
		  ]',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic YWRtaW46c2VjcmV0',
		    'Content-Type: application/json',
		    'Cookie: JSESSIONID=8364162c637902409a438c5e743d'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$datos = array('rows'=>json_decode($response));
		echo json_encode($datos);
	}
}