<?php

namespace App\Modules\<NOME_MODULO>\Models;

use DB;
use App\MyModel;

class <NOME_MODULO> extends MyModel
{
	protected $table = '<NOME_TABELA>';

	private $rules = array();

	private $messages = array();

	public function __construct(){
		$this->setMessages($this->messages);
		$this->setRules($this->rules);
	}

    public function editar($fields, $input, $id){
		$insert = [];
		foreach ($fields as $field) {
			$insert[$field] = $input[$field];
		}

    	DB::table('<NOME_TABELA>')->where('id', $id)
		->update($insert);

		return 1;
	}

	public function getImagem($id){
		return DB::table('<NOME_TABELA>_imagens')->find($id);
	}

	public function getImagens($id){
		return DB::table('<NOME_TABELA>_imagens')->where('id_<ITEM_MODULO>', $id)->get();
	}
	public function criar_imagem($input){
		return DB::table('<NOME_TABELA>_imagens')->insert([
			[
				'id_<ITEM_MODULO>' => $input['id_<ITEM_MODULO>'],
				'thumbnail_principal' => $input['thumbnail_principal'],
			]
		]);
	}
	public function editar_imagem($input, $id){
		return DB::table('<NOME_TABELA>_imagens')->where('id', $id)
		->update([
			'id_<ITEM_MODULO>' => $input['id_<ITEM_MODULO>'],
			'thumbnail_principal' => $input['thumbnail_principal'],
		]);;
	}
	public function deletar_imagem($id){
		return DB::table('<NOME_TABELA>_imagens')
				->where('id', $id)
				->delete();
	}
}
