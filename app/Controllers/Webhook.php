<?php

namespace App\Controllers;

class Webhook extends BaseController{
	
	public function index(){
		return view('webhook/index');
	}
}
