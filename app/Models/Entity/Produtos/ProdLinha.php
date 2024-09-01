<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdLinha extends Model
{
    use HasFactory;
    protected $table = 'prod_linha';
    protected $guarded = [];
}
