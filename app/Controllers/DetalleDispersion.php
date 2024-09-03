<?php

namespace App\Controllers;

class DetalleDispersion extends BaseController{
	
	public function index(){
		if (session('idUser')) {
      
			return view('detalleDispersion/index');
		}else{
			return redirect()->to(base_url().'/');
		}
	}
}
