<?php
 
namespace App;

use Validator;
use DB;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model{

	private $errors;
	private $messages;
	private $rules;

	public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules, $this->messages);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function messages()
	{
	    return $this->messages;
	}

	public function setMessages($messages){
		$this->messages = $messages;
	}

	public function setRules($rules){
		$this->rules = $rules;
	}
}