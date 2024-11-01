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
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                      </ol>
                    </nav>
            
                  </div>

                <div class="mb-4 linha_marcador">
                    <h1 class="marcador">Últimas notícias</h1>
                </div>
    
    
    
    
    
                <div class="row row-cols-1 row-cols-md-4 g-4">

                    @if ($blog->isNotEmpty())
                        @foreach ($blog as $post)

                        <div class="col">
                            <div class="card border-0 shadow-sm">
                              <img loading="lazy" src="{{ asset('img/empresa.webp') }}" class="card-img-top img-fluid" width="412" height="auto" alt="{{ $post['titulo'] }}" title="{{ $post['titulo'] }}" />
                              <div class="card-body">
                          
                                  <p class="card-text">{{ $post['titulo'] }}</p>
                                  <a href="{{ route('post', ['slug' => Str::slug($post['id'].'-'.$post['titulo'])]) }}" class="btn btn-warning btn-sm" role="button" aria-disabled="true" title="{{ $post['titulo'] }}">Leia mais</a>
                          
                              </div>
                            </div>
                        </div>
        
                            
                        @endforeach
                        
                        @else
                        <p>Nenhum post encontrado.</p>
                    @endif
                    
    
      
    
    
    </div>
    
    
    
    
    
    
            </div>
    
            <div class="py-3 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
            </div>
    
        </main>

    @endsection
