<?php

namespace App\Models\Regras;

use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Entity\Produtos\UploadProdutosLocal;
use App\Models\Entity\Produtos\VariantesProduto;
use Exception;
use Illuminate\Support\Facades\DB;

class ProdutosLocalRegras 
{
    public static function salvarProduto($data)
    {
        $produto = ProdutosLocal::create($data['produto']);

        if (!$produto) {
            throw new Exception("Falha ao salvar o produto.");
        }

        return $produto;
    }

    public static function salvarVariantes($data, $produtoLocal)
    {
        if($data['variantes']) {
            $p = $data['variantes'];

            foreach($p as $itemVariante) {
                $variante = new VariantesProduto();
                $variante->produto_id = $produtoLocal->id;
                $variante->codigo_produto_variante = $itemVariante['id'];
                $variante->save();
    
                if (!$variante) {
                    throw new Exception("Falha ao salvar variantes do produto.");
                }
            }
    
            return ;
        } else {
            return ;
        }
    }

    public static function upload($data, $produtoLocal)
    {
        $data = (object)$data;
        if(isset($data->arquivo)) {
            $path = $data->arquivo->path();
            $nomeArquivo = $data->arquivo->getClientOriginalName();
            $documento = file_get_contents($path);

            $doc = new UploadProdutosLocal();
            $doc->arquivo = DB::raw("decode('" . base64_encode($documento) . "', 'base64')");
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
