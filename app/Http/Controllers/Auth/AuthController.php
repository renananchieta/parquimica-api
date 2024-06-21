<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seguranca\LogAcesso;
use App\Models\Seguranca\AuthRegras;
use App\Models\Seguranca\SegPerfil;
use App\Models\Seguranca\SegPerfilDB;
use App\Models\Seguranca\UsuarioDB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string'
        ]);

        $params = (Object)$request->all();

        try {
            $usuario = AuthRegras::autenticacao($params->email, $params->senha, $request->ip(), $request->userAgent());

                LogAcesso::create([
                    'usuario' => $params->email,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'login' => date('Y-m-d H:i:s'),
                ]);

                return response($usuario, 200); 
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            $usuario = Auth::user();
            $logAcesso = LogAcesso::where('usuario', $usuario->email)->whereNull('logout')->first();
            $logAcesso->update([
                'logout' => date('Y-m-d H:i:s'),
                'ultimo_acesso' => $logAcesso->login
            ]);

            Auth::guard('api')->logout();


            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch(Exception $e) {
            return response(['erro' => 'Falha ao realizar esta operação.', 'mensagem' => $e->getMessage()], 500);
        }
    }
    
    public function info()
    {
        $usuario = Auth::user();

        $usuarioInfo = [
            "id" => $usuario->id,
            "nome" =>  $usuario->nome,
            "perfis" => SegPerfilDB::perfilUsuario($usuario->id),
            "rotas" => UsuarioDB::rotas($usuario),
          ];

        return response()->json($usuarioInfo);
    }
}
