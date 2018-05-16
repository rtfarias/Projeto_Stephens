<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Sentinel;

class BaseController extends Controller
{

	protected $current_user;
	protected $current_module;
	protected $current_role;
	protected $current_template;

	public function __construct()
	{

		$this->current_user = Sentinel::getUser();
		if($this->current_user){
			\View::share('current_user', $this->current_user);
			$user = \App\User::find($this->current_user->id);
			$this->current_role = Sentinel::findRoleById($user->roleUser->role_id);

			if($this->current_role->id == 1){
				$this->current_template = 'layouts.app';
			}else{
				$this->current_template = 'layouts.restrito.restrito';
			}
			\View::share('current_template', $this->current_template);

			\View::share('current_role', $this->current_role);
		}


		$currentPath = \Request::path();
		$pieces = explode('/', $currentPath);
		if(!empty($pieces) && isset($pieces[1])){
			$this->current_module = \App\Gerador::where('rota',$pieces[1])->first();
		}else{
			$this->current_module = null;
		}



		\View::share('current_module', $this->current_module);
	}

}
