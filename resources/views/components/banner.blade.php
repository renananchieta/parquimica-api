<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    
    <div class="carousel-inner">
      <!-- Slide 1 (Text on the right) -->
      <div class="carousel-item active">
        <img src="{{ asset('img/slide2-min.webp') }}" class="d-block w-100" width="100%" height="auto" alt="40 ANOS DE EXPERIÊNCIA" title="40 ANOS DE EXPERIÊNCIA" >
        <div class="carousel-caption carousel-caption-left caption01">
            <h1>
                <strong>40 ANOS DE EXPERIÊNCIA</strong> <br>
                PROPORCIONANDO ECONOMIA <br>
                E VERSATILIDADE
            </h1>
          {{-- <p>...</p> --}}
          {{-- <a href="#" class="btn btn-primary">Learn More</a> --}}
        </div>
      </div>
  
      <!-- Slide 2 (Text on the left) -->
      <div class="carousel-item">
        <img loading="lazy" src="{{ asset('img/slide1-min.webp') }}" class="d-block w-100" alt="PRODUTOS QUÍMICOS DE QUALIDADE" title="PRODUTOS QUÍMICOS DE QUALIDADE" >
        <div class="carousel-caption carousel-caption-right caption02">
            <h2>
                PRODUTOS QUÍMICOS DE <br>
                <strong>QUALIDADE  <br> E SOLUÇÕES
                    INOVADORAS</strong>
                
            </h2>
          {{-- <p>...</p> --}}
          {{-- <a href="#" class="btn btn-primary">Learn More</a> --}}
        </div>
      </div>
  
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
