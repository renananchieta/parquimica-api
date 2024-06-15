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
                "nome" => "api/admin/perfis",
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
                "nome" => "api/admin/perfil",
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
                "nome" => "api/admin/perfil/{perfil}",
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
                "nome" => "api/admin/perfil/{perfil}",
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
                "nome" => "api/admin/perfil/{perfil}",
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
                "nome" => "api/admin/usuarios",
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
                "nome" => "api/admin/usuario",
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
                "nome" => "api/admin/usuario/{usuario}",
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
                "nome" => "api/admin/usuario/{usuario}",
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
                "nome" => "api/admin/usuario/{usuario}",
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
                "nome" => "api/login",
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
                "nome" => "api/usuario-info",
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
                "nome" => "api/logout",
                "method" => "GET",
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
                "id" => 1513,
                "nome" => "api/home",
                "method" => "GET",
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
                "id" => 1514,
                "nome" => "api/admin/usuarios/create",
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
        ];

        DB::table('seg_acao')->insert($items);
    }
}
