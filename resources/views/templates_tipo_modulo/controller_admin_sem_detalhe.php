<?php

namespace App\Modules\<NOME_MODULO>\Controllers\Admin;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\Modules\<NOME_MODULO>\Models\<NOME_MODULO>;

class Admin<NOME_MODULO>Controller extends BaseController
{
	private $modulo;
	private $fields;
	private $fks;

    public function __construct(){
		parent::__construct();
		$this->middleware('auth');
		$this->modulo = \App\Gerador::find(<ID_MODULO>);
		$this->fields = \App\CampoModulo::where('id_modulo',<ID_MODULO>)->orderBy('ordem','ASC')->get();
		$this->fks = \App\FkModulo::where('id_modulo',<ID_MODULO>)->orderBy('ordem','ASC')->get();
		$this-><NOME_TABELA>_m = new <NOME_MODULO>();
	}

	public function index(){
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
		$data['<ITEM_MODULO>'] = $this-><NOME_TABELA>_m->find(1);
		if($this->modulo->galeria){
			$data['<ITEM_MODULO>']->imagens = $this-><NOME_TABELA>_m->getImagens(1);
		}
		foreach ($this->fks as $fk) {
			$classPath = '\App\Modules\\'.$fk->moduloRelacionado->nome.'\Models\\'.$fk->moduloRelacionado->nome;
			$data['array_'.$fk->nome] = $classPath::get();
		}
		return view('<NOME_MODULO>::admin/<ROTA_MODULO>',$data);
	}


	public function save(Request $request){
		try{
			$post = $request->input();

			foreach ($this->fields as $field) {
				$arrayFields[] = $field->nome;
			}
			foreach ($this->fks as $fk) {
				$arrayFields[] = $fk->nome;
			}
			if($this->modulo->imagem){
				$arrayFields[] = 'thumbnail_principal';
			}

			$this-><NOME_TABELA>_m->editar($arrayFields, $post, $request->input('id'));

			\Session::flash('type', 'success');
         \Session::flash('message', "Alteracoes salvas com sucesso!");
			return redirect('admin/<ROTA_MODULO>');
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
			$tmpFilePath = '/uploads/<ROTA_MODULO>/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
			return response()->json(array('path'=> $path, 'file_name'=>$tmpFileName), 200);
		} else {
			return response()->json(false, 200);
		}
	}

	public function crop_image(Request $request) {
		$img = \Image::make('uploads/<ROTA_MODULO>/'.$request->input('file_name'));
		$dataCrop = json_decode($request->input('data_crop'));
		if($img->crop(intval($dataCrop->width), intval($dataCrop->height), intval($dataCrop->x), intval($dataCrop->y))->save('uploads/<ROTA_MODULO>/thumb_'.$request->input('file_name'))){
			@unlink('uploads/<ROTA_MODULO>/'.$request->input('file_name'));
			echo json_encode(array(
				'status' => true,
				'path' => '/uploads/<ROTA_MODULO>/thumb_'.$request->input('file_name'),
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
			$this-><NOME_TABELA>_m->deletar($id);

			\Session::flash('type', 'success');
         \Session::flash('message', "Registro removido com sucesso!");
			return redirect('admin/<ROTA_MODULO>');
		}catch(Exception $e){
			\Session::flash('type', 'error');
         \Session::flash('message', "Nao foi possivel remover o registro!");
         return redirect()->back();
		}
	}

	public function upload_galeria(Request $request) {
		if($request->hasFile('file')) {
			//upload an image to the /img/tmp directory and return the filepath.
			$file = $request->file('file');
			$tmpFilePath = '/uploads/<ROTA_MODULO>/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;

			$this-><NOME_TABELA>_m->criar_imagem(array('id_<ITEM_MODULO>' => 1, 'thumbnail_principal' => $tmpFileName));

			return response()->json(array('path'=> $path, 'file_name'=>$tmpFileName), 200);
		} else {
			return response()->json(false, 200);
		}
	}

	public function delete_imagem($id){
		try{
			$imagem = $this-><NOME_TABELA>_m->getImagem($id);
			$this-><NOME_TABELA>_m->deletar_imagem($id);

			unlink('uploads/<ROTA_MODULO>/'.$imagem->thumbnail_principal);

			return response()->json(array('status' => true, 'message' => 'Registro removido com sucesso!'));
		}catch(Exception $e){
			return response()->json(array('status' => false, 'message' => $e->getMessage()));
		}


	}

}
