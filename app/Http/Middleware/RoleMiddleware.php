<?php

namespace App\Http\Middleware;

use App\Http\Controllers\BaseController;
use Closure;

class RoleMiddleware extends BaseController
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle($request, Closure $next, $method, $second_method = null)
	{
		$condition = $this->current_role->hasAccess($this->current_module->nome_tabela.'.'.$method);
		if($second_method){
			$condition = $condition || $this->current_role->hasAccess($this->current_module->nome_tabela.'.'.$second_method);
		}
		if($this->current_role->id == 4){
			$condition = $condition || $this->current_user->hasAccess($this->current_module->nome_tabela.'.'.$method);
		}
		if($condition){
			return $next($request);
		}else{
			if ($request->ajax()) {
				 return response('Bad Permissions.', 401);
			} else {
				return redirect('admin/bad_permissions');
			}
		}

	}
}
