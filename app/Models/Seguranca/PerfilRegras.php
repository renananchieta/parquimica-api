<?php

namespace App\Models\Seguranca;

class PerfilRegras
{
    public static function telaCadastro(Usuario $usuario): array
    {
        return self::gridPerfil($usuario);
    }

    public static function telaEdicao(\stdClass $p): array
    {
        $perfil = SegPerfil::select(['id', 'perfil'])
            ->find($p->id);

        $acoes = self::gridPerfil($p->usuario);
        $grupos = array_map(fn ($item) => $item['perfil'], $acoes);

        return [
            'registro' => $perfil,
            'destaque' => $acoes,
            'grupos' => $grupos,
            'permissoes_concedidas' => PerfilDB::permissoesDestaqueConcedidas($p->id)
        ];
    }

    public static function gridPerfil(Usuario $usuario): array
    {
//        $acoes = SegAcao::where('obrigatorio', false)//ações obrigatórias não devem ficar disponíveis na tela de perfil
//        ->where('destaque', true)
//            ->orderBy('grupo')
//            ->orderBy('nome_amigavel')
//            ->get([
//                'id',
//                'nome_amigavel',
//                'descricao',
//                'grupo'
//            ]);
        $acoes = PerfilDB::permissoesDestaqueConcedidasUsuarioLogado($usuario);
        $grupos = $acoes->groupBy('grupo');

        //formatando para tela
        $destaques = [];
        foreach ($grupos as $indice => $g) {
            $destaques[] = [
                'nome' => $indice,
                'filhos' => $g
            ];
        }
        return $destaques;
    }

    public static function cadastrar(\stdClass $p): SegPerfil
    {
        $perfil = SegPerfil::create([
            'perfil' => $p->perfil
        ]);

        //adicionando permissão às ações selecionadas na tela
        foreach ($p->permissoes as $permissao) {
            SegPermissao::create([
                'acao_id' => $permissao,
                'perfil_id' => $perfil->id
            ]);
        }

        /*
         * localizar todas as dependências das telas selecionadas
         * adicionar ao perfil cada uma delas
         */
        SegDependencia::whereIn('acao_atual_id', $p->permissoes)
            ->select('acao_dependencia_id')
            ->groupBy('acao_dependencia_id')
            ->groupBy('id')
            ->each(function ($dependencia) use ($perfil) {

                SegPermissao::firstOrCreate([//adiciona permissão ao perfil, se ainda não possuir
                    'acao_id' => $dependencia->acao_dependencia_id,
                    'perfil_id' => $perfil->id
                ]);
            });

        return $perfil;
    }

    public static function atualizar(\stdClass $p): SegPerfil
    {
        $perfil = SegPerfil::find($p->id);
        $perfil->nome = $p->nome;
        $perfil->save();

        /*
         * Localizar todas as ações que só estão na tela (e suas dependências)
         * adicionar ao banco (se ainda não estiverem lá)
         */
        $permissoesTela = PerfilDB::acoesConcedidas($p->permissoes);

        //remover do banco qualquer ação que não esteja no item acima
        SegPermissao::where('perfil_id', $perfil->id)
            ->whereNotIn('acao_id', $permissoesTela)
            ->each(function ($acaoConcedida) {
                $acaoConcedida->delete();
            });


        //Unindo em um único array as ações selecionadas pelo usuário e suas dependências
        $acoesRaizEDependencias = array_merge($p->permissoes, $permissoesTela);

        foreach ($acoesRaizEDependencias as $acao) {
            SegPermissao::firstOrCreate([
                'acao_id' => $acao,
                'perfil_id' => $perfil->id
            ]);
        }

        return $perfil;
    }

    public static function excluir(SegPerfil $perfil)
    {
        //removendo todas as permissões do perfil
        SegPermissao::where('perfil_id', $perfil->id)
            ->each(function($segPermissao) {
                $segPermissao->delete();
            });

        //excluindo o perfil
        $perfil->delete();
    }
}
