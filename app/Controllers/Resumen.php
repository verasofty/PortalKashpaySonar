<?php

namespace App\Controllers;

class Resumen extends BaseController{
	
	public function index(){
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
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));	
			$response = json_decode( curl_exec($curl));

			curl_close($curl);

			/*********************ADICIONALES**********************/

			$curl_subafiliado = curl_init();
			curl_setopt_array($curl_subafiliado, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/com.onsigna',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_subafiliado = json_decode( curl_exec($curl_subafiliado));

			curl_close($curl_subafiliado);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows'=>$response,
					'subafiliados'=> $response_subafiliado
				);
			}

		}else if(session('idRol') == 3){
			//subafiliado
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));	
			$response = json_decode( curl_exec($curl));
      
      		//var_dump($response);

			curl_close($curl);

			$curl_comision = curl_init();

          	curl_setopt_array($curl_comision, array(
	            CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.session('entitySonID'),
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => '',
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 0,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => 'GET',
	            CURLOPT_HTTPHEADER => array(
	              'Authorization: Basic YWRtaW46c2VjcmV0',
	              'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	            ),
	        ));

        	$response_comision = json_decode( curl_exec($curl_comision));

          	curl_close($curl_comision);

			/*********************ADICIONALES**********************/

			$curl_entidad = curl_init();
			curl_setopt_array($curl_entidad, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_entidad = json_decode( curl_exec($curl_entidad));

			curl_close($curl_entidad);
      
      		//var_dump($response_entidad);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows' => $response,
					'entidades' => $response_entidad,
					'comisiones' => $response_comision
				);
			}

		}else if(session('idRol') == 4){
			//entidad
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response = json_decode( curl_exec($curl));

			curl_close($curl);

			/*********************ADICIONALES**********************/

			$curl_sucursal = curl_init();
			curl_setopt_array($curl_sucursal, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_sucursal = json_decode( curl_exec($curl_sucursal));

			curl_close($curl_sucursal);

			$curl_entidad = curl_init();
			curl_setopt_array($curl_entidad, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_entidad = json_decode( curl_exec($curl_entidad));

			curl_close($curl_entidad);

			$curl_comision = curl_init();
          	curl_setopt_array($curl_comision, array(
	            CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.session('entitySonID'),
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => '',
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 0,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => 'GET',
	            CURLOPT_HTTPHEADER => array(
	              'Authorization: Basic YWRtaW46c2VjcmV0',
	              'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	            ),
	        ));
        	$response_comision = json_decode( curl_exec($curl_comision));
          	curl_close($curl_comision);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows' => $response,
					'sucursales'=>$response_sucursal,
					'comisiones'=>$response_comision
				);
			}



		}else if(session('idRol') == 5){
			//sucursal
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response = json_decode( curl_exec($curl));

			curl_close($curl);

			$curl_entidad = curl_init();
			curl_setopt_array($curl_entidad, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_entidad = json_decode( curl_exec($curl_entidad));

			curl_close($curl_entidad);

			$curl_comision = curl_init();
          	curl_setopt_array($curl_comision, array(
	            CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.session('entitySonID'),
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => '',
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 0,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => 'GET',
	            CURLOPT_HTTPHEADER => array(
	              'Authorization: Basic YWRtaW46c2VjcmV0',
	              'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	            ),
	        ));
        	$response_comision = json_decode( curl_exec($curl_comision));
          	curl_close($curl_comision);

			/*********************ADICIONALES**********************/

			$curl_caja = curl_init();
			curl_setopt_array($curl_caja, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_caja = json_decode( curl_exec($curl_caja));

			curl_close($curl_caja);
      
      //var_dump($response_caja);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows' => $response,
					'sucursales'=>$response_caja,
					'comisiones'=>$response_comision
				);
			}


		}else if(session('idRol') == 6){
			//colaborador
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));

			$response = json_decode( curl_exec($curl));

			curl_close($curl);

			$curl_caja = curl_init();
			curl_setopt_array($curl_caja, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_caja = json_decode( curl_exec($curl_caja));

			curl_close($curl_caja);

			$curl_comision = curl_init();
          	curl_setopt_array($curl_comision, array(
	            CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.session('entitySonID'),
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => '',
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 0,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => 'GET',
	            CURLOPT_HTTPHEADER => array(
	              'Authorization: Basic YWRtaW46c2VjcmV0',
	              'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	            ),
	        ));
        	$response_comision = json_decode( curl_exec($curl_comision));
          	curl_close($curl_comision);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows' => $response,
					'comisiones' => $response_comision
				);
			}
		}else if(session('idRol') == 7){
			//comisionista
			curl_setopt_array($curl, array(
			  CURLOPT_URL => WS_SALDOS.'/Entities/entities/getBalance/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response = json_decode( curl_exec($curl));

			curl_close($curl);

			/*********************ADICIONALES**********************/

			$curl_sucursal = curl_init();
			curl_setopt_array($curl_sucursal, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_sucursal = json_decode( curl_exec($curl_sucursal));

			curl_close($curl_sucursal);

			$curl_entidad = curl_init();
			curl_setopt_array($curl_entidad, array(
			  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.session('entitySonID'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET'
			));
			$response_entidad = json_decode( curl_exec($curl_entidad));

			curl_close($curl_entidad);

			$curl_comision = curl_init();
          	curl_setopt_array($curl_comision, array(
	            CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.session('entitySonID'),
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => '',
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 0,
	            CURLOPT_FOLLOWLOCATION => true,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => 'GET',
	            CURLOPT_HTTPHEADER => array(
	              'Authorization: Basic YWRtaW46c2VjcmV0',
	              'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	            ),
	        ));
        	$response_comision = json_decode( curl_exec($curl_comision));
          	curl_close($curl_comision);

			if (!isset($response->createdAt)) {
				$datos = ['rows'=>[
							"onsignaEntity"=> [
								"balance"=> 0
							]
						]];
			}else{
				$datos = array(
					'rows' => $response,
					'sucursales'=>$response_sucursal,
					'comisiones'=>$response_comision
				);
			}



		}
		
		var_dump($response);
		var_dump($response_sucursal);
		var_dump($response_comision);

		return view('resumen/index', $datos);
	}


	public function search($id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => WS_SALDOS.'/'.'Entities/entities/getChildren/'.$id,
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

		if ($response != '[]') {
			$datos['rows']= json_decode($response);
			$datos['success'] = '1';
		}else{
			$datos['rows']= 'No se encontraron resultados';
			$datos['success'] = '0';
		}

		
		echo json_encode($datos);

		//echo json_encode($response);
	}

	public function searchComision($id){
		$curl = curl_init();

    	curl_setopt_array($curl, array(
	        CURLOPT_URL => WS_SALDOS.'/Entities/fees/get/'.$id,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => '',
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => 'GET',
	        CURLOPT_HTTPHEADER => array(
	          'Authorization: Basic YWRtaW46c2VjcmV0',
	          'Cookie: JSESSIONID=8283c6274faf5ae11079bdac8fb4'
	        ),
      	));

      	$response = json_decode( curl_exec($curl));
    	curl_close($curl);

    	echo json_encode($response);

    	//var_dump($response);
	}

}
