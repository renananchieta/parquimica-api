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
        Schema::create('seg_perfil_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('seg_usuarios');
            $table->foreignId('perfil_id')->constrained('seg_perfil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seg_perfil_usuario');
    }
};
