<?php

namespace App\Models\Seguranca;

use App\Models\Seguranca\SegAcao;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SegAcaoDB
{
    /**
     * Retorna o id de uma url
     * @param string $nomeAcao
     * @param string $metodo
     * @return int|null
     */
    public static function id(string $nomeAcao, string $metodo): ?int
    {
        return SegAcao::where('nome', $nomeAcao)
            ->where('method', 'like', $metodo)
            ->select('id')
            ->first()
            ?->id;
    }

    /**
     * @return Collection
     */
    public static function listaAcoesDestaque(): Collection
    {
        return SegAcao::where('destaque', true)
            ->orderBy('grupo')
            ->orderBy('nome_amigavel')
            ->get([
                'id',
                'nome_amigavel',
                'descricao',
                'grupo'
            ]);
    }

    public static function acoesObrigatorias(): Collection
    {
        return SegAcao::where('obrigatorio', true)
            ->get();
    }

    /**
     * @param string $endereco
     * @param string $metodo
     * @return SegAcao|null
     */
    public static function pesquisarEndereco(string $endereco, string $metodo = 'get'): ?SegAcao
    {
        return SegAcao::where('nome', '=', $endereco)
            ->whereRaw('method like ?', "%$metodo%")
            ->first();
    }

//    /**
//     * Gera uma nova ação automaticamente
//     * @param string $acao
//     * @param string $metodo
//     * @return SegAcao
//     */
//    public static function gerarAcaoAutomaticamente(string $acao, string $metodo): SegAcao
//    {
//        return SegAcao::create([
//            'nome' => $acao,
//            'method' => $metodo,
//            'grupo' => 'GeradoAutomaticamente'
//        ]);
//    }

    public static function grid(\stdClass $p): Collection
    {
        $destaque = isset($p->destaque) ? boolval($p->destaque) : null;

        $sql = SegAcao::orderBy('id', 'desc')
            ->limit(200);

        if (isset($p->nome)) {
            $sql->where('nome', 'like', "%{$p->nome}%");
        }

        if ($destaque) {
            $sql->where('destaque', $p->destaque);
        }

        return $sql->get([
            'id',
            'nome',
            'method',
            'descricao'
        ]);
    }

    /**
     * Retorna todas as ações, exceto a que está sendo editada passada como argumento
     * @param int|null $exceto_id
     * @return Collection
     */
    public static function comboAcoes(int $exceto_id = null): Collection
    {
        $sql = SegAcao::orderBy('grupo')
            ->orderBy('nome');

        if ($exceto_id) {
            $sql->where('id', '!=', $exceto_id);
        }

        return $sql->get([
            'id',
            DB::raw("'[' || method || '] ' || nome  as nome"),
            'method',
            'grupo'
        ]);
    }

    /**
     * Retorna todas as dependências de uma determinada ação
     * @param int $acao_id
     * @return Collection
     */
    public static function dependencias(int $acao_id): Collection
    {
        return DB::table('seg_dependencia as sd')
            ->join('seg_acao as sa', 'sa.id', '=', 'sd.acao_dependencia_id')
            ->where('acao_atual_id', $acao_id)
            ->pluck('sa.id');
    }

    public static function comboGrupo(): Collection
    {
        return DB::table('seg_acao')
            ->whereNotNull('grupo')
            ->groupBy(['grupo'])
            ->orderBy('grupo')
            ->pluck('grupo');
    }
}
