<?php

namespace App\Http\Controllers\Api;

use Validator;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Sentinel;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Mail;
use App\User;


use App\Modules\Estados\Models\Estados;
use App\Modules\Cidades\Models\Cidades;
use App\Modules\Categorias\Models\Categorias;
use App\Services\AppService;


use Activation;
use DB;


class ApiController extends Controller
{
	use Helpers;

	public function __construct(){
		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function respostaSolicitacaoFornecedor(){
		$filtros = \Request::input();

		$mensagem = $filtros['mensagem'];
		unset($filtros['mensagem']);

		$id_relacao = DB::table('solicitacoes_fornecedores')->where([['id_solicitacao', $filtros['id_solicitacao']], ['id_fornecedor', $filtros['id_fornecedor']]])->update($filtros);

		//GRAVA na tabela de mensagens . 0 = cliente, 1 = fornecedor
		$arrayMensagem = ['id_cliente' => $filtros['id_cliente'], 'id_fornecedor' => $filtros['id_fornecedor'], 'id_solicitacao' => $filtros['id_solicitacao'], 'mensagem' => $arrayFiltros['mensagem'], 'enviado_por' => 1];  

		$id_relacao_mensagem = DB::table('mensagens')->insertGetId($arrayMensagem);

		$status = true;
		$message = 'Solicitação atualizada';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $filtros['id_solicitacao']
		));

	}

	public function deletarSolicitacao(){
		$filtros = \Request::input();

		if(!isset($filtros['id_solicitacao'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_solicitacao é obrigatório.'
			));
		}

		DB::table('solicitacoes_fornecedores')->where('id_solicitacao', $filtros['id_solicitacao'])->delete();
		DB::table('solicitacoes')->where('id', $filtros['id_solicitacao'])->delete();

		$status = true;
		$message = 'Solicitação deletada';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $filtros['id_solicitacao']
		));

	}

	public function cadastroSolicitacaoEmergencial(){

		$filtros = \Request::input();
		$arrayFiltros = \Request::input();

		unset($filtros['id_fornecedor']);
		unset($filtros['id_solicitacao']);
		unset($filtros['latitude']);
		unset($filtros['longitude']);
		unset($filtros['mensagem']);

		

		//if($arrayFiltros['id_solicitacao'] == 'null' || $arrayFiltros['id_solicitacao'] == ''){
		
		//}

		$lat = $arrayFiltros['latitude'];
		$lng = $arrayFiltros['longitude'];

		$fornecedoresQualificados = DB::table('fornecedores')->select('fornecedores.nome', 'fornecedores.id AS id_fornecedor', 'fornecedores.avaliacao', DB::raw("((ACOS(SIN(" . $lat . " * PI() / 180) * SIN(latitude * PI() / 180) +
	         COS(" . $lat . " * PI() / 180) * COS(latitude * PI() / 180) * COS((" . $lng . " - longitude) *
	         PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) AS distance"))->join('fornecedores_categorias', 'fornecedores_categorias.id_fornecedor', '=', 'fornecedores.id')->where([['fornecedores_categorias.id_categoria', $arrayFiltros['id_categoria']] ,['fornecedores_categorias.reparo_emergencial', 1]])->groupBy('fornecedores.id')->havingRaw('fornecedores.avaliacao > 3.9 AND distance <= 10')->inRandomOrder()->first();



		if($fornecedoresQualificados == null || count($fornecedoresQualificados) == 0){
			$fornecedoresQualificados = DB::table('fornecedores')->select('fornecedores.nome', 'fornecedores.id AS id_fornecedor','fornecedores.avaliacao', DB::raw("((ACOS(SIN(" . $lat . " * PI() / 180) * SIN(latitude * PI() / 180) +
	         COS(" . $lat . " * PI() / 180) * COS(latitude * PI() / 180) * COS((" . $lng . " - longitude) *
	         PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) AS distance"))->join('fornecedores_categorias', 'fornecedores_categorias.id_fornecedor', '=', 'fornecedores.id')->where([['fornecedores_categorias.id_categoria', $arrayFiltros['id_categoria']] ,['fornecedores_categorias.reparo_emergencial', 1]])->groupBy('fornecedores.id')->havingRaw('distance <= 10')->inRandomOrder()->first();


		}

		if($fornecedoresQualificados == null || count($fornecedoresQualificados) == 0){
			$fornecedoresQualificados = DB::table('fornecedores')->select('fornecedores.nome', 'fornecedores.id AS id_fornecedor', 'fornecedores.avaliacao')->join('fornecedores_categorias', 'fornecedores_categorias.id_fornecedor', '=', 'fornecedores.id')->where([['fornecedores_categorias.id_categoria', $arrayFiltros['id_categoria']] ,['fornecedores_categorias.reparo_emergencial', 1]])->groupBy('fornecedores.id')->inRandomOrder()->first();
		}

		//SE NAO RETORNAR NENHUM RESULTADO MESMO COM TODOS OS FILTROS ELE DEVE RETORNAR AO USUARIO FALSE
		if($fornecedoresQualificados == null  || count($fornecedoresQualificados) == 0){
			$status = false;
			$message = 'Nenhum resultado encontrado.';
			return json_encode(array(
				'status' => $status,
				'message' => $message,
				'response' => []
			));
		}

		//echo json_encode($fornecedoresQualificados->id_fornecedor); die;

		$arrayFiltros['id_solicitacao'] = DB::table('solicitacoes')->insertGetId($filtros);

		//GRAVA na relação de solicitacoes_fornecedores
		$array = ['id_cliente' => $arrayFiltros['id_cliente'], 'id_fornecedor' => $fornecedoresQualificados->id_fornecedor, 'id_solicitacao' => $arrayFiltros['id_solicitacao']];

		$id_relacao = DB::table('solicitacoes_fornecedores')->insertGetId($array);

		//GRAVA na tabela de mensagens. 0 = cliente, 1 = fornecedor
		$arrayMensagem = ['id_cliente' => $arrayFiltros['id_cliente'], 'id_fornecedor' => $fornecedoresQualificados->id_fornecedor, 'id_solicitacao' => $arrayFiltros['id_solicitacao'], 'mensagem' => $arrayFiltros['mensagem'], 'enviado_por' => 0];

		$id_relacao_mensagem = DB::table('mensagens')->insertGetId($arrayMensagem);




		//funções de envio de push
		$cliente = DB::table('clientes')->select('nome')->where('id', $arrayFiltros['id_cliente'])->first();
		$fornecedor = DB::table('fornecedores')->select('udid')->where('id', $fornecedoresQualificados->id_fornecedor)->first();
		
		$arrayUsuarios = [$fornecedor->udid];
		$descricao = 'Solicitação reparo emergencial criada pelo cliente '.$cliente->nome;
		$titulo = 'Solicitação de reparo';
		$data = ['id_cliente'=> $arrayFiltros['id_cliente'], 'id_fornecedor'=> $fornecedoresQualificados->id_fornecedor, 'id_solicitacao'=> $arrayFiltros['id_solicitacao']];
		//AppService::enviaPush($arrayUsuarios, $descricao, $titulo, $data);


		$status = true;
		$message = 'Retorno solicitação';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $arrayFiltros['id_solicitacao']
		));


	}

	public function cadastroSolicitacao(){

		$filtros = \Request::input();
		$arrayFiltros = \Request::input();

		if(!isset($filtros['id_categoria']) || !$filtros['id_categoria']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_categoria é obrigatório.'
			));
		}

		if(!isset($filtros['id_fornecedor']) || !$filtros['id_fornecedor']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_fornecedor é obrigatório.'
			));
		}

		// unset($filtros['id_fornecedor']);
		unset($filtros['id_solicitacao']);
		unset($filtros['latitude']);
		unset($filtros['longitude']);
		unset($filtros['mensagem']);

		if($arrayFiltros['id_solicitacao'] == 'null' || $arrayFiltros['id_solicitacao'] == '' || $arrayFiltros['id_solicitacao'] == null){
			$arrayFiltros['id_solicitacao'] = DB::table('solicitacoes')->insertGetId($filtros);
		}

		//GRAVA na relação de solicitacoes_fornecedores
		$array = ['id_cliente' => $arrayFiltros['id_cliente'], 'id_fornecedor' => $arrayFiltros['id_fornecedor'], 'id_solicitacao' => $arrayFiltros['id_solicitacao']];

		$id_relacao = DB::table('solicitacoes_fornecedores')->insertGetId($array);

		//GRAVA na tabela de mensagens
		$arrayMensagem = ['id_cliente' => $arrayFiltros['id_cliente'], 'id_fornecedor' => $arrayFiltros['id_fornecedor'], 'id_solicitacao' => $arrayFiltros['id_solicitacao'], 'mensagem' => $arrayFiltros['mensagem'], 'enviado_por' => 0];

		$id_relacao_mensagem = DB::table('mensagens')->insertGetId($arrayMensagem);


		
		//funções de envio de push
		$cliente = DB::table('clientes')->select('nome')->where('id', $arrayFiltros['id_cliente'])->first();
		$fornecedor = DB::table('fornecedores')->select('udid')->where('id', $arrayFiltros['id_fornecedor'])->first();
		//echo json_encode($udidFornecedor->udid); die();
		$arrayUsuarios = [$fornecedor->udid];
		$descricao = 'Solicitação reparo criada pelo cliente '.$cliente->nome;
		$titulo = 'Solicitação de reparo';
		$data = ['id_cliente'=> $arrayFiltros['id_cliente'], 'id_fornecedor'=> $arrayFiltros['id_fornecedor'], 'id_solicitacao'=> $arrayFiltros['id_solicitacao']];
		//AppService::enviaPush($arrayUsuarios, $descricao, $titulo, $data);


		$status = true;
		$message = 'Retorno solicitação';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $arrayFiltros['id_solicitacao']
		));


	}

	public function uploadImagem(Request $request){

		$post = \Request::input();
		if(!isset($post['id_solicitacao']) && !isset($post['id_cliente']) && !isset($post['id_fornecedor'])){
			return json_encode(array(
			'status' => false,
			'message' => 'o id_solicitacao ou id_cliente ou id_fornecedor é obrigatório.'
			));
		}	

		if($request->hasFile('file')) {
			$file = $request->file('file');
			$tipo = $request->input('tipo');

			$tmpFilePath = 'uploads/'.$tipo.'/'.$id.'/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() .'/'. $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;

			$img = \Image::make($tmpFilePath.$tmpFileName);
			$tmpThumbName = 'thumb_'.$tmpFileName;
			if($img->resize($img->width()/5, $img->height()/5)->save($tmpFilePath.$tmpThumbName)){
				$pathThumb = '/'.$tmpFilePath.$tmpThumbName;

				$update['thumbnail_principal'] = $pathThumb;

				if(isset($post['id_solicitacao']) && is_array($post['id_solicitacao'])) {
					foreach ($post['id_solicitacao'] as $id) {
						DB::table('solicitacoes')->where('id',$id)->update($update);
					}
				}
				if(isset($post['id_cliente'])){
					DB::table('clientes')->where('id',$post['id_cliente'])->update($update);
				}if(isset($post['id_fornecedor'])){
					DB::table('fornecedores')->where('id',$post['id_fornecedor'])->update($update);
				}

				return response()->json(array('status' => true, 'path'=> $path, 'file_name'=>$tmpFileName, 'path_thumb' => $pathThumb, 'file_name_thumb' => $tmpThumbName), 200);
			}else{
				return response()->json(array('status'=>false,'message' => 'Não foi possível alterar o tamanho da imagem.'), 200);
			}
		} else {
			return response()->json(false, 200);
		}
	}

	public function buscaFornecedores(){
		$filtros = \Request::input();

		if(!isset($filtros['id_categoria']) && !isset($filtros['nome'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_categoria ou nome é obrigatório.'
			));
		}

	//	$query = DB::table('fornecedores')->select('fornecedores.*', 'fornecedores_categorias.*', 'categorias.id AS id_categoria', 'categorias.nome AS nome_categoria')->join('fornecedores_categorias', 'fornecedores_categorias.id_fornecedor', '=', 'fornecedores.id')->join('categorias', 'categorias.id', '=', 'fornecedores_categorias.id_categoria');

		$query = DB::table('fornecedores')->select('fornecedores.*', 'fornecedores_categorias.*', 'categorias.id AS id_categoria', 'fornecedores.id AS id', 'categorias.nome AS nome_categoria')->join('fornecedores_categorias', 'fornecedores_categorias.id_fornecedor', '=', 'fornecedores.id')->join('categorias', 'categorias.id', '=', 'fornecedores_categorias.id_categoria');





		$where = [['ativo', '1']];

		if($filtros['nome'] != '' && $filtros['nome'] != 'null'){
			$where[] = ['fornecedores.nome', 'like', '%'.$filtros['nome'].'%'];
		}

		if($filtros['id_categoria'] != '' && $filtros['id_categoria'] != 'null'){
			$where[] = ['fornecedores_categorias.id_categoria', $filtros['id_categoria']];
		}

		//echo json_encode($where);die();

		$query = $query->where($where)->groupBy('fornecedores.id');
		$fornecedores = $query->get();



		foreach ($fornecedores as $key => $fornecedor) {
		
				$query2 = DB::table('categorias')->select('categorias.*')->join('fornecedores_categorias', 'fornecedores_categorias.id_categoria', '=', 'categorias.id')->where('fornecedores_categorias.id_fornecedor', $fornecedor->id_fornecedor);

				$categorias = $query2->get();

				$fornecedores[$key]->categorias = $categorias;
		}	


		$status = true;
		$message = 'Lista de fornecedores';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $fornecedores
		));

	}

	public function getDetalhesSolicitacao(){
		$filtros = \Request::input();
 
		if(!isset($filtros['id_solicitacao']) || !$filtros['id_solicitacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_solicitacao é obrigatório.'
			));
		}

		$query = DB::table('solicitacoes_fornecedores')
				   	->select('solicitacoes_fornecedores.*', 'solicitacoes.*', 'fornecedores.nome AS nome_fornecedor', 'clientes.nome AS nome_cliente', 'clientes.email AS email_cliente', 'clientes.telefone AS telefone_cliente', 'categorias.nome AS nome_categoria')
				   	->join('fornecedores', 'solicitacoes_fornecedores.id_fornecedor', '=', 'fornecedores.id')
				   	->join('clientes', 'solicitacoes_fornecedores.id_cliente', '=', 'clientes.id')
				   	->join('solicitacoes', 'solicitacoes_fornecedores.id_solicitacao', '=', 'solicitacoes.id')
				   	->join('categorias', 'solicitacoes.id_categoria', '=', 'categorias.id');

		if(isset($filtros['aceito'])){
			$query = $query->where('solicitacoes_fornecedores.aceito', $filtros['aceito']);
		}

		if(isset($filtros['finalizado'])){
			$query = $query->where('solicitacoes.finalizado', $filtros['finalizado']);
		}

		$solicitacao = $query->where('solicitacoes_fornecedores.id_solicitacao', $filtros['id_solicitacao'])->first();

		$query_mensagens = DB::table('mensagens')->select('mensagens.*')->where('id_solicitacao',$filtros['id_solicitacao'])->get();

		if(!empty($solicitacao)){
			$solicitacao->mensagens = $query_mensagens;
		}

		$status = true;
		$message = 'Detalhes da solicitação';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $solicitacao
		));

	}

	public function getSolicitacoesDeClientes(){
		$filtros = \Request::input();
 
		if(!isset($filtros['id_fornecedor']) || !$filtros['id_fornecedor']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_fornecedor é obrigatório.'
			));
		}

		$query = DB::table('solicitacoes_fornecedores')->select('solicitacoes_fornecedores.*', 'solicitacoes.*', 'fornecedores.nome AS nome_fornecedor', 'clientes.nome AS nome_cliente', 'categorias.nome AS nome_categoria')->join('fornecedores', 'solicitacoes_fornecedores.id_fornecedor', '=', 'fornecedores.id')->join('clientes', 'solicitacoes_fornecedores.id_cliente', '=', 'clientes.id')->join('solicitacoes', 'solicitacoes_fornecedores.id_solicitacao', '=', 'solicitacoes.id')->join('categorias', 'solicitacoes.id_categoria', '=', 'categorias.id');

		if(isset($filtros['aceito'])){
			$query = $query->where('solicitacoes_fornecedores.aceito', $filtros['aceito']);
		}

		if(isset($filtros['finalizado'])){
			$query = $query->where('solicitacoes.finalizado', $filtros['finalizado']);
		}

		$solicitacoes = $query->where('solicitacoes_fornecedores.id_fornecedor', $filtros['id_fornecedor'])->get();

		$status = true;
		$message = 'Lista de solicitações';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $solicitacoes
		));

	}

	public function getMinhasSolicitacoes(){
		$filtros = \Request::input();
 
		if(!isset($filtros['id_cliente']) || !$filtros['id_cliente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_cliente é obrigatório.'
			));
		}

		$solicitacoes = DB::table('solicitacoes_fornecedores')->select('solicitacoes.*', 'solicitacoes_fornecedores.id_fornecedor AS id_fornecedor', 'fornecedores.nome AS nome_fornecedor', 'fornecedores.email AS email_fornecedor', 'fornecedores.telefone AS telefone_fornecedor','categorias.nome AS nome_categoria')->join('fornecedores', 'solicitacoes_fornecedores.id_fornecedor', '=', 'fornecedores.id')->join('solicitacoes', 'solicitacoes.id', '=', 'solicitacoes_fornecedores.id_solicitacao')->join('categorias', 'solicitacoes.id_categoria', '=', 'categorias.id')->where('solicitacoes_fornecedores.id_cliente', $filtros['id_cliente'])->get();

		$status = true;
		$message = 'Lista de solicitações';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $solicitacoes
		));

	}

	public function getAvaliacoesRecebidasFornecedores(){

		$filtros = \Request::input();

		if(!isset($filtros['id_fornecedor']) || !$filtros['id_fornecedor']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_fornecedor é obrigatório.'
			));
		}

		$avaliacoes = DB::table('avaliacoes_fornecedores')->select('avaliacoes_fornecedores.*', 'clientes.nome AS nome_cliente', 'clientes.id AS id_cliente',  'fornecedores.nome AS nome_fornecedor', 'fornecedores.id AS fornecedor')->join('clientes', 'avaliacoes_fornecedores.id_cliente', '=', 'clientes.id')->join('fornecedores', 'avaliacoes_fornecedores.id_fornecedor', '=', 'fornecedores.id')->where('avaliacoes_fornecedores.id_fornecedor', $filtros['id_fornecedor'])->get();


		$status = true;
		$message = 'Lista de avaliações.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $avaliacoes
		));
	}

	public function getAvaliacoesRecebidasClientes(){

		$filtros = \Request::input();

		if(!isset($filtros['id_cliente']) || !$filtros['id_cliente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_cliente é obrigatório.'
			));
		}

		$avaliacoes = DB::table('avaliacoes_clientes')->select('avaliacoes_clientes.*', 'clientes.nome AS nome_cliente', 'clientes.id AS id_cliente',  'fornecedores.nome AS nome_fornecedor', 'fornecedores.id AS fornecedor')->join('clientes', 'avaliacoes_clientes.id_cliente', '=', 'clientes.id')->join('fornecedores', 'avaliacoes_clientes.id_fornecedor', '=', 'fornecedores.id')->where('avaliacoes_clientes.id_cliente', $filtros['id_cliente'])->get();

		$status = true;
		$message = 'Lista de avaliações.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $avaliacoes
		));
	}

	public function getTipos(){
		$tipos = Categorias::select('categorias.id', 'categorias.nome', 'categorias.codigo')->get();

		$status = true;
		$message = 'Lista de tipos.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $tipos
		));
	}

	public function getCidades(){
		$cidades = Cidades::select('cidades.id', 'cidades.cidade')->get();

		$status = true;
		$message = 'Lista de cidades.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $cidades
		));
	}


	public function cadastrarCliente(){

		$filtros = \Request::input();

		$id_cliente = '';

		if($filtros['id_cliente'] == null){

			unset($filtros['id_cliente']);

			//Insere cliente e pega o Id inserido
			$id_cliente = DB::table('clientes')->insertGetId($filtros);

		}else{

			$id_cliente = $filtros['id_cliente'];

			unset($filtros['id_cliente']);

			//Update dados do cliente
			DB::table('clientes')->where('id', $id_cliente)->update($filtros);
			

		}

		$status = true;
		$message = 'Consulta cadastrada.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $id_cliente
		));


	}










//APAGAR DEPOIS <-------------------------------------------> APAGAR DEPOIS----------------------------------

	public function getConsultas(){
		$filtros = \Request::input();

		if(!isset($filtros['id_cliente']) || !$filtros['id_cliente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo cliente é obrigatório.'
			));
		}

		$consultas = DB::table('consultas')->select('consultas.*', 'sis_users.first_name AS nome_clinica','consultas.id AS id')->join('sis_users', 'consultas.clinica', '=', 'sis_users.id')->where('consultas.id_cliente', $filtros['id_cliente'])->limit('50')->orderBy('consultas.id', 'desc')->get();

		$array = array();
		foreach ($consultas as $key) {
			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Sao_Paulo');
			$data = strftime('%d de %B de %Y', strtotime($key->datahorario));
			$key->data_formatada = $data;
			$array[] = $key;
		}

		$status = true;
		$message = 'Lista de consultas.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $array
		));
	}

	public function getDetalheNoticia(){
		$filtros = \Request::input();

		if(!isset($filtros['id_noticia']) || !$filtros['id_noticia']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_noticia é obrigatório.'
			));
		}

		$noticias = DB::table('noticias')->select('noticias.*', 'noticias.id AS id')->join('clientes_consultas', 'clientes_consultas.id_clinica', '=', 'noticias.id_clinica')->where([['noticias.id', $filtros['id_noticia']]])->limit(1)->get();

		$listaNoticias = array();
		$urlBase  = url('/').'/uploads/noticias/';

		foreach ($noticias as $key => $value) {
			$value->thumbnail_principal = $urlBase.$value->thumbnail_principal;
		}

		$status = true;
		$message = 'Detalhe notícia.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $noticias
		));
	}

	public function getNoticias(){
		$filtros = \Request::input();

		if(!isset($filtros['id_cliente']) || !$filtros['id_cliente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo cliente é obrigatório.'
			));
		}

		$noticias = DB::table('noticias')->select('noticias.*', 'noticias.id AS id')->join('clientes_consultas', 'clientes_consultas.id_clinica', '=', 'noticias.id_clinica')->where([['clientes_consultas.id_cliente', $filtros['id_cliente']],['noticias.aceito', 1]])->limit('50')->orderBy('noticias.id', 'desc')->get();

		$status = true;
		$message = 'Lista de notícias.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $noticias
		));
	}

	public function insereConsulta(){

		$array = \Request::input();

		$arrayCliente = ['nome' => $array['nome'], 'udid' => $array['udid'], 'email' => $array['email'], 'telefone' => $array['telefone']];

		$cliente = DB::table('clientes')->select('id')->where('email', '=', $array['email'])->limit('1')->get();

		
		if(count($cliente) == 0){

			//Insere cliente e pega o Id inserido
			$idcliente = DB::table('clientes')->insertGetId($arrayCliente);

			

			$clinica_consulta = DB::table('clientes_consultas')->where([['id_cliente', '=', $idcliente],['id_clinica', '=', $array['id_clinica']]])->count();


			if($clinica_consulta == 0){
				$arrayRelacionamento = ['id_cliente' => $idcliente, 'id_clinica' => $array['id_clinica']];
				//Insere na tabela de relacionamento caso ainda não haja. A partir daí o cliente deve aprecer para essa clínica
				$idrelacionamento = DB::table('clientes_consultas')->insertGetId($arrayRelacionamento);
			}

		}else{

			$idcliente = $cliente[0]->id;

			//Atualiza os dados do cliente
			$result = DB::table('clientes')->where('id', $idcliente)->update($arrayCliente);

			$clinica_consulta = DB::table('clientes_consultas')->where([['id_cliente', '=', $cliente[0]->id],['id_clinica', '=', $array['id_clinica']]])->count();

			if($clinica_consulta == 0){
				$arrayRelacionamento = ['id_cliente' => $cliente[0]->id, 'id_clinica' => $array['id_clinica']];
				//Insere na tabela de relacionamento caso ainda não haja. A partir daí o cliente deve aprecer para essa clínica
				$idrelacionamento = DB::table('clientes_consultas')->insertGetId($arrayRelacionamento);
			}
		}

		$arrayConsulta = [
			'titulo' => $array['titulo'],
			'id_cliente' => $idcliente,
			'datahorario' => $array['datahorario'],
			'titulo' => $array['titulo'],
			'aceito' => 2,
			'tipo' => $array['id_tipo'],
			'descricao' => $array['descricao'],
			'clinica' => $array['id_clinica']
		];
		//Insere consulta
		$idconsulta = DB::table('consultas')->insertGetId($arrayConsulta);

		if($idconsulta){

			$user = Sentinel::findUserById($array['id_clinica']);

			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			$data = strftime('%d de %B de %Y', strtotime($array['datahorario']));
			$horario = strftime('%k:%M', strtotime($array['datahorario']));

			$data = array(
				'nome_cliente' => $array['nome'],
				'data' => $data,
				'horario' => $horario,
				'titulo' => 'Olá, você recebeu um nova solicitação de consulta',
				'descricao' => 'O Cliente "'.$array['nome'].'" fez uma solicitação de consulta. Acesse o gerenciador para aceitar ou rejeitar o agendamento.' ,
				'link' => 'http://institutofacesimples.duoapp.com.br/admin/login'

			);
			
			Mail::send('emails.email_consulta', $data, function ($m) use($user){
			    $m->from(env('MAIL_USERNAME'), 'Instituto da Face');
			    $m->to($user->email)->subject('Nova solicitação de consulta');
			});
		}

		$status = true;
		$message = 'Consulta cadastrada.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $idcliente
		));


	}

	public function detalheClinica(){
		$filtros = \Request::input();

		if(!isset($filtros['clinica']) || !$filtros['clinica']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo clínica é obrigatório.'
			));
		}

		$query = User::select('sis_users.*')->orderBy('sis_users.first_name', 'ASC');

		if(isset($filtros['clinica'])){
			$query->where('id', $filtros['clinica']);
		}

		$listaClinicas = $query->first();

		$status = true;
		$message = 'Lista de clínicas.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $listaClinicas
		));

	} 


	public function buscarClinicas(){

		$filtros = \Request::input();

		/*if(!isset($filtros['cidade']) || !$filtros['cidade']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo cidade é obrigatório.'
			));
		}*/                       

		$query = User::select('sis_users.id', 'sis_users.first_name', 'sis_users.endereco', 'sis_users.numero', 'sis_users.complemento', 'sis_role_users.role_id')->join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')->where([
				['sis_role_users.role_id', '<>', 1], 
			])->orderBy('sis_users.first_name', 'ASC');

		if(isset($filtros['cidade'])){
			$query->where([
				['sis_users.cidade', $filtros['cidade']]
			]);
		}

		$listaClinicas = $query->get();

		$status = true;
		$message = 'Lista de clínicas.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $listaClinicas
		));
	}

	public function buscarEstados(){

		$filtros = \Request::input();
		$query = Estados::select('estados.*')->join('sis_users', 'estados.id', '=', 'sis_users.estado')->groupBy('sis_users.estado')->orderBy('estados.estado', 'ASC');

		$listaEstados = $query->get();
		$status = true;
		$message = 'Lista de estados.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $listaEstados
		));
	}

	public function buscarCidades()
	{
		$filtros = \Request::input();

		if(!isset($filtros['estado']) || !$filtros['estado']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo estado é obrigatório.'
			));
		}

		$query = Cidades::select('cidades.*')->join('sis_users', 'cidades.id', '=', 'sis_users.cidade')->groupBy('sis_users.cidade')->orderBy('cidades.cidade', 'ASC');

		if(isset($filtros['estado'])){
			$query->where('cidades.estado', $filtros['estado']);
		}

		$listaCidades = $query->get();

		$status = true;
		$message = 'Lista de cidades.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $listaCidades
		));
	}




	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function teste()
	{
		//return view('admin.sessions.create');

		$user = app('Dingo\Api\Auth\Auth')->user();

		return $user;
	}

	public function sindicoLogin(){
		$params = \Request::input();
		$response = null;
		if(User::join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')->where('sis_role_users.role_id', 2)->where('email', $params['email'])->count()){
			$user = Sentinel::authenticate(array(
				'email'    => $params['email'],
				'password' => $params['password']
			));
			if($user){
				$response = $user;
				$status = true;
				$message = 'Usuário logado com sucesso.';
			}else{
				$status = false;
				$message = 'Não foi possível efetuar o login. E-mail ou senha inválidos.';
			}
		}else{
			$status = false;
			$message = 'Não existe um usuário com esse e-mail';
		}

		if($response){
			$condomino = Condominos::where('id_user', $response->id)->first();
			$response->id_user = $response->id;
			$response->id = $condomino->id;
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	public function login(){
		$params = \Request::input();
		$response = null;
		if(isset($params['id_condominio'])){
			if(User::join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')->join('condomino', 'sis_users.id_condomino' , '=', 'condomino.id')->join('condominio_unidade', 'condomino.id_condominio_unidade', '=', 'condominio_unidade.id')->join('condominio_torre', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')->where('sis_users.email', $params['email'])->where('condominio_torre.id_condominio', $params['id_condominio'])->count()){
				$user = Sentinel::authenticate(array(
					'email'    => $params['email'],
					'password' => $params['password']
				));

				if($user){

					$userModel = \App\User::find($user->id);
					if(isset($params['udid']) && $params['udid']){
						$userModel->udid = $params['udid'];
						$userModel->save();
					}
					$notificacoes = ConfiguracaoNotificacao::where('configuracao_notificacao.id_user',$user->id)->get();
					$user->notificacoes = $notificacoes;
					$user->udid = $userModel->udid;
					$user->role = $userModel->roleUser->role;
					$user->permissions = str_replace('.','_',$user->permissions);
					$response = $user;
					$status = true;
					$message = 'Usuário logado com sucesso.';
				}else{
					$status = false;
					$message = 'Não foi possível efetuar o login. E-mail ou senha inválidos.';
				}
			}else{
				$status = false;
				$message = 'Não foi possível efetuar o login. Usuário não encontrado para esse condomínio.';
			}
		}else{
			$status = false;
			$message = 'É necessário enviar o código do condomínio.';
		}


		if($response){
			$condomino = Condominos::select('condomino.*')->join('sis_users', 'condomino.id', '=', 'sis_users.id_condomino')->where('sis_users.id', $response->id)->first();
			$response->id_user = $response->id;
			$response->id = $condomino->id;
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	public function buscarEventos()
	{

		$filtros = \Request::input();

		//var_dump($filtros); exit;


		$query = Evento::select('evento.*');
		if(isset($filtros['id_evento'])){
			$query->where('id', $filtros['id_evento']);
		}

		if(isset($filtros['status'])){
			$query->where('status', $filtros['status']);
		}

		if(isset($filtros['id_condominio_torre'])){
			$query->where('id_condominio_torre', $filtros['id_condominio_torre']);
		}

		if(isset($filtros['ano']) && isset($filtros['mes']) && isset($filtros['dia'])){
			$dataParametro = $filtros['ano'] . '-' . $filtros['mes'] . '-' . $filtros['dia'];
			$query->whereBetween('data', [$dataParametro . ' 00:00:00', $dataParametro . ' 23:59:59']);
		}


		$listaEventos = $query->get();

		foreach ($listaEventos as $key => $evento) {
			$flagCurtido = false;

			if($evento->id_user_responsavel){
				$listaEventos[$key]->userresponsavel = User::find($evento->id_user_responsavel);
				/*
				if($listaEventos[$key]->userresponsavel){
				$listaPosts[$key]->empresa->thumbnail_principal = url('/uploads/empresa/'.$listaPosts[$key]->empresa->thumbnail_principal);
			}
			*/
			}
			if($listaEventos[$key]->data){
				$listaEventos[$key]->data = date('d/m/Y H:i:s', strtotime($evento->data));
			}

		}

		return $listaEventos;
	}

	public function buscarRecados()
	{

		$filtros = \Request::input();
		$query = Recado::select('recado.*')->orderBy('recado.data', 'desc')->groupBy('recado.id');

		if(isset($filtros['limit'])){
			$query->limit($filtros['limit']);
		}

		if(isset($filtros['id_recado'])){
			$query->where('recado.id', $filtros['id_recado']);
		}

		if(isset($filtros['tipo'])){
			$query->where('recado.tipo', $filtros['tipo']);
		}

		if(isset($filtros['id_user_remetente'])){
			$query->where('recado.id_user_remetente', $filtros['id_user_remetente']);
		}

		if(isset($filtros['id_user'])){
			$query->join('recado_destinatario', 'recado.id', '=', 'recado_destinatario.id_recado');
			$query->where('recado_destinatario.id_user_destinatario', $filtros['id_user']);
			$query->orWhere('recado.id_user_remetente', $filtros['id_user']);
		}

		$listaRecados = $query->get();
		if(isset($filtros['id_recado'])){
			$listaRecados->load(['respostas' => function ($query) {
			   $query->orderBy('data', 'desc');
			}, 'respostas.remetente.condomino']);
		}
		foreach ($listaRecados as $key => $recado) {

			if($recado->id_user_remetente){
				$userremetente = User::find($recado->id_user_remetente);
				$listaRecados[$key]->first_name = $userremetente->first_name;
				$listaRecados[$key]->last_name = $userremetente->last_name;
				$listaRecados[$key]->thumbnail = $userremetente->thumbnail_principal;
			}

			if($recado->data){
				$listaRecados[$key]->data = date('d/m/Y', strtotime($recado->data));
			}

			if($recado->tipo){
				if ($recado->tipo == 'E') $listaRecados[$key]->tipo_string = 'Evento';
				if ($recado->tipo == 'A') $listaRecados[$key]->tipo_string = 'Aviso';
				if ($recado->tipo == 'S') $listaRecados[$key]->tipo_string = 'Solicitação';
			}

		}

		return $listaRecados;
	}

	public function buscarDocumentos()
	{

		$filtros = \Request::input();
		$query = Documento::select('documento.*')->orderBy('documento.data_criacao', 'desc')->orderBy('documento.data_modificacao', 'desc')->groupBy('documento.id');
		if(isset($filtros['id_documento'])){
			$query->where('documento.id', $filtros['id_documento']);
		}

		if(isset($filtros['id_user_criacao'])){
			$query->where('documento.id_user_criacao', $filtros['id_user_criacao']);
		}

		if(isset($filtros['id_user_modificacao'])){
			$query->where('documento.id_user_modificacao', $filtros['id_user_modificacao']);
		}

		if(isset($filtros['id_condominio'])){
			$query->join('condominio_torre', 'documento.id_condominio_torre', '=', 'condominio_torre.id');
			$query->where('condominio_torre.id_condominio', $filtros['id_condominio']);
		}

		$listaDocumentos = $query->with('categoria', 'torre', 'userCriacao', 'userModificacao')->get();

		return $listaDocumentos;
	}

	public function buscarReservas()
	{

		$filtros = \Request::input();
		$query = Reserva::select('reserva.*')->orderBy('reserva.data', 'desc')->groupBy('reserva.id');
		if(isset($filtros['id_reserva'])){
			$query->where('reserva.id', $filtros['id_reserva']);
		}

		if(isset($filtros['id_user_responsavel'])){
			$query->where('reserva.id_user_responsavel', $filtros['id_user_responsavel']);
		}

		if(isset($filtros['status'])){
			$query->where('reserva.status', $filtros['status']);
		}

		if(isset($filtros['data'])){
			$query->where('reserva.data', '>=', $filtros['data']);
		}

		$listaReservas = $query->get();

		foreach ($listaReservas as $key => $reserva) {
			$reserva->convidados;
			$reserva->condominioUnidade;
			$reserva->espacoComumHorario;
			$reserva->espacoComum;
			$reserva->userResponsavel;
			if ($reserva->status == 'P') $listaReservas[$key]->status_string = 'Pendente';
			if ($reserva->status == 'A') $listaReservas[$key]->status_string = 'Aprovada';
			if ($reserva->status == 'R') $listaReservas[$key]->status_string = 'Recusada';
		}

		return $listaReservas;
	}

	public function buscarAvisos()
	{

		$filtros = \Request::input();
		$query = Aviso::select('aviso.*')->orderBy('aviso.data', 'desc');
		$query->where('status', 'A');

		if(isset($filtros['id_aviso'])){
			$query->where('id_aviso', $filtros['id_aviso']);
		}

		if(isset($filtros['id_user_destinatario'])){
			$query->where('id_user_destinatario', $filtros['id_user_destinatario']);
		}

		$listaAvisos = $query->get();

		foreach ($listaAvisos as $key => $aviso) {

			if($aviso->id_user_remetente){
				$listaAvisos[$key]->userremetente = User::find($aviso->id_user_remetente);
			}

			if($aviso->data){
				$listaAvisos[$key]->data = date('d/m/Y', strtotime($aviso->data));
			}

		}

		return $listaAvisos;
	}

	public function buscarQuestionamentos()
	{

		$filtros = \Request::input();
		$offset = (isset($filtros['offset'])) ? $filtros['offset'] : 0;
		$limit = (isset($filtros['limit'])) ? $filtros['limit'] : 10;

		$query = Questionamento::select(array('questionamento.*', 'questionamento_assunto.nome'))->orderBy('questionamento.data_criacao', 'DESC')->limit($limit);

		$query->join('questionamento_assunto', 'questionamento_assunto.id', '=', 'questionamento.id_questionamento_assunto');

		if(isset($filtros['id_questionamento'])){
			$query->where('questionamento.id', $filtros['id_questionamento']);
		}

		if(isset($filtros['id_user_destinatario'])){
			$query->where('questionamento.id_user_destinatario', $filtros['id_user_destinatario']);
		}

		if(isset($filtros['visualizado'])){
			$query->where('questionamento.visualizado', $filtros['visualizado']);
		}

		if(isset($filtros['id_user_remetente'])){
			$query->where('questionamento.id_user_remetente', $filtros['id_user_remetente']);
		}

		if(isset($filtros['tipo'])){
			$query->where('questionamento.tipo', $filtros['tipo']);
		}

		if(isset($filtros['status'])){
			$query->where('questionamento.status', $filtros['status']);
		}

		if(isset($filtros['id_condominio'])){
			$query->join('sis_users','questionamento.id_user_destinatario', '=', 'sis_users.id');
			$query->join('condomino','sis_users.id_condomino', '=', 'condomino.id');
			$query->join('condominio_unidade','condomino.id_condominio_unidade', '=', 'condominio_unidade.id');
			$query->join('condominio_torre','condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id');
			$query->where('condominio_torre.id_condominio', $filtros['id_condominio']);
		}


		$listaQuestionamentos = $query->get();

		if(isset($filtros['id_questionamento'])){
			$listaQuestionamentos->load(['respostas' => function ($q) {
			   $q->orderBy('questionamento_resposta.data', 'desc');
			}, 'respostas.sindico']);
		}

		$questionamentosPendentes = [];
		$questionamentosFinalizadosOuAssembleia = [];
		$count = 0;
		foreach ($listaQuestionamentos as $key => $questionamento) {

			if($questionamento->id_user_remetente){
				$userremetente = User::find($questionamento->id_user_remetente);
				$listaQuestionamentos[$key]->first_name = $userremetente->first_name;
				$listaQuestionamentos[$key]->last_name = $userremetente->last_name;
				$listaQuestionamentos[$key]->thumbnail_user = $userremetente->thumbnail_principal;
			}

			if($questionamento->data){
				$listaQuestionamentos[$key]->data = date('d/m/Y', strtotime($questionamento->data));
			}

			if($questionamento->tipo){
				if ($questionamento->tipo == 'R') $listaQuestionamentos[$key]->tipo_string = 'Reclamação';
				if ($questionamento->tipo == 'S') $listaQuestionamentos[$key]->tipo_string = 'Sugestão';
			}

			/*foreach ($questionamento->respostas as $resposta) {
				$resposta->sindico;
			}*/

			if($questionamento->status){
				if ($questionamento->status == 'P'){
					$listaQuestionamentos[$key]->status_string = 'Pendente';
					$questionamentosPendentes[] = $questionamento;
				}
				if ($questionamento->status == 'F'){
					$listaQuestionamentos[$key]->status_string = 'Finalizado';
					if($count < $limit && $count >= $offset){
						$questionamentosFinalizadosOuAssembleia[] = $questionamento;
						$count++;
					}
				}
				if ($questionamento->status == 'A'){
					$listaQuestionamentos[$key]->status_string = 'Discutir em Assembléia';
					if($count < $limit && $count >= $offset){
						$questionamentosFinalizadosOuAssembleia[] = $questionamento;
						$count++;
					}
				}
			}
		}

		if(isset($filtros['id_questionamento'])){
			return $listaQuestionamentos;
		}else {
			return json_encode(array(
				'questionamentos_pendentes' => $questionamentosPendentes,
				'questionamentos_assembleia_finalizados' => $questionamentosFinalizadosOuAssembleia
			));
		}

	}

	public function buscarNotificacoes()
	{

		$filtros = \Request::input();
		$offset = (isset($filtros['offset'])) ? $filtros['offset'] : 0;

		$query = Notificacao::select(array('notificacao.*'))->orderBy('notificacao.status', 'ASC')->orderBy('notificacao.data_criacao', 'DESC')->groupBy('notificacao.id');

		if(isset($filtros['limit'])){
			$query->limit($filtros['limit']);
		}

		if(isset($filtros['id_notificacao'])){
			$query->where('notificacao.id', $filtros['id_notificacao']);
		}

		if(isset($filtros['status'])){
			$query->where('notificacao.status', $filtros['status']);
		}

		if(isset($filtros['id_user_destinatario'])){
			$query->where('notificacao.id_user_destinatario', $filtros['id_user_destinatario']);
		}

		if(isset($filtros['id_user_remetente'])){
			$query->where('notificacao.id_user_remetente', $filtros['id_user_remetente']);
		}

		$listaNotificacoes = $query->get();

		foreach ($listaNotificacoes as $key => $notificacao) {
			$user = User::find($notificacao->id_user_remetente);
			$listaNotificacoes[$key]->first_name = $user->first_name;
			$listaNotificacoes[$key]->last_name = $user->last_name;
			$listaNotificacoes[$key]->thumbnail = $user->thumbnail_principal;

		}


		return $listaNotificacoes;

	}

	public function buscarTorres()
	{

		$filtros = \Request::input();
		$query = CondominioTorre::select(array('condominio_torre.*'))->orderBy('condominio_torre.nome', 'ASC');

		$query->join('condominio', 'condominio_torre.id_condominio', '=', 'condominio.id');

		if(isset($filtros['id_condominio'])){
			$query->where('condominio.id', $filtros['id_condominio']);
		}

		$listaTorres = $query->get();


		foreach ($listaTorres as $key => $torre) {
			$torre->unidades;
			$torre->condominio;
		}

		$status = true;
		$message = 'Segue listagem  de torres';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $listaTorres
		));


		//return $listaTorres;
	}

	public function buscarEspacosComuns()
	{

		$filtros = \Request::input();
		$query = EspacoComum::select(array('espaco_comum.*'))->orderBy('espaco_comum.nome', 'ASC');

		$query->join('condominio_torre', 'espaco_comum.id_condominio_torre', '=', 'condominio_torre.id');
		$query->join('condominio', 'condominio_torre.id_condominio', '=', 'condominio.id');

		if(isset($filtros['id_condominio'])){
			$query->where('condominio.id', $filtros['id_condominio']);
		}

		$listaEspacos = $query->get();

		foreach ($listaEspacos as $key => $espaco) {
			$espaco->items;
		}

		return $listaEspacos;
	}

	public function buscarEspacoComum(Request $request)
	{
		$post = $request->input();

		$espacoComum = EspacoComum::find($post['id_espaco_comum']);

		if($espacoComum){
			$espacoComum->items;
			$espacoComum->horarios;
			$espacoComum->reservas;
			$espacoComum->tipo;
			$espacoComum->torre;
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não existe um espaço comum com esse ID'
			));
		}

		return $espacoComum;
	}

	public function buscarAssembleias()
	{

		$filtros = \Request::input();
		$offset = isset($filtros['offset']) ? $filtros['offset'] : 0;
		$limit = isset($filtros['limit']) ? $filtros['limit'] : 10;
		$countFinalizadas = 0;
		$query = Assembleia::select(array('assembleia.*'))->orderBy('assembleia.data_primeira_chamada', 'DESC');
		if(isset($filtros['id_assembleia'])){
			$query->where('assembleia.id', $filtros['id_assembleia']);
		}
		if(isset($filtros['id_condominio'])){
			$query->join('assembleia_condominio_torre', 'assembleia.id', '=', 'assembleia_condominio_torre.id_assembleia');
			$query->join('condominio_torre', 'assembleia_condominio_torre.id_condominio_torre', '=', 'condominio_torre.id');
			$query->where('condominio_torre.id_condominio', $filtros['id_condominio']);
		}

		$listaAssembleias = $query->get();
		$assembleiasFinalizadas = [];
		$assembleiasAbertas = [];
		foreach ($listaAssembleias as $key => $assembleia) {
			foreach ($assembleia->torres as $assembleiaTorre) {
				$assembleiaTorre->torre;
			}
			foreach ($assembleia->questionamentos as $assembleiaQuestionamento) {
				$assembleiaQuestionamento->questionamento;
			}
			if($assembleia->status){
				$assembleiasAbertas[] = $assembleia;
			}else{
				if($countFinalizadas >= $offset && $countFinalizadas < $limit){
					$assembleiasFinalizadas[] = $assembleia;
					$countFinalizadas++;
				}
			}
		}

		if(isset($filtros['id_assembleia'])){
			return $listaAssembleias;
		}else{
			return json_encode(array(
				'assembleias_finalizadas' => $assembleiasFinalizadas,
				'assembleias_abertas' => array_reverse($assembleiasAbertas)
			));
		}
	}

	public function buscar_posts()
	{

		$filtros = \Request::input();
		$query = Post::select('post.*');
		if(isset($filtros['id_post'])){
			$query->where('id', $filtros['id_post']);
		}
		$listaPosts = $query->get();

		foreach ($listaPosts as $key => $post) {
			$flagCurtido = false;
			foreach ($post->postLikes as $postLike) {
				$postLike->pessoaObject;
			}
			if($post->id_segmento){
				$listaPosts[$key]->segmento = Segmento::find($post->id_segmento);
			}
			if($post->id_empresa){
				$listaPosts[$key]->empresa = Empresa::find($post->id_empresa);
				if($listaPosts[$key]->empresa){
					$listaPosts[$key]->empresa->thumbnail_principal = url('/uploads/empresa/'.$listaPosts[$key]->empresa->thumbnail_principal);
				}
			}
			if($listaPosts[$key]->data){
				$listaPosts[$key]->data = date('d/m/Y', strtotime($post->data));
			}
			if($listaPosts[$key]->data_validade){
				$listaPosts[$key]->data_validade = date('d/m/Y', strtotime($post->data_validade));
			}
			if($listaPosts[$key]->thumbnail_principal){
				$listaPosts[$key]->thumbnail_principal = url('/uploads/post/'.$post->thumbnail_principal);
			}
			if(isset($filtros['id_pessoa'])){
				foreach ($post->postLikes as $postLike) {
					if($postLike->pessoaObject->id == $filtros['id_pessoa']){
						$flagCurtido = true;
					}
				}
			}
			$listaPosts[$key]->curtido = $flagCurtido;
		}

		return $listaPosts;
	}

	public function buscarEmpresas()
	{
		$filtros = \Request::input();
		$query = Empresa::select('empresa.*');

		if(isset($filtros['id_segmento'])){
			$arraySegmento = explode(',',$filtros['id_segmento']);
			$query->join('empresa_has_segmento', 'empresa.id', '=', 'empresa_has_segmento.id_empresa');
			//$query->where('empresa_has_segmento.id_segmento', $filtros['id_segmento']);
			$query->whereIn('empresa_has_segmento.id_segmento', $arraySegmento);
			$query->groupBy('empresa.id');
		}

		$listaEmpresas = $query->get();

		foreach ($listaEmpresas as $key => $empresa) {

			foreach ($empresa->segmentos as $segmento) {
				$segmento->objSegmento;
			}

			if($listaEmpresas[$key]->thumbnail_principal){
				$listaEmpresas[$key]->thumbnail_principal = url('/uploads/empresa/'.$empresa->thumbnail_principal);
			}

			if($listaEmpresas[$key]->thumbnail_logo){
				$listaEmpresas[$key]->thumbnail_logo = url('/uploads/empresa/'.$empresa->thumbnail_logo);
			}

		}

		return $listaEmpresas->toJson();
	}

	public function getPost()
	{

		$filtros = \Request::input();
		$flagDisponivel = false;
		$flagCurtido = false;

		$post = Post::with('cupons')->find($filtros['id_post']);

		$post->segmento;
		if($post->empresa){
			$post->empresa->thumbnail_principal = url('/uploads/empresa/'.$post->empresa->thumbnail_principal);
		}
		if($post->data){
			$post->data = date('d/m/Y', strtotime($post->data));
		}
		if($post->data_validade){
			$post->data_validade = date('d/m/Y', strtotime($post->data_validade));
		}
		if($post->thumbnail_principal){
			$post->thumbnail_principal = url('/uploads/post/'.$post->thumbnail_principal);
		}

		if(count($post->cuponsAbertosDisponiveis)){
			$flagDisponivel = true;
		}
		if(isset($filtros['id_pessoa'])){
			foreach ($post->cupons as $cupom) {
				if($cupom->cupomPessoa && $cupom->cupomPessoa->pessoaObject && $cupom->cupomPessoa->pessoaObject->id == $filtros['id_pessoa']){
					$flagDisponivel = false;
				}
			}
			foreach ($post->postLikes as $postLike) {
				if($postLike->pessoaObject->id == $filtros['id_pessoa']){
					$flagCurtido = true;
				}
			}
		}
		$post->cupomDisponivel = $flagDisponivel;
		$post->curtido = $flagCurtido;

		return $post->toJson();
	}

	public function buscarSegmentos()
	{
		$filtros = \Request::input();
		$query = Segmento::select('segmento.*');

		if(isset($filtros['id_segmento'])){
			$query->whereIn('segmento.id', $filtros['id_segmento']);
		}

		$listaSegmentos = $query->get();


		return $listaSegmentos;
	}

	public function inserirPostLike()
	{
		$filtros = \Request::input();
		$obj = new PostLike;

		if($obj->validate($filtros)){
			$obj->id_post = $filtros['id_post'];
			$obj->id_pessoa = $filtros['id_pessoa'];
			$obj->data = date('Y-m-d H:i:s');
			$obj->save();
			return json_encode(array("retorno" => true));
		}else{
			return json_encode(array("retorno" => false));
		}

	}

	public function removerPostLike()
	{
		$filtros = \Request::input();

		$obj = PostLike::where('id_post', $filtros['id_post'])
		->where('id_pessoa', $filtros['id_pessoa'])
		->delete();

		return json_encode(array("retorno" => true));

	}

	public function inserirPessoa(){
		$info = \Request::input();
		$password = $info['password'];
		unset($info['password']);
		unset($info['confirmPassword']);
		$pessoa = Pessoa::find(DB::table('pessoa')->insertGetId($info));
		$user = Sentinel::register(array(
			'first_name' => $info['nome'],
			'email'    => $info['email'],
			'password' => $password,
		));
		$pessoa->id_user = $user->id;
		$pessoa->save();
		$role = Sentinel::findRoleById(1);
		$role->users()->attach($user);
		$activation = Activation::create($user);
		Activation::complete($user, $activation->code);

		$pessoa->cidade;
		$pessoa->grupoPessoa;

		return $pessoa;
	}

	public function inserirPessoaSegmento(){
		$post = \Request::input();
		$pessoa = Pessoa::find($post['id_pessoa']);
		foreach ($pessoa->segmentos as $segmento) {
			$segmento->delete();
		}
		foreach ($post['segmentos'] as $id_segmento) {
			$pessoaSegmento = new PessoaSegmento();
			$pessoaSegmento->id_pessoa = $pessoa->id;
			$pessoaSegmento->id_segmento = $id_segmento;
			$pessoaSegmento->save();
		}

		return json_encode(array('sucess' => true));
	}



	public function buscarPostsFavoritos(){
		$parametros = \Request::input();
		$pessoa = Pessoa::find($parametros['id_pessoa']);
		$response = null;

		if($pessoa){
			$response = array();
			foreach ($pessoa->postLikes as $postLike) {
				$response[] = $postLike->postObject;
			}
			foreach ($response as $key => $post) {
				foreach ($post->postLikes as $postLike) {
					$postLike->pessoaObject;
				}
				if($post->id_segmento){
					$response[$key]->segmento = Segmento::find($post->id_segmento);
				}
				if($post->id_empresa){
					$response[$key]->empresa = Empresa::find($post->id_empresa);
					if($response[$key]->empresa){
						$response[$key]->empresa->thumbnail_principal = url('/uploads/empresa/'.$response[$key]->empresa->thumbnail_principal);
					}
				}
				if($response[$key]->data){
					$response[$key]->data = date('d/m/Y', strtotime($post->data));
				}
				if($response[$key]->data_validade){
					$response[$key]->data_validade = date('d/m/Y', strtotime($post->data_validade));
				}
				if($response[$key]->thumbnail_principal){
					$response[$key]->thumbnail_principal = url('/uploads/post/'.$post->thumbnail_principal);
				}
			}
			$message = 'Posts favoritos buscados com sucesso!';
			$status = true;
		}else{
			$message = 'Não existe uma pessoa com esse ID';
			$status = false;
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarPessoa(){
		$parametros = \Request::input();
		$pessoa = Pessoa::find($parametros['id_pessoa']);
		$response = null;

		if($pessoa){
			foreach ($pessoa->segmentos as $pessoaSegmento) {
				$pessoaSegmento->segmentoObject;
			}
			$pessoa->grupoPessoa;
			$pessoa->cidade;
			$pessoa->empresa;
			$response = $pessoa;
			$message = 'Pessoa buscada com sucesso!';
			$status = true;
		}else{
			$message = 'Não existe uma pessoa com esse ID';
			$status = false;
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function cancelarCupom(){
		$params = \Request::input();
		$cupom = Cupom::find($params['id_cupom']);
		$response = null;
		if($cupom){
			if($cupom->cupomPessoa){
				$cupom->cupomPessoa->delete();
				$cupom->status = 'A';
				$cupom->save();
				$message = 'Cupom cancelado com sucesso!';
				$status = true;
			}else{
				$message = 'Não existe uma pessoa vinculada a esse cupom.';
				$status = false;
			}
		}else{
			$message = 'Não existe um cupom com esse ID';
			$status = false;
		}
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarEnderecosEmpresa(){
		$params = \Request::input();
		$empresa = Empresa::find($params['id_empresa']);
		$response = null;
		if($empresa){
			$response = [
				'latitude' => $empresa->latitude,
				'longitude' => $empresa->longitude,
				'filiais' => []
			];
			foreach ($empresa->filiais as $filial) {
				$response['filiais'][] = [
					'latitude' => $filial->latitude,
					'longitude' => $filial->longitude
				];
			}
			$status = true;
			$message = 'Endereços buscados com sucesso.';
		}else{
			$message = 'Não existe uma empresa com esse ID';
			$status = false;
		}
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarMapa(){
		$params = \Request::input();
		$latitude = $params['latitude'];
		$longitude = $params['longitude'];
		$distancia = isset($params['distancia']) ? $params['distancia'] : 50;
		$response = null;

		$empresas = DB::table('empresa')->select('empresa.nome_fantasia', 'empresa.latitude', 'empresa.longitude', DB::raw('111.045 * DEGREES(ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(empresa.latitude)) * COS(RADIANS(empresa.longitude) - RADIANS('.$longitude.')) + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(empresa.latitude)))) AS distance_in_km'))->havingRaw('distance_in_km <= '.$distancia)->get();

		$filiais = DB::table('empresa')->select('empresa.nome_fantasia','empresa_filial_endereco.latitude', 'empresa_filial_endereco.longitude', DB::raw('111.045 * DEGREES(ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(empresa_filial_endereco.latitude)) * COS(RADIANS(empresa_filial_endereco.longitude) - RADIANS('.$longitude.')) + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(empresa_filial_endereco.latitude)))) AS distance_filial_in_km') )->join('empresa_filial_endereco','empresa.id', '=', 'empresa_filial_endereco.id_empresa')->havingRaw('distance_filial_in_km <= '.$distancia)->get();

		$response = array_merge($empresas, $filiais);

		$status = true;
		$message = 'Empresas buscadas com sucesso.';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function alterarPessoa(){
		$input = \Request::input();

		$nome = (isset($input['nome']) && $input['nome']) ? $input['nome'] : null;
		$telefone = (isset($input['telefone']) && $input['telefone']) ? $input['telefone'] : null;
		$celular = (isset($input['celular']) && $input['celular']) ? $input['celular'] : null;
		$email = (isset($input['email']) && $input['email']) ? $input['email'] : null;
		$data_nascimento = (isset($input['data_nascimento']) && $input['data_nascimento']) ? $input['data_nascimento'] : null;
		$id_cidade = (isset($input['id_cidade']) && $input['id_cidade']) ? $input['id_cidade'] : null;
		$sexo = (isset($input['sexo']) && $input['sexo']) ? $input['sexo'] : null;
		$password = (isset($input['password']) && $input['password']) ? $input['password'] : null;

		$pessoa = Pessoa::find($input['id_pessoa']);
		if($pessoa){
			$user = User::find($pessoa->id_user);
			$pessoa->nome = $nome;
			$pessoa->telefone = $telefone;
			$pessoa->celular = $celular;
			$pessoa->data_nascimento = $data_nascimento;
			$pessoa->id_cidade = $id_cidade;
			$pessoa->sexo = $sexo;
			if($email){
				if(User::where('email', $email)->count() && $email != $user->email){
					return json_encode(array(
						'status' => false,
						'message' => 'Esse e-mail já está em uso'
					));
				}else{
					$pessoa->email = $email;
				}

				$user->email = $email;
			}
			if($password){
				$user->password = bcrypt($password);
			}
			$pessoa->save();
			$user->save();

			return json_encode(array(
				'status' => true,
				'message' => 'Dados alterados com sucesso!'
			));
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não existe uma pessoa com esse ID.'
			));
		}
	}

	public function alterarStatusCupom(Request $request){
		$post = $request->input();
		$cupom = Cupom::find($post['id_cupom']);
		if($post['status'] == 'F' || $post['status'] == 'U' && $cupom->data_validade >= date('Y-m-d')){ // Verifica se está tentando utilizar um cupom vencido
			if($post['status'] == 'F' || $post['status'] == 'U' && $cupom->cupomPessoa){ // Verifica se esta tentando utilizar um cupom sem pessoa
				$cupom->status = $post['status'];
				$cupom->save();
				$status = true;
				$message = 'Status alterado com sucesso.';
			}else{
				$status = false;
				$message = 'Não foi possível alterar o status. Verifique se esse cupom possui uma pessoa ligada a ele.';
			}
		}else{
			$status = false;
			$message = 'Não foi possível alterar o status. Verifique a data de validade do cupom.';
		}


		return json_encode(array(
			'status' => $status,
			'message' => $message
		));
	}

	public function criarUsuarioAuxiliar(){
		$post = \Request::input();
		if(!isset($post['password']) || !$post['password']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo senha é obrigatório'
			));
		}
		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório'
			));
		}
		if(!isset($post['email']) || !$post['email']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo e-mail é obrigatório'
			));
		}
		if(User::where('email', $post['email'])->count()){
			return json_encode(array(
				'status' => false,
				'message' => 'Já existe um usuário com esse e-mail.'
			));
		}

		$condominoCriador = Condominos::select('condomino.*')->join('sis_users','condomino.id', '=', 'sis_users.id_condomino')->where('sis_users.id', $post['id_criador'])->first();

		$condomino = new Condominos();
		$condomino->nome_completo = $post['nome'];
		$condomino->email = $post['email'];
		$condomino->id_condominio_unidade = $condominoCriador->id_condominio_unidade;
		$condomino->save();

		$user = new User();
		$user->password = bcrypt($post['password']);
		$user->email = $post['email'];
		$user->first_name = $post['nome'];
		$user->id_condomino = $condomino->id;
		$user->id_criador = $post['id_criador'];
		$user->save();

		$userSentinel = Sentinel::findUserById($user->id);

		$activation = Activation::create($userSentinel);
		Activation::complete($userSentinel, $activation->code);

		$role = Sentinel::findRoleById(4);
		$role->users()->attach($userSentinel);

		if(isset($post['permissions'])){
			$permissions = [];
			foreach ($post['permissions'] as $module_name => $status) {
				$permissions[$module_name.'.view'] = $status;
				$permissions[$module_name.'.create'] = $status;
			}
			$userSentinel->permissions = $permissions;
			$userSentinel->save();
		}

		return json_encode(array(
			'status' => true,
			'message' => 'Usuário criado com sucesso!'
		));
	}

	public function editarUsuarioAuxiliar(){
		$post = \Request::input();
		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório'
			));
		}
		if(!isset($post['email']) || !$post['email']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo e-mail é obrigatório'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Usuário é obrigatório'
			));
		}
		$userEmail = User::where('email', $post['email'])->first();
		if($userEmail->id != $post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'Já existe um usuário com esse e-mail.'
			));
		}
		$user = User::find($post['id_user']);
		if(!$user){
			return json_encode(array(
				'status' => false,
				'message' => 'Não existe um usuário com esse ID.'
			));
		}

		if(isset($post['password']) && $post['password']){
			if(strlen($post['password']) >= 6){
				$user->password = bcrypt($post['password']);
			}else{
				return json_encode(array(
					'status' => false,
					'message' => 'A senha deve conter no mínimo 6 caracteres.'
				));
			}
		}

		$user->email = $post['email'];
		$user->first_name = $post['nome'];
		$user->save();

		$condomino = $user->condomino;
		$condomino->nome_completo = $post['nome'];
		$condomino->email = $post['email'];
		$condomino->save();

		$userSentinel = Sentinel::findUserById($user->id);

		if(isset($post['permissions'])){
			$permissions = [];
			foreach ($post['permissions'] as $module_name => $status) {
				$permissions[$module_name.'.view'] = $status;
				$permissions[$module_name.'.create'] = $status;
			}
			$userSentinel->permissions = $permissions;
			$userSentinel->save();
		}

		return json_encode(array(
			'status' => true,
			'message' => 'Usuário editado com sucesso!'
		));
	}

	public function salvarEnquete(){
		$post = \Request::input();

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório'
			));
		}
		if(!isset($post['data_limite']) || !$post['data_limite']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo data limite é obrigatório'
			));
		}
		if(!isset($post['id_condominio']) || !$post['id_condominio']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_condominio é obrigatório'
			));
		}

		if(!isset($post['alternativas']) || !count($post['alternativas'])){
			return json_encode(array(
				'status' => false,
				'message' => 'Você precisa cadastrar alternativas para a enquete.'
			));
		}

		$enquete = new Enquete();
		$enquete->nome = $post['nome'];
		$enquete->descricao = (isset($post['descricao'])) ? $post['descricao'] : '';
		$enquete->data_criacao = date('Y-m-d H:i:s');
		$enquete->data_finalizacao = $post['data_limite'];
		$enquete->id_condominio = $post['id_condominio'];
		$enquete->save();


		foreach ($post['alternativas'] as $alternativa) {
			$alternativaModel = new EnqueteAlternativa();
			$alternativaModel->id_enquete = $enquete->id;
			$alternativaModel->descricao = $alternativa;
			$alternativaModel->save();
		}


		return json_encode(array(
			'status' => true,
			'message' => 'Enquete criada com sucesso!'
		));
	}

	public function buscarEnquetes(){
		$post = \Request::input();
		$limit = isset($post['limit']) ? $post['limit'] : 10;
		$offset = isset($post['offset']) ? $post['offset'] : 0;
		$countFinalizadas = 0;
		$response = null;
		if(isset($post['id_condominio']) && $post['id_condominio']){
			$enquetesAbertas = [];
			$enquetesFinalizadas = [];
			$enquetes = Enquete::where('id_condominio', $post['id_condominio'])->orderBy('data_criacao', 'DESC')->get();

			foreach ($enquetes as $enquete) {
				$totalVotos = EnqueteAlternativaUsers::join('enquete_alternativa', 'enquete_alternativa_users.id_enquete_alternativa', '=', 'enquete_alternativa.id')->where('enquete_alternativa.id_enquete', $enquete->id)->count();
				foreach ($enquete->alternativas as $alternativa) {
					$alternativa->nr_votos = count($alternativa->votos);
					if($totalVotos)
					$alternativa->porcentagem = ($alternativa->nr_votos / $totalVotos) * 100;
					else {
						$alternativa->porcentagem = 0;
					}
				}
				if($enquete->data_finalizacao < date('Y-m-d H:i:s')){
					$enquete->finalizada = true;
					if($countFinalizadas < $limit && $countFinalizadas >= $offset){
						$enquetesFinalizadas[] = $enquete;
						$countFinalizadas++;
					}
				}else{
					$enquete->finalizada = false;
					$enquetesAbertas[] = $enquete;
				}
				$enquete->ja_votou = false;
				if(isset($post['id_user'])){
					$votoUsuario = EnqueteAlternativaUsers::join('enquete_alternativa', 'enquete_alternativa_users.id_enquete_alternativa', '=', 'enquete_alternativa.id')->where('id_user_principal', $post['id_user'])->where('enquete_alternativa.id_enquete', $enquete->id)->count();
					if($votoUsuario){
						$enquete->ja_votou = true;
					}
				}

			}
			$status = true;
			$message = 'Enquetes buscadas com sucesso!';
			$response = array(
				'enquetes_abertas' => $enquetesAbertas,
				'enquetes_finalizadas' => $enquetesFinalizadas
			);
		}else{
			$status = false;
			$message = 'ID do condomínio é obrigatório.';
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarEnquete(){
		$post = \Request::input();
		$response = null;
		if(isset($post['id_enquete']) && $post['id_enquete']){
			$enquete = Enquete::find($post['id_enquete']);
			if($enquete){
				$totalVotos = EnqueteAlternativaUsers::join('enquete_alternativa', 'enquete_alternativa_users.id_enquete_alternativa', '=', 'enquete_alternativa.id')->where('enquete_alternativa.id_enquete', $enquete->id)->count();
				foreach ($enquete->alternativas as $alternativa) {
					$alternativa->nr_votos = count($alternativa->votos);
					if($totalVotos)
					$alternativa->porcentagem = ($alternativa->nr_votos / $totalVotos) * 100;
					else {
						$alternativa->porcentagem = 0;
					}

				}
				if($enquete->data_finalizacao < date('Y-m-d H:i:s')){
					$enquete->finalizada = true;
				}else{
					$enquete->finalizada = false;
				}

				$enquete->ja_votou = false;
				if(isset($post['id_user'])){
					$votoUsuario = EnqueteAlternativaUsers::join('enquete_alternativa', 'enquete_alternativa_users.id_enquete_alternativa', '=', 'enquete_alternativa.id')->where('id_user_principal', $post['id_user'])->where('enquete_alternativa.id_enquete', $enquete->id)->count();
					if($votoUsuario){
						$enquete->ja_votou = true;
					}
				}
				$status = true;
				$message = 'Enquete buscada com sucesso!';
				$response = $enquete;
			}else{
				$status = false;
				$message = 'Enquete com esse ID não foi encontrada.';
			}
		}else{
			$status = false;
			$message = 'ID da enquete é obrigatório.';
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function votarEnquete(){
		$post = \Request::input();
		$response = null;
		$enqueteAlternativaUsers = new EnqueteAlternativaUsers();
		$enqueteAlternativaUsers->id_user_principal = $post['id_user'];
		$enqueteAlternativaUsers->id_enquete_alternativa = $post['id_alternativa'];
		$enqueteAlternativaUsers->data = date('Y-m-d H:i:s');
		$enqueteAlternativaUsers->save();
		$status = true;
		$message = 'Voto salvo com sucesso!';
		$response = $enqueteAlternativaUsers;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function criarQuestionamento(){
		$post = \Request::input();
		$response = null;
		if(!isset($post['mensagem']) || !$post['mensagem']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo mensagem é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo usuário é obrigatório.'
			));
		}
		if(!isset($post['id_assunto']) || !$post['id_assunto']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo assunto é obrigatório.'
			));
		}
		if(!isset($post['id_condominio']) || !$post['id_condominio']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo condomínio é obrigatório.'
			));
		}
		if(!isset($post['tipo']) || !$post['tipo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo é obrigatório.'
			));
		}

		$questionamento = new Questionamento();
		$questionamento->descricao = $post['mensagem'];
		$questionamento->id_user_remetente = $post['id_user'];
		$questionamento->id_questionamento_assunto = $post['id_assunto'];
		$questionamento->tipo = $post['tipo'];
		$questionamento->status = 'P';
		$idSindico = CondominioService::buscarSindicoCondominio($post['id_condominio']);
		$questionamento->id_user_destinatario = $idSindico;
		$questionamento->data_criacao = date('Y-m-d H:i:s');
		if(isset($post['data_finalizacao']) && $post['data_finalizacao']){
			$questionamento->data_finalizacao = $post['data_finalizacao'];
		}
		if(isset($post['imagem']) && $post['imagem']){
			$questionamento->thumbnail_principal = $post['imagem'];
			$questionamento->thumbnail_app = 'thumb_'.$post['imagem'];
		}
		$questionamento->save();
		$status = true;
		$message = 'Questionamento criado com sucesso!';
		$response = $questionamento;

		//CondominioService::notificarUsuario($post['id_user'], 'V', 'Você tem um novo questionamento.', $questionamento->descricao, $idSindico, 'questionamento', $questionamento->id);
		$userSindico = User::find($idSindico);
		$onesignal = [
			0 => $userSindico->udid
		];
		CondominioService::sendMessage($onesignal, $questionamento->descricao, 'Você tem um novo questionamento.', 'questionamento', $questionamento->id);

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function responderQuestionamento(){
		$post = \Request::input();
		$response = null;
		if(!isset($post['descricao']) || !$post['descricao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo descricao é obrigatório.'
			));
		}
		if(!isset($post['id_user_sindico']) || !$post['id_user_sindico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user_sindico é obrigatório.'
			));
		}
		if(!isset($post['id_questionamento']) || !$post['id_questionamento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_questionamento é obrigatório.'
			));
		}

		$questionamento = Questionamento::find($post['id_questionamento']);
		if($questionamento){

			if(isset($post['status']) && $post['status']){
				$questionamento->status = $post['status'];
				$questionamento->save();
			}

			$questionamentoResposta = new QuestionamentoResposta();
			$questionamentoResposta->descricao = $post['descricao'];
			$questionamentoResposta->id_user_sindico = $post['id_user_sindico'];
			$questionamentoResposta->id_questionamento = $post['id_questionamento'];
			$questionamentoResposta->data = date('Y-m-d H:i:s');
			$questionamentoResposta->save();
			$status = true;
			$message = 'Questionamento respondido com sucesso!';
			$response = $questionamentoResposta;

			CondominioService::notificarUsuario($post['id_user_sindico'], 'S', 'O síndico respondeu seu questionamento.', $questionamento->descricao, $questionamento->id_user_remetente, 'questionamentoResposta', $questionamento->id);

			return json_encode(array(
				'status' => $status,
				'message' => $message,
				'response' => $response
			));
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um questionamento com esse ID.'
			));
		}
	}

	public function responderRecado(){
		$post = \Request::input();
		$response = null;
		if(!isset($post['descricao']) || !$post['descricao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo descricao é obrigatório.'
			));
		}
		if(!isset($post['id_user_remetente']) || !$post['id_user_remetente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user_remetente é obrigatório.'
			));
		}
		if(!isset($post['id_recado']) || !$post['id_recado']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_recado é obrigatório.'
			));
		}

		$recado = Recado::find($post['id_recado']);
		if($recado){


			$recadoResposta = new RecadoResposta();
			$recadoResposta->descricao = $post['descricao'];
			$recadoResposta->id_user_remetente = $post['id_user_remetente'];
			$recadoResposta->id_recado = $post['id_recado'];
			$recadoResposta->data = date('Y-m-d H:i:s');
			if(isset($post['atendido']) && $post['atendido']){
				$recado->id_user_atendido = $post['id_user_remetente'];
				$recado->save();
				$recadoResposta->atendido = 1;
			}
			$recadoResposta->save();

			$status = true;
			$message = 'Recado respondido com sucesso!';
			$response = $recadoResposta;

			$user = User::find($post['id_user_remetente']);
			$title = $user->first_name.' '.$user->last_name.' respondeu seu recado.';

			/* Se o usuário responder o próprio recado, notifica todos que responderam o recado */
			if($post['id_user_remetente'] == $recado->id_user_remetente){
				$respostas = RecadoResposta::where('id_recado', $recado->id)->where('id_user_remetente', '!=', $recado->id_user_remetente)->groupBy('id_user_remetente')->get();
				foreach ($respostas as $resposta) {
					CondominioService::notificarUsuario($post['id_user_remetente'], 'V', 'Há novas respostas no recado que você respondeu.', $recado->descricao, $resposta->id_user_remetente, 'recadoResposta', $recado->id);
				}
			}else{ // Senão responde apenas o criador do recado.
				CondominioService::notificarUsuario($post['id_user_remetente'], 'V', $title, $recado->descricao, $recado->id_user_remetente, 'recadoResposta', $recado->id);
			}

			return json_encode(array(
				'status' => $status,
				'message' => $message,
				'response' => $response
			));
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um recado com esse ID.'
			));
		}
	}

	public function editarQuestionamento(){
		$post = \Request::input();
		$response = null;
		if(!isset($post['id_questionamento']) || !$post['id_questionamento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Questionamento é obrigatório.'
			));
		}
		if(!isset($post['mensagem']) || !$post['mensagem']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo mensagem é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo usuário é obrigatório.'
			));
		}
		if(!isset($post['id_assunto']) || !$post['id_assunto']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo assunto é obrigatório.'
			));
		}
		if(!isset($post['tipo']) || !$post['tipo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo é obrigatório.'
			));
		}

		if(!isset($post['status']) || !$post['status']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo status é obrigatório.'
			));
		}

		$questionamento = Questionamento::find($post['id_questionamento']);
		if($questionamento){
			$questionamento->descricao = $post['mensagem'];
			$questionamento->id_user_remetente = $post['id_user'];
			$questionamento->id_questionamento_assunto = $post['id_assunto'];
			$questionamento->tipo = $post['tipo'];
			$questionamento->status = $post['status'];
			$questionamento->data_finalizacao = $post['data_finalizacao'];
			if(isset($post['imagem']) && $post['imagem']){
				$questionamento->thumbnail_principal = $post['imagem'];
				$questionamento->thumbnail_app = 'thumb_'.$post['imagem'];
			}
			if(isset($post['data_finalizacao']) && $post['data_finalizacao']){
				$questionamento->data_finalizacao = $post['data_finalizacao'];
			}
			$questionamento->save();
			$status = true;
			$message = 'Questionamento editado com sucesso!';
			$response = $questionamento;
		}else{
			$status = false;
			$message = 'Não foi encontrado nenhum questionamento com esse ID.';
		}


		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarAssuntosQuestionamentos(){
		$response = QuestionamentoAssunto::get();
		$status = true;
		$message = 'Registros buscados com sucesso!';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarTiposEspacoComum(){
		$params = \Request::input();
		$query = EspacoComumTipo::select('espaco_comum_tipo.*');
		if(isset($params['id_espaco_comum_tipo'])){
			$query->where('id', $params['id_espaco_comum_tipo']);
		}
		$response = $query->get();
		$status = true;
		$message = 'Registros buscados com sucesso!';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarModelosEspacoComum(){
		$params = \Request::input();
		$query = EspacoComumModelo::select('espaco_comum_modelo.*');
		if(isset($params['id_espaco_comum_modelo'])){
			$query->where('id', $params['id_espaco_comum_modelo']);
		}
		if(isset($params['id_espaco_comum_tipo'])){
			$query->where('id_espaco_comum_tipo', $params['id_espaco_comum_tipo']);
		}
		$response = $query->get();
		foreach ($response as $espacoComumModelo) {
			$espacoComumModelo->items;
			$espacoComumModelo->horarios;
		}
		$status = true;
		$message = 'Registros buscados com sucesso!';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarTiposAnimal(){
		$response = TipoAnimal::get();
		$status = true;
		$message = 'Registros buscados com sucesso!';
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response->toArray()
		));
	}

	public function criarAnimal(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['raca']) || !$post['raca']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo raça é obrigatório.'
			));
		}
		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo usuário é obrigatório.'
			));
		}
		if(!isset($post['id_tipo_animal']) || !$post['id_tipo_animal']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo espécie é obrigatório.'
			));
		}

		$animal = new Animal();
		$animal->raca = $post['raca'];
		$animal->nome = $post['nome'];
		$animal->id_condominio_unidade = \App\Services\CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
		$animal->id_tipo_animal = $post['id_tipo_animal'];
		$animal->save();
		$status = true;
		$message = 'Animal salvo com sucesso!';
		$response = $animal;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function editarAnimal(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_animal']) || !$post['id_animal']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID do animal é obrigatório.'
			));
		}
		if(!isset($post['raca']) || !$post['raca']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo raça é obrigatório.'
			));
		}
		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo usuário é obrigatório.'
			));
		}
		if(!isset($post['id_tipo_animal']) || !$post['id_tipo_animal']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo espécie é obrigatório.'
			));
		}

		$animal = Animal::find($post['id_animal']);
		$animal->raca = $post['raca'];
		$animal->nome = $post['nome'];
		$animal->id_condominio_unidade = \App\Services\CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
		$animal->id_tipo_animal = $post['id_tipo_animal'];
		$animal->save();
		$status = true;
		$message = 'Animal editado com sucesso!';
		$response = $animal;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function criarVeiculo(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['placa']) || !$post['placa']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo placa é obrigatório.'
			));
		}
		if(!isset($post['modelo']) || !$post['modelo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo modelo é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}
		if(!isset($post['cor']) || !$post['cor']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo cor é obrigatório.'
			));
		}

		$veiculo = new Veiculo();
		$veiculo->placa = $post['placa'];
		$veiculo->cor = $post['cor'];
		$veiculo->id_condominio_unidade = \App\Services\CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
		$veiculo->modelo = $post['modelo'];
		$veiculo->save();
		$status = true;
		$message = 'Veículo salvo com sucesso!';
		$response = $veiculo;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function editarVeiculo(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_veiculo']) || !$post['id_veiculo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID do veículo é obrigatório.'
			));
		}
		if(!isset($post['placa']) || !$post['placa']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo placa é obrigatório.'
			));
		}
		if(!isset($post['modelo']) || !$post['modelo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo modelo é obrigatório.'
			));
		}
		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}
		if(!isset($post['cor']) || !$post['cor']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo cor é obrigatório.'
			));
		}

		$veiculo = Veiculo::find($post['id_veiculo']);
		$veiculo->placa = $post['placa'];
		$veiculo->cor = $post['cor'];
		$veiculo->id_condominio_unidade = \App\Services\CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
		$veiculo->modelo = $post['modelo'];
		$veiculo->save();
		$status = true;
		$message = 'Veículo editado com sucesso!';
		$response = $veiculo;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarVeiculos(){
		$post = \Request::input();
		$response = null;
		if(isset($post['id_veiculo'])){
			$veiculo = Veiculo::find($post['id_veiculo']);
			if($veiculo){
				$response = $veiculo;
				$status = true;
				$message = 'Registro buscado com sucesso!';
			}else{
				$status = false;
				$message = 'Não foi encontrado um veículo com esse ID.';
			}
		}else{
			if(isset($post['id_user']) && $post['id_user']){
				if(User::where('id', $post['id_user'])->count()){
					$id_condominio_unidade = CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
					$response = Veiculo::where('id_condominio_unidade', $id_condominio_unidade)->get();
					$status = true;
					$message = 'Registros buscados com sucesso!';
				}else{
					$status = false;
					$message = 'Não foi encontrado um usuário com esse ID.';
				}
			}else{
				$status = false;
				$message = 'O ID do usuário é obrigatório.';
			}

		}
		return response()->json(array('status' => $status, 'message' => $message, 'response' => $response));
	}


	public function buscarAnimais(){
		$post = \Request::input();
		$response = null;
		if(isset($post['id_animal'])){
			$animal = Animal::find($post['id_animal']);
			if($animal){
				$response = $animal;
				$status = true;
				$message = 'Registro buscado com sucesso!';
			}else{
				$status = false;
				$message = 'Não foi encontrado um veículo com esse ID.';
			}
		}else{
			if(isset($post['id_user']) && $post['id_user']){
				if(User::where('id', $post['id_user'])->count()){
					$id_condominio_unidade = CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
					$response = Animal::where('id_condominio_unidade', $id_condominio_unidade)->get();
					$status = true;
					$message = 'Registros buscados com sucesso!';
				}else{
					$status = false;
					$message = 'Não foi encontrado um usuário com esse ID.';
				}
			}else{
				$status = false;
				$message = 'O ID do usuário é obrigatório.';
			}
		}
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function deletarVeiculo(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_veiculo']) || !$post['id_veiculo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Veículo é obrigatório.'
			));
		}

		$veiculo = Veiculo::find($post['id_veiculo']);
		if($veiculo){
			$veiculo->delete();
			$status = true;
			$message = 'Veículo removido com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um veículo com esse ID.'
			));
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function deletarQuestionamento(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_questionamento']) || !$post['id_questionamento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Questionamento é obrigatório.'
			));
		}

		$questionamento = Questionamento::find($post['id_questionamento']);
		if($questionamento){
			@unlink('uploads/questionamento/'.$questionamento->thumbnail_principal);
			$questionamento->delete();
			$status = true;
			$message = 'Questionamento removido com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um questionamento com esse ID.'
			));
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function deletarAnimal(){
		$post = \Request::input();
		$response = null;
		if(!isset($post['id_animal']) || !$post['id_animal']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Animal é obrigatório.'
			));
		}
		$animal = Animal::find($post['id_animal']);
		if($animal){
			$animal->delete();
			$status = true;
			$message = 'Animal removido com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um animal com esse ID.'
			));
		}
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function deletarUsuario(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Usuário é obrigatório.'
			));
		}

		$user = User::find($post['id_user']);
		if($user){
			if($user->condomino){
				$user->condomino->delete();
			}
			$user->delete();
			$status = true;
			$message = 'Usuário removido com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um usuário com esse ID.'
			));
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarUsuariosAuxiliares(){
		$post = \Request::input();
		$response = null;

		if(isset($post['id_user'])){
			$user = User::find($post['id_user']);
			$user->condomino;
			$user->permissions = str_replace('.', '_',$user->permissions);
			$response = $user;
			$message = 'Usuário buscado com sucesso!';
			$status = true;
		}else{
			if(!isset($post['id_criador']) || !$post['id_criador']){
				return json_encode(array(
					'status' => false,
					'message' => 'O campo ID Criador é obrigatório.'
				));
			}
			$usuarios = User::where('sis_users.id_criador',$post['id_criador'])->get();
			foreach ($usuarios as $usuario) {
				$usuario->condomino;
				$usuario->permissions = str_replace('.', '_',$usuario->permissions);
			}
			$response = $usuarios;
			$status = true;
			$message = 'Usuários buscados com sucesso!';
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	public function criarAssembleia(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['titulo']) || !$post['titulo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo título é obrigatório.'
			));
		}
		if(!isset($post['data_primeira_chamada']) || !$post['data_primeira_chamada']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo data da primeira chamada é obrigatório.'
			));
		}
		if(!isset($post['data_segunda_chamada']) || !$post['data_segunda_chamada']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo data da segunda chamada é obrigatório.'
			));
		}
		if(!isset($post['local']) || !$post['local']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo local é obrigatório.'
			));
		}
		if(!isset($post['descricao']) || !$post['descricao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo descrição é obrigatório.'
			));
		}
		if(!isset($post['torres']) || !count($post['torres'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo torres é obrigatório.'
			));
		}
		if(!isset($post['questionamentos']) || !count($post['questionamentos'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo questionamentos é obrigatório.'
			));
		}

		$assembleia = new Assembleia();
		$assembleia->titulo = $post['titulo'];
		$assembleia->data_primeira_chamada = $post['data_primeira_chamada'];
		$assembleia->data_segunda_chamada = $post['data_segunda_chamada'];
		$assembleia->local = $post['local'];
		$assembleia->descricao = $post['descricao'];
		$assembleia->save();

		foreach ($post['torres'] as $id_torre) {
			$assembleiaTorre = new AssembleiaCondominioTorre();
			$assembleiaTorre->id_assembleia = $assembleia->id;
			$assembleiaTorre->id_condominio_torre = $id_torre;
			$assembleiaTorre->save();
		}

		foreach ($post['questionamentos'] as $id_questionamento) {
			$assembleiaQuestionamento = new AssembleiaQuestionamento();
			$assembleiaQuestionamento->id_assembleia = $assembleia->id;
			$assembleiaQuestionamento->id_questionamento = $id_questionamento;
			$assembleiaQuestionamento->save();
		}

		$status = true;
		$message = 'Assembléia criada com sucesso!';
		$response = $assembleia;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function criarModeloEspacoComum(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}
		if(!isset($post['id_espaco_comum_tipo']) || !$post['id_espaco_comum_tipo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo do espaço comum é obrigatório.'
			));
		}
		if(!isset($post['hora_inicio_utilizacao']) || !$post['hora_inicio_utilizacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo hora de inicio de utilização é obrigatório.'
			));
		}
		if(!isset($post['hora_fim_utilizacao']) || !$post['hora_fim_utilizacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo hora final de utilização é obrigatório.'
			));
		}
		if(!isset($post['tempo_utilizacao']) || !$post['tempo_utilizacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tempo de utilização é obrigatório.'
			));
		}
		if(!isset($post['items']) || !count($post['items'])){
			return json_encode(array(
				'status' => false,
				'message' => 'Os items são obrigatório.'
			));
		}


		$espacoComumModelo = new EspacoComumModelo();
		$espacoComumModelo->nome = $post['nome'];
		$espacoComumModelo->hora_inicio_utilizacao = $post['hora_inicio_utilizacao'];
		$espacoComumModelo->hora_fim_utilizacao = $post['hora_fim_utilizacao'];
		$espacoComumModelo->tempo_utilizacao = $post['tempo_utilizacao'];
		$espacoComumModelo->id_espaco_comum_tipo = $post['id_espaco_comum_tipo'];
		$espacoComumModelo->save();

		foreach ($post['items'] as $item) {
			$espacoComumItensModelo = new EspacoComumItensModelo();
			$espacoComumItensModelo->id_espaco_comum_modelo = $espacoComumModelo->id;
			$espacoComumItensModelo->chave = $item['chave'];
			$espacoComumItensModelo->valor = $item['valor'];
			$espacoComumItensModelo->save();
		}

		$status = true;
		$message = 'Modelo criado com sucesso!';
		$response = $espacoComumModelo;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function criarEspacoComum(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}
		if(!isset($post['id_espaco_comum_tipo']) || !$post['id_espaco_comum_tipo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo do espaço comum é obrigatório.'
			));
		}
		if(!isset($post['id_espaco_comum_modelo']) || !$post['id_espaco_comum_modelo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Modelo do espaço comum é obrigatório.'
			));
		}


		if(!isset($post['id_condominio_torre']) || !$post['id_condominio_torre']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo torre é obrigatório.'
			));
		}

		if(!isset($post['capacidade']) || !$post['capacidade']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo capacidade é obrigatório.'
			));
		}
		// sem valor é igual a 0
		if(!isset($post['valor_taxa_uso']) || !$post['valor_taxa_uso']){
			$post['valor_taxa_uso'] = 0;
		}
		if(!isset($post['reserva_aprovada'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo de preciso aprovar a reserva é obrigatório.'
			));
		}

		switch ($post['id_espaco_comum_tipo']) {
			// salao de festas
			case 1:
				$thumb = 'uploads/app/img3.png';
				break;
			// quadra de tenis
			case 4:
				$thumb = 'uploads/app/img1.png';
				break;

			default:
				$thumb = 'uploads/app/img3.png';
				break;
		}

		$modeloEspacoComum = EspacoComumModelo::where('espaco_comum_modelo.id',$post['id_espaco_comum_modelo'])->first();


		$espacoComum = new EspacoComum();
		$espacoComum->nome = $post['nome'];
		$espacoComum->thumbnail_principal = $thumb;
	//	$espacoComum->hora_inicio_utilizacao = $post['hora_inicio_utilizacao'];
	//	$espacoComum->hora_fim_utilizacao = $post['hora_fim_utilizacao'];
	//	$espacoComum->tempo_utilizacao = $post['tempo_utilizacao'];
		$espacoComum->id_espaco_comum_tipo = $post['id_espaco_comum_tipo'];
		$espacoComum->capacidade = $post['capacidade'];
		$espacoComum->valor_taxa_uso = $post['valor_taxa_uso'];
		$espacoComum->reserva_aprovada = $post['reserva_aprovada'];
		$espacoComum->id_condominio_torre = $post['id_condominio_torre'];
		$espacoComum->save();

		foreach ($modeloEspacoComum->horarios as $horario) {
			$espacoComumHorario = new EspacoComumHorario();
			$espacoComumHorario->id_espaco_comum = $espacoComum->id;
			$espacoComumHorario->dia = $horario->dia;
			$espacoComumHorario->hora_inicial = $horario->hora_inicial;
			$espacoComumHorario->hora_final = $horario->hora_final;
			$espacoComumHorario->save();
		}

		$status = true;
		$message = 'Espaço comum criado com sucesso!';
		$response = $espacoComum;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}



	public function deletarEspacoComum(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_espaco_comum']) || !$post['id_espaco_comum']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_espaco_comum obrigatório.'
			));
		}

		$espacoComum = EspacoComum::find($post['id_espaco_comum']);
		if($espacoComum){
			$espacoComum->delete();
			$status = true;
			$message = 'Espaço Comum removido com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um espaco comum com esse ID.'
			));
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	// criar uma nova reserva para um espaco comum
	public function criarReservaEspacoComum(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_espaco_comum']) || !$post['id_espaco_comum']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Id do espaço comum é obrigatório.'
			));
		}

		if(!isset($post['id_user_responsavel']) || !$post['id_user_responsavel']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user_responsavel é obrigatório.'
			));
		}

		if(!isset($post['id_espaco_comum_horario']) || !$post['id_espaco_comum_horario']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo horário é obrigatório.'
			));
		}

		if(!isset($post['data']) || !$post['data']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo data é obrigatório.'
			));
		}

		$espacoComum = EspacoComum::find($post['id_espaco_comum']);
		$userResponsavel = Sentinel::findUserById($post['id_user_responsavel']);
		if($espacoComum->reserva_aprovada && !$userResponsavel->inRole('sindico')){
			$status = 'P';
		}else{
			$status = 'A';
		}

		$idCondominioUnidade = CondominioService::buscarCondominioUnidadeAtual($post['id_user_responsavel']);

		$reserva = new Reserva();
		$reserva->id_espaco_comum = $post['id_espaco_comum'];
		$reserva->id_condominio_unidade = $idCondominioUnidade;
		$reserva->id_user_responsavel = $post['id_user_responsavel'];
		$reserva->id_espaco_comum_horario = $post['id_espaco_comum_horario'];
		$reserva->data = $post['data'];
		$reserva->status = $status;
		$reserva->save();

		$idCondominio = CondominioService::buscarCondominioAtual($post['id_user_responsavel']);
		$idSindico = CondominioService::buscarSindicoCondominio($idCondominio);
		if($espacoComum->reserva_aprovada){
			CondominioService::notificarUsuario($post['id_user_responsavel'], 'V', 'Há uma nova reserva a ser aprovada.', $espacoComum->nome, $idSindico, 'aprovarReserva', $reserva->id);
		}

		$status = true;
		$message = 'Reserva criada com sucesso!';
		$response = $reserva;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarHorariosDisponiveis(Request $request){
		$post = $request->input();
		$message = 'Horários buscados com sucesso!';
		$status = true;
		$response = [];
		if($post['data'] >= date('Y-m-d')){
			$espacoComum = EspacoComum::find($post['id_espaco_comum']);
			foreach ($espacoComum->horarios as $horario) {
				if($horario->dia == (date('w', strtotime($post['data'])) + 1) && ($post['data'] >= date('Y-m-d') || $post['data'] == date('Y-m-d') && $horario->hora_inicial >= date('H:i:s')) ){
					$reservado = Reserva::where('data', $post['data'])->where('id_espaco_comum_horario', $horario->id)->where('status', '!=', 'R')->count();
					if(!$reservado){
						$response[] = $horario;
					}
				}
			}
		}else{
			$status = false;
			$message = 'A data deve ser posterior à data atual.';
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	public function mudarConfiguracaoNotificacaoUsuario(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}

		if(!isset($post['tipo_notificacao']) || !$post['tipo_notificacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo_notificacao é obrigatório.'
			));
		}

		if(!isset($post['ativo'])){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ativo é obrigatório.'
			));
		}


		$query = ConfiguracaoNotificacao::select('configuracao_notificacao.*');
		$query->where('id_user', $post['id_user']);
		$query->where('chave', $post['tipo_notificacao']);
		$notificacoes = $query->first();


		$notificacoes->ativo = $post['ativo'];
		$notificacoes->save();

		$status = true;
		$message = 'Notificação alterada com sucesso!';
		$response = $notificacoes;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));

	}

	public function criarRecado(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_user_remetente']) || !$post['id_user_remetente']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user_remetente é obrigatório.'
			));
		}

		if(!isset($post['descricao']) || !$post['descricao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo descrição é obrigatório.'
			));
		}

		if(!isset($post['tipo']) || !$post['tipo']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo tipo é obrigatório.'
			));
		}

		if(!isset($post['id_condominio_torre']) || !$post['id_condominio_torre']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_condominio_torre é obrigatório.'
			));
		}

		$recado = new Recado();
		$recado->id_user_remetente = $post['id_user_remetente'];
		$recado->descricao = $post['descricao'];
		$recado->data = date('Y-m-d H:i:s');
		$recado->tipo = $post['tipo'];
		$recado->save();

		if($post['id_condominio_torre'] == 'todos'){

			//$idCondominio = CondominioService::buscarCondominioAtual($reserva->id_user_responsavel);
			$idCondominio = CondominioService::buscarCondominioAtual($post['id_user_remetente']);
			$users = DB::table('sis_users')
			->select('sis_users.*')
			->join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')
			->join('condomino', 'sis_users.id_condomino', '=', 'condomino.id')
			->join('condominio_unidade', 'condomino.id_condominio_unidade', '=', 'condominio_unidade.id')
			->join('condominio_torre', 'condominio_torre.id', '=', 'condominio_unidade.id_condominio_torre')
			->where('condominio_torre.id_condominio', $idCondominio)
			->get();

		}else{

			//$torre = CondominioTorre::find($post['id_condominio_torre']);
			$users = DB::table('sis_users')
			->select('sis_users.*')
			->join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')
			->join('condomino', 'sis_users.id_condomino', '=', 'condomino.id')
			->join('condominio_unidade', 'condomino.id_condominio_unidade', '=', 'condominio_unidade.id')
			->where('condominio_unidade.id_condominio_torre', $post['id_condominio_torre'])
			->where('sis_role_users.role_id', '!=', 6) // Não notificar o porteiro
			->get();

		}

		
		foreach ($users as $user) {
			$recadoDestinatario = new RecadoDestinatario();
			$recadoDestinatario->id_user_destinatario = $user->id;
			$recadoDestinatario->id_recado = $recado->id;
			$recadoDestinatario->save();
		}

		switch ($post['tipo']) {
			case 'A': $tipo = 'S'; $titulo = 'Aviso do Síndico'; break;
			case 'S': $tipo = 'V'; $titulo = 'Solicitação de Vizinho'; break;
			default:
				# code...
				break;
		}

		if($post['id_condominio_torre'] == 'todos'){
			$usuariosFiltrados = CondominioService::notificarCondominio($post['id_user_remetente'], $tipo, $titulo, $post['descricao'], $idCondominio, 'recado', $recado->id);
		}else{
			$usuariosFiltrados = CondominioService::notificarTorre($post['id_user_remetente'], $tipo, $titulo, $post['descricao'], $post['id_condominio_torre'], 'recado', $recado->id);
		}	

		
		$status = true;
		$message = 'Recado criado com sucesso!';
		$response = $recado;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response,
			'usuariosFiltrados' => $usuariosFiltrados
		));
	}

	public function visualizarQuestionamentos(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_questionamento']) || !$post['id_questionamento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_questionamento é obrigatório.'
			));
		}

		Questionamento::where('id', $post['id_questionamento'])->update(array('visualizado' => 1));

		$status = true;
		$message = 'Questionamento visualizado com sucesso!';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function visualizarNotificacoes(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_notificacao']) || !$post['id_notificacao']){
			Notificacao::where('id_user_destinatario', $post['id_user_destinatario'])->where('id_referencia', $post['id_referencia'])->update(array('status' => 1));
		}else{
			Notificacao::where('id', $post['id_notificacao'])->update(array('status' => 1));
		}



		$status = true;
		$message = 'Notificação visualizada com sucesso!';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarConfiguracoesNotificacao(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}

		$configuracoes  = ConfiguracaoNotificacao::where('id_user', $post['id_user'])->get();

		$response = $configuracoes;
		$status = true;
		$message = 'Configurações buscadas com sucesso!';

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarDiasMes(Request $request){
		$post = $request->input();
		$dias = cal_days_in_month(CAL_GREGORIAN, $post['mes'], $post['ano']);
		$return = [];
		for ($i=1; $i<=$dias ; $i++) {
			$countReservas = Reserva::join('condominio_unidade', 'reserva.id_condominio_unidade', '=', 'condominio_unidade.id')
			->join('condominio_torre', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')
			->where('data',$post['ano'].'-'.$post['mes'].'-'.$i)
			->where('condominio_torre.id_condominio',$post['id_condominio'])->count();
			if($countReservas){
				$temEvento = true;
			}else{
				$temEvento = false;
			}

			$diaSemana = date('w',strtotime($post['ano'].'-'.$post['mes'].'-'.$i)) +1;
			switch ($diaSemana) {
				case 1: $dia = 'Dom'; break;
				case 2: $dia = 'Seg'; break;
				case 3: $dia = 'Ter'; break;
				case 4: $dia = 'Qua'; break;
				case 5: $dia = 'Qui'; break;
				case 6: $dia = 'Sex'; break;
				case 7: $dia = 'Sáb'; break;
			}
			$return[] = array(
				'dia' => $i,
				'temEvento' => $temEvento,
				'diaSemana' => $dia
			);
		}
		return json_encode($return);

	}

	public function buscarEventosDia(Request $request){
		$post = $request->input();

		$reservas = Reserva::select('reserva.*')->join('condominio_unidade', 'reserva.id_condominio_unidade', '=', 'condominio_unidade.id')
		->join('condominio_torre', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')
		->where('data',$post['ano'].'-'.$post['mes'].'-'.$post['dia'])
		->where('condominio_torre.id_condominio',$post['id_condominio'])->where('reserva.status', 'A')->with('espacoComum', 'espacoComumHorario', 'userResponsavel')->get();

		return json_encode($reservas);

	}

	public function aprovarReserva(Request $request){
		$post = $request->input();

		$reserva = Reserva::find($post['id_reserva']);
		if($reserva){
			if($post['status'] == 'A'){
				$reserva->status = 'A';
				$mensagem = 'O síndico aprovou sua reserva.';
			}elseif($post['status'] == 'R'){
				$reserva->status = 'R';
				$mensagem = 'O síndico recusou sua reserva.';
			}
			$reserva->save();

			$idCondominio = CondominioService::buscarCondominioAtual($reserva->id_user_responsavel);
			$idSindico = CondominioService::buscarSindicoCondominio($idCondominio);
			CondominioService::notificarUsuario($idSindico, 'S', $mensagem, $reserva->espacoComum->nome, $reserva->id_user_responsavel, 'reserva', $reserva->id);
			$status = true;
			//$message = 'Reserva aprovada com sucesso!';
		}else{
			$status = false;
			$mensagem = 'Não existe uma reserva com esse ID.';
		}

		return json_encode(array(
			'status' => $status,
			'message' => $mensagem
		));

	}

	public function sincronizarFacebook(Request $request){
		$post = $request->input();

		$status = false;
		$message = 'Não foi possível sincronizar com os dados do Facebook.';

		$img = \Image::make($post['picture']);
		$id_condominio = CondominioService::buscarCondominioAtual($post['id_user']);
		$tmpFilePath = 'uploads/users/'.$id_condominio.'/';
		$fileName = 'user'.$post['id_user'].'.jpg';
		$img->save($tmpFilePath.$fileName);

		$user = User::find($post['id_user']);
		$user->first_name = $post['name'];
		$user->email = $post['email'];
		$user->thumbnail_principal = $fileName;
		$user->save();

		$status = true;
		$message = 'Facebook sincronizado com sucesso!';

		return json_encode(array(
			'status' => $status,
			'message' => $message
		));
	}

	public function criarPrestadorServico(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível criar o registro. Tente novamente mais tarde.";

		if(!isset($post['id_condominio_torre']) || !$post['id_condominio_torre']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Torre é obrigatório.'
			));
		}

		if(!isset($post['id_segmento_servico']) || !$post['id_segmento_servico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Segmento de Serviço é obrigatório.'
			));
		}

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}

		$prestadorServico = new PrestadorServico();
		$prestadorServico->nome = $post['nome'];
		$prestadorServico->id_condominio_torre = $post['id_condominio_torre'];
		$prestadorServico->id_segmento_servico = $post['id_segmento_servico'];
		$prestadorServico->telefone = (isset($post['telefone'])) ? $post['telefone'] : null;
		$prestadorServico->email = (isset($post['email'])) ? $post['email'] : null;
		$prestadorServico->site = (isset($post['site'])) ? $post['site'] : null;

		$prestadorServico->save();

		$status = true;
		$message = 'Prestador criado com sucesso!';
		$response = $prestadorServico;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function editarPrestadorServico(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível editar o registro. Tente novamente mais tarde.";

		if(!isset($post['id_prestador_servico']) || !$post['id_prestador_servico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID é obrigatório.'
			));
		}

		if(!isset($post['id_condominio_torre']) || !$post['id_condominio_torre']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Torre é obrigatório.'
			));
		}

		if(!isset($post['id_segmento_servico']) || !$post['id_segmento_servico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Segmento de Serviço é obrigatório.'
			));
		}

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo nome é obrigatório.'
			));
		}

		$prestadorServico = PrestadordeServico::find($post['id_prestador_servico']);
		$prestadorServico->nome = $post['nome'];
		$prestadorServico->id_condominio_torre = $post['id_condominio_torre'];
		$prestadorServico->id_segmento_servico = $post['id_segmento_servico'];
		$prestadorServico->telefone = (isset($post['telefone'])) ? $post['telefone'] : $prestadorServico->telefone;
		$prestadorServico->email = (isset($post['email'])) ? $post['email'] : $prestadorServico->email;
		$prestadorServico->site = (isset($post['site'])) ? $post['site'] : $prestadorServico->site;

		$prestadorServico->save();

		$status = true;
		$message = 'Prestador editado com sucesso!';
		$response = $prestadorServico;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function deletarPrestadorServico(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível deletar o registro. Tente novamente mais tarde.";

		if(!isset($post['id_prestador_servico']) || !$post['id_prestador_servico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID é obrigatório.'
			));
		}



		PrestadordeServico::where('id',$post['id_prestador_servico'])->delete();


		$status = true;
		$message = 'Prestador deletado com sucesso!';
		$response = $prestadorServico;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function buscarSegmentosServico(){
		$segmentos = SegmentoServico::get();

		return $segmentos;
	}

	public function buscarPrestadoresServico(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível buscar os registros. Tente novamente mais tarde.";

		if(!isset($post['id_condominio']) || !$post['id_condominio']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID Condomínio é obrigatório.'
			));
		}



		$query = PrestadordeServico::select('prestador_de_servico.*')->join('condominio_torre', 'prestador_de_servico.id_condominio_torre', '=', 'condominio_torre.id')
		->where('condominio_torre.id_condominio',$post['id_condominio']);

		if(isset($post['id_segmento_servico'])){
			$query->where('prestador_de_servico.id_segmento_servico', $post['id_segmento_servico'])->get();
		}

		$prestadores = $query->get();

		$status = true;
		$message = 'Prestadores buscados com sucesso!';
		$response = $prestadores;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function alterarFotoPerfil(Request $request){
		if($request->hasFile('file')) {
			//upload an image to the /img/tmp directory and return the filepath.
			$file = $request->file('file');
			$id_condominio = CondominioService::buscarCondominioAtual($request->input('id_user'));
			$tmpFilePath = 'uploads/users/'.$id_condominio.'/';
			$tmpFileName = time() . '-' . $file->getClientOriginalName();
			$file = $file->move(public_path() . '/'.$tmpFilePath, $tmpFileName);
			$path = '/'.$tmpFilePath . $tmpFileName;

			$img = \Image::make($tmpFilePath.$tmpFileName);
			$tmpThumbName = 'thumb_'.$tmpFileName;
			if($img->resize($img->width()/5, $img->height()/5)->save($tmpFilePath.$tmpThumbName)){
				$pathThumb = '/'.$tmpFilePath.$tmpThumbName;
				$user = User::find($request->input('id_user'));
				$user->thumbnail_principal = $tmpThumbName;
				$user->save();
				return response()->json(array('status'=> true, 'file_name'=>$tmpFileName, 'file_name_thumb' => $tmpThumbName), 200);
			}else{
				return response()->json(array('status'=>false,'message' => 'Não foi possível alterar o tamanho da imagem.'), 200);
			}
		} else {
			return response()->json(false, 200);
		}
	}

	public function buscarDadosUsuario(Request $request){
		$params = $request->input();
		$usuario = User::find($params['id_user']);
		$response = null;
		if($usuario){
			$status = true;
			$message = "Dados buscados com sucesso!";
			$response = $usuario;
		}else{
			$status = false;
			$message = "Não existe um usuário com esse ID";
		}
		return response()->json(array('status'=> $status, 'message'=>$message, 'response' => $response), 200);
	}

	public function criarCondominio(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível criar o condomínio. Tente novamente mais tarde.";

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Nome é obrigatório.'
			));
		}

		if(!isset($post['endereco']) || !$post['endereco']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Endereço é obrigatório.'
			));
		}

		if(!isset($post['id_cidade']) || !$post['id_cidade']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Cidade é obrigatório.'
			));
		}

		if(!isset($post['bairro']) || !$post['bairro']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Bairro é obrigatório.'
			));
		}

		if(!isset($post['numero_torres']) || !$post['numero_torres']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Número de Torres é obrigatório.'
			));
		}

		if(!isset($post['numero_andares']) || !$post['numero_andares']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Número de Andares é obrigatório.'
			));
		}

		if(!isset($post['numero_apartamentos_andar']) || !$post['numero_apartamentos_andar']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Número de Apartamentos por andar é obrigatório.'
			));
		}

		if(!isset($post['nome_sindico']) || !$post['nome_sindico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Nome do Síndico é obrigatório.'
			));
		}

		if(!isset($post['email_sindico']) || !$post['email_sindico']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo E-mail do Síndico é obrigatório.'
			));
		}

		if(!isset($post['cep']) || !$post['cep']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo CEP é obrigatório.'
			));
		}

		if(User::where('email', $post['email_sindico'])->count()){
			return json_encode(array(
				'status' => false,
				'message' => 'Seu síndico ja foi cadastrado. Favor entrar em contato com ele.'
			));
		}

		$condominio = new Condominio();
		$condominio->nome = $post['nome'];
		$condominio->bairro = $post['bairro'];
		$condominio->endereco = $post['endereco'];
		$condominio->numero = (isset($post['numero'])) ? $post['numero'] : null;
		$condominio->cep = $post['cep'];
		$condominio->id_cidade = $post['id_cidade'];
		$condominio->save();

		$arrayPasswords = [];
		for ($i=1; $i <= $post['numero_torres']; $i++) {
			$torre = new CondominioTorre();
			$torre->nome = 'Torre '+$i;
			$torre->id_condominio = $condominio->id;
			$torre->numero_andares = $post['numero_andares'];
			$torre->numero_apartamento_andar = $post['numero_apartamentos_andar'];
			$torre->save();
			for ($j=1; $j <= $post['numero_andares']; $j++) {
				for ($k=1; $k <= $post['numero_apartamentos_andar']; $k++) {
					$nr_apartamento = $j."0".$k;
					$unidade = new CondominioUnidade();
					$unidade->nome = "Unidade ".$nr_apartamento;
					$unidade->id_condominio_torre = $torre->id;
					$unidade->andar = $j;
					$unidade->save();

					$condomino = new Condominos();
					$condomino->nome_completo = "Ap.".$nr_apartamento;
					$condomino->email = "apartamento_{$nr_apartamento}_{$i}_{$condominio->id}@falavizinho.com.br";
					$condomino->id_condominio_unidade = $unidade->id;
					$condomino->save();

					$password = mt_rand(100000,999999);
					$credentials = [
					    'email'    => $condomino->email,
					    'password' => $password
					];
					$user = Sentinel::registerAndActivate($credentials);
					$role = Sentinel::findRoleBySlug('condomino');
					$role->users()->attach($user);

					$userModel = User::find($user->id);
					$userModel->id_condomino = $condomino->id;
					$userModel->first_name = "Ap.".$nr_apartamento;
					$userModel->last_name = $nr_apartamento;
					$userModel->save();

					$arrayPasswords[$userModel->id] = $password;

				}
			}
		}

		$condominio->load('torres.unidades.condominos.user');
		$data = array(
			'condominio' => $condominio,
			'arrayPasswords' => $arrayPasswords,
			'email_sindico' => $post['email_sindico'],
			'nome_sindico' => $post['nome_sindico']
		);
		Mail::send('emails.usuarios', $data, function ($m) use($post){
		     $m->from(env('MAIL_USERNAME'), 'Fala Vizinho');
		     $m->to($post['email_sindico'])->subject('Usuários do Condomínio');
		});

		$status = true;
		$message = 'Condomínio criado com sucesso!';
		$response = $condominio;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}

	public function alterarUsuarioGeradoSindico(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível alterar o usuário. Tente novamente mais tarde.";

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Nome é obrigatório.'
			));
		}

		if(!isset($post['email']) || !$post['email']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo E-mail é obrigatório.'
			));
		}

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID User é obrigatório.'
			));
		}

		$user = Sentinel::findUserById($post['id_user']);
		if($user){
			$data = array(
				'antigo_email' => $user->email,
				'novo_email' => $post['email']
			);
			$user->first_name = $post['nome'];
			$user->email = $post['email'];
			$user->save();
			Mail::send('emails.alteracao_conta_sindico', $data, function ($m) use($post){
			     $m->from(env('MAIL_USERNAME'), 'Fala Vizinho');
			     $m->to($post['email'])->subject('Sua conta foi alterada');
			});
			$roleCondomino = Sentinel::findRoleBySlug('condomino');
			$roleSindico = Sentinel::findRoleBySlug('sindico');
			$roleSindico->users()->detach($user);
			$roleCondomino->users()->detach($user);
			$roleSindico->users()->attach($user);

		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado um usuário com esse ID.'
			));
		}


		$status = true;
		$message = 'Usuário alterado com sucesso!';
		$response = $user;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}



	public function criarPessoaAutorizada(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível alterar o usuário. Tente novamente mais tarde.";

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Nome é obrigatório.'
			));
		}	

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}	

		if(!isset($post['documento']) || !$post['documento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Documento é obrigatório.'
			));
		}	

		if(!isset($post['observacao']) || !$post['observacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Observação é obrigatório.'
			));
		}	

		$PessoaAutorizada = new PessoaAutorizada;
		$PessoaAutorizada->nome = $post['nome'];
		$PessoaAutorizada->id_user_responsavel = $post['id_user'];
		$PessoaAutorizada->observacao = $post['observacao'];
		$PessoaAutorizada->id_condominio_unidade = CondominioService::buscarCondominioUnidadeAtual($post['id_user']);
		$PessoaAutorizada->documento = $post['documento'];
		if($post['thumbnail_principal']){
			$PessoaAutorizada->thumbnail_principal = $post['thumbnail_principal'];
		}
		$PessoaAutorizada->save();

		//$PessoaAutorizada->id ; retorna ID

		$status = true;
		$message = 'Pessoa Autorizada foi criada com sucesso!';
		$response = $PessoaAutorizada;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}



	public function buscaPessoaAutorizada(){
		$post = \Request::input();
		$response = null;
		$status = false;
		$message = "Não foi possível alterar o usuário. Tente novamente mais tarde.";

		if(!isset($post['id_user']) || !$post['id_user']){
		return json_encode(array(
			'status' => false,
			'message' => 'O campo id_user é obrigatório.'
			));
		}	

		if(isset($post['id_pessoa_autorizada'])){
			$pessoa = PessoaAutorizada::find($post['id_pessoa_autorizada']);
			if($pessoa){
				$response = $pessoa;
				$status = true;
				$message = 'Registro buscado com sucesso!';
			}else{
				$status = false;
				$message = 'Não foi encontrado um veículo com esse ID.';
			}
		}else{

			$query = PessoaAutorizada::select('pessoa_autorizada.*')
			->where('pessoa_autorizada.id_user_responsavel',$post['id_user']);

			$pessoasAutorizadas = $query->get();

			$response = null;
			if($pessoasAutorizadas){
				$status = true;
				$message = "Dados buscados com sucesso!";
				$response = $pessoasAutorizadas;
			}else{
				$status = false;
				$message = "Não existe com esse ID";
			}

		}
		return response()->json(array('status'=> $status, 'message'=>$message, 'response' => $response), 200);

	}


	public function deletarPessoaAutorizada(){
		$post = \Request::input();
		$response = null;

		if(!isset($post['id_pessoa_autorizada']) || !$post['id_pessoa_autorizada']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo ID pessoa autorizada é obrigatório.'
			));
		}

		$pessoa = PessoaAutorizada::find($post['id_pessoa_autorizada']);
		if($pessoa){
			$pessoa->delete();
			$status = true;
			$message = 'Pessoa Autorizada removida com sucesso!';
		}else{
			return json_encode(array(
				'status' => false,
				'message' => 'Não foi encontrado uma pessoa autorizada com esse ID.'
			));
		}

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
	}


	public function editarPessoaAutorizada(){

		$post = \Request::input();
		$response = null;

		if(!isset($post['nome']) || !$post['nome']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Nome é obrigatório.'
			));
		}	

		if(!isset($post['id_user']) || !$post['id_user']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo id_user é obrigatório.'
			));
		}	

		if(!isset($post['documento']) || !$post['documento']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Documento é obrigatório.'
			));
		}	

		if(!isset($post['observacao']) || !$post['observacao']){
			return json_encode(array(
				'status' => false,
				'message' => 'O campo Observação é obrigatório.'
			));
		}	

		$PessoaAutorizada = PessoaAutorizada::find($post['	']);
		$PessoaAutorizada->nome = $post['nome'];
		$PessoaAutorizada->observacao = $post['observacao'];
		$PessoaAutorizada->documento = $post['documento'];
		if($post['thumbnail_principal']){
			$PessoaAutorizada->thumbnail_principal = $post['thumbnail_principal'];
		}
		
		$PessoaAutorizada->save();
		$status = true;
		$message = 'Pessoa Autorizada editada com sucesso!';
		$response = $PessoaAutorizada;

		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'response' => $response
		));
		
	}

	public function loginFornecedor(){

		$post = \Request::input();
		$response = null;
		$status = false;

		if(empty($post['email']) || empty($post['senha'])) {
			return json_encode([
				'status' => false,
				'message' => "O campo email e senha são obrigatórios",
				'response' => $response
			]);
		}

		$response = DB::table('fornecedores')
					->where([
						['email', $post['email']],
						['senha', $post['senha']]
					])
					->first();

		if(empty($response)){
			$message = 'Não foi possível efetuar o login. E-mail ou senha inválidos.';
		}else{
			$status = true;
			$message = 'Usuário logado com sucesso.';
		}

		return json_encode([
			'status' => $status,
			'message' => $message,
			'response' => $response
		]);
	}

	public function getSolicitacoesFornecedor(){

		$post = \Request::input();
		$response = null;

		if(empty($post['id_fornecedor'])) {
			return json_encode([
				'status' => false,
				'message' => "O campo id_fornecedor é obrigatório",
				'response' => $response
			]);
		}

		$response = DB::table('solicitacoes')
					->where('id_fornecedor', $post['id_fornecedor'])
					->get();

		if(!empty($response)){
			$message = 'Lista de Solicitações!';
		}else{
			$message = 'Nenhum registro encontrado!';
			$response = null;
		}

		return json_encode([
			'status' => true,
			'message' => $message,
			'response' => $response
		]);
	}

	public function setMensagem(){
		$post = \Request::input();

		if(empty($post['id_solicitacao'])) {
			return json_encode([
				'status' => false,
				'message' => "O campo id_solicitacao é obrigatório"
			]);
		}

		if(empty($post['id_fornecedor']) || empty($post['id_cliente'])) {
			return json_encode([
				'status' => false,
				'message' => "O campo id_fornecedor e id_cliente são obrigatórios"
			]);
		}

		$response = DB::table('mensagens')->insertGetId($post);

		if(!empty($response)){
			$status = true;
			$message = 'Mensagem inserida!';
		}else{
			$status = false;
			$message = 'Falha ao inserir dado!';
		}

		return json_encode([
			'status' => $status,
			'message' => $message,
			'response' => $response
		]);
	}
}
