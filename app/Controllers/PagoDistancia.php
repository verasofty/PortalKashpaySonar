<?php

namespace App\Controllers;

class PagoDistancia extends BaseController{
	
	public function index(){
		//if (session('idUser')) {
			return view('pagoDistancia/index');
		/*}else{
			return redirect()->to(base_url().'/');
		}*/

		//var_dump($datos);

		//return view('pagoDistancia/index',$datos);
		 
	}

	public function searchLink(){
		//var_dump($_POST);

		$curlNL = curl_init();
		curl_setopt_array($curlNL, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/getPaymentLinkStatus?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&date='.$_POST['filtro'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic YWRtaW46c2VjcmV0',
				'Cookie: JSESSIONID=131eb2aa155148bd181e012e8502'
			),
		));
		$responseNL = curl_exec($curlNL);
		curl_close($curlNL);

		//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&amount=&reference&date='.$_POST['filtro'].'&page='.$_GET['page'];
			
		$curlLinks = curl_init();
		curl_setopt_array($curlLinks, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&amount=&reference&date='.$_POST['filtro'].'&page='.$_GET['page'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic YWRtaW46c2VjcmV0',
				'Cookie: JSESSIONID=131eb2aa155148bd181e012e8502'
			),
		));
		$responseLinks = curl_exec($curlLinks);
		curl_close($curlLinks);

		$datos = array('numLinks'=>json_decode($responseNL),'links'=>json_decode($responseLinks));

		

		echo json_encode($datos);
	}
}
