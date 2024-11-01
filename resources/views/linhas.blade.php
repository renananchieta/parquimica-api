@extends('layouts.app')

    @section('content')
        
        @include('components.ImageTop')

        <main>

            <div class="container mt-5">

                <div class="bg-light small">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="{{ route('home') }}" class="text-decoration-none" title="Home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Linhas de Produtos</li>
                      </ol>
                    </nav>
            
                  </div>

                <div class="mb-4 linha_marcador">
                    <h1 class="marcador">Linhas de Produtos</h1>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-4">

                    @if ($linhas->isNotEmpty())
                        @foreach ($linhas as $linha)
                          @if (in_array($linha['ID'], [1,10,19,24,30]))

                        <div class="col mb-3">
                            <div class="card border-0 shadow-sm">
                              <img loading="lazy" src="{{ asset('img/linhas/linha-'.Str::slug($linha['DESCRICAO']).'-min.webp') }}" class="card-img-top img-fluid img-linhas" width="197" height="auto" alt="Linha {{ Str::ucfirst($linha['DESCRICAO']) }}" title="Linha {{ Str::ucfirst($linha['DESCRICAO']) }}" />
                              <div class="card-body">
                          
                                  <p class="card-text"><strong>Linha {{ Str::ucfirst(Str::lower($linha['DESCRICAO'])) }}</strong></p>
                                  <a href="{{ route('produtos-linha', ['slug' => Str::slug($linha['DESCRICAO'])]) }}" class="btn btn-warning btn-sm" role="button" aria-disabled="true" title="Linha {{ Str::ucfirst($linha['DESCRICAO']) }}">Ver Produtos</a>
                          
                              </div>
                            </div>
                        </div>
        
                          @endif
                        @endforeach
                        
                        @else
                        <p>Nenhum linha encontrado.</p>
                    @endif
   
                </div>
            </div>
    
            {{-- <div class="py-3 d-flex justify-content-center">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div> --}}
    
        </main>

    @endsection
