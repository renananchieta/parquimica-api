<?php

namespace App\Models\Seguranca;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PerfilDB
{
    /**
     * Lista todas as permissões de destaque que um usuário possui
     * Usado na tela de Edição de Perfil para marcar as permissões já concedidas
     * @param int $perfil_id
     * @return Collection
     */
    public static function permissoesDestaqueConcedidas(int $perfil_id): Collection
    {
        return DB::table('seg_permissao as sp')
            ->join('seg_acao as sa', 'sp.acao_id', '=', 'sa.id')
            ->where('perfil_id', $perfil_id)
            ->where('destaque', true)
            ->pluck('sp.acao_id');
    }

    /**
     * Exibe somente as permissões que o usuário possui
     * Perfis root podem ver todas as permissões do sistema
     * Usado no Cadastro/Edição de perfil para montar a tabela de permissões
     * @param Usuario $usuario
     * @return Collection
     */
    public static function permissoesDestaqueConcedidasUsuarioLogado(Usuario $usuario): Collection
    {
        //perfis do usuário logado
        $perfis = UsuarioDB::perfisIDUsuarioLogado($usuario);

        if ($usuario->isRoot($perfis)) {

            $acoes = DB::table('seg_acao as sa')
                ->where('obrigatorio', false)//obrigatórias não devem ficar disponíveis na tela de perfil
                ->where('destaque', true)//Somente ação raiz. Dependências serão calculadas automaticamente
                ->orderBy('grupo')
                ->orderBy('nome_amigavel');
        } else {

            $acoes = DB::table('seg_permissao as sp')
                ->join('seg_acao as sa', 'sp.acao_id', '=', 'sa.id')
                ->whereIn('sp.perfil_id', $perfis)
                ->where('obrigatorio', false)//obrigatórias não devem ficar disponíveis na tela de perfil
                ->where('sa.destaque', true)//Somente ação raiz. Dependências serão calculadas automaticamente
                ->orderBy('grupo')
                ->orderBy('nome_amigavel');

                $campos = [
                    'sp.id',
                    'nome_amigavel',
                    'descricao',
                    'grupo',
                ];

                $campos[] = DB::raw("(SELECT count(1) FROM seg_dependencia where acao_atual_id = sa.id) as total_dependencia");

                return $acoes->get($campos);
        }

        $campos = [
            'id',
            'nome_amigavel',
            'descricao',
            'grupo',
        ];

        // if ($usuario->isRoot(UsuarioDB::perfisIDUsuarioLogado($usuario))) {//para o root irá exibir o total de dependências de cada destaque
            $campos[] = DB::raw("(SELECT count(1) FROM seg_dependencia where acao_atual_id = sa.id) as total_dependencia");
        // }

        return $acoes->get($campos);
    }

    /**
     * Todas as ações e dependências concedidas calculadas
     * a partir do array enviado com ids de ações
     * @param array $acoesRaiz
     * @return array
     */
    public static function acoesConcedidas(array $acoesRaiz): array
    {
        if (empty($acoesRaiz))
            return [];

        $acoesNaTela = implode(',', $acoesRaiz);

        $sql = "
            WITH RECURSIVE filho AS (
                select acao_atual_id, acao_dependencia_id
                from seg_dependencia
                where acao_atual_id in ($acoesNaTela)

                UNION

                select sd.acao_atual_id, sd.acao_dependencia_id
                from seg_dependencia as sd
                    join filho on filho.acao_dependencia_id = sd.acao_atual_id
            )
            SELECT acao_dependencia_id as dependencia
            from filho
            group by acao_dependencia_id
            ORDER BY acao_dependencia_id
        ";

        $resultado = DB::select($sql);

        $retorno = [];
        foreach ($resultado as $r) {
            $retorno[] = $r->dependencia;
        }

        return $retorno;
    }

    /**
     * Todas as ações e dependências que um perfil tem acesso (exceto ações obrigatórias de qualquer perfil)
     * A partir das ações detaque (tabela seg_acao.destaque = true) todas as dependências serão calculadas
     * retornando um grande array com todas as ações que o usuário possui permissão.
     * @param int $perfil_id
     * @return array
     */
    public static function acoesConcedidasAUmPerfilComDependencias(int $perfil_id): array
    {
//        if (empty($acoesRaiz))
//            return [];

        $sqlAcoesDestaque = "select sp.acao_id
                            from seg_permissao as sp
                                     join seg_acao as sa on sp.acao_id = sa.id
                            where perfil_id = $perfil_id
                              and destaque = true";

        $sql = "
            WITH RECURSIVE filho AS (
                select acao_atual_id, acao_dependencia_id
                from seg_dependencia
                where acao_atual_id in ($sqlAcoesDestaque)

                UNION

                select sd.acao_atual_id, sd.acao_dependencia_id
                from seg_dependencia as sd
                    join filho on filho.acao_dependencia_id = sd.acao_atual_id
            )
            SELECT acao_dependencia_id as dependencia
            from filho
            group by acao_dependencia_id
            ORDER BY acao_dependencia_id
        ";

        $resultado = DB::select($sql);

        $retorno = [];
        foreach ($resultado as $r) {
            $retorno[] = $r->dependencia;
        }

        return $retorno;
    }
}
