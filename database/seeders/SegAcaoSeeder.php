<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SegAcaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                "id" => 1500,
                "nome" => "/admin/perfis",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1501,
                "nome" => "/admin/perfil",
                "method" => "POST",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1502,
                "nome" => "/admin/perfil/{perfil}",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1503,
                "nome" => "/admin/perfil/{perfil}",
                "method" => "PUT",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1504,
                "nome" => "/admin/perfil/{perfil}",
                "method" => "DELETE",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1505,
                "nome" => "/admin/usuarios",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1506,
                "nome" => "/admin/usuario",
                "method" => "POST",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1507,
                "nome" => "/admin/usuario/{usuario}",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1508,
                "nome" => "/admin/usuario/{usuario}",
                "method" => "PUT",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1509,
                "nome" => "/admin/usuario/{usuario}",
                "method" => "DELETE",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1510,
                "nome" => "/login",
                "method" => "POST",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => true,
                "grupo" => "obrigatório",
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1511,
                "nome" => "/usuario-info",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1512,
                "nome" => "/logout",
                "method" => "GET",
                "descricao" => null,
                "destaque" => false,
                "nome_amigavel" => null,
                "obrigatorio" => true,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
        ];

        DB::table('seg_acao')->insert($items);
    }
}
