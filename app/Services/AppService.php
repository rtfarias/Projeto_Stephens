<?php

namespace App\Services;

use DB;
use App\Http\Controllers\BaseController;
use Sentinel;
use App\Modules\Estados\Models\Estados;


class AppService extends BaseController
{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Sao_Paulo');
	}

	public static function enviaPush($arrayUsuarios, $descricao, $titulo,  $data = null){

        $content = array(
            "en" => $descricao
            );
        $heading = array(
            "en" => $titulo
            );

        $fields = array(
            'app_id' => "2a59286a-6632-46bb-b1d3-e03411dac98a",
            //'included_segments' => ["Active Users"],
            'include_player_ids' => $arrayUsuarios,
            'data' => $data,
            'contents' => $content,
            'headings' => $heading,
            'template_id' => '5d8d57ff-20fd-466d-b742-c78667ab90c5'
        );

        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic MTIzYWQxOGYtODlkYy00YWY5LWE1NDEtYjMwZjJjNmZhNThh'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);


        $return["allresponses"] = $response;
        $return = json_encode( $return);

        //print("\n\nJSON received:\n");
        //print($return);
        //print("\n");


        return json_encode(0);

    }



	public static function buscarSindicoCondominio($id_condominio){
		$sindico = Condominio::select('sis_users.id')->join('condominio_torre', 'condominio.id', '=', 'condominio_torre.id_condominio')->join('condominio_unidade', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')->join('condomino', 'condominio_unidade.id', '=', 'condomino.id_condominio_unidade')->join('sis_users', 'condomino.id', '=', 'sis_users.id_condomino')->join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')->where('sis_role_users.role_id', 2)->where('condominio.id', $id_condominio)->first();
		if($sindico){
			return $sindico->id;
		}else{
			return null;
		}

	}

	public static function buscarCondominioAtual($id_user = null){
		if(!$id_user){
			$user = Sentinel::getUser();
		}else{
			$user = Sentinel::findUserById($id_user);
		}
		$item = Condominio::select('condominio.*')->join('condominio_torre', 'condominio.id' ,'=', 'condominio_torre.id_condominio')->join('condominio_unidade', 'condominio_torre.id', '=', 'condominio_unidade.id_condominio_torre')->join('condomino', 'condominio_unidade.id', '=', 'condomino.id_condominio_unidade')->where('condomino.id', $user->id_condomino)->first();
		if($item){
			return $item->id;
		}else{
			return null;
		}
	}

	public static function buscarTorreAtual($id_user = null){
		if(!$id_user){
			$user = Sentinel::getUser();
		}else{
			$user = Sentinel::findUserById($id_user);
		}
		$item = Condominio::select('condominio_torre.*')->join('condominio_torre', 'condominio.id' ,'=', 'condominio_torre.id_condominio')->join('condominio_unidade', 'condominio_torre.id', '=', 'condominio_unidade.id_condominio_torre')->join('condomino', 'condominio_unidade.id', '=', 'condomino.id_condominio_unidade')->where('condomino.id', $user->id_condomino)->first();
		return $item->id;
	}

	public static function buscarCondominioUnidadeAtual($id_user = null){
		if(!$id_user){
			$user = Sentinel::getUser();
		}else{
			$user = Sentinel::findUserById($id_user);
		}
		$item = Condominio::select('condominio_unidade.*')->join('condominio_torre', 'condominio.id' ,'=', 'condominio_torre.id_condominio')->join('condominio_unidade', 'condominio_torre.id', '=', 'condominio_unidade.id_condominio_torre')->join('condomino', 'condominio_unidade.id', '=', 'condomino.id_condominio_unidade')->where('condomino.id', $user->id_condomino)->first();
		if($item){
			return $item->id;
		}else{
			return null;
		}
	}

	public static function notificarCondominio($id_remetente, $tipo, $titulo, $mensagem, $id_condominio, $modulo, $id_referencia){

		$users = DB::table('sis_users')
		->select('sis_users.id', 'sis_users.udid')
		->join('condomino', 'sis_users.id_condomino', '=', 'condomino.id')
		->join('condominio_unidade', 'condomino.id_condominio_unidade', '=', 'condominio_unidade.id')
		->join('condominio_torre', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')
		->join('configuracao_notificacao', 'configuracao_notificacao.id_user', '=', 'sis_users.id')
		->where('condominio_torre.id_condominio', '=', $id_condominio)
		->where('configuracao_notificacao.ativo', '=', 1)
		->where('configuracao_notificacao.chave', '=', $tipo)
		->where('sis_users.id', '!=', $id_remetente)
		->groupBy('sis_users.id')
		->get();

		$onesignal = array();
		foreach ($users as $user){
			if($user->udid){
				array_push($onesignal, $user->udid);
			}
		}

		$notificado = self::criarNotificacao($users, $titulo, $modulo, $id_referencia, $id_remetente);

		$enviado = self::sendMessage($onesignal, $mensagem, $titulo, $modulo, $id_referencia);

		return json_encode(array(
			'onesignal' => $onesignal,
			'users' => $users,
			'tipo' => $tipo,
			'titulo' => $titulo,
			'mensagem' => $mensagem,
			'push' => $enviado,
			'notificado' => $notificado
		));
	}

	public static function notificarTorre($id_remetente, $tipo, $titulo, $mensagem, $id_torre, $modulo, $id_referencia){
		$users = DB::table('sis_users')
		->select('sis_users.id', 'sis_users.udid')
		->join('sis_role_users', 'sis_users.id', '=', 'sis_role_users.user_id')
		->join('condomino', 'sis_users.id_condomino', '=', 'condomino.id')
		->join('condominio_unidade', 'condomino.id_condominio_unidade', '=', 'condominio_unidade.id')
		->join('condominio_torre', 'condominio_unidade.id_condominio_torre', '=', 'condominio_torre.id')
		->join('configuracao_notificacao', 'configuracao_notificacao.id_user', '=', 'sis_users.id')
		->where('condominio_torre.id', '=', $id_torre)
		->where('configuracao_notificacao.ativo', '=', 1)
		->where('configuracao_notificacao.chave', '=', $tipo)
		->where('sis_users.id', '!=', $id_remetente)
		->where('sis_role_users.role_id', '!=', 6) // Não notificar o porteiro
		->groupBy('sis_users.id')
		->get();

		$onesignal = array();
		foreach ($users as $user){
			if($user->udid){
				array_push($onesignal, $user->udid);
			}
		}

		$notificado = self::criarNotificacao($users, $titulo, $modulo, $id_referencia, $id_remetente);
		$enviado = self::sendMessage($onesignal, $mensagem, $titulo, $modulo, $id_referencia);
		return json_encode(array(
			'onesignal' => $onesignal,
			'users' => $users,
			'tipo' => $tipo,
			'titulo' => $titulo,
			'mensagem' => $mensagem,
			'push' => $enviado,
			'notificado' => $notificado
		));
	}

	public static function notificarUsuario($id_remetente, $tipo, $titulo, $mensagem, $id_user, $modulo, $id_referencia){
		$users = DB::table('sis_users')
		->select('sis_users.id', 'sis_users.udid')
		->join('configuracao_notificacao', 'configuracao_notificacao.id_user', '=', 'sis_users.id')
		->where('sis_users.id', '=', $id_user)
		->where('configuracao_notificacao.ativo', '=', 1)
		->where('configuracao_notificacao.chave', '=', $tipo)
		->groupBy('sis_users.id')
		->get();

		$onesignal = array();
		foreach ($users as $user){
			if($user->udid){
				array_push($onesignal, $user->udid);
			}
		}

		if($modulo == 'recadoResposta'){
			$moduloNotificacao = 'recado';
		}
		else if($modulo == 'questionamentoResposta'){
			$moduloNotificacao = 'questionamento';
		}
		else if($modulo == 'aprovarReserva'){
			$moduloNotificacao = 'reserva';
		}else{
			$moduloNotificacao = $modulo;
		}

		$notificado = self::criarNotificacao($users, $titulo, $moduloNotificacao, $id_referencia, $id_remetente);

		$enviado = self::sendMessage($onesignal, $mensagem, $titulo, $modulo, $id_referencia);

		return json_encode(array(
			'onesignal' => $onesignal,
			'users' => $users,
			'tipo' => $tipo,
			'titulo' => $titulo,
			'mensagem' => $mensagem,
			'push' => $enviado,
			'notificado' => $notificado
		));
	}

	public static function sendMessage($arrayIds, $mensagem, $titulo, $pushType = null, $caminho = null){
		$content = array(
			"en" => $mensagem
		);
		$heading = array(
			"en" => $titulo
		);
		$fields = array(
			'app_id' => "0a7821b4-4b3d-4698-a985-b1028dd3a156",
			//  'include_player_ids' => $arrayIds,
			'include_player_ids' => $arrayIds,
			'data' => array("type" => $pushType,
			"idReferencia" => $caminho),
			'contents' => $content,
			'headings' => $heading,
			'template_id' => 'a903a176-0956-4834-9b51-1e30e79915c5'
		);
		$fields = json_encode($fields);
		// print("\nJSON sent:\n");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic Y2RmNDBmYWYtNGY5Ni00MDM4LTg5YWYtNTE1NGE1M2JlOGY3'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		curl_close($ch);
		//print_r($response); die();

		// Cria notificação


		return $response;
		//return true;
	}

	public static function listarModelo($id_espaco_comum_modelo){
		$espacoComumModelo = EspacoComumModelo::find($id_espaco_comum_modelo);
		$espacoComumModelo->items;
		$espacoComumModelo->horarios;
		return json_encode(array(
			'status' => true,
			'response' => $espacoComumModelo
		));
	}

	public static function criarNotificacao($users, $mensagem, $modulo, $id_referencia, $id_remetente){
		foreach ($users as $user) {
			$notificacao = new Notificacao();
			$notificacao->descricao = $mensagem;
			$notificacao->tipo = $modulo;
			$notificacao->id_referencia = $id_referencia;
			$notificacao->id_user_remetente = $id_remetente;
			$notificacao->id_user_destinatario = $user->id;
			$notificacao->data_criacao = date('Y-m-d H:i:s');
			$notificacao->save();
		}
		return true;
	}
}
