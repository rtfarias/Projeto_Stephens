<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Sentinel;
use App\Modules\Notificacao\Models\Notificacao;
use App\Modules\Reserva\Models\Reserva;
use App\Modules\Recado\Models\Recado;
use Illuminate\Auth\GenericUser;
use App\User;
use App\Services\AppService;
use DB;

class AdminController extends BaseController
{
	public function __construct(){
		parent::__construct();
		//$this->consultas_m = new Consultas();
		//$this->noticias_m = new Noticias();
	}
    public function getHome()
    {

		$data = array();
		$user = Sentinel::getUser();
		$user_role = Sentinel::findById($user->id)->roles[0];

		if($user_role->slug != 'admins'){
			/*$data['consultas'] = [];
			$data['consultas'] = Consultas::select('consultas.*', 'clientes.*', 'clientes.id AS id_cliente', 'consultas.id AS id_consulta','tipos.nome AS nome_tipo')->join('clientes', 'consultas.id_cliente', '=', 'clientes.id')->join('tipos', 'consultas.tipo', '=', 'tipos.id')->where([['consultas.clinica', '=' ,$user->id],['consultas.aceito', '=' ,'2']])->orderBy('consultas.datahorario', 'desc')
	                ->get();

	        $horarioAtual = date("Y-m-d H:i:s");

	        $data['consultas_hoje'] = [];
	    	$data['consultas_hoje'] = Consultas::select('consultas.*', 'clientes.*', 'clientes.id AS id_cliente', 'consultas.id AS id_consulta','tipos.nome AS nome_tipo')->join('clientes', 'consultas.id_cliente', '=', 'clientes.id')->join('tipos', 'consultas.tipo', '=', 'tipos.id')->where([['consultas.clinica', '=' ,$user->id],['consultas.aceito', '=' ,'1'], ['consultas.datahorario', '>', $horarioAtual ]])->orderBy('consultas.id', 'desc')->limit('15')
	                ->get();*/


	    }else{
	    	/*$data['noticias'] = [];
	    	$data['noticias'] = Noticias::select('noticias.*', 'sis_users.first_name AS nome_clinica', 'sis_users.id AS id_clinica')->join('sis_users', 'sis_users.id', '=','noticias.id_clinica')->where([['noticias.aceito', '=' ,'2']])->orderBy('id', 'desc')
	                ->get();*/

	    }


			

        return view('admin.index', $data);	

    }

    public function verificaSePrecisaAtualizar()
    {

    	$user = Sentinel::getUser();
		$user_role = Sentinel::findById($user->id)->roles[0];

		if($user_role->slug != 'admins'){
			$data = Consultas::select('consultas.*', 'clientes.*', 'clientes.id AS id_cliente', 'consultas.id AS id_consulta','tipos.nome AS nome_tipo')->join('clientes', 'consultas.id_cliente', '=', 'clientes.id')->join('tipos', 'consultas.tipo', '=', 'tipos.id')->where([['consultas.clinica', '=' ,$user->id],['consultas.aceito', '=' ,'2']])->orderBy('consultas.datahorario', 'desc')
	                ->get();

	        return count($data);

	    }else{
	    	$data = Noticias::select('noticias.*', 'sis_users.first_name AS nome_clinica', 'sis_users.id AS id_clinica')->join('sis_users', 'sis_users.id', '=','noticias.id_clinica')->where([['noticias.aceito', '=' ,'2']])->orderBy('id', 'desc')
	                ->get();

	        return count($data);

	    }

    }

    public function aceitar_noticia($id){
		try{
			$this->noticias_m->aceitarOuRejeitarNoticia($id, 1);

			\Session::flash('type', 'success');
            \Session::flash('message', "Notícia enviada com sucesso!");
			return redirect('admin/');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possivel enviar a notícia!");
            return redirect()->back();
		}
	}

	public function rejeitar_noticia($id){
		try{
			$this->noticias_m->aceitarOuRejeitarNoticia($id, 0);

			\Session::flash('type', 'success');
            \Session::flash('message', "Notícia rejeitada!");
			return redirect('admin/');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possivel rejeitar a notícia!");
            return redirect()->back();
		}
	}


    public function aceitar($id){
		try{
			 $this->consultas_m->aceitarOuRejeitar($id, 1, '');

			\Session::flash('type', 'success');
            \Session::flash('message', "Consulta aceita com sucesso!");
			return redirect('admin/');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possivel aceitar a consulta!");
            return redirect()->back();
		}
	}

	public function rejeitar($id){
		try{
			//$justificativa = $_POST['justificativa'];
			$this->consultas_m->aceitarOuRejeitar($id, 0, 'Sua consulta não pôde ser aceita neste horário. Aguarde alguns instantes que entraremos em contato');

			\Session::flash('type', 'success');
            \Session::flash('message', "Consulta rejeitada!");
			return redirect('admin/');
		}catch(Exception $e){
			\Session::flash('type', 'error');
            \Session::flash('message', "Nao foi possivel rejeitar a consulta!");
            return redirect()->back();
		}
	}

    public function processBuscar(Request $request){
		$keyword = $request->get('q');
		$data = array();
		$modulos = \App\Gerador::where('id_tipo_modulo',1)->get();
		foreach ($modulos as $modulo) {
			$listagem = array();
			$query = DB::table($modulo->nome_tabela)->select('*');
			foreach ($modulo->camposTexto as $campo) {
				$query->orWhere($campo->nome, 'LIKE', "%$keyword%");
				if($campo->listagem){
					$listagem[] = $campo;
				}
			}
			$results = $query->get();

			if(count($results) && $this->current_user->hasAccess($modulo->nome_tabela.'.view')){
				$data['modulos'][$modulo->id]['modulo'] = $modulo;
				$data['modulos'][$modulo->id]['campos_listagem'] = $listagem;
				$data['modulos'][$modulo->id]['registros'] = $results;
			}

		}

		//print_r($data);die();

		return view('admin/busca', $data);
	}

	public function verificaEmail(){
		$email = $_POST['email'];
		$query = DB::table('sis_users')->select('sis_users.*')->where('email', $email)->get();
		//echo json_encode($query);
		if(count($query) > 0)
			return json_encode(true);
		else
			return json_encode(false);
	}

	public function getCep() {
	  	$cep = $_POST['cep'];
	  	$url = 'http://republicavirtual.com.br/web_cep.php?cep='.$cep.'&formato=jsonp';

	  	$resultado = file_get_contents($url);

	  	//print_r($resultado); die;

	  	if(!$resultado){
	  		$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
	  	}
	  	print_r($resultado);
	  	exit;
	}

	public function bad_permissions(){
		return view('admin/bad_permissions');
	}

	public function ver_notificacao(Request $request){
		$id_notificacao = $request->input('id_notificacao');
		Notificacao::where('id', $id_notificacao)->update(array('status' => 1));
		return json_encode('Notificacão visualizada com sucesso!');
	}

}
