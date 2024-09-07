<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SegPermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itens = [
            [
                "id" => 1,
                "acao_id" => 1514,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 2,
                "acao_id" => 1500,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 3,
                "acao_id" => 1501,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 4,
                "acao_id" => 1502,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 5,
                "acao_id" => 1503,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 6,
                "acao_id" => 1504,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 7,
                "acao_id" => 1505,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 8,
                "acao_id" => 1506,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 9,
                "acao_id" => 1507,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 10,
                "acao_id" => 1508,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 11,
                "acao_id" => 1509,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
            [
                "id" => 12,
                "acao_id" => 1515,
                "perfil_id" => 2,
                "created_at" => Carbon::now()
            ],
        ];

        DB::table('seg_permissao')->insert($itens);
        DB::statement("ALTER TABLE seg_permissao AUTO_INCREMENT = 5;");
    }
}
