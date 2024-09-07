<?php

use Carbon\Carbon;

test('Consultar frequencia Index (GET)', function () {
    $response = $this->getJson('/api/frequencia/index');
    expect($response)
        ->assertStatus(200);
});

test('Cadastrar Frequência individualmente Store (POST)', function () {
    $dados = [
        'codigoMatricula' => '111111111',
        'mesReferencia' => '04',
        'anoReferencia' => '2024',
        'hlOfertadaPeriodo' => '200',
        'hlPresentePeriodo' => '150',
        'jutificativaSuspensaoAula' => '3'
    ];
    $response = $this->postJson('/api/frequencia/store', $dados);
    expect($response)
        ->assertStatus(200);
});

test('Cadastrar Frequência individualmente Store (POST) - Homologação MEC.', function () {
    $dados = [
        'codigoMatricula' => "1374729",
        'mesReferencia' => '11',
        'anoReferencia' => "2024",
        'hlOfertadaPeriodo' => "600",
        'hlPresentePeriodo' => "600",
        'jutificativaSuspensaoAula' => '',
    ];
    $response = $this->postJson('/api/mec/homologacao/frequencia-estudantes/store', $dados);
    expect($response)
        ->assertStatus(201);
})->only();

test('Consultar Frequência de estudante pelo CPF (GET) - Homologação MEC', function () {
    $cpf = "01143718225";
    $response = $this->getJson('/api/mec/homologacao/frequencia-estudante/' . $cpf);
    expect($response)
        ->assertStatus(200);
});

test('Cadastrar frequência de estudantes em Lotes (POST) - Homologação MEC', function () {
    //
});