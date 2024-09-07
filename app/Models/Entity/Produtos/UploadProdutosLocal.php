<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadProdutosLocal extends Model
{
    use HasFactory;
    protected $table = 'imagens_produtos';
    protected $guarded = [];
}
