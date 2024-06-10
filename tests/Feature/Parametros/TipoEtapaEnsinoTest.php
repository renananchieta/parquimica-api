<?php

test('(POST) Cadastrar Tipo de Etapa de Ensino', function () {
    $dados = [
        'codigo_etapa_ensino' => 100,
        'descricao' => 'Teste'
    ];
    $response = $this->postJson('/api/tipo-etapa-ensino/store', $dados);
    expect($response)
        ->assertStatus(200);
})->only();