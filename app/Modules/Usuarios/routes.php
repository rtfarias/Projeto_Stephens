<?php

// ================================
// Usuários routes BEGGINING
// ================================

Route::group(array('middleware' => 'web', 'namespace' => 'App\Modules\Usuarios\Controllers'), function() {
	Route::get('usuarios', ['uses' => 'UsuariosController@index']);
	Route::get('usuarios/detalhe/{slug}', ['uses' => 'UsuariosController@detalhe']);
});

Route::group(array('middleware' => ['auth','role:view'], 'namespace' => 'App\Modules\Usuarios\Controllers\Admin'), function() {
	Route::get('admin/usuarios', ['uses' => 'AdminUsuariosController@index']);
});

Route::group(array('middleware' => ['auth','role:create'], 'namespace' => 'App\Modules\Usuarios\Controllers\Admin'), function() {
	Route::get('admin/usuarios/add', ['uses' => 'AdminUsuariosController@add']);
});

Route::group(array('middleware' => ['auth','role:update'], 'namespace' => 'App\Modules\Usuarios\Controllers\Admin'), function() {
	Route::get('admin/usuarios/edit/{id}', ['uses' => 'AdminUsuariosController@edit']);
});

Route::group(array('middleware' => ['auth','role:delete'], 'namespace' => 'App\Modules\Usuarios\Controllers\Admin'), function() {
	Route::get('admin/usuarios/delete/{id}', ['uses' => 'AdminUsuariosController@delete']);
});

Route::group(array('middleware' => ['auth','role:update,create'], 'namespace' => 'App\Modules\Usuarios\Controllers\Admin'), function() {
	Route::post('admin/usuarios/save', ['uses' => 'AdminUsuariosController@save']);
	Route::post('admin/usuarios/upload', ['uses' => 'AdminUsuariosController@upload_image']);
	Route::post('admin/usuarios/crop', ['uses' => 'AdminUsuariosController@crop_image']);
	Route::post('admin/usuarios/upload_galeria/{id}', ['uses' => 'AdminUsuariosController@upload_galeria']);
	Route::post('admin/usuarios/delete_imagem/{id}', ['uses' => 'AdminUsuariosController@delete_imagem']);
});
