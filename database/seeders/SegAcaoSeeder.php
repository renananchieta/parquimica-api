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
                "nome" => "api/perfil",
                "method" => "POST",
                "descricao" => "Cadastrar perfil",
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1501,
                "nome" => "api/perfil/grid",
                "method" => "GET",
                "descricao" => "Listar todos os perfis",
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1502,
                "nome" => "api/perfil/create",
                "method" => "GET",
                "descricao" => "Parâmetros para cadastrar perfil",
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1503,
                "nome" => "api/perfil/{perfil}/edit",
                "method" => "GET",
                "descricao" => "Editar dados de perfil",
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1504,
                "nome" => "api/perfil/{perfil}",
                "method" => "DELETE",
                "descricao" => "Remover Perfil",
                "destaque" => true,
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
                "descricao" => "Listar todos os usuários",
                "destaque" => true,
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
                "descricao" => "Cadastrar usuário",
                "destaque" => true,
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
                "descricao" => "Editar Usuário",
                "destaque" => true,
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
                "descricao" => "Alterar dados de usuário",
                "destaque" => true,
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
                "descricao" => "Remover Usuário",
                "destaque" => true,
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
                "descricao" => "Login",
                "destaque" => true,
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
                "descricao" => "Informações de usuário",
                "destaque" => true,
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
                "descricao" => "Página inicial",
                "destaque" => true,
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
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1515,
                "nome" => "api/perfil/{perfil}",
                "method" => "PUT",
                "descricao" => "Alterar dados de perfil",
                "destaque" => true,
                "nome_amigavel" => null,
                "obrigatorio" => false,
                "grupo" => null,
                "log_acesso" => false,
                "created_at" => Carbon::now(),
                "updated_at" => null
            ],
            [
                "id" => 1516,
                "nome" => "api/admin/usuarios/create",
                "method" => "GET",
                "descricao" => "Parâmetros para cadastrar usuário",
                "destaque" => true,
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
