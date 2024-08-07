<?php

namespace App\Models\Regras;

use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Entity\Produtos\UploadProdutosLocal;
use Illuminate\Support\Facades\DB;

class ProdutosLocalRegras 
{
    public static function cadastrar($data)
    {
        $produtoLocal = ProdutosLocal::create($data);

        if(isset($data->arquivo)) {
            $path = $data->anexo->path();
            $nomeArquivo = $data->anexo->getClientOriginalName();
            $documento = file_get_contents($path);

            $doc = new UploadProdutosLocal();
            $doc->anexo = DB::raw("decode('" . base64_encode($documento) . "', 'base64')");
            $doc->produto_id = $produtoLocal->id;
            $doc->nome_arquivo = $nomeArquivo;
            $doc->save();
        }

        return $produtoLocal;
    }

    public static function exibirArquivo(int $produto_id)
    {
        $doc = UploadProdutosLocal::where('codigo_produto', $produto_id);
        $file = stream_get_contents($doc->anexo);
        $response = response($file);
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename="documento.pdf"');
        return $response;
    }
}
