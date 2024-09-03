<?php 
//El ini_set modifica (setea) parámetros del php.ini.
//El display_errors en 0 apaga la muestra de errores, en 1 lo habilita
//En la línea 21, tenemos un error que se muestra o no, según este valor

$url = $_SERVER['HTTP_HOST'];
$file = preg_match( '/localhost/', $url ) ? 'ini_local.ini' : 'ini_online.ini';

$cfg = parse_ini_file( $file , true );

ini_set('display_errors', $cfg['errores']['display'] );
error_reporting( $cfg['errores']['reporting'] );
date_default_timezone_set( 'America/Argentina/Buenos_aires' );

$nombre = 'German';
$apellido = 'Rodriguez';
$email = 'german@email.com';

$logueado = false;

##Conexion al SQL
$host = 'localhost';
// $user = 'root';
// $pass = '';
// $db = 'blog';

$cnx = @mysqli_connect( $host, $cfg['mysql']['user'], $cfg['mysql']['clave'], $cfg['mysql']['bdd'] );
if($cnx){
	mysqli_set_charset( $cnx, 'utf8mb4' );
}

session_start( ); //inicia las sesiones, para leerlas o escribirlas

function verificar_seguridad( $nivel = 'administrador' ){
	return $_SESSION['NIVEL'] == $nivel;
}

function escape( $valor ){
	global $cnx;
	return mysqli_real_escape_string( $cnx, $valor );
}




?>