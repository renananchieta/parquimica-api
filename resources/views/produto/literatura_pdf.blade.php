<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LITERATURA E DETALHES DE PRODUTO</title>
    <style>
        /* Estilos anteriores aqui */

        .details-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            page-break-inside: avoid; /* Evitar quebrar a página no meio de um detalhe */
        }

        .details-left {
            width: 30%;
            font-weight: bold;
            font-family: 'CalibriB', Arial, sans-serif; /* Utilizando a fonte Calibri bold se disponível */
            text-align: left;
        }

        .details-right {
            width: 65%;
            font-family: 'Calibri', Arial, sans-serif; /* Utilizando a fonte Calibri se disponível */
            text-align: justify;
            padding-left: 10px;
        }

        /* Outros estilos continuam aqui */
    </style>
</head>

<body>
    <div id="header">
        <div>
            @foreach ($literatura as $item)
                <div>
                    <h2>{{ $item->PRD_NOME }}</h2>
                    <h3>"{{ $item->PRD_LIT_DSC }}"</h3>
                </div>

                @foreach ($item->detalhes as $detalhe)
                    @foreach ($$detalhe as $desc)
                        <div class="details-container">
                            <div class="details-left">{{ $desc->LITENS_DSC }}</div>
                            <div class="details-right">{{ $desc->LID_DSC }}</div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>

    <!-- Restante do seu conteúdo HTML -->

</body>

</html>
