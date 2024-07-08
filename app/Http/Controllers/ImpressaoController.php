<?php

namespace App\Http\Controllers;

use App\Models\Facade\FirebirdDB;
use App\Models\Regras\ConfigurarPDF;
use Illuminate\Http\Request;

class ImpressaoController extends Controller
{
    public function gerarPDF(Request $request)
    {
        $p = (Object)$request->all();

        if (isset($p->imprime_literatura)){
            $literatura = json_encode(FirebirdDB::literatura($p));

            $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('literatura'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }

    }
}
