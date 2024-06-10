<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    use HasFactory;
    protected $table = 'log_acesso';
    protected $guarded = [];
}
