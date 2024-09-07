<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantesProduto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'variantes_produto';
    protected $guarded = [];
}
