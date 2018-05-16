<?php

namespace App\Modules\Cidades\Models;

use DB;
use App\MyModel;

class Cidades extends MyModel
{
	protected $table = 'cidades';

	private $rules = array();

	private $messages = array();

	public function __construct(){
		$this->setMessages($this->messages);
		$this->setRules($this->rules);
	}

	public function getBySlug($slug){
		return DB::table($this->table)->where('slug',$slug)->firstOrFail();
	}

	public function criar($fields, $input){
		$insert = [];
		foreach ($fields as $field) {
			if($field != 'estado')
				$insert[$field] = $input[$field];
		}

		$id_cidade = DB::table($this->table)->insertGetId(
			$insert
		);

		return $id_cidade;
	}

    public function editar($fields, $input, $id){
		$insert = [];
		foreach ($fields as $field) {
			if($field != 'estado')
				$insert[$field] = $input[$field];
		}

    	DB::table($this->table)->where('id', $id)
		->update($insert);

		return 1;
	}

	public function deletar($id){
		return DB::table($this->table)
				->where('id', $id)
				->delete();
	}


	public function getImagem($id){
		return DB::table($this->table.'_imagens')->find($id);
	}

	public function getImagens($id){
		return DB::table($this->table.'_imagens')->where('id_cidade', $id)->get();
	}
	public function criar_imagem($input){
		return DB::table($this->table.'_imagens')->insert([
			[
				'id_cidade' => $input['id_cidade'],
				'thumbnail_principal' => $input['thumbnail_principal'],
			]
		]);
	}
	public function deletar_imagem($id){
		return DB::table($this->table.'_imagens')
				->where('id', $id)
				->delete();
	}

	public function getNextAutoIncrement(){
		$lastId = DB::select("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_NAME = '$this->table' ORDER BY table_name;")[0]->AUTO_INCREMENT;
		return $lastId;
	}
}
