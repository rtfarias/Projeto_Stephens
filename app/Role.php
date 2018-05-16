<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
	protected $table = 'sis_roles';

	public static function criar($input){

		 DB::table('sis_roles')->insert([
			  [
					'name' => $input['name'],
					'slug' => $input['slug']
			  ]
		 ]);

		 $id_role = DB::getPdo()->lastInsertId();


		 return $id_role;
	}

	public static function editar($input, $id){

		 $updateArray = [
			  'name' => $input['name'],
			  'slug' => $input['slug'],
		 ];

		 DB::table('sis_roles')->where('id', $id)
		 ->update($updateArray);

		 return $id;
	}

	public function permissionsRole(){
		return $this->hasMany('App\Permission', 'id_role');
	}

	public function permissionsList(){
		return $this->permissionsRole()->lists('id_modulo')->toArray();
	}
}
