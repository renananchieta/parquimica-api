<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LITERATURA E DETALHES DE PRODUTO</title>
    <style>
        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header img {
            margin: 0; /* Remova o espaçamento padrão das imagens */
        }

        @font-face {
            font-family: 'Calibri';
            src: url('<?= asset('fonts/calibri/calibri.ttf') ?>') format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'CalibriB';
            src: url('<?= asset('fonts/calibri/calibrib.ttf') ?>') format("truetype");
            font-weight: bold;
        }

        body {
            font-family: Arial, sans-serif; /* Alterando para Arial */
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 0;
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

                    @foreach ($item->detalhes as $detalhe)
                        <div class="details-container">
                            <div class="details-left">{{ $detalhe->LITENS_DSC }}</div>
                            <div class="details-right">{{ $detalhe->LID_DSC }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
