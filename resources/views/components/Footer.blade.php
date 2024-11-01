<footer>
    
    <div class="container py-4 text-white">

        <div class="row">
            <div class="mb-3 col-lg-3 col-md-6 col-sm-6 text-center">
                <img loading="lazy" src="{{ secure_asset('img/logo-parquimica.webp') }}" width="200" height="auto" class="logo" alt="Parquimica Indústria" title="Parquimica Indústria">
                <br>
                <p class="mt-2 mb-4 small">Há mais de 40 anos trazendo qualidade para a região norte do Brasil.</p>

                <ul class="nav d-flex justify-content-center">

                <li class="nav-item">
                    <a class="nav-link px-2" target="_blank" href="https://www.instagram.com/parquimica/" title="Instagram">
                    <img loading="lazy" src="{{ secure_asset('img/icons/instagram.svg') }}" alt="Instagram" title="Instagram" width="32" height="32">
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link px-2" target="_blank" href="https://www.facebook.com/parquimicaindustrias/" title="Facebook">
                    <img loading="lazy" src="{{ secure_asset('img/icons/facebook.svg') }}" alt="Facebook" title="Facebook" width="32" height="32">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" target="_blank" href="https://www.linkedin.com/company/parquimica" title="Linkedin">
                    <img loading="lazy" src="{{ secure_asset('img/icons/linkedin.svg') }}" alt="Linkedin" title="Linkedin" width="32" height="32">
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-2" target="_blank" href="#" title="Youtube">
                    <img loading="lazy" src="{{ secure_asset('img/icons/youtube.svg') }}" alt="Youtube" title="Youtube" width="32" height="32">
                    </a>
                </li>

                </ul>

            </div>


            <div class="mb-3 col-lg-3 col-md-6 col-sm-6">
                <p class="subtitle-footer text-white fw-semibold">Links Úteis</p>

                <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link text-white p-0" href="{{ route('empresa') }}" title="A Empresa" >- A Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white p-0" href="{{ route('produtos') }}" title="Linhas de Produtos" >- Linhas de Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white p-0" href="{{ route('cotacao') }}" title="Faça uma Cotação" >- Faça uma Cotação</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white p-0" href="{{ route('contato') }}" title="Fale Conosco" >- Fale Conosco</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white p-0" href="{{ route('blog') }}" title="Blog" >- Blog</a>
                </li> --}}
                <li class="nav-item">
                  <a class="nav-link text-white p-0" href="{{ route('certificacoes') }}" title="Certificações" >- Certificações</a>
                </li>


                </ul>

            </div>

            <div class="mb-3 col-lg-3 col-md-6 col-sm-6">
                <p class="subtitle-footer fw-semibold">Endereço</p>
                <p>BR 316, Km 4, número 4444 <br>
                Guanabara, Ananindeua - Pará <br>
                CEP 67110-000
                </p>
            </div>


            <div class="mb-3 col-lg-3 col-md-6 col-sm-6">

                <p class="subtitle-footer text-white fw-semibold">Contatos</p>

                <p class="small">
                  <a href="mailto:comercial@parquimica.com.br" title="Entre em contato com o nosso departamento Comercial">comercial@parquimica.com.br</a> <br>
                  <a href="mailto:vendas@parquimica.com.br" title="Entre em contato com o nosso departamento de Vendas">vendas@parquimica.com.br</a>
                </p>

                <p class="subtitle-footer text-white">Telefones</p>

                <p class="small">
                Comercial: <a href="tel:+559133443346" title="Entre em contato com o nosso departamento Comercial">+55 (91) 3344-3346</a> <br>
                Vendas: <a href="https://wa.me/5591981199504/?text=Olá! Desejo obter mais informações sobre o catálogo de produtos!" title="Entre em contato pelo Whatsapp!" target="_blank" rel="noopener noreferrer">+55 (91) 98119-9504</a> <br>
                Loja: <a href="tel:+5591981199507" title="Entre em contato com a nossa Loja">+55 (91) 98119-9507</a>
                </p>
            </div>
        </div>
        <div class="row copyright pt-2">
            <div class="container">
                <div class="wrapper text-center">
                  <small>
                    Copyright &copy; {{ date('Y') }} Parquimica Indústria
                  </small>
            <br>
                  <a href="https://www.newboxinfo.com.br/" target="_blank" rel="noopener" class="assinatura" title="Entre em Contato com a New Box!">
                    <small>
                      Desenvolvido por <strong>New Box</strong>
                    </small>
                  </a>
                </div>
              </div>
        </div>
    </div>
</footer>


  <div class="floating-button">
    <a href="https://wa.me/5591981199504/?text=Olá! Desejo obter mais informações sobre o catálogo de produtos!" class="float" title="Entre em contato pelo Whatsapp!">
      <img loading="lazy" src="{{ secure_asset('img/icons/whatsapp.svg') }}" width="40" height="40" alt="icon-whatsapp" title="icon-whatsapp">
    </a>
  </div>

  <script src="{{ secure_asset('js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ secure_asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
    $(document).ready(function() {
      $('#carouselExample').carousel({
        interval: 2000
      })

      const elementosComClasseText = document.querySelectorAll('.ql-align-center');

      elementosComClasseText.forEach(elemento => {
        elemento.style.textAlign = 'center';
      });
    });
    </script>

  <script type="text/javascript">
    var nav = document.querySelector('nav');

    window.addEventListener('scroll', function () {
      if (window.pageYOffset > 10) {
        nav.classList.add('topo', 'shadow');
      } else {
        nav.classList.remove('topo', 'shadow');
      }
    }); 
  </script>

  <script>
    const numbers = document.querySelectorAll("[data-number]");

    if (numbers.length > 0) {
      const startNumberAnimation = (element) => {
        const number = +element.innerText;
        const numberDivision = number / 30;
        const animationRuntimeMS = 50;
        let dynamicNumber = 0;

        element.innerText = dynamicNumber;

        const animateNumbers = setInterval(() => {
          if (dynamicNumber < number) {
            dynamicNumber += numberDivision;
            element.innerText = Math.floor(dynamicNumber);
          } else {
            element.innerText = number;
            clearInterval(animateNumbers);
          }
        }, Math.random() * animationRuntimeMS);
      };

      numbers.forEach((number) => {
        startNumberAnimation(number);
      });
    }
  </script>
