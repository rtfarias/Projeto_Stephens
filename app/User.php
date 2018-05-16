<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{

	protected $table = 'sis_users';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'name', 'email', 'password', 'id_user_group'
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];


	public function userGroup(){
		return $this->belongsTo('\App\UserGroup','id_user_group');
	}

	public static function getUsersMaster(){
		return DB::table('sis_users')->where('id_user_group', 1)->get();
	}

	public static function criar($input){

		

		$arrayInput = [
			'email' => $input['email'],
			'first_name' => $input['name'],
			'descricao' => $input['descricao'],
			'telefone' => $input['telefone'],
			'telefone2' => $input['telefone2'],
			'celular' => $input['celular'],
			'endereco' => $input['endereco'],
			'cnpj' => $input['cnpj'],
			'cidade' => $input['cidade'],
			'estado' => $input['estado'],
			'cep' => $input['cep'],
			'numero' => $input['numero'],
			'responsavel' => $input['responsavel'],
			'complemento' => $input['complemento'],
			'bairro' => $input['bairro'],
			'latitude' => $input['latitude'],
			'longitude' => $input['longitude'],
			'hora_inicio_manha' => $input['hora_inicio_manha'],
			'hora_fim_manha' => $input['hora_fim_manha'],
			'hora_inicio_tarde' => $input['hora_inicio_tarde'],
			'hora_fim_tarde' => $input['hora_fim_tarde'],
			'hora_inicio_noite' => $input['hora_inicio_noite'],
			'hora_fim_noite' => $input['hora_fim_noite'],
			'password' => bcrypt($input['password']),
			//'id_user_group' => $input['id_user_group'],
		];
		
		DB::table('sis_users')->insert([
			$arrayInput
		]);

		$id_user = DB::getPdo()->lastInsertId();


		return $id_user;
	}

	public static function editar($input, $id){

		$updateArray = [
			'email' => $input['email'],
			'first_name' => $input['name'],
			'descricao' => $input['descricao'],
			'telefone' => $input['telefone'],
			'telefone2' => $input['telefone2'],
			'celular' => $input['celular'],
			'endereco' => $input['endereco'],
			'cnpj' => $input['cnpj'],
			'responsavel' => $input['responsavel'],
			'cidade' => $input['cidade'],
			'estado' => $input['estado'],
			'cep' => $input['cep'],
			'numero' => $input['numero'],
			'complemento' => $input['complemento'],
			'bairro' => $input['bairro'],
			'latitude' => $input['latitude'],
			'longitude' => $input['longitude'],
			'hora_inicio_manha' => $input['hora_inicio_manha'],
			'hora_fim_manha' => $input['hora_fim_manha'],
			'hora_inicio_tarde' => $input['hora_inicio_tarde'],
			'hora_fim_tarde' => $input['hora_fim_tarde'],
			'hora_inicio_noite' => $input['hora_inicio_noite'],
			'hora_fim_noite' => $input['hora_fim_noite'],
			'thumbnail_principal' => $input['thumbnail_principal'],
			//'id_user_group' => $input['id_user_group'],
		];

		if(isset($input['id_empresa']) && $input['id_empresa']){
			$updateArray['id_empresa'] = $input['id_empresa'];
		}

		if($input['password'] != ''){
			$updateArray['password'] = bcrypt($input['password']);
		}

		DB::table('sis_users')->where('id', $id)
		->update($updateArray);

		return $id;
	}

	public function roleUser(){
		return $this->hasOne('App\RoleUser', 'user_id');
	}

	public function condomino(){
		return $this->belongsTo('App\Modules\Condominos\Models\Condominos', 'id_condomino');
	}
}
