<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Catalogo\CatalogoResource;
use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Facade\FirebirdDB;
use App\Models\Regras\ProdutosLocalRegras;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $parametros = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtoLocal = ProdutosLocalRegras::cadastrar($parametros);
            DB::commit();
            return response($produtoLocal);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $codigo_produto)
    {
        $params = (Object)$request->all();
        $params->codigo_produto = $codigo_produto;
        try {
            DB::beginTransaction();
            $literaturas = FirebirdDB::literatura($params);
            DB::commit();
            return response($literaturas);
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
    public function update(Request $request, ProdutosLocal $produtoLocal)
    {
        $data = $request->validate();
        try {
            DB::beginTransaction();
            $produtoLocal->update($data);
            $produtoLocal->fresh();
            DB::commit();
            return response($produtoLocal);
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
}
