<?php

// ================================
// Clientes routes BEGGINING
// ================================

Route::group(array('middleware' => 'web', 'namespace' => 'App\Modules\Clientes\Controllers'), function() {
	Route::get('clientes', ['uses' => 'ClientesController@index']);
	Route::get('clientes/detalhe/{slug}', ['uses' => 'ClientesController@detalhe']);
});

Route::group(array('middleware' => ['auth','role:view'], 'namespace' => 'App\Modules\Clientes\Controllers\Admin'), function() {
	Route::get('admin/clientes', ['uses' => 'AdminClientesController@index']);
});

Route::group(array('middleware' => ['auth','role:create'], 'namespace' => 'App\Modules\Clientes\Controllers\Admin'), function() {
	Route::get('admin/clientes/add', ['uses' => 'AdminClientesController@add']);
});

Route::group(array('middleware' => ['auth','role:update'], 'namespace' => 'App\Modules\Clientes\Controllers\Admin'), function() {
	Route::get('admin/clientes/edit/{id}', ['uses' => 'AdminClientesController@edit']);
});

Route::group(array('middleware' => ['auth','role:delete'], 'namespace' => 'App\Modules\Clientes\Controllers\Admin'), function() {
	Route::get('admin/clientes/delete/{id}', ['uses' => 'AdminClientesController@delete']);
});

Route::group(array('middleware' => ['auth','role:update,create'], 'namespace' => 'App\Modules\Clientes\Controllers\Admin'), function() {
	Route::post('admin/clientes/save', ['uses' => 'AdminClientesController@save']);
	Route::post('admin/clientes/upload', ['uses' => 'AdminClientesController@upload_image']);
	Route::post('admin/clientes/crop', ['uses' => 'AdminClientesController@crop_image']);
	Route::post('admin/clientes/upload_galeria/{id}', ['uses' => 'AdminClientesController@upload_galeria']);
	Route::post('admin/clientes/delete_imagem/{id}', ['uses' => 'AdminClientesController@delete_imagem']);
	Route::post('admin/clientes/verifica_email', ['uses' => 'AdminClientesController@verificaEmail']);
});
