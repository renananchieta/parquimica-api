<?php

namespace App\Http\Controllers\Seguranca;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seguranca\SegPerfilRequest;
use App\Http\Resources\Seguranca\SegPerfilResource;
use App\Models\Seguranca\SegPerfil;
use App\Models\Seguranca\SegPerfilDB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = (Object)$request->all();
        $data = SegPerfilDB::gridPerfis($params);
        return response(SegPerfilResource::collection($data),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SegPerfilRequest $request)
    {
        $data = $request->valid();
        try {
            DB::beginTransaction();
            $perfil = SegPerfil::create($data);
            DB::commit();
            return response([
                'message' => 'Perfil cadastrado com sucesso.',
                'data' => $perfil,
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response([
                'erro' => 'Erro ao tentar realizar esta operação.', 
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SegPerfil $perfil)
    {
        return response(new SegPerfilResource($perfil), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SegPerfilRequest $request, SegPerfil $perfil)
    {
        $data = $request->valid();
        try {
            DB::beginTransaction();
            $perfil->update($data);
            $perfil->fresh();
            DB::commit();
            return response(new SegPerfilResource($perfil), 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response([
                'erro' => 'Erro ao tentar realizar esta operação.', 
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SegPerfil $perfil)
    {
        try{
            DB::beginTransaction();
            $perfil->delete();
            DB::commit();
            return response('Operação realizada com sucesso', 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response([
                'erro' => 'Erro ao tentar realizar esta operação.', 
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }
}
