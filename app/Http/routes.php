<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


# Registration
Route::group(['middleware' => ['auth', 'admin']], function()
{
    Route::get('register', 'RegistrationController@create');
    Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);

});

Route::group(['middleware' => ['auth']], function()
{
    //Route::resource('admin/dashboard', ['uses' => 'Admin\AdminController@getHome']);
    Route::resource('admin/dashboard', 'Admin\AdminController' , ['only' => ['getHome']]);

});

Route::group(['middleware' => ['auth']], function()
{

    Route::get('admin', ['as' => 'admin_dashboard', 'uses' => 'Admin\AdminController@getHome']);
    Route::get('admin/verifica_atualizar', ['uses' => 'Admin\AdminController@verificaSePrecisaAtualizar']);
	Route::post('admin/getcep', ['uses' => 'Admin\AdminController@getCep']);
    Route::get('admin/aceitar/{id}', ['uses' => 'Admin\AdminController@aceitar']);
    Route::get('admin/rejeitar/{id}', ['uses' => 'Admin\AdminController@rejeitar']);
    Route::get('admin/aceitar_noticia/{id}', ['uses' => 'Admin\AdminController@aceitar_noticia']);
    Route::get('admin/rejeitar_noticia/{id}', ['uses' => 'Admin\AdminController@rejeitar_noticia']);
    Route::get('admin/users/busca_cidades', ['uses' => 'Admin\UserController@buscaCidades']);
    Route::post('admin/verifica_email', ['uses' => 'Admin\AdminController@verificaEmail']);



});

# Authentication
    Route::get('admin/login', ['as' => 'admin/login', 'middleware' => 'guest', 'uses' => 'Auth\AuthController@create']);
	 Route::get('admin/register', ['as' => 'admin/register', 'middleware' => 'guest', 'uses' => 'Auth\AuthController@register']);
    Route::get('admin/logout', ['as' => 'admin/logout', 'uses' => 'Auth\AuthController@destroy']);
    Route::resource('admin/login', 'Auth\AuthController' , ['only' => ['create','store','destroy']]);

# Forgotten Password
    //Route::get('admin/forgot_password', 'Auth\PasswordController@getEmail');
    //Route::post('admin/forgot_password','Auth\PasswordController@postEmail');
    //Route::get('admin/reset_password/{token}', 'Auth\PasswordController@getReset');
    //Route::post('admin/reset_password/{token}', 'Auth\PasswordController@postReset');

    Route::get('admin/forgot_password', 'Auth\PasswordController@getEmail');
    Route::post('password/email','Auth\PasswordController@postEmail');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset/{token}', 'Auth\PasswordController@postReset');


# Standard User Routes
Route::group(['middleware' => ['auth','standardUser']], function()
{
    Route::get('userProtected', 'StandardUser\StandardUserController@getUserProtected');
    Route::resource('profiles', 'StandardUser\UsersController', ['only' => ['show', 'edit', 'update']]);
});
# Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function()
{

    Route::resource('admin/profiles', 'Admin\AdminUsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
});


// ==============================
// Configurações (Admin) routes
// ==============================
Route::get('admin/informacoes-basicas', 'Admin\BasicInfoController@index');
Route::post('admin/informacoes-basicas/save', 'Admin\BasicInfoController@save');
Route::get('admin/gerador', 'Admin\GeradorController@index');
Route::get('admin/gerador/add', 'Admin\GeradorController@add');
Route::get('admin/gerador/edit/{id}', 'Admin\GeradorController@edit');
Route::get('admin/gerador/delete/{id}', 'Admin\GeradorController@delete');
Route::post('admin/gerador/save', 'Admin\GeradorController@save');
Route::get('admin/gerador/import', 'Admin\GeradorController@import');
Route::post('admin/gerador/import-sql', 'Admin\GeradorController@importSql');
Route::post('admin/gerador/add-fk', 'Admin\GeradorController@addForeignKey');
Route::post('admin/gerador/remove-fk', 'Admin\GeradorController@removeForeignKey');
Route::get('admin/roles', 'Admin\RoleController@index');
Route::get('admin/roles/add', 'Admin\RoleController@add');
Route::get('admin/roles/edit/{id}', 'Admin\RoleController@edit');
Route::get('admin/roles/delete/{id}', 'Admin\RoleController@delete');
Route::post('admin/roles/save', 'Admin\RoleController@save');
Route::post('admin/campo-modulo/delete/{id}', 'Admin\CampoModuloController@delete');

// ==============================
// Tipo Módulo routes
// ==============================
Route::get('admin/tipo-modulo', 'Admin\TipoModuloController@index');
Route::get('admin/tipo-modulo/add', 'Admin\TipoModuloController@add');
Route::get('admin/tipo-modulo/edit/{id}', 'Admin\TipoModuloController@edit');
Route::get('admin/tipo-modulo/delete/{id}', 'Admin\TipoModuloController@delete');
Route::post('admin/tipo-modulo/save', 'Admin\TipoModuloController@save');


// ================================
// UserGroup routes BEGINING
// ================================
Route::get('admin/users-groups', 'AdminUserGroupController@index');
Route::get('admin/users-groups/add', 'AdminUserGroupController@add');
Route::get('admin/users-groups/edit/{id}', 'AdminUserGroupController@edit');
Route::post('admin/users-groups/save', 'AdminUserGroupController@save');
Route::get('admin/users-groups/delete/{id}', 'AdminUserGroupController@delete');
Route::get('/admin/busca', 'Admin\AdminController@processBuscar');

// ================================
// User routes BEGINING
// ================================
Route::get('admin/users', 'Admin\UserController@index');
Route::get('admin/users/add', 'Admin\UserController@add');
Route::get('admin/users/edit/{id}', 'Admin\UserController@edit');
Route::post('admin/users/save', 'Admin\UserController@save');
Route::get('admin/users/delete/{id}', 'Admin\UserController@delete');
Route::post('admin/users/upload', 'Admin\UserController@upload_image');
Route::post('admin/users/crop', 'Admin\UserController@crop_image');

Route::get('admin/bad_permissions', 'Admin\AdminController@bad_permissions');

Route::post('admin/ver-notificacao', 'Admin\AdminController@ver_notificacao');


// ================================
// Auth routes BEGINING
// ================================
//Route::auth();


// ================================
// Home routes BEGINING
// ================================
Route::get('/', 'HomeController@index');


// ================================
// Telegram routes BEGINING
// ================================
Route::get('telegram/get-updates','TelegramController@getUpdates');
Route::post('telegram/send-message','TelegramController@postSendMessage');
//Route::get('send-message','TelegramController@getSendMessage');




$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  function ($api) {
    //$api->post('teste', ['as' => 'api.teste', 'middleware' => 'api.auth', 'uses' => 'App\Http\Controllers\Auth\AuthController@teste']);

    $api->post('get_detalhes_solicitacao', ['as' => 'api.get_detalhes_solicitacao', 'uses' => 'App\Http\Controllers\Api\ApiController@getDetalhesSolicitacao']);

    $api->post('reposta_solicitacao_fornecedor', ['as' => 'api.reposta_solicitacao_fornecedor', 'uses' => 'App\Http\Controllers\Api\ApiController@respostaSolicitacaoFornecedor']);

    $api->post('deletar_solicitacao', ['as' => 'api.deletar_solicitacao', 'uses' => 'App\Http\Controllers\Api\ApiController@deletarSolicitacao']);

    $api->post('upload_imagem', ['as' => 'api.upload_imagem', 'uses' => 'App\Http\Controllers\Api\ApiController@uploadImagem']);

    $api->post('cadastro_solicitacao_emergencial', ['as' => 'api.cadastro_solicitacao_emergencial', 'uses' => 'App\Http\Controllers\Api\ApiController@cadastroSolicitacaoEmergencial']);

    $api->post('cadastro_solicitacao', ['as' => 'api.cadastro_solicitacao', 'uses' => 'App\Http\Controllers\Api\ApiController@cadastroSolicitacao']);

    $api->post('busca_fornecedores', ['as' => 'api.busca_fornecedores', 'uses' => 'App\Http\Controllers\Api\ApiController@buscaFornecedores']);

    $api->post('get_solicitacoes_de_clientes', ['as' => 'api.get_solicitacoes_de_clientes', 'uses' => 'App\Http\Controllers\Api\ApiController@getSolicitacoesDeClientes']);

    $api->post('get_minhas_solicitacoes', ['as' => 'api.get_minhas_solicitacoes', 'uses' => 'App\Http\Controllers\Api\ApiController@getMinhasSolicitacoes']);

    $api->post('get_avaliacoes_recebidas_fornecedores', ['as' => 'api.get_avaliacoes_recebidas_fornecedores', 'uses' => 'App\Http\Controllers\Api\ApiController@getAvaliacoesRecebidasFornecedores']);

    $api->post('get_avaliacoes_recebidas_clientes', ['as' => 'api.get_avaliacoes_recebidas_clientes', 'uses' => 'App\Http\Controllers\Api\ApiController@getAvaliacoesRecebidasClientes']);

    $api->post('cadastrar_cliente', ['as' => 'api.cadastrar_cliente', 'uses' => 'App\Http\Controllers\Api\ApiController@cadastrarCliente']);

    $api->post('get_solicitacoes_fornecedor', ['as' => 'api.get_solicitacoes_fornecedor', 'uses' => 'App\Http\Controllers\Api\ApiController@getSolicitacoesFornecedor']);

	$api->post('login_fornecedor', ['as' => 'api.login_fornecedor', 'uses' => 'App\Http\Controllers\Api\ApiController@loginFornecedor']);

    $api->post('set_mensagem', ['as' => 'api.set_mensagem', 'uses' => 'App\Http\Controllers\Api\ApiController@setMensagem']);

    $api->get('get_tipos', ['as' => 'api.get_tipos', 'uses' => 'App\Http\Controllers\Api\ApiController@getTipos']);

    $api->get('get_cidades', ['as' => 'api.get_cidades', 'uses' => 'App\Http\Controllers\Api\ApiController@getCidades']);

});
