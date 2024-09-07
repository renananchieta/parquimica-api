<?php

namespace App\Models\Entity\Produtos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linha extends Model
{
    use HasFactory;
    protected $table = 'linha';
    protected $guarded = [];
}
