<header>

    <div class="container">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark topo-inicial">
            <div class="container">
              <a class="navbar-brand" href="{{ route('/') }}" title="Parquimica Indústria">
                <img loading="lazy" src="{{ app()->environment('production') ? secure_asset('img/logo-parquimica.webp') : asset('img/logo-parquimica.webp') }}" width="200" height="100%" class="logo" alt="Parquimica Indústria" title="Parquimica Indústria">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
    
              <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
    
    
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('empresa') }}" title="A INDUSTRIA">A INDUSTRIA</a>
                  </li>
    
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos') }}" title="PRODUTOS">PRODUTOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('certificacoes') }}" title="CERTIFICAÇÕES">CERTIFICAÇÕES</a>
                  </li>
    
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog') }}" title="BLOG">BLOG</a>
                  </li> --}}
    
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                      data-bs-toggle="dropdown" aria-expanded="false">CONTATO</a>
                    <ul class="dropdown-menu submenu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('contato') }}" title="Fale Conosco">Fale Conosco</a></li>
                      <li><a class="dropdown-item" href="{{ route('cotacao') }}" title="Faça sua Cotação">Faça sua Cotação</a></li>
                    </ul>
                  </li>
                </ul>
    
                <div class="text-lg-end">
                  <a href="http://site.parquimica.com.br:8080/login" target="_blank" class="btn btn-warning btn-sm" title="Acessar Área Restrita">AREA RESTRITA</a>
                 {{-- <button type="button" class="btn btn-link  btn-sm">
                    <a href="#">
                      <img loading="lazy" src="img/flags/brazil.png" alt="">
                    </a>
                  </button>
                  <button type="button" class="btn btn-link  btn-sm">
                    <a href="#">
                      <img loading="lazy" src="img/flags/united-states.png" alt="">
                    </a>
                  </button> --}}
    
                </div>
    
    
              </div>
            </div>
        </div>


    </div>
</header>
