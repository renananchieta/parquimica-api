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
        Schema::create('log_acesso', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('ip');
            $table->string('user_agent');
            $table->dateTime('login');
            $table->dateTime('logout')->nullable();
            $table->dateTime('ultimo_acesso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_acesso');
    }
};
