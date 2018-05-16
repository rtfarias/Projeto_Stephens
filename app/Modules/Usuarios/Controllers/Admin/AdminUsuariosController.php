<?php

namespace App\Modules\Usuarios\Controllers\Admin;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\Modules\Usuarios\Models\Usuarios;

class AdminUsuariosController extends BaseController
{
	private $modulo;
	private $fields;
	private $fks;
	private $lastInsertId;

    public function __construct(){
		parent::__construct();
		$this->middleware('auth');
		$this->modulo = \App\Gerador::find(21);
		$this->fields = \App\CampoModulo::where('id_modulo',21)->orderBy('ordem','ASC')->get();
		$this->fks = \App\FkModulo::where('id_modulo',21)->orderBy('ordem','ASC')->get();
		$this->usuarios_m = new Usuarios();
	}

	public function index(){
		$query = $this->usuarios_m->select('usuarios.*');


		//$data['usuarios'] = $this->usuarios_m->get();
		$data['fields_listagem'] = array();
		foreach ($this->fields as $field) {
			if($field->listagem){
				$data['fields_listagem'][] = $field;
			}
		}
		foreach ($this->fks as $fk) {
			$query->leftJoin($fk->moduloRelacionado->nome_tabela, 'usuarios.'.$fk->nome, '=', $fk->moduloRelacionado->nome_tabela.'.id');
			$query->addSelect($fk->moduloRelacionado->nome_tabela.'.'.$fk->campoRelacionado->nome.' as fk'.$fk->id);
			if($fk->listagem){
				$data['fields_listagem'] = $fk;
			}
		}

		$data['usuarios'] = $query->groupBy('usuarios.id')->get();

		/*foreach ($this->fks as $fk) {
			if($fk->listagem){
				$nomeVariavel = $fk->nome;
				$classPath = '\App\Modules\\'.$fk->moduloRelacionado->nome.'\Models\\'.$fk->moduloRelacionado->nome;
				foreach ($data['usuarios'] as $item) {
					$data['object_fk'][$item->id][$fk->id] = $classPath::find($item->$nomeVariavel);
				}
				$data['fields_listagem'][] = $field;
			}
		}*/

		usort($data['fields_listagem'], function($a, $b) {
		    return $a->ordem - $b->ordem;
		});

		return view('Usuarios::admin/usuarios',$data);
	}

	public function add(){
		$data = array();
		$data['modulo'] = $this->modulo;
		$data['fields'] = [];
		foreach ($this->fields as $field) {
			$data['fields'][] = $field;
		}
		foreach ($this->fks as $fk) {
			$data['fields'][] = $fk;
		}
		usort($data['fields'], function($a, $b) {
		    return $a->ordem - $b->ordem;
		});
		foreach ($this->fks as $fk) {
			$classPath = '\App\Modules\\'.$fk->moduloRelacionado->nome.'\Models\\'.$fk->moduloRelacionado->nome;
			$data['array_'.$fk->nome] = $classPath::get();
		}
		$data['nextId'] = $this->usuarios_m->getNextAutoIncrement();
		return view('Usuarios::admin/form-usuarios', $data);
	}

	public function edit($id){
		$data['modulo'] = $this->modulo;
		$data['fields'] = [];
		foreach ($this->fields as $field) {
			$data['fields'][] = $field;
		}
		foreach ($this->fks as $fk) {
			$data['fields'][] = $fk;
		}
		usort($data['fields'], function($a, $b) {
		    return $a->ordem - $b->ordem;
		});
		foreach ($this->fks as $fk) {
			$classPath = '\App\Modules\\'.$fk->moduloRelacionado->nome.'\Models\\'.$fk->moduloRelacionado->nome;
			$data['array_'.$fk->nome] = $classPath::get();
		}
		$data['usuario'] = $this->usuarios_m->find($id);
		if($this->modulo->galeria){
			$data['usuario']->imagens = $this->usuarios_m->getImagens($id);
		}
		return view('Usuarios::admin/form-usuarios',$data);
	}



	public function save(Request $request){
		try{
			$post = $request->input();

			$post['meta_keywords'] = (isset($post['meta_keywords'])) ? implode(',',$post['meta_keywords']) : null;

			foreach ($this->fields as $field) {
				$arrayFields[] = $field->nome;
			}
			foreach ($this->fks as $fk) {
				$arrayFields[] = $fk->nome;
			}
			if($this->modulo->imagem){
				$arrayFields[] = 'thumbnail_principal';
			}
			/*$arrayFields[] = 'meta_descricao';
			$arrayFields[] = 'meta_keywords';
			$arrayFields[] = 'slug';
			*/
			//$post['slug'] = $this->slugify($post['titulo']);
			if($request->input('id')){
				$this->usuarios_m->editar($arrayFields, $post, $request->input('id'));
			}else{
				$this->usuarios_m->criar($arrayFields, $post);
			}
			\Session::flash('type', 'success');
         \Session::flash('message', "Alteracoes salvas com sucesso!");
			return redirect('admin/usuarios');
		}catch(Exception $e){
			\Session::flash('type', 'error');
         \Session::flash('message', $e->getMessage());
         return redirect()->back();
		}


	}



	public function upload_image(Request $request) {
		if($request->hasFile('file')) {
			//upload an image to the /img/tmp directory and return the filepath.
			$file = $request->file('file');
			$tmpFilePath = '/uploads/usuarios/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
			return response()->json(array('path'=> $path, 'file_name'=>$tmpFileName), 200);
		} else {
			return response()->json(false, 200);
		}
	}

	public function upload_galeria($id, Request $request) {
		if($request->hasFile('file')) {
			//upload an image to the /img/tmp directory and return the filepath.
			$file = $request->file('file');
			$tmpFilePath = '/uploads/usuarios/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;

			$this->usuarios_m->criar_imagem(array('id_usuario' => $id, 'thumbnail_principal' => $tmpFileName));

			return response()->json(array('path'=> $path, 'file_name'=>$tmpFileName), 200);
		} else {
			return response()->json(false, 200);
		}
	}

	public function crop_image(Request $request) {
		$img = \Image::make('uploads/usuarios/'.$request->input('file_name'));
		$dataCrop = json_decode($request->input('data_crop'));
		if($img->crop(intval($dataCrop->width), intval($dataCrop->height), intval($dataCrop->x), intval($dataCrop->y))->save('uploads/usuarios/thumb_'.$request->input('file_name'))){
			@unlink('uploads/usuarios/'.$request->input('file_name'));
			echo json_encode(array(
				'status' => true,
				'path' => '/uploads/usuarios/thumb_'.$request->input('file_name'),
				'file_name' => 'thumb_'.$request->input('file_name'),
			));
		}else{
			echo json_encode(array(
				'status' => false,
				'message' => 'Não foi possível alterar a imagem.'
			));
		}

	}

	public function delete($id){
		try{
			$this->usuarios_m->deletar($id);

			\Session::flash('type', 'success');
            \Session::flash('message', "Registro removido com sucesso!");
			return redirect('admin/usuarios');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possivel remover o registro!");
            return redirect()->back();
		}


	}

	public function delete_imagem($id){
		try{
			$imagem = $this->usuarios_m->getImagem($id);
			$this->usuarios_m->deletar_imagem($id);

			unlink('uploads/usuarios/'.$imagem->thumbnail_principal);

			return response()->json(array('status' => true, 'message' => 'Registro removido com sucesso!'));
		}catch(Exception $e){
			return response()->json(array('status' => false, 'message' => $e->getMessage()));
		}


	}

	private function slugify($string)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }
}
