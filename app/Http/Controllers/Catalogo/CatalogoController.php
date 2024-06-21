<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Facade\FirebirdDB;
use App\Models\Firebird;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = Firebird::all();
            DB::commit();
            return response($catalogo);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function grid(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::grid($params);
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
            return response($catalogo);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function consulta(Request $request)
    {
        $params = (Object)$request->all();
        try {
            DB::beginTransaction();
            $catalogo = FirebirdDB::grid($params);
            DB::commit();
            return response($catalogo);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
