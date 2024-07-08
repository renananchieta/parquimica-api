<?php

namespace App\Http\Controllers;

use App\Models\Regras\ConfigurarPDF;
use Illuminate\Http\Request;

class ImpressaoController extends Controller
{
    public function gerarPDF(Request $request)
    {
        $p = (object)$request->all();

        if (isset($p->imprime_literatura)){
            $operacao = Operacoes::with(
                'unidade',
                'coordenador',
                'subcoordenador',
                'chefeOperacao',
                'chefeCartorio',
                'diretoria',
                'equipes')
                ->find($p->operacao_id);

            $pdf = ConfigurarPDF::configurar('operacao.identificacao_efetivo_coord_apoio_pdf', compact('operacao'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }

        if(isset($p->ficha_do_alvo)){
            $alvo = Alvos::with(
                'nivelRisco',
                'operacao',
                'tipoPrisao',
                'cidades',
                'bairros',
                'alvoEquipes'
            )->find($p->alvo_id);

            $pdf = ConfigurarPDF::configurar('operacao.ficha_do_alvo_pdf', compact('alvo'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }
    }
}
