<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguracaoPages extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'configuracao_pages';
    protected $guarded = [];
}
