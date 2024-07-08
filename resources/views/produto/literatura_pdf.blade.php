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

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details-table th {
            background-color: #f2f2f2;
            padding: 8px;
            font-weight: bold;
            text-align: left;
        }

        .details-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .details-left {
            font-weight: bold;
        }

        .details-right {
            font-family: "Times New Roman", Times, serif;
        }

    </style>
</head>
<body>
    <div id="header">
        <div>
            @foreach ($literatura as $item)
                <div>
                    <h2>{{ $item->PRD_NOME }}</h2>
                    <h3>"{{ $item->PRD_LIT_DSC }}"</h3>

                    <table class="details-table">
                        <thead>
                            <tr>
                                <th>Detalhe</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->detalhes as $detalhe)
                                <tr>
                                    <td class="details-left">{{ $detalhe->LITENS_DSC }}</td>
                                    <td class="details-right">{{ $detalhe->LID_DSC }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
