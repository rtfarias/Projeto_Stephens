<?php

// ================================
// Destinos routes BEGGINING
// ================================

Route::group(array('middleware' => 'web', 'namespace' => 'App\Modules\Destinos\Controllers'), function() {
	Route::get('destinos', ['uses' => 'DestinosController@index']);
	Route::get('destinos/detalhe/{slug}', ['uses' => 'DestinosController@detalhe']);
});

Route::group(array('middleware' => ['auth','role:view'], 'namespace' => 'App\Modules\Destinos\Controllers\Admin'), function() {
	Route::get('admin/destinos', ['uses' => 'AdminDestinosController@index']);
});

Route::group(array('middleware' => ['auth','role:create'], 'namespace' => 'App\Modules\Destinos\Controllers\Admin'), function() {
	Route::get('admin/destinos/add', ['uses' => 'AdminDestinosController@add']);
});

Route::group(array('middleware' => ['auth','role:update'], 'namespace' => 'App\Modules\Destinos\Controllers\Admin'), function() {
	Route::get('admin/destinos/edit/{id}', ['uses' => 'AdminDestinosController@edit']);
});

Route::group(array('middleware' => ['auth','role:delete'], 'namespace' => 'App\Modules\Destinos\Controllers\Admin'), function() {
	Route::get('admin/destinos/delete/{id}', ['uses' => 'AdminDestinosController@delete']);
});

Route::group(array('middleware' => ['auth','role:update,create'], 'namespace' => 'App\Modules\Destinos\Controllers\Admin'), function() {
	Route::post('admin/destinos/save', ['uses' => 'AdminDestinosController@save']);
	Route::post('admin/destinos/upload', ['uses' => 'AdminDestinosController@upload_image']);
	Route::post('admin/destinos/crop', ['uses' => 'AdminDestinosController@crop_image']);
	Route::post('admin/destinos/upload_galeria/{id}', ['uses' => 'AdminDestinosController@upload_galeria']);
	Route::post('admin/destinos/delete_imagem/{id}', ['uses' => 'AdminDestinosController@delete_imagem']);
});
