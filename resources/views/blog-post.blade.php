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
                    <li class="breadcrumb-item">
                        <a href="{{ route('blog') }}" class="text-decoration-none" title="Blog">Blog</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post['titulo'] }}</li>
                  </ol>
                </nav>
        
              </div>
              <div class="mb-4 linha_marcador">
                <h1 class="marcador">{{ $post['titulo'] }}</h1>
              </div>
        
                {!! $post['texto' ] !!}
        
            </div>
        
        
          </main>

    @endsection
