<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $itens = [
            [
                "id" => 1,
                "nome" => "Admin",
                "cpf" => "12345678910",
                "email" => "admin.user@gmail.com",
                "senha" => Hash::make(12345678),
                "contato_wpp" => "91993039530",
                "dt_nascimento" => "2000-01-01",
                "ativo" => true,
                "created_at" => Carbon::now(),
            ],
            [
                "id" => 2,
                "nome" => "Renan Anchieta",
                "cpf" => "12345678911",
                "email" => "renangap18@gmail.com",
                "senha" => Hash::make(12345678),
                "contato_wpp" => "91993039531",
                "dt_nascimento" => "2000-01-02",
                "ativo" => true,
                "created_at" => Carbon::now(),
            ],
            [
                "id" => 3,
                "nome" => "Ítalo Costa",
                "cpf" => "12345678912",
                "email" => "italocosta@gmail.com",
                "senha" => Hash::make(12345678),
                "contato_wpp_wpp" => "91993039532",
                "dt_nascimento" => "2000-01-03",
                "ativo" => true,
                "created_at" => Carbon::now(),
            ],
        ];
        DB::table('seg_usuarios')->insert($itens);
        DB::statement("ALTER TABLE seg_usuarios AUTO_INCREMENT = 4;");
    }
}
