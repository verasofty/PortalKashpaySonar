<?php

namespace App\Controllers;

class Contacto extends BaseController{

	public function index(){
		return view('contacto/index');
	}

	// Función que envía el email
	public function  sendMail() {

		echo 'ok';

		/*$config['mail'] = array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'onsigna.com',    // My host name
		    'smtp_port' => 2525,
		    'smtp_user' => 'username',   // My username
		    'smtp_pass' => 'password',   // My password
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE,
		    'smtp_timeout' => 30,
		    'newline' => "\r\n",
		    'crlf' => "\r\n",
		    'mailtype' => "text"
		);


		date_default_timezone_set('Africa/Accra');    // This was to cater for an error given to me earlier
        $this->config->load('email', TRUE);//load email config file
        $confiuration = $this->config->item('mail', 'email');//email configuration

        $this->load->library('email');
        $this->email->initialize($configuration);//initializes email configuration

        $this->email->from('the email I used in the email.php', "Name");
        $this->email->to('email to send to');
        $this->email->subject('Test email');
        $this->email->message("Testing the email class");

        var_dump($this->email->send());
        $this->email->print_debugger();

		/*$email = \Config\Services::email();

		$email->setFrom('monica.aviles@onsigna.com', 'Your Name');
		$email->setTo('monica.aviles@onsigna.com');
		$email->setCC('monica.aviles@onsigna.com');
		$email->setBCC('monica.aviles@onsigna.com');

		$email->setSubject('Email Test');
		$email->setMessage('Testing the email class.');

		$email->send();

		if ($email->send()) {
			echo 'ok';
		}else{
			echo 'fail'.$email->send();
			var_dump($email->send());
		}*/

		
	}

	public function contactar(){
		$hoy  = date("d/m/Y");  

        $titulo  = 'ORDEN DE COMPRA '; 
		$para    = "monica.aviles@onsigna.com";

        $mensaje = "<div> OKKO </div>";  

        $from='support@onsigna.com';


        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\n"; 
        $headers .= "From: ". $from ."\r\n". 
                    "Bcc: mony.a.910915@gmail.com";

		if (mail($para, $titulo, $mensaje, $headers) ) {
		   echo "ok";
		}  else{
			echo "string";
		}

	}
}
