<?php

namespace App\Models\Seguranca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = 'seg_usuarios';
    protected $fillable = [
        'nome',
        'nome_social',
        'email',
        'senha',
        'cpf',
        'dt_nascimento',
        'contato',
        'contato_wpp',
        'estado',
        'municipio',
        'bairro',
        'logradouro',
        'numero',
    ];
    protected $primaryKey = 'id';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function perfis()
    {
        return $this->belongsToMany(SegPerfil::class, 'seg_perfil_usuario', 'usuario_id', 'perfil_id');
    }
}
