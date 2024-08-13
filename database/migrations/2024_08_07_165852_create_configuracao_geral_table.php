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
        Schema::create('configuracao_geral', function (Blueprint $table) {
            $table->id();
            $table->string('nome_empresa')->nullable();
            $table->string('numero_um')->nullable();
            $table->string('numero_dois')->nullable();
            $table->string('link_wpp')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('segunda_sexta')->nullable();
            $table->string('sabado')->nullable();
            $table->string('domingo')->nullable();
            $table->string('variavel')->nullable();
            $table->string('valor')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracao_geral');
    }
};
