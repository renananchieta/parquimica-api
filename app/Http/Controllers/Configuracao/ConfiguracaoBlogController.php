<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use App\Models\Entity\Configuracao\ConfiguracaoBlog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracaoBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = (Object)$request->all();
        try{
            DB::beginTransaction();
            $configPagina = ConfiguracaoBlog::create($params);
            DB::commit();
            return response([
                'message' => 'Cadastro realizado com sucesso.',
                'data' => $configPagina
            ], 201);
        }catch(Exception $e) {
            DB::rollBack();
            return response('Erro ao tentar salvar registro', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
