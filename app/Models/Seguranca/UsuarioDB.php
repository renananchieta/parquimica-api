<?php

namespace App\Models\Seguranca;

use App\Models\Seguranca\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UsuarioDB 
{
    public static function gridUsuarios(object $data)
    {
        $query = Usuario::query();

        if(isset($data->email)) $query->where('email', 'like', '%' . $data->email . '%');
        if(isset($data->nome)) $query->where('nome', 'like', '%' . $data->nome . '%');
        if(isset($data->nome_social)) $query->where('nome_social', 'like', '%' . $data->nome_social . '%');
        if(isset($data->cpf)) $query->where('cpf', 'like', '%' . $data->cpf . '%');

        $dados = $query->limit(200)->get();

        return $dados;
    }

    public static function rotas(Usuario $usuario)
    {
        $perfis = self::perfisIDUsuarioLogado($usuario);

        if (Auth::id() === 1) {//usuário dime sempre tem acesso a tudo
            return ['*'];
        }

        if ($perfis->contains('id', 1)) {//usuário com perfil 1 (root)
            return ['*'];
        }

        $sql = DB::table('seg_acao as sa')
            ->leftJoin('seg_permissao as sp', 'sa.id', '=', 'sp.acao_id')
            ->whereIn('sp.perfil_id', $perfis)
            ->orWhere('sa.obrigatorio', true)
            ->orderBy('sa.nome');

        return $sql->pluck('nome');
    }

    public static function perfisIDUsuarioLogado(Usuario $usuario)
    {
        //Gera cache dos perfis do usuário. 7200 segundos = 2 horas
        return Cache::remember("usuario$usuario->id", 7200, function () use ($usuario) {
            return SegPerfilUsuario::where('usuario_id', $usuario->id)
                ->get('perfil_id as id');
        });
    }
}
