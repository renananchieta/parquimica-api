<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Http\Resources\Catalogo\CatalogoResource;
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
            return response(CatalogoResource::collection($catalogo), 200);
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
            // return response(CatalogoResource::collection($catalogo), 200);
            return response($funcoes);
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
}
