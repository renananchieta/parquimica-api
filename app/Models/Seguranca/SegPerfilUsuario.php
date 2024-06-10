<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SegPerfilUsuario extends Model
{
    use HasFactory;
    protected $table = 'seg_perfil_usuario';
    protected $fillable = [
        'usuario_id',
        'perfil_id'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo('App\Models\Seguranca\Usuario', 'usuario_id');
    } 

    public function perfil(): BelongsTo
    {
        return $this->belongsTo('App\Models\Seguranca\SegPerfil', 'perfil_id');
    }
}
