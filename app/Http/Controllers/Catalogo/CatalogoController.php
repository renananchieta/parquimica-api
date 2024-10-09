<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Http\Resources\Catalogo\CatalogoResource;
use App\Http\Resources\Catalogo\ComboProdutosResource;
use App\Http\Resources\Catalogo\FuncoesResource;
use App\Models\Facade\FirebirdDB;
use App\Models\Firebird;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function grid(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::grid($params);
            DB::commit();
            return response($catalogo, 200);
            return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function comboProdutos(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::comboProdutos($params);
            DB::commit();
            return response(ComboProdutosResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function linhas(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $linhas = FirebirdDB::linhas($params);
            DB::commit();
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($linhas);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function funcoes(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $funcoes = FirebirdDB::funcoes($params);
            DB::commit();
            return response(FuncoesResource::collection($funcoes), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function prodLinha(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $prodLinhas = FirebirdDB::prodLinha($params);
            DB::commit();
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($prodLinhas);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function prodFuncao(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $prodFuncao = FirebirdDB::prodFuncao($params);
            DB::commit();
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($prodFuncao);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function literatura(Request $request, int $codigo_produto)
    {
        $params = (Object)$request->all();
        $params->codigo_produto = $codigo_produto;
        try {
            DB::beginTransaction();
            $literaturas = FirebirdDB::literatura($params);
            DB::commit();
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($literaturas);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function literaturaTeste(Request $request, int $codigo_produto)
    {
        $params = (Object)$request->all();
        $params->codigo_produto = $codigo_produto;
        try {
            DB::beginTransaction();
            $literaturas = FirebirdDB::literaturaTeste($params);
            DB::commit();
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($literaturas);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function catalogoGridExportCsv(Request $request)
    {
        $params = (Object)$request->all();
        try{
            DB::beginTransaction();
            $catalogoExportCsv = FirebirdDB::exportarCsv($params);
            DB::commit();
            return response($catalogoExportCsv['content'], 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $catalogoExportCsv['filename'] . '"',
            ]);
        } catch(Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function consulta(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::consultaExtensa($params);
            DB::commit();
            return response($catalogo);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function grid2(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::grid2($params);
            DB::commit();
            return response($catalogo, 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function produtos(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtos = FirebirdDB::grid2($params);
            DB::commit();
            return response($produtos, 200);
            // return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function siteProdLista(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtos = FirebirdDB::siteProdLista($params);
            DB::commit();
            return response($produtos, 200);
            // return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
        
    }

    public function siteProdDetalhes(Request $request)
    {
        $params = (Object)$request->all();
        dd($params);
        try {
            DB::beginTransaction();
            $produtos = FirebirdDB::siteProdDetalhes($params);
            DB::commit();
            return response($produtos, 200);
            // return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function siteProdVariantes(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $produtos = FirebirdDB::siteProdVariantes($params);
            DB::commit();
            return response($produtos, 200);
            // return response(CatalogoResource::collection($catalogo), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

}
