<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegDependencia extends Model
{
    use HasFactory;

    protected $table = 'seg_dependencia';
    protected $guarded = [];


    protected static function booted() {
        //atribuindo permissão a todos os perfis que possuem esta ação
        /*
         * verificar se o perfil possui permissão para a ação
         * adicionar nova dependência ao perfil
         */
        static::created(function ($o) {


        });

        //atualizando permissão de todos os perfis que possuem esta ação
        static::updated(function ($o) {});
    }
}
