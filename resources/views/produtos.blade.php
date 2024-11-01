@extends('layouts.app')

@section('content')

@include('components.ImageTop')
    <main>

        <div class="container mt-5">
            <div class="bg-light small">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" title="Home">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('linhas') }}" class="text-decoration-none" title="Linhas de Produtos">Linhas de Produtos</a></li> 
                        @if ($linha)
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($linha) }}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                        @endif
                        
                    </ol>
                </nav>

            </div>

            <div class="mb-4 linha_marcador">
                @if ($linha)
                    <h1 class="marcador">Linha de Produtos: {{ Str::ucfirst($linha) }}</h1>
                @else
                    <h1 class="marcador">Produtos</h1>
                @endif
            </div>

            <div>
                <form method="GET" action="{{ route('produtos') }}" class="row g-3" id="filtro-produto-form" >
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Produto</label>
                        <input type="text" class="form-control" name="termo" id="termo" placeholder="informe o nome do produto" value="{{ $pesquisa['termo'] ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label for="linhas" class="form-label">Linha</label>
                        <select id="linhas" name="linhas" class="form-select">
                            <option value="">Selecione ...</option>
                            <?php
                                if(isset($linhas)) {
                                    foreach ($linhas as $key => $lin) {
                                        
                                        $selected = '';
                                        if (($pesquisa['linha'] == Str::slug($lin['DESCRICAO'])) || (Str::slug($lin['DESCRICAO']) == $linha)) {
                                            $selected = 'selected';
                                        }

                                ?>
                                <option value="<?=Str::slug($lin['DESCRICAO']);?>" {{ $selected }}><?=$lin['DESCRICAO']?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>


                    <div class="col-md-3">
                        <label for="funcoes" class="form-label">Função</label>
                        <select id="funcoes" name="funcoes" class="form-select">
                            <option value="">Selecione ...</option>
                            <?php
                                if(isset($funcoes)) {
                                    foreach ($funcoes as $key => $fun) {

                                        $selected = '';
                                        if (($pesquisa['funcao'] == Str::slug($fun['DESCRICAO'])) || (Str::slug($fun['DESCRICAO']) == $funcao)) {
                                            $selected = 'selected';
                                        }


                                ?>
                                <option value="<?=Str::slug($fun['DESCRICAO'])?>" {{ $selected }}><?=$fun['DESCRICAO']?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-md-2 mt-0">
                        <button type="submit" class="btn btn-warning w-100 my-5">Filtrar</button>
                    </div>
                </form>
            </div>

            <div id="produtos" class="row row row-cols-1 row-cols-md-4 row-cols-sm-2 g-4 pb-5 mt-5">

                @if($products->isNotEmpty())
                    @foreach ($products as $product)

                    <div class="card h-100 border-0 shadow">

                        <img loading="lazy" src="{{ getImagePath($product['slug']) }}" alt="{{ $product['nome'] }}" title="{{ $product['nome'] }}">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <p class="">{{ $product['slug'] }}</p>
                                <a href="{{ route('produto', ['slug' => $product['slug']]) }}" class="btn btn-warning " title="{{ Str::ucfirst($product['nome']) }}">Ver Produto</a>

                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <p>Nenhum produto encontrado.</p>
            @endif

            </div>

        </div>
    </main>

@endsection

<script src="{{ asset('js/produto.js') }}"></script>