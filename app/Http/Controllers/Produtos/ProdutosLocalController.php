<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutosLocalRequest;
use App\Http\Resources\Catalogo\CatalogoResource;
use App\Jobs\MigrarProdutosJob;
use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Facade\FirebirdDB;
use App\Models\Facade\ProdutosLocalDB;
use App\Models\Regras\ProcessamentoDeDadosRegras;
use App\Models\Regras\ProdutosLocalRegras;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProdutosLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parametros = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtosLocal = ProdutosLocalDB::getProdutosTodos($parametros);
            DB::commit();
            return response($produtosLocal);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function gridProdutos(Request $request)
    {
        $parametros = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtosLocal = ProdutosLocalDB::getProdutosTodos($parametros);
            DB::commit();
            return response($produtosLocal);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function comboProdutos()
    {
        try {
            DB::beginTransaction();
            $comboProdutos = ProdutosLocalDB::getComboProdutos();
            DB::commit();
            return response($comboProdutos);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::grid($params);
            DB::commit();
            return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutosLocalRequest $request)
    {
        $data = $request->valid();
        try {
            DB::beginTransaction();
            $produtoLocal = ProdutosLocalRegras::salvarProduto($data);
            ProdutosLocalRegras::salvarVariantes($data, $produtoLocal);
            // $arquivo = ProdutosLocalRegras::upload($data, $produtoLocal);
            DB::commit();
            return response([
                'data' => $produtoLocal,
                'message' => 'Registro salvo com sucesso!'
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $codigo_produto)
    {
        try {
            DB::beginTransaction();
            $produtoLocal = ProdutosLocalDB::getProdutoLocal($codigo_produto);
            DB::commit();
            return response($produtoLocal);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function showArquivo(int $produto_id)
    {
        return ProdutosLocalRegras::exibirArquivo($produto_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutosLocalRequest $request, $codigo_produto)
    {
        $data = $request->valid();

        $data = (Object)$data;

        try {
            DB::beginTransaction();
            if ($request->hasFile('arquivo')) {
                $arquivo = $request->file('arquivo');
    
                $caminhoArquivo = $arquivo->store('produtos', 'public');
    
                $data->caminho_arquivo = $caminhoArquivo;
            }
            $produtoAlterado = ProdutosLocalRegras::alterarProduto($data, $codigo_produto);
            // ProdutosLocalRegras::alterarVariantes($data, $produtoLocal);
            DB::commit();
            return response(['message' => 'Produto Alterado com sucesso!']);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function updateAtivoSite(Request $request)
    {
        $params = (Object)$request->all();
        try{
            DB::beginTransaction();
            $produtosFireBird = FirebirdDB::grid2($params);
            $produtoUpdt = ProdutosLocalRegras::atualizarProdutoAtivoSite($produtosFireBird);
            DB::commit();
            return response($produtoUpdt);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cadastrarProdutosBaseLocal(Request $request)
    {
        // $produtoSalvoBaseLocal = ProcessamentoDeDadosRegras::salvarProdutosDoFirebirdNaBaseLocal();

        // return response()->json($produtoSalvoBaseLocal);

        MigrarProdutosJob::dispatch();
        return response(['message' => 'Job para Migrar produtos foi despachado.']);
    }

    public function consultaTeste()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://srcs.parquimica.com.br/api/area-restrita/produtos/base-local');

        if ($response->successful()) {
            $produtos = $response->json(); 

            foreach($produtos as $produto) {
                // dd($produto);

                $produtoLocal = new ProdutosLocal();
                $produtoLocal->codigo_produto = $produto['codigo_produto'];
                $produtoLocal->nome_produto = $produto['nome_produto'];
                $produtoLocal->subtitulo = $produto['subtitulo'];
                $produtoLocal->modo_acao = $produto['modo_acao'];
                $produtoLocal->recomendacao = $produto['recomendacao'];
                $produtoLocal->slug = $produto['slug'];
                $produtoLocal->ativo_site = $produto['ativo_site'];
                $produtoLocal->variantes = $produto['variantes'];
                $produtoLocal->linha = $produto['linha'];
                $produtoLocal->funcao = $produto['funcao'];
                $produtoLocal->save();

            }
            
            return response()->json(['Sucessc' => 'Produtos Salvos na Base Local.'], $response->status());;
        }

        return response()->json(['error' => 'Não foi possível consultar os produtos.'], $response->status());
    }
}
