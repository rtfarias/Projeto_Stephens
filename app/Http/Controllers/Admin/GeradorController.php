<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Permission;
use App\Http\Controllers\BaseController;
use App\Gerador;
use Sentinel;
use File;
use App\CampoModulo;
use App\FkModulo;

class GeradorController extends BaseController
{
    public function __construct(){
		parent::__construct();
		$this->middleware('auth');
	}

	public function index(){
		$data['modulos'] = \App\Gerador::get();
		return view('admin/gerador',$data);
	}

	public function add(){
		$data = array();
		$data['tipos'] = \App\TipoModulo::get();
		return view('admin/form-gerador', $data);
	}

	public function edit($id){
		$data['modulo'] = \App\Gerador::find($id);
		$data['tipos'] = \App\TipoModulo::get();
		$data['campos'] = \App\CampoModulo::where('id_modulo', $data['modulo']->id)->get();
		$data['fks'] = \App\FkModulo::where('id_modulo', $data['modulo']->id)->get();
		$data['modulos'] = \App\Gerador::where('id', '!=', $data['modulo']->id)->get();
		return view('admin/form-gerador',$data);
	}

	public function save(Request $request){
		try{
			$post = $request->input();
			if($request->input('id')){
				$modulo = \App\Gerador::find($request->input('id'));
				\App\Gerador::editar($post, $request->input('id'));

				$this->updateTable($request->input(), $modulo);
			}else{
				if(!(\Schema::hasTable($post['nome_tabela']))){
					if(!(\App\Gerador::where('nome', $post['nome'])->count())){
						$id_modulo = \App\Gerador::criar($post);
						$modulo = \App\Gerador::find($id_modulo);
						$this->createTable($request->input(), $modulo);
						$this->generateFiles($modulo);
						$this->createPermissionsAdmin($modulo);
					}else{
						die('Já existe um módulo com esse nome, seu infeliz !');
					}
				}else{
					die('Já existe uma tabela com esse nome, seu infeliz !');
				}
			}
			\Session::flash('type', 'success');
         \Session::flash('message', "Alteracoes salvas com sucesso!");
			return redirect('admin/gerador');
		}catch(Exception $e){
			\Session::flash('type', 'error');
         \Session::flash('message', $e->getMessage());
         return redirect()->back();
		}


	}

	public function delete($id){
		try{
			$modulo = \App\Gerador::find($id);

			\App\Gerador::deletar($id);


			/* Apaga a pasta do módulo recursivamente */
			$this->rrmdir('../app/Modules/'.$modulo->nome);
			$this->rrmdir('../public/uploads/'.$modulo->rota);

			/* Remove do config/module.php */
			$modules = config("module.modules");
			$str = "<?php
			# config/module.php
			return  [
			    'modules' => [
			";
			while (list(,$module) = each($modules)) {
				if($module != $modulo->nome){
					$str .= "'$module',
					";
				}
			}
			$str .= "
				]
			];";
			file_put_contents('../config/module.php',$str);

			\App\CampoModulo::where('id_modulo',$modulo->id)->delete();
			\App\FkModulo::where('id_modulo',$modulo->id)->delete();

			DB::statement('SET foreign_key_checks = 0');

			DB::statement('DROP TABLE IF EXISTS '.$modulo->nome_tabela);
			if($modulo->id_tipo_modulo != 3){
				DB::statement('DROP TABLE IF EXISTS '.$modulo->nome_tabela.'_imagens');
			}

			DB::statement('SET foreign_key_checks = 1');

			\Session::flash('type', 'success');
         \Session::flash('message', "Registro removido com sucesso!");
			return redirect('admin/gerador');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possível remover o registro!");
            return redirect()->back();
		}


	}

	private function generateFiles($modulo){
		$tipo_modulo = \App\TipoModulo::find($modulo->id_tipo_modulo);
		$replaces = array('<NOME_MODULO>','<ID_MODULO>','<ROTA_MODULO>','<ITEM_MODULO>','<ITEMS_MODULO>','<NOME_TABELA>','<LABEL_MODULO>');
		$by = array($modulo->nome,$modulo->id,$modulo->rota,$modulo->item_modulo,$modulo->items_modulo,$modulo->nome_tabela,$modulo->label);

		if(file_exists('../app/Modules/'.$modulo->nome)){
			die('Ja existe um módulo com esse nome, seu idiota !');
		}

		/* Cria as pastas */
		mkdir('../app/Modules/'.$modulo->nome, 0777, true);
		mkdir('../app/Modules/'.$modulo->nome.'/Models', 0777, true);
		if($tipo_modulo->id != 3){
			mkdir('../app/Modules/'.$modulo->nome.'/Views', 0777, true);
			mkdir('../app/Modules/'.$modulo->nome.'/Views/admin', 0777, true);
			mkdir('../app/Modules/'.$modulo->nome.'/Controllers', 0777, true);
			mkdir('../app/Modules/'.$modulo->nome.'/Controllers/Admin', 0777, true);
		}


		/* Gera o Model */
		$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/".$tipo_modulo->model));
		file_put_contents('../app/Modules/'.$modulo->nome.'/Models/'.$modulo->nome.'.php',$text);

		if($tipo_modulo->id != 3){
			/* Gera o Controller */
			$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/".$tipo_modulo->controller_admin));
			file_put_contents('../app/Modules/'.$modulo->nome.'/Controllers/Admin/Admin'.$modulo->nome.'Controller.php',$text);

			/* Gera o Controller do Site */
			$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/controller_basico.php"));
			file_put_contents('../app/Modules/'.$modulo->nome.'/Controllers/'.$modulo->nome.'Controller.php',$text);

			/* Gera a View Index */
			$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/".$tipo_modulo->view_admin_index));
			file_put_contents('../app/Modules/'.$modulo->nome.'/Views/admin/'.$modulo->rota.'.blade.php',$text);

			if($tipo_modulo->id == 1){ // Com Detalhe
				/* Gera a View Form */
				$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/".$tipo_modulo->view_admin_form));
				file_put_contents('../app/Modules/'.$modulo->nome.'/Views/admin/form-'.$modulo->rota.'.blade.php',$text);
			}

			/* Gera a view index do site */
			file_put_contents('../app/Modules/'.$modulo->nome.'/Views/'.$modulo->rota.'.blade.php','');

			/* Gera as rotas */
			$text = str_replace($replaces,$by,file_get_contents("../resources/views/templates_tipo_modulo/".$tipo_modulo->rotas));
			file_put_contents('../app/Modules/'.$modulo->nome.'/routes.php',$text);
		}

		/* Adiciona o módulo ao config/module.php */
		$modules = config("module.modules");

		$str = "<?php
		# config/module.php

		return  [
		    'modules' => [
		";
		foreach ($modules as $module) {
			$str .= "'$module',
			";
		}
		$str .= "'$modulo->nome'
		";
		$str .= "
			]
		];";
		$modules[] = $modulo->nome;
		config(['module.modules' => $modules]);

		file_put_contents('../config/module.php',$str);

		return true;
	}

	private function createTable($input, $modulo){
		if($modulo->id_tipo_modulo != 3){
			$sqlColumns = '( id INT NOT NULL AUTO_INCREMENT, thumbnail_principal VARCHAR(255) DEFAULT NULL';
		}else{
			$sqlColumns = '( id INT NOT NULL AUTO_INCREMENT';
		}

		if($modulo->id_tipo_modulo == 1){
			$sqlColumns .= ', meta_keywords TEXT DEFAULT NULL, meta_descricao TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL';
		}
		if(isset($input['campo-nome']) && count($input['campo-nome'])){
			foreach ($input['campo-nome'] as $key => $nome_campo) {
				$sqlColumns .= ', ';
				switch ($input['campo-tipo-campo'][$key]) {
					case 'INT':
						$tipo = 'INT';
						$valor_tipo = '(11)';
						break;
					case 'I':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
					case 'N':
						$tipo = 'DECIMAL';
						$valor_tipo = '(15,2)';
						break;
					case 'T':
						$tipo = 'TEXT';
						$valor_tipo = '';
						break;
					case 'D':
						$tipo = 'DATE';
						$valor_tipo = '';
						break;
					case 'DT':
						$tipo = 'DATETIME';
						$valor_tipo = '';
						break;
					case 'TIME':
						$tipo = 'TIME';
						$valor_tipo = '';
						break;
					case 'S':
						$tipo = 'TINYINT';
						$valor_tipo = '';
						break;
					case 'SI':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
				}
				$sqlColumns .= $nome_campo.' '.$tipo.' '.$valor_tipo.' DEFAULT NULL';

				$campoInfo = array(
					'nome' => $nome_campo,
					'valor_padrao' => $input['campo-valor-padrao'][$key],
					'listagem' => $input['campo-listagem'][$key],
					'required' => $input['campo-required'][$key],
					'label' => $input['campo-label'][$key],
					'required' => $input['campo-required'][$key],
					'tipo_campo' => $input['campo-tipo-campo'][$key],
					'ordem' => $input['campo-ordem'][$key],
					'id_modulo' => $modulo->id,
				);
				\App\CampoModulo::criar($campoInfo);
			}
		}


		if(isset($input['fk-nome']) && count($input['fk-nome'])){
			foreach ($input['fk-nome'] as $key => $nome_fk) {
				$sqlColumns .= ', ';

				$sqlColumns .= $nome_fk.' INT (11) DEFAULT NULL';

				$fkModulo = new FkModulo();
				$fkModulo->nome = $nome_fk;
				$fkModulo->label = $input['fk-label'][$key];
				$fkModulo->id_modulo = $modulo->id;
				$fkModulo->id_modulo_relacionado = $input['fk-modulo'][$key];
				$fkModulo->id_campo_modulo_relacionado = $input['fk-campo-label'][$key];
				$fkModulo->ordem = $input['fk-ordem'][$key];
				$fkModulo->listagem = $input['fk-listagem'][$key];
				$fkModulo->save();
			}
		}


		$sqlColumns .= ', PRIMARY KEY (id)';

		$fks = FkModulo::where('id_modulo', $modulo->id)->get();
		foreach ($fks as $fk) {
			$sqlColumns .= ', FOREIGN KEY ('.$fk->nome.') REFERENCES '.$fk->moduloRelacionado->nome_tabela.'(id)';
		}
		
		$sqlColumns .= ')';


		DB::statement('SET foreign_key_checks = 0');

		DB::statement('CREATE TABLE '.$input['nome_tabela'].' '.$sqlColumns);

		if($modulo->id_tipo_modulo != 3){
			DB::statement('CREATE TABLE '.$input['nome_tabela'].'_imagens (id INT NOT NULL AUTO_INCREMENT, thumbnail_principal VARCHAR (255) DEFAULT NULL, id_'.$modulo->item_modulo.' INT(11) NOT NULL, PRIMARY KEY (id))');
		}

		if($modulo->id_tipo_modulo == 2){
			DB::statement('INSERT INTO '.$input['nome_tabela'].' (id) VALUES (1)');
		}

		DB::statement('SET foreign_key_checks = 1');

		return true;
	}

	private function updateTable($input, $modulo){
		DB::statement('SET foreign_key_checks = 0');
		if(isset($input['edit-campo-nome'])){
			foreach ($input['edit-campo-nome'] as $key => $nome_campo) {
				if($input['old-campo-nome'][$key] != $nome_campo){
					$new_name = $nome_campo;
				}else{
					$new_name = '';
				}
				switch ($input['edit-campo-tipo-campo'][$key]) {
					case 'INT':
						$tipo = 'INT';
						$valor_tipo = '(11)';
						break;
					case 'I':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
					case 'N':
						$tipo = 'DECIMAL';
						$valor_tipo = '(15,2)';
						break;
					case 'T':
						$tipo = 'TEXT';
						$valor_tipo = '';
						break;
					case 'D':
						$tipo = 'DATE';
						$valor_tipo = '';
						break;
					case 'DT':
						$tipo = 'DATETIME';
						$valor_tipo = '';
						break;
					case 'TIME':
						$tipo = 'TIME';
						$valor_tipo = '';
						break;
					case 'S':
						$tipo = 'TINYINT';
						$valor_tipo = '';
						break;
					case 'SI':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
				}
				DB::statement('ALTER TABLE '.$modulo->nome_tabela.' CHANGE COLUMN '.$input['old-campo-nome'][$key].' '.$nome_campo.' '.$tipo.' '.$valor_tipo.' DEFAULT NULL');

				$campoObject = \App\CampoModulo::find($input['edit-campo-id'][$key]);

				$campoInfo = array(
					'nome' => $nome_campo,
					'valor_padrao' => $input['edit-campo-valor-padrao'][$key],
					'listagem' => $input['edit-campo-listagem'][$key],
					'required' => $input['edit-campo-required'][$key],
					'label' => $input['edit-campo-label'][$key],
					'tipo_campo' => $input['edit-campo-tipo-campo'][$key],
					'ordem' => $input['edit-campo-ordem'][$key],
					'id_modulo' => $modulo->id,
				);
				\App\CampoModulo::editar($campoInfo, $campoObject->id);
			}

		}

		if(isset($input['edit-fk-nome']) && count($input['edit-fk-nome'])){
			foreach ($input['edit-fk-nome'] as $key => $nome_fk) {

				DB::statement('ALTER TABLE '.$modulo->nome_tabela.' CHANGE COLUMN '.$input['old-fk-nome'][$key].' '.$input['edit-fk-nome'][$key].' INT (11) DEFAULT NULL');

				$fkModulo = FkModulo::find($input['edit-fk-id'][$key]);
				$fkModulo->nome = $nome_fk;
				$fkModulo->label = $input['edit-fk-label'][$key];
				$fkModulo->id_modulo_relacionado = $input['edit-fk-modulo'][$key];
				$fkModulo->id_campo_modulo_relacionado = $input['edit-fk-campo-label'][$key];
				$fkModulo->ordem = $input['edit-fk-ordem'][$key];
				$fkModulo->listagem = $input['edit-fk-listagem'][$key];
				$fkModulo->save();
			}
		}

		if(isset($input['campo-nome'])){
			foreach ($input['campo-nome'] as $key => $nome_campo) {
				switch ($input['campo-tipo-campo'][$key]) {
					case 'INT':
						$tipo = 'INT';
						$valor_tipo = '(11)';
						break;
					case 'I':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
					case 'N':
						$tipo = 'DECIMAL';
						$valor_tipo = '(15,2)';
						break;
					case 'T':
						$tipo = 'TEXT';
						$valor_tipo = '';
						break;
					case 'D':
						$tipo = 'DATE';
						$valor_tipo = '';
						break;
					case 'DT':
						$tipo = 'DATETIME';
						$valor_tipo = '';
						break;
					case 'TIME':
						$tipo = 'TIME';
						$valor_tipo = '';
						break;
					case 'S':
						$tipo = 'TINYINT';
						$valor_tipo = '';
						break;
					case 'SI':
						$tipo = 'VARCHAR';
						$valor_tipo = '(255)';
						break;
				}
				DB::statement('ALTER TABLE '.$modulo->nome_tabela.' ADD '.$nome_campo.' '.$tipo.' '.$valor_tipo.' DEFAULT NULL');

				$campoInfo = array(
					'nome' => $nome_campo,
					'valor_padrao' => $input['campo-valor-padrao'][$key],
					'listagem' => $input['campo-listagem'][$key],
					'required' => $input['campo-required'][$key],
					'label' => $input['campo-label'][$key],
					'tipo_campo' => $input['campo-tipo-campo'][$key],
					'ordem' => $input['campo-ordem'][$key],
					'id_modulo' => $modulo->id,
				);
				\App\CampoModulo::criar($campoInfo);
			}
		}

		if(isset($input['fk-nome']) && count($input['fk-nome'])){
			foreach ($input['fk-nome'] as $key => $nome_fk) {

				DB::statement('ALTER TABLE '.$modulo->nome_tabela.' ADD '.$nome_fk.' INT (11) DEFAULT NULL');

				$fkModulo = new FkModulo();
				$fkModulo->nome = $nome_fk;
				$fkModulo->label = $input['fk-label'][$key];
				$fkModulo->id_modulo = $modulo->id;
				$fkModulo->id_modulo_relacionado = $input['fk-modulo'][$key];
				$fkModulo->listagem = $input['fk-listagem'][$key];
				$fkModulo->id_campo_modulo_relacionado = $input['fk-campo-label'][$key];
				$fkModulo->ordem = $input['fk-ordem'][$key];
				$fkModulo->save();
			}
		}

		DB::statement('SET foreign_key_checks = 1');

		return true;

	}

	public function createPermissionsAdmin($modulo){
		$role = Sentinel::findRoleBySlug('admins');
		$newPermissions = array(
			$modulo->nome_tabela.'.view' => true,
			$modulo->nome_tabela.'.create' => true,
			$modulo->nome_tabela.'.update' => true,
			$modulo->nome_tabela.'.delete' => true,
		);
		$role->permissions = array_merge($role->permissions, $newPermissions);
		$role->save();
		return true;
	}

	public function rrmdir($dir) {
	  if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
			  if (is_dir($dir."/".$object))
				 $this->rrmdir($dir."/".$object);
			  else
				 unlink($dir."/".$object);
			}
		 }
		 rmdir($dir);
	  }
	}

	public function importSql(Request $request){

		/* Upload and exec file */
		$file = $request->file('sql');
		$tmpFilePath = '/uploads/sql/';
		$tmpFileName = time() . '-' . $file->getClientOriginalName();
		$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
		$path = $tmpFilePath . $tmpFileName;
		$sql = explode(';',File::get(substr($path,1)));

		foreach ($sql as $query) {
			$query = trim($query);
			if($query){
				DB::select($query);
			}
		}

		$tables = DB::select('SHOW TABLES');
 		foreach ($tables as $table) {
 			$nomeField = 'Tables_in_'.env('DB_DATABASE');
			$table->name = $table->$nomeField;
 			$table->columns = DB::select('SHOW COLUMNS FROM '.$table->$nomeField);
			/* Verifica todas tabelas que não sao do sistema */
			if(substr($table->name,0,4) != 'sis_'){
				$arrayNome = explode('_',$table->name);
				$nomeModulo = '';
				$labelModulo = '';
				$rotaModulo = '';
				foreach ($arrayNome as $key => $piece) {
					$nomeModulo .= ucfirst($piece);
					if($key){
						$labelModulo .= ' ';
						$rotaModulo .= '-';
					}
					$labelModulo .= ucfirst($piece);
					$rotaModulo .= $piece;
				}

				$modulo = new Gerador();
				$modulo->rota = $rotaModulo;
				$modulo->nome_tabela = $table->name;
				$modulo->id_tipo_modulo = 1;
				$modulo->nome = $nomeModulo;
				$modulo->label = $labelModulo;
				$modulo->item_modulo = $table->name;
				$modulo->items_modulo = $table->name.'s';
				$modulo->save();

				$this->generateFiles($modulo);
				$this->createPermissionsAdmin($modulo);

				foreach ($table->columns as $column) {
					if($column->Extra != 'auto_increment'){
						if($column->Key != 'MUL'){
							$arrayTipo = explode("(",$column->Type);
							switch ($arrayTipo[0]) {
								case "int": $tipo = 'INT'; break;
								case "varchar": $tipo = 'I'; break;
								case "text": $tipo = 'T'; break;
								case "date": $tipo = 'D'; break;
								case "datetime": $tipo = 'DT'; break;
								case "time": $tipo = 'TIME'; break;
								case "decimal": $tipo = 'N'; break;
								default: $tipo = 'I'; break;
							}
							$arrayNome = explode('_',$column->Field);
							$labelCampo = '';
							foreach ($arrayNome as $key => $piece) {
								if($key){
									$labelCampo .= ' ';
								}
								$labelCampo .= ucfirst($piece);
							}
							$campoModulo = new CampoModulo();
							$campoModulo->tipo_campo = $tipo;
							$campoModulo->nome = $column->Field;
							$campoModulo->label = $labelCampo;
							$campoModulo->valor_padrao = $column->Default;
							$campoModulo->required = ($column->Null == "YES") ? 1 : 0;
							$campoModulo->listagem = 1;
							$campoModulo->id_modulo = $modulo->id;
							$campoModulo->save();
						}else {
							$arrayNome = explode('_',str_replace('id_', '',$column->Field));
							$labelCampo = '';
							$nomeModuloRelacionado = '';
							foreach ($arrayNome as $key => $piece) {
								if($key){
									$labelCampo .= ' ';
								}
								$labelCampo .= ucfirst($piece);
								$nomeModuloRelacionado .= ucfirst($piece);
							}
							$moduloRelacionado = Gerador::where('nome', $nomeModuloRelacionado)->first();
							$fkModulo = new FkModulo();
							$fkModulo->id_modulo = $modulo->id;
							$fkModulo->nome = $column->Field;
							$fkModulo->label = $labelCampo;
							$fkModulo->listagem = 1;
							$fkModulo->id_modulo_relacionado = ($moduloRelacionado) ? $moduloRelacionado->id : null;
							$fkModulo->id_campo_modulo_relacionado = ($moduloRelacionado) ? $moduloRelacionado->campos[0]->id : null;
							$fkModulo->save();
						}

					}

				}

			}

 		}
		return redirect('admin/gerador');
	}

	public function import(){
		$data = [];

		return view('admin/import-gerador', $data);
	}

	public function addForeignKey(Request $request){
		$post = $request->input();
		if(isset($post['id_modulo'])){
			$data['modulos'] = Gerador::where('id', '!=', $post['id_modulo'])->get();
		}else{
			$data['modulos'] = Gerador::get();
		}

		$data['count'] = $post['count'];
		return view('admin/add-foreign-key', $data);
	}

	public function removeForeignKey(Request $request){
		try{
			$post = $request->input();
			$fk = FkModulo::find($post['id_fk']);

			DB::statement('ALTER TABLE '.$fk->modulo->nome_tabela.' DROP COLUMN '.$fk->nome);

			$fk->delete();

			echo json_encode(array(
				'status' => true,
				'message' => 'Registro removido com sucesso!'
			));
			exit;
		}catch(Exception $e){
			echo json_encode(array(
				'status' => false,
				'message' => 'Não foi possível remover o registro.'
			));
			exit;
		}

	}

}
