<?php

namespace App\Http\Middleware;

use App\Models\Seguranca\AcaoSolicitada;
use App\Models\Seguranca\SegAcaoDB;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastroAutomaticoDeTelaEDependencia
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        function debugEstaAtivo(): bool {
            return config('app.debug');
        }
        
        if (!debugEstaAtivo()) {//abandona logo este middleware se não estiver com modo debug Ativo
            return $next($request);
        }

        /*
         * ===========================================
         * FUNÇÃO BETA NÃO REMOVA O COMENTÁRIO ABAIXO
         * ===========================================
         */
        $t = self::possuiCabecalhoDeTela();
        if ($t) {
            //substitui números na url por :id. Ex: usuario/10/edit => usuario/:id/edit
//            $urlTratada = preg_replace("@/\d+/@", '/:id/', $_SERVER['HTTP_X_SEGURANCA_TELA']);
            $urlTratada = $_SERVER['HTTP_X_SEGURANCA_TELA'];
            $acao_id = SegAcaoDB::id($urlTratada, 'GET');

            if (!$acao_id) {//se a tela não estiver cadastrada, pergunta ao programador se deve cadastrá-la

                $response = $next($request);
                $response->header('X-SEGURANCA-TELA', $urlTratada);
                return $response;
            } else { //ações já cadastradas

                $querAcessarOQue = AcaoSolicitada::getInstance()->getAcao();

                //cria vínculo de dependência entre elas (menos para o delete, put, patch)
//                if (!in_array(mb_strtolower($querAcessarOQue->method), ['delete', 'put', 'patch'])) {
                // if (mb_strtolower($querAcessarOQue->method) != 'delete') {
                //     SegDependencia::firstOrCreate([
                //         'acao_atual_id' => $acao_id,
                //         'acao_dependencia_id' => $querAcessarOQue->id
                //     ]);
                // }
                if (mb_strtolower($querAcessarOQue->method) == 'delete') {//delete será adicionado como destaque
                    $querAcessarOQue->nome_amigavel = 'Excluir';
                    $querAcessarOQue->destaque = true;
                    $querAcessarOQue->save();
                }
            }
        }


        /*
         * Backup da versão que funciona com telas cadastradas com antecedência
         */
//        if (isset($_SERVER['HTTP_X_SEGURANCA_TELA'])) {
//            $quem = SegAcaoDB::id($_SERVER['HTTP_X_SEGURANCA_TELA'], 'GET');
//            $querAcessarOQue = AcaoSolicitada::getInstance()->getAcao();
//
//            if ($quem && $querAcessarOQue && !SegDependenciaRegras::dependenciaJaCadastrada($querAcessarOQue->id, $quem)) {
//
//                SegDependencia::create([
//                    'acao_atual_id' => $quem,
//                    'acao_dependencia_id' => $querAcessarOQue->id
//                ]);
////                $response = $next($request);
////                $response
////                    ->header('X-Seguranca-Dependencia-Nome', $querAcessarOQue->nome)
////                    ->header('X-Seguranca-Dependencia-Id', $querAcessarOQue->id);
////                ->header('Access-Control-Allow-Origin', '*');
//            }
//        }

        return $next($request);
    }

    public static function possuiCabecalhoDeTela(): bool
    {
        return isset($_SERVER['HTTP_X_SEGURANCA_TELA']);
    }
}
