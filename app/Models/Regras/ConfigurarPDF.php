<?php

namespace App\Models\Regras;

use PDF;

class ConfigurarPDF
{
    /**
     * @param string $tela
     * @param array $params
     * @return mixed
     */
    public static function configurar(string $tela, array $params)
    {
        $pdf = PDF::loadView($tela, $params);
        $pdf->setOptions([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        /**
         * Estes parâmetros fazem com que o domPdf não valide o
         * certificado ssl e aceite o certificado auto-assinado
        */
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed'=> TRUE
            ]
        ]);
        $pdf->setHttpContext($context);

        return $pdf;
    }
}
