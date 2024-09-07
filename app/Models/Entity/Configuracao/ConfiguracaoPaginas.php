<?php

namespace App\Models\Entity\Configuracao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguracaoPaginas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
}
