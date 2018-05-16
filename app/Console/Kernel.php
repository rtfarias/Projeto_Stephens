<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Services\AppService;
use DB;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
        $schedule->call(function () {
           date_default_timezone_set('America/Sao_Paulo');/*
           $enquetesToNotify = Enquete::where('notificado', 0)->where('data_finalizacao', '<', date('Y-m-d H:i:s'))->get();
           foreach ($enquetesToNotify as $enquete) {
                \App\Services\CondominioService::notificarCondominio(0, 'S', 'Uma enquete foi finalizada.', $enquete->nome, $enquete->id_condominio, 'enquete', $enquete->id);
               $enquete->notificado = 1;
               $enquete->save();
           }
            $arrayUsuarios = [$fornecedor->udid];
            $descricao = 'Solicitação reparo emergencial criada pelo cliente '.$cliente->nome;
            $titulo = 'Solicitação de reparo';
            $data = ['id_cliente'=> $arrayFiltros['id_cliente'], 'id_fornecedor'=> $arrayFiltros['id_fornecedor'], 'id_solicitacao'=> $arrayFiltros['id_solicitacao']];
            //AppService::enviaPush($arrayUsuarios, $descricao, $titulo, $data);*/

            $i = 1;

            $arrayMensagem = ['id_cliente' => 1, 'id_fornecedor' => 1, 'id_solicitacao' => 1, 'mensagem' => 'asdfaasfd2', 'enviado_por' => 1];  

            //$id_relacao_mensagem = DB::table('mensagens')->insert($arrayMensagem);

            /*if($i == 1){
                $data = array(
                    'nome_cliente' => '',
                    'data' => '',
                    'horario' => '',
                    'titulo' => 'Teste',
                    'descricao' => 'O Cliente fez uma solicitação de consulta. Acesse o gerenciador para aceitar ou rejeitar o agendamento.' ,
                    'link' => 'http://institutofacesimples.duoapp.com.br/admin/login'

                );
                
                Mail::send('emails.email_consulta', $data, function ($m){
                    $m->from(env('MAIL_USERNAME'), 'Prolar');
                    $m->to('ricardo@duostudio.com.br')->subject('Nova solicitação de consulta');
                });
            }*/

        })->everyMinute();
    }
}
