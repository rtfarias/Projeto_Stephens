<?php

namespace App\Modules\Cidades\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CidadesController extends Controller
{
	private $modulo;
	private $fields;

    public function __construct(){
		$this->modulo = \App\Gerador::find(20);
		$this->fields = \App\CampoModulo::where('id_modulo',20)->get();
	}

	public function index(){
		$data = array();
		return view('cidades',$data);
	}
}
