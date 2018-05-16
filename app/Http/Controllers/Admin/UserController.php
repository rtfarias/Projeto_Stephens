<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\User;
use Sentinel;
use App\Services\CondominioService;
use Activation;
use App\Modules\Cidades\Models\Cidades;

class UserController extends BaseController
{
	public function __construct(){
		parent::__construct();
		$this->middleware('auth');
	}

	public function index(){
		if(!$this->current_user->inRole('admins')){
			return redirect('admin');
		}

		$data['listaUser'] = \App\User::all();


		return view('admin/users',$data);
	}

	public function add(){
		$data = array();
		$data['roles'] = \App\Role::get();
		$data['userLogado'] = \App\User::find(Sentinel::getUser()->id);

		$data['cidades'] = [];
		$data['estados'] = DB::table('estados')->get();

		//$data['id_condominio'] = CondominioService::buscarCondominioAtual();
		return view('admin/form-users', $data);
	}

	public function edit($id){
		$data['user'] = \App\User::find($id);
		$data['roles'] = \App\Role::get();
		$data['userLogado'] = \App\User::find(Sentinel::getUser()->id);
		$data['cidades'] = DB::table('cidades')->get();
		$data['estados'] = DB::table('estados')->get();
		//$data['id_condominio'] = CondominioService::buscarCondominioAtual();
		return view('admin/form-users',$data);
	}



	public function save(Request $request){
		try{
			$post = $request->input();

			$role = Sentinel::findRoleById($post['id_role']);
			if($request->input('id')){
				$id_user = \App\User::editar($post, $request->input('id'));
				$user = Sentinel::findById($id_user);
				$user->roles()->detach();
			}else{
				$id_user = \App\User::criar($post);
				$user = Sentinel::findById($id_user);
				$activation = Activation::create($user);
				Activation::complete($user, $activation->code);
			}

			$role->users()->attach($user);
			\Session::flash('type', 'success');
			\Session::flash('message', "Alteracoes salvas com sucesso!");
			return redirect('admin/users');
		}catch(\Illuminate\Database\QueryException $e){
			\Session::flash('type', 'error');
			\Session::flash('message', $e->getMessage());
			return redirect()->back();
		}


	}

	public function buscaCidades(){

		$result = Cidades::select('cidades.*')->where('estado', $_GET['estado'])->get();
		$data['cidades'] = [];
		$data['cidades'] = $result;
		return $result;
	}

	public function upload_image(Request $request) {
		if($request->hasFile('file')) {
			//upload an image to the /img/tmp directory and return the filepath.
			$file = $request->file('file');
			$tmpFilePath = '/uploads/users/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
			return response()->json(array('path'=> $path, 'file_name'=>$tmpFileName), 200);
		} else {
			return response()->json(false, 200);
		}
	}

	public function crop_image(Request $request) {
		$img = \Image::make('uploads/users/'.$request->input('file_name'));
		$dataCrop = json_decode($request->input('data_crop'));
		if($img->crop(intval($dataCrop->width), intval($dataCrop->height), intval($dataCrop->x), intval($dataCrop->y))->save('uploads/users/thumb_'.$request->input('file_name'))){
			@unlink('uploads/users/'.$request->input('file_name'));
			echo json_encode(array(
				'status' => true,
				'path' => '/uploads/users/thumb_'.$request->input('file_name'),
				'file_name' => 'thumb_'.$request->input('file_name'),
			));
		}else{
			echo json_encode(array(
				'status' => false,
				'message' => 'Não foi possível alterar a imagem.'
			));
		}

	}

	public function delete($id){
		try{
			$user = \App\User::find($id);
			DB::table('sis_users')
			->where('id', $id)
			->delete();
			@unlink("uploads/users/$user->thumbnail_principal");
			\Session::flash('type', 'success');
			\Session::flash('message', "Registro removido com sucesso!");
			return redirect('admin/users');
		}catch(Exception $e){
			\Session::flash('type', 'error');
			\Session::flash('message', "Nao foi possivel remover o registro!");
			return redirect()->back();
		}


	}
}
