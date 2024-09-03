<?php

namespace App\Controllers;
use App\Libraries\ExportExcel;

class ExportarExcel extends BaseController{
	
	public function dExcel($num_page){
		$today_hora = date("Y-m-d H:i:s"); 

		$curl = curl_init();
    	
		curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://44.199.131.117/Entities/entities/'.session('entitySonID').'/getoperationbytypeandstatus?type='.$_POST['type'].'&status='.$_POST['status'].'&page=&size='.$num_page,
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

		$response = curl_exec($curl);

		//var_dump($response);
		curl_close($curl);

		$datos['rows']= json_decode($response);
		
		$this->ExportExcel->to_excel(json_encode($datos),'Operaciones-'.$today_hora);
		
	}

}