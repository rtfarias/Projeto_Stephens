<?php

namespace App\Modules\Estados\Models;

use DB;
use App\MyModel;

class Estados extends MyModel
{
	protected $table = 'estados';

	private $rules = array();

	private $messages = array();

	public function __construct(){
		$this->setMessages($this->messages);
		$this->setRules($this->rules);
	}

}
