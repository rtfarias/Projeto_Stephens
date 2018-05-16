<?php

// ================================
// Cidades routes BEGGINING
// ================================

Route::group(array('middleware' => 'web', 'namespace' => 'App\Modules\Cidades\Controllers'), function() {
	Route::get('cidades', ['uses' => 'CidadesController@index']);
	Route::get('cidades/detalhe/{slug}', ['uses' => 'CidadesController@detalhe']);
});

Route::group(array('middleware' => ['auth','role:view'], 'namespace' => 'App\Modules\Cidades\Controllers\Admin'), function() {
	Route::get('admin/cidades', ['uses' => 'AdminCidadesController@index']);
});

Route::group(array('middleware' => ['auth','role:create'], 'namespace' => 'App\Modules\Cidades\Controllers\Admin'), function() {
	Route::get('admin/cidades/add', ['uses' => 'AdminCidadesController@add']);
});

Route::group(array('middleware' => ['auth','role:update'], 'namespace' => 'App\Modules\Cidades\Controllers\Admin'), function() {
	Route::get('admin/cidades/edit/{id}', ['uses' => 'AdminCidadesController@edit']);
});

Route::group(array('middleware' => ['auth','role:delete'], 'namespace' => 'App\Modules\Cidades\Controllers\Admin'), function() {
	Route::get('admin/cidades/delete/{id}', ['uses' => 'AdminCidadesController@delete']);
});

Route::group(array('middleware' => ['auth','role:update,create'], 'namespace' => 'App\Modules\Cidades\Controllers\Admin'), function() {
	Route::post('admin/cidades/save', ['uses' => 'AdminCidadesController@save']);
	Route::post('admin/cidades/upload', ['uses' => 'AdminCidadesController@upload_image']);
	Route::post('admin/cidades/crop', ['uses' => 'AdminCidadesController@crop_image']);
	Route::post('admin/cidades/upload_galeria/{id}', ['uses' => 'AdminCidadesController@upload_galeria']);
	Route::post('admin/cidades/delete_imagem/{id}', ['uses' => 'AdminCidadesController@delete_imagem']);
});
