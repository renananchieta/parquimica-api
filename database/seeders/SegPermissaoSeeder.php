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
        ];

        DB::table('seg_permissao')->insert($itens);
        DB::statement("ALTER TABLE seg_permissao AUTO_INCREMENT = 5;");
    }
}
