<?php

namespace App\Models\Seguranca;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRegras 
{
    public static function  autenticacao(string $email, string $senha, ?string $ip, ?string $agente)
    {
        $usuario = Usuario::where('email', $email)
                          ->where('deleted_at', null)
                          ->first();

        if (!$usuario || !Hash::check($senha, $usuario->senha)) return throw new Exception('Credenciais inválidas.');

        if (!$token = JWTAuth::fromUser($usuario)) {
            return throw new Exception('Não foi possível criar o token.');
        }
        
        $usuario->token = $token;

        $rotas = UsuarioDB::rotas($usuario);

        $usuarioInfo = [
          "id" => $usuario->id,
          "nome" =>  $usuario->nome,
          "token" => $usuario->token,
          "expires_in" => auth()->factory()->getTTL() * 60,
          "rotas" => $rotas
        ];

        return $usuarioInfo;
    } 

}
