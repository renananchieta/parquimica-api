<?php

test('Cadastrar Estudantes individualmente (POST) - Homologação MEC', function () {
    $dados = [
        "id" => "",
        "cpf" => "01143718234",
        "nome" => "RENAN GONÇALVES ANCHIETA PEREIRA",
        "numeroNIS" => "",
        "rg" => "",
        "orgaoEmisor" => "POLÍCIA CIVÍL - PA",
        "cpfResponsavel" => "",
        "nomeMaeEstudante" => "MARIA DAS GRAÇAS PEREIRA",
        "numeroNISResponsavel" => "",
        "dataNascimento" => "1993-08-31",
        "logradouro" => "Conjunto Pedro Álvares Cabral",
        "bairro" => "Marambaia",
        "numero" => "319",
        "cep" => "66615235",
        "municipio" => "1500107",
        "certidaoNascimento" => "",
        "cnh" => "",
        "instituicao" => "18929",
        "inep" => "15064280",
        "dataInicioMatricula" => "2024/01/01",
        "dataFimMatricula" => "",
        "uf" => "15",
        "racaCor" => "0",
        "tipoDeficiencia" => [],
        "genero" => "1",
        "situacaoMat" => true,
        "serieAno" => "1",
    ];
    $response = $this->postJson('/api/mec/homologacao/estudante/store', $dados);
    expect($response)
        ->assertStatus(201);
});

test('Consultar Estudante (GET) - Homologação MEC', function () {
    $cpf = "01143718234";
    $response = $this->getJson('/api/mec/homologacao/estudante/' . $cpf);
    expect($response)
        ->assertStatus(200);
});