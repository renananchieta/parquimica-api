<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdFuncao extends Model
{
    use HasFactory;
    protected $table = 'prod_funcao';
    protected $guarded = [];
}
