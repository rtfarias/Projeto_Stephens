<?php

namespace App\Modules\Categorias\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriasController extends Controller
{
	private $modulo;
	private $fields;

    public function __construct(){
		$this->modulo = \App\Gerador::find(12);
		$this->fields = \App\CampoModulo::where('id_modulo',12)->get();
	}

	public function index(){
		$data = array();
		return view('categorias',$data);
	}
}
