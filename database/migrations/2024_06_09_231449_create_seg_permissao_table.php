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
        Schema::create('seg_permissao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('seg_acao');
            $table->foreignId('perfil_id')->constrained('seg_perfil');
            $table->timestamps();

            $table->unique(['acao_id', 'perfil_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seg_permissao');
    }
};
