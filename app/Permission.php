<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Permission extends Model
{
	protected $table = 'sis_permissions';

	public function modulo()
   {
      return $this->belongsTo('App\Gerador', 'id_modulo');
   }

	public function role()
   {
      return $this->belongsTo('App\Role', 'id_role');
   }
}
