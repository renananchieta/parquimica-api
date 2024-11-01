@extends('layouts.app')

@section('content')

@include('components.ImageTop')

    <main>

        <div class="container mt-5">
            <div class="bg-light small">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" title="Home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contato</li>
                  </ol>
                </nav>
        
              </div>

            <div class="mb-4 linha_marcador">
                <h1 class="marcador">Entre em contato</h1>
            </div>


            <div class="row">
                <div class="col-lg-6">



                    <p>
                        Estamos prontos para atender suas dúvidas, sugestões ou solicitações. Na Parquímica Indústria, oferecemos soluções industriais de qualidade, sempre com foco em eficiência e inovação. Preencha o formulário ao lado e nossa equipe entrará em contato o mais breve possível.
                    </p>
                    <p>
                        Se preferir, você também pode nos contatar pelos e-mails ou telefones listados abaixo. Estamos à disposição para ajudá-lo a encontrar as melhores soluções para o seu negócio.
                    </p>


                    <div class="row contatos mt-4">
                        <div class="col">
                            <h4>E-mails</h4>

                            <p>
                                comercial@parquimica.com.br <br>
                                vendas@parquimica.com.br
                            </p>
                        </div>
                        <div class="col">
                            <h4>Telefones:</h4>

                            <p><strong>Comercial:</strong> +55 (91) 3344-3346 <br>
                                <strong>Vendas:</strong> +55 (91) 98119-9504 <br>
                                <strong>Loja:</strong> +55 (91) 98119-9507</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <h4>Horário de funcionamento:</h4>
                            <p>
                                Segunda a Quinta das 07:00 às 17:00 horas. <br>
                                Sexta das 07:00 às 16:00 horas.</p>
                        </div>
                    </div>

                    <div class="row my-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15954.587424322204!2d-48.4119316!3d-1.3884691!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a48ac69a944b13%3A0x197d6bc29566fd4b!2sParqu%C3%ADmica%20Ind%C3%BAstria!5e0!3m2!1spt-BR!2sbr!4v1721742661972!5m2!1spt-BR!2sbr"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Localização"></iframe>
                    </div>


                </div>

                <div class="col-lg-6 mb-5">

                    <h3>Preencha o formulário:</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form name="contato" id="contato" action="{{ route('enviar', ['form' => 'contato']) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome (obrigatório)</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                aria-describedby="textHelp" placeholder="Escreva seu nome...">

                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email (obrigatório)</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="seuemail@empresa.com.br">

                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone (obrigatório)</label>
                            <input type="text" class="form-control" id="telefone" name="telefone"
                                aria-describedby="textHelp" placeholder="(99) 99999-9999">

                        </div>

                        <div class="mb-3">
                            <label for="departamento" class="form-label">Departamento (obrigatório)</label>
                            <select class="form-select" name="departamento" id="departamento">
                                <option value="">Selecione um departamento</option>
                                <option value="1">Comercial</option>
                                <option value="2">RH</option>
                                <option value="3">Compras</option>
                                <option value="4">Financeiro</option>
                                <option value="5">Reclamações</option>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="assunto" class="form-label">Assunto (obrigatório)</label>
                            <input type="text" class="form-control" id="assunto" name="assunto"
                                aria-describedby="textHelp" placeholder="Escreva o assunto...">

                        </div>

                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem (obrigatório)</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Escreva sua mensagem..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-warning w-100" name="enviar" id="enviar">Enviar</button>
                    </form>

                </div>
            </div>

        </div>


    </main>

@endsection
