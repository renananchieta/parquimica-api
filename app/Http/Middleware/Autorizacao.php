<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PoliciaCivil\Seguranca\Models\Entity\Usuario;
use PoliciaCivil\Seguranca\Models\Regras\AcaoSolicitada;
use PoliciaCivil\Seguranca\Models\Regras\UsuarioLogado;

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
        if ($usuario->isRoot()) {//root passa direto para próxima camada
            return $next($request);
        }
        
        return $next($request);
    }
}
