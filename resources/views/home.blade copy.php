@extends('layouts.app')

@section('content')

<section>
    @include('components.banner')
</section>
      <main>
    
        <section>

          <div class="container linhas-section py-5">
    
            <div class="mb-4 linha_marcador mb-4">
              <h2 class="marcador fw-bold">Linha de Produtos</h2>
            </div>
            <p>Ao longo de mais de 40 anos de atuação, nossa Indústria se destaca no mercado desenvolvendo produtos
              especializados e focados nas áreas com maior demanda por soluções inovadoras na Região Norte do Brasil. Nossa
              variedade de produtos reflete esse compromisso, oferecendo produtos concentrados e de alta qualidade, capazes
              de remover sujidades intensas e comuns através de diferentes diluições, proporcionando economia e
              versatilidade. Por isso, estamos presentes em diversos segmentos do mercado.</p>
    
            <div class="row ">
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Naval')]) }}" title="Linha Naval">
                  <img loading="lazy" src="img/linhas/linha-naval-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha Naval" title="Linha Naval">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha Naval</h3>
                <p class="small text-secondary">Fornecemos produtos biodegradáveis específicos para manutenção
                  interna e externa de embarcações, assim como removedores para os resíduos de insumos transportados.
                </p>
              </div>
    
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Tratamento de Água')]) }}" title="Linha de Tratamento de Água">
                  <img loading="lazy" src="img/linhas/linha-tratamento-de-agua-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha de Tratamento de Água" title="Linha de Tratamento de Água">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha de Tratamento de Água</h3>
                <p class="small text-secondary">Focada em tratamento de Caldeiras, Efluentes e Sistemas de Refrigeração.
                </p>
              </div>
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Hospitalar')]) }}" title="Linha Hospitalar">
                  <img loading="lazy" src="img/linhas/linha-hospitalar-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha Hospitalar" title="Linha Hospitalar">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha Hospitalar</h3>
                <p class="small text-secondary">Fornecemos produtos para limpeza e desinfecção de áreas comuns,
                  para lavanderia profissional e esterilização de material cirúrgico.
                </p>
              </div>
    
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Mineração')]) }}" title="Linha de Mineração">
                  <img loading="lazy" src="img/linhas/linha-mineracao-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha de Mineração" title="Linha de Mineração">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha de Mineração</h3>
                <p class="small text-secondary">Uma de nossas principais linhas, contendo Desincrustantes e
                  Solventes de alta penetração para remoção de sujidades específicas deste ramo.
                </p>
              </div>
    
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Manutenção Industrial')]) }}" title="Linha de Manutenção Industrial">
                  <img loading="lazy" src="img/linhas/linha-industrial-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha de Manutenção Industrial" title="Linha de Manutenção Industrial">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha de Manutenção Industrial</h3>
                <p class="small text-secondary">Linha especializada na limpeza e manutenção do chão de fábrica,
                  incluindo tanques e maquinários de todo tipo de material.
                </p>
              </div>
    
              <div class="col-lg-2 col-md-3 col-sm-6">
                <a href="{{ route('produtos-linha', ['slug' => Str::slug('Limpeza Geral')]) }}" title="Linha de Limpeza Geral">
                  <img loading="lazy" src="img/linhas/linha-limpeza-geral-min.webp" class="img-fluid rounded img-linhas" width="197" height="147" alt="Linha de Limpeza Geral" title="Linha de Limpeza Geral">
                </a>
                <h3 class="fw-bold mt-2 mb-0">Linha de Limpeza Geral</h3>
                <p class="small text-secondary">Desenvolvida para o consumidor final, buscando atingir economia e
                  qualidade na limpeza do seu empreendimento ou lar.
                </p>
              </div>
            </div>
    
            <div class="d-flex justify-content-center py-3">
              <a href="{{ route('produtos') }}" class="btn btn-warning " title="Conheça nossas outras linhas">Conheça nossas outras linhas</a>
    
            </div>

          </div>
    
        </section>
    
        <section>
          <div class="empresa-section" style="background: url('{{asset('img/slide2-min.webp') }}') no-repeat center / cover;">
    
            <div class="container py-5">
              <div class="row">
    
                <div class="col-lg-7">
                  <div class="mb-4 linha_marcador">
                    <h2 class="marcador text-white fw-bold">Sobre a empresa</h2>
                  </div>
    
    
                  <p class="text-white">
                    Somos uma indústria 100% licenciada, nascida e criada na região metropolitana de Belém, comprometida com
                    a inovação e a constante melhoria de produtos e processos. Visitamos nossos clientes para entender suas
                    necessidades e desenvolver soluções específicas. Utilizando tecnologia de ponta e avaliando a eficácia
                    de cada produto no local, construímos uma marca que representa qualidade e confiança.
                  </p>
                  <a href="{{ route('empresa') }}" class="btn btn-warning btn-sm" title="Leia mais sobre a empresa">Leia mais</a>
    
                </div>
    
                <div class="col-lg-5">
                  <img loading="lazy" src="img/empresa-parquimica-industria-min.webp" class="img-fluid rounded mt-4" width="526" height="314" alt="Fachada da Empresa" title="Fachada da Empresa">
                </div>
              </div>
    
              <div class="row text-white">
    
                <div class="col-lg-3 col-md-6 col-sm-6 text-center my-2">
                  <h3><span class="h1 fw-bold">+</span> de <span class="h1 fw-bold number" data-number>40</span> anos de
                    mercado
                  </h3>
                </div>
    
                <div class="col-lg-3 col-md-6 col-sm-6 text-center my-2">
                  <h3><span class="h1 fw-bold">+</span> de <span class="h1 fw-bold number" data-number>4000</span> clientes
                    ativos</h3>
                </div>
    
                <div class="col-lg-3 col-md-6 col-sm-6 text-center my-2">
                  <h3><span class="h1 fw-bold">+</span> de <span class="h1 fw-bold number" data-number>3000</span> produtos
                  </h3>
                </div>
    
                <div class="col-lg-3 col-md-6 col-sm-6 text-center my-2">
                  <h3> <span class="h1 fw-bold">+</span> de <span class="h1 fw-bold number" data-number>20</span> linhas de
                    atuação</h3>
                </div>
    
              </div>
            </div>
    
          </div>
    
        </section>
    
        <section>

          <div class="container diferenciais-section py-5">
    
            <div class="mb-4 linha_marcador">
              <h2 class="marcador fw-bold">Diferenciais</h2>
            </div>
    
            <p>Nosso modelo de negócio é centrado na sustentabilidade, focando na reciclagem e reaproveitamento de insumos
              para minimizar o impacto ambiental, seguindo rigorosamente normas e diretrizes ecológicas.</p>
    
            <div class="row row-cols-1 row-cols-md-4 g-4 pb-5" style="justify-content: center;">
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-sustentabilidade.webp" alt="Sustentabilidade" title="Sustentabilidade" width="128" height="128">
                    <h3 class="fw-bold mt-2">Sustentabilidade</h3>
                    <p class="small">Adotamos rigorosas normas ambientais para reciclar e reaproveitar insumos, reduzindo
                      ao máximo o impacto no meio ambiente.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-produtos-biodegradaveis.webp" alt="Produtos Biodegradáveis" title="Produtos Biodegradáveis" width="128" height="128">
                    <h3 class="fw-bold mt-2">Produtos Biodegradáveis</h3>
                    <p class="small">Oferecemos produtos biodegradáveis de médio e curto prazo, garantindo segurança e
                      responsabilidade ambiental.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-embalagens-reduzidas.webp" alt="Embalagens Reduzidas" title="Embalagens Reduzidas" width="128" height="128">
                    <h3 class="fw-bold mt-2">Embalagens Reduzidas</h3>
                    <p>Com fórmulas mais concentradas e reutilização de embalagens, diminuímos significativamente o uso de
                      plástico e a poluição.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-entrega-rapida.webp" alt="Entrega Rápida" title="Entrega Rápida" width="128" height="128">
                    <h3 class="fw-bold mt-2">Entrega Rápida</h3>
                    <p class="small">Estando localizados na região metropolitana, oferecemos a maioria de nossos produtos
                      à pronta
                      entrega, permitindo atender os pedidos dos clientes com eficiência e rapidez.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-reciclagem-embalagens.webp" alt="Reciclagem de Embalagens" title="Reciclagem de Embalagens" width="128" height="128">
                    <h3 class="fw-bold mt-2">Reciclagem de Embalagens</h3>
                    <p>Reciclamos e reaproveitamos embalagens PET, PED e PEAD, contribuindo para um ciclo de produção mais
                      sustentável.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-materia-prima-vegetal.webp" alt="Matéria-Prima Vegetal" title="Matéria-Prima Vegetal" width="128" height="128">
                    <h3 class="fw-bold mt-2">Matéria-Prima Vegetal</h3>
                    <p>A maioria de nossos produtos são fabricados com matérias-primas de origem vegetal, promovendo uma
                      produção mais ecológica.</p>
                  </div>
                </div>
    
              </div>
    
              <div class="col mb-2">
                <div class="card border-0 h-100 shadow-sm">
                  <div class="card-body text-center">
                    <img loading="lazy" src="img/diferenciais/icone-energia-sustentavel.webp" alt="Energia Sustentável" title="Energia Sustentável" width="128" height="128">
                    <h3 class="fw-bold mt-2">Energia Sustentável</h3>
                    <p>Geramos nossa própria energia com placas solares, integrando soluções energéticas renováveis ao
                      nosso processo produtivo.</p>
                  </div>
                </div>
    
              </div>
    
            </div>
          </div>
    
          </div>
        </section>
    
        <section>
          <div class="calltocation-section" style="background: url('{{asset('img/industria-min.webp') }}') no-repeat center / cover;">
            <div class="container py-5">
              <div class="row">
                <div class="col-lg-6 text-white text-shadow">
    
                  <h2 class="fw-bold">Fale Conosco</h2>
                  <p>Se você enfrenta desafios e não encontra soluções, estamos aqui para ajudar! Fabricamos soluções
                    personalizadas e adaptamos nossos produtos às necessidades específicas da sua empresa.</p>
                  <p>Converse com nosso departamento comercial ou solicite uma cotação.</p>
    
                  <a href="https://wa.me/5591981199504/?text=Olá! Estou no site e desejo obter mais informações!" target="_blank" class="btn btn-warning" title="Entre em contato">Entre em contato</a>
    
                </div>
              </div>
            </div>
          </div>
        </section>
    
        {{-- BLOG --}}
        {{-- @include('components.blog-home') --}}

@endsection
