<?php

namespace App\Http\Controllers;

use App\Http\Resources\SitePostagemResource;
use App\Http\Resources\SitePostagemShowResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

// use App\Models\ConfigurarPDF;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;
use App\Models\Entity\ConfiguracaoPages;
use App\Models\Facade\FirebirdDB;
use App\Models\Facade\ProdutosLocalDB;
use App\Models\Facade\SitePostagemDB;
use App\Models\Regras\ConfigurarPDF;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $params = (Object)$request->all();

        if (app()->environment('local')) {
            $default = 'http://srcs.parquimica.com.br/api';
    
            $blog = collect(Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/area-restrita/blog/postagem/grid")->json());
        } else {
            $postagensSite = SitePostagemDB::getPostagensBlog($params);
    
            $blog = SitePostagemResource::collection($postagensSite);
        } 
        
        $seo = seoTags();

        return view('home', compact('blog', 'seo'));
    }

    public function empresa()
    {
        $default = 'http://srcs.parquimica.com.br/api';

        if (app()->environment('local')) {
            $response = Http::timeout(60)->withOptions(['verify' => false])->get(env('API_URL', $default) . "/area-restrita/site/postagem/show/3");

            $page = $response->json();
        } else {
            $postagem = ConfiguracaoPages::find(3);
            $page = new SitePostagemShowResource($postagem);
        }

        $seo = seoTags('empresa');

        return view('empresa', compact('page', 'seo'));
    }

    public function certificacoes()
    {
        $default = 'http://srcs.parquimica.com.br/api';

        if (app()->environment('local')) {
            $response = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/area-restrita/site/postagem/show/2");

            $page = $response->json();
        } else {
            $postagem = ConfiguracaoPages::find(2);

            $page = new SitePostagemShowResource($postagem);
        }   

        $seo = seoTags('certificacoes');

        return view('certificacoes', compact('page', 'seo'));
    }

    public function contato(Request $request)
    {

        $tags = [
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('contato', $tags);

        return view('contato', compact('seo'));
    }

    public function cotacao(Request $request)
    {
        $params = (Object)$request->all();
        $default = 'http://srcs.parquimica.com.br/api';

        if (app()->environment('local')) {
            $linhas = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/linhas")->json();
            
            $products = collect(Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-lista")->json());
        } else {
            $linhas = json_decode(json_encode(FirebirdDB::linhas($params)), true);
            
            $products = json_decode(json_encode(ProdutosLocalDB::getProdutosTodos($params)), true);
        }  
        
        $tags = [
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('cotacao', $tags);

        return view('cotacao', compact('linhas', 'products', 'seo'));
    }

    public function blog(Request $request)
    {
        $default = 'http://srcs.parquimica.com.br/api';
        $params = (Object)$request->all();

        if (app()->environment('local')) {
            
            $blog = collect(Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/area-restrita/blog/postagem/grid")->json());

        } else {
            $postagensSite = SitePostagemDB::getPostagensBlog($params);
    
            $blog = SitePostagemResource::collection($postagensSite);
        }  
        
        $tags = [
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('blog', $tags);

        return view('blog', compact('blog', 'seo'));
    }

    public function post(Request $request, $slug)
    {
        $params = (Object)$request->all();
        $default = 'http://srcs.parquimica.com.br/api';

        $codigo = strtok($slug, '-');

        if (isset($codigo)) {
            // $params = "?codigo_produto={$codigo}";
            $params->codigo_produto = $codigo;
        }

        if (app()->environment('local')) {
            
            $post = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/area-restrita/blog/postagem/show/{$codigo}")->json();

            // $post = $post['data'][0];
        } else {
            
            $post = collect(json_decode(json_encode(ConfiguracaoPages::find($params->codigo_produto))));
        
        }  

        $tags = [
            'title' => $post['titulo'],
            'description' => substr(strip_tags($post['texto']),0,100),
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('post', $tags);

        return view('blog-post', compact('post', 'seo'));
    }

    public function linhas(Request $request)
    {
        $params = (Object)$request->all();

        $default = 'http://srcs.parquimica.com.br/api';
        
        if (app()->environment('local')) {
            
            $linhas = collect(Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/linhas")->json());

        } else {

            $linhas = collect(json_decode(json_encode(FirebirdDB::linhas($params)), true));
        
        }  


        $tags = [
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('linhas', $tags);

        return view('linhas', compact('linhas', 'seo'));
    }

    public function funcoes(Request $request)
    {
        $params = (Object)$request->all();

        $funcoes = collect(json_decode(json_encode(FirebirdDB::funcoes($params)), true));

        $tags = [
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('funcoes', $tags);

        return view('funcoes', compact('funcoes', 'seo'));
    }

    public function produtos(Request $request, $linha = null, $funcao = null)
    {
        $default = 'http://srcs.parquimica.com.br/api';
        $params = (Object)$request->all();

        if (app()->environment('local')) {
            
            $linhas = collect(Http::withOptions(['verify' => false])->timeout(30)->get(env('API_URL', $default)."/firebird/linhas")->json());
            $funcoes = collect(Http::withOptions(['verify' => false])->timeout(30)->get(env('API_URL', $default)."/firebird/funcoes")->json());
        } else {
            $linhas = collect(json_decode(json_encode(FirebirdDB::linhas($params)), true));
            
            $funcoes = collect(json_decode(json_encode(FirebirdDB::funcoes($params)), true));
        
        }  

        $queryParams = array_filter($request->all(), function ($value) {
            return $value !== null && $value !== '';
        });
        
        // var_dump($queryParams);die;
        $page = 'produtos';

        if (app()->environment('local')) {
            $params = '?ordem=asc';
        } else {
            $params = new \stdClass();
        }  


        if (!empty($queryParams)) {
            $page = 'pesquisa';
            $tags['pesquisa'] = $queryParams;

            if (!empty($queryParams['termo'])) {
                if (app()->environment('local')) {
                    $params .= "&nome={$queryParams['termo']}";
                } else {
                    $params->nome = $queryParams['termo'];
                }  
            }
    
            if (!empty($queryParams['linhas'])) {
                if (app()->environment('local')) {
                    $params .= "&slug_linha={$queryParams['linhas']}";
                } else {
                    $params->slug_linha = $queryParams['linhas'];
                }  
            }
    
            if (!empty($queryParams['funcoes'])) {
                if (app()->environment('local')) {
                    $params .= "&slug_funcao={$queryParams['funcoes']}";
                } else {
                    $params->slug_funcao = $queryParams['funcoes'];
                }  
            }
        }
        
        if ($linha) {
            if (app()->environment('local')) {
                $params .= "&slug_linha={$linha}";
            } else {
                $params->slug_linha = $linha;
            }  
            $page = 'linha';
            $tags['linha'] = $linha;
        }

        if ($funcao) {
            if (app()->environment('local')) {
                $params .= "&slug_funcao={$funcao}";
            } else {
                $params->slug_funcao = $funcao;
            } 
            $page = 'funcao';
            $tags['funcao'] = $funcao;
        }

        if (app()->environment('local')) {
            $products = collect(Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-lista{$params}")->json());
        } else {
            $products = collect(json_decode(json_encode(FirebirdDB::siteProdLista($params)), true));
        } 

        $tags['url'] = $request->fullUrl();

        $seo = seoTags($page, $tags);

        $pesquisa = array(
            'termo' => $request['termo'],
            'linha' => $request['linhas'],
            'funcao' => $request['funcoes']
        );

        $data = ['products', 'linhas', 'funcoes', 'pesquisa', 'seo', 'linha', 'funcao'];

        return view('produtos', compact($data));
    }

    public function produto(Request $request, $slug)
    {
        $default = 'http://srcs.parquimica.com.br/api';

        if (app()->environment('local')) {
            $params = '';
            $params2 = '';

            if (isset($slug)) {
                $codigo = strtok($slug, '-');
                $params = "?id_base={$codigo}";
            }
        } else {
            $params = new \stdClass();
            $params2 = new \stdClass();
            if (isset($slug)) {
                $params->slug = $slug;
            }
        } 

        if (app()->environment('local')) {
            $prod = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-lista{$params}")->json();

            $prod = $prod[0];
            
            $params2 = '?id_base='.$prod['id_base'];
            // dd($params2);
            $produto = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-detalhes{$params2}")->json();

            $variantes = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-variantes{$params2}")->json();

        } else {
            $prod = collect(json_decode(json_encode(FirebirdDB::siteProdLista($params)), true));
        
            $prod = $prod[0];
            
            $params2->id_base = $prod['id_base'];
        
            $produto = collect(json_decode(json_encode(FirebirdDB::siteProdDetalhes($params2)), true));

            $variantes = collect(json_decode(json_encode(FirebirdDB::siteProdVariantes($params2)), true));
        } 

        $produto = $produto[0];
        $produto['variantes'] = $variantes;
        $produto['SLUG'] = $slug;
        
        // var_dump($produto);die;

        $produto['imagens'] = allImageProduct($prod['id_base']);

        // var_dump($produto);die;

        $tags = [
            'title' => $produto['NOME'],
            'description' => $produto['DESCRICAO'],
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('produto', $tags);

        return view('produto', compact('produto', 'seo'));
    }

    public function produtofb(Request $request, $slug)
    {
        $codigo = strtok($slug, '-');
        
        $default = 'http://srcs.parquimica.com.br/api';

        if (app()->environment('local')) {
            $params = '';
 
            if (isset($codigo)) {
                $params = "?id_base={$codigo}";
            }

            $produto = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-detalhes{$params}")->json();

            $variantes = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/site-prod-variantes{$params}")->json();
            
            // $produto = $produto['data'][0];
        } else {
            $params = new \stdClass();
            
            if (isset($codigo)) {
                $params->id_base = $codigo;
            }
        
            $produto = collect(json_decode(json_encode(FirebirdDB::siteProdDetalhes($params)), true));
            
            $variantes = collect(json_decode(json_encode(FirebirdDB::siteProdVariantes($params)), true));
            
        } 
        
        $produto['variantes'] = $variantes;

        $tags = [
            'title' => $produto['NOME'],
            // 'description' => $produto['subtitulo'],
            'url' => $request->fullUrl(),
        ];

        $seo = seoTags('produto', $tags);

        return view('produto-fb', compact('produto', 'seo'));
    }

    public function fichaTecnica(Request $request, $slug) 
    {
        set_time_limit(300);

        $default = 'http://srcs.parquimica.com.br/api';

        $codigo = strtok($slug, '-');

        if (app()->environment('local')) {
            $params = '';

            if (isset($codigo)) {
                $params = "?codigo_produto={$codigo}";
            }
            
            $literatura = Http::withOptions(['verify' => false])->get(env('API_URL', $default)."/firebird/literatura/{$codigo}")->json();

            $pdf = ConfigurarPDF::configurar('pdf.ficha-tecnica', ['literatura' => $literatura])->setPaper('a4', 'portrait');
            $pdf->save("pdf/ficha-tecnica-{$slug}.pdf");

            return $pdf->stream("ficha-tecnica-{$slug}.pdf", ['Attachment' => 0]);

        } else {
            $params = new \stdClass();

            if (isset($codigo)) {
                $params->codigo_produto = intval($codigo);
            }
            
            $literatura = FirebirdDB::literatura($params);

            $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('literatura'));
            
            return $pdf->setPaper('a4', 'portrait')->stream();
        } 
    }

    public function enviar(Request $request, $form = null)
    {
        // Validação dos campos do formulário
        if ($form == 'contato') {
            $request->validate([
                'nome' => 'required',
                'email' => 'required|email',
                'telefone' => 'required',
                'departamento' => 'required',
                'assunto' => 'required',
                'mensagem' => 'required',
            ]);
    
            $destinatario = departamento($request->input('departamento'));
    
            $details = [
                'template' => 'emails.contact',
                'subject' => $request->input('nome'). ' entrou em contato | Site Parquimica Indústria',
                'from' => 'site@parquimica.com.br',
                'from-name' => 'Parquimica Indústria',
                'to' => $destinatario['para'], // Destinatário principal
                'to-name' => $destinatario['departamento'],
                'body' => $request->all()
            ];
        } elseif ($form == 'cotacao') {
            $request->validate([
                'nome' => 'required',
                'empresa' => 'required',
                'email' => 'required|email',
                'telefone' => 'required',
                'cnpj' => 'required',
                'linhas' => 'required',
                'produtos' => 'required',
                'volume' => 'required',
                'finalidade' => 'required',
            ]);
    
            $details = [
                'template' => 'emails.cotacao',
                'subject' => $request->input('nome'). ' solicitou uma cotação | Site Parquimica Indústria',
                'from' => 'site@parquimica.com.br',
                'from-name' => 'Parquimica Indústria',
                'to' => 'vendas@parquimica.com.br', // Destinatário principal
                'to-name' => 'Setor de Vendas',
                'body' => $request->all()
            ];
        } elseif ($form == 'produto') {
            $request->validate([
                'nome' => 'required',
                'empresa' => 'required',
                'email' => 'required|email',
                'telefone' => 'required',
                'produto' => 'required',
                'mensagem' => 'required',
            ]);
    
            $details = [
                'template' => 'emails.produto',
                'subject' => $request->input('nome'). ' solicitou informações de produto | Site Parquimica Indústria',
                'from' => 'site@parquimica.com.br',
                'from-name' => 'Parquimica Indústria',
                'to' => 'vendas@parquimica.com.br', // Destinatário principal
                'to-name' => 'Setor de Vendas',
                'body' => $request->all()
            ];

        }

        try {
            // Envia o e-mail usando a Mail class
            Mail::to($details['to'], $details['to-name'])->send(new ContactMail($details));

            // Retorna com uma mensagem de sucesso
            if ($form == 'produto')
                return redirect()->route($form, ['slug' => $request->input('produto')])->with('success', 'Mensagem enviada com sucesso!');
            else
                return redirect()->route($form)->with('success', 'Mensagem enviada com sucesso!');
        } catch (Exception $e) {
            // Em caso de erro, retorna uma mensagem de erro
            return redirect()->route($form)->with('error', 'Ocorreu um erro ao enviar a mensagem. '.$e);
        }
    }

    public function teste()
    {
        $response = Http::withOptions(['verify' => false])->get('http://srcs.parquimica.com.br/api/area-restrita/site/postagem/show/3');

        return response()->json($response->json());

    }
}
