<?php

namespace App\Controllers;

class Dispersion extends BaseController{
	
	public function index(){
		if (session('idUser')) {
			if (session('idRol') == 2) {
				$idcontext = 0;
				$contexCombo = '';
			}else{
				//$idcontext = session('idcontextResponse')[0];
				$contexCombo = session('issueId');
			}

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


			$curl_cuentas2 = curl_init();

			curl_setopt_array($curl_cuentas2, array(
			  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getAllBalance/'.session('issueId'),
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response_cuentas2 = curl_exec($curl_cuentas2);

			curl_close($curl_cuentas2);

			$curl_combo = curl_init();

			curl_setopt_array($curl_combo, array(
			  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.$contexCombo.'&level=',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response_combo = curl_exec($curl_combo);

			curl_close($curl_combo);

			$datos = array('cuentas'=>json_decode($response_cuentas),'cuentas2'=>json_decode($response_cuentas2),'combo'=>json_decode($response_combo));
      /*var_dump(URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.$contexCombo.'&level=');
      var_dump($response_combo);*/
			return view('dispersion/index',$datos);
		}else{
			return redirect()->to(base_url().'/');
		}
	}
	public function cargarArchivo(){
	    //Windows
        //$url = 'C:/xampp/htdocs/portal/public/dist/file/dispersiones/';
        $url = "/var/www/html/adquirencia/public/assets/files/dispersiones/";
        $urlCallback = 'https://www.google.com';
        $nameRef= explode('.',$_FILES["customFile"]["name"]); 

        //echo $nameRef[1]; 

        if ($nameRef[1] != 'csv') {
        	echo '1';
       	}else{

	        $customFile = $_FILES["customFile"];

	        if ($customFile['name'] != null) {
	            $tmp_name = $customFile["tmp_name"];
	            $name = $customFile["name"];
	            $newfilename = 'CARGATRN_'.$_POST['afiliacion'].'_'.$_POST['dateTime'].'.csv';
	            $customFile["name"] = $newfilename;
	            $ruta_img = $url.$newfilename;

	            //$move = move_uploaded_file($tmp_name, $ruta_img);
	            $move =move_uploaded_file($_FILES['customFile']['tmp_name'], $ruta_img );
	           

	            echo('2');
	            
	        }else{
	        	echo('0');
	        }
    	}

		/*$file = $_FILES['customFile']['name'];

		$remote_file = $_FILES['customFile']['tmp_name'];
		$tama = $_FILES["customFile"]["size"];

		$ftp_server = SERVIDOR_FTP;
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, USUARIO_FTP, PASSWORD_FTP);

		print_r($_FILES['customFile']);

		if (!$ftp_conn || !$login) { 
			die('Parece que no se puede conectar'); 
		}else{
			echo 'hi'."\n";
		}
		$log_error=fopen($remote_file,'a');

		echo('log_error ='.$log_error."\n");

		echo 'hi2'."\n";

		$directorio='/home/ftpgbm/ftp/'.$file; 

		echo('directorio ='.$directorio."\n");

		$f_w=fwrite($log_error,"\n".date('m-d-Y h:i:s a', time())." - Conexión al FTP con errores,  Intentando conectar a ".SERVIDOR_FTP);

		echo('f_w ='.$f_w);

		


		$f_put=ftp_put($ftp_conn, $directorio, $remote_file, FTP_BINARY);

		echo 'f_put'.$f_put;

		fclose($log_error);

		
		/*$ruta = SERVIDOR_FTP."/opt/payara52/payara5/glassfish/domains/domain1/docroot/disperciones/POR_PROCESAR/";
		// Verificamos si no hemos excedido el tamaño del archivo
		
			// Verificamos si ya se subio el archivo temporal
			echo 'despues ruta';
			if (is_uploaded_file($remote_file)){
				// copiamos el archivo temporal, del directorio de temporales de nuestro servidor a la ruta que creamos
			echo 'is ';

				//copy($remote_file, $ruta);	

			echo 'despues copy ';

			}
			// Sino se pudo subir el temporal
			else {
				echo "no se pudo subir el archivo ".$file;
			}
		
		echo "Ruta: " . $ruta;

		// cerrar la conexión ftp
		ftp_close($ftp_conn);


		/*    //if (isset($_POST['submit'])) {  
		      if (!empty($_FILES['customFile']['name'])) {  
		        $ch = curl_init();  
		        $localfile = $_FILES['customFile']['tmp_name'];  
		        $fp = fopen($localfile, "r");  
		        curl_setopt($ch, CURLOPT_URL, "ftp://".USUARIO_FTP.":".PASSWORD_FTP."@".SERVIDOR_FTP."/".$_FILES['customFile']['name']);  
		        curl_setopt($ch, CURLOPT_UPLOAD, 1);  
		        curl_setopt($ch, CURLOPT_INFILE, $fp);  
		        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));  
		        curl_exec ($ch);  
		        $error_no = curl_errno($ch);  
		        curl_close ($ch);  
		        if ($error_no == 0) {  
		          $error = "Fichero subido correctamente.";  
		        } else {  
		          $error = "Error al subir el fichero.";  
		        }  
		      } else {  
		        $error = "Selecciona un fichero.";  
		      }  
		    //}  */
	}
}
