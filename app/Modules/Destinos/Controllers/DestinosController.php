<?php

namespace App\Modules\Destinos\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DestinosController extends Controller
{
	private $modulo;
	private $fields;

    public function __construct(){
		$this->modulo = \App\Gerador::find(25);
		$this->fields = \App\CampoModulo::where('id_modulo',25)->get();
	}

	public function index(){
		$data = array();
		return view('destinos',$data);
	}
}
