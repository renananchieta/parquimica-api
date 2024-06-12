<?php

namespace App\Http\Controllers\Seguranca;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seguranca\SegPerfilRequest;
use App\Http\Resources\Seguranca\SegPerfilResource;
use App\Models\Seguranca\PerfilRegras;
use App\Models\Seguranca\SegAcaoDB;
use App\Models\Seguranca\SegPerfil;
use App\Models\Seguranca\SegPerfilDB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perfis = SegPerfilDB::comboPerfil(Auth::user());
        $acoesDestaque = SegAcaoDB::listaAcoesDestaque();
        $grupos = $acoesDestaque->orderBy('grupo');
        return response([
            'perfis' => $perfis,
            'acoes' => $acoesDestaque,
            'grupos' => $grupos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $usuario = Auth::user();
        return response([
            'destaque' => PerfilRegras::telaCadastro($usuario)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function grid(Request $request)
    {
        $p = (object)$request->all();
        return response(SegPerfilDB::grid($p));
    }

    public function store(Request $request)
    {
        $dados = (object)$request->validate([
            'perfil' => 'required',
            'permissoes' => 'array'
        ]);

        DB::beginTransaction();
        try {

            $perfil = PerfilRegras::cadastrar($dados);
            DB::commit();

            return response([
                'message' => 'Perfil criado com sucesso',
                'perfil' => $perfil->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response(['message' => $e->getMessage()], 500);
        }
    }

    public static function edit($perfil_id)
    {
        $p = new \stdClass();
        $p->id = $perfil_id;
        $p->usuario = Auth::user();

        return response(PerfilRegras::telaEdicao($p));
    }

    public function update(Request $request)
    {
        $dados = (object)$request->validate([
            'id' => 'required',
            'nome' => 'required',
            'permissoes' => 'array'
        ], [
            'id.required' => 'Não foi possível identificar o ID do perfil para edição'
        ]);

        DB::beginTransaction();
        try {
            PerfilRegras::atualizar($dados);

            DB::commit();
            return response([
                'message' => 'Perfil atualizado com sucesso'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 500);        }
    }

    public function delete(SegPerfil $perfil)
    {
        DB::beginTransaction();
        try {

            PerfilRegras::excluir($perfil);

            DB::commit();
            return response([
                'message' => 'Perfil excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => $e->getMessage()], 500);        }
    }
}
