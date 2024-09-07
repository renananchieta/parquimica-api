<?php

namespace App\Models\Regras;

use App\Models\Entity\Produtos\ProdFuncao;
use App\Models\Entity\Produtos\ProdLinha;
use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Entity\Produtos\UploadProdutosLocal;
use App\Models\Entity\Produtos\VariantesProduto;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProdutosLocalRegras 
{
    public static function salvarProduto($data)
    {
        $data = $data['produto'];
        $produto = ProdutosLocal::create($data);

        if (!$produto) {
            throw new Exception("Falha ao salvar o produto.");
        }

        return $produto;
    }

    public static function salvarVariantes($data, $produtoLocal)
    {
        $p = $data['variantes'];

        foreach($p as $itemVariante) {
            $variante = new VariantesProduto();
            $variante->codigo_produto = $produtoLocal->codigo_produto;
            $variante->codigo_produto_variante = $itemVariante['codigo_produto'];

            if(empty($itemVariante['descricao_produto_variante'])) {
                $descricao = ProdutosLocal::where('codigo_produto', $itemVariante['codigo_produto'])->first();
                $variante->descricao_produto_variante = $descricao->nome_produto;
            }

            $variante->save();

            if (!$variante) {
                throw new Exception("Falha ao salvar variantes do produto.");
            }
        }

        return ;
    }

    public static function salvarLinhasEFuncoes($data, $produtoLocal)
    {
        $l = $data['linha'];

        foreach($l as $itemLinha) {
            $prodLinha = new ProdLinha();
            $prodLinha->codigo_produto = $produtoLocal->codigo_produto;
            $prodLinha->codigo_linha = $itemLinha['codigo_linha'];

            if(empty($itemLinha['descricao_linha'])){
                $descricao = ProdLinha::where('codigo_linha',$itemLinha['codigo_linha'])->first();
                $prodLinha->descricao_linha = $descricao->descricao_linha;
            }

            $prodLinha->save();

            if (!$prodLinha) {
                throw new Exception("Falha ao salvar linha do produto.");
            }
        }

        $f = $data['funcao'];

        foreach($f as $itemFuncao) {
            $prodFuncao = new ProdFuncao();
            $prodFuncao->codigo_produto = $produtoLocal->codigo_produto;
            $prodFuncao->codigo_funcao = $itemFuncao['codigo_funcao'];
            
            if(empty($itemFuncao['descricao_funcao'])){
            
                $descricao = ProdFuncao::where('codigo_funcao', $itemFuncao['codigo_funcao'])->first();
            
                $prodFuncao->descricao_funcao = $descricao->descricao_funcao;

            }

            $prodFuncao->save();

            if (!$prodFuncao) {
                throw new Exception("Falha ao salvar funcao do produto.");
            }
        }

        return ;
    }

    public static function alterarVariantes($data, $produtoLocal)
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

    public static function alterarProduto($data, $codigo_produto)
    {
        $data = $data['produto'];

        $produtoExistente = ProdutosLocal::where('codigo_produto', $codigo_produto)->first();
    
        $produtoExistente->update($data);
        $produtoExistente->fresh();
    
        return $produtoExistente;
    }

    public static function alterarLinhasEFuncoes($data, $produtoLocal)
    {
        $l = $data['linha'];

        $prodLinha = ProdLinha::where('codigo_produto', $produtoLocal->codigo_produto)->first();

        if($prodLinha) ProdLinha::where('codigo_produto', $produtoLocal->codigo_produto)->delete();
        
        foreach($l as $itemLinha) {
            $prodLinha = new ProdLinha();
            $prodLinha->codigo_produto = $produtoLocal->codigo_produto;
            $prodLinha->codigo_linha = $itemLinha['codigo_linha'];

            if(empty($itemLinha['descricao_linha'])){
                $descricao = ProdLinha::where('codigo_linha',$itemLinha['codigo_linha'])->first();
                $prodLinha->descricao_linha = $descricao->descricao_linha;
            }

            $prodLinha->save();

            if (!$prodLinha) {
                throw new Exception("Falha ao salvar linha do produto.");
            }
        }

        $prodFuncao = ProdFuncao::where('codigo_produto', $produtoLocal->codigo_produto)->first();
        if($prodFuncao) ProdFuncao::where('codigo_produto', $produtoLocal->codigo_produto)->delete();

        $f = $data['funcao'];

        foreach($f as $itemFuncao) {
            $prodFuncao = new ProdFuncao();
            $prodFuncao->codigo_produto = $produtoLocal->codigo_produto;
            $prodFuncao->codigo_funcao = $itemFuncao['codigo_funcao'];
            
            if(empty($itemFuncao['descricao_funcao'])){
            
                $descricao = ProdFuncao::where('codigo_funcao', $itemFuncao['codigo_funcao'])->first();
            
                $prodFuncao->descricao_funcao = $descricao->descricao_funcao;

            }

            $prodFuncao->save();

            if (!$prodFuncao) {
                throw new Exception("Falha ao salvar funcao do produto.");
            }
        }

        return ;
    }

    public static function alterarProdutoBKP($data, $codigo_produto)
    {
        // $data = (Object)$data;

        // Buscar o produto existente pelo código do produto
        $produtoExistente = ProdutosLocal::where('codigo_produto', $codigo_produto)->first();
    
        if ($produtoExistente) {
            if (!empty($produtoExistente->caminho_arquivo) && Storage::exists($produtoExistente->caminho_arquivo)) {
                Storage::delete($produtoExistente->caminho_arquivo);
            }
    
            $produtoExistente->nome_produto = $data->nome_produto;
            $produtoExistente->codigo_produto = $data->codigo_produto;
            $produtoExistente->subtitulo = $data->subtitulo;
            $produtoExistente->modo_acao = $data->modo_acao;
            $produtoExistente->variantes = $data->variantes;
            $produtoExistente->caminho_arquivo = $data->caminho_arquivo;
            $data->slug ? $produtoExistente->slug = $data->slug : $produtoExistente->slug = null;
            $data->linha ? $produtoExistente->linha = $data->linha :$produtoExistente->linha = null;
            $data->funcao ? $produtoExistente->funcao = $data->funcao : $produtoExistente->funcao = null;
            $produtoExistente->save();
    
            return $produtoExistente;
        } else {
            // $produto = new ProdutosLocal();
            $produtoExistente->nome_produto = $data->nome_produto;
            $produtoExistente->codigo_produto = $data->codigo_produto;
            $produtoExistente->subtitulo = $data->subtitulo;
            $produtoExistente->modo_acao = $data->modo_acao;
            $produtoExistente->variantes = $data->variantes;
            $produtoExistente->caminho_arquivo = $data->caminho_arquivo;
            $data->slug ? $produtoExistente->slug = $data->slug : $produtoExistente->slug = null;
            $data->linha ? $produtoExistente->linha = $data->linha : $produtoExistente->linha = null;
            $data->funcao ? $produtoExistente->funcao = $data->funcao : $produtoExistente->funcao = null;
            $produtoExistente->save();
    
            return $produtoExistente;
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
            // $doc->arquivo = DB::raw("decode('" . base64_encode($documento) . "', 'base64')");  //Para PostgreSQL
            $doc->arquivo = base64_encode($documento);   // Para MySQL
            $doc->produto_id = $produtoLocal->id;
            $doc->nome_arquivo = $nomeArquivo;
            $doc->save();
        }

        return $doc;
    }

    public static function exibirArquivo(int $id)
    {
        $arquivo = ProdutosLocal::find($id);
        $filePath = $arquivo->caminho_arquivo;
        
        if (Storage::disk('public')->exists($filePath)) {
            $mimeType = Storage::disk('public')->mimeType($filePath);  // Detecta o tipo MIME correto da imagem
            return Storage::disk('public')->download($filePath, $arquivo->caminho_arquivo, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $arquivo->caminho_arquivo . '"'
            ]);
        } else {
            return response()->json(['error' => 'Arquivo não encontrado.'], 404);
        }
    }

    public static function atualizarProdutoAtivoSite(array $data)
    {
        foreach($data as $produto) {
            if($produto->ATIVO_SITE != null){
                $produtoUpdt = ProdutosLocal::where('codigo_produto', $produto->ID)->first();
                $produtoUpdt->ativo_site = $produto->ATIVO_SITE;
                $produtoUpdt->save();
    
                // return $produtoUpdt;
            }
        }

        return 'success';
    }

    public static function existeProdutoLocal($data)
    {
        $data = (Object)$data['produto'];
        $produto = ProdutosLocal::where('codigo_produto', $data->codigo_produto)->first();

        if($produto){
            ProdutosLocal::where('codigo_produto', $data->codigo_produto)->delete();
            ProdLinha::where('codigo_produto', $data->codigo_produto)->delete();
            ProdFuncao::where('codigo_produto', $data->codigo_produto)->delete();
            VariantesProduto::where('codigo_produto', $data->codigo_produto)->delete();
        }
        
        return;
    }
}
