<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

class BasicInfoController extends BaseController
{
	public function __construct(){
		parent::__construct();
		$this->middleware('auth');
	}

	public function index(){
		$data['info'] = \App\BasicInfo::find(1);
		return view('admin/basic-info',$data);
	}

	public function save(Request $request){
		$contato = \App\BasicInfo::find(1);
		if($contato){
			try{
				\App\BasicInfo::editar($request->input(), 1);
				\Session::flash('type', 'success');
				\Session::flash('message', "Registro alterado com sucesso!");
			}catch(Exception $e){
				\Session::flash('type', 'error');
				\Session::flash('message', "Não foi possível alterar o registro!");
			}
		}else{
			\Session::flash('type', 'error');
			\Session::flash('message', "Não foi possível encontrar o registro fixo do módulo de contato.");
		}
		return redirect('/admin/informacoes-basicas');
	}

}
