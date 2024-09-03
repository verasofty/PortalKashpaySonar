<?php

namespace App\Controllers;

class EstatusDispersion extends BaseController{
	
	public function index(){
		if (session('idUser')) {
       
   
       $curl_cuentas = curl_init();

			curl_setopt_array($curl_cuentas, array(
			  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getBalance/'.session('issueId'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			));


			$response_cuentas = curl_exec($curl_cuentas);

			curl_close($curl_cuentas);
      
      //echo URL_SERVICES.'/AldebaranServices/getBalance/'.session('entitySonID');

			$datos = array('cuentas'=>json_decode($response_cuentas));

			return view('estatusDispersion/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

}
