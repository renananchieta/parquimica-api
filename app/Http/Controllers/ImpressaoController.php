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
            $literatura = FirebirdDB::literatura($p);
            $literaturaJson = json_encode($literatura);

            $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('literaturaJson'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }

    }
}
