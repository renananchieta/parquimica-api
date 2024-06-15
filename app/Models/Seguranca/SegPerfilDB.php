<?php

namespace App\Models\Seguranca;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class SegPerfilDB
{
    public static function grid(stdClass $p): Collection
    {
        $sql = DB::table('seg_perfil as p')
            ->where('id', '!=', 1)
            ->limit(200)
            ->orderBy('id', 'desc');

        if (isset($p->nome)) {
            $sql->where('perfil', 'like', $p->perfil);
        }

        return $sql->get([
            'id',
            'perfil',
            DB::raw('(select count(1) from seg_perfil_usuario where perfil_id = p.id) as total_usuarios')
        ]);
    }

    /**
     * @param Usuario|null $usuarioLogado
     * @return Collection
     */
    public static function comboPerfil(Usuario $usuarioLogado = null): Collection
    {
        $sql = DB::table('seg_perfil')
            ->orderBy('perfil');

        if ($usuarioLogado->id != 1) {
            $sql->where('id', '!=', 1);
        }

        return $sql->get([
            'id as value',
            'perfil as text'
        ]);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public static function perfilUsuario(int $id): Collection
    {
        return DB::table('seg_perfil_usuario')
            ->where('usuario_id', $id)
            ->pluck('perfil_id');
    } 
}
