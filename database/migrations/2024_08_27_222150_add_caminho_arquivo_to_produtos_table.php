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
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('caminho_arquivo')->nullable();
            $table->string('linha')->nullable();
            $table->string('funcao')->nullable();
            $table->dropUnique(['codigo_produto']);
            $table->dropUnique(['nome_produto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('caminho_arquivo');
            $table->dropColumn('linha');
            $table->dropColumn('funcao');
        });
    }
};
