<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoleUser extends Model
{
	protected $table = 'sis_role_users';

	public function role(){
		return $this->belongsTo('App\Role', 'role_id');
	}

}
