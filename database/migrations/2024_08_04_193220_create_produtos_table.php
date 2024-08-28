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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo_produto');
            $table->string('nome_produto');
            $table->text('subtitulo');
            $table->text('modo_acao');
            $table->text('recomendacao')->nullable();
            $table->string('slug')->nullable();
            $table->integer('ativo_site')->default(0);
            $table->text('variantes')->nullable();
            $table->string('caminho_arquivo')->nullable();
            $table->string('linha')->nullable();
            $table->string('funcao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
