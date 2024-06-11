<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SegAcao extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'seg_acao';
    protected $guarded = [];
}
