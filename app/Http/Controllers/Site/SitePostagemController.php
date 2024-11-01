<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SitePostagemRequest;
use App\Http\Resources\SitePostagemResource;
use App\Http\Resources\SitePostagemShowResource;
use App\Models\Entity\ConfiguracaoPages;
use App\Models\Facade\SitePostagemDB;
use App\Models\Regras\SitePostagemRegras;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SitePostagemController extends Controller
{
    public function index(Request $request)
    {
        $params = (Object)$request->all();

        $postagensSite = SitePostagemDB::getPostagensSite($params);

        return response(SitePostagemResource::collection($postagensSite), 200);
    }

    public function store(SitePostagemRequest $request)
    {
        $data = $request->valid();

        try{
            DB::beginTransaction();

            $postagem = SitePostagemRegras::salvarPostagemSite($data);

            DB::commit();

            return response([
                'data' => $postagem,
                'message' => 'Postagem criada com sucesso.'
            ], 201);

        } catch(Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(string $id)
    {
        $postagem = ConfiguracaoPages::find($id);

        return response(new SitePostagemShowResource($postagem), 200);
    }

    public function update(SitePostagemRequest $request, ConfiguracaoPages $postagemSite)
    {
        $data = $request->valid();

        try {
            DB::beginTransaction();
            $postagemSite->update($data);
            $postagemSite->fresh();
            DB::commit();

            return response([
                'data' => new SitePostagemShowResource($postagemSite),
                'message' => 'Postagem alterada com sucesso.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(int $id)
    {
        ConfiguracaoPages::find($id)->delete();

        return response([
            'message' => 'Postagem deletada com sucesso.'
        ], 200);
    }

    public function testeRequisicao2()
    {
        $response1 = Http::withOptions([
            'verify' => false,
            'timeout' => 60,
        ])->get('https://srcs.parquimica.com.br/api/firebird/linhas');
    
        $response2 = Http::withOptions([
            'verify' => false,
            'timeout' => 60,
        ])->get('https://srcs.parquimica.com.br/api/firebird/funcoes');
    
        $response = [
            'linhas' => $response1->json(),
            'funcoes' => $response2->json()
        ];
    
        return response()->json($response); 
    }

    public function testeRequisicao()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://srcs.parquimica.com.br/api/firebird/linhas");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response1 = curl_exec($ch);
        curl_close($ch);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://srcs.parquimica.com.br/api/firebird/funcoes");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response2 = curl_exec($ch);
        curl_close($ch);

        return response()->json([
            'linhas' => json_decode($response1, true),
            'funcoes' => json_decode($response2, true),
        ]);
    }
}
