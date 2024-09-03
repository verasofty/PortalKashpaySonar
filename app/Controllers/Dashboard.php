<?php

namespace App\Controllers;

class Dashboard extends BaseController{
	public function index(){
		$curl = curl_init();
		$datos = array();
		$response = '';
		if (session('idBusinessModel')) {
			if (session('idBusinessModel') == 1) {
				
			} else if (session('idBusinessModel') == 2) {
				curl_setopt_array($curl, array(
					CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&searchBy=0&startDate=&endDate=',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
					  'Authorization: Basic YWRtaW46c2VjcmV0',
					  'Cookie: JSESSIONID=fc9b7dffc60b37d679f9797a0753'
					),
				));
				$datos['rows']=json_decode($response);
			}else if (session('idBusinessModel') == 3){
				if (session('idRol') != 2) {
					curl_setopt_array($curl, array(
						CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&searchBy=0&startDate=&endDate=',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'GET',
						CURLOPT_HTTPHEADER => array(
						  'Authorization: Basic YWRtaW46c2VjcmV0',
						  'Cookie: JSESSIONID=fc9b7dffc60b37d679f9797a0753'
						),
					));
					$datos['rows']=json_decode($response);

				} else {
					$datos['rows']= 'Sin datos';
				}
			}
			$response = curl_exec($curl);
			curl_close($curl);
			return view('dashboard/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}

	public function searchResults(){
		$curl = curl_init();
		$url = '';
		if ($_POST['rango'] == -11) {
			$porciones_ini = explode(" ", $_POST['fechaI']);
			$porciones_fin = explode(" ", $_POST['fechaF']);

            $location = curl_escape($curl, $porciones_ini[0].' '.$porciones_ini[1]);
            $location2 = curl_escape($curl, $porciones_fin[0].' '.$porciones_fin[1]);

			$url =  WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&searchBy='.$_POST['rango'].'&startDate='.$location.'&endDate='.$location2;

			//echo $url;

			//$url = WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext=30&idEntity=0&idTerminal=0&searchBy='.$_POST['rango'].'&startDate=&endDate=';
		}else{
			$url =  WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&searchBy='.$_POST['rango'].'&startDate='.$_POST['fechaI'].'&endDate='.$_POST['fechaF'];

			//$url = WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/dashboard/getConfig?idContext=30&idEntity=0&idTerminal=0&searchBy='.$_POST['rango'].'&startDate='.$_POST['fechaI'].'&endDate='.$_POST['fechaF'];
		}

		//echo $url;
		if (session('idRol') == 2) {
			/*curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=c275f226d7a7ca4b7096a967057e'
			  ),
			));*/
		}else if (session('idRol') == 3) {
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=c275f226d7a7ca4b7096a967057e'
			  ),
			));
		}else if (session('idRol') == 4) {
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=c275f226d7a7ca4b7096a967057e'
			  ),
			));
		}else if (session('idRol') == 5) {
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=c275f226d7a7ca4b7096a967057e'
			  ),
			));
		}else if (session('idRol') == 6) {
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic YWRtaW46c2VjcmV0',
			    'Cookie: JSESSIONID=c275f226d7a7ca4b7096a967057e'
			  ),
			));
		}

		

		$response = curl_exec($curl);

		curl_close($curl);

		if (session('idRol') != 2) {
			$datos = array('rows'=>json_decode($response));
		}else{
			$datos = array('rows'=> 'Sin datos');
			//$datos = array('rows'=>json_decode($response));

		}
		//var_dump(session('idRol'));

		//return view('addSucursal/index',$datos);
		//return view('dashboard/index', $datos);
		echo json_encode($datos);
	}
}
