<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FkModulo extends Model
{
	protected $table = 'sis_fk_modulo';

	public function modulo()
   {
      return $this->belongsTo('App\Gerador', 'id_modulo');
   }

	public function moduloRelacionado()
   {
      return $this->belongsTo('App\Gerador', 'id_modulo_relacionado');
   }

	public function campoRelacionado()
   {
      return $this->belongsTo('App\CampoModulo', 'id_campo_modulo_relacionado');
   }
}
