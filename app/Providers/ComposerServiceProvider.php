<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Questionamento\Models\Questionamento;
use App\Modules\Notificacao\Models\Notificacao;
use App\Services\CondominioService;
use Sentinel;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	* Bootstrap the application services.
	*
	* @return void
	*/
	public function boot()
	{
		//
		\View::composer('layouts/website', function($view){
			$data = array();
			$data['basic_info'] = \App\BasicInfo::find(1);
			$view->with('data', $data);
		});
		\View::composer('layouts/app', function($view){
			$data = array();
			$data['modulos'] = \App\Gerador::where('id_tipo_modulo', '!=', 3)->where('menu', 1)->orderBy('ordem', 'ASC')->orderBy('label', 'ASC')->get();
			$view->with('data', $data);
		});
		\View::composer('layouts/restrito/restrito', function($view){
			$user = Sentinel::getUser();
			$data = array();
			$data['modulos'] = \App\Gerador::where('id_tipo_modulo', '!=', 3)->where('menu', 1)->orderBy('ordem', 'ASC')->orderBy('label', 'ASC')->get();
			$view->with($data);
		});

	}

	/**
	* Register the application services.
	*
	* @return void
	*/
	public function register()
	{
		//
	}
}
