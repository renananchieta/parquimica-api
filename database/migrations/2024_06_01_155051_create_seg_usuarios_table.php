<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seg_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('nome_social', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->string('senha');
            $table->string('cpf', 11)->unique();
            $table->boolean('ativo')->default(true);
            $table->date('dt_nascimento');
            $table->string('contato')->nullable();
            $table->string('contato_wpp');
            $table->string('estado')->nullable();
            $table->string('municipio')->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('logradouro', 255)->nullable();
            $table->string('numero', 50)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seg_usuarios');
    }
};
