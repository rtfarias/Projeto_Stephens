<?php

namespace App\Modules\Usuarios\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
	private $modulo;
	private $fields;

    public function __construct(){
		$this->modulo = \App\Gerador::find(21);
		$this->fields = \App\CampoModulo::where('id_modulo',21)->get();
	}

	public function index(){
		$data = array();
		return view('usuarios',$data);
	}
}
