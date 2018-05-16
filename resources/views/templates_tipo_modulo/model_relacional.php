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

}
