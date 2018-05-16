<?php

namespace App\Modules\Clientes\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
	private $modulo;
	private $fields;

    public function __construct(){
		$this->modulo = \App\Gerador::find(10);
		$this->fields = \App\CampoModulo::where('id_modulo',10)->get();
	}

	public function index(){
		$data = array();
		return view('clientes',$data);
	}
}
