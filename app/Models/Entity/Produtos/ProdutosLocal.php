<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosLocal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'produtos';
    protected $fillable = [
        'codigo_produto',
        'nome_produto',
        'subtitulo',
        'modo_acao',
        'recomendacao',
        'variantes_produtos',
        'ativo_site'
    ];
}
