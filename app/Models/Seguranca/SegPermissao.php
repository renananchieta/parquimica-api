<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegPermissao extends Model
{
    use HasFactory;

    protected $table = 'seg_permissao';
    protected $guarded = [];
}
