<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SegAcaoSeeder::class,
            UsuarioSeeder::class,
            SegPerfilSeeder::class,
            SegPerfilUsuarioSeeder::class,
            SegPermissaoSeeder::class,
            // EscolasSeeder::class,
            // EstudantesSeeder::class,
            // MatriculaEstudantesSeeder::class,
            // FrequenciaEstudantesSeeder::class,
        ]);
    }
}
