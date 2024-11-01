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
                        <li class="breadcrumb-item active" aria-current="page">{{ $produto['nome'] }}</li>
                    </ol>
                </nav>

            </div>

            <div class="mb-4 linha_marcador">
                <h1 id="nome-produto" class="marcador">{{ $produto['nome'] }}</h1>
            </div>

            <div class="row produto-detalhes my-5">

                <div class="descricao-produto col-lg-8">

                    <div class="mb-2">{!! $produto['subtitulo'] !!}</div>

                    <div class="acao mb-2">

                        <h2>Download</h2>

                        <a href="{{ route('literatura', ['slug' => Str::slug($produto['id'].'-'.$produto['nome'])]) }}" id="ficha-link" target="_blank" class="btn btn-warning btn-lg px-5 text-white mb-2" title="Ficha Técnica - {{ $produto['nome'] }}">Ficha Técnica <img class="pl-2" src="{{ asset('img/icons/pdf.svg') }}" alt="icon-pdf" title="icon-pdf"></a>

                        <a href="https://wa.me/5591981199504/?text=Olá! Desejo obter mais informações do produto {{ $produto['nome'] }}!" id="wp-link" target="_blank" class="btn btn-warning btn-lg px-5 text-white mb-2" title="FISPQ">FISPQ <img class="pl-2" src="{{ asset('img/icons/chat.svg') }}" alt="icon-chat" title="icon-title"></a>
                    </div>

                    <div>
                        <h2>Modo de Ação</h2>
                        {{-- <p>{!! $produto['modo_acao'] !!}</p> --}}
                        <hr>
                        <h2>Recomendação de Diluição</h2>
                        {{-- <p>{!! $produto['recomendacao'] !!}</p> --}}
                        <hr>
                        <h2>Variantes deste Produto</h2>
                        {{-- <p>{!! $produto['variantes'] !!}</p> --}}
                    </div>

                </div>

                <div class="produto-image col-lg-4">

                    <figure class="figure">
                        <img class="figure-image img-responsive rounded" src="{{ getImagePath($produto['nome']) }}" alt="{{ $produto['nome'] }}" title="{{ $produto['nome'] }}" width="100%" height="auto" >
                        <figure-caption class="figure-caption text-justify">
                            <img loading="lazy" src="{{ asset('img/icons/camera.svg') }}" class="mr-2" alt="icon-camera" title="icon-camera" width="11" height="11" > {{ $produto['nome'] }} <em>(Image ilustrativa)</em>
                        </figure-caption>
                    </figure>
                </div>
            </div>

            <div class="row">

                <div class="card mb-5">
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

                                <div class="col mb-3">
                                    <label for="sobrenome" class="form-label">Sobrenome (obrigatório)</label>
                                    <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                                aria-describedby="textHelp" placeholder="Escreva seu sobrenome...">

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
                                <label for="empresa" class="form-label">Nome da Empresa (obrigatório)</label>
                                <input type="text" class="form-control" id="empresa" name="empresa" aria-describedby="textHelp"
                placeholder="Escreva o nome da empresa...">

                            </div>

                            <div class="col">
                                <input type="hidden" name="produto" id="produto" value="{{ $produto['nome'] }}">
                            </div>
                            <button type="submit" class="btn btn-warning w-100 my-5" name="enviar" id="enviar">Enviar mensagem</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </main>

    @endsection
