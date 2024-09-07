<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SegPerfil extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'seg_perfil';
    protected $fillable = [
        'perfil'
    ];
    
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'seg_perfil_usuario', 'perfil_id', 'usuario_id');
    }
}
