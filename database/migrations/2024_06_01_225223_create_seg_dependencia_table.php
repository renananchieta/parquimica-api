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
        Schema::create('seg_dependencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_atual_id')->constrained('seg_acao');
            $table->foreignId('acao_dependencia_id')->constrained('seg_acao');
            $table->timestamps();
            
            $table->unique(['acao_atual_id', 'acao_dependencia_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seg_dependencia');
    }
};
