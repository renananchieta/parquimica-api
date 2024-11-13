@extends('layouts.app')

@section('content')

@include('components.ImageTop')
    <main>

        <div id="produto" class="container mt-5">
            <div class="bg-light small">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" title="Home">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('produtos') }}" class="text-decoration-none" title="Produtos">Produtos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $produto['NOME'] }}</li>
                    </ol>
                </nav>

            </div>

            <div class="mb-4 linha_marcador">
                <h1 id="nome-produto" class="marcador">{{ $produto['NOME'] }}</h1>
            </div>

            <div class="row produto-detalhes mb-5">

                <div class="descricao-produto col-lg-8">

                    <div class="mb-2">{!! $produto['DESCRICAO'] !!}</div>

                    <div class="acao mb-2">

                        <h2>Download</h2>

                        <a href="{{ route('literatura', ['slug' => $produto['SLUG']]) }}" id="ficha-link" target="_blank" class="btn btn-warning btn-lg px-5 text-white mb-2" title="Ficha Técnica - {{ $produto['NOME'] }}">Ficha Técnica <img class="pl-2" src="{{ asset('img/icons/pdf.svg') }}" alt="icon-pdf" title="icon-pdf"></a>

                        <a href="https://wa.me/5591981199504/?text=Olá! Desejo obter mais informações do produto {{ $produto['NOME'] }}!" id="wp-link" target="_blank" class="btn btn-warning btn-lg px-5 text-white mb-2" title="FISPQ">FISPQ <img class="pl-2" src="{{ asset('img/icons/chat.svg') }}" alt="icon-chat" title="icon-title"></a>
                    </div>

                    <div>
                        <h2>Modo de Ação</h2>
                        <p>{!! $produto['MODO_ACAO'] !!}</p>
                        <hr>
                        @if ($produto['DILUICAO'])
                            <h2>Recomendação de Diluição</h2>
                            <p><ul>{!! $produto['DILUICAO'] !!}</ul></p>
                            <hr>
                        @endif                        
                        
                        @if($produto['variantes'])
                            <h2>Variantes deste Produto</h2>
                            <p>
                                <ul>
                                    @foreach ($produto['variantes'] as $variante)
                                        <li>
                                            <strong>{{ $variante['NOME'] }}:</strong> {{ $variante['DESCRICAO'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </p>
                        @endif
                    </div>

                </div>

                <div class="produto-image col-lg-4">

                    <figure class="figure">
                        <img id="current-image" class="figure-image img-responsive rounded" src="{{ getImagePath($produto['ID']) }}" alt="{{ $produto['NOME'] }}" title="{{ $produto['NOME'] }}" width="100%" height="auto" >
                        <figure-caption class="figure-caption text-justify">
                            <img loading="lazy" src="{{ asset('img/icons/camera.svg') }}" class="mr-2" alt="icon-camera" title="icon-camera" width="11" height="11" > {{ $produto['NOME'] }} <em>(Image ilustrativa)</em>
                        </figure-caption>
                    </figure>

                    <div class="thumbnails">
                        <img src="{{ getImagePath($produto['ID']) }}" alt="{{ $produto['NOME'] }}" onclick="changeImage(this)" loading="lazy" class="rounded" />
                        @foreach ($produto['imagens'] as $imagem)
                            <img src="{{ asset('img/catalogo/variacoes/'.$imagem) }}" alt="{{ $produto['NOME'] }}" onclick="changeImage(this)" loading="lazy" class="rounded" />  
                        @endforeach
                      </div>

                </div>
            </div>

            <div class="row">

                <div class="card mb-5">
                    <div class="card-title mt-3">
                        Desejo fazer uma cotação do produto <strong>{{ $produto['NOME'] }}</strong>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form name="produto" id="produto" action="{{ route('enviar', ['form' => 'produto']) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nome" class="form-label">Nome (obrigatório)</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                aria-describedby="textHelp" placeholder="Escreva seu nome...">

                                </div>

                                
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="email" class="form-label">Email (obrigatório)</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="seuemail@empresa.com.br">

                                </div>

                                <div class="col mb-3">
                                    <label for="telefone" class="form-label">Telefone (obrigatório)</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone"
                                aria-describedby="textHelp" placeholder="(99) 99999-9999">

                                </div>
                            </div>

                            <div class="col">
                                <label for="mensagem" class="form-label">Mensagem (obrigatório)</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Escreva sua mensagem..."></textarea>

                            </div>

                            <div class="col">
                                <input type="hidden" name="produto" id="produto" value="{{ $produto['NOME'] }}">
                            </div>
                            <button type="submit" class="btn btn-warning w-100 my-5" name="enviar" id="enviar">Enviar mensagem</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </main>

    @endsection

    <script>
        function changeImage(element) {
            const mainImage = document.getElementById("current-image");

            // Remove as classes de animação se já existirem
            mainImage.classList.remove("fade-in");
            mainImage.classList.add("fade-out");

            // Após um curto período (igual ao tempo da transição), troca a imagem e faz o fade-in
            setTimeout(() => {
                mainImage.src = element.src;
                mainImage.classList.remove("fade-out");
                mainImage.classList.add("fade-in");
            }, 500); // O valor deve ser igual ao tempo da transição em CSS

            // Remove a classe 'active' de todas as miniaturas
            const thumbnails = document.querySelectorAll(".thumbnails img");
            thumbnails.forEach((thumb) => thumb.classList.remove("active"));

            // Adiciona a classe 'active' à miniatura clicada
            element.classList.add("active");
            }

    </script>