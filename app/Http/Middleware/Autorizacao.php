<?php

namespace App\Http\Middleware;

use App\Models\Seguranca\AcaoSolicitada;
use App\Models\Seguranca\UsuarioDB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Autorizacao
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

        if (!Auth::check()) {
            abort(401, 'Usuário não autenticado');
        }

        /**
         * @var Usuario $usuario
         */
        $usuario = Auth::user();
        if ($usuario->id === 1) {//root passa direto para próxima camada
            return $next($request);
        }

        $acaoSolicitada = AcaoSolicitada::getInstance();

        //usuário deve trocar senha e não está na tela de troca de senha
//        if ($usuario->deveTrocarSenha()
//            && $acaoSolicitada->getNome() !== 'configuracoes/senha' //url do front
//            && $acaoSolicitada->getNome() !== 'api/configuracoes/senha'//url do back
//            && $acaoSolicitada->getNome() !== 'api/usuario/configuracoes'//url do back que popula a tela de configurações
//            && $acaoSolicitada->getNome() !== 'api/usuario/info'//url do back que verifica se usuário está logado
//        ) {
//            return response(['url' => '/configuracoes/senha'], 307);//307 - Temporary Redirect
//        }

        //usuário deve atualizar seu cadastro e não está na tela de atualizar cadastro
        // if ($usuario->cadastroIncompleto() && $acaoSolicitada->getNome() !== 'api/usuario/configuracoes') {
        //     return response(['url' => '/configuracoes'], 307);
        // }

        if (!UsuarioDB::permissaoUrl($acaoSolicitada)) {
            return abort(403, 'Seu usuário não possui permissão para acessar o recurso solicitado');
        }

        return $next($request);
    }
}
