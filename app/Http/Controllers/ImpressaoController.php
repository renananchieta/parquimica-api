<?php

namespace App\Http\Controllers;

use App\Models\Facade\FirebirdDB;
use App\Models\Regras\ConfigurarPDF;
use Illuminate\Http\Request;

class ImpressaoController extends Controller
{
    public function gerarPDF(Request $request)
    {
        $p = (object)$request->all();

        if (isset($p->imprime_literatura)){
            // $literatura = FirebirdDB::literatura($p);
            $teste = "teste";

            // $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('literatura'));
            $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('teste'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }

    }
}
