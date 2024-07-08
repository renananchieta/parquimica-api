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

        #header {
            text-align: center;
            margin: auto;
            font-weight: bold;
        }

        body {
            font-family: 'Calibri', 'CalibriB';
            position: relative;
            left: 0px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 0;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0; /* espaçamento interno do rodapé */
            border-top: 1px solid #000; /* Adiciona uma linha preta no topo do rodapé */
        }

        #footer p {
            margin: 0 0 5px 0; /* Adiciona um espaçamento entre a linha preta e o texto */
            font-size: 12px; /* Define o tamanho da fonte como 12px */
            font-weight: normal; /* Remove o negrito do texto */
        }

        #conteudo {
            margin-top: 50px;
            margin-bottom: 5px;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        table {
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 2px;
        }
        .quebra_de_pagina{
            page-break-after: always;
        }
        .subtabela {
            min-width: 102%;
            /*Cima, Baixo, Esquerda, Direita*/
            margin: -3px -1px -0px -3px;
            border: 1px;
            border-collapse: unset;
        }
        .subtabela th, td, tr {
            height: 100vh;
            font-size: 10px;
            font-weight: normal;
        }
        .subtabela th {
            font-weight: bold;
        }

        .not-bold {
            font-weight: normal;
        }
        .titulo_anexo {
            font-size: 15px;
            text-align: justify;
            font-family: 'Calibri', 'sans-serif';
        }
        .paragrafo_roteiro_inicio{
            font-size: 14px;
            text-align: justify;
            font-family: 'Calibri', 'sans-serif';
            margin-left: 60px;
        }
        .paragrafo_roteiro{
            font-size: 14px;
            text-align: justify;
            font-family: 'Calibri', 'sans-serif';
        }
        .tabela_contato{
            width: 100%;
            border-collapse: collapse;
        }
        .tabela_contato th{
            font-weight: bold;
            border: 1px solid #000;
        }
        .tabela_contato td {
            border: 1px solid #000;
            font-weight: normal;
        }
    </style>
</head>

{{--    INICIO DO CONTROLE DE CHEGADA (Equipes de Cumprimento)--}}
<body>
    <div id="header">
        <div>
            <div>PARQUIMICA</div>
        </div>
    </div>
    <div id="body">
        <p class="titulo_anexo">ANEXO III</p>
        <div class="container">
            <table border="1" cellpadding="5" cellspacing="0" width="85">
                <tr>
                    TESTE
                </tr>
                    <th>EQUIPE</th>
                    <th>CHEGADA</th>
                    <th>MANDADOS</th>
                </tr>
            </table>
            <div>
                <p>OBSERVAÇÕES IMPORTANTES:</p>
            </div>
        </div>
    </div>
    <div class="quebra_de_pagina"></div>
</body>
</html>
