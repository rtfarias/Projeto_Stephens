<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Http\Requests\AdminUsersEditFormRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Role;
use App\Gerador;
use App\Permission;
use Sentinel;

class RoleController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->middleware('auth');
	}

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$data['listaRole'] = Role::all();
		return view('admin/roles', $data);
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($id)
	{
		$user = $this->user->find($id);
		$user_role = $user->roles->first()->name;

		return view('protected.admin.show_user')->withUser($user)->withUserRole($user_role);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/

	public function add()
	{
		$data['modulos'] = Gerador::where('id_tipo_modulo','!=','3')->get();

		return view('admin/form-role', $data);
	}

	public function edit($id)
	{
		$data['role'] = Role::find($id);
		$data['roleSentinel'] = Sentinel::findRoleById($data['role']->id);
		$data['modulos'] = Gerador::where('id_tipo_modulo','!=','3')->get();
		return view('admin/form-role', $data);
	}

	public function save(Request $request){
		try{
			$post = $request->input();
			if($request->input('id')){
				$id_role = $request->input('id');
				Role::editar($post, $id_role);
				$role = Role::find($id_role);
				foreach ($role->permissionsRole as $permission) {
					$permission->delete();
				}
			}else{
				$id_role = Role::criar($post);
			}
			$role = Sentinel::findRoleById($id_role);
			if(isset($post['permission'])){
				$permissions = [];
				foreach ($post['permission'] as $permission_name) {
					$permissions[$permission_name] = true;
				}
				$role->permissions = $permissions;
				$role->save();
			}else{
				$role->permissions = [];
				$role->save();
			}
			\Session::flash('type', 'success');
			\Session::flash('message', "Alteracoes salvas com sucesso!");
			return redirect('admin/roles');
		}catch(Exception $e){
			\Session::flash('type', 'error');
			\Session::flash('message', $e->getMessage());
			return redirect()->back();
		}

	}

	public function delete($id){
		$role = Role::find($id);
		$role->delete();
		return redirect()->back();
	}
}
