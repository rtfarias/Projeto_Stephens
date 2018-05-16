<?php

// ================================
// Categorias routes BEGGINING
// ================================

Route::group(array('middleware' => 'web', 'namespace' => 'App\Modules\Categorias\Controllers'), function() {
	Route::get('categorias', ['uses' => 'CategoriasController@index']);
	Route::get('categorias/detalhe/{slug}', ['uses' => 'CategoriasController@detalhe']);
});

Route::group(array('middleware' => ['auth','role:view'], 'namespace' => 'App\Modules\Categorias\Controllers\Admin'), function() {
	Route::get('admin/categorias', ['uses' => 'AdminCategoriasController@index']);
});

Route::group(array('middleware' => ['auth','role:create'], 'namespace' => 'App\Modules\Categorias\Controllers\Admin'), function() {
	Route::get('admin/categorias/add', ['uses' => 'AdminCategoriasController@add']);
});

Route::group(array('middleware' => ['auth','role:update'], 'namespace' => 'App\Modules\Categorias\Controllers\Admin'), function() {
	Route::get('admin/categorias/edit/{id}', ['uses' => 'AdminCategoriasController@edit']);
});

Route::group(array('middleware' => ['auth','role:delete'], 'namespace' => 'App\Modules\Categorias\Controllers\Admin'), function() {
	Route::get('admin/categorias/delete/{id}', ['uses' => 'AdminCategoriasController@delete']);
});

Route::group(array('middleware' => ['auth','role:update,create'], 'namespace' => 'App\Modules\Categorias\Controllers\Admin'), function() {
	Route::post('admin/categorias/save', ['uses' => 'AdminCategoriasController@save']);
	Route::post('admin/categorias/upload', ['uses' => 'AdminCategoriasController@upload_image']);
	Route::post('admin/categorias/crop', ['uses' => 'AdminCategoriasController@crop_image']);
	Route::post('admin/categorias/upload_galeria/{id}', ['uses' => 'AdminCategoriasController@upload_galeria']);
	Route::post('admin/categorias/delete_imagem/{id}', ['uses' => 'AdminCategoriasController@delete_imagem']);
});
